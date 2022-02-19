<?php

namespace App\Http\Controllers\frontend\api;

use App\Http\Controllers\Controller;
use App\Models\catalog\product;
use App\Models\catalog\review;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class reviewController extends Controller
{
    //
    function list(Request $request, $id = null) {
        if ($id) {
            $data = review::findOrfail($id);
        } else {
            $data = review::orderBy('created_at', 'DESC')->where('product_id',$request->product_id)->paginate($request->perPage);
        }
        return $data;
    }
    public function add(Request $request)
    {

        try
        {
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'review' => "required",
                'rate' => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }
            $product = product::findOrfail($request->product_id);
            $review = new review();
            if (Auth::user()) {
                $review->user_id = Auth::user()->id;
            } else {
                $review->user_id = null;
            }

            $review->name = Str::lower($request->name);
            $review->review = Str::lower($request->review);
            $review->rate = $request->rate;
            $review->product_id = $request->product_id;
            $review->save();
            $product->countRating($request->rate);
            return response()->json(['data' => $product->review, "message" => "Thank you for your feedback", "status" => "success"], 200);
            // update product reviews

        } catch (Exception $e) {
            return response()->json(['data' => [], "message" => "oops! Something went wrong", "status" => "failed"], 500);
        }
    }
    public function edit(Request $request, $id)
    {

        try
        {
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'review' => "required",
                'rate' => "required",
            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }
          
            $review = review::findOrfail($id);
            if (Auth::user()) {
                $review->user_id = Auth::user()->id;
            } else {
                $review->user_id = null;
            }

            $review->name = Str::lower($request->name);
            $review->review = Str::lower($request->review);
            $review->rate = $request->rate;
            $review->product_id = $request->product_id;
            $review->save();
            $product=product::findOrfail($review->product_id);
            $product->countRating($request->rate,true);
            return response()->json(['data' => $product->review, "message" => "Thank you for your feedback", "status" => "success"], 200);
            // update product reviews

        } catch (Exception $e) {
            return response()->json(['data' => [], "message" => "oops! Something went wrong", "status" => "failed"], 500);
        }
    }

    public function delete($id)
    {
        reveiw::find($id)->delete();
        return response()->json(['data' => $review, "message" => "Your feedback removed successfully", "status" => "success"], 200);
    }

}
