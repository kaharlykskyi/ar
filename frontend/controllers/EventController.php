<?php
namespace frontend\controllers;

use common\models\event\Event;
use common\models\event\ReceiverEvent;
use common\models\ProductObject\ProductObjectPage;
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
class EventController extends CController
{
    public $layout = 'event';

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
    public function actionIndex()
    {
        $id = \Yii::$app->request->get('id');
        $event_id = \Yii::$app->request->get('event_id');

        $modelReceiverEvent = new ReceiverEvent();
        if($id!="")
        {
            $modelReceiverEvent = ReceiverEvent::findOne($id);
            $modelReceiverEvent->status = 1;
            $modelReceiverEvent->save(false);

            $model = $modelReceiverEvent->event;
        }

        if($event_id!=""){
            $model = Event::findOne($event_id);
        }


        return $this->render('index', [
            'modelReceiverEvent'=>$modelReceiverEvent,
            'model'=>$model,
            'id'=>$id
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/');
        }

        return $this->redirect('/');
    }

    public function actionAttend()
    {
        $id = \Yii::$app->request->get('id');
        $attempt = \Yii::$app->request->get('attempt');
        $replies = \Yii::$app->request->get('replies');

        if($id!="")
        {
            $model = ReceiverEvent::findOne($id);
            if($attempt>=$model->invited) $attempt=$model->invited;

            $model->attempt = $attempt;
            $model->replies = $replies;
            $model->save(false);
        }

        echo json_encode([
            'status'=>'success',
            'msg'=>'Sended'
        ]);

        exit;
    }

    public function actionNotAttend()
    {
        $id = \Yii::$app->request->get('id');
        if($id!="")
        {
            $model = ReceiverEvent::findOne($id);
            $model->invited = 0;
            $model->save(false);
        }

        return $this->redirect('/');
    }


    public function actionGetEnvelope()
    {
        $id = \Yii::$app->request->get('id');
        $model = Event::findOne($id);
        
        $data = $this->getEnvelope($model);
        
        return $this->redirect('/');
    }


    public function getEnvelope($model)
    {
        $productObjectUser = $model->productObjectUser;

        $page = 'card';
        $productPage = $productObjectUser->$page;
        $cardData = $productPage->getPageElement('');



        $page = 'backside';
        $productPage = $productObjectUser->$page;
        $backsideData = $productPage->getPageElement('');

        $page = 'envelope';
        $productPage = $productObjectUser->$page;
        $envelopeData = $productPage->getPageElement('');

        $page = 'rsvp';
        $productPage = $productObjectUser->$page;
        $rsvpData = $productPage->getPageElement('');


        
        $pageData = [
            'card'=>$cardData,
            'backside'=>$backsideData,
            'envelope'=>$envelopeData,
            'rsvp'=>$rsvpData,
        ];

        echo  json_encode([
            'elementData'=>$pageData,
        ]);

        exit;
    }

    protected function findModel($id)
    {
        if (($model = ReceiverEvent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
