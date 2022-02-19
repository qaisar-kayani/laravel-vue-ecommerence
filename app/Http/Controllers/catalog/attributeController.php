<?php

namespace App\Http\Controllers\catalog;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helpers\helperController;
use App\Models\catalog\attribute;
use App\Models\catalog\attributeValue;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\checkUniqueValue;
use Illuminate\Support\Str;
class attributeController extends Controller
{
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;
    public $id;
    public function __construct(helperController $helperController)
    {

        $this->helperController = new helperController();
    }

  public  function list(Request $request, $id = null) {

    
        $data = [];
        if ($id) {

            $data = attribute::with('attributeValues')->find($id);
        } else {

            $data = attribute::paginate($request->perPage);
        }

        return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);

    }
    public  function listwithChild() {
       

        $data=attribute::with('attributeValues')->where('status','active')->whereHas('attributeValues', function ($query) {
            return $query->where('status', '=', 'active');
        })->get();
       
        return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);

    }
// add product list
    public function add(Request $request)
    {

        try
        { 
            
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'code' => ["required",new checkUniqueValue('attributes')],
                "status" => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $attribute = new attribute();
            $attribute->name = strtolower($request->name);
            $attribute->code = strtolower($request->code);
            $attribute->status = $request->status;
            $attribute->by_user = Auth::user()->id;
            $attribute->created_at = carbon::now();
            $attribute->save();
            return response()->json(['data' => $attribute, 'message' => "", 'status' => "success"], 200);
        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }

    }
    //  edit catalog
    public function edit(Request $request, $id)
    {
        try
        {
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'code' => ["required",new checkUniqueValue('attributes',$id)],
                "status" => "required",

            ]);

            
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $attribute = attribute::findorfail($id);
            $attribute->name = strtolower($request->name);
            $attribute->code = strtolower($request->code);
            $attribute->status = strtolower($request->status);
            $attribute->updated_at = carbon::now();
            $attribute->save();
            return response()->json(['data' => $attribute, 'message' => "", 'status' => "success"], 200);
        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }

    }

// delete attributes

    public function delete($id)
    {
        $attribute = attribute::find($id);
        $attribute->status = "deleted";
        $attribute->save();
        $attribute->delete();
        return response()->json(['data' => "", 'message' => "attribute deleted successfully.", 'status' => "success"], 200);
    }

//  remove product gallery
public function valueList(Request $request,$id=null)
{
    $data = [];
    if ($id) {

        $data = attributeValue::find($id);
    } else {

        $data = attributeValue::paginate($request->perPage);
    }


    
    return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);

}
    public function addValue(Request $request)
    {

        try
        {
            $validator = Validator::make($request->all(), [

                'attribute_id'=>'required',
                'name' => "required",
                'code' => ["required",new checkUniqueValue('attributeValues')],
                "status" => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $attribute = new attributeValue();
            $attribute->attribute_id = $request->attribute_id;
            $attribute->name = strtolower($request->name);
            $attribute->description = strtolower($request->description);
            $attribute->code = strtolower($request->code);
            $attribute->status = $request->status;
            $attribute->by_user = Auth::user()->id;
            $attribute->created_at = carbon::now();
            $attribute->save();
            return response()->json(['data' => $attribute, 'message' => "", 'status' => "success"], 200);
        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }
    }

    // edit attribute value

    public function editValue(Request $request,$id)
    {

        try
        {
            $validator = Validator::make($request->all(), [
                'attribute_id'=>'required',
                'name' => "required",
                'code' => ["required",new checkUniqueValue('attributeValues',$id)],
                "status" => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $attribute = attributeValue::findorfail($id);
            $attribute->attribute_id = $request->attribute_id;
            $attribute->name = strtolower($request->name);
            $attribute->description = strtolower($request->description);
            $attribute->code = strtolower($request->code);
            $attribute->status = $request->status;
            $attribute->by_user = Auth::user()->id;
            $attribute->created_at = carbon::now();
            $attribute->save();
            return response()->json(['data' => $attribute, 'message' => "", 'status' => "success"], 200);
        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }
    }

    public function deleteValue($id)
    {
        $attributeValue = attributeValue::findorfail($id)->delete();
        return response()->json(['data' => "", 'message' => "attribute deleted successfully.", 'status' => "success"], 200);
    }

}
