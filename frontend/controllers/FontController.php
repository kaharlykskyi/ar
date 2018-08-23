<?php
namespace frontend\controllers;

use common\models\font\Font;
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
class FontController extends Controller
{
    /**
     * @inheritdoc
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

    public function actionCss()
    {
        // $model = Font::find()->orderBy('name')->all();
        $model = Font::find()->all();

        return $this->renderPartial('css', [
            'model'=>$model
        ]);
    }

    public function actionIndex()
    {
        $model = Font::find()->orderBy('name')->all();

        return $this->render('index');
    }


}