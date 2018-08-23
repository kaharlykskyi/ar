<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $h1
 * @property string $title
 * @property string $meta_desc
 * @property int $parent_id
 * @property int $updated_at
 * @property int $created_at
 *
 * @property ProductCategory[] $productCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ]
            ],
        ];
    }

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'string'],
            [['parent_id', 'updated_at', 'created_at'], 'integer'],
            [['name', 'h1', 'title'], 'string', 'max' => 256],
            [['meta_desc'], 'string', 'max' => 512],
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
            'desc' => Yii::t('app', 'Desc'),
            'h1' => Yii::t('app', 'H1'),
            'title' => Yii::t('app', 'Title'),
            'meta_desc' => Yii::t('app', 'Meta Desc'),
            'parent_id' => Yii::t('app', 'Percent ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::className(), ['category_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getMain()
    {
        $module = Category::find()->where('parent_id is null')->orderBy('id')->all();
        return $module;
    }


    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getChild()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }


}
