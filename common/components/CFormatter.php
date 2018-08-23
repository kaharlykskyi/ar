<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\StringHelper;

class CFormatter extends Component {

    public static function getHoursMinute24($start = '12:00AM', $end = '11:59PM', $interval = '+30 minutes')
    {
        // $interval = '+1 hour';
        // $interval = '+30 minutes';
        // $interval = '+15 minutes';

        $start_str = strtotime($start);
        $end_str = strtotime($end);
        $now_str = $start_str;

        $dateArray = [];
        while($now_str <= $end_str){
            $dateArray[] = date('H:i', $now_str);
            $now_str = strtotime($interval, $now_str);
        }

        return $dateArray;
    }

    public static function toAlphabet($number){

        $alphabet   = ['1', '2', '3', '4', '5', '6', '7', '8', '9', 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $number--;
        $count = count($alphabet);
        $alpha = "";
        if($number < $count)
            return $alphabet[$number];

        while($number >= 0){
            $modulo     = ($number) % $count;
            $alpha      = $alphabet[$modulo].$alpha;
            $number     = floor((($number - $modulo) / $count))-1;
        }
        return $alpha;
    }




    public static function generationEmail()
    {
        return time()."@".\Yii::$app->params['domen'];
    }

    public static function substr($str, $length){

        $newStr = mb_substr($str, 0, $length, 'UTF-8');
        if(mb_strlen($str,'UTF-8')<=$length)
            return $newStr;
        else
            return $newStr.'...';
    }

    public static function checkOnlyDigits($txt){


        $txt_new = preg_replace("/[^0-9 ,.:;-]/", "", $txt);

        if($txt == $txt_new)
            return true;
        else
            return false;
    }



    public static function leftDay($timestamp, $data=[]){

        $left = $timestamp-time();

        if($left>=0)
        {
            $day = floor($left/24/60/60);
            $hour = floor(($left - $day*24*60*60)/60/60);
            $min = floor(($left - $day*24*60*60 - $hour*60*60)/60);
            if(!empty($data))
                return $day.(isset($data['D']) ? $data['D']:"").", ".$hour.(isset($data['H']) ? $data['H']:"")." : ".$min.(isset($data['M']) ? $data['M']:"")." ".(isset($data['Left']) ? $data['Left']:"");
            else
                return $day.", ".$hour.":".$min;
        }
        else{
            return "";
        }
    }

    public static function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]) ? true:false;
    }


    public static function dateRus($date) {
        $ru_month = array( 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь' );
        $en_month = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );

        return str_replace( $en_month, $ru_month, $date );

    }

    public static function minuteToHours($minute) {

        if($minute<60)
            return $minute." мин";
        else{
            $h = floor($minute/60);
            $m = $minute-$h*60;
            return $h." ч ".($m>0 ? $m." мин":"");
        }
    }

    public static function numberFormat($sum, $drop=0) {

        return number_format($sum, $drop, '.', ' ');
    }

    public static function dayString($day) {

        $str = "";
        $day = $day - floor($day/10)*10;

        if($day==0) $str = 'дней';
        if($day==1) $str = 'день';
        if($day>=2 && $day<=4) $str = 'дня';
        if($day>=5 && $day<=9) $str = 'дней';

        return $str;
    }

    public static function getFonts($data) {

        $font = [];
        foreach($data as $item){
            if($item['element_type_id']==4)
            {
                $value_text = explode('fontFamily":"', $item['value_text']);
                $ind = 0;
                foreach ($value_text as $row){
                    if($ind>0)
                    {
                        $t = explode('"', $row);
                        $font[] = $t[0];
                    }
                    $ind++;
                }
            }
        }
        $font = array_unique($font);

        $fontList = [];
        foreach ($font as $item){
            $fontList[] = $item;
        }

        return $fontList;
    }






}