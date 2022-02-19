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
//models
use App\Models\customers\order;
use App\Models\customers\orderItems;
use App\Models\customers\orderItemsVendor;
use App\Models\customers\orderStatus;
use App\Models\customers\orderVendor;
class OrderController extends Controller
{
    //
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

     $this->helperController = new helperController();
 }
    public function checkout(Request $request)
    {  
       
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('cart')
                ->setKeywords('cart')
                ->setDescription('cart');
            return view('frontend.pages.order.checkout');
        

    }
    public function orderSuccess(Request $request,$id=null)
    {  
        $order = order::with('orderStatus')->with('orderItems')->findOrfail($id);
           
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle('order-success')
                ->setKeywords('order-success')
                ->setDescription('order-success');
            return view('frontend.pages.order.orderSuccess',compact('order'));
        

    }
    

    

}
