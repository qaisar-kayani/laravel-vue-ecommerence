<?php

use App\Http\Controllers\frontend\categoryController;
use App\Http\Controllers\frontend\productController;
use App\Http\Controllers\frontend\api\reviewController;
use App\Http\Controllers\frontend\api\homeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'frontend', "as" => "frontend."], function () {


    Route::group(['prefix'=>"home",'as'=>"home"],function(){
        Route::get('shopByCategory',[homeController::class, 'shopByCategory'])->name('shopByCategory');
    });
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        // Route access by all user
        Route::post('/{id}/product', [categoryController::class, 'productListApi'])->name('productListApi');
        Route::post('/{id}/filter', [categoryController::class, 'categoryFilter'])->name('categoryFilter');
        //Route::get("allCategories", [categoryController::class, 'allCategories'])->name('allCategories');
        Route::post('/{id}/filter', [categoryController::class, 'categoryFilter'])->name('categoryFilter');
        // homepage 
        Route::get('bestSeller/{id}',[categoryController::class,'bestSeller'])->name('bestSeller');
        Route::get('newArrival',[categoryController::class,'newArrival'])->name('newArrival');
        Route::get('mostRating',[categoryController::class,'mostRating'])->name('mostRating');
    });
    //products public routes
    Route::group(['prefix' => "product", 'as' => "product."], function () {
        Route::get('/list/{id}', [productController::class, 'list'])->name('list');
        Route::get('/relatedProduct/{id}', [productController::class, 'relateProduct'])->name('relateProduct');
        // home page
        Route::get('bestSeller',[productController::class,'bestSeller'])->name('bestSeller');
        Route::get('newArrival',[productController::class,'newArrival'])->name('newArrival');
        Route::get('mostRating',[productController::class,'mostRating'])->name('mostRating');
       
        // product reviews

        Route::group(['prefix' => "reviews", 'as' => "reviews."], function () {
            Route::get('/list/{id?}', [reviewController::class, 'list'])->name('list');
            Route::post('add', [reviewController::class, 'add'])->name('add');
            Route::post('edit/{id}', [reviewController::class, 'edit'])->name('edit');
            Route::delete('delete/{id}',[reviewController::class,'delete'])->name('delete');
        });
    });

    Route::group(['prefix' => "attribute", 'as' => "attribute."], function () {

    });

});
