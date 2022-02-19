<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\settings\tax;
class taxController extends Controller
{
    //


    public function add(Request $request, $id = null)
    {
        
       $tax=new tax();
       $tax->name=$request->name;
       $tax->code=$request->code;
       $tax->vendor_id=(int) $request->vendor_id;
       $tax->amount=(double) $request->amount;
       $tax->amountType=$request->amountType;
       $tax->priceExcludingTax= (double) $request->priceExcludingTax;
       $tax->status="active";
       $tax->save();
      return response()->json(['data' => $tax, 'message' => "", 'status' => "success"], 200);
    }
}
