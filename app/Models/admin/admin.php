<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class admin extends Authenticatable
{
    use HasApiTokens, Notifiable,HasRoles;

    protected $table="admin";
    protected $primaryKey ="id";
    protected $fillable = [
        'admin_first_name',
        'admin_last_name',
        'admin_email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
