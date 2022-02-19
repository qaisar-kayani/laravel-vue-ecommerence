<?php

namespace App\Http\Controllers\frontend\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\catalog\category;
class homeController extends Controller
{
    //

    public function shopByCategory()
    {
        return category::orderby('created_at','DESC')->limit(20)->get();
        
    }
}
