<?php

use Morilog\Jalali\Jalalian;

class ViewHelper{

    public static function get_current_date_and_time(){
        $date = jdate();
        return $date->getYear() . sprintf("%02d", $date->getMonth()) . sprintf("%02d", $date->getDay()) .
            sprintf("%02d", $date->getHour()) . sprintf("%02d", $date->getMinute()) . sprintf("%02d", $date->getSecond());
    }

    public static function to_persian_datetime($date){
        if(empty($date))
            return "-----";
        return Jalalian::forge($date)->format('%Y/%m/d H:i:s');
    }

    public static function to_persian_date($date){
        if(empty($date))
            return "-----";
        return Jalalian::forge($date)->format('%Y/%m/d');
    }

    public static function to_persian_date_fa_format($date){
        if(empty($date))
            return "-----";
        return \App\Helpers\ShamsiDate::enTOfa(Jalalian::forge($date)->format('%Y/%m/d'));
    }

    public static function get_status($status){
        if($status == true)
            return "<span style='color:#03a679'><i class='fa fa-check'></i> " . trans("Active") . "</span>";
        else
            return "<span style='color:#d53d2f'><i class='fa fa-times'></i> " . trans("Inactive") . "</span>";
    }

    public static function show_letter_number($letter_number){
        $ex = explode("-", $letter_number);
        return "<span dir='ltr'>{$ex[0]}-<bdi>{$ex[1]}</bdi>-{$ex[2]}</span>";
    }
}
