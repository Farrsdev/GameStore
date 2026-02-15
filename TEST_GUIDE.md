# Quick Test Guide - Game Store Implementation

## What's Been Implemented ✅

This guide helps you test the complete Game Store system with all new features.

---

## 🚀 Quick Start

### 1. Run Migrations
```bash
php artisan migrate:fresh --seed
```

### 2. Start Server
```bash
php artisan serve
```

### 3. Access the Application
- **User Dashboard:** http://localhost:8000/dashboard
- **Admin Dashboard:** http://localhost:8000/admin/dashboard
- **My Library:** http://localhost:8000/library

---

## 🧪 Testing Checklist

### Admin Game Creation (NEW)

1. Go to `/admin/games/create`
2. Fill in basic details:
   - Title: "Browser Game Test"
   - Description: Any description
   - Developer: Test Developer
   - Platform: Web
   - Stock: 5
   - Price: 50000

3. **NEW:** Select Game Type: **Browser**
   - Notice: "Embed URL" field appears
   - Notice: "File Path" field is hidden

4. Enter Embed URL: `https://example.com/game`

5. Save Game

### Testing Download Game Type

1. Go to `/admin/games/create` again
2. Fill details (different game name)
3. **NEW:** Select Game Type: **Download**
   - Notice: "File Path" field appears
   - Notice: "Embed URL" field is hidden

4. Enter File Path: `/storage/games/game.zip`

5. Save Game

### Testing User Shopping Flow

1. Login as regular user (not admin)
2. Go to `/dashboard` - Browse all games
3. Click on "Browser Game Test"
   - See "Add to Cart" button
4. Click "Add to Cart"
5. Go to `/cart`
   - See the game in cart
   - See total price
   - Can remove item
6. Click "Checkout"
7. Review order details
8. Click "Confirm Purchase"
9. Get success message

### Testing User Library (NEW)

1. After successful purchase, go to `/library`
2. **NEW:** See statistics:
   - "1 Games Owned"
   - "1 Browser Games"
   - "0 Download Games"

3. See game card with:
   - Game cover image
   - Game title
   - Developer
   - Type badge (Browser/Download)
   - Ownership badge

### Testing Play - Browser Game

1. In library, click "Play Now" on browser game
2. See:
   - Game details on sidebar
   - **Iframe embedded** with the embed URL
   - "Back to Library" button

### Testing Play - Download Game

1. After purchasing download game
2. Go to library and click "Download"
3. See:
   - Download button
4. Click download button
5. See **animated progress bar**:
   - Shows 0% → 100%
   - Takes ~3-5 seconds
   - After 100%, triggers file download
   - Progress resets after 2 seconds

### Testing Ownership Validation

1. Try to access play route directly: `/play/1`
2. If you don't own it: Should see 403 error
3. If you own it: Should play the game

### Testing Stock Validation

1. Create a game with stock: 1
2. Admin edits stock to: 0
3. Try to add to cart: Should show error
4. Admin increases stock: Can now add to cart

### Testing Duplicate Purchase Prevention

1. After buying a game, try to add it again
2. Should see error: "Already in cart" or similar
3. Try directly in checkout: Should see "Already owned" error

---

## 📁 File Locations & What They Do

### Admin Forms
- **`resources/views/admin/games/create.blade.php`**
  - Add game with type selector
  - Conditional embed_url/file_path fields
  - JavaScript: toggleGameTypeFields()

- **`resources/views/admin/games/edit.blade.php`**
  - Same as create but edit existing game

### User Shopping
- **`resources/views/cart.blade.php`**
  - Session-based cart display
  - Remove items, view total

- **`resources/views/checkout.blade.php`**
  - Review order before purchase
  - Show all items and total

### User Library (NEW)
- **`resources/views/user/library.blade.php`**
  - Display owned games
  - Show stats (total, browser, download)
  - Play/Download buttons

- **`resources/views/user/dashboard.blade.php`**
  - Browse all games
  - Add cart link and library link

### Game Playing
- **`resources/views/play.blade.php`**
  - Browser games: Iframe display
  - Download games: Progress bar animation

### Controllers
- **`app/Http/Controllers/GameController.php`**
  - `userLibrary()` - Fetch owned games
  - `store()` - Save game with validation
  - `update()` - Update game with validation

- **`app/Http/Controllers/CartController.php`**
  - `add()` - Add game to session cart
  - `remove()` - Remove from session cart
  - `view()` - Display cart page

- **`app/Http/Controllers/CheckoutController.php`**
  - `show()` - Display checkout review
  - `process()` - Process purchase with service

- **`app/Http/Controllers/PlayController.php`**
  - `play()` - Show game player (browser or download)
  - Ownership verification
  - Type handling

- **`app/Http/Controllers/CheckoutService.php`**
  - `checkout()` - Atomic transaction logic
  - Validation, order creation, stock reduction

### Models
- **`app/Models/Game.php`**
  - `users()` - belongsToMany relationship
  - `genres()` - belongsToMany relationship
  - Fillable: type, embed_url, file_path, etc.

- **`app/Models/User.php`**
  - `games()` - belongsToMany relationship
  - `orders()` - hasMany relationship

- **`app/Models/Order.php`**
  - `user()` - belongsTo relationship
  - `items()` - hasMany OrderItems

- **`app/Models/OrderItem.php`**
  - `order()` - belongsTo
  - `game()` - belongsTo

---

## 🔍 Key Features to Verify

### 1. Dynamic Form Fields
- [ ] Admin creates game, selects "Browser"
  - embed_url appears, file_path hidden
- [ ] Admin changes to "Download"
  - file_path appears, embed_url hidden
- [ ] Form validates required fields based on type

### 2. Session Cart
- [ ] Add game → shows in cart
- [ ] Remove game → removed from cart
- [ ] Page refresh → cart persists
- [ ] Checkout → cart clears

### 3. Checkout Transaction
- [ ] Stock validated before purchase
- [ ] Ownership validated (can't buy twice)
- [ ] Order created with correct total
- [ ] OrderItems created for each game
- [ ] user_games pivot record created
- [ ] Stock decremented
- [ ] Cart cleared

### 4. User Library (NEW)
- [ ] Shows only owned games
- [ ] Stats show correct counts
- [ ] Cards display game info
- [ ] Play/Download buttons visible

### 5. Play System
- [ ] Browser games show in iframe
- [ ] Download games show download button
- [ ] Progress bar animates on download
- [ ] Unowned game access denied (403)

---

## 🎯 Important Routes

```
// User Routes (require auth)
GET  /dashboard              - Browse all games
GET  /library                - View owned games (NEW)
GET  /game/{id}              - Game details
POST /cart/add/{game}        - Add to cart
POST /cart/remove/{game}     - Remove from cart
GET  /cart                   - View cart
GET  /checkout               - Checkout page
POST /checkout/process       - Process purchase
GET  /play/{game}            - Play game

// Admin Routes (require auth + admin)
GET  /admin/games            - List games
GET  /admin/games/create     - Create form (with type field)
POST /admin/games            - Save game
GET  /admin/games/{id}/edit  - Edit form (with type field)
PUT  /admin/games/{id}       - Update game
```

---

## 💡 Test Scenarios

### Scenario 1: Complete Purchase Flow
1. Register user
2. Login
3. Browse dashboard
4. Add browser game to cart
5. View cart
6. Checkout
7. See success
8. Go to library
9. See owned game with stats
10. Click Play - see iframe

### Scenario 2: Download Game
1. Admin creates download game with file_path
2. User adds to cart
3. User checks out
4. User goes to library
5. Sees "Download" button
6. Clicks download
7. Sees animated progress bar
8. Progress reaches 100%

### Scenario 3: Ownership Validation
1. User owns game
2. User tries to add same game again
3. System prevents (already owned error)
4. Cart doesn't allow duplicate

### Scenario 4: Stock Validation
1. Admin creates game with stock: 1
2. User adds to cart
3. Another user adds same game to cart
4. Second user tries to checkout
5. System prevents (out of stock error)

---

## 📝 Database Schema Verification

### Run this to verify tables exist:
```bash
php artisan tinker
> Schema::getTables()
```

Should include:
- games (updated)
- orders (new)
- order_items (new)
- user_games (new)
- users

### Verify games table has new columns:
```bash
php artisan tinker
> DB::select("DESCRIBE games")
```

Should show:
- type (enum)
- embed_url (nullable text)
- file_path (nullable string)

---

## ✅ Success Indicators

The implementation is working correctly when:

1. ✅ Form type field shows/hides relevant fields dynamically
2. ✅ Games can be created as browser or download type
3. ✅ Users can add games to session cart
4. ✅ Checkout creates order, order_items, and user_games records
5. ✅ Stock decrements after purchase
6. ✅ User library shows only owned games
7. ✅ Browser games display in iframe
8. ✅ Download button shows progress bar animation
9. ✅ Unowned games return 403 error
10. ✅ Duplicate purchases are prevented

---

## 🆘 Troubleshooting

### Game won't save in admin form
- Check browser console for JavaScript errors
- Verify form validation on server
- Check `GameController@store` method

### Cart not persisting
- Verify session is configured in `config/session.php`
- Check middleware includes session in `app/Http/Middleware`

### Play page shows 403
- Verify user owns the game in `user_games` table
- Check PlayController ownership verification

### Download progress bar not showing
- Verify JavaScript in `play.blade.php`
- Check browser console for errors
- Ensure file_path is set in database

### Checkout fails
- Check order creation logs
- Verify user_games relationship
- Check stock levels before purchase

---

## 📞 Support

For issues with specific features:
1. Check controller method comments
2. Review model relationships
3. Check view file structure
4. Review JavaScript in forms/pages
5. Check database migrations

All code has been commented with clear explanations of functionality!
