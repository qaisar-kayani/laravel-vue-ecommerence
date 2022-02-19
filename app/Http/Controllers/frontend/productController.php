<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\catalog\product;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;

class productController extends Controller
{
    // load view

    public function singleProductView($slug, $id)
    {
        $product = product::with('category')->find($id);
         dd($product);
        if ($product) {
            Meta::setTitleSeparator('->')
                ->setTitle('Price Driller')
                ->prependTitle($product->seo_title)
                ->setKeywords($product->see_Keywords)
                ->setDescription($product->seo_description);
            return view('frontend.pages.catalog.single-product', compact('product'));
        }

    }
    // api
    function list($slug, $id = null) {

        $returnProduct = [];
        $parent_product = [];
        $attributeGroup = [];
        $returnProduct['attributeList'] = [];
        $returnProduct['attributeGroup'] = [];
        $product = product::findOrfail($id);
        if ($product->type == "configurable") {
            if ($product->parent_id) {
                $parent_product = product::find($product->parent_id);
                $returnProduct = $product;
            } else {
                $parent_product = $product;
                $returnProduct = $parent_product->child->first();

            }
            $parentProductAttributes = [];
            if(isset($parent_product->child)){
            foreach ($parent_product->child as $key => $child) {
                //  return $child->_id;
                $attributes = (array) $child->productAttributes;
                if (!array_key_exists($child->_id, $attributeGroup)) {
                    $attributeGroup[$child->_id] = $attributes;
                }

                foreach ($attributes as $akey => $avalue) {
                    if (!array_key_exists($akey, $parentProductAttributes)) {
                        $parentProductAttributes[$akey][] = $avalue;
                    }
                    if (!in_array($avalue, $parentProductAttributes[$akey])) {
                        $parentProductAttributes[$akey][] = $avalue;
                    }

                }

            }
         }

            $returnProduct['attributeList'] = $parentProductAttributes;
            $returnProduct['attributeGroup'] = $attributeGroup;
        } else {
            $returnProduct = $product;
        }

        Meta::setTitleSeparator('->')
            ->setTitle('Price Driller')
            ->prependTitle($returnProduct->seo_title)
            ->setKeywords($returnProduct->see_Keywords)
            ->setDescription($returnProduct->seo_description);
          
        return view('frontend.pages.catalog.single-product', compact('returnProduct'));

    }
    public function relateProduct($id)
    {
        $product = product::findOrfail($id);
        return product::select('category_id', 'name', 'slug', 'feature_image', 'thumbnail')->where('_id', '!=', $id)->where(['category_id'=>$product->category_id,'status'=>'active'])->orderBy('created_at', 'DESC')->limit(10)->get();
    }
    // best seller
    public function bestSeller(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : 10;
        return product::groupBy('name')
            ->get(['sku', 'name']);
    }
    public function newArrival(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : 10;
        return product::where('bages', 'new_arrival')->limit($limit)->get();
    }
    public function mostRating(Request $request)
    {
        $limit = ($request->limit) ? $request->limit : 10;
        return product::where('rating.rate', '>', 3.5)->limit($limit)->get();
    }
    

}
