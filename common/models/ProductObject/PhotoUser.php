<?php

namespace common\models\ProductObject;

use common\models\File;
use Yii;

/**
 * This is the model class for table "photo_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $element_type_id
 *
 * @property ElementType $elementType
 */
class PhotoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'element_type_id'], 'integer'],
            [['element_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ElementType::className(), 'targetAttribute' => ['element_type_id' => 'id']],
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
            'element_type_id' => Yii::t('app', 'Element Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElementType()
    {
        return $this->hasOne(ElementType::className(), ['id' => 'element_type_id']);
    }

    public static function getList($element_type_id)
    {
        $model = PhotoUser::find()->where('user_id=:user_id and element_type_id=:element_type_id', [
            ':element_type_id'=>$element_type_id,
            ':user_id'=>\Yii::$app->user->id,
        ])->all();

        return $model;
    }

    public function getPictures()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_PRODUCT_ELEMENT_PHOTO
            ])
            ->orderBy('sort')
            ->all();

        return $model;
    }
}
