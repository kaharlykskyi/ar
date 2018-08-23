<?php
namespace frontend\controllers;

use common\models\Category;
use common\models\event\Event;
use common\models\event\ReceiverEvent;
use common\models\Product;
use common\models\ProductObject\ProductObjectPage;
use common\models\search\ProductSearch;
use common\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class ProductController extends CController
{
    // public $layout = 'event';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionItem()
    {
        $id = \Yii::$app->request->get('id');

        $model = Product::findOne($id);

        return $this->render('item', [
            'model' => $model,
        ]);

    }



}
