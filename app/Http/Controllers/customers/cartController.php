<?php

namespace App\Http\Controllers\customers;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\catalog\product;
use App\Models\customers\cart;
use App\Models\customers\cartItems;
use App\Models\customers\cartItemsVendor;
use App\Models\customers\cartVendors;
use App\Events\changeBidStatusEvent;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class cartController extends Controller
{
    //
    public function cartList(Request $request, $id = null)
    {
        if ($id) {
            $cart = cart::with('cartItems')->find($id);
        } else {
            $cart = cart::paginate($request->perPager);
        }

        return $cart;
    }
    public function addTocart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }
        $cart = '';
        $cartId = '';
        $cartDiscount=0;
        $productDiscount=0;
        $unitPrice = '';
        $isBid=false;
        $vendorBidId=null;
        $product = product::findOrfail($request->product_id);
        // check product sales price
        if (isset($request->isBid) && $request->isBid == true) {
            $unitPrice = $request->bidPrice;
            $isBid=true;
            $productDiscount= Helpers::normalizePrice($product->regular_price-$request->bidPrice);
            if(isset($request->vendorBidId) && $request->vendorBidId)
            {
                $vendorBidId=$request->vendorBidId;
            }
        } else {
            if ($product->sale_price && $product->sale_price > 0) {
                $unitPrice = $product->sale_price;
                $productDiscount= Helpers::normalizePrice($product->regular_price-$product->sale_price);
            } else {
                $unitPrice = $product->regular_price;
            }
        }
        if (isset($request->cartId) && ($request->cartId != '' || $request->cartId != null)) {

            $cart = cart::findOrfail($request->cartId);
            $cartTotal = $cart->cartTotal;
            $cartSubTotal = $cart->cartSubTotal;
            $cartDiscount=$cart->cartDiscount;
            $cartTotalItems = $cart->totalItems;
            $cartId = $cart->_id;
            //  check if item alread exists;
            if ($cartItems = $cart->cartItems->where('product_id', $request->product_id)->first()) {
                $itemPrice = $cartItems->unitPrice;
                $itemtotalPrice = Helpers::normalizePrice($cartItems->price + $itemPrice);
                $cartItems = cartItems::where('_id', $cartItems->_id)->increment('quantity', 1, ['price' => $itemtotalPrice]);
                $cart->cartSubTotal = Helpers::normalizePrice($cartSubTotal + $itemPrice);
                $cart->totalItems = $cartTotalItems + 1;
                $cart->totalTax = Helpers::VatCalculation($cart->cartSubTotal);
                $cart->cartTotal = Helpers::normalizePrice($cart->cartSubTotal + $cart->totalTax);
                $cart->save();
            } else {
                // add a new item to cart
                $cartItems = new cartItems();
                $cartItems->cart_id = $cart->id;
                $cartItems->isBid = $request->isBid;
                $cartItems->product_id = $request->product_id;
                $cartItems->parent_id = $request->parent_id;
                $cartItems->vendor_id = $product->vendor_id;
                $cartItems->sku = $product->vendor_id;
                $cartItems->name = $product->name;
                $cartItems->quantity = (int) $request->quantity;
                $cartItems->price = Helpers::normalizePrice($unitPrice * $request->quantity);
                $cartItems->unitPrice = Helpers::normalizePrice($unitPrice);
                $cartItems->thumbnail = $product->thumbnail;
                $cartItems->image = $product->feature_image;
                $cartItems->attributes = $product->productAttributes;
                $cartItems->condition = array();
                $cartItems->associatedModel = array();
                $cartItems->save();
                $cartItemsId = $cartItems->_id;
                $cart->cartSubTotal = Helpers::normalizePrice($cartSubTotal + ($unitPrice * $request->quantity));
                $cart->totalItems = $cartTotalItems + (int) $request->quantity;
                $cart->totalTax = Helpers::VatCalculation($cart->cartSubTotal);
                $cart->cartTotal = Helpers::normalizePrice($cart->cartSubTotal + $cart->totalTax);
                $cart->save();
                if (!$cart->vendor->where('vendor_id', $product->vendor_id)->count()) {
                    cartVendors::insert(['cart_id' => $cartId, "vendor_id" => $product->vendor_id]);
                }

                cartItemsVendor::insert(['cart_id' => $cartId, "vendor_id" => $product->vendor_id, "cartitem_id" => $cartItemsId]);}

        } else {
            // save cart data
            $cart = new cart();
            $cart->is_guest = true;
            $cart->customer_id = null;
            if (Auth::user()) {
                $userObj = Auth::user();
                $customer['customer_id'] = $userObj->id;
                $customer['firstName'] = $userObj->first_name;
                $customer['lastName'] = $userObj->last_name;
                $customer['email'] = $userObj->email;
                $customer['mobile'] = $userObj->mobile;
                $cart->customer = $customer;
                $cart->customer_id = $userObj->id;
                $cart->is_guest = false;
            } else {
                $cart->customer = null;
            }

            $cart->customerIp = $request->Ip;
            $cart->customerBrowser = $request->customerBrowser;
            $cart->customerDevice = $request->customerDevice;
            $cart->status = "created";
            $cart->totalItems = $request->quantity;
            $cart->cartSubTotal = Helpers::normalizePrice($unitPrice * $request->quantity);
            $cart->totalTax = Helpers::VatCalculation($cart->cartSubTotal);
            $cart->cartTotal = Helpers::normalizePrice($cart->cartSubTotal + $cart->totalTax);
            $cart->save();
            // save cart Items;
            $cartId = $cart->_id;
            $cartItems = new cartItems();
            $cartItems->cart_id = $cart->id;
            $cartItems->isBid = $isBid;
            $cartItems->product_id = $request->product_id;
            $cartItems->parent_id = $request->parent_id;
            $cartItems->vendor_id = $product->vendor_id;
            $cartItems->sku = $product->sku;
            $cartItems->name = $product->name;
            $cartItems->quantity = (int) $request->quantity;
            $cartItems->unitPrice = Helpers::normalizePrice($unitPrice);
            $cartItems->price = Helpers::normalizePrice($cartItems->unitPrice * $request->quantity);
            $cartItems->thumbnail = $product->thumbnail;
            $cartItems->image = $product->feature_image;
            $cartItems->attributes = $product->productAttributes;
            $cartItems->condition = array();
            $cartItems->associatedModel = array();
            $cartItems->save();
            $cartItemsId = $cartItems->_id;
            // save vendor cart
            $cartVendor = cartVendors::insert(['cart_id' => $cartId, "vendor_id" => $product->vendor_id]);
            cartItemsVendor::insert(['cart_id' => $cartId, "vendor_id" => $product->vendor_id, "cartitem_id" => $cartItemsId]);
            if($isBid)
            {
                 $bid['status']="accepted";
                 $bid['vendorBidId']=$vendorBidId;
                event(new changeBidStatusEvent($bid));           }

        }
        return cart::with('cartItems')->find($cartId);
    }
    public function updateCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cartId' => "required",
            'product_id' => "required",
            'quantity' => "required",

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }
        $cart = '';
        $cartId = '';
        if (isset($request->cartId) && ($request->cartId != '' || $request->cartId != null)) {

            $cart = cart::findOrfail($request->cartId);
            $cartTotal = $cart->cartTotal;
            $cartSubTotal = $cart->cartSubTotal;
            $cartTotalItems = $cart->totalItems;
            $cartId = $cart->_id;
            //  check if item alread exists;
            if ($cartItems = $cart->cartItems->where('product_id', $request->product_id)->first()) {
                // remove old price and quantity
                $itemOldprice = $cartItems->price;
                $itemsOldQuantity = $cartItems->quantity;
                $cartSubTotal = $cartSubTotal - $itemOldprice;
                $cartTotalItems = $cartTotalItems - $itemsOldQuantity;
                // calculate new price for the cart items

                $itemPrice = $cartItems->unitPrice;
                $itemtotalPrice = Helpers::normalizePrice($itemPrice * (int) $request->quantity);
                $cartItems = cartItems::where('_id', $cartItems->_id)->update(['quantity' => (int) $request->quantity, 'price' => $itemtotalPrice]);
                $cart->cartSubTotal = Helpers::normalizePrice($cartSubTotal + $itemtotalPrice);
                $cart->totalItems = $cartTotalItems + (int) $request->quantity;
                $cart->totalTax = Helpers::VatCalculation($cart->cartSubTotal);
                $cart->cartTotal = Helpers::normalizePrice($cart->cartSubTotal + $cart->totalTax);
                $cart->save();
            }

        }

        return cart::with('cartItems')->find($cartId);
    }
    public function removeCart(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => "required",
            "cartId" => "required",

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }
        $cart = cart::findOrfail($request->cartId);
        $cartTotal = $cart->cartTotal;
        $cartSubTotal = $cart->cartSubTotal;
        $cartTotalItems = $cart->totalItems;
        $cartId = $cart->_id;
        $itemPrice = 0;
        //  check if item alread exists;
        if ($cartItems = $cart->cartItems->where('product_id', $request->product_id)->first()) {
            $itemQuantity = $cartItems->quantity;
            $itemPrice = $cartItems->unitPrice;
            $itemtotalPrice = Helpers::normalizePrice($cartItems->price - $itemPrice);
            if ($itemQuantity > 1) {
                cartItems::where('_id', $cartItems->_id)->decrement('quantity', 1, ['price' => $itemtotalPrice]);

            } else {
                cartItems::where('_id', $cartItems->_id)->delete();
            }

        } else {
            return response()->json(['data' => [], 'message' => "Item doesn't exist", 'status' => "failed"], 403);
        }

        $cart->cartSubTotal = Helpers::normalizePrice($cartSubTotal - $itemPrice);
        $cart->totalTax = Helpers::VatCalculation($cart->cartSubTotal);
        $cart->cartTotal = Helpers::normalizePrice($cart->cartSubTotal + $cart->totalTax);
        $cart->totalItems = $cartTotalItems - 1;
        $cart->save();
        return cart::with('cartItems')->find($cartId);
    }

    public function removeCartItem(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'product_id' => "required",
            "cartId" => "required",

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }
        $cart = cart::findOrfail($request->cartId);
        $cartTotal = $cart->cartTotal;
        $cartSubTotal = $cart->cartSubTotal;
        $cartTotalItems = $cart->totalItems;
        $cartId = $cart->_id;
        $itemPrice = 0;
        //  check if item alread exists;
        if ($cartItems = $cart->cartItems->where('product_id', $request->product_id)->first()) {
            $itemQuantity = $cartItems->quantity;
            $itemstotalPrice = $cartItems->price;
            cartItems::where('_id', $cartItems->_id)->delete();

        } else {
            return response()->json(['data' => [], 'message' => "Item doesn't exist", 'status' => "failed"], 403);
        }

        $cart->cartSubTotal = Helpers::normalizePrice($cartSubTotal - $itemstotalPrice);
        $cart->totalTax = Helpers::VatCalculation($cart->cartSubTotal);
        $cart->cartTotal = Helpers::normalizePrice($cart->cartSubTotal + $cart->totalTax);
        $cart->totalItems = $cartTotalItems - $itemQuantity;
        $cart->save();
        return cart::with('cartItems')->find($cartId);
    }
    public function clearAllCart($cartId)
    {
        $cart = cart::findOrfail($cartId);
        $cart->status = "cleared";
        $cart->save();
        return response()->json(['data' => [], 'message' => "cart cleared successfully", 'status' => "success"], 200);

    }

}
