<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $access
 * @property string birthdate
 * @property integer gender
 * @property integer is_subscribe_newsletter
 * @property integer is_subscribe_offers
 * @property string company_name
 * @property string address1
 * @property string address2
 * @property string region
 * @property string city
 * @property string zip_code
 * @property integer country_id
 * @property string phone
 * @property string phone_home
 * @property string profile

 *
 *
 *
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ACCESS_ALLOW = 1;
    const ACCESS_DENY = 0;

    const STATUS_DEACTIVE = 0;
    const STATUS_EMAIL_NOT_CONFIRMED = 10;
    const STATUS_SETTINGS_NOT_ENTERED = 15;
    const STATUS_ACTIVE = 20;

    const ROLE_USER = 20;
    const ROLE_ADMIN = 777;

    public $password="";

    public $columnAccess;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
/*
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
*/

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_DEACTIVE, self::STATUS_EMAIL_NOT_CONFIRMED, self::STATUS_ACTIVE]],
            [['role_id', 'access', 'gender', 'is_subscribe_newsletter', 'is_subscribe_offers', 'country_id'], 'number'],
            [['fullname', 'phone', 'phone_home', 'birthdate', 'company_name', 'address1', 'address2', 'region',  'city', 'zip_code', 'password', 'profile', 'access_token'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            
            'is_subscribe_newsletter' => Yii::t('app', 'Sign up for our newsletter!'),
            'is_subscribe_offers' => Yii::t('app', 'Receive special offers from our partners!'),            
            'country_id ' => Yii::t('app', 'Country'),

        ];
    }

    



    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        if (Yii::$app->getSession()->has('user-'.$id)) {
            return new self(Yii::$app->getSession()->get('user-'.$id));
        }
        else {
            // return isset(self::$users[$id]) ? new self(self::$users[$id]) : null;
            return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        }

        //return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByEAuth($service) {
        if (!$service->getIsAuthenticated()) {
            throw new ErrorException('EAuth user should be authenticated before creating identity.');
        }

        $id = $service->getServiceName().'-'.$service->getId();
        $model = User::find()->where('auth_key=:auth_key', [
            ':auth_key'=>md5($id)
        ])->one();


        $attributes = $service->getAttributes();
        if(!isset($model->id))
        {
            $model = new User();
            $model->username = $id;
            $model->email = isset($attributes['email']) ? $attributes['email']:$id.'@site';
            $model->access = User::ACCESS_ALLOW;
            $model->status = User::STATUS_ACTIVE;
            $model->fullname = $service->getAttribute('name');
            $model->auth_key = md5($id);
            $model->setPassword($id);
            // $model->photo = $service->getAttributes()['photo'];
            // $model->vk_id = $service->getId();
            // $model->expired_at = time() + 24*60*60;
            // echo $service->getAttributes()['photo'];
            // var_dump($model->attributes);
        }
        else{
            // $model->vk_id = $service->getId();
            $model->status = User::STATUS_ACTIVE;
        }
        $model->save(false);
        $model->password = $id;
        
        return $model;

    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE, 'access'=>User::ACCESS_ALLOW]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE, 'access'=>User::ACCESS_ALLOW]);
    }

    public function getIsAccess()
    {
        return  ($this->status==self::STATUS_ACTIVE && $this->access==User::ACCESS_ALLOW) ? true:false;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getName()
    {
        return $this->fullname !="" ? $this->fullname : $this->email;
    }


    public function getAvatar()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_AVATAR
            ])
            ->one();

        return $model;
    }

    public function getParent()
    {
        return $this->hasOne(User::className(), ['id' => 'referer_id']);
    }

    public function getChild()
    {
        return $this->hasMany(User::className(), ['referer_id' => 'id']);
    }

    public static function getStatusLabels($colored = false) {

        return [
            /*
            self::STATUS_DEACTIVE =>
                ($colored ? '<span style="color: #efb755">all</span>' : 'all'),
            */

            self::STATUS_EMAIL_NOT_CONFIRMED =>
                ($colored ? '<span style="color: #efd44c; font-weight: 600;">Емайл не подтвержден</span>' : 'Емайл не подтвержден'),

            /*
            self::STATUS_SETTINGS_NOT_ENTERED =>
                ($colored ? '<span style="color: #efb755">Shipping support</span>' : 'Shipping support'),
            */

            self::STATUS_ACTIVE =>
                ($colored ? '<span style="color: #5dbc5d;  font-weight: 600;">Email  подтвержден</span>' : 'Email подтвержден'),
        ];
    }


    /**
     * @param bool $colored
     * @return mixed|string
     */
    public function getStatusLabel($colored = false) {
        $labels = static::getStatusLabels($colored);
        return isset($labels[$this->status]) ? $labels[$this->status] : '--';
    }

    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['user_id' => 'id']);
    }
}
