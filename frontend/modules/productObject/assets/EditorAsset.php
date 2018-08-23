<?php

namespace frontend\modules\productObject\assets;


use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EditorAsset extends AssetBundle
{
        
    public $sourcePath = '@frontend/modules/productObject/assets';
    public $publishOptions = [
        'forceCopy' => true,
    ];
    public $css = [
        'https://fonts.googleapis.com/css?family=Lato:400,700',
        'css/ie10-viewport-bug-workaround.css',
        'css/fontawesome-all.css',
        'css/sglide.css',
        'css/rangeslider.css',
        'css/style.css',
        'css/editor.css',
        '/uploads/font.css'
    ];
    public $js = [
        'js/lib/jquery-ui.js',
        'js/lib/bootstrap.min.js',
        'js/lib/holder.min.js',
        'js/lib/ie10-viewport-bug-workaround.js',
        'js/lib/jquery.sglide.js',
        'js/lib/rangeslider.js',
        /* 'js/lib/ie8-responsive-file-warning.js',*/
        'js/lib/ie-emulation-modes-warning.js',
        'js/lib/html5shiv.min.js',
        'js/lib/respond.min.js',
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