<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_celebration".
 *
 * @property int $id
 * @property int $product_id
 * @property int $celebration_id
 *
 * @property Celebration $celebration
 * @property Product $product
 */
class ProductCelebration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_celebration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'celebration_id'], 'integer'],
            [['celebration_id'], 'exist', 'skipOnError' => true, 'targetClass' => Celebration::className(), 'targetAttribute' => ['celebration_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'celebration_id' => Yii::t('app', 'Celebration ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCelebration()
    {
        return $this->hasOne(Celebration::className(), ['id' => 'celebration_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
