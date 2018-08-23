<?php

namespace common\models\event;

use common\models\File;
use common\models\ProductObject\ProductObjectUser;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property int $product_object_user_id
 * @property int $user_id
 * @property string $host_name
 * @property string $event_name
 * @property string $address
 * @property int $start_date
 * @property int $end_date
 * @property int $date_to_send
 * @property string $notes
 * @property string $payed_at
 * @property string $updated_at
 * @property string $created_at
 *
 * @property ProductObjectUser $productObjectUser
 * @property ReceiverEvent[] $receiverEvents
 */
class Event extends \yii\db\ActiveRecord
{
    public $attachments="";
    public $date_to_send_text="";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
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
            [['product_object_user_id', 'user_id', 'date_to_send', 'payed_at', 'updated_at', 'created_at'], 'integer'],
            [['notes'], 'string'],

            [['start_date', 'end_date'], 'string', 'max' => 128],

            [['host_name', 'event_name', 'address', 'date_to_send_text', 'product_object_user_id'], 'required', 'on'=>'create'],
            [['date_to_send_text'], 'validateStartTime', 'on'=>'create'],

            [['host_name'], 'string', 'max' => 128],
            [['event_name'], 'string', 'max' => 256],
            [['address'], 'string', 'max' => 1024],
            [['product_object_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductObjectUser::className(), 'targetAttribute' => ['product_object_user_id' => 'id']],
        ];
    }

    public function validateStartTime($attribute, $params, $validator)
    {
        if($this->date_to_send_text == "")
        {
            $this->addError($attribute, \Yii::t('app', 'Cant be blank'));
        }
        else{
            $date = \DateTime::createFromFormat('d.m.Y', $this->date_to_send_text);
            if($date){
                $this->date_to_send = $date->getTimestamp();

                if(!$this->date_to_send)
                    $this->addError($attribute, \Yii::t('app', 'error date format'));
            }
            else{
                $this->addError($attribute, \Yii::t('app', 'error date format'));
            }

        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_object_user_id' => Yii::t('app', 'Product Object User ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'host_name' => Yii::t('app', 'Host name'),
            'event_name' => Yii::t('app', 'Email subject'),
            'address' => Yii::t('app', 'Address'),
            'start_date' => Yii::t('app', 'Starts'),
            'end_date' => Yii::t('app', 'Ends'),
            'notes' => Yii::t('app', 'Notes'),
            'date_to_send_text' => Yii::t('app', 'Date To Send'),
            'date_to_send' => Yii::t('app', 'Date To Send'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductObjectUser()
    {
        return $this->hasOne(ProductObjectUser::className(), ['id' => 'product_object_user_id']);
    }
    
  
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverEvents()
    {
        return $this->hasMany(ReceiverEvent::className(), ['event_id' => 'id']);
    }


    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function getCsv()
    {
        $model = File::find()
            ->where('object_id =:object_id and object_type=:object_type', [
                ':object_id' => $this->id,
                ':object_type' => File::OBJECT_TYPE_RECEIVER
            ])
            ->one();

        return $model;
    }
}
