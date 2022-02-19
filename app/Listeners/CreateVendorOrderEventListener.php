<?php

namespace App\Listeners;

use App\Events\createVendorOrderEvent;
use App\Helpers\Helpers;
use App\Models\customers\orderVendor;
use App\Models\customers\orderStatusVendor;
use App\Models\customers\orderItemsVendor;
use Carbon\Carbon;
use Auth;
use Log;
use DB;
class CreateVendorOrderEventListener
{ 
   

    public function __construct()
    {
        //

    }


    public function handle(createVendorOrderEvent $event)
    {
     
        $vendorOrder = orderVendor::where('vendor_id', $event->orderItems->vendor_id)->where('orderNumber', $event->order->orderNumber)->first();
        if ($vendorOrder) {
            $vendorOrder->totalItems= $vendorOrder->totalItems+$event->orderItems->quantity;
            $vendorOrder->orderSubTotal = Helpers::normalizePrice($vendorOrder->orderSubTotal + $event->orderItems->price);
            $vendorOrder->orderTotalTax = Helpers::VatCalculation($vendorOrder->orderSubTotal);
            $vendorOrder->orderTotal = Helpers::normalizePrice($vendorOrder->orderSubTotal + $vendorOrder->orderTotalTax);
            $vendorOrder->totalDiscount = 0.00;
            $vendorOrder->orderTotal = Helpers::normalizePrice(($vendorOrder->orderSubTotal + $vendorOrder->orderTotalTax) - $vendorOrder->totalDiscount);
            $vendorOrder->save();
            $orderItemsVendor=$event->orderItems->toArray();
            $orderItemsVendor['vendor_order_id']=$vendorOrder->_id;
            unset($orderItemsVendor['_id']);
            orderItemsVendor::insert($orderItemsVendor);
        } else {
          //  $vendorOrder = new orderVendor;
            $order=$event->order->toArray();
            $order['vendor_id']=$event->orderItems->vendor_id;
            $order['totalItems'] = $event->orderItems->quantity;
            $order['orderSubTotal'] = Helpers::normalizePrice($event->orderItems->price);
            $order['orderTotalTax'] = Helpers::VatCalculation($order['orderSubTotal']);
            $order['orderTotal'] = Helpers::normalizePrice($order['orderSubTotal'] + $order['orderTotalTax']);
            $order['totalDiscount'] = 0.00;
            $order['orderTotal'] = Helpers::normalizePrice(($order['orderSubTotal'] + $order['orderTotalTax']) - $order['totalDiscount']);
            unset($order['_id']);
            $id=orderVendor::insertGetId($order);
            $id=(string)$id;
            $orderItemsVendor=$event->orderItems->toArray();
            $orderItemsVendor['vendor_order_id']=$id;
            unset($orderItemsVendor['_id']);
            orderItemsVendor::insert($orderItemsVendor);
            orderStatusVendor::insert(['vendor_order_id' => $id, "status" => "placed", "statusChangeAt" => Helpers::get_mongo_date(Carbon::now())]);
        }

       

    }
}
