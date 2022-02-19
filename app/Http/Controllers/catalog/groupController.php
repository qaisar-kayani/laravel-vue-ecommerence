<?php

namespace App\Http\Controllers\catalog;

use App\Http\Controllers\Controller;
use App\Models\catalog\product;
use App\Models\catalog\productGroup;
use App\Models\catalog\vendorGroup;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class groupController extends Controller
{
    //

    function list(Request $request, $id = null) {
        $data = [];
        if ($id) {
            $data = productGroup::findOrfail($id);
        } else {
            $data = productGroup::paginate($request->perPage);
        }

        return $data;
    }
    // add groups

    public function add(Request $request, $id = null)
    {

        try
        {
            $validator = Validator::make($request->all(), [

                'name' => "required",

                'status' => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $productGroup = new productGroup;
            $productGroup->name = strtolower($request->name);
            $productGroup->gCode = strtolower(Str::slug($request->name));
            $productGroup->status = strtolower($request->status);
            $productGroup->created_by = Auth::user()->id;
            $productGroup->save();
            return response()->json(['data' => [], "message" => "Group created successfull.", "status" => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => [], "message" => "Oops! something went wrong.", "status" => "failed"], 403);
        }
    }
    //edit group

    public function edit(Request $request, $id = null)
    {

        try
        {
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'status' => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }
            if (productGroup::where('code', strtolower(Str::slug($request->name)))->where('_id', "!=", $id)->first()) {
                return response()->json(['data' => $validator->errors(), "message" => "Similar group already Exist", "status" => "failed"], 403);
            }

            $productGroup = productGroup::findOrfail($id);
            $productGroup->name = strtolower($request->name);
            //$productGroup->gCode = strtolower(Str::slug($request->name));
            $productGroup->status = strtolower($request->status);
            $productGroup->created_by = Auth::user()->id;
            $productGroup->save();
            return response()->json(['data' => [], "message" => "Group updated successfull.", "status" => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => [], "message" => "Oops! something went wrong.", "status" => "failed"], 403);
        }
    }

    public function addProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'products' => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }
        $productGroup = productGroup::findOrfail($id);
        $productGroup->push('products', $request->products);
        foreach ($request->products as $p => $value) {
            $product = product::find($value['product_id']);
            $product->group_id = $id;
            $product->save();
            $vendorGroup = vendorGroup::where(['group_id' => $id, 'vendor_id' =>$product->vendor_id])->update(["group_id" => $id, "vendor_id" => $product->vendor_id,"rating"=>$product->rating], array('upsert' => true));
        }

        return response()->json(['data' => $productGroup, "message" => "Group updated successfull.", "status" => "success"], 200);
    }
}
