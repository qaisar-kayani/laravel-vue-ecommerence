<?php

namespace App\Models\customers;

use DB;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Support\Str;

class order extends Model
{

    protected $table = "orders";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'order_date', 'deleted_at'];

    public function orderItems()
    {
        return $this->hasMany(orderItems::class, 'order_id');
    }

    public function orderStatus()
    {
        return $this->hasMany(orderStatus::class, 'order_id');
    }

    public static function getID($name,$prefix='',$month='')
    {
         $updateSequen = DB::connection('mongodb')->getCollection('counters')->findOneAndUpdate(
            ['_id'=>$name],
            ['$inc' => ['seq' => 1]],
            ['new' => true, 'upsert' => true]
        );
        
     $seq=DB::connection('mongodb')->table('counters')->where('_id',$name)->first();
     return 'OR'.date('Y').date('m').date('d')."-".$seq['seq'];
       
    }
    public static function orderFilter($q, $request)
    {   
        
        $sortKey = '';
        $sortValue = '';
        if (isset($request->sort) && !empty($request->sort)) {
            foreach ($request->sort as $sortK => $sortV) {
                if ($sortK == 'rating') {
                    $sortKey = $sortK . '.' . "rate";
                } else {
                    $sortKey = $sortK;
                }
                $sortValue = $sortV;

            }
        } else {
            $sortKey = 'created_at';
            $sortValue = "DESC";
        }
        //return data
        return $q->where(function ($query) use ($request) {

            //   check string attributes

            if (isset($request->filter['general'])) {

                foreach ($request->filter['general'] as $key => $aValue) {

                    if (!is_array($aValue) && gettype($aValue) == 'string') {
                        $query->where($key, 'LIKE', '%' . Str::lower($aValue) . '%');
                    }
                    if (!is_array($aValue) && gettype($aValue) == 'double') {
                        $query->where($key, '=', (double) $aValue);
                    }
                    if (!is_array($aValue) && gettype($aValue) == 'integer') {
                        $query->where($key, '=', (int) $aValue);
                    }

                }
            }

          

        })->orderBy($sortKey, $sortValue)->paginate($request->perPage);
    }

}
