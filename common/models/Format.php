<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "format".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductFormat[] $productFormat
 */
class Format extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'format';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 64],
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
    public function getProductFormat()
    {
        return $this->hasMany(ProductFormat::className(), ['format_id' => 'id']);
    }
}
