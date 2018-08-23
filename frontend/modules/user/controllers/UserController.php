<?php

namespace frontend\modules\user\controllers;

use common\models\Bet;
use common\models\Favorite;
use common\models\User;
use frontend\controllers\CController;
use Yii;
use yii\web\Controller;

/**
 * SellerController - базовый класс для всех дочерних модуля
 */
class UserController extends CController
{
    /**
     * @inheritdoc
     */
    
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {

            if (\Yii::$app->user->isGuest){
                $this->redirect(['/'])->send();
                \Yii::$app->end();
            }
            else{
                $cid = \Yii::$app->controller->module->id."-".\Yii::$app->controller->id."-".\Yii::$app->controller->action->id;


                /*
                if($cid!="user-lk-role" && \Yii::$app->user->identity->role_id == "")
                {
                    $this->redirect(['/user/lk/role'])->send();
                    \Yii::$app->end();
                }


                if($cid == "user-lk-role" && \Yii::$app->user->identity->role_id != "")
                {
                    $this->redirect(['/user/lk/profile'])->send();
                    \Yii::$app->end();
                }
                */

                
                
                return true;
            }

        }

        return false;
        // parent::__construct($id, $module);
    }
    

}