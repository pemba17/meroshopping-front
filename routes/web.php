<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;
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
use App\Http\Controllers\EsewaController;
use App\Http\Livewire\SearchProduct;
use App\Http\Livewire\TrackOrder;
use App\Http\Livewire\TagProduct;
use App\Http\Livewire\About;
use App\Http\Livewire\Contact;
use App\Http\Livewire\FAQ;
use App\Http\Livewire\Warranty;
use App\Http\Livewire\BrandProduct;
use App\Http\Livewire\Corporate;
use App\Http\Livewire\Ticket;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
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


Route::get('/',Home::class)->name('/');

Route::get('/cart',Cart::class)->name('cart');
Route::any('/checkout',Checkout::class);
Route::get('/wishlist',Wishlist::class)->middleware('auth');
Route::any('/category/{slug?}',Category::class);
Route::get('/order-received/{id?}',OrderInformation::class);
Route::get('/order-history',OrderHistory::class)->middleware('auth');
Route::get('/profile',UpdateProfile::class)->middleware(['auth']);

Auth::routes(['verify'=>true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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

// Route::get('/product/{slug}',[SingleProductController::class,'index']);

Route::post('/add-to-cart/{type}',[SingleProductController::class,'store']);

Route::get('/payment',[PaymentController::class,'index']);  

Route::post('/orders',[OrderController::class,'save']);

Route::any('esewa/success',[EsewaController::class,'success'])->name('esewa.success');
Route::any('esewa/fail',[EsewaController::class,'fail'])->name('esewa.fail');

Route::get('payment/fail',[PaymentController::class,'fail'])->name('payment.fail');

Route::get('add-to-wishlist/{id}',[SingleProductController::class,'addToWishList'])->name('add.wishlist');

Route::get('/search/{name}',SearchProduct::class);

Route::get('track',TrackOrder::class);

// related products to add cart
Route::get('add-cart/{id}',[SingleProductController::class,'addToCart'])->name('add.cart');

Route::get('tag/{slug}',TagProduct::class);

Route::post('add-review',[SingleProductController::class,'addReview']);

Route::get('about',About::class)->name('about');
Route::get('contact',Contact::class);
Route::get('faq',FAQ::class);
Route::get('warranty',Warranty::class);

Route::get('brand/{slug}',BrandProduct::class);
Route::get('corporate',Corporate::class);

// product questions
Route::post('question',[SingleProductController::class,'postQuestion']);
Route::get('/ticket',Ticket::class)->middleware('auth');


Route::get('/mail',function(){
    Mail::to('pemba.nuru59@gmail.com')->send(new TestMail());
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::post('/khalti',[OrderController::class,'khalti']);

Route::get('product/{slug}',function($slug){
    return redirect($slug);
});

Route::get('{slug}',[SingleProductController::class,'index']);


