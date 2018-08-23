<?php

namespace common\models\event;

use Yii;

/**
 * This is the model class for table "receiver_list".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $user_id
 *
 * @property ReceiverEvent[] $receiverEvents
 */
class ReceiverList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'receiver_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name', 'email'], 'string', 'max' => 128],
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
            'email' => Yii::t('app', 'Email'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverEvents()
    {
        return $this->hasMany(ReceiverEvent::className(), ['receiver_id' => 'id']);
    }
}
