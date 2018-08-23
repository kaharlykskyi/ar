<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_format".
 *
 * @property int $id
 * @property int $product_id
 * @property int $format_id
 *
 * @property Format $occasion
 * @property Product $product
 */
class ProductFormat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_format';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'format_id'], 'integer'],
            [['format_id'], 'exist', 'skipOnError' => true, 'targetClass' => Format::className(), 'targetAttribute' => ['format_id' => 'id']],
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
            'format_id' => Yii::t('app', 'Format ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormat()
    {
        return $this->hasOne(Format::className(), ['id' => 'format_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
