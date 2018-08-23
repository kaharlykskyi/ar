<?php

namespace common\models\font;

use common\models\File;
use Yii;

/**
 * This is the model class for table "font_style".
 *
 * @property integer $id
 * @property integer $font_id
 * @property integer $font_style
 * @property integer $font_weight
 * @property string $path
 *
 * @property Font $font
 */
class FontStyle extends \yii\db\ActiveRecord
{
    public $attachments;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'font_style';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['font_id', 'font_style', 'font_weight'], 'integer'],
            [['path'], 'string', 'max' => 1024],
            [['font_id'], 'exist', 'skipOnError' => true, 'targetClass' => Font::className(), 'targetAttribute' => ['font_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'font_id' => 'Font ID',
            'font_style' => 'Font Style',
            'font_weight' => 'Font Weight',
            'path' => 'Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFont()
    {
        return $this->hasOne(Font::className(), ['id' => 'font_id']);
    }

    public function getFiles()
    {
        $module = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id'=>$this->id,
                ':object_type'=>File::OBJECT_TYPE_FONT
            ])
            ->orderBy('sort')
            ->all();
        
        return $module;
    }

}
