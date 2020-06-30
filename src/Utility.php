<?php

namespace vahidkaargar\Tools;

use PhpSlugger\PhpSlugger;
use Carbon\Carbon;

class Utility
{
    public static function IP()
    {
        $ip = new IP();
        return $ip->Get();
    }

    public static function Browser()
    {
        $browser = new Browser();
        return $browser->Get();
    }

    public static function Redirect($url)
    {
        header('Location: ' . $url);
        die;
    }

    // Time
    public static function TimeDiff($time1, $time2)
    {
        $dateTime1 = Carbon::parse($time1);
        $dateTime2 = Carbon::parse($time2);
        return ($dateTime1->timestamp - $dateTime2->timestamp);
    }

    public static function Random($size, $type = null)
    {
        $obj = new Random();
        if ($type == 'numeric')
            return $obj->numbers($size);
        else
            return $obj->string($size);
    }


    // Convert Persian numbers to english
    public static function Fa2En($number)
    {
        $en = array("0","1","2","3","4","5","6","7","8","9");
        $fa = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
        return str_replace($fa, $en, $number);
    }

    // Split Iran Mobile
    public static function MobileNumber($number)
    {
        $number = static::Fa2En($number);
        return substr($number, -10);
    }

    // Mobile Validation
    public static function MobileValidate($number)
    {
        $number = static::Fa2En($number);
        if(preg_match('/^(?:98|\+98|0098|0)?9[0-9]{9}$/', $number))
        {
            return true;
        }
        return false;
    }

    // Split Iran Phone Number
    public static function PhoneNumber($number)
    {
        $number = static::Fa2En($number);
        return substr($number, -10);
    }
    // Phone Validation
    public static function PhoneValidate($number)
    {
        $number = static::ConvertFa2En($number);
        if(preg_match('/^(?:98|\+98|0098|0)?[1-8]{1}\d{9}$/', $number))
        {
            return true;
        }
        return false;
    }

    // Trim & lowercase String
    public static function TrimLower($str)
    {
        return strtolower(trim($str));
    }

    // Create slug from string
    public static function Slug($str)
    {
        $phpSlugger = new PhpSlugger();
        return mb_strtolower($phpSlugger->slugit($str));
    }

    // Json Encode and Decode
    public static function Json($str, $decode = false)
    {
        if($decode == true)
        {
            $string = isset($str) ? $str : null;
            $decode = json_decode($string, true);
            if(is_null($decode))
            {
                return [];
            }
            return $decode;
        }
        else
        {
            $string = isset($str) ? $str : null;
            return json_encode($string);
        }
    }
}