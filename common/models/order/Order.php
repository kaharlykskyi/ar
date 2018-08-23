<?php

namespace common\models\order;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $fullname
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $sum
 * @property string $notes
 * @property integer $delivery_type_id
 * @property integer $delivery_sum
 * @property integer $total
 * @property integer $payment_type_id
 * @property string $payed_info
 * @property integer $payed_at
 * @property integer $created_at
 *
 * @property User $user
 * @property OrderProduct[] $orderProducts
 */
class Order extends \yii\db\ActiveRecord
{
    /*
    const DELIVERY_TYPE_COURIER = 1;
    const DELIVERY_TYPE_PICKUP = 2;
    */

    const PAYMENT_TYPE_CACHE = 1;
    const PAYMENT_TYPE_CARD = 2;
    const PAYMENT_TYPE_TRANSFER = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ]
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'region_id', 'delivery_type_id', 'delivery_sum', 'total', 'payment_type_id', 'payed_at', 'created_at'], 'integer'],
            [['sum'], 'number'],
            [['notes', 'payed_info'], 'string'],
            [['fullname'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 16],
            [['address', 'city'], 'string', 'max' => 255],

            /*
            [['fullname', 'email', 'phone', 'delivery_type_id', 'payment_type_id'], 'required'],
            [['address', 'city', 'region_id'], 'validateLocation'],
            */

            /* [['delivery_type_id'], 'validateDeliveryType'],*/

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

        ];
    }

    public function validateLocation($attribute, $params, $validator)
    {
        if ($this->delivery_type_id == Order::DELIVERY_TYPE_COURIER && $this->$attribute=="")
        {
            $this->addError($attribute, \Yii::t('app', 'Необходимо заполнить {attribute}'));
        }
    }
    
    public function validateDeliveryType($attribute, $params, $validator)
    {
        if ($this->delivery_type_id == Order::DELIVERY_TYPE_COURIER)
        {
            if($this->address=="")
                $this->addError('address', \Yii::t('app', 'Необходимо заполнить адрес'));

            if($this->city=="")
                $this->addError('city', \Yii::t('app', 'Необходимо заполнить населенный пункт'));

            if($this->region_id=="")
                $this->addError('region_id', \Yii::t('app', 'Необходимо заполнить регион'));
        }
        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'fullname' => Yii::t('app', 'Имя'),
            'email' => Yii::t('app', 'E-mail'),
            'phone' => Yii::t('app', 'Телефон'),
            'region_id' => Yii::t('app', 'Район'),
            'address' => Yii::t('app', 'Адрес'),
            'city' => Yii::t('app', 'Населенный пункт'),
            'sum' => Yii::t('app', 'Sum'),
            'notes' => Yii::t('app', 'Дополнительная информация'),
            'delivery_type_id' => Yii::t('app', 'Delivery Type ID'),
            'delivery_sum' => Yii::t('app', 'Delivery Sum'),
            'total' => Yii::t('app', 'Total'),
            'payment_type_id' => Yii::t('app', 'Payed Type ID'),
            'payed_info' => Yii::t('app', 'Payed Info'),
            'payed_at' => Yii::t('app', 'Payed At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProduct()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }
}
