<?php

namespace App\Models\customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class customer  extends Authenticatable
{
    use HasApiTokens, Notifiable,HasRoles;
     
    protected $table="users";
    protected $primaryKey ="id";
    protected $fillable = [
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'password',
    ];
   protected $hidden = [
        'password',
        'remember_token',
    ];

    
}
