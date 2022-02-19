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
class PagesContoller extends Controller
{
    //
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

     $this->helperController = new helperController();
 }
    public function cartList(Request $request)
    {  
       
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('cart')
                ->setKeywords('cart')
                ->setDescription('cart');
            return view('frontend.pages.order.shopingCart');
        

    }

    

}
