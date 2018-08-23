<?php

namespace frontend\modules\eventOrder\assets;


use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EventOrderAsset extends AssetBundle
{
        
    public $sourcePath = '@frontend/modules/eventOrder/assets';
    public $publishOptions = [
        'forceCopy' => true,
    ];
    public $css = [
        'css/event.css'
    ];
    public $js = [
        '/js/CUtils.js',
        'js/CEventOrder.js',
        'js/CEventReceiver.js',
        'js/CBasket.js',        
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