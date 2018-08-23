<?php

namespace common\models\event\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\event\ReceiverEvent;

/**
 * ReceiverEventSearch represents the model behind the search form of `common\models\event\ReceiverEvent`.
 */
class ReceiverEventSearch extends ReceiverEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'event_id', 'receiver_id', 'invited', 'attempt', 'status', 'sended_at', 'created_at'], 'integer'],
            /*[['name', 'email', 'replies'], 'safe'],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $data = [])
    {
        $query = ReceiverEvent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>['name'=>SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(isset($data['event_id']))
        {
            $this->event_id = $data['event_id'];
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'event_id' => $this->event_id,
            'receiver_id' => $this->receiver_id,
            'invited' => $this->invited,
            'attempt' => $this->attempt,
            'status' => $this->status,
            'sended_at' => $this->sended_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'replies', $this->replies]);



        return $dataProvider;
    }
}
