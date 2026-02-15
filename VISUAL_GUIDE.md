# 🎮 Game Store Implementation - Visual Guide

## 🏗️ System Architecture

```
┌─────────────────────────────────────────────────────────────────────┐
│                          USER INTERFACE                             │
│  ┌──────────────┐ ┌────────────┐ ┌─────────────┐ ┌──────────────┐ │
│  │  Dashboard   │ │ Game Detail│ │    Cart     │ │ Checkout Pay │ │
│  │ (Browse)     │ │ (Details)  │ │ (Review)    │ │ (Process)    │ │
│  └──────────────┘ └────────────┘ └─────────────┘ └──────────────┘ │
│                                                                      │
│  ┌──────────────────────────┐  ┌──────────────────────────────┐    │
│  │    Play Page (Browser)   │  │ Play Page (Download)         │    │
│  │  ├─ Iframe + embed_url   │  │  ├─ Download button          │    │
│  │  └─ Sandbox security     │  │  └─ file_path                │    │
│  └──────────────────────────┘  └──────────────────────────────┘    │
└────────────────────────────────────────────────────────────────────┬┘
                                                                       │
                            ↓ HTTP/Blade
                                                                       │
┌────────────────────────────────────────────────────────────────────┬┘
│                    ROUTING LAYER (routes/web.php)                   │
│                                                                      │
│  POST  /cart/add/{game}        → CartController@add                │
│  POST  /cart/remove/{game}     → CartController@remove             │
│  GET   /cart                   → CartController@view               │
│  GET   /checkout               → CheckoutController@show           │
│  POST  /checkout/process       → CheckoutController@process        │
│  GET   /play/{game}            → PlayController@play               │
│                                                                      │
│  + Auth Middleware (all routes)                                    │
│  + Ownership Check (play route)                                    │
└────────────────────────────────────────────────────────────────────┬┘
                                                                       │
                            ↓ Controllers
                                                                       │
┌────────────────────────────────────────────────────────────────────┬┘
│                  CONTROLLER LAYER (HTTP Layer)                      │
│                                                                      │
│  CartController                                                     │
│  ├─ add(): Check ownership, add/increment in session              │
│  ├─ remove(): Remove from session                                  │
│  └─ view(): Display cart with totals                              │
│                                                                      │
│  CheckoutController                                                │
│  ├─ show(): Display checkout page with review                     │
│  └─ process(): Call service, handle response                      │
│                                                                      │
│  PlayController                                                     │
│  └─ play(): Check ownership, render based on type                 │
│                                                                      │
│  GameController (Updated)                                          │
│  ├─ store(): Validate type, embed_url, file_path                  │
│  └─ update(): Same validation                                      │
│                                                                      │
└────────────────────────────────────────────────────────────────────┬┘
                                                                       │
                    ↓ Service & Business Logic
                                                                       │
┌────────────────────────────────────────────────────────────────────┬┘
│                   SERVICE LAYER (Business Logic)                    │
│                                                                      │
│  CheckoutService                                                    │
│  └─ checkout(User, array): Atomic Transaction                      │
│     ├─ 1. Validate stock                                          │
│     ├─ 2. Validate ownership (prevent double purchase)            │
│     ├─ 3. DB::transaction() {                                      │
│     │    ├─ Create order                                          │
│     │    ├─ Create order_items                                    │
│     │    ├─ Attach user_games pivot                               │
│     │    └─ Decrement stock                                       │
│     │   }                                                          │
│     └─ Return Order or throw Exception                            │
│                                                                      │
│  SESSION ('cart')                                                   │
│  └─ [                                                              │
│      {game_id: 1, quantity: 1},                                    │
│      {game_id: 3, quantity: 2},                                    │
│      ...                                                           │
│     ]                                                              │
│                                                                      │
└────────────────────────────────────────────────────────────────────┬┘
                                                                       │
                      ↓ Eloquent Models
                                                                       │
┌────────────────────────────────────────────────────────────────────┬┘
│                      MODEL LAYER (Data)                             │
│                                                                      │
│  User                                  Game                         │
│  ├─ hasMany(Order)                    ├─ belongsToMany(User)      │
│  └─ belongsToMany(Game)               └─ hasMany(OrderItem)       │
│       through: user_games                                          │
│                                                                      │
│  Order                                 OrderItem                    │
│  ├─ belongsTo(User)                   ├─ belongsTo(Order)         │
│  └─ hasMany(OrderItem)                └─ belongsTo(Game)          │
│                                                                      │
│  Relationships:                                                      │
│  User 1-∞ Order (user_id)                                          │
│  Order 1-∞ OrderItem (order_id)                                    │
│  User ∞-∞ Game (through user_games)                                │
│  Game 1-∞ OrderItem (game_id)                                      │
│                                                                      │
└────────────────────────────────────────────────────────────────────┬┘
                                                                       │
                    ↓ Database Queries
                                                                       │
┌────────────────────────────────────────────────────────────────────┬┘
│                    DATABASE LAYER (Schema)                          │
│                                                                      │
│  users                    orders                 user_games         │
│  ├─ id                    ├─ id                  ├─ id              │
│  ├─ name                  ├─ user_id ────┐      ├─ user_id ────┐  │
│  ├─ email                 ├─ total_price │      ├─ game_id ────┼─ │
│  └─ password              ├─ status      │      └─ timestamps   │  │
│                           └─ timestamps  │                       │  │
│                                         ↓                       ↓  │
│  games                    order_items                             │
│  ├─ id                    ├─ id                                  │
│  ├─ title                 ├─ order_id                            │
│  ├─ type (enum)           ├─ game_id ───────────────────┐       │
│  ├─ embed_url             ├─ price                       ↓       │
│  ├─ file_path             ├─ quantity                            │
│  ├─ price                 └─ timestamps                          │
│  ├─ stock                                                         │
│  └─ ...                                                          │
│                                                                      │
│  (All tables have timestamps)                                       │
│                                                                      │
└────────────────────────────────────────────────────────────────────┘
```

---

## 🔄 Data Flow Diagrams

### FLOW 1: ADD TO CART
```
User clicks "Add to Cart"
         ↓
POST /cart/add/{game}
         ↓
CartController@add
    ├─ Check: Is auth? ✓
    ├─ Check: Already owned?
    │   └─ YES → Error: "Anda sudah memiliki game ini"
    │   └─ NO → Continue
    ├─ Get session cart: $cart = session('cart', [])
    ├─ Check: Game in cart?
    │   └─ YES → $cart[$key]['quantity']++
    │   └─ NO → $cart[] = {game_id, quantity: 1}
    ├─ session(['cart' => $cart])
    └─ redirect()->back()->with('success')
         ↓
User sees: "Game ditambahkan ke cart!"
```

### FLOW 2: CHECKOUT PROCESS
```
User clicks "Proceed to Checkout"
         ↓
GET /checkout
         ↓
CheckoutController@show
    ├─ Get: $cart = session('cart', [])
    ├─ Check: Cart empty?
    │   └─ YES → Redirect /cart with error
    │   └─ NO → Continue
    ├─ Get game details
    ├─ Calculate total
    └─ view('checkout.show', compact('items', 'totalPrice'))
         ↓
User reviews order and clicks "Complete Purchase"
         ↓
POST /checkout/process
         ↓
CheckoutController@process
    ├─ Get: $cart = session('cart', [])
    ├─ Call: CheckoutService@checkout(auth()->user(), $cart)
    │
    └─ [ATOMIC TRANSACTION START]
         ↓
    CheckoutService@checkout()
         ├─ 1. VALIDATE
         │   ├─ For each item:
         │   │   ├─ Check: Stock >= quantity?
         │   │   │   └─ NO → Exception: "Stock tidak cukup"
         │   │   ├─ Check: User already owns?
         │   │   │   └─ YES → Exception: "Sudah memiliki"
         │   │   └─ Calculate total
         │   │
         │   ├─ 2. CREATE ORDER
         │   │   └─ Order::create(['user_id', 'total_price', 'status'=>'paid'])
         │   │
         │   ├─ 3. CREATE ORDER ITEMS
         │   │   ├─ For each item:
         │   │   │   └─ $order->items()->create(['game_id', 'price', 'qty'])
         │   │   │
         │   │   ├─ 4. ATTACH & REDUCE STOCK
         │   │   │   ├─ For each item:
         │   │   │   │   ├─ $user->games()->attach($game_id)
         │   │   │   │   └─ Game::find($id)->decrement('stock', $qty)
         │   │   │   │
         │   │   └─ 5. RETURN ORDER
         │   │       └─ return $order
         │
    └─ [ATOMIC TRANSACTION END]
         ↓
    Exception caught?
    ├─ YES → Redirect /checkout with error message
    │        (Database unchanged - full rollback)
    │
    └─ NO → Continue
         ├─ session()->forget('cart')
         ├─ return redirect('/dashboard')->with('success', 'Order #' . $order->id)
         ↓
User sees: "Pembelian berhasil! Order #123"
           + Game is now in library
           + Stock reduced
           + Order created in database
```

### FLOW 3: PLAY GAME
```
User clicks "Play Game" (from dashboard or detail)
         ↓
GET /play/{game}
         ↓
[Middleware: auth]
    ├─ Is authenticated?
    │   └─ NO → Redirect /login
    │   └─ YES → Continue
         ↓
PlayController@play(Game $game)
         ├─ Check: User owns this game?
         │   $isOwned = auth()->user()->games()
         │             ->where('game_id', $game->id)
         │             ->exists()
         │
         ├─ NOT OWNED? → abort(403, "Belum membeli")
         │
         └─ OWNED? → Continue
             ├─ Check game type
             │
             ├─ IF type = 'browser'
             │   └─ view('play.blade', [
             │      'game' => $game
             │      ])
             │      ├─ Display: Game cover, info
             │      └─ Display: <iframe src="embed_url" sandbox>
             │
             └─ IF type = 'download'
                 └─ view('play.blade', [
                    'game' => $game
                    ])
                    ├─ Display: Game cover, info
                    └─ Display: <a href="file_path" download>
                                Download Game</a>
         ↓
User plays game!
```

---

## 📊 Database State Changes

### Before Checkout
```
users                orders      order_items      user_games
id=1, name=John     (empty)     (empty)          (empty)

games
id=1, title=Game A, stock=100, price=29.99
id=2, title=Game B, stock=50, price=49.99

Session Cart:
[
  {game_id: 1, quantity: 1},
  {game_id: 2, quantity: 1}
]
```

### After Successful Checkout
```
users
id=1, name=John

orders (NEW)
id=1, user_id=1, total_price=79.98, status='paid'

order_items (NEW)
id=1, order_id=1, game_id=1, price=29.99, quantity=1
id=2, order_id=1, game_id=2, price=49.99, quantity=1

user_games (NEW) - User now owns games
user_id=1, game_id=1
user_id=1, game_id=2

games (UPDATED - Stock reduced)
id=1, title=Game A, stock=99, price=29.99     ← stock: 100 → 99
id=2, title=Game B, stock=49, price=49.99     ← stock: 50 → 49

Session Cart: (CLEARED)
[]
```

---

## 🔐 Security Checkpoints

```
┌─────────────────────────────────────────────────────────┐
│ CART OPERATIONS (Post /cart/add, /cart/remove)         │
├─────────────────────────────────────────────────────────┤
│ ✓ Middleware: auth                                       │
│ ✓ Check: User not already owner                         │
│ ✓ Session-based: Cart data not exposed                  │
│ ✓ CSRF token required                                    │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│ CHECKOUT (Post /checkout/process)                      │
├─────────────────────────────────────────────────────────┤
│ ✓ Middleware: auth                                       │
│ ✓ Validate: Stock sufficient                           │
│ ✓ Validate: User doesn't already own                   │
│ ✓ Atomic: All-or-nothing transaction                   │
│ ✓ Rollback: If any error                               │
│ ✓ CSRF token required                                   │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│ PLAY GAME (Get /play/{game})                           │
├─────────────────────────────────────────────────────────┤
│ ✓ Middleware: auth                                       │
│ ✓ Check: User is owner (via user_games pivot)         │
│ ✓ Abort: 403 if not owner                              │
│ ✓ Iframe: Sandbox attributes for browser games         │
│ ✓ Download: Direct file serving                        │
└─────────────────────────────────────────────────────────┘
```

---

## 📈 File Count Summary

```
NEW FILES:     12
├─ Controllers:    3 (Cart, Checkout, Play)
├─ Models:        2 (Order, OrderItem)
├─ Views:         3 (cart, checkout, play)
├─ Migrations:    3 (orders, order_items, user_games)
├─ Service:       1 (CheckoutService)
└─ Docs:          4 (Implementation, Setup, Reference, Summary)

UPDATED FILES:  7
├─ Controllers:    1 (GameController)
├─ Models:        2 (Game, User)
├─ Views:         2 (dashboard, show)
├─ Migrations:    1 (games)
└─ Routes:        1 (web.php)

DOCUMENTATION: 4 files
├─ IMPLEMENTATION.md
├─ SETUP.md
├─ QUICK_REFERENCE.md
└─ CHANGES_SUMMARY.md

TOTAL: 23 files modified/created
```

---

## 🚀 Deployment Checklist

```
Pre-Deployment:
  □ Backup database
  □ git commit changes
  □ Review all migrations

Deployment:
  □ php artisan migrate
  □ php artisan route:list (verify routes)
  □ php artisan tinker (test models)

Testing:
  □ Login as user
  □ Add game to cart
  □ View cart
  □ Proceed to checkout
  □ Complete checkout
  □ Verify order in database
  □ Play game (browser)
  □ Play game (download)
  □ Test 403 for non-owned game

Post-Deployment:
  □ Monitor error logs
  □ Test payment flow
  □ Verify stock changes
  □ Check session management
```

---

**Implementation Complete** ✅
**Status**: Ready for Migration & Testing
**Date**: February 15, 2026
