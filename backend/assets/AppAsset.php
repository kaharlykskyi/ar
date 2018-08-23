<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/site.css',
        '/css/bootstrap-spinner.css',
        '/css/bootstrap-switch.css',
    ];
    public $js = [
        '/js/jquery-ui.js',
        '/js/core.js',
        '/js/bootstrap-switch.js',
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
