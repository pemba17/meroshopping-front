<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('categories',[CategoryApiController::class,'getCategories']);
Route::get('cat_products',[ProductApiController::class,'getProducts']);
Route::get('tags',[TagApiController::class,'getTags']);
Route::get('brands',[BrandsApiController::class,'getBrands']);
Route::get('sliders',[SliderApiController::class,'getSliders']);


