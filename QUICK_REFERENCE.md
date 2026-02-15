# 🎮 Quick Reference - Game Store Implementation

## 📌 Critical Code Snippets

### 1. Cart Session Format
```php
// How cart is stored in session
session(['cart' => [
    ['game_id' => 1, 'quantity' => 1],
    ['game_id' => 3, 'quantity' => 2],
]]);

// Get cart
$cart = session()->get('cart', []);

// Clear cart
session()->forget('cart');
```

### 2. Atomic Checkout Transaction
```php
// In CheckoutService::checkout()
return DB::transaction(function () use ($user, $cartItems) {
    // 1. Validate
    // 2. Create order
    $order = Order::create([...]);
    
    // 3. Create items
    foreach ($orderItems as $item) {
        $order->items()->create($item);
    }
    
    // 4. Attach & reduce stock
    foreach ($cartItems as $item) {
        $user->games()->attach($item['game_id']);
        Game::find($item['game_id'])->decrement('stock', $item['quantity']);
    }
    
    return $order;
    // If any error above → entire transaction rollback
});
```

### 3. Ownership Check
```php
// In PlayController::play()
$isOwned = auth()->user()->games()
    ->where('game_id', $game->id)
    ->exists();

if (!$isOwned) {
    abort(403, 'You don\'t own this game');
}
```

### 4. Game Type Logic
```php
// In play.blade.php
@if($game->type === 'browser')
    <!-- Render iframe -->
    <iframe src="{{ $game->embed_url }}" sandbox="allow-scripts"></iframe>
@elseif($game->type === 'download')
    <!-- Render download button -->
    <a href="{{ $game->file_path }}" download>Download</a>
@endif
```

### 5. Model Relationships
```php
// User
$user->games();           // belongsToMany through user_games
$user->orders();          // hasMany

// Game
$game->users();           // belongsToMany through user_games

// Order
$order->items();          // hasMany order_items
$order->user;            // belongsTo user

// OrderItem
$orderItem->game;        // belongsTo game
$orderItem->order;       // belongsTo order
```

---

## 🔄 Flow Diagrams

### Cart Flow
```
User Page
    ↓
POST /cart/add/{game}
    ↓
CartController@add
    ↓
Check ownership (owned? abort)
Check cart duplicate (exists? increment qty : add new)
session(['cart' => [...]])
    ↓
Redirect back with success
```

### Checkout Flow
```
GET /cart
    ↓
POST /checkout/process
    ↓
CheckoutController@process
    ↓
CheckoutService@checkout (DB::transaction)
    ├─ Validate stock
    ├─ Validate ownership
    ├─ Create Order
    ├─ Create OrderItems
    ├─ Attach user_games
    └─ Decrement stock
    ↓
session()->forget('cart')
    ↓
Redirect /dashboard with success
```

### Play Flow
```
User Library (dashboard)
    ↓
Click "Play Game"
    ↓
GET /play/{game}
    ↓
PlayController@play
    ├─ Check auth (middleware)
    └─ Check ownership (abort 403)
    ↓
Game type?
├─ browser → Render iframe (embed_url)
└─ download → Render download button (file_path)
```

---

## 🗂️ File Organization

### Controllers (Business Logic)
```
Controllers/
├─ CartController.php
│  ├─ add($request, Game $game)      // Add to session
│  ├─ remove($request, Game $game)   // Remove from session
│  └─ view()                         // Display cart
├─ CheckoutController.php
│  ├─ show($request)                 // Show checkout form
│  └─ process($request)              // Call service, clear cart
├─ CheckoutService.php
│  └─ checkout(User, array)          // Atomic transaction
└─ PlayController.php
   └─ play(Game)                     // Check + serve game
```

### Models (Data Layer)
```
Models/
├─ Game.php              [UPDATED]
│  └─ users()            // belongsToMany
├─ User.php              [UPDATED]
│  ├─ orders()          // hasMany
│  └─ games()           // belongsToMany
├─ Order.php             [NEW]
│  ├─ user()            // belongsTo
│  └─ items()           // hasMany
└─ OrderItem.php         [NEW]
   ├─ order()           // belongsTo
   └─ game()            // belongsTo
```

### Views (UI)
```
views/
├─ cart.blade.php       [NEW] - Cart listing
├─ checkout.blade.php   [NEW] - Order review
├─ play.blade.php       [NEW] - Game player
└─ user/
   ├─ dashboard.blade.php [UPDATED] - Game list + cart link
   └─ show.blade.php     [UPDATED] - Game detail
```

### Migrations (DB Schema)
```
migrations/
├─ create_games_table.php            [UPDATED]
│  └─ type, embed_url, file_path
├─ create_orders_table.php           [NEW]
│  └─ user_id, total_price, status
├─ create_order_items_table.php      [NEW]
│  └─ order_id, game_id, price, qty
└─ create_user_games_table.php       [NEW]
   └─ user_id, game_id (unique)
```

---

## 🔑 Key Validation Rules

### Game Type Validation
```php
// In GameController@store() & update()
'type' => 'required|in:browser,download',
'embed_url' => 'required_if:type,browser|nullable|url',
'file_path' => 'required_if:type,download|nullable|string',
```

### Checkout Validation
```php
// In CheckoutService@checkout()
- Stock sufficient: $game->stock >= $item['quantity']
- No double purchase: !$user->games()->where('game_id', $id)->exists()
```

---

## 💾 Session Management

### Setting Cart
```php
$cart = [['game_id' => 1, 'quantity' => 1]];
session()->put('cart', $cart);
```

### Getting Cart
```php
$cart = session()->get('cart', []); // Default empty array
```

### Clearing Cart
```php
session()->forget('cart');
// Or after checkout:
session(['cart' => []]);
```

### Session Config
Check `.env` file:
```
SESSION_DRIVER=cookie      // or file, database
SESSION_LIFETIME=120       // minutes
```

---

## 🛣️ Routes Reference

### User Routes (Auth Required)
```
POST   /cart/add/{game}           CartController@add
POST   /cart/remove/{game}        CartController@remove
GET    /cart                      CartController@view
GET    /checkout                  CheckoutController@show
POST   /checkout/process          CheckoutController@process
GET    /play/{game}               PlayController@play
```

### Admin Routes (Auth + Admin Required)
```
GET    /admin/games               GameController@index
POST   /admin/games               GameController@store
GET    /admin/games/create        GameController@create
GET    /admin/games/{id}/edit     GameController@edit
PUT    /admin/games/{id}          GameController@update
DELETE /admin/games/{id}          GameController@destroy
```

---

## 🧪 Database Queries

### Check if user owns game
```php
$user->games()->where('game_id', $gameId)->exists();
```

### Get user's orders
```php
$user->orders()->with('items.game')->get();
```

### Get order details
```php
$order->items()->with('game')->get();
```

### Get games with stock
```php
Game::where('stock', '>', 0)->get();
```

---

## 📋 Blade Template Helpers

### Check Ownership
```blade
@php
    $isOwned = auth()->user()->games()
        ->where('game_id', $game->id)
        ->exists();
@endphp

@if($isOwned)
    <a href="{{ route('play.game', $game) }}">Play</a>
@else
    <form action="{{ route('cart.add', $game) }}" method="POST">
        @csrf
        <button>Add to Cart</button>
    </form>
@endif
```

### Cart Loop
```blade
@foreach($cartItems as $item)
    <div>
        <h3>{{ $item['game']->title }}</h3>
        <p>Price: ${{ $item['game']->price }}</p>
        <p>Qty: {{ $item['quantity'] }}</p>
        <p>Total: ${{ $item['itemTotal'] }}</p>
    </div>
@endforeach
```

### Order Loop
```blade
@foreach($user->orders as $order)
    <h4>Order #{{ $order->id }}</h4>
    <p>Total: ${{ $order->total_price }}</p>
    <p>Status: {{ $order->status }}</p>
    
    @foreach($order->items as $item)
        <p>{{ $item->game->title }} - ${{ $item->price }}</p>
    @endforeach
@endforeach
```

---

## 🐛 Common Debugging Commands

```php
// Tinker
php artisan tinker

// Check cart
>>> session()->get('cart')

// Check user games
>>> auth()->user()->games

// Check orders
>>> auth()->user()->orders

// Check specific order
>>> $order = Order::find(1);
>>> $order->items;
>>> $order->user;

// Check game
>>> $game = Game::find(1);
>>> $game->users;
>>> $game->stock;

// Clear session
>>> session()->forget('cart')
```

---

## ⚠️ Error Handling

### Common Errors

**"Cart kosong" on checkout:**
```php
// Check if empty
if (empty(session()->get('cart', []))) {
    // Handle error
}
```

**"Stock tidak cukup":**
```php
if ($game->stock < $item['quantity']) {
    throw new Exception("Stock tidak cukup untuk {$game->title}");
}
```

**"Anda sudah memiliki game ini":**
```php
$alreadyOwned = $user->games()->where('game_id', $id)->exists();
if ($alreadyOwned) {
    throw new Exception("Anda sudah memiliki game ini");
}
```

**"403 Forbidden" on play:**
```php
// User doesn't own game
if (!$isOwned) {
    abort(403, 'Anda belum membeli game ini');
}
```

---

## ✅ Implementation Checklist

- [x] Migrations created
- [x] Models with relationships
- [x] CartController with session
- [x] CheckoutController & Service
- [x] PlayController with auth
- [x] Blade templates
- [x] Routes registered
- [x] Validation rules
- [x] Error handling
- [x] Atomic transactions
- [x] Security checks
- [x] Documentation

**Status: READY FOR DEPLOYMENT**

---

Generated: February 15, 2026
