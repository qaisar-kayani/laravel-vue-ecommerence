<?php

namespace App\Http\Controllers\catalog;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helpers\helperController;
use App\Models\catalog\category;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class categoryController extends Controller
{
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

        $this->helperController = new helperController();
    }

    function list(Request $request, $id = null) {
        if ($id) {
            $data = category::find($id);
            if ($data) {
                $data['child'] = $data->child;
            }

        } else {
            $data = category::paginate($request->perPage);
        }

        return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);

    }
// add cetegory list

    public function add(Request $request)
    {

        try
        {  
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'seo_title' => "required",
                'details' => "required",
                'seo_description' => 'details',
                'image' => 'mimes:jpeg,jpg,png,gif,svg|max:10000',
                'icon' => 'mimes:jpeg,jpg,png,gif,svg|required|max:200',
            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $category = new category();
            $category->parent_id = ($request->parent_id)?$request->parent_id:null;
            $category->name = $request->name;
            $category->details = $request->details;
            $category->seo_title = $request->seo_title;
            $category->seo_details = $request->seo_details;
            $category->status = 'active';
            $category->seo_keywords = $request->seo_keywords;
            $category->slug = Str::slug($request->name, '-');
            $category->by_user = Auth::user()->id;
            $category->categoryFilter = ($request->categoryFilter)? $request->categoryFilter :[];
            $category->added_date=null;
            $image ='';
            if ($request->file('image')) {
                $path = 'public/images/catalog/category/images';
                $image = $this->helperController->generateImageFile('', 400, 400, $path, $request->file('image'));
                if (!isset($image['error'])) {
                    $category->image = $image;
                    $path = 'public/images/catalog/category/thumbnail';
                    $category->thumbnail = $this->helperController->generateImageFile('', 150, 150, $path, $request->file('image'));
                } else {
                    return response()->json(['data' => [$image['message']], "message" => "validation failed.", "status" => "failed"], 403);
                }

            }
            if ($request->file('icon')) {
                $catId = $category->_id;
                $path = 'public/images/catalog/category/icons';
                $image = $this->helperController->generateImageFile('', 26, 26, $path, $request->file('icon'));
                if (!isset($image['error'])) {
                    $category->icon = $image;
                  
                } else {
                    return response()->json(['data' => [$image['message']], "message" => "validation failed.", "status" => "failed"], 403);
                }

            }

            if ($request->file('bannerImage')) {
                $catId = $category->_id;
                $path = 'public/images/catalog/category/banners';
                $image = $this->helperController->generateImageFile('', 1370, 300, $path, $request->file('bannerImage'));
                if (!isset($image['error'])) {
                    $category->bannerImage = $image;
                  
                } else {
                    return response()->json(['data' => [$image['message']], "message" => "validation failed.", "status" => "failed"], 403);
                }

            }

            $category->save();
            return response()->json(['data' => $category, 'message' => "", 'status' => "success"], 200);

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
                'seo_title' => "required",
                'details' => "required",
                'seo_description' => 'details',

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }

            $category = category::find($id);
            $category->parent_id = ($request->parent_id)? $request->parent_id :[];
            $category->name = $request->name;
            $category->details = $request->details;
            $category->cetegory_seo_title = $request->seo_title;
            $category->seo_details = $request->seo_details;
            $category->seo_keywords = $request->seo_keywords;
            $category->categoryFilter =($request->categoryFilter)? $request->categoryFilter :[];
            // $category->slug=Str::slug($request->name,'-');
            if ($request->file('new_image')) {
                
                $path = 'public/images/catalog/category/images';
                $image = $this->helperController->generateImageFile($category->image, 400, 400, $path, $request->file('new_image'));
                if (!isset($image['error'])) {
                    $category->image = $image;
                    $path = 'public/images/catalog/category/thumbnail';
                    $category->thumbnail = $this->helperController->generateImageFile($category->thumbnail, 150, 150, $path, $request->file('new_image'));
                } else {
                    return response()->json(['data' => [$image['message']], "message" => "validation failed.", "status" => "failed"], 403);
                }

            }
            if ($request->file('new_icon')) {
                $catId = $category->_id;
                $path = 'public/images/catalog/category/icons';
                $image = $this->helperController->generateImageFile($category->icon, 26, 26, $path, $request->file('new_icon'));
                if (!isset($image['error'])) {
                    $category->icon = $image;
                } else {
                    return response()->json(['data' => [$image['message']], "message" => "validation failed.", "status" => "failed"], 403);
                }
                
            }
            if ($request->file('new_bannerImage')) {
                $catId = $category->_id;
                $path = 'public/images/catalog/category/banners';
                $image = $this->helperController->generateImageFile($category->new_bannerImage, 1370, 300, $path, $request->file('new_bannerImage'));
                if (!isset($image['error'])) {
                    $category->bannerImage = $image;
                  
                } else {
                    return response()->json(['data' => [$image['message']], "message" => "validation failed.", "status" => "failed"], 403);
                }

            }
            $category->save();

            return response()->json(['data' => $category, 'message' => "", 'status' => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);
        }

    }

// vendorCategory

    public function allCategories()
    {

        $category = category::select('_id as id', 'name')->where('parent_id', null)->orWhere('parent_id', '')->orWhere('parent_id',[])->get();
        $finalCategory = [];
        foreach ($category as $key => $cat) {
            $finalCategory[$key]['id'] = $cat->_id;
            $finalCategory[$key]['label'] = $cat->name;
            $finalCategory[$key]['children'] = [];

            if (count($cat->child)) {
                $finalCategory[$key]['children'] = [];
                foreach ($cat->child as $firstChildKey => $levelTwo) {
                    $child['id'] = $levelTwo->_id;
                    $child['label'] = $levelTwo->name;
                    array_push($finalCategory[$key]['children'], $child);
                    if ($levelTwo->child) {
                        $finalCategory[$key]['children'][$firstChildKey]['children'] = [];
                        foreach ($levelTwo->child as $secondChildKey => $levelThree) {
                            $child['id'] = $levelThree->_id;
                            $child['label'] = $levelThree->name;
                            array_push($finalCategory[$key]['children'][$firstChildKey]['children'], $child);
                        }}

                }

            }

        }
        return $finalCategory;
    }

}
