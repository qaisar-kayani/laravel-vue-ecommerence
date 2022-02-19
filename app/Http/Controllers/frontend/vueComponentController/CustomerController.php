<?php

namespace App\Http\Controllers\frontend\vueComponentController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\helpers\helperController;

use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Query\Builder;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Regex;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Driver\Cursor;
use Carbon\Carbon;
use DateTime;
class CustomerController extends Controller
{
    //
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

     $this->helperController = new helperController();
 }
    public function login(Request $request)
    {  
       
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('cart')
                ->setKeywords('cart')
                ->setDescription('cart');
            return view('frontend.pages.customer.login');
        

    }
    public function register(Request $request)
    {  
       
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('cart')
                ->setKeywords('cart')
                ->setDescription('cart');
            return view('frontend.pages.customer.register');
        

    }
    public function vendorRegister(Request $request)
    {  
       
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('Vendor')
                ->setKeywords('cart')
                ->setDescription('cart');
            return view('frontend.pages.customer.vendorRegister');
        

    }
    public function vendorregistrationsuccess(Request $request)
    {  
       
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('Vendor')
                ->setKeywords('cart')
                ->setDescription('cart');
            return view('frontend.pages.customer.vendorRegister');
        

    }
    

    

}
