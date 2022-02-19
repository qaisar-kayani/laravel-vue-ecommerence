<?php

namespace App\Http\Controllers\customers;

use App\Events\createVendorOrderEvent;
use App\Events\NotificationEvent;
use App\Events\VendorNotificationEvent;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\customers\cart;
use App\Models\customers\customerAddress;
use App\Models\customers\customerDefaultAddress;
use App\Models\customers\order;
use App\Models\customers\orderVendor;
use App\Models\customers\orderItemsVendor;
use App\Models\customers\orderItems;
use App\Models\customers\orderStatus;
use Auth;
use Carbon\Carbon;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

// events

class orderController extends Controller
{
    //
    public function customerOrders(Request $request, $id = null)
    {
        if ($id) {
            $order = order::with('orderStatus')->with('orderItems')->findOrfail($id);
        } else {
            $order = order::with('orderStatus')->with('orderItems')->where('customer_id', Auth::user()->id)->get();
        }

        return $order;
    }

    public function vendorOrder(Request $request, $id = null)
    {
        if ($id) {
            $order = orderVendor::with('orderStatusVendor','orderItemsVendor')->findOrfail($id);
        } else {
    
            $order = orderVendor::with('orderStatusVendor')->with('orderItemsVendor')->where('vendor_id',Auth::user()->vendor->id)->orderBy('created_at','DESC')->paginate($request->perPage);
        }

        return $order;
    }
    public function adminOrder(Request $request, $id = null)
    {
        if ($id) {
            $order = order::with('orderStatus')->with('orderItems')->findOrfail($id);
        } else {
            // $order = order::with('orderStatus')->with('orderItems')->orderBy('created_at', 'DESC')->paginate($request->perPage);
            $order = order::query();
            $order=order::orderFilter($order,$request);
        }

        return $order;
    }

    public function create(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [

                "cartId" => "required",
                "customer.first_name" => "required",
                "customer.last_name" => "required",
                "customer.email" => "required",
                "customer.mobile" => "phone:AE",
                "customer.country_code" => "required",
                "address.address1" => "required",
                "address.city" => "required",
                "address.zip" => "required",
                "address.country" => "required",

                // "payment_method_id"=>"required",
                // "paymentMethod"=>"required",
                // "shipping_method_id"=>"required",
                // "shippingMethod"=>"required",
                // "total"=>"required",
                //  "subTotal"=>"required",
                //  "totalTax"=>"required"

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }
            // $cart = cart::where('status', 'created')->findOrfail($request->cartId);
            $cart = cart::findOrfail($request->cartId);
            $order = new order();
            $order->orderNumber = $order->getID('order');
            $order->status = 'placed';
            $order->orderDate = Helpers::get_mongo_date(date('Y-m-d H:i:s'));
            $order->comments = $request->comments;
            $order->cart_id = $request->cartId;
            if ($customer = Auth::user()) {
                $customer_id = Auth::user()->id;
                $order->customer_id = $customer_id;
                $customerOrderData['first_name'] = Str::lower($request->customer['first_name']);
                $customerOrderData['last_name'] = Str::lower($request->customer['last_name']);
                $customerOrderData['email'] = Str::lower(trim($request->customer['email']));
                $customerOrderData['phone'] = phone($request->customer['mobile'], $request->customer['country_code'])->formatE164();
                $customerOrderData['address']['customer_id'] = $order->customer_id;
                $customerOrderData['address']['type'] = $request->address['type'];
                $customerOrderData['address']['country'] = $request->address['country'];
                $customerOrderData['address']['countryCode'] = $request->customer['country_code'];
                $customerOrderData['address']['address1'] = $request->address['address1'];
                $customerOrderData['address']['address2'] = $request->address['address2'];
                $customerOrderData['address']['state'] = $request->address['state'];
                $customerOrderData['address']['city'] = $request->address['city'];
                $customerOrderData['address']['zip'] = $request->address['zip'];
                $customerOrderData['address']['street'] = $request->address['street'];
                $customerOrderData['address']['building'] = $request->address['building'];
                $customerOrderData['address']['flat'] = $request->address['flat'];
                $customerOrderData['address']['instruction'] = $request->address['instruction'];
                //$customerOrderData['address']['lat'] = $request->address['lat'];
                //$customerOrderData['address']['long'] = $request->address['long'];
                $customerOrderData['address']['isDefault'] = $request->address['isDefault'];
                if (!$request->address_id) {
                    $customerAddress = new customerAddress;
                    $customerAddress->customer_id = $order->customer_id;
                    $customerAddress->type = $request->address['type'];
                    $customerAddress->country = $request->address['country'];
                    $customerAddress->countryCode = $request->customer['country_code'];
                    $customerAddress->address1 = $request->address['address1'];
                    $customerAddress->address2 = $request->address['address2'];
                    $customerAddress->state = $request->address['state'];
                    $customerAddress->city = $request->address['city'];
                    $customerAddress->zip = $request->address['zip'];
                    $customerAddress->street = $request->address['street'];
                    $customerAddress->building = $request->address['building'];
                    $customerAddress->flat = $request->address['flat'];
                    $customerAddress->instruction = $request->address['instruction'];
                    //$customerOrderData['address']['lat=$request->address['lat'];
                    //$customerOrderData['address']['long=$request->address['long'];
                    $customerAddress->isDefault = ($request->address['isDefault']) ? $request->address['isDefault'] : false;
                    if ($request->address['isDefault']) {
                        $customerDefaultAddress = customerDefaultAddress::where('customer_id', $customer_id)->update(["customer_id" => $customer_id, "address_id" => $customerAddress->_id], array('upsert' => true));
                    }

                }
            }
            $order->customer = $customerOrderData;
            $order->totalItems = $cart->totalItems;
            $order->orderTotal = $cart->cartTotal;
            $order->orderSubTotal = $cart->cartSubTotal;
            $order->orderTotalTax = $cart->totalTax;
            $order->totalDiscount = 0.00;
            $order->save();
            $OrderVendorId = [];

            if ($cart->cartItems) {
                foreach ($cart->cartItems as $Itemskey => $cartItemsValue) {
                    $orderItems = new orderItems;
                    $orderItems->order_id = $order->_id;
                    $orderItems->cartItem_id = $cartItemsValue->_id;
                    $orderItems->product_id = $cartItemsValue->product_id;
                    $orderItems->parent_id = $cartItemsValue->parent_id;
                    $orderItems->vendor_id = $cartItemsValue->vendor_id;
                    $orderItems->sku = $cartItemsValue->sku;
                    $orderItems->name = $cartItemsValue->name;
                    $orderItems->quantity = $cartItemsValue->quantity;
                    $orderItems->unitPrice = $cartItemsValue->unitPrice;
                    $orderItems->price = $cartItemsValue->price;
                    $orderItems->thumbnail = $cartItemsValue->thumbnail;
                    $orderItems->image = $cartItemsValue->feature_image;
                    $orderItems->attributes = $cartItemsValue->attributes;
                    $orderItems->condition = $cartItemsValue->condition;
                    $orderItems->associatedModel = $cartItemsValue->associatedModel;
                    $orderItems->save();
                    event(new createVendorOrderEvent($order, $orderItems));

                    if (!in_array($cartItemsValue->vendor_id, $OrderVendorId)) {
                        array_push($OrderVendorId, $cartItemsValue->vendor_id);
                    }

                }

                // fire events
                $notification['type'] = "new_order";
                $notification['message'] = "new order has been place";
                $notification['status'] = "created";
                event(new NotificationEvent($notification));
                foreach ($OrderVendorId as $key => $value) {
                    $notification['type'] = "new_order";
                    $notification['message'] = "new order has been place";
                    $notification['status'] = "placed";
                    $notification['vendor_id'] = $OrderVendorId;
                    event(new VendorNotificationEvent($notification));
                }
                // update cart
                $cart->status = "checked_out";
                $cart->save();
                // update order status
                $orderStatus = orderStatus::insert(['order_id' => $order->id, "status" => "placed", "statusChangeAt" => Helpers::get_mongo_date(Carbon::now())]);
                return response()->json(['data' => $order, "message" => "Your order has placed successfully", "status" => "success"], 200);

            }
        } catch (Exception $e) {
            return response()->json(['data' => [], "message" => "Oopps Something went wrong", "status" => "success"], 200);

        }
    }

    // update order
    public function edit(Request $request, $id)
    {
        try {
            $order = order::findOrfail($id);
            $order->status = $request->status;
            $order->updated_at = Helpers::get_mongo_date(date('Y-m-d H:i:s'));
            $order->save();
            $orderStatus = orderStatus::insert(['order_id' => $id, "status" => $request->status, "changed_by" => Auth::user()->id, "statusChangeAt" => Helpers::get_mongo_date(date('Y-m-d H:i:s'))]);
            return response()->json(['data' => $orderStatus, "message" => "order status changed successfully", "status" => "success"], 200);
        } catch (Exception $e) {
            return response()->json(['data' => [], "message" => "Oops Somthing went wrong", "status" => "failed"], 500);
        }
    }
}
