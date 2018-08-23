<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $desc
 * @property string $h1
 * @property string $title
 * @property string $meta_desc
 * @property string $payment_refunds
 * @property string $shipping_police
 * @property int $updated_at
 * @property int $created_at
 *
 * @property Product[] $products
 * @property Shipping[] $shippings
 * @property User $user
 */
class Shop extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
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
            [['user_id', 'updated_at', 'created_at'], 'integer'],
            [['desc', 'payment_refunds', 'shipping_police'], 'string'],
            [['name'], 'string', 'max' => 1024],
            [['h1', 'title'], 'string', 'max' => 256],
            [['meta_desc'], 'string', 'max' => 512],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'h1' => Yii::t('app', 'H1'),
            'title' => Yii::t('app', 'Title'),
            'meta_desc' => Yii::t('app', 'Meta Desc'),
            'payment_refunds' => Yii::t('app', 'Payment refunds'),
            'shipping_police' => Yii::t('app', 'Shipping & Store Policies'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippings()
    {
        return $this->hasMany(Shipping::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
