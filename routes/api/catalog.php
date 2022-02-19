<?php

use App\Http\Controllers\catalog\categoryController;
use App\Http\Controllers\catalog\productController;
use App\Http\Controllers\catalog\groupController;
use App\Http\Controllers\catalog\attributeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'catalog', "as" => "catalog."], function () {

    // route accesss by admin and vendor only
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::group(['middleware' => ['auth:vendor', 'scopes:admin']], function () {
            Route::post('add', [categoryController::class, 'add'])->name('add');
            Route::post('edit/{id}', [categoryController::class, 'edit'])->name('edit');
        });
        // Route access by all user
        Route::group(['middleware' => ['auth:admin,vendor,customer', 'scopes:admin,vendor,customer']], function () {
            Route::get('/list/{id?}', [categoryController::class, 'list'])->name('list');
            Route::get("allCategories",[categoryController::class, 'allCategories'])->name('allCategories');
          
        });
    });
    //products routes
    Route::group(['prefix'=>"product",'as'=>"product."], function () {
        //product added by vendor and admin only
        Route::group(['middleware' => ['auth:vendor,admin', 'scopes:admin,vendor']], function () {
            Route::post('add', [productController::class, 'add'])->name('add');
            Route::post('saveFakeproduct', [productController::class, 'saveFakeproduct'])->name('saveFakeproduct');
            Route::post('edit/{id}', [productController::class, 'edit'])->name('edit');
            Route::delete('delete/{id}',[productController::class,'delete'])->name('delete');
            Route::post('gallery/delete/{id}',[productController::class,'removeGallery'])->name('removeGallery');
        });
        Route::group(['middleware' => ['auth:admin,vendor,customer', 'scopes:admin,vendor,customer']], function () {
            Route::post('/list/{id?}', [productController::class, 'list'])->name('list');
            Route::get('unGroup/list/', [productController::class, 'unGroup'])->name('unGroup');
            Route::post('attribute/generate/{id}',[productController::class,'productAttributes'])->name('productAttributes');
                // Route::get('/list/{id?}', [productController::class, 'list'])->name('list');
            
        });
    });

// product group
Route::group(['prefix'=>"group",'as'=>"group."], function () {
    //product added by vendor and admin only
    Route::group(['middleware' => ['auth:vendor,admin', 'scopes:admin,vendor']], function () {
        Route::get('/list/{id?}', [groupController::class, 'list'])->name('list');
        Route::post('add', [groupController::class, 'add'])->name('add');
        Route::post('add/{id}/product', [groupController::class, 'addProduct'])->name('addProduct');
        Route::post('edit/{id}', [groupController::class, 'edit'])->name('edit');
        Route::delete('delete/{id}',[groupController::class,'delete'])->name('delete');
        
    });
  
});

    Route::group(['prefix'=>"attribute",'as'=>"attribute."], function () {
        //product added by vendor and admin only
        Route::group(['middleware' => ['auth:vendor,admin', 'scopes:admin,vendor']], function () {
            Route::get('/list/{id?}', [attributeController::class, 'list'])->name('list');
            Route::get('/withchild', [attributeController::class, 'listwithChild'])->name('withchild');
            Route::post('add', [attributeController::class, 'add'])->name('add');
            Route::post('edit/{id}', [attributeController::class, 'edit'])->name('edit');
            Route::delete('delete/{id}',[attributeController::class,'delete'])->name('delete');
            // attribute values
            Route::group(['prefix'=>"attributevalue",'as'=>"attributevalue."], function () {
                Route::get('/list/{id?}', [attributeController::class, 'valueList'])->name('attributelist');
                Route::post('add', [attributeController::class, 'addValue'])->name('addValue');
                Route::post('edit/{id}', [attributeController::class, 'editValue'])->name('editValue');
                Route::delete('delete/{id}',[attributeController::class,'deleteValue'])->name('deleteValue');
            });
            
        });
        
    });
    
});
