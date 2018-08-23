<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class EventAsset extends AssetBundle
{
    public $sourcePath = '@frontend/web_event/';

    public $publishOptions = [
        'forceCopy' => true,
    ];

    /*public $basePath = '@webroot';
    public $baseUrl = '@web';
    */
    public $css = [
        'https://fonts.googleapis.com/css?family=Lato:400,700',
        "css/final_cards.css",
    ];
    public $js = [
        "https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js",

        "js/bootstrap.min.js",
        "js/jquery-ui.js",
        "js/CAnimation.js",
        "js/CUtils.js"

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];



    public function init(){

        $_version = \Yii::$app->params['version'];

        foreach ($this->js as $key=>$item)
        {
            $this->js[$key] = $this->js[$key]."?_=".$_version;
        }

        foreach ($this->css as $key=>$item)
        {
            $this->css[$key] = $this->css[$key]."?_=".$_version;
        }

    }
}
