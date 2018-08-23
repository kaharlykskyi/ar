<?php
namespace frontend\modules\user\models;


use common\components\CFormatter;
use common\components\CMail;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ChangePassword extends Model
{
    // public $username;
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Пароли не совпадают" ],
        ];
    }

    public function attributeLabels() {
        return [
            'password' => \Yii::t('app', 'Password'),
            'password_repeat' => \Yii::t('app', 'Repeat password'),

        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = \Yii::$app->user->getIdentity();
        $user->setPassword($this->password);
        
        return $user->save() ? $user : null;
    }

}
