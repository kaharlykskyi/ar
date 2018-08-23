<?php
namespace frontend\controllers;

use common\components\CMail;
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
class SiteController extends CController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
            'eauth' => array(
                // required to disable csrf validation on OpenID requests
                'class' => \nodge\eauth\openid\ControllerBehavior::className(),
                'only' => ['login'],
            ),
        ];
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
        return $this->render('index');
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLoginAdmin()
    {
        $token = \Yii::$app->request->get('token');
        $user = User::find()->where('password_hash=:token', [
            ':token'=>$token
        ])->one();

        $model = new LoginForm();

        if($model->login($user))
            return $this->redirect(['/user/lk/index']);
        else
            return $this->redirect('/');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $serviceName = \Yii::$app->getRequest()->getQueryParam('service');

        if (isset($serviceName)) {
            /** @var $eauth \nodge\eauth\ServiceBase */
            $eauth = Yii::$app->get('eauth')->getIdentity($serviceName);
            $eauth->setRedirectUrl(Yii::$app->getUser()->getReturnUrl());
            $eauth->setCancelUrl(Yii::$app->getUrlManager()->createAbsoluteUrl('site/login'));


            try {
                if ($eauth->authenticate()) {

                    $identity = User::findByEAuth($eauth);
                    if($identity->isAccess){
                        Yii::$app->getUser()->login($identity);
                        // special redirect with closing popup window
                        return $eauth->redirect("/user/lk/index");
                    }
                    else{
                        Yii::$app->session->setFlash('error', 'Your account is deleted');
                    }
                }
                else {

                    // close popup window and redirect to cancelUrl
                    $eauth->cancel();
                }
            }
            catch (\nodge\eauth\ErrorException $e) {
                // save error to show it later
                Yii::$app->getSession()->setFlash('error', 'EAuthException: '.$e->getMessage());
                // close popup window and redirect to cancelUrl
//              $eauth->cancel();
                $eauth->redirect($eauth->getCancelUrl());
            }
        }

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->login())
            {
                return $this->redirect(['/user/lk/index']);
            }
            else{
                return $this->renderPartial('//common/_login', [
                    'model' => $model,
                ]);
            }
        } else {
            $model->password = '';

            return $this->render('//common/_login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {

                if(!$model->sendEmail())
                {
                }

                Yii::$app->session->setFlash('success', Yii::t('app', 'Отлично! Вы зарегистрированы. На почту отправлено письмо с подтверждением.'));
                return $this->redirect(['/']);
            }
        }
        else
        {
            $model->is_subscribe_newsletter = 1;
            $model->is_subscribe_offers = 1;
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionConfirmEmail($token) {
        /** @var $user \common\models\User */
        $user = User::findOne([
            'auth_key' => $token,
        ]);

        if($user) {
            $user->updateAttributes([
                'status' => User::STATUS_ACTIVE,
                'auth_key' => ''
            ]);
            if(Yii::$app->user->login($user, 3600 * 24)) {
                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Ваша почта успешно подтверждена'));
                return $this->redirect(['/user/lk/index']);

            }
        }

        throw new NotFoundHttpException();
    }

    public function actionTestEmail() {

        $email = \Yii::$app->request->get('email', 'eignatov@outlook.com');

        $mail = new CMail();
        $mail->send([
            'alias'=>'test',
            'model'=>[
                'name'=>'eignatov',
            ],
            'to'=>$email,
            /* 'to'=>'kriartds@gmail.com',*/
            'subject'=>'test for outlook'
        ]);
        
        echo "sent " .date('d.m.Y H:i:s', time());

    }


}
