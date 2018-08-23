<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $shop_id
 * @property int $user_id
 * @property string $name
 * @property string $desc
 * @property string $h1
 * @property string $title
 * @property string $meta_desc
 * @property int $is_physical
 * @property int $is_digital
 * @property int $is_request
 * @property string $tag
 * @property string $price
 * @property string $sku
 * @property string $is_active
 * @property int $updated_at
 * @property int $created_at
 *
 * @property User $user
 * @property Shop $shop
 * @property ProductCategory[] $productCategory
 * @property ProductCelebration[] $productCelebration
 * @property ProductFormat[] $productFormat
 */
class Product extends \yii\db\ActiveRecord
{
    public $attachments;
    public $resources;

    public $category_id;
    public $category_main_id;
    public $celebration_id;
    public $format_id;
    public $section_id;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
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
            [['shop_id', 'user_id', 'is_physical', 'is_digital', 'is_request', 'is_active', 'quantity', 'updated_at', 'created_at'], 'integer'],
            [['desc'], 'string'],
            [['price'], 'number'],

            [['category_main_id', 'category_id', 'celebration_id', 'format_id', 'section_id'], 'integer'],

            [['name', 'tag'], 'string', 'max' => 1024],
            [['h1', 'title'], 'string', 'max' => 256],
            [['meta_desc'], 'string', 'max' => 512],
            [['sku'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'h1' => Yii::t('app', 'H1'),
            'title' => Yii::t('app', 'Title'),
            'meta_desc' => Yii::t('app', 'Meta Desc'),
            'is_physical' => Yii::t('app', 'Physical'),
            'is_digital' => Yii::t('app', 'Digital'),
            'is_request' => Yii::t('app', 'Custom order'),

            'category_main_id' => Yii::t('app', 'Category'),
            'category_id' => Yii::t('app', 'Sub category'),
            'section_id' => Yii::t('app', 'Section'),

            'celebration_id' => Yii::t('app', 'With photo'),
            'format_id' => Yii::t('app', 'Format'),

            'tag' => Yii::t('app', 'Tag'),
            'price' => Yii::t('app', 'Price'),
            'sku' => Yii::t('app', 'Sku'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['product_id' => 'id']);
    }

    public function getCategory()
    {
        $model = Category::find()
            ->innerJoin('product_category pc', 'category.id = pc.category_id')
            ->where('pc.product_id =:product_id', [
                ':product_id'=>$this->id
            ])->one();

        return $model;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCelebrations()
    {
        return $this->hasOne(ProductCelebration::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFormat()
    {
        return $this->hasOne(ProductFormat::className(), ['product_id' => 'id']);
    }

    public function getProductSection()
    {
        return $this->hasOne(ProductSection::className(), ['section_id' => 'id']);
    }

    public function getPictures()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_PRODUCT
            ])
            ->orderBy('sort')
            ->all();

        return $model;
    }

    public function getFirstPictureShortPath()
    {
        $model = $this->getPictures();

        if(count($model)>0)
            return $model[0]->shortPath;

        return "";
    }


    public function getResource()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_PRODUCT_RESOURCE
            ])
            ->orderBy('sort')
            ->one();

        return $model;

    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorite()
    {
        if(!isGuest())
        {
            return $this->hasOne(Favorite::className(), [
                'product_id' => 'id'
            ])->andWhere(['user_id' => \Yii::$app->user->identity->id]);
        }
        else
        {
            return [];
        }

    }




}
