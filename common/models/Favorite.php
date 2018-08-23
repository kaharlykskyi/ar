<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_favorite".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $created_at
 *
 * @property Product $product
 * @property User $user
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'created_at'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id', ]);
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

    public function getFavorite()
    {
        if(!Yii::$app->user->isGuest)
        {
            $model = Favorite::find()->where('user_id=:user_id', [
                ':user_id'=>Yii::$app->user->id
            ])->orderBy(['id' => SORT_DESC])->all();
        }
        else{
            $model = [];
        }
        return $model;
    }
    

}
