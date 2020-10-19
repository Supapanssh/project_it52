<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Emp_idcard', 'Emp_tel', 'Emp_moo', 'Emp_tumbol', 'Emp_amphur', 'Emp_province', 'Emp_zipcode'], 'integer'],
            [['Emp_ID', 'Emp_name', 'Emp_lname', 'Emp_sex', 'Emp_birth', 'Emp_address', 'Emp_road', 'Emp_mail', 'Emp_start', 'Emp_quit', 'Emp_status'], 'safe'],
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
        $query = Employee::find();

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
            'ID' => $this->ID,
            'Emp_idcard' => $this->Emp_idcard,
            'Emp_birth' => $this->Emp_birth,
            'Emp_tel' => $this->Emp_tel,
            'Emp_moo' => $this->Emp_moo,
            'Emp_tumbol' => $this->Emp_tumbol,
            'Emp_amphur' => $this->Emp_amphur,
            'Emp_province' => $this->Emp_province,
            'Emp_zipcode' => $this->Emp_zipcode,
            'Emp_start' => $this->Emp_start,
            'Emp_quit' => $this->Emp_quit,
        ]);

        $query->andFilterWhere(['like', 'Emp_ID', $this->Emp_ID])
            ->andFilterWhere(['like', 'Emp_name', $this->Emp_name])
            ->andFilterWhere(['like', 'Emp_lname', $this->Emp_lname])
            ->andFilterWhere(['like', 'Emp_sex', $this->Emp_sex])
            ->andFilterWhere(['like', 'Emp_address', $this->Emp_address])
            ->andFilterWhere(['like', 'Emp_road', $this->Emp_road])
            ->andFilterWhere(['like', 'Emp_mail', $this->Emp_mail])
            ->andFilterWhere(['like', 'Emp_status', $this->Emp_status]);

        return $dataProvider;
    }
}
