<?php
namespace App\Helpers;
use App\Models\customer\cart;
use App\Helpers\Helpers;

class addToCart
{
    public static function add($id, $name = null, $price = null, $quantity = null, $attributes = array(), $conditions = array(), $associatedModel = null)
    {
       
        if(is_array($id))
        {
            foreach ($id as $item) {
                $this->add(
                    $item['id'],
                    $item['name'],
                    $item['price'],
                    $item['quantity'],
                    Helpers::issetAndHasValueOrAssignDefault($item['attributes'], array()),
                    Helpers::issetAndHasValueOrAssignDefault($item['conditions'], array()),
                    Helpers::issetAndHasValueOrAssignDefault($item['associatedModel'], null)
                );
            }
        }
        else
        {
           dd($name); 
        }





    }

}
