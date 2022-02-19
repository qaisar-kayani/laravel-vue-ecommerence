<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\settings\productSettings;
use Illuminate\Http\Request;

class generalSettingsController extends Controller
{
    //

    public function Countrylist($country_code = null)
    {   
        if ($country_code) {
            $country = country::where('code', '=', $country_code)->orWhere('dial_code', '=', $country_code)->first();
        } else {
            $country = country::all();
        }
        return response()->json($country);
    }
    // products Setting

    public function productSettings(Request $request, $id = null)
    {
        $productSetting = productSettings::first();
        if (!$productSetting) {
            $productSetting=new productSetting();
        }
        $image['height'] = $request->imageHeight;
        $image['width'] = $request->imageWidth;
        $productSetting->image = $image;
        $thumbnail['height'] = $request->thumbnailHeight;
        $thumbnail['width'] = $request->thumbnailWidth;
        $productSetting->thumbnail=$thumbnail;
        $productSetting->save();
      return response()->json(['data' => $productSetting, 'message' => "", 'status' => "success"], 200);
    }

}
