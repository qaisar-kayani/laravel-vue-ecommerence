<?php

namespace App\Http\Controllers\catalog;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helpers\helperController;
use App\Models\catalog\category;
use App\Models\catalog\product;
use App\Models\settings\productSettings;
use App\Models\vendors\vendor;
use Auth;
use Carbon\Carbon;
use DateTime;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class productController extends Controller
{
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

        $this->helperController = new helperController();
    }

   public function list(Request $request, $id = null) {
    //    dd($request->all());
// $searchTerm ='baby';
// $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
// $searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);
// $searchValues = preg_split('/\s+/', $searchTerm, -1, PREG_SPLIT_NO_EMPTY);

// $data = product::where(function ($q) use ($searchValues) {
//     foreach ($searchValues as $value) {
//     $q->orWhere('name', 'like', "%{$value}%");
//     $q->orWhere('type', 'like', "%{$value}%");
//     $q->orWhere('details','like',"%{$value}%");
//     $q->orWhere('regluar_price','like',"%{$value}%");
//     }
// })->paginate($request->perPage);
// return $data;
        $data = [];
        if ($id) {
            $data = product::find($id);
        } else {
                $product=product::query();
                $data = product::scopeFilterBackend($product, $request);
        }
    
        return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);

    }
    public function unGroup(Request $request)
    {
        //    return product::where('name', 'like', '/.*'.$request->name.'/i')->where('group_id','=',null)->get();
        $projections = ['id', 'feature_image'];
        $product= product::query();
        $product->project(['product_id' => '$_id',"_id"=>0]);
        $product->select('_id','name', 'thumbnail','vendor_id','regular_price','sale_price')->where('group_id', 'exists', false)->orwhere('group_id','')->orwhere('group_id',null);
        if($request->name){

            $product->whereRaw(array('$text' => array('$search' => Str::lower($request->name))));
        }
  
        return $product->paginate($request->perPage);

    }
// add-product-list
    public function add(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [

                'name' => "required",
                'category_id' => "required",
                'summary' => "required",
                'details' => "required",
                'seo_title' => 'required',
                'seo_details' => "required",
                'seo_keywords' => "required",
                'feature_image' => 'mimes:jpeg,jpg,png,gif|max:10000',
                "gallery.*" => 'mimes:jpeg,jpg,png,gif|max:10000',

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
            }
            $productSettings = productSettings::first();
            $product = new product();
            $product->parent_id = ($request->parent_id) ? $request->parent_id : [];
            $product->category_id = $request->category_id;
            $product->vendor_id = (int) $request->vendor_id;
            $product->name = strtolower($request->name);
            $product->status = strtolower($request->status);
            $product->type = $request->type;
            $product->details = strtolower($request->details);
            $product->summary = strtolower($request->summary);
            $product->seo_title = $request->seo_title;
            $product->seo_details = $request->seo_details;
            $product->seo_keywords = $request->seo_keywords;
            $product->slug = Str::slug(strtolower($request->name), '-');
            $product->regular_price = (double) $request->regular_price;
            $product->sale_price = (double) $request->sale_price;
            $product->sku = $request->sku;
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->manage_stock = $request->manage_stock;
            $product->stock_status = $request->stock_status;
            $product->tags = ($request->tags) ? $request->tags : [];
            $product->productAttributes = ($request->productAttributes) ? json_decode($request->productAttributes, true) : [];
            $product->visibility = $request->visibility;
            $product->created_at = new \MongoDB\BSON\UTCDateTime(new DateTime(date('Y-m-d')));
            if (isset($request->schedule_date)) {
                $product->schedule_date = carbon::createFromFormat('Y-m-d', $request->schedule_date);
            } else {
                $product->schedule_date = null;
            }

            $shipping['weight'] = null;
            $shipping['width'] = null;
            $shipping['height'] = null;
            $shipping['class'] = [];
            $product->shipping = $shipping;
            $product->related_products = [];
            $product->tax_rule = [];
            $product->by_user = Auth::user()->id;
            $product->created_at = Carbon::now();
            $rating['rate'] = 0;
            $rating['count'] = 0;
            $product->rating = $rating;
            $gallery_images = [];
            $image_error = [];
            if ($request->feature_image) {
                $path = 'public/images/catalog/product/images/feature';
                $image = $this->helperController->generateImageFile('', $productSettings->image['height'], $productSettings->image['width'], $path, $request->feature_image);
                if (!isset($image['error'])) {
                    $product->feature_image = $image;
                    $path = 'public/images/catalog/product/thumbnail';
                    $product->thumbnail = $this->helperController->generateImageFile('', $productSettings->thumbnail['height'], $productSettings->thumbnail['width'], $path, $request->feature_image);
                } else {
                    array_push($image_error, $image['message']);
                }

            }
            if ($request->gallery && count($request->gallery)) {
                foreach ($request->gallery as $pic) {
                    $path = 'public/images/catalog/product/gallery/images';
                    $image = $this->helperController->generateImageFile('', 400, 400, $path, $pic);
                    if (isset($image['error'])) {
                        array_push($image_error, $image['message']);
                    } else {
                        $path = 'public/images/catalog/product/gallery/thumbnail';
                        $thumb = $this->helperController->generateImageFile('', 150, 150, $path, $pic);
                        $glr['image'] = $image;
                        $glr['thumbnail'] = $thumb;
                        array_push($gallery_images, $glr);

                    }
                }

                $product->gallery = $gallery_images;

            }
            if (count($image_error)) {
                return response()->json(['data' => $image_error, "message" => "validation failed.", "status" => "failed"], 403);
            }
            $product->save();
            return response()->json(['data' => $product, 'message' => "", 'status' => "success"], 200);
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
                'category_id' => "required",
                'summary' => "required",
                'details' => "required",
                'seo_title' => 'required',
                'seo_details' => "required",
                'seo_keywords' => "required",
                'new_feature_image' => 'mimes:jpeg,jpg,png,gif|max:10000',
                "new_gallery.*" => 'mimes:jpeg,jpg,png,gif|max:10000',

            ]);

            $productSettings = productSettings::first();
            $product = product::findOrfail($id);
            $product->parent_id = ($request->parent_id) ? $request->parent_id : [];
            $product->category_id = $request->category_id;
            $product->vendor_id = $request->vendor_id;
            $product->name = Str::lower($request->name);
            $product->type = $request->type;
            $product->details = Str::lower($request->details);
            $product->summary = Str::lower($request->summary);
            $product->seo_title = $request->seo_title;
            $product->seo_details = $request->seo_details;
            $product->seo_keywords = $request->seo_keywords;
            $product->slug = Str::slug($request->name, '-');
            $product->regular_price = (double) $request->regular_price;
            $product->sale_price = (double) $request->sale_price;
            $product->sku = $request->sku;
            $product->stock = $request->stock;
            $product->manage_stock = $request->manage_stock;
            $product->stock_status = $request->stock_status;
            $product->status = strtolower($request->status);
            $product->tags = ($request->tags) ? $request->tags : [];
            $shipping['weight'] = null;
            $shipping['width'] = null;
            $shipping['height'] = null;
            $shipping['class'] = [];
            $product->shipping = $shipping;
            $product->related_products = [];
            $product->tax_rule = [];
            $product->by_user = Auth::user()->id;
            // $product->productAttributes = ($request->productAttributes) ?  json_decode($request->productAttributes, true) : [];
            $gallery_images = (array) $product->gallery;
            $image_error = [];
            if ($request->file('new_feature_image')) {

                $path = 'public/images/catalog/product/images/feature';
                $image = $this->helperController->generateImageFile($product->feature_image, $productSettings->image['height'], $productSettings->image['width'], $path, $request->file('new_feature_image'));
                if (!isset($image['error'])) {
                    $product->feature_image = $image;
                    $path = 'public/images/catalog/product/images/thumbnail';
                    $product->thumbnail = $this->helperController->generateImageFile($product->thumbnail, $productSettings->thumbnail['height'], $productSettings->thumbnail['width'], $path, $request->file('new_feature_image'));
                } else {
                    array_push($image_error, $image['message']);
                }

            }
            if ($request->file('new_gallery') && count($request->new_gallery)) {
                foreach ($request->new_gallery as $pic) {
                    $path = 'public/images/catalog/product/images/gallery';
                    $image = $this->helperController->generateImageFile('', $productSettings->image['height'], $productSettings->image['width'], $path, $pic);
                    if (isset($image['error'])) {
                        array_push($image_error, $image['message']);
                    } else {
                        $path = 'public/images/catalog/product/gallery/thumbnail';
                        $thumb = $this->helperController->generateImageFile('', 150, 150, $path, $pic);
                        $glr['image'] = $image;
                        $glr['thumbnail'] = $thumb;
                        array_push($gallery_images, $glr);
                    }
                }

                $product->gallery = $gallery_images;
            }
            if (count($image_error)) {
                return response()->json(['data' => $image_error, "message" => "validation failed.", "status" => "failed"], 403);
            }
            $product->save();
            return response()->json(['data' => $product, 'message' => "", 'status' => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }

    }

    //

// delete product

    public function delete($id)
    {
        product::find($id)->delete();
        return response()->json(['data' => ['delete'], 'message' => "", 'status' => "success"], 200);
    }

//  remove product gallery

    public function removeGallery(Request $request, $id = null)
    {

        try {
            $key['image'] = $request->image;
            $key['thumbnail'] = $request->thumbnail;
            $product = product::findOrfail($id);
            $product->pull('gallery', $key);
            if (file_exists(base_path($request->image))) {

                unlink(base_path($request->image));
                unlink(base_path($request->thumbnail));
            }
            return response()->json(['data' => [], 'message' => "Image deleted successfully!", 'status' => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => ['oops! something went wrong'], 'message' => "", 'status' => "failed"], 500);

        }

    }
// generat combination

    public function productAttributes(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'pattributes' => "required",

        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }

        $pattributes = (array) $request->pattributes;

        $product = product::findOrfail($id);
        $varriations = [];
        $ar = $pattributes;
        $counts = array_map("count", $ar);
        $total = array_product($counts);
        $res = [];
        $name = $product->name;
        $generateName = '';
        $combinations = [];
        $curCombs = $total;

        foreach ($ar as $field => $vals) {
            $curCombs = $curCombs / $counts[$field];
            $combinations[$field] = $curCombs;
        }

        for ($i = 0; $i < $total; $i++) {
            $generateName = '';
            $res[$i]['parent_id'] = $id;
            $res[$i]['details'] = $product->details;
            $res[$i]['summary'] = $product->summary;
            $res[$i]['seo_title'] = $product->seo_title;
            $res[$i]['seo_details'] = $product->seo_details;
            $res[$i]['seo_keywords'] = $product->seo_keywords;
            $res[$i]['category_id'] = $product->category_id;
            $res[$i]['type'] = "configurable";
            $res[$i]['vendor_id'] = $product->vendor_id;
            $res[$i]['slug'] = "";
            $res[$i]['regular_price'] = 0.00;
            $res[$i]['sale_price'] = 0.00;
            $res[$i]['sku'] = $product->sku . '-variants-' . $i;
            $res[$i]['manage_stock'] = '';
            $res[$i]['stock'] = 1;
            $res[$i]['stock_status'] = '';
            $res[$i]['status'] = '';
            $res[$i]['tags'] = '';
            $shipping['weight'] = null;
            $shipping['width'] = null;
            $shipping['height'] = null;
            $shipping['class'] = [];
            $res[$i]['shipping'] = $shipping;
            $res[$i]['related_products'] = '';
            $res[$i]['tax_rule'] = [];
            $res[$i]['by_user'] = Auth::user()->id;
            $res[$i]['gallery'] = [];
            $res[$i]['feature_image'] = [];

            foreach ($ar as $field => $vals) {
                $generateName = $generateName . '-' . $vals[($i / $combinations[$field]) % $counts[$field]];
                $res[$i]['productAttributes'][$field] = $vals[($i / $combinations[$field]) % $counts[$field]];

            }
            $res[$i]['name'] = $name . " " . $generateName;
        }
        return $res;
    }

    public function saveProductAttributes(Request $request)
    {

    }

    public function saveFakeproduct(Request $request)
    {

        $productSettings = productSettings::first();

        $catid = '';
        foreach ($request->all() as $pd) {
            $category = category::where('name', Str::lower($pd['category']))->first();
            if ($category) {
                $catid = $category->id;
            } else {
                $category = new category();
                $category->parent_id = [];
                $category->name = Str::lower($pd['category']);
                $category->details = '';
                $category->seo_title = '';
                $category->seo_details = '';
                $category->status = 'active';
                $category->seo_keywords = '';
                $category->slug = Str::slug(Str::lower($pd['category']), '-');
                $category->by_user = Auth::user()->id;
                if ($pd['image']) {

                    $url = $pd['image'];
                    $path = 'public/images/catalog/category/images';
                    $folderPath = base_path($path);
                    File::isDirectory($folderPath) or File::makeDirectory($folderPath, 755, true, true);

                    $filename = basename($url);
                    $img = Image::make($url);
                    $img->resize(600, 600, function ($constraint) {
                        //$constraint->aspectRatio();
                    })->save($folderPath . '/' . $filename);
                    $category->image = $path . '/' . $filename;

                    $path = 'public/images/catalog/category/images/thumbnail';
                    $folderPath = base_path($path);
                    File::isDirectory($folderPath) or File::makeDirectory($folderPath, 755, true, true);
                    $img = Image::make($url);
                    $img->resize(150, 150, function ($constraint) {
                        //$constraint->aspectRatio();
                    })->save($folderPath . '/' . $filename);
                    $category->thumbnail = $path . '/' . $filename;

                }
                $category->categoryFilter = [];
                $category->save();
                $catid = $category->id;
            }
            $product = new product;
            $product->parent_id = null;
            $catIDs = [];
            array_push($catIDs, $catid);
            $product->category_id = $catIDs;
            $product->vendor_id = 4;
            $product->name = Str::lower($pd['title']);
            $product->type = 'simple';
            $product->details = Str::lower($pd['description']);
            $product->summary = '';
            $product->seo_title = $pd['title'];
            $product->seo_details = $pd['description'];
            $product->seo_keywords = '';
            $product->slug = Str::slug($pd['title'], '-');
            $product->regular_price = (double) $pd['price'];
            $product->sale_price = 0.00;
            $product->sku = $pd['id'];
            $product->stock = 40;
            $product->manage_stock = true;
            $product->stock_status = true;
            $product->status = 'active';
            $product->tags = ($request->tags) ? $request->tags : [];
            $shipping['weight'] = null;
            $shipping['width'] = null;
            $shipping['height'] = null;
            $shipping['class'] = [];
            $product->shipping = $shipping;
            $product->related_products = [];
            $product->tax_rule = [];
            // $rating['rate']=0;
            // $rating['count']=0;
            $product->rating = $pd['rating'];
            $product->by_user = Auth::user()->id;
            $gallery_images = [];
            $image_error = [];
            if ($pd['image']) {

                $url = $pd['image'];
                $path = 'public/images/catalog/product/images/feature';
                $folderPath = base_path($path);
                File::isDirectory($folderPath) or File::makeDirectory($folderPath, 755, true, true);

                $filename = basename($url);
                $img = Image::make($url);
                $img->resize(600, 600, function ($constraint) {
                    //$constraint->aspectRatio();
                })->save($folderPath . '/' . $filename);
                $product->feature_image = $path . '/' . $filename;

                $path = 'public/images/catalog/product/images/thumbnail';
                $folderPath = base_path($path);
                File::isDirectory($folderPath) or File::makeDirectory($folderPath, 755, true, true);
                $img = Image::make($url);
                $img->resize(150, 150, function ($constraint) {
                    //$constraint->aspectRatio();
                })->save($folderPath . '/' . $filename);
                $product->thumbnail = $path . '/' . $filename;

            }
            $product->save();
        }
    }
}
