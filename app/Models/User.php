<?php
namespace App\Models;
use App\Models\customers\bidding;
use App\Models\customers\customerAddress;
use App\Models\customers\customerDefaultAddress;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HybridRelations,HasPermissionsTrait, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\role', 'role_id', 'id');
    }

    public function vendor()
    {
        return $this->hasOne('App\Models\vendors\vendor', 'user_id', 'id');
    }
    // user address

    public function address()
    {

        return $this->hasMany(customerAddress::class)->where;

    }
    public function bidding()
    {
        return $this->hasMany(bidding::class,'user_id');
    }
    public static function defaultAddress($user)
    {
        $userDefualtAddress = customerDefaultAddress::where('customer_id', $user->id)->first();
        $addresss = customerAddress::where('customer_id', $userDefualtAddress->customer_id)->first();
        if ($addresss) {
            return $addresss;
        } else {
            return [];
        }

    }
}
