<?php
namespace App\Helpers;
use Carbon\Carbon;
use DateTime;
use DB;
/**
 * Created by PhpStorm.
 * User: darryl
 * Date: 1/15/2015
 * Time: 8:09 PM
 */

class Helpers
{

    /**
     * normalize price
     *
     * @param $price
     * @return float
     */
    public static function normalizePrice($price)
    {
        $number=(is_string($price)) ? floatval($price) : $price;
        return (double) number_format($number, 2, '.', '');
    }

    /**
     * check if array is multi dimensional array
     * This will only check the first element of the array if it is still an array
     * to decide that it is a multi dimensional, if you want to check the array strictly
     * with all on its element, flag the second argument as true
     *
     * @param $array
     * @param bool $recursive
     * @return bool
     */
    public static function isMultiArray($array, $recursive = false)
    {
        if ($recursive) {
            return (count($array) == count($array, COUNT_RECURSIVE)) ? false : true;
        } else {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    return true;
                } else {
                    return false;
                }
            }

        }
    }

    /**
     * check if variable is set and has value, return a default value
     *
     * @param $var
     * @param bool|mixed $default
     * @return bool|mixed
     */
    public static function issetAndHasValueOrAssignDefault(&$var, $default = false)
    {
        if ((isset($var)) && ($var != '')) {
            return $var;
        }

        return $default;
    }

    public static function formatValue($value, $format_numbers, $config)
    {
        if ($format_numbers && $config['format_numbers']) {
            return number_format($value, $config['decimals'], $config['dec_point'], $config['thousands_sep']);
        } else {
            return $value;
        }
    }

    public static function VatCalculation($price)
    {
        //The VAT rate / percentage.
        $vat = 5;
        $vatToPay = ($price / 100) * $vat;
        return (double) number_format($vatToPay, 2, '.', '');
    }

    public  static function get_mongo_date($date)
    {
        if ($date instanceof \MongoDB\BSON\UTCDateTime) {
            return $date;
        } else if ($date instanceof \Carbon\Carbon) {
            return new \MongoDB\BSON\UTCDateTime(new DateTime($date->toDateTimeString()));
        } else {
            return new \MongoDB\BSON\UTCDateTime(new DateTime($date));
        }
    }

    public static function getID($name,$prefix='',$month='',$year='')
    {
         $updateSequen = DB::connection('mongodb')->getCollection('counters')->findOneAndUpdate(
            ['_id'=>$name],
            ['$inc' => ['seq' => 1]],
            ['new' => true, 'upsert' => true]
        );
        
      $seq=DB::connection('mongodb')->table('counters')->where('_id',$name)->first();
      return $prefix.date('Y').date('m').date('d')."-".$seq['seq'];
       
    }
}
