<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PlayController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [GameController::class, 'userIndex'])->name('user.dashboard');
    Route::get('/library', [GameController::class, 'userLibrary'])->name('user.library');
    Route::get('/game/{id}', [GameController::class, 'userShow'])->name('user.game.show');

    // Cart Routes
    Route::post('/cart/add/{game}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{game}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Play Game Route
    Route::get('/play/{game}', [PlayController::class, 'play'])->name('play.game');

});

Route::middleware(['auth', 'admin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin/dashboard', [GameController::class, 'adminDashboard'])->name('admin.dashboard');

    // Genre CRUD Routes
    Route::resource('admin/genres', GenreController::class, ['as' => 'admin'])->names([
        'index' => 'admin.genres.index',
        'create' => 'admin.genres.create',
        'store' => 'admin.genres.store',
        'edit' => 'admin.genres.edit',
        'update' => 'admin.genres.update',
        'destroy' => 'admin.genres.destroy',
    ]);

    // Game CRUD Routes
    Route::get('/admin/games', [GameController::class, 'index'])->name('admin.games.index');
    Route::get('/admin/games/create', [GameController::class, 'create'])->name('admin.games.create');
    Route::post('/admin/games', [GameController::class, 'store'])->name('admin.games.store');
    Route::get('/admin/games/{id}', [GameController::class, 'show'])->name('admin.games.show');
    Route::get('/admin/games/{id}/edit', [GameController::class, 'edit'])->name('admin.games.edit');
    Route::put('/admin/games/{id}', [GameController::class, 'update'])->name('admin.games.update');
    Route::delete('/admin/games/{id}', [GameController::class, 'destroy'])->name('admin.games.destroy');

});
