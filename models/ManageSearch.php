<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manage;

/**
 * ManageSearch represents the model behind the search form of `app\models\Manage`.
 */
class ManageSearch extends Manage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Manage_No'], 'integer'],
            [['PNo', 'Manage_date', 'Manage_Amount', 'PeoNo'], 'safe'],
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
        // จอยตาราง manage เข้ากับ product กับ user ดูได้ที่โมเดล Manage ตรง getPNo() กับ getPeoNo() 
        // คำว่า pNo ได้มาจาก getPNo()==> get->PNo() => pNo
        // คำว่า peoNo ได้มาจาก getPeoNo() ==> get->PeoNo() => peoNo

        $query = Manage::find()->joinWith("pNo")->joinWith("peoNo");

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'Manage_No' => $this->Manage_No
        ]);
        $query->andFilterWhere(['like', "user.username", $this->PeoNo]); //พอเอาไปต่อกับตาราง user จากการจอยข้างบนเราสามารถใช้ filter ได้แล้วเป็น user. อะไรก็ว่าไปของ user หากจำไม่ได้ว่ามี attributes อะไรบ้างก็เปิด Model User ดูเอา
        // ปล. $this->PeoNo คือช่องค้นหาด้านบนในหน้า manage index ตรงผู้รับผิดชอบ

        $query->andFilterWhere(['like', "product.Product_name", $this->PNo]); //กรณีเดียวกับตาราง user
        $query->andFilterWhere(['like', "Manage_date", $this->Manage_date]);
        $query->andFilterWhere(['like', "Manage_Amount", $this->Manage_Amount]);

        return $dataProvider;
    }
}
