<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
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
// Route::group(['middleware'=>['auth.sanctum']],function(){

// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('user',[AuthController::class,'getUsers']);
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);


Route::post('search',[ProductApiController::class,'search']);
Route::get('cat_products',[ProductApiController::class,'getProducts']);
Route::get('/product/{id}',[ProductApiController::class,'getSingleProduct']);

Route::get('tags',[TagApiController::class,'getTags']);
Route::get('brands',[BrandsApiController::class,'getBrands']);
Route::get('sliders',[SliderApiController::class,'getSliders']);
Route::get('top-selling',[ProductApiController::class,'getTopSoldProducts']);



