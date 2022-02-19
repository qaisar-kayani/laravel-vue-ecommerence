<?php

namespace App\Models\catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class product extends Model
{
    use HasFactory, softDeletes;
    protected $table = "products";
    protected $connection = "mongodb";
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(category::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(brand::class, 'category_id');
    }

    public function vendor()
    {
        return $this->hasMany(vendor::class);
    }

    public function child()
    {
        return $this->hasMany(product::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(product::class);
    }
  
    // product review
    public function review()
    {
        return $this->hasMany(review::class, 'product_id');
    }
   // product Group
   public function group()
   {
    return $this->belongsTo(productGroup::class);
   }    
    public function countRating($ratingStar, $oldRate = null)
    {
        if (isset($this->rating)) {
            $reviewCount = $this->rating['count'] + 1;
        } else {
            $reviewCount = 1;
        }
        if ($oldRate) {
            $reviewCount = $this->rating['count'];
        }

        $rate = $this->review->avg('rate');
        if (!$rate) {
            $rate = $ratingStar;
        }

        $rating['count'] = $reviewCount;
        $rating['rate'] = ceil($rate);
        $this->rating = $rating;
        $this->save();
        return [$reviewCount, $rating['rate'] ];
    }
    public static function scopeFilter($q, $request, $id = null)
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
            $sortKey = 'rating.rate';
            $sortValue = "DESC";
        }
        //return data
        return $q->where(function ($query) use ($request, $id) {

            // if category id set

            if ($id) {
                $query->where('category_id', $id);
            }
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

            // if isset price range
            if (isset($request->filter['priceRange']) && !empty($request->filter['priceRange'])) {
                $query->where([
                    'regular_price' => ['$gt' => $request->priceRange['min'], '$lt' => $request->priceRange['max']],
                ]);
            }
            // if isset product Attributes
            if (isset($request->filter['productAttributes']) && !empty($request->filter['productAttributes'])) {
                foreach ($request->filter['productAttributes'] as $key => $value) {
                    $query->whereIn('productAttributes.' . $key, $value);
                }
            }
            // if ratting is set

            if (isset($request->filter['rating'])) {
                $query->where([
                    'rating.rate' => ['$gte' => $request->rating['min']],
                ]);
            }

        })->orderBy($sortKey, $sortValue)->skip((int) $request->limitStart)->take((int) $request->limitEnd)->get();
    }

    public static function scopeFilterBackend($q, $request)
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

            // if isset price range
            if (isset($request->filter['priceRange']) && !empty($request->filter['priceRange'])) {
                $query->where([
                    'regular_price' => ['$gt' => $request->priceRange['min'], '$lt' => $request->priceRange['max']],
                ]);
            }
            // if isset product Attributes
            if (isset($request->filter['productAttributes']) && !empty($request->filter['productAttributes'])) {
                foreach ($request->filter['productAttributes'] as $key => $value) {
                    $query->whereIn('productAttributes.' . $key, $value);
                }
            }
            // if ratting is set

            if (isset($request->filter['rating'])) {
                $query->where([
                    'rating.rate' => ['$gte' => $request->rating['min']],
                ]);
            }

        })->orderBy($sortKey, $sortValue)->paginate($request->perPage);
    }

}
