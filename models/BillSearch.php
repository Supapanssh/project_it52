<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bill;

/**
 * BillSearch represents the model behind the search form of `app\models\Bill`.
 */
class BillSearch extends Bill
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BillNo', 'PeoNo', 'BillDiscount', 'BillTotal', 'BillCash'], 'integer'],
            [['BillDate', 'Bill_detail'], 'safe'],
            [['Billvat'], 'number'],
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
        $query = Bill::find();

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
            'BillNo' => $this->BillNo,
            'BillDate' => $this->BillDate,
            'PeoNo' => $this->PeoNo,
            'BillDiscount' => $this->BillDiscount,
            'BillTotal' => $this->BillTotal,
            'BillCash' => $this->BillCash,
            'Billvat' => $this->Billvat,
        ]);

        $query->andFilterWhere(['like', 'Bill_detail', $this->Bill_detail]);

        return $dataProvider;
    }
}
