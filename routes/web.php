<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserControllers\ClientController;



// Client route (public homepage)
Route::get('/', [ClientController::class, 'viewClient'])->name('clientView');
//missinge get for produt in the client page

############################################ Cart Routes ############################################

// Cart operations (require authentication for add/checkout, public for get)
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
Route::delete('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin route (protected)
    Route::get('/admin', [AdminController::class, 'viewAdmin'])->name('adminView');

    ############################################ Product Routes ############################################

    Route::get('products/create', [ProductController::class, 'viewProduct'])->name('product.create');
    Route::post('products/create', [ProductController::class, 'storeProduct'])->name('product.store');
    Route::get('products/listProducts', [ProductController::class, 'listProducts'])->name('product.list');
    Route::get('products/{id}/editProduct', [ProductController::class, 'editProduct'])->name('product.edit');
    Route::put('products/{id}/updateProduct', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::delete('products/{id}/deleteProduct', [ProductController::class, 'deleteProduct'])->name('product.delete');

    ############################################ Category Routes ############################################

    Route::get('category/create', [CategoryController::class, 'viewCategory'])->name('category.create');
    Route::post('category/create', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::get('category/listCategories', [CategoryController::class, 'listCategories'])->name('category.list');
    Route::get('category/{id}/editCategory', [CategoryController::class, 'editCategory'])->name('category.edit');
    Route::put('category/{id}/updateCategory', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::delete('category/{id}/deleteCategory', [CategoryController::class, 'deleteCategory'])->name('category.delete');

    ############################################ Order Routes ############################################

    // Order routes
    Route::get('order/listOrders', [OrderController::class, 'index'])->name('order.list');
    Route::get('order/create', [OrderController::class, 'viewOrder'])->name('order.create');
    Route::post('order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('order/{order}/edit', [OrderController::class, 'editOrder'])->name('order.edit');
    Route::put('order/{order}/update', [OrderController::class, 'updateOrder'])->name('order.update');
    Route::delete('order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
});


// Dashboard (default Breeze route)
Route::get('/dashboard', function () {
    return view('clientViews.client');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
