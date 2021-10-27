<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Check;
use App\Http\Livewire\SingleProduct;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Wishlist;
use App\Http\Livewire\Category;
use App\Http\Livewire\OrderInformation;
use App\Http\Livewire\OrderHistory;
use App\Http\Livewire\Login;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',Check::class)->name('/');
Route::get('/product',SingleProduct::class);
Route::get('/cart',Cart::class);
Route::get('/checkout',Checkout::class);
Route::get('/wishlist',Wishlist::class);
Route::get('/category',Category::class);
Route::get('/order-detail',OrderInformation::class);
Route::get('/history',OrderHistory::class);

Route::get('/signin',Login::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
