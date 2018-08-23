<?php

namespace common\helpers;

class CHelper
{

    public static function box($data)
    {

        $html = self::boxBegin($data);

        if(!isset($data['header-box']) || (isset($data['header-box']) && $data['header-box'])){

            $html.= self::boxTitleBegin($data);

                $html .= isset($data['title']) ? '<h3 class="box-title">' . $data['title'] . '</h3>' : '<h3 class="box-title">&nbsp;</h3>';

                $html .= self::boxHeaderBegin();

                $html .= isset($data['header']) ? $data['header'] : '';

                $html .= self::boxHeaderEnd();

            $html.= self::boxTitleEnd($data);

        }

        $html.= self::boxBodyStart();

        $html .= $data['content'];

        $html .= self::boxEnd() ;

        return $html;
    }

    public static function boxBegin($data)
    {
        $data['box-class'] = isset($data['box-class']) ? $data['box-class']:'box-warning';

        return '<div class="box '.(isset($data['box-class']) ? $data['box-class']:'').'">';
    }

    public static function boxTitleBegin($data)
    {
        return '<div class="box-header with-border">';
    }



    public static function boxHeaderBegin()
    {
        return '<div class="box-tools">';
    }

    public static function boxHeaderEnd()
    {
        return '</div>';
    }

    public static function boxTitleEnd()
    {
        return '</div>';
    }


    public static function boxBodyStart()
    {
        return '<div class="box-body">';
    }


    public static function boxEnd()
    {
        return '</div></div>';
    }

}