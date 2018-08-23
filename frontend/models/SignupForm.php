<?php
namespace frontend\models;

use common\components\CMail;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    // public $username;

    public $email;
    public $password;
    public $is_subscribe_newsletter;
    public $is_subscribe_offers;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /*
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            */

            [['is_subscribe_newsletter', 'is_subscribe_offers'], 'number'],
            
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'is_subscribe_newsletter' => \Yii::t('app', 'Sign up for our newsletter!'),
            'is_subscribe_offers' => \Yii::t('app', 'Receive special offers from our partners!'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->access = User::ACCESS_ALLOW;
        $user->status = User::STATUS_EMAIL_NOT_CONFIRMED;
        $user->role_id = User::ROLE_USER;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $user->is_subscribe_newsletter = $this->is_subscribe_newsletter;
        $user->is_subscribe_offers = $this->is_subscribe_offers;
        
        return $user->save() ? $user : null;
    }



    public function sendEmail()
    {

        $user = User::findOne([
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        $mail = new CMail();
        $mail->send([
            'alias'=>'signup',
            'model'=>$user,
            'to'=>$this->email,
            'subject'=>\Yii::t('app', 'Регистрация'),
        ]);


        return true;
    }

}
