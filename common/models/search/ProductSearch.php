<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'user_id', 'is_physical', 'is_digital', 'is_request', 'updated_at', 'created_at'], 'integer'],
            [['name', 'desc', 'h1', 'title', 'meta_desc', 'tag', 'sku'], 'safe'],
            [['price'], 'number'],
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
    public function search($params, $data)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(isset($data['user_id'])){
            $this->user_id = $data['user_id'];
        }

        if(isset($data['is_active'])){
            $this->is_active = $data['is_active'];
        }

        if(isset($data['category_id'])){
            
            $query->innerJoin('product_category pc', 'product.id = pc.product_id');
            $query->andWhere('pc.category_id=:category_id', [
                ':category_id'=>$data['category_id']
            ]);
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'user_id' => $this->user_id,
            'is_physical' => $this->is_physical,
            'is_active' => $this->is_active,
            'is_digital' => $this->is_digital,
            'is_request' => $this->is_request,
            'price' => $this->price,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'meta_desc', $this->meta_desc])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'sku', $this->sku]);

        return $dataProvider;
    }
}
