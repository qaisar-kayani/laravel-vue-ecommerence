<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helpers\helperController;
use App\Models\plugins\slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class pluginController extends Controller
{
    //
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

        $this->helperController = new helperController();
    }
    public function sliderlist(Request $request,$id = null)
    {  
        if ($id) {
            $slider = slider::where('_id', '=', $id)->first();

        } else {
            $slider = slider::paginate($request->perPage);

        }
        return response()->json($slider, 200);
    }

    public function addSlider(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => "required",
            "images.*" => 'mimes:jpeg,jpg,png,gif|required|max:10000',

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }

        $slider = new slider();
        $slider->name = $request->name;
        $slider->slug = Str::slug($request->name);
        $slider->type = $request->type;
        $slider->status = $request->status;
        $slider->created_at = Carbon::now();
        $slider->by_user = $request->user_id;
        $images = [];
        $image_error=[];
        if ($request->file('images') && count($request->images)) {
            foreach ($request->images as $pic) {
                $path = 'public/images/slider/images';
                $image = $this->helperController->generateImageFile('', 1990, 650, $path, $pic);
                if (isset($image['error'])) {
                    array_push($image_error, $image['message']);
                } else {
                    $path = 'public/images/slider/thumbnail';
                    $thumb = $this->helperController->generateImageFile('', 150, 150, $path, $pic);
                    $img['image'] = $image;
                    $img['thumbnail'] = $thumb;
                    array_push($images, $img);

                }
            }
            $slider->images = $images;
        }
        if (count($image_error)) {
            return response()->json(['data' => $image_error, "message" => "validation failed.", "status" => "failed"], 403);
        }

        $slider->save();
        return response()->json(['data' => $slider, 'message' => "", 'status' => "success"], 200);

    }
    // public edit slider

    public function editSlider(Request $request, $id)
    {
        // return dd($request->all());
        $validator = Validator::make($request->all(), [

            'name' => "required",
            "new_images.*" => 'mimes:jpeg,jpg,png,gif|max:10000',

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }

        $slider = slider::find($id);
        $slider->name = $request->name;
        $slider->slug = Str::slug($request->name);
        $slider->type = $request->type;
        $slider->created_at = Carbon::now();
        $slider->by_user = $request->user_id;
        $slider->status = $request->status;
        $images = (array) $slider->images;
        $image_error=[];
        if ($request->file('new_images') && count($request->new_images)) {
            foreach ($request->new_images as $pic) {
                $path = 'public/images/slider/images';
                $image = $this->helperController->generateImageFile('', 1960, 620, $path, $pic);
                if (isset($image['error'])) {
                    array_push($image_error, $image['message']);
                } else {
                    $path = 'public/images/slider/thumbnail';
                    $thumb = $this->helperController->generateImageFile('', 150, 150, $path, $pic);
                    $img['image'] = $image;
                    $img['thumbnail'] = $thumb;
                    array_push($images, $img);

                }
            }
            $slider->images = $images;
        }
        if (count($image_error)) {
            return response()->json(['data' => $image_error, "message" => "validation failed.", "status" => "failed"], 403);
        }

        $slider->save();
        return response()->json(['data' => $slider, 'message' => "", 'status' => "success"], 200);

    }

    public function removeGallery(Request $request, $id=null)
    {
        try {   
             $key['image']=$request->image;
             $key['thumbnail']=$request->thumbnail;
   
            $product=slider::findOrfail($id);
             $product ->pull('images',$key);
            //$product->pull('images.thumbnail', $request->thumbnail);
            if (file_exists(base_path($request->image))) {
                unlink(base_path($request->image));
                unlink(base_path($request->thumbnail));
            }
            return response()->json(['data' => [], 'message' => "Image deleted successfully!", 'status' => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }

    }
}
