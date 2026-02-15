# 🎮 Game Store Setup & Deployment Guide

## Pre-Requirements
- Laravel 12
- PHP 8.2+
- MySQL/PostgreSQL
- Composer

---

## 🔧 Installation Steps

### 1. Run Migrations
```bash
php artisan migrate
```

**Migrations yang akan dijalankan:**
- Update `games` table: tambah type, embed_url, file_path
- Create `orders` table
- Create `order_items` table
- Create `user_games` pivot table

### 2. Update Fillable Properties
Pastikan semua model sudah update:
- `Game`: Tambahkan `type`, `embed_url`, `file_path` ke fillable
- `User`: Sudah ada (tidak perlu update)
- `Order`: Baru dibuat (already correct)
- `OrderItem`: Baru dibuat (already correct)

### 3. Test Routes
```bash
php artisan route:list | grep -E "(cart|checkout|play)"
```

Expected routes:
```
POST   /cart/add/{game}              → CartController@add
POST   /cart/remove/{game}           → CartController@remove
GET    /cart                          → CartController@view
GET    /checkout                      → CheckoutController@show
POST   /checkout/process              → CheckoutController@process
GET    /play/{game}                   → PlayController@play
```

---

## 📱 User Flow

### 1. Browse Games
```
GET /dashboard → View all games
```

### 2. Add to Cart
```
POST /cart/add/{game} → Add game ke session cart
```

### 3. View Cart
```
GET /cart → See all items, total price, remove button
```

### 4. Checkout
```
GET /checkout → Review order
POST /checkout/process → Process payment (dummy) & create order
```

### 5. Play Game
```
GET /play/{game} → Check ownership & serve game
  - Browser: Show iframe with embed_url
  - Download: Show download button with file_path
```

---

## 🎯 Admin Setup

### Adding Browser Games
When creating/editing a game:
```
Type: browser
Embed URL: https://example.com/game-iframe
File Path: (leave empty)
```

Example browser games:
- Flappy Bird: https://flappybird.io
- Chrome Dino: https://chromedino.com
- 2048: https://2048.org

### Adding Download Games
```
Type: download
Embed URL: (leave empty)
File Path: /storage/games/game-name.zip
```

---

## 🧪 Testing Endpoints

### 1. Add to Cart
```bash
curl -X POST "http://localhost:8000/cart/add/1" \
  -H "Cookie: XSRF-TOKEN=...; laravel_session=..."
```

### 2. View Cart
```bash
curl "http://localhost:8000/cart" \
  -H "Cookie: laravel_session=..."
```

### 3. Checkout
```bash
curl -X POST "http://localhost:8000/checkout/process" \
  -H "Cookie: laravel_session=..." \
  -H "X-CSRF-TOKEN: ..."
```

### 4. Play Game
```bash
curl "http://localhost:8000/play/1" \
  -H "Cookie: laravel_session=..."
```

---

## 🐛 Debugging

### Check Session Cart
```php
php artisan tinker
>>> session()->get('cart')
```

### Check User Games (Owned)
```php
>>> auth()->user()->games
>>> auth()->user()->orders
```

### Check Order Details
```php
>>> $order = Order::find(1);
>>> $order->items;
>>> $order->user;
```

---

## ⚠️ Common Issues

### Issue: Game tidak bisa ditambah ke cart
**Solution:** Pastikan user sudah login & game belum dibeli sebelumnya

### Issue: Checkout gagal dengan "Stock tidak cukup"
**Solution:** Pastikan stock game cukup di database. Admin bisa update stock di edit game

### Issue: Play game menampilkan 403 error
**Solution:** User harus membeli game dulu sebelum bisa play. Pastikan checkout berhasil & order created

### Issue: Iframe tidak load untuk browser games
**Solution:** 
1. Pastikan embed URL benar & accessible
2. Check browser console untuk CORS errors
3. Beberapa game mungkin tidak support iframe (test manual)

---

## 🔐 Security Checklist

- [x] Cart data hanya di session (tidak di URL)
- [x] Ownership check untuk play endpoint
- [x] Stock validation saat checkout
- [x] No double purchase protection
- [x] Transaction rollback on error
- [x] Sandbox attributes pada iframe
- [x] Auth middleware required

---

## 📊 Database Schema Reference

### games
```
id, title, description, developer, platform, stock, price, 
release_date, rating, cover, 
type, embed_url, file_path,  ← NEW FIELDS
created_at, updated_at
```

### orders
```
id, user_id, total_price, status (pending/paid/cancelled), 
created_at, updated_at
```

### order_items
```
id, order_id, game_id, price, quantity, created_at, updated_at
```

### user_games (pivot)
```
id, user_id, game_id, created_at, updated_at
```

---

## 📝 Maintenance

### Regular Tasks
- Monitor order status (should all be 'paid' with dummy payment)
- Check stock levels
- Archive old orders if needed
- Backup database regularly

### Performance Optimization
- Cache game list: `Cache::remember('games', 3600, function() { ... })`
- Optimize queries: Use `with()` for eager loading
- Session cleanup: Laravel handles automatically

---

## 🚀 Deployment Checklist

- [ ] All migrations ran successfully
- [ ] Fillable properties updated in all models
- [ ] Routes registered correctly
- [ ] Controllers have required use statements
- [ ] Views created in correct paths
- [ ] Auth middleware applied
- [ ] CSRF token in forms
- [ ] Error handling tested
- [ ] Transaction logic verified
- [ ] Session config correct (.env: SESSION_DRIVER=cookie or file)

---

## 📚 File Structure

```
app/
├── Models/
│   ├── Game.php ← UPDATED
│   ├── User.php ← UPDATED
│   ├── Order.php ← NEW
│   └── OrderItem.php ← NEW
└── Http/
    └── Controllers/
        ├── GameController.php ← UPDATED
        ├── CartController.php ← NEW
        ├── CheckoutController.php ← NEW
        ├── CheckoutService.php ← NEW
        └── PlayController.php ← NEW

database/
└── migrations/
    ├── 2026_02_08_121819_create_games_table.php ← UPDATED
    ├── 2026_02_15_060000_create_orders_table.php ← NEW
    ├── 2026_02_15_060001_create_order_items_table.php ← NEW
    └── 2026_02_15_060002_create_user_games_table.php ← NEW

resources/
└── views/
    ├── cart.blade.php ← NEW
    ├── checkout.blade.php ← NEW
    ├── play.blade.php ← NEW
    └── user/
        ├── dashboard.blade.php ← UPDATED
        └── show.blade.php ← UPDATED

routes/
└── web.php ← UPDATED
```

---

## 🎓 Code Comments Location

Key explanations are marked with komentar dalam code:

- **GameController.php**:
  - `store()`: Validasi type, embed_url, file_path
  - `update()`: Same validation sebagai store

- **CartController.php**:
  - `add()`: Session management + duplicate check
  - `view()`: Cart calculation

- **CheckoutService.php**:
  - `checkout()`: Atomic transaction dengan semua validasi
  
- **CheckoutController.php**:
  - `process()`: Service integration + cart clearing

- **PlayController.php**:
  - `play()`: Ownership check + type handling

---

## 📞 Support

For detailed implementation guide, see: `/IMPLEMENTATION.md`

Generated: February 15, 2026
