<?php

namespace common\models\order;

use common\models\Product;
use common\models\ProductObject\PageType;
use common\models\ProductObject\ProductObject;
use common\models\ProductObject\ProductObjectPage;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $product_object_id
 * @property string $name
 * @property string $attr
 * @property string $notes
 * @property integer $price
 * @property integer $count
 * @property integer $delivery_price
 * @property integer $delivery_sum
 * @property integer $total
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Order $order
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    const OBJECT_TYPE_EVENT = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product';
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
            [['order_id', 'object_id', 'object_type', 'count', 'total', 'product_object_id', 'product_id', 'created_at', 'updated_at'], 'integer'],
            [['price', 'delivery_price', 'delivery_sum'], 'number'],
            [['attr'], 'string'],
            [['name', 'notes'], 'string', 'max' => 128],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'object_id' => Yii::t('app', 'Product ID'),
            'object_type' => Yii::t('app', 'Object type'),
            'name' => Yii::t('app', 'Name'),
            'attr' => Yii::t('app', 'Attr'),
            'notes' => Yii::t('app', 'Notes'),
            'price' => Yii::t('app', 'Price'),
            'count' => Yii::t('app', 'Count'),
            'total' => Yii::t('app', 'Total'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }


    public function getSvg()
    {
        $model = ProductObjectPage::find()->where('product_object_id=:product_object_id and page_type_id=:page_type_id', [
            ':product_object_id'=>$this->product_object_id,
            ':page_type_id'=>PageType::TYPE_CARD,
        ])->one();

        return $model->svg;
    }

}
