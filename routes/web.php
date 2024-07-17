<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class,'getIndex'])->name('product.index');

Route::get('/add-to-cart/{id}',[ProductController::class,'getAddToCart'])->name('product.addToCart');

Route::get('/reduce/{id}',[ProductController::class,'getReduceByOne'])->name('product.reduceByOne');
Route::get('/remove/{id}',[ProductController::class,'getRemoveItem'])->name('product.remove');

Route::get('/shopping-cart',[ProductController::class,'getCart'])->name('product.shoppingCart');

Route::get('/checkout',[ProductController::class,'getCheckout'])->name('checkout')->middleware('auth');
Route::post('/checkout',[ProductController::class,'postCheckout'])->name('checkout')->middleware('auth');

Route::group(['prefix'=>'user'],function(){
    Route::group(['middleware'=>'guest'],function(){
        Route::get('/signup',[UserController::class,'getSignup'])->name('user.signup');
        Route::post('/signup',[UserController::class,'postSignup'])->name('user.signup');
    
        Route::get('/signin',[UserController::class,'getSignin'])->name('user.signin');
        Route::post('/signin',[UserController::class,'postSignin'])->name('user.signin');
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('/profile',[UserController::class,'getProfile'])->name('user.profile');
        Route::get('/logout',[UserController::class,'getLogout'])->name('user.logout');
    });
});