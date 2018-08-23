<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shipping".
 *
 * @property int $id
 * @property int $user_id
 * @property int $shop_id
 * @property int $shipping_region_id
 * @property int $processing_time
 * @property string $price
 * @property int $updated_at
 * @property int $created_at
 *
 * @property ShippingRegion $shippingRegion
 * @property Shop $shop
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping';
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
            [['user_id', 'shop_id', 'shipping_region_id', 'processing_time', 'updated_at', 'created_at'], 'integer'],
            [['price'], 'number'],
            [['shipping_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingRegion::className(), 'targetAttribute' => ['shipping_region_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
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
            'shop_id' => Yii::t('app', 'Shop ID'),
            'shipping_region_id' => Yii::t('app', 'Shipping Region'),
            'processing_time' => Yii::t('app', 'Processing Time (day)'),
            'price' => Yii::t('app', 'Price $'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingRegion()
    {
        return $this->hasOne(ShippingRegion::className(), ['id' => 'shipping_region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }
}
