# ✅ Developer Checklist - Game Store Implementation

## Pre-Deployment Checklist

### Database & Migrations
- [ ] All 3 new migrations created
- [ ] 1 games migration updated
- [ ] No syntax errors in migrations
- [ ] Foreign keys properly defined
- [ ] Unique constraints added (user_games)
- [ ] Timestamps on all tables

### Models
- [ ] Order model created with correct relations
- [ ] OrderItem model created with correct relations
- [ ] Game model updated with users() relation
- [ ] User model updated with orders() & games() relations
- [ ] All fillable properties updated
- [ ] All casts defined correctly

### Controllers
- [ ] CartController created with 3 methods
- [ ] CheckoutController created with 2 methods
- [ ] PlayController created with 1 method
- [ ] GameController updated with new validations
- [ ] All use statements correct
- [ ] Proper error handling

### Service Classes
- [ ] CheckoutService created
- [ ] Atomic transaction logic correct
- [ ] All validations implemented
- [ ] Exception handling proper

### Views
- [ ] cart.blade.php created
- [ ] checkout.blade.php created
- [ ] play.blade.php created
- [ ] dashboard.blade.php updated (cart link)
- [ ] show.blade.php updated (cart/play buttons)
- [ ] All routes in views use correct names
- [ ] Forms have @csrf tokens

### Routes
- [ ] Cart add route: POST /cart/add/{game}
- [ ] Cart remove route: POST /cart/remove/{game}
- [ ] Cart view route: GET /cart
- [ ] Checkout show route: GET /checkout
- [ ] Checkout process route: POST /checkout/process
- [ ] Play route: GET /play/{game}
- [ ] All routes have auth middleware
- [ ] All routes grouped properly

### Documentation
- [ ] IMPLEMENTATION.md created
- [ ] SETUP.md created
- [ ] QUICK_REFERENCE.md created
- [ ] VISUAL_GUIDE.md created
- [ ] CHANGES_SUMMARY.md created
- [ ] README_IMPLEMENTATION.md created

---

## Migration Execution Checklist

### Before Running Migrations
```
- [ ] Backup current database
- [ ] Verify .env DATABASE_URL is correct
- [ ] Verify MySQL/PostgreSQL service is running
- [ ] Check laravel.log for errors
- [ ] Git commit current state
```

### Run Migrations
```bash
# Check migration status
php artisan migrate:status

# Run migrations
php artisan migrate

# If error, rollback:
php artisan migrate:rollback
```

### Verify Migrations
```
- [ ] Check migrate:status shows all as "Batch 0"
- [ ] Verify games table has new columns:
      - type (enum: browser, download)
      - embed_url (text, nullable)
      - file_path (varchar, nullable)
- [ ] Verify orders table created
- [ ] Verify order_items table created
- [ ] Verify user_games table created with unique constraint
```

---

## Testing Checklist - Manual

### Test 1: Add to Cart
```
Precondition: User logged in, not owning any games

Steps:
1. [ ] Go to /dashboard
2. [ ] Click "Tambah ke Cart" on a game
3. [ ] Should see: "Game ditambahkan ke cart!"
4. [ ] Session should have: session('cart') = [{game_id: X, qty: 1}]

Verify:
- [ ] Game appears in /cart
- [ ] Quantity is 1
- [ ] Price is correct
- [ ] Total is correct
```

### Test 2: Prevent Double Add
```
Precondition: Game already in cart

Steps:
1. [ ] Go to game detail page
2. [ ] Click "Tambah ke Cart" again
3. [ ] Should stay on same page
4. [ ] Session should have: qty: 2 (not 2 items)

Verify:
- [ ] Quantity incremented, not duplicate entry
```

### Test 3: Prevent Already Owned
```
Precondition: User already owns a game

Setup:
- [ ] Manually add entry to user_games table
- [ ] Or complete a purchase first

Steps:
1. [ ] Try to add already-owned game to cart
2. [ ] Should see error: "Anda sudah memiliki game ini!"

Verify:
- [ ] Game not added to cart
- [ ] Error message shown
```

### Test 4: Remove from Cart
```
Precondition: Game in cart

Steps:
1. [ ] Go to /cart
2. [ ] Click "Remove" button on a game
3. [ ] Should redirect to /cart with success message

Verify:
- [ ] Game removed from cart
- [ ] Total price updated
- [ ] Session updated
```

### Test 5: Cart Persistence
```
Precondition: Game in cart

Steps:
1. [ ] Add game to cart
2. [ ] Go to /dashboard
3. [ ] Go to different game detail page
4. [ ] Go back to /cart

Verify:
- [ ] Game still in cart
- [ ] Quantity preserved
```

### Test 6: Checkout Process
```
Precondition: Game in cart, stock > 1

Steps:
1. [ ] Go to /cart
2. [ ] Click "Proceed to Checkout"
3. [ ] Should see order review on GET /checkout
4. [ ] Click "Complete Purchase"
5. [ ] Should process POST /checkout/process

Verify:
- [ ] Order created in database
- [ ] order_items created with correct details
- [ ] user_games entry created (pivot)
- [ ] Game stock decremented
- [ ] Session cart cleared
- [ ] Redirect to /dashboard with success
```

### Test 7: Prevent Overselling
```
Precondition: Game stock = 1, add 2 to cart

Steps:
1. [ ] Manually set game stock to 1
2. [ ] Add game to cart 2x (quantity: 2)
3. [ ] Go to checkout
4. [ ] Click "Complete Purchase"

Verify:
- [ ] Error: "Stock tidak cukup"
- [ ] No order created
- [ ] No user_games entry
- [ ] Stock unchanged
- [ ] Cart preserved
```

### Test 8: Play Browser Game
```
Precondition: User owns browser-type game

Steps:
1. [ ] Go to /dashboard
2. [ ] Click "Play Game" on owned game
3. [ ] Should go to GET /play/{game}

Verify:
- [ ] Can see game info
- [ ] Iframe is loaded with embed_url
- [ ] Sandbox attributes present
- [ ] Can see "Back to Library" button
```

### Test 9: Play Download Game
```
Precondition: User owns download-type game

Steps:
1. [ ] Go to /dashboard
2. [ ] Click "Play Game" on owned game
3. [ ] Should go to GET /play/{game}

Verify:
- [ ] Can see game info
- [ ] Download button visible with file_path
- [ ] Can click to download
- [ ] Can see "Back to Library" button
```

### Test 10: Play Without Ownership
```
Precondition: User NOT owning a game

Steps:
1. [ ] Try to access GET /play/{game_id} directly
2. [ ] User doesn't own this game

Verify:
- [ ] Should see 403 error: "Anda belum membeli game ini"
- [ ] Redirected to error page
```

### Test 11: Play Without Auth
```
Precondition: User NOT logged in

Steps:
1. [ ] Go to GET /play/1
2. [ ] No authentication

Verify:
- [ ] Should redirect to /login
```

### Test 12: Database State After Checkout
```
Precondition: Successful checkout of 2 games

Check Database:
- [ ] orders table has 1 new row
- [ ] order_items table has 2 new rows
- [ ] user_games table has 2 new rows
- [ ] games table stock decremented correctly
- [ ] No NULL values in critical fields
```

---

## API/Route Testing Checklist

### Test via Route List
```bash
php artisan route:list | grep -E "(cart|checkout|play)"
```

Verify these routes exist:
```
- [ ] POST /cart/add/{game}
- [ ] POST /cart/remove/{game}
- [ ] GET /cart
- [ ] GET /checkout
- [ ] POST /checkout/process
- [ ] GET /play/{game}
```

### Test Route Parameters
```bash
# Check route parameter binding
php artisan route:list

# All {game} parameters should resolve to Game model
```

---

## Code Quality Checklist

### Controllers
- [ ] No syntax errors (run php artisan)
- [ ] Proper try-catch for exceptions
- [ ] Redirect with correct route names
- [ ] Views render with correct variables
- [ ] Use statements complete

### Models
- [ ] No syntax errors
- [ ] Relationships define correctly
- [ ] Fillable contains all needed fields
- [ ] Casts handle types correctly

### Service
- [ ] Atomic transaction wraps all operations
- [ ] Validations happen before transaction
- [ ] Clear exception messages
- [ ] Returns expected objects

### Views
- [ ] All variables passed from controller
- [ ] Loop variables accessible in blade
- [ ] Form routes use correct route names
- [ ] CSRF tokens on POST forms
- [ ] Links use route() helpers

---

## Security Audit Checklist

- [ ] Cart operations require auth middleware
- [ ] Checkout operations require auth middleware
- [ ] Play route requires auth middleware
- [ ] Play route checks ownership
- [ ] CSRF tokens on all POST forms
- [ ] Form submission validates input
- [ ] No sensitive data in session keys
- [ ] No SQL injection possible (using ORM)
- [ ] Iframe has sandbox attributes
- [ ] Error messages don't expose system info

---

## Performance Checklist

- [ ] Eager loading in checkout (.with())
- [ ] No N+1 queries in cart view
- [ ] Session operations fast (no DB)
- [ ] Transaction times acceptable
- [ ] No blocking operations

---

## Common Issues & Resolutions

| Issue | Check | Fix |
|-------|-------|-----|
| Migration fails | SQL syntax | Review migration file |
| Model not found | use statement | Add: use App\Models\Model |
| Route not working | Route registered | php artisan route:list |
| View not rendering | View path | Check resources/views path |
| Session empty | SESSION_DRIVER | Check .env file |
| 403 Forbidden | Ownership check | Verify user_games entry |
| Stock error | Stock validation | Check games.stock in DB |

---

## Deployment Steps

### 1. Code Preparation
```bash
- [ ] Commit all changes
- [ ] Review files in git diff
- [ ] Check for console.log() or dd()
```

### 2. Database Backup
```bash
- [ ] Backup production database
- [ ] Note current schema version
```

### 3. Run Migrations
```bash
php artisan migrate
- [ ] Monitor for errors
- [ ] Verify schema updated
```

### 4. Verify Functionality
```bash
- [ ] Login works
- [ ] Dashboard loads
- [ ] Cart functions
- [ ] Checkout processes
- [ ] Play works
```

### 5. Monitor
```bash
- [ ] Check error logs
- [ ] Monitor database
- [ ] User feedback
```

---

## Documentation Verification

- [ ] IMPLEMENTATION.md covers all components
- [ ] SETUP.md has step-by-step instructions
- [ ] QUICK_REFERENCE.md has useful snippets
- [ ] VISUAL_GUIDE.md has diagrams
- [ ] Code has comments on complex logic
- [ ] All file paths are correct

---

## Final Sign-Off

```
Implementation Status: ✅ COMPLETE

Pre-flight checks:
- [ ] All files created
- [ ] All files updated
- [ ] No syntax errors
- [ ] Database schema correct
- [ ] Routes configured
- [ ] Views rendered
- [ ] Security in place
- [ ] Documentation complete

Ready for migration: [ ] YES / [ ] NO

Approved by: _________________
Date: _________________
```

---

**Implementation Date**: February 15, 2026
**Status**: Ready for Testing & Deployment
**Framework**: Laravel 12
**PHP**: 8.2+
