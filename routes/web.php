<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\FormOrder01;
use App\Http\Livewire\FormOrder02;
use App\Http\Livewire\ShoppingCart;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class);

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');

Route::get('product/{product}',[ProductController::class, 'show'])->name('product.show');

Route::get('search', SearchController::class)->name('search');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');

Route::middleware(['auth'])->group(function () {
    Route::get('orders/create', FormOrder01::class)->name('orders.create');
    Route::get('orders/registration', FormOrder02::class)->name('orders.registration');
    Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.resume');
    // Route::get('order/success', [OrderController::class , 'success'])->name('order.success');
    // Route::get('order/index', [OrderController::class , 'index'])->name('order.index');
    // Route::get('order/{order}/show', [OrderController::class , 'show'])->name('order.show');
    // Route::get('order/{order}/pdf', [OrderController::class , 'stream_pdf'])->name('order.pdf');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
