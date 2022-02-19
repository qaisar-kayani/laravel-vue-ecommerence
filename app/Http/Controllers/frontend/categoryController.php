<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\frontend\helpers\helperController;
use App\Models\catalog\attribute;
use App\Models\catalog\category;
use App\Models\catalog\product;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Query\Builder;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Regex;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Driver\Cursor;
use Carbon\Carbon;
use DateTime;
class categoryController extends Controller
{
    //
    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

     $this->helperController = new helperController();
 }
    public function productListView(Request $request,$slug)
    {  
       $filter =$request->filter??[];
       $category = category::where('slug', $slug)->first();
        if ($category) {
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle($category->seo_title)
                ->setKeywords($category->see_Keywords)
                ->setDescription($category->seo_description);
            return view('frontend.pages.catalog.category-product', compact('category','filter'));
        }

    }

    public function productListAPi(Request $request, $id = null)
    {
    //      $dateBegin = new \MongoDB\BSON\UTCDateTime(new DateTime(date('2022-01-09')));
    //      $dateEnd                = new \MongoDB\BSON\UTCDateTime(new DateTime(date('Y-m-d')));
    
        $product = new product;
        $result = product::scopeFilter($product, $request, $id);
        return response()->json($result, 200);

    }

    public function categoryFilter(Request $request, $id = null)
    {
        $category = category::findOrfail($id);
        $categoryFilter = [];
        $categoryFilter['categories'] = $this->helperController->categoryHierachy($category);
        $categoryFilter['priceRange']['min'] = $category->product->min('regular_price');
        $categoryFilter['priceRange']['max'] = $category->product->max('regular_price');
        if ($category->categoryFilter) {
            $attribute = attribute::select('name', 'code', 'status')->with('attributeValues')->whereIn('_id', $category->categoryFilter)->get();
            $attribute = $attribute->toArray();
            foreach ($attribute as $aKey => $a) {

                foreach ($a['attribute_values'] as $aValuekey => $aValue) {
                    $categoryFilter['attribute'][$a['code']][$aValue['code']] = $aValue['code'];

                }
            }
        }
        return $categoryFilter;

    }

    // home page

    public function shopByCategory(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : 10;
        $category = category::where('status', 'active')->limit($limit)->get();
        return $category;
    }
    //

    public function bestSeller($id)
    {
      return '<div class="ltabs-items-inner ltabs-slider">
      <div class="ltabs-item">
          <div class="item-inner product-layout transition product-grid">
              <div class="product-item-container">
                  <div class="left-block">
                      <div class="product-image-container second_img">
                          <a href="product.html" target="_self" title="Ribeye hamhock">
                              <img src="image/catalog/demo/product/270/7.jpg" class="img-1 img-responsive" alt="image">
                              <img src="image/catalog/demo/product/270/6.jpg" class="img-2 img-responsive" alt="image">
                          </a>
                      </div>
                      <div class="box-label"> <span class="label-product label-sale"> -7% </span></div>
                     
                  </div>
                  <div class="right-block">
                      <div class="caption">
                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                          </div>
                          <h4><a href="product.html" title="Ribeye hamhock" target="_self">Ribeye hamhock</a></h4>
                          <div class="price"> <span class="price-new">$65.00</span>
                              <span class="price-old">$70.00</span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="item-inner product-layout transition product-grid">
              <div class="product-item-container">
                  <div class="left-block">
                      <div class="product-image-container second_img">
                          <a href="product.html" target="_self" title="Wamboudin ribeye">
                              <img src="image/catalog/demo/product/270/8.jpg" class="img-1 img-responsive" alt="image">
                              <img src="image/catalog/demo/product/270/5.jpg" class="img-2 img-responsive" alt="image">
                          </a>
                      </div>
                      
                    
                  </div>
                  <div class="right-block">
                      <div class="caption">
                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                              <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                          </div>
                          <h4><a href="product.html" title="Wamboudin ribeye" target="_self">Wamboudin ribeye</a></h4>
                          <div class="price">$63.00</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
     
      
      
  </div>';
    }

}
