<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Check;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\Wishlist;
use App\Http\Livewire\Category;
use App\Http\Livewire\OrderInformation;
use App\Http\Livewire\OrderHistory;
use App\Http\Livewire\Login;
use App\Http\Livewire\UpdateProfile;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\SingleProductController;
use App\Http\Controllers\PaymentController; 
use App\Http\Controllers\OrderController;
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
Route::get('/cart',Cart::class)->name('cart');
Route::post('/checkout',Checkout::class);
Route::get('/wishlist',Wishlist::class);
Route::get('/category',Category::class);
Route::get('/order-detail',OrderInformation::class);
Route::get('/history',OrderHistory::class);
Route::get('/profile',UpdateProfile::class)->middleware(['auth']);

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('auth/{service}', [SocialController::class, 'redirectToProvider']);
Route::get('auth/{service}/callback', [SocialController::class, 'handleProviderCallback']);

Route::get('email',function(){
    return view('auth.passwords.reset');
});

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    echo '<h1>All Clear</h1>';
});

Route::get('/export-clients',[App\Http\Controllers\FileController::class,'export']);
Route::get('/upload',function(){
    return view('file');
});
Route::post('/import-clients',[App\Http\Controllers\FileController::class,'import']);

Route::get('/product/{slug}',[SingleProductController::class,'index']);
Route::post('/add-to-cart',[SingleProductController::class,'store']);

Route::get('/payment',[PaymentController::class,'index']);  

Route::post('/orders',[OrderController::class,'save']);

Route::get('/success',function(){
    return view('sucess');
});