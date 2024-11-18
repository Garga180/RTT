<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetUsersRole;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/setrole', [SetUsersRole::class, 'ListUsers'])->name('users.setrole');
Route::put('/setrole/role', [SetUsersRole::class, 'UpdateRole'])->name('users.updateRoles');

Route::get('/updatestock', [ProductsController::class, 'OrderItems'])->name('updatestock');
Route::post('/updatestock/add', [ProductsController::class, 'UpdateStock'])->name('place.stock.order');

Route::resource('/products', ProductsController::class);

Route::get('/dashboard', [ProductsController::class, 'Dashboardindex'])->name('dashboard');

Route::get('/cart', [CartController::class, 'ShowCart'])->name('cart');

Route::post('/cart/add/{productId}', [ProductsController::class, 'AddToCart'])->name('cart.add');
Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('placeOrder');
require __DIR__ . '/auth.php';
