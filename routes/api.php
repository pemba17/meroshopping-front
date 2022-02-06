<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ProfileApiController;
use App\Http\Controllers\SliderApiController;
use App\Http\Controllers\TagApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('user',[AuthController::class,'getUsers']);
    // profile
    Route::get('profile',[ProfileApiController::class,'getProfile']);
    Route::get('edit-profile',[ProfileApiController::class,'editProfile']);
    Route::put('update-profile',[ProfileApiController::class,'updateProfile']);


    Route::get('wishlists',[ProductApiController::class,'getWhilstProducts']);
    Route::post('addtoWishLists',[ProductApiController::class,'addToWishList']);
    Route::delete('removeWishLists',[ProductApiController::class,'removeWishList']);


    Route::post('add-to-cart',[ProductApiController::class,'addToCart']);
    Route::get('view-cart',[ProductApiController::class,'getItemsFromAddToCart']);
    Route::put('update-cart',[ProductApiController::class,'updateCart']);
    Route::delete('delete-cart',[ProductApiController::class,'removeCart']);

    // checkout
    Route::post('checkout',[ProductApiController::class,'checkOut']);
    Route::get('view-checkout',[ProductApiController::class,'viewCheckOut']);
    Route::post('payment-type',[ProductApiController::class,'paymentType']);

    Route::get('get-city',[ProductApiController::class,'getCity']);
    Route::get('get-area',[ProductApiController::class,'getArea']);

    Route::get('order-history',[ProductApiController::class,'orderHistory']);
    Route::post('esewa',[ProductApiController::class,'sendEsewUrl']);


});


Route::post('register',[AuthController::class,'register']);
Route::post('auth-login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);
Route::post('forgotPassword',[AuthController::class,'forgotPassword']);
Route::post('ResetPassword',[AuthController::class,'resetPassword']);


Route::get('search',[ProductApiController::class,'search']);
Route::get('products/brands/{id}',[CategoryApiController::class,'getBrandProducts']);
Route::get('products/tags/{id}',[CategoryApiController::class,'getTagsProduct']);

Route::get('product/{slug}',[ProductApiController::class,'getSingleProduct']);


Route::get('tags',[TagApiController::class,'getTags']);
Route::get('brands',[BrandsApiController::class,'getBrands']);
Route::get('sliders',[SliderApiController::class,'getSliders']);
Route::get('top-selling',[ProductApiController::class,'getTopSoldProducts']);

Route::get('fet_categories',[CategoryApiController::class,'getFetCategories']);
Route::get('categories',[CategoryApiController::class,'getCategories']);
Route::get('subcategories/{categoryId}',[CategoryApiController::class,'getSubCategories']);
Route::get('subcategory/{categoryId}',[CategoryApiController::class,'getSubCategory']);
Route::get('subcategoryProducts/{subcategoryId}',[CategoryApiController::class,'getSubCategoryProducts']);
Route::get('subsubcategoryProducts/{subcategoryId}',[CategoryApiController::class,'getSubSubCategoryProducts']);
// Route::get('subcategory/{categoryParentId}/{subCategoryParentId}',[CategoryApiController::class,'getSingleSubCategoryProducts']);

Route::get('category/{categoryId}',[CategoryApiController::class,'getCategoryProducts']);
