<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form of `app\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sup_id', 'sup_moo', 'sup_tumbol', 'sup_amphur', 'sup_province', 'sup_zipcode'], 'integer'],
            [['sup_company', 'sup_username', 'sup_address', 'sup_tel', 'sup_detail'], 'safe'],
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
        $query = Supplier::find();

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
            'sup_id' => $this->sup_id,
            'sup_moo' => $this->sup_moo,
            'sup_tumbol' => $this->sup_tumbol,
            'sup_amphur' => $this->sup_amphur,
            'sup_province' => $this->sup_province,
            'sup_zipcode' => $this->sup_zipcode,
        ]);

        $query->andFilterWhere(['like', 'sup_company', $this->sup_company])
            ->andFilterWhere(['like', 'sup_username', $this->sup_username])
            ->andFilterWhere(['like', 'sup_address', $this->sup_address])
            ->andFilterWhere(['like', 'sup_tel', $this->sup_tel])
            ->andFilterWhere(['like', 'sup_detail', $this->sup_detail]);

        return $dataProvider;
    }
}
