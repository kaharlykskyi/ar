<?php

namespace common\models\ProductObject;

use common\models\File;
use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property int $id
 * @property string $name
 * @property int $element_type_id
 * @property int $product_object_id
 */
class Photo extends \yii\db\ActiveRecord
{
    
    public $attachments;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['element_type_id', 'product_object_id'], 'integer'],
            [['name'], 'string', 'max' => 512],
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
            'element_type_id' => Yii::t('app', 'Element Type ID'),
        ];
    }

    public static function getList($element_type_id, $product_object_id = "")
    {

        $model = Photo::find()->where('element_type_id=:element_type_id', [
            ':element_type_id'=>$element_type_id
        ]);

        if($product_object_id!=""){

            $model->andWhere('product_object_id=:product_object_id', [
                ':product_object_id'=>$product_object_id
            ]);
        }

        return $model->all();
    }

    public function getPictures()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_PRODUCT_ELEMENT_CARD_IMAGE
            ])
            ->orderBy('sort')
            ->all();

        return $model;
    }

    public function getEnvelopeLevel($lvl)
    {
        $model = EnvelopePhoto::find()
            ->where('photo_id =:photo_id and lvl=:lvl', [
                ':photo_id' => $this->id,
                ':lvl' => $lvl
            ])
            ->one();

        return $model;
    }

}
