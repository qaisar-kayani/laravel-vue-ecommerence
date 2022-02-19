<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helpers\helperController;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class customerController extends Controller
{

    //use App\Http\Controllers\helpers\helperController;
    protected $helperController;

    public function __construct(helperController $helperController)
    {

        $this->helperController = new helperController();
    }
    public function list(Request $request, $id = null) {
        if ($id) {
            $data = User::where('role','customer')->findOrFail($id);
            return User::defaultAddress($data);
        } else {

            $data = User::where('role','customer')->paginate($request->perPage);
        }

        return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);
    }
    // customer login
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
        $userObj = User::where('email', $email)->first();
        if (!$userObj || !$userObj->hasRole('customer') || $userObj->status != 1) {
            return response()->json(['data' => ["User doesn't exist or disabled."], "message" => "User doesn't exist or disabled. ", "status" => "failed"], 401);
        }
        //  verify password
        if (password_verify($password, $userObj->password)) {
            $userObj->last_login = Carbon::now();
            $userObj->save();
            $data = $userObj;
            $data['token'] = $userObj->createToken('token', ['customer'])->accessToken;
            return response()->json(['data' => $data, "message" => "signup successfull.", 'status' => "failed"], 200);
        }
        return response()->json(['data' => ["Invalide credentials."], "message" => "data validation failed", "status" => "failed"], 401);
    }
    // signup customer
    public function signup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'country_code' => 'required',
            'country' => "required",
            "password" => "required|confirmed|min:6",
            "email" => 'required|unique:users|email',
            "mobile" => "phone:" . $request->country_code,
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
        }
        $userObj = new User();
        $userObj->first_name = strtolower($request->first_name);
        $userObj->last_name = strtolower($request->first_name);
        $userObj->email = strtolower(trim($request->email));
        $userObj->password = Hash::make($request->password);
        $userObj->country_code = $request->country_code;
        $userObj->country = $request->country;
        $userObj->mobile_normalized = preg_replace('[^0-9]', '', $request->mobile);
        $userObj->mobile_national = preg_replace('[^0-9]', '', phone($request->mobile, $request->country_code)->formatNational());
        $userObj->mobile_e164 = phone($request->mobile, $request->country_code)->formatE164();
        $userObj->mobile = phone($request->mobile, $request->country_code)->formatE164();
        $userObj->status = 1;
        $userObj->role = 'customer';
        $userObj->created_at = date('Y-m-d H:i:s');
        if ($userObj->save()) {
            $role = Role::where('slug', 'customer')->first();
            $userObj->roles()->attach($role);
            $data = $userObj;
            $data['token'] = $userObj->createToken('customer_token', ['customer'])->accessToken;
            return response()->json(['data' => $data, "message" => "Signedup successfull.", 'status' => "success"], 200);
        }

    }
// add customer
    public function add(Request $request)
    {
        try
        {
            // validate request
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'country_code' => 'required',
                'country' => "required",
                "email" => 'required|unique:users|email',
                "mobile" => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
            }

            //
            $customerObj = new User();
            $userObj->first_name = $request->first_name;
            $userObj->last_name = $request->first_name;
            $userObj->email = $request->email;
            if ($request->generateCred) {
                $userObj->password = Hash::make($request->password);
            }
            $userObj->country_code = $request->country_code;
            $userObj->country = $request->country;
            $userObj->mobile_normalized = preg_replace('[^0-9]', '', $request->mobile);
            $userObj->mobile_national = preg_replace('[^0-9]', '', phone($request->mobile, $request->country_code)->formatNational());
            $userObj->mobile_e164 = phone($request->mobile, $request->country_code)->formatE164();
            $userObj->mobile = phone($request->mobile, $request->country_code)->formatE164();
            $userObj->status = 0;
            $userObj->created_at = date('Y-m-d H:i:s');
            $customerObj->created_at = date('Y-m-d H:i:s');
            if ($customerObj->save()) {
                $customerid = $customerObj->id;
                if ($request->file('profile')) {
                    $path = 'images/customer/' . $customerid . '/profile';
                    $customerAsset['profile'] = $this->helperController->generateImage('', 150, 150, $path, $request->file('profile'));
                    $path = 'images/customer/' . $customerid . '/thumbnail';
                    $customerAsset['thumbnail'] = $this->helperController->generateImage('', 50, 50, $path, $request->file('profile'));

                } else {
                    $customerAsset['profile'] = "";
                    $customerAsset['thumbnail'] = "";
                }
                // save thumbnail
                if ($customerAsset) {
                    User::where('id', $customerid)->update($customerAsset);
                }
                return response()->json(['data' => $customerObj, 'message' => "customer has been created successfuly.", 'status' => "success"], 200);
            } else {
                return response()->json(['data' => $validator, 'message' => "customer can not be created.", 'status' => "failed"], 500);
            }

        } catch (Exception $e) {
            return response()->json(['data' => [], 'message' => "oops! Something went wrong.", 'status' => "failed"], 500);
        }
    }

// edit customer

    public function edit(Request $request, $id)
    {

        try
        {
            // validate request
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                "email" => 'required|email',
                "mobile" => 'required',
                "country_code" => "required",
                "country" => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
            }

            $customerObj = User::findOrFail($id);
            $customerObj->first_name = $request->first_name;
            $customerObj->last_name = $request->last_name;
            $customerObj->country_code = $request->country_code;
            $customerObj->country = $request->country;
            $customerObj->mobile_normalized = preg_replace('[^0-9]', '', $request->mobile);
            $customerObj->mobile_national = preg_replace('[^0-9]', '', phone($request->mobile, $request->country_code)->formatNational());
            $customerObj->mobile_e164 = phone($request->mobile, $request->country_code)->formatE164();
            $customerObj->mobile = phone($request->mobile, $request->country_code)->formatE164();
            $customerAsset = [];
            //$customerObj->status =1;
            $customerObj->updated_at = date('Y-m-d H:i:s');
            if ($customerObj->save()) {
                $customerid = $customerObj->id;
                if ($request->file("new_profile_photo")) {
                    $path = 'images/customer/' . $customerid . '/profile';
                    $customerAsset['profile_photo'] = $this->helperController->generateImage($customerObj->profile_photo, 150, 150, $path, $request->file("new_profile_photo"));
                    $path = 'images/customer/' . $customerid . '/thumbnail';
                    $customerAsset['thumbnail'] = $this->helperController->generateImage($customerObj->thumbnail, 50, 50, $path, $request->new_thumbnail);
                }
                if ($customerAsset) {
                    User::where('id', $customerid)->update($customerAsset);
                }

                return response()->json(['data' => $customerObj, 'message' => "Customer Profile has been updated successfuly.", 'status' => "success"], 200);
            } else {
                return response()->json(['data' => $validator, 'message' => "Customer can not be updated.", 'status' => "failed"], 500);
            }

        } catch (Exception $e) {
            return response()->json(['data' => [], 'message' => "oops! Something went wrong.", 'status' => "failed"], 500);
        }
    }

}
