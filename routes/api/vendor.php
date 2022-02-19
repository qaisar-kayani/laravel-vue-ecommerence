<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vendors\vendorController;
use App\Http\Controllers\catalog\categoryController;
use App\Http\Controllers\customers\biddingController;
use App\Http\Controllers\customers\orderController;


Route::group( ['prefix' => 'vendor',"as"=>"vendor."/*,"middleware"=>"localization"*/],function(){
  
    // unauthenticate user login
    Route::post('login',[vendorController::class,'login'])->name('login');
    Route::post('signup',[vendorController::class,'signup'])->name('signup');
    //authenticated vendor routes here 
   Route::group( ['prefix' => '','middleware' => ['auth:vendor','scopes:vendor'] ],function(){
        Route::get('/list/{id?}',[vendorController::class,'list'])->name('list');
        Route::post('add',[vendorController::class,'add'])->name('add');
        Route::post('edit/{id}',[vendorController::class,'edit'])->name('edit');
        Route::post('profile/edit/{id}',[vendorController::class,'editProfile'])->name('editprofile');
        Route::get('profile/{id}',[vendorController::class,'profile'])->name('profile');
    });
   // vendor-category
    Route::group(['prefix'=>"category","as"=>"category."],function(){
        Route::get('list',[categoryController::class,'vendorCategory'])->name('vendorCategory');
    });

    Route::group(['prefix'=>"bidding","as"=>"bidding."],function(){
        Route::get('list/{id}',[biddingController::class,'vendorBidding'])->name('vendorBidding');
        Route::post('bidResponse/{id}',[biddingController::class,'bidResponse'])->name('bidResponse');
        
    });

    // 
    Route::group(['prefix'=>"order","as"=>"order."],function(){
        Route::get('list/{id?}',[orderController::class,'vendorOrder'])->name('vendorOrder');
    });
  
  
});   




?>