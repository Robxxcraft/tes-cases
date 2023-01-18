<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\VendorController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/login',[AuthController::class, 'login'])->name('login.form');
Route::post('/login',[AuthController::class, 'loginPost'])->name('login');
// Route::get('/register',[AuthController::class, 'register']);
// Route::post('/register',[AuthController::class, 'registerPost']);
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');

//auth
Route::group(['middleware' => 'auth'], function(){
    //vendor,admin,supervisor
    Route::get('/vendor', [VendorController::class, 'index'])->middleware('role:vendor,admin,supervisor')->name('vendor.manage');

    //admin,supervisor
    Route::group(['middleware' => 'role:admin,supervisor'], function(){
        Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
        Route::post('/vendor/create', [VendorController::class, 'createPost'])->name('vendor.createPost');
        Route::get('/user-management', [UserManagementController::class, 'index'])->name('user.manage');
    });

    //supervisor
    Route::group(['middleware' => 'role:supervisor'], function(){
        Route::get('/vendor/download/{id}', [VendorController::class, 'download'])->name('vendor.download');
        Route::get('/user-management/create', [UserManagementController::class, 'create'])->name('user.create');
        Route::post('/user-management/create', [UserManagementController::class, 'createPost'])->name('user.createPost');
        Route::get('/user-management/edit/{id}', [UserManagementController::class, 'edit'])->name('user.edit');
        Route::put('/user-management/update/{id}', [UserManagementController::class, 'update'])->name('user.update');
        Route::get('/user-management/delete/{id}', [UserManagementController::class, 'destroy'])->name('user.delete');
    });
});