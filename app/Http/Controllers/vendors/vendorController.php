<?php

namespace App\Http\Controllers\vendors;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helpers\helperController;
use App\Models\Role;
use App\Models\User;
use App\Models\vendors\vendor;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class vendorController extends Controller
{
    protected $helperController;
    public function __construct(helperController $helperController)
    {
        $this->helperController = new helperController();
    }
    // get all vendor
    function list(Request $request, $id = null) {
        if ($id) {
            $data = vendor::find($id);
        } else {
            $data = vendor::paginate($request->perPage);
        }

        return response()->json(['data' => $data, 'message' => "", 'status' => "success"], 200);
    }
    // vendor login
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
        $user = User::where('email',$email)->with('vendor')->first();
        if (!$user || !$user->hasRole('vendor') || $user->vendor->status != 'active') {
            return response()->json(['data' => ["User doesn't exist or disabled"], "message" => "User doesn't exist or disabled", "status" => "failed"], 401);
        }
        //  verify password
        if (password_verify($password, $user->password)) {
            $user->last_login = Carbon::now();
            $user->save();
            $data = $user;
            $data['vendor'] = $user->vendor;
            $data['token'] = $user->createToken('vendor_token', ['vendor'])->accessToken;
            return response()->json(['data' => $data, "message" => "loggedin successfull.", 'status' => "success"], 200);

        }
        return response()->json(['data' => ["Invalide credentials."], "message" => "data validation failed", "status" => "failed"], 401);
    }

    // singup vendor
    public function signup(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'country_code' => 'required',
                'country' => "required",
                "password" => "required|confirmed|min:6",
                "email" => 'required|unique:users|email',
                "mobile" => "required",
                'shop_unique_name' => 'required',
                'shop_name' => 'required',
                "business_email" => 'required|email',
                "office_phone" => 'required',

                'trade_license' => 'required| mimes:pdf,docx,jpeg,jpg,png|max:10000',
                'license_number' => 'required',
                'vat_certificate' => 'required| mimes:pdf,docx,jpeg,jpg,png|max:10000',
                'vat_number' => 'required',
                "license_expiry" => "required|date",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
            }
            // add-user
            $userObj = new User();
            $userObj->first_name = $request->first_name;
            $userObj->last_name = $request->last_name;
            if (isset($request->isSame_email) && $request->isSame_email) {
                $userObj->email = $request->business_email;
            } else {
                $userObj->email = trim($request->email);
            }
            $userObj->password = Hash::make($request->password);
            $userObj->phone = $request->office_phone;
            $userObj->status=0;
            $userObj->country_code = $request->country_code;
            $userObj->mobile = $request->mobile;
            $userObj->role = "vendor";
            $userObj->status = 1;
            // add-vendor
            $vendorObj = new vendor();
            $vendorObj->shop_name = $request->shop_name;
            $vendorObj->shop_unique_name = $request->shop_unique_name;
            $vendorObj->shop_slug = Str::slug($request->shop_name, '-');
            $vendorObj->business_email = $request->business_email;
            $vendorObj->shop_address = $request->shop_address;
            $vendorObj->zip = $request->zip;
            $vendorObj->city = $request->city;
            $vendorObj->country_code = $request->country_code;
            $vendorObj->country = $request->country;
           
            $vendorObj->created_at = date('Y-m-d H:i:s');

            if ($request->file('shop_logo')) {
                $path = 'public/images/vendors/logo';

                $file = $this->helperController->generateImageFile('', 150, 150, $path, $request->file('shop_logo'));
                if (!isset($file['error'])) {
                    $vendorObj->shop_logo = $file;
                    $vendorObj->thumbnail = $this->helperController->generateImageFile('', 50, 50, $path, $request->file('shop_logo'));
                } else {
                    return response()->json(['data' =>'', 'message' => $file['message'], 'status' => "failed"], 403);
                }

            }
            if ($request->file('trade_license')) {
                $path = 'docs/vendors/trade_license';

                $file = $this->helperController->generateFile('', '', '', $path, $request->file('trade_license'));
                if (!isset($file['error'])) {
                    $vendorObj->trade_license = $file;
                   
                } else {
                    return response()->json(['data' =>'', 'message' => $file['message'], 'status' => "failed"], 403);
                }

            }
            if ($request->file('vat_certificate')) {
                $path = 'docs/vendors/vat_certificate';

                $file = $this->helperController->generateFile('', '', '', $path, $request->file('vat_certificate'));
                if (!isset($file['error'])) {
                    $vendorObj->vat_certificate = $file;
                   
                } else {
                    return response()->json(['data' =>'', 'message' => $file['message'], 'status' => "failed"], 403);
                }

            }
            
            $vendorObj->license_number = $request->license_number;
            $vendorObj->license_expiry = date('Y-m-d',strtotime($request->license_expiry));
            $vendorObj->vat_number = $request->vat_number;
            // transaction start
            DB::transaction(function () use ($userObj, $vendorObj) {
                $userObj->save();
                $vendor_role = Role::where('slug', 'vendor')->first();
                $userObj->roles()->attach($vendor_role);
                $user_id = $userObj->id;
                $vendorObj->user_id = $user_id;
                $vendorObj->save();
            });
            $data = $userObj;
            $data['vendor'] = $vendorObj;
            //$data['token'] = $userObj->createToken('vendor_token', ['vendor'])->accessToken;
            return response()->json(['data' => $data, "message" => "Signup successfull.", 'status' => "success"], 200);
        } catch (Exception $e) {
            return response()->json(['data' => ['oops! Something went wrong'], 'message' => "data validation failed.", 'status' => "failed"], 500);
        }

    }
    // add vendor
    public function add(Request $request)
    {
        try
        {
            // validate request
            $validator = Validator::make($request->all(), [
                'shop_unique_name' => 'required',
                'shop_name' => 'required',
                "business_email" => 'required|email',
                "email" => 'required|unique:users|email',
                "office_phone" => 'required',
                "shop_address" => 'required',
                "country" => "required",

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
            }
            $userObj = new User();
            $userObj->first_name = $request->first_name;
            $userObj->last_name = $request->last_name;
            $userObj->email = $request->email;
            $userObj->mobile = $request->mobile;
            $userObj->password = Hash::make('123456');
            $userObj->country = $request->country;
            $userObj->country_code = $request->country_code;
            $userObj->status = 0;
            $vendorObj = new vendor();
            $vendorObj->shop_unique_name = $request->shop_unique_name;
            $vendorObj->shop_name = $request->shop_name;
            $vendorObj->shop_slug = Str::slug($request->shop_name, '-');
            $vendorObj->business_email = $request->business_email;
            $vendorObj->office_phone = $request->office_phone;
            $vendorObj->shop_address = $request->shop_address;
            $vendorObj->zip = $request->zip;
            $vendorObj->lat = $request->lat;
            $vendorObj->long = $request->long;
            $vendorObj->created_at = date('Y-m-d H:i:s');
            DB::transaction(function () use ($userObj, $vendorObj) {
                $userObj->save();
                $user_id = $userObj->id;
                $vendor_role = Role::where('slug', 'vendor')->first();
                $userObj->roles()->attach($vendor_role);
                $vendorObj->user_id = $user_id;
                $vendorObj->save();
            });

            $vendorId = $vendorObj->id;
            if ($request->file('shop_logo')) {
                $path = 'images/vendors/' . $vendorId . '/logo';
                $vendorAsset['shop_logo'] = $this->helperController->generateImageFile('', 150, 150, $path, $request->file('shop_logo'));
                $vendorAsset['shop_thumbnail'] = $this->helperController->generateImageFile('', 50, 50, $path, $request->file('shop_logo'));

            } else {
                $vendorAsset['shop_logo'] = "";
            }

            // save cover photo

            if ($request->file('cover_photo')) {
                $path = "images/vendors/" . $vendorId . '/cover';
                $vendorAsset['shop_cover_photo'] = $this->helperController->generateImageFile('', 1300, 850, $path, $request->file('cover_photo'));
            } else {
                $vendorAsset['shop_cover_photo'] = "";
            }

            if ($vendorAsset) {
                vendor::where('id', $vendorId)->update($vendorAsset);
            }
            $data = $userObj;
            $data['vendor'] = $userObj->vendor;
            return response()->json(['data' => $data, 'message' => "Vendor has been created successfuly.", 'status' => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => [], 'message' => "oops! Something went wrong.", 'status' => "failed"], 500);
        }
    }
// edit vendors
    public function edit(Request $request, $id)
    {
        try
        {
            // validate request
            $validator = Validator::make($request->all(), [
                'shop_unique_name' => 'required',
                'shop_name' => 'required',
                "business_email" => 'required|email',
                "office_phone" => 'required',
                "shop_address" => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
            }
            $user_id = 1;
            if ($user_id) {
                $vendorObj = vendor::find($id);
                if (!$vendorObj) {
                    return response()->json(['data' => ['Invalide request.'], 'message' => "data validation failed.", 'status' => "failed"], 403);
                }

                $vendorObj->shop_unique_name = $request->shop_unique_name;
                $vendorObj->shop_name = $request->shop_name;
                $vendorObj->shop_slug = Str::slug($request->shop_name, '-');
                $vendorObj->business_email = $request->business_email;
                $vendorObj->office_phone = $request->office_phone;
                $vendorObj->status = $request->status;
                $vendorObj->shop_address = $request->shop_address;
                $vendorObj->zip = $request->zip;
                $vendorObj->lat = $request->lat;
                $vendorObj->long = $request->long;
                $vendorObj->status = $request->status;
                $vendorObj->created_at = date('Y-m-d H:i:s');
                if ($vendorObj->save()) {
                    $vendorId = $vendorObj->id;
                    if ($request->file('new_shop_logo')) {
                        $path = 'images/vendors/' . $vendorId . '/logo';
                        $vendorAsset['shop_logo'] = $this->helperController->generateImageFile($vendorObj->shop_logo, 150, 150, $path, $request->file('new_shop_logo'));
                        $vendorAsset['shop_thumbnail'] = $this->helperController->generateImageFile($vendorObj->shop_thumbnail, 50, 50, $path, $request->file('new_shop_logo'));
                    } else {
                        $vendorAsset['shop_logo'] = "";
                        $vendorAsset['shop_thumbnail'] = "";
                    }

                    if ($request->file('shop_cover')) {
                        $path = "images/vendors/" . $vendorId . '/cover';
                        $vendorAsset['shop_cover_photo'] = $this->helperController->generateImageFile('', 1300, 850, $path, $request->file('shop_cover'));
                    } else {
                        $vendorAsset['shop_cover_photo'] = "";
                    }

                    if ($vendorAsset) {
                        vendor::where('id', $vendorId)->update($vendorAsset);
                    }
                    $data = [];
                    $data['vendor'] = $vendorObj;
                    return response()->json(['data' => $data, 'message' => "Vendor has been created successfuly.", 'status' => "success"], 200);
                }
            } else {
                return response()->json(['data' => $validator, 'message' => "Vendor can not be created.", 'status' => "success"], 200);
            }

        } catch (Exception $e) {
            return response()->json(['data' => [], 'message' => "oops! Something went wrong.", 'status' => "failed"], 500);
        }
    }
// edit profile

    public function editProfile(Request $request, $id)
    {

        try
        {
            // validate request
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                "mobile" => 'required',
                "new_profile_photo" => "mimes:jpeg,jpg,png,gif|max:10000",

            ]);

            if ($validator->fails()) {
                return response()->json(['data' => $validator->errors(), 'message' => "data validation failed.", 'status' => "failed"], 403);
            }

            $vendorProfile = User::findOrFail($id);
            $vendorProfile->first_name = $request->first_name;
            $vendorProfile->last_name = $request->last_name;
            $vendorProfile->country_code = "971";
            $vendorProfile->mobile = $request->mobile;
            $vendorProfile->updated_at = date('Y-m-d H:i:s');
            $image_error = [];
            if ($request->file('new_profile_photo')) {
                $path = 'public/images/users/profile/images';
                $image = $this->helperController->generateImageFile($vendorProfile->profile_photo, 400, 400, $path, $request->file('new_profile_photo'));
                if (!isset($image['error'])) {
                    $vendorProfile->profile_photo = $image;
                    $path = 'public/images/users/profile/thumbnail';
                    $vendorProfile->thumbnail = $this->helperController->generateImageFile($vendorProfile->thumbnail, 150, 150, $path, $request->file('new_profile_photo'));
                } else {
                    array_push($image_error, $image['message']);
                }

            }
            if (count($image_error)) {

                return response()->json(['data' => $image_error, 'message' => "Profile can not be updated.", 'status' => "failed"], 500);
            }
            $vendorProfile->save();
            return response()->json(['data' => $vendorProfile, 'message' => "Profile updated succesfully.", 'status' => "success"], 200);

        } catch (Exception $e) {
            return response()->json(['data' => [], 'message' => "oops! Something went wrong.", 'status' => "failed"], 500);
        }
    }
    //get vendor profile

    public function profile($id)
    {
        $user = User::findOrfail($id);
        return response()->json($user, 200);

    }

}
