<?php

namespace common\models\font;

use Yii;

/**
 * This is the model class for table "font".
 *
 * @property integer $id
 * @property string $name
 *
 * @property FontStyle[] $fontStyles
 */
class Font extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'font';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFontStyle()
    {
        return $this->hasMany(FontStyle::className(), ['font_id' => 'id']);
    }
}
