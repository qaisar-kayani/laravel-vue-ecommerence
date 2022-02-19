<?php

use App\Http\Controllers\frontend\categoryController;
use App\Http\Controllers\frontend\productController;
use App\Http\Controllers\frontend\vueComponentController\CustomerController;
use App\Http\Controllers\frontend\vueComponentController\OrderController;
use App\Http\Controllers\frontend\vueComponentController\PagesContoller; //for vue component use in blade
use App\Http\Controllers\homeController; //for vue component use in blade customer routes
use Butschster\Head\Facades\Meta; //for vue component use in blade customer routes
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
// web routes
// Route::post('/', function () {
//     Meta::prependTitle('Price Driller !')
//     ->setTitle('Home')
//     ->setFavicon('favicon-index.ico');
//     return view('frontend.pages.home');
// });
Route::get('/', [homeController::class, 'load'])->name("home-page");
Route::get('/home', [homeController::class, 'load'])->name("home");
// pages 
 
Route::get('aboutUs',function (){
    Meta::prependTitle('Price Driller !')
    ->setTitle('About Us')
    ->setFavicon('favicon-index.ico');
    return view('frontend.pages.common.about');
})->name('about-us');

Route::get('faq',function (){
    Meta::prependTitle('Price Driller !')
    ->setTitle('Faqs')
    ->setFavicon('favicon-index.ico');
    return view('frontend.pages.common.faq');
})->name('faq');
Route::get('termsCondition',function (){
    Meta::prependTitle('Price Driller !')
    ->setTitle('Terms & condition')
    ->setFavicon('favicon-index.ico');
    return view('frontend.pages.common.terms-conditions');
})->name('termsnCondition');
Route::get('warranyServices',function (){
    return view('frontend.pages.common.terms-conditions');
})->name('warranyServices');
Route::get('privacyPolicy',function (){
    Meta::prependTitle('Price Driller !')
    ->setTitle('Privacy & Policy');
    return view('frontend.pages.common.privacy-policy');
})->name('privacyPolicy');
Route::get('blogs',function (){
    Meta::prependTitle('Price Driller !')
    ->setTitle('Privacy & Policy');
    return view('frontend.pages.common.blogs');
})->name('blogs');
Route::get('contact-us',function (){
    Meta::prependTitle('Price Driller !')
    ->setTitle('Contact us');
    return view('frontend.pages.common.contact-us');
})->name('contact-us');
// load Category
Route::prefix('category')->as('category.')->group(function () {
    Route::get('/{slug}', [categoryController::class, 'productListView'])->name('products');
});
Route::prefix('product')->as('product.')->group(function () { //load products

    Route::get('/{slug}/{id}', [productController::class, 'list'])->name('singleProduct');

});
//cart and checkout
Route::get('cart', [PagesContoller::class, 'cartList'])->name('cartList');
Route::get('checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('order-success/{id}', [OrderController::class, 'orderSuccess'])->name('order-sucess'); //ORDER conformation

//customer
Route::get('login', [CustomerController::class, 'login'])->name('login');
Route::get('register', [CustomerController::class, 'register'])->name('register');
Route::get('vendor/register', [CustomerController::class, 'vendorRegister'])->name('vendor-register');
Route::get('vendor/success', function () {
    return view('frontend.pages.customer.vendorSuccess');
});


Route::prefix('customer')->as('customer.')->group(function () {
    Route::get('dashboard', function () {
        return view('frontend.pages.customer.dashboard');
    });
    Route::get('bidding', function () {
        return view('frontend.pages.customer.bidding');
    });
    Route::get('order/list', function () {
        return view('frontend.pages.customer.orderList');
    });
    Route::get('order/details/{id}', function ($id) {
        
        return view('frontend.pages.customer.orderDetails',['id'=>$id]);
    });
    Route::get('profile', function () {
        return view('frontend.pages.customer.profile');
    });

});

//vue admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::view('/{any}', 'vueAdmin')
    // ->middleware(['auth'])
        ->where('any', '.*');
});

//vendor
Route::group(['prefix' => 'vendor'], function () {
    Route::view('/{any}', 'vueVendor')
    // ->middleware(['auth'])
        ->where('any', '.*');
});
