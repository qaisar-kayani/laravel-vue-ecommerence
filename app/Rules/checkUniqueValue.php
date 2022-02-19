<?php

namespace App\Rules;

use DB;
use Illuminate\Contracts\Validation\Rule;

class checkUniqueValue implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $collection = '';
    private $message = "";
    public $id ;
    public function __construct($collection,$id=null)
    {
        //
    
        $this->collection = $collection;
        $this->id=$id;
      
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
       
        if($this->id)
        $count = DB::connection('mongodb')->collection($this->collection)->where($attribute, strtolower($value))->where('_id','!=',$this->id)->count();
        else
        $count = DB::connection('mongodb')->collection($this->collection)->where($attribute, strtolower($value))->count();
        if ($count) {
         return false;
        } else {
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "attribute already exists";
    }
}
