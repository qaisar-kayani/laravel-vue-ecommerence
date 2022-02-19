<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plugins\slider;
use App\Models\catalog\category;
use Butschster\Head\Facades\Meta;
class HomeController extends Controller
{
 
    public function load()
    {   
        $slider=slider::where(['type'=>'home-slider',"status"=>"active"])->first();

        $shopByCategory=category::orderby('created_at','DESC')->limit(20)->get();
        $bestSellerCategory=category::orderby('created_at','ASC')->limit(3)->get();
        Meta::prependTitle('Price Driller !')
        ->setTitle('Home')
        ->setFavicon('favicon-index.ico');
        return view('frontend.pages.home',compact('slider','shopByCategory','bestSellerCategory'));
    
    }
}
