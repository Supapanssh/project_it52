<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PNo', 'category_id', 'brand_id', 'Product_quantity'], 'integer'],
            [['Product_no', 'Product_code', 'Product_name', 'Product_desc', 'Product_unit', 'Product_exp'], 'safe'],
            [['Product_price', 'Product_cost'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params)
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

        // grid filtering conditions
        $query->andFilterWhere([
            'PNo' => $this->PNo,
            'category_id' => $this->category_id,
            //'brand_id' => $this->brand_id,
            'Product_price' => $this->Product_price,
            'Product_cost' => $this->Product_cost,
            'Product_quantity' => $this->Product_quantity,
            'Product_exp' => $this->Product_exp,
        ]);

        $query->andFilterWhere(['like', 'Product_no', $this->Product_no])
            ->andFilterWhere(['like', 'Product_code', $this->Product_code])
            ->andFilterWhere(['like', 'Product_name', $this->Product_name])
            ->andFilterWhere(['like', 'Product_desc', $this->Product_desc])
            ->andFilterWhere(['like', 'Product_unit', $this->Product_unit]);

        return $dataProvider;
    }
}
