<?php

namespace common\models\event;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "receiver_event".
 *
 * @property int $id
 * @property int $event_id
 * @property int $receiver_id
 * @property string $name
 * @property string $email
 * @property int $invited
 * @property int $attempt
 * @property string $replies
 * @property int $status 1: opened, 2: accepted, 3: canceled
 * @property int $sended_at
 * @property int $created_at
 *
 * @property Event $event
 * @property ReceiverList $receiver
 */
class ReceiverEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receiver_event';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            [['event_id', 'receiver_id', 'invited', 'attempt', 'status', 'sended_at', 'created_at'], 'integer'],

            [['event_id', 'invited', 'name', 'email'], 'required'],
            ['email', 'email'],

            [['name', 'email'], 'string', 'max' => 128],
            [['replies'], 'string', 'max' => 2048],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['receiver_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReceiverList::className(), 'targetAttribute' => ['receiver_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'receiver_id' => Yii::t('app', 'Receiver ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'invited' => Yii::t('app', 'Invited'),
            'attempt' => Yii::t('app', 'Attempt'),
            'replies' => Yii::t('app', 'Replies'),
            'status' => Yii::t('app', 'status'), /*1: opened, 2: accepted, 3: canceled*/
            'sended_at' => Yii::t('app', 'Sended At'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(ReceiverList::className(), ['id' => 'receiver_id']);
    }
}
