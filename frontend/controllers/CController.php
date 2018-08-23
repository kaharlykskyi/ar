<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;

/**
 * G controller
 */
class CController extends Controller
{

    public function __construct($id, $module)
    {
        parent::__construct($id, $module);

    }

    public function beforeAction($action)
    {
        $cid = \Yii::$app->controller->id;
        $aid = \Yii::$app->controller->action->id;

        \Yii::$app->params['mca'] =  (\Yii::$app->controller->module->id == "frontend" ? "":\Yii::$app->controller->module->id."-").\Yii::$app->controller->id."-".\Yii::$app->controller->action->id;

        /*
        if($cid."-".$aid == 'site-index' && !isGuest())
        {
            $this->redirect(['/user/lk/profile'])->send();
            \Yii::$app->end();
        }
        */
        return true;
    }


}
