<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/products',[ProductController::class,'index']);

Route::get('products/search',[ProductController::class,'search']);
Route::get('products/category/{categoryName}',[ProductController::class,'getByCategory']);


Route::middleware(['auth.api','role:admin'])->group(function(){
    Route::post('/categories',[CategoryController::class,'store']);
    Route::post('/products',[ProductController::class,'store']);
});

Route::middleware(['auth.api'])->group(function () {
    Route::post('/checkout', [OrderController::class, 'checkout']);
});
