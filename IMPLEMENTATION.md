# Game Store - Mini Steam Implementation Guide

## 📋 Overview
Sistem e-commerce game lengkap dengan cart berbasis session, checkout dengan atomic transactions, dan playback system untuk browser/download games.

---

## 🗄️ Database Changes

### 1. Updated `games` table (migrations/2026_02_08_121819_create_games_table.php)
```sql
ALTER TABLE games ADD COLUMN type ENUM('browser', 'download') DEFAULT 'browser';
ALTER TABLE games ADD COLUMN embed_url TEXT NULL;
ALTER TABLE games ADD COLUMN file_path VARCHAR(255) NULL;
```

**Field Explanations:**
- `type`: Tipe game - 'browser' untuk iframe, 'download' untuk file
- `embed_url`: URL untuk iframe (jika type=browser)
- `file_path`: Path ke file download (jika type=download)

### 2. New `orders` table (migrations/2026_02_15_060000_create_orders_table.php)
```sql
CREATE TABLE orders (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FOREIGN KEY,
    total_price DECIMAL(10, 2),
    status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',
    timestamps
);
```

### 3. New `order_items` table (migrations/2026_02_15_060001_create_order_items_table.php)
```sql
CREATE TABLE order_items (
    id BIGINT PRIMARY KEY,
    order_id BIGINT FOREIGN KEY,
    game_id BIGINT FOREIGN KEY,
    price DECIMAL(10, 2),
    quantity INT UNSIGNED DEFAULT 1,
    timestamps
);
```

### 4. New `user_games` pivot table (migrations/2026_02_15_060002_create_user_games_table.php)
```sql
CREATE TABLE user_games (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FOREIGN KEY,
    game_id BIGINT FOREIGN KEY,
    timestamps,
    UNIQUE(user_id, game_id)
);
```

---

## 📦 Models & Relationships

### Game Model
```php
// app/Models/Game.php
public function users()
{
    return $this->belongsToMany(User::class, 'user_games')->withTimestamps();
}
```

### User Model
```php
// app/Models/User.php
public function orders()
{
    return $this->hasMany(Order::class);
}

public function games()
{
    return $this->belongsToMany(Game::class, 'user_games')->withTimestamps();
}
```

### Order Model (New)
```php
// app/Models/Order.php
public function user()
{
    return $this->belongsTo(User::class);
}

public function items()
{
    return $this->hasMany(OrderItem::class);
}
```

### OrderItem Model (New)
```php
// app/Models/OrderItem.php
public function order()
{
    return $this->belongsTo(Order::class);
}

public function game()
{
    return $this->belongsTo(Game::class);
}
```

---

## 🛒 Cart System (Session-Based)

### How It Works
1. Cart disimpan di session Laravel: `session('cart')`
2. Format: Array of objects dengan `game_id` dan `quantity`
3. Tidak ada data di database sampai checkout

### CartController Methods

#### 1. add(Game $game)
```php
// POST /cart/add/{game}
// Validasi: 
// - Game belum dibeli user
// - Tambah ke session cart atau increment quantity jika sudah ada
```

#### 2. remove(Game $game)
```php
// POST /cart/remove/{game}
// Remove game dari session cart
```

#### 3. view()
```php
// GET /cart
// Display cart page dengan list games + total price
```

---

## 💳 Checkout System

### CheckoutService (app/Http/Controllers/CheckoutService.php)
Service class untuk handle business logic checkout dengan atomic transaction.

**Proses:**
1. **Validasi semua items**
   - Stock mencukupi
   - User belum memiliki game (prevent double purchase)

2. **Atomic Transaction** (DB::transaction)
   - Create order record
   - Create order_items records
   - Attach games ke user (user_games pivot)
   - Decrement stock

3. **Error Handling**
   - Jika ada error, seluruh transaksi rollback
   - Exception thrown dengan pesan error yang jelas

### CheckoutController Methods

#### 1. show()
```php
// GET /checkout
// Display checkout page dengan order review
// Validasi cart tidak kosong
```

#### 2. process()
```php
// POST /checkout/process
// Process payment (dummy - selalu sukses)
// Call CheckoutService->checkout()
// Clear session cart jika sukses
// Redirect ke dashboard dengan success message
```

---

## 🎮 Play System

### PlayController Methods

#### play(Game $game)
```php
// GET /play/{game}
// Authorization check:
//   - User sudah login (auth middleware)
//   - User sudah membeli game (abort 403 jika tidak)
// 
// Logic:
//   - Jika type='browser': Render iframe dengan embed_url
//   - Jika type='download': Render download button dengan file_path
```

---

## 🚀 Routes

```php
// routes/web.php

// Cart Routes (auth required)
Route::post('/cart/add/{game}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{game}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

// Checkout Routes (auth required)
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// Play Game Route (auth + ownership check)
Route::get('/play/{game}', [PlayController::class, 'play'])->name('play.game');
```

---

## 📄 Views

### 1. cart.blade.php
- List game di cart dengan cover image
- Quantity per item
- Remove button
- Total price summary
- Proceed to checkout button

### 2. checkout.blade.php
- Order review dengan game details
- Payment summary (subtotal, tax, total)
- Complete purchase button
- Back to cart button

### 3. play.blade.php
**Browser Game (type='browser'):**
- Iframe dengan embed_url
- Sandbox security attributes

**Download Game (type='download'):**
- Download button
- File info display

### 4. user/dashboard.blade.php (Updated)
- Cart link di navbar
- "Tambah ke Cart" button untuk game belum dibeli
- "Play Game" button untuk game sudah dibeli

### 5. user/show.blade.php (Updated)
- "Tambah ke Cart" button untuk game belum dibeli
- "Play Game" button untuk game sudah dibeli

---

## ✅ GameController Updates

### store() method
**Validasi baru:**
```php
'type' => 'required|in:browser,download',
'embed_url' => 'required_if:type,browser|nullable|url',
'file_path' => 'required_if:type,download|nullable|string',
```

### update() method
Same validation seperti store()

---

## 🔐 Security Features

1. **Session-based Cart**: Cart data hanya di session, tidak exposed di URL
2. **Ownership Check**: Middleware auth + ownership verification di PlayController
3. **Stock Validation**: Cek stock saat checkout (atomic transaction)
4. **No Double Purchase**: Validasi user tidak bisa membeli game 2x
5. **Sandbox Iframe**: Iframe browser game menggunakan sandbox attributes
6. **Transaction Rollback**: Jika checkout error, semua changes di-rollback

---

## 🧪 Testing Checklist

### Cart Flow
- [ ] Add game ke cart dari game detail
- [ ] Prevent add game yang sudah dibeli
- [ ] Remove game dari cart
- [ ] View cart dengan correct total price
- [ ] Session persist across pages

### Checkout Flow
- [ ] Validate stock sufficient
- [ ] Validate user doesn't own game already
- [ ] Create order + order_items
- [ ] Attach game ke user_games
- [ ] Reduce stock
- [ ] Clear session cart
- [ ] Transaction rollback on error

### Play Flow
- [ ] Access /play/{game} tanpa auth → redirect login
- [ ] Access /play/{game} user tidak punya → abort 403
- [ ] Browser game → render iframe
- [ ] Download game → show download button
- [ ] Download button works

---

## 📝 Key Files

```
app/Models/
├── Game.php (Updated)
├── User.php (Updated)
├── Order.php (New)
└── OrderItem.php (New)

app/Http/Controllers/
├── GameController.php (Updated)
├── CartController.php (New)
├── CheckoutController.php (New)
├── CheckoutService.php (New - Business Logic)
└── PlayController.php (New)

routes/
└── web.php (Updated)

database/migrations/
├── 2026_02_08_121819_create_games_table.php (Updated)
├── 2026_02_15_060000_create_orders_table.php (New)
├── 2026_02_15_060001_create_order_items_table.php (New)
└── 2026_02_15_060002_create_user_games_table.php (New)

resources/views/
├── cart.blade.php (New)
├── checkout.blade.php (New)
├── play.blade.php (New)
├── user/dashboard.blade.php (Updated)
└── user/show.blade.php (Updated)
```

---

## 🎯 Architecture Notes

### Clean Architecture Pattern
- **Controllers**: Handle HTTP requests/responses only
- **Service Classes**: Business logic (CheckoutService)
- **Models**: Data layer with relationships
- **Middleware**: Authorization checks
- **Views**: UI rendering with Blade

### Transaction Safety
Seluruh checkout process menggunakan `DB::transaction()` untuk ensure atomicity. Jika salah satu step gagal, semua changes di-rollback.

### Session-Based Cart Benefits
- No database overhead for temporary cart
- Session cleared on logout
- Privacy: Cart tidak terikat ke user sampai checkout
- Fast: In-memory session operations

---

## 🚀 Next Steps / Future Enhancements

1. **Payment Gateway Integration**: Replace dummy payment dengan real Stripe/PayPal
2. **Wishlist System**: Add to wishlist table
3. **Reviews & Ratings**: User dapat rate/review games
4. **Game Library**: User profile page dengan collection mereka
5. **Search & Filter**: Filter by genre, price, rating
6. **Statistics Dashboard**: Sales, popular games untuk admin
7. **Email Notifications**: Order confirmation emails
8. **Refund System**: Handle refunds and disputes

---

## 📚 Reference

### Laravel Documentation
- [Relationships](https://laravel.com/docs/11.x/eloquent-relationships)
- [Transactions](https://laravel.com/docs/11.x/database#database-transactions)
- [Sessions](https://laravel.com/docs/11.x/session)
- [Middleware](https://laravel.com/docs/11.x/middleware)

### Code Comments
Key parts have `// Komentar Penting` untuk penjelasan logic

---

**Implementation Date**: February 15, 2026
**Framework**: Laravel 12
**PHP Version**: 8.2+
