<?php

namespace frontend\modules\user\controllers;
use common\components\CMail;
use common\models\Change;
use common\models\Currency;
use common\models\File;
use common\models\Mining;
use common\models\Notification;
use common\models\Order;
use common\models\RefPayed;
use common\models\SprMessage;
use common\models\User;
use common\models\UserMining;
use common\models\UserParam;
use common\models\UserService;
use frontend\modules\user\models\ChangePassword;
use yii\data\ActiveDataProvider;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;
use \common\models\Level;

/**
 * Class CabinetController
 * @package frontend\modules\seller\controllers
 */
class LkController extends UserController
{
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        return true;
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
        ]);
    }

    public function actionProfile()
    {

        $model = \Yii::$app->user->getIdentity();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            /*
            if($model->password!="")
            {
                $model->setPassword($model->password);
                $model->save(false);
            }
            */

            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Информация  сохранен'));

            return $this->redirect(['/user/lk/profile']);
        }


        return $this->render('profile', [
            'model'=>$model
        ]);
    }


    public function actionChangePass()
    {
        $model = new ChangePassword();

        if ($model->load(\Yii::$app->request->post())) {

            if($model->save()) {

                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Пароль изменен'));
                return $this->redirect(['/user/lk/change-pass']);
            }
        }

        return $this->render('change-pass', [
            'model'=>$model
        ]);
    }

    public function actionReferal()
    {
        $id = \Yii::$app->request->get('id');

        if($id == "")
            $id = \Yii::$app->user->id;

        $model = User::findOne($id);

        return $this->render('referal', [
            'model'=>$model
        ]);
    }


    public function actionPayout()
    {
        return $this->render('payout', [
            'model'=>[]
        ]);
    }


    public function actionPayed()
    {
        $user = \Yii::$app->user->identity;
        // $user_id = $model->id;

        $model = \Yii::$app->user->identity;
        if($model->is_payed != "1"){

            for($i=1; $i<=10; $i++){

                if($model->parent->id != User::REF_ADMIN){

                    $refPayed = new RefPayed();

                    $refPayed->attributes = [
                        'user_id' => $model->id,
                        'referer_id' => $model->parent->id,
                        'main_referer_id' => $user->id,
                        'lvl' => $model->parent->lvl,
                        'sum' => 1,
                        'created_at' => time(),
                    ];
                    $refPayed->save();

                    $model->parent->balance+=1;
                    $model->parent->save(false);

                    $model = $model->parent;
                }
                else{
                    $refPayed = new RefPayed();

                    $refPayed->attributes = [
                        'user_id' => $model->id,
                        'referer_id' => $model->parent->id,
                        'main_referer_id' => $user->id,
                        'lvl' => $model->parent->lvl,
                        'sum' => 10-$i+1,
                        'created_at' => time(),
                    ];
                    $refPayed->save();

                    $model->parent->balance+=(10-$i+1);
                    $model->parent->save(false);

                    break;
                }
            }

            $user->is_payed = 1;
            $user->save(false);

            echo "end ";

        }

        \Yii::$app->end();

        return $this->render('payout', [
            'model'=>[]
        ]);
    }



    
}
