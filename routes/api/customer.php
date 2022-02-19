<?php

use App\Http\Controllers\customers\customerController;
use App\Http\Controllers\customers\cartController;
use App\Http\Controllers\customers\orderController;
use App\Http\Controllers\customers\biddingController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customer', "as" => "customer."], function () {
    // unauthenticate user login
    Route::post('/login', [customerController::class, 'login'])->name('login');
    Route::post('/signup', [customerController::class, 'signup'])->name('signup');

    //authenticated customer routes here
    Route::group(['prefix' => '', 'middleware' => ['auth:customer,admin', 'scopes:customer,admin']], function () {
        Route::get('/list/{id?}', [customerController::class, 'list'])->name('list');
        Route::post('/add', [customerController::class, 'add'])->name('add');
        Route::post('/edit/{id}', [customerController::class, 'edit'])->name('edit');
        
    });
    Route::group(['prefix' => 'cart', 'as' => 'cart.'], function () {
        Route::get('list/{id?}', [CartController::class, 'cartList'])->name('list');
        Route::post('addTocart', [CartController::class, 'addToCart'])->name('store');
        Route::post('remove', [CartController::class, 'removeCart'])->name('remove');
        Route::post('removeItem', [CartController::class, 'removeCartItem'])->name('removeItem');
        Route::post('updateCart', [CartController::class, 'updateCart'])->name('updateCart');
        Route::post('/{id}/clear', [CartController::class, 'clearAllCart'])->name('clear');
    });
    Route::group(['prefix' => 'order', 'as' => 'order.','middleware' => ['auth:customer', 'scopes:customer']], function () {
        Route::get('list/{id?}', [orderController::class, 'customerOrders'])->name('customerOrders');
        Route::post('create', [orderController::class, 'create'])->name('create');
        Route::post('edit/{id}', [orderController::class, 'edit'])->name('edit');
        // Route::get('customerOrder/{id}', [orderController::class, 'customerOrder'])->name('customerOrder');
    });

    Route::group(['prefix' => 'bidding', 'as' => 'bidding.','middleware' => ['auth:customer', 'scopes:customer']], function () {
     
        Route::get('{id}', [biddingController::class, 'customerBid'])->name('customerBid');
        Route::post('create', [biddingController::class, 'create'])->name('create');
        Route::get('details/{id}', [biddingController::class, 'customerBidDetails'])->name('customerBidDetails');
   
    });


});
