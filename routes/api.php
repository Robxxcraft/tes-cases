<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->get('/user', function () {
    return new UserResource(auth()->user());
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/admin/dashboard', [ChartController::class, 'dashboard']);
Route::get('/admin/chart', [ChartController::class, 'chart']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'create']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    Route::get('/admin/products', [ProductController::class, 'admin']);
    Route::post('/products', [ProductController::class, 'create']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/cart', [CartController::class,'index']);
    Route::post('/cart', [CartController::class,'store']);
    Route::delete('/cart/{productId}', [CartController::class,'destroy']);
    Route::post('/cart/update/{id}', [CartController::class,'updateQty']);
    Route::post('/cart/incr/{id}', [CartController::class,'incrementQty']);
    Route::post('/cart/dcr/{id}', [CartController::class,'decrementQty']);
    Route::delete('/cart-clear', [CartController::class,'cartClear']);

    Route::get('/favorited', [FavoriteController::class, 'index']);
    Route::post('/favorited/{id}', [FavoriteController::class, 'add']);
    Route::delete('/favorited/{id}', [FavoriteController::class, 'remove']);

    Route::get('/user/orders', [OrderController::class, 'userOrders']);
    Route::get('/admin/orders', [OrderController::class, 'admin']);
    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
});

Route::get('/orders', [OrderController::class, 'adminOrders']);
Route::get('/all/categories', [CategoryController::class, 'all']);
Route::get('/home/categories', [CategoryController::class, 'home']);
Route::get('/home/products', [ProductController::class, 'home']);
Route::get('/details/products/{slug}', [ProductController::class, 'details']);