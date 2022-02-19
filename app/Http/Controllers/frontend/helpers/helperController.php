<?php

namespace App\Http\Controllers\frontend\helpers;

use App\Http\Controllers\Controller;
use App\Models\catalog\category;
class helperController extends Controller
{
    //

    public function categoryHierachy($category)
    {   
       
        if (!$category->parent_id) {
            $category =category::where('_id',$category->_id)->get();
        } else if ($category->parent_id) {
            $category=category::whereIn('_id',$category->parent_id)->get();
         
         }

         foreach ($category as $key => $cat) {
            $finalCategory[$key]['id'] = $cat->_id;
            $finalCategory[$key]['label'] = $cat->name;
            $finalCategory[$key]['slug'] = $cat->slug;
            $finalCategory[$key]['children'] = [];
           
            if (count($cat->child)) {
                $finalCategory[$key]['children'] = [];
                foreach ($cat->child as $firstChildKey => $levelTwo) {
                    $child['id'] = $levelTwo->_id;
                    $child['label'] = $levelTwo->name;
                    $child['slug'] = $levelTwo->slug;
                    array_push($finalCategory[$key]['children'], $child);
                    if ($levelTwo->child) {
                        $finalCategory[$key]['children'][$firstChildKey]['children'] = [];
                        foreach ($levelTwo->child as $secondChildKey => $levelThree) {
                            $child['id'] = $levelThree->_id;
                            $child['label'] = $levelThree->name;
                            $child['slug'] = $levelThree->slug;
                            array_push($finalCategory[$key]['children'][$firstChildKey]['children'], $child);
                        }}

                }

            }

        }
        return $finalCategory;
    }

}
