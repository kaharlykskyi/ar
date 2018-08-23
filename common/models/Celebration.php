<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "celebration".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductCelebration[] $productCelebrations
 */
class Celebration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'celebration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCelebrations()
    {
        return $this->hasMany(ProductCelebration::className(), ['celebration_id' => 'id']);
    }
}
