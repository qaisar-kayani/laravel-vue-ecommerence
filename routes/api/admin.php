<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\pluginController;
use App\Http\Controllers\settings\taxController;
use App\Http\Controllers\customers\orderController;
use App\Http\Controllers\generalSettingsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', "as" => "admin."], function () {
    // unauthenticate user login
    Route::post('login', [adminController::class, 'login'])->name('adminlogin');
    //Route::post('/signup',[adminController::class,'signup'])->name('signup');
    //authenticated vendor routes here
    Route::group(['prefix' => '', 'middleware' => ['auth:admin', 'scopes:admin']], function () {
        Route::get('/list/{id?}', [adminController::class, 'list'])->name('list');
        Route::post('/add', [adminController::class, 'add'])->name('add');
        Route::post('/edit/{id}', [adminController::class, 'edit'])->name('edit');
    });
    // plugin settings route
    Route::group(['prefix' => "plugins", 'as' => "plugins.", 'middleware' => ['auth:admin', 'scopes:admin']], function () {
        // sliders
        Route::get('slider/list/{id?}', [pluginController::class, 'sliderlist'])->name('sliderlist');
        Route::post('slider/add', [pluginController::class, 'addSlider'])->name('addSlider');
        Route::post('slider/edit/{id}', [pluginController::class, 'editSlider'])->name('editSlider');
        Route::post('slider/gallery/delete/{id}',[pluginController::class,'removeGallery'])->name('removeGallery');
    });
    // other settings
    Route::group(['prefix' => "settings", 'as' => "settings.", 'middleware' => ['auth:admin', 'scopes:admin']], function () {
        
        // product settings
        Route::post('productSettings', [generalSettingsController::class, 'productSettings'])->name('productSettings');

        Route::group(['prefix' => "tax", 'as' => "tax.", 'middleware' => ['auth:admin', 'scopes:admin']], function () {
            // tax settings
            Route::get('list/{id?}', [taxController::class, 'list'])->name('sliderlist');
            Route::post('add', [taxController::class, 'add'])->name('addtax');
            Route::post('edit/{id}', [taxController::class, 'edit'])->name('edittax');
            
        });

      
    });

    Route::group(['prefix' => "order", 'as' => "order.", 'middleware' => ['auth:admin', 'scopes:admin']], function () {
        // order List
        Route::get('list/{id?}', [orderController::class, 'adminOrder'])->name('adminOrder');
        Route::post('update/{id?}', [orderController::class, 'edit'])->name('adminOrderUpdate'); //for order update and 
       
        
    });


});
