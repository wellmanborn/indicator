<?php

namespace App\Helpers;

use Morilog\Jalali\Jalalian;

trait ShamsiDate{

    public function get_current_date_and_time(){
        $date = jdate();
        return $date->getYear() . sprintf("%02d", $date->getMonth()) . sprintf("%02d", $date->getDay()) .
            sprintf("%02d", $date->getHour()) . sprintf("%02d", $date->getMinute()) . sprintf("%02d", $date->getSecond());
    }

    public static function to_persian_datetime($datetime){
        return Jalalian::forge(strtotime($datetime))->format('%Y/%m/d H:i:s');
    }

    public static function get_persian_date_separately($date = null){
        if(is_null($date)){
            $date = jdate();
        }
        $date = str_replace(["/", "-"], "", $date);
        $year = intval(substr($date, 0, 4));
        $month = intval(substr($date, 4, 2));
        $day = intval(substr($date, 6, 2));
        return [$year, $month, $day];
    }

    public static function persian_date_to_datetime($date){
        $get_date = self::get_persian_date_separately($date);
        $datetime = (new Jalalian($get_date[0], $get_date[1], $get_date[2], 0, 0, 0))
            ->toCarbon()
            ->toDateTimeString();
        return $datetime;
    }

    public static function persian_date_to_datetime_next_day($date){
        $get_date = self::get_persian_date_separately($date);
        $datetime = (new Jalalian($get_date[0], $get_date[1], $get_date[2], 0, 0, 0))
            ->addDays(1)
            ->toCarbon()
            ->toDateTimeString();
        return $datetime;
    }

    public static function faTOen($string) {
        return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    }

    public static function enTOfa($string) {
        return strtr($string, array('0'=>'۰', '1'=>'۱', '2'=>'۲', '3'=>'۳', '4'=>'۴', '5'=>'۵', '6'=>'۶', '7'=>'۷', '8'=>'۸', '9'=>'۹'));
    }

}
