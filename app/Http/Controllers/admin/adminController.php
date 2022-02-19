<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    //

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'email' => "required|email",
            'password' => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), "message" => "data validation failed.", "status" => "failed"], 403);
        }

        $email = trim($request->email);
        $password = $request->password;
        $admin=User::where('email', $email)->first();
        if (!$admin || !$admin->hasRole('admin') || $admin->status!=1) {
            return response()->json(['data' => ["User doesn't exist or disabled."], "message" => "Invalid email or password", "status" => "failed"], 401);
        }

        //  verify password
        if (password_verify($password, $admin->password)) {
            $admin->last_login = Carbon::now();
            $admin->save();
            $data = $admin;
            $data['token'] = $admin->createToken('admin_token', ['*'])->accessToken;
            return response()->json(['data' => $data, "message" => "Signup successfull.", 'status' => "failed"], 200);

        }
        return response()->json(['data' => ["Invalide credentials."], "message" => "Invalid email or password", "status" => "failed"], 401);
    }

    public function signup(Reqquest $request)
    {

    }
}
