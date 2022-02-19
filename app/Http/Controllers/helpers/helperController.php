<?php

namespace App\Http\Controllers\helpers;

use App\Http\Controllers\Controller;
use DateTime;
use File;
use Image;

class helperController extends Controller
{
    //

    public function generateImage($oldImage = null, $width, $height, $path, $base64, )
    {

        try
        {
            $data['error'] = false;
            $data["message"] = null;
            $image_type_array = array('png', 'jpg', 'jpeg', 'PNG', 'JPEG', 'JPG', 'gif');
            $image_parts = explode(";base64,", $base64);
            $image_type_aux = explode("image/", $image_parts[0]);
            if (isset($image_type_aux[1]) && in_array($image_type_aux[1], $image_type_array)) {
                $image_type = $image_type_aux[1];
                $folderPath = base_path($path);
                File::isDirectory($folderPath) or File::makeDirectory($folderPath, 755, true, true);
                $image_base64 = base64_decode($image_parts[1]);
                $imageSize = strlen($image_base64) - 22;
                if ($imageSize > 5000000) {
                    $data['error'] = true;
                    $data['error'] = "Image size should be less than 5mb";
                    return $data;
                }

                $img_name = time() . uniqid() . '.' . $image_type;
                $imageUrl = $path . '/' . $img_name;
                $imagePath = $folderPath . '/' . $img_name;
                $img = Image::make($image_base64);
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath);
                if ($oldImage && file_exists(base_path($oldImage))) {
                    unlink(base_path($oldImage));
                }
                //$img->save($imagePath);
                //$this->fttpUpload($image_base64,$img_name);
                return $imageUrl;
            } else {
                $data['error'] = true;
                $data['message'] = "Following formate are supported 'png', 'jpg', 'jpeg', 'PNG', 'JPEG', 'JPG','gif'";
                return $data;
            }

        } catch (Exception $e) {
            $data['error'] = true;
            $data['error'] = "oops: something went wrong";
            return $data;
        }

    }

    public function generateImageFile($oldImage = null, $width, $height, $path, $file, )
    {
        try
        {
            $data['error'] = false;
            $data["message"] = null;
            $image_type_array = array('png', 'jpg', 'jpeg', 'PNG', 'JPEG', 'JPG', 'gif');
            $image = $file;
            $image_type_aux = $image->getClientOriginalExtension();
            if (isset($image_type_aux) && in_array($image_type_aux, $image_type_array)) {
                $folderPath = base_path($path);
                File::isDirectory($folderPath) or File::makeDirectory($folderPath, 755, true, true);
                $img_name = time() . uniqid() . '.' . $image_type_aux;
                $imgFile = Image::make($image->getRealPath());
                if ($image_type_aux == 'gif') {
                    $imgFile->save($folderPath . '/' . $img_name);
                } else {
                    $imgFile->resize($width, $height, function ($constraint) {
                        // $constraint->aspectRatio();
                    })->save($folderPath . '/' . $img_name);
                }

                $imageUrl = $path . '/' . $img_name;
                if ($oldImage && file_exists(base_path($oldImage))) {
                    unlink(base_path($oldImage));
                }
                //$img->save($imagePath);
                //$this->fttpUpload($image_file,$img_name);
                return $imageUrl;
            } else {
                $data['error'] = true;
                $data['message'] = "Following formate are supported 'png', 'jpg', 'jpeg', 'PNG', 'JPEG', 'JPG','gif'";
                return $data;
            }

        } catch (Exception $e) {
            $data['error'] = true;
            $data['error'] = "oops: something went wrong";
            return $data;
        }

    }
//  upload file

    public function generateFile($oldImage = null, $width, $height, $path, $file)
    {
        try
        {
            $data['error'] = false;
            $data["message"] = null;
            $image_type_array = array('pdf', 'docs','docx', 'jpeg', 'PNG', 'JPEG', 'JPG');
            $image = $file;
            $image_type_aux = $image->getClientOriginalExtension();
            if (isset($image_type_aux) && in_array($image_type_aux, $image_type_array)) {
                $folderPath = base_path($path);
                File::isDirectory($folderPath) or File::makeDirectory($folderPath, 777, true, true);
                $img_name = time() . uniqid() . '.' . $image_type_aux;
                //$imgFile = Image::make($image->getRealPath());
                //$imgFile->save($folderPath . '/' . $img_name);
              
                $file->move(public_path($path), $img_name);
                $imageUrl = $path . '/' . $img_name;
                if ($oldImage && file_exists(base_path($oldImage))) {
                    unlink(base_path($oldImage));
                }
                //$img->save($imagePath);
                //$this->fttpUpload($image_file,$img_name);
                return $imageUrl;
            } else {
                $data['error'] = true;
                $data['message'] = "Following formate are supported 'png', 'jpg', 'jpeg', 'PNG', 'JPEG', 'JPG','pdf','docs'";
                return $data;
            }

        } catch (Exception $e) {
            $data['error'] = true;
            $data['error'] = "oops: something went wrong";
            return $data;
        }

    }

    // get mongo Date

    public function get_mongo_date($date)
    {
        if ($date instanceof \MongoDB\BSON\UTCDateTime) {
            return $date;
        } else if ($date instanceof \Carbon\Carbon) {
            return new \MongoDB\BSON\UTCDateTime(new DateTime($date->toDateTimeString()));
        } else {
            return new \MongoDB\BSON\UTCDateTime(new DateTime($date));
        }
    }

    // remove gallery

}
