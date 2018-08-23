<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $name_ru
 * @property string $name_en
 * @property string $name_de
 * @property string $name_fr
 * @property int $sort
 * @property string $code_2
 * @property string $code_3
 * @property int $publish
 * @property int $created_at
 * @property int $updated_at
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'publish', 'created_at', 'updated_at'], 'integer'],
            [['name_ru', 'name_en', 'name_de', 'name_fr'], 'string', 'max' => 255],
            [['code_2'], 'string', 'max' => 2],
            [['code_3'], 'string', 'max' => 3],
            [['name_ru'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_ru' => 'Name Ru',
            'name_en' => 'Name En',
            'name_de' => 'Name De',
            'name_fr' => 'Name Fr',
            'sort' => 'Sort',
            'code_2' => 'Code 2',
            'code_3' => 'Code 3',
            'publish' => 'Publish',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
