<?php

namespace App\Http\Controllers\customers;

use App\Events\VendorBidEvent;
use App\Http\Controllers\Controller;
use App\Models\catalog\productGroup;
use App\Models\customers\bidding;
use App\Models\customers\vendorBidding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helpers;
class biddingController extends Controller
{
    //

    public function customerBid($user_id)
    {

        // return vendorBidding::min('givenPrice');
        $biddArray=[];
        $bidding=bidding::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        foreach ($bidding as $bidKey=>$value)
        {
            $biddArray[$bidKey]=$value;
            $biddArray[$bidKey]['minBid']=$value->vendorBidding->min('givenPrice');
            $biddArray[$bidKey]['accepted']=$value->vendorBidding->where('status','accepted')->pluck('givenPrice')->first();
        }
             return $biddArray;
    }
    public function customerBidDetails($bidding_id)
    {       
        return vendorBidding::with('product')->where('bidding_id', $bidding_id)->where('status', '!=', 'waiting')->orderBy('updated_at', 'DESC')->get();
    }
    public function vendorBidding($vendor_id)
    {   
        return vendorBidding::with('bidding','product')->where('vendor_id', (int) $vendor_id)->orderBy('created_at', 'DESC')->get();
    }

    public function create(Request $request)
    {

        $bidding = new bidding;
        $bidding->bid_number = Helpers::getID('bidding','bid');
        $bidding->name = $request->name;
        $bidding->user_id = $request->user_id;
        $bidding->bidPrice =(double) $request->bidPrice;
        $bidding->price =(double) $request->productPrice;
        $bidding->product_id = $request->product_id;
        $bidding->vendor_id = (int) $request->vendor_id;
        $bidding->thumbnail = $request->thumbnail;
        $bidding->image = $request->image;
        $bidding->message = $request->message;
        $bidding->status = "running";
        $bidding->responseCount = 0;
        $bidding->start_time =  Helpers::get_mongo_date(date('Y-m-d H:i:s'));
        $bidding->end_time= Helpers::get_mongo_date(date('Y-m-d H:i:s',strtotime('+30 minutes', time())));
        $bidding->save();
        // if product is grouped
        if ($request->group_id) {
            $producGroup = productGroup::find($request->group_id);
            if ($producGroup) {
                foreach ($producGroup->products as $pkey => $pvalue) {
                    $data['bidding_id'] = $bidding->_id;
                    $data['bidPrice'] = $request->bidPrice;
                    $data['user_id'] = $request->user_id;
                    $data['message'] = $request->message;
                    $data['product_id'] = $pvalue['product_id'];
                    $data['vendor_id'] = (int) $pvalue['vendor_id'];
                    $data['status'] = "waiting";
                    $data['savedAmount'] = 0;
                    $data['givenPrice'] = null;
                    event(new VendorBidEvent($data));
                }
            }
        } else {

            $data['bidding_id'] = $bidding->_id;
            $data['bidPrice'] = $request->bidPrice;
            $data['user_id'] =(int) $request->user_id;
            $data['message'] = $request->message;
            $data['product_id'] = $request->product_id;
            $data['vendor_id'] =(int) $request->vendor_id;
            $data['savedAmount'] = 0;
            $data['status'] = "waiting";
            $data['givenPrice'] = 0;
            event(new VendorBidEvent($data));
        }
        return response()->json(['data' => [], "message" => "Bid created successful", "status" => "success"], 200);
    }

    public function bidResponse(Request $request, $vendorBidId)
    {

        $validator = Validator::make($request->all(), [
            "givenPrice" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }
        try{
    
        $vendorBidding=vendorBidding::findOrfail($vendorBidId);
        $product_price=$vendorBidding->product->regular_price;
        $vendorBidding->givenPrice=Helpers::normalizePrice($request->givenPrice);
        $vendorBidding->status=$request->status;
        $vendorBidding->savedAmount=Helpers::normalizePrice($product_price-$vendorBidding->givenPrice);
        $vendorBidding->updated_at=Helpers::get_mongo_date(date('Y-m-d H:i:s'));
        $vendorBidding->save();
        $responseCount = bidding::where('_id', $vendorBidding->bidding_id)->increment('responseCount', 1);
        return response()->json(['data' => [], "message" => "Action successful", "status" => "success"], 200);
        }
        catch (Exception $e)
        {
            return response()->json(['data' => [], "message" => "oops! Something went wrong", "status" => "failed"], 500);
        }
    }

}
