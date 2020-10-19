<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sell;

/**
 * SellSearch represents the model behind the search form of `app\models\Sell`.
 */
class SellSearch extends Sell
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SellNo', 'PNo', 'BillNo', 'SellAmount'], 'integer'],
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
        $query = Sell::find();

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
            'SellNo' => $this->SellNo,
            'PNo' => $this->PNo,
            'BillNo' => $this->BillNo,
            'SellAmount' => $this->SellAmount,
        ]);

        return $dataProvider;
    }
}
