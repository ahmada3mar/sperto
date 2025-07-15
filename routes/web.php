<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// Redirect root to products index
Route::get('/', function () {

    $all = (new ProductController())->loadAllProducts();

   $allProducts = array_slice($all, 0, 20);

   $featuredProducts = array_slice($all, 20, 10);

    // dd($allProducts);

    return view('home' , compact('allProducts' , 'featuredProducts'));
})->name('home');


// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// API endpoint for paginated products
Route::get('/api/products-paginated', [ProductController::class, 'getPaginatedProducts'])->name('api.products.paginated');

// Cart route
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Checkout route
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');



