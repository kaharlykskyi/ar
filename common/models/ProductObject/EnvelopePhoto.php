<?php

namespace common\models\ProductObject;

use common\models\File;
use Yii;

/**
 * This is the model class for table "envelope_photo".
 *
 * @property int $id
 * @property int $photo_id
 * @property int $lvl 1: first layer, 2: second layer
 */
class EnvelopePhoto extends \yii\db\ActiveRecord
{
    public $level1_file;
    public $level2_file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'envelope_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_id', 'lvl'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo_id' => Yii::t('app', 'Photo ID'),
            'lvl' => Yii::t('app', '1: first layer, 2: second layer'),
        ];
    }

    public function getPictures()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_ENVELOPE_PHOTO
            ])
            ->orderBy('sort')
            ->all();

        return $model;
    }

}
