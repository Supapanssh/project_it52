<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manage".
 *
 * @property int $Manage_No รหัสจัดการสินค้า
 * @property string|null $Manage_date วันที่
 * @property int|null $PNo รหัสสินค้า
 * @property int|null $PeoNo ผู้รับผิดชอบ
 * @property int|null $Manage_Amount จำนวนสินค้า
 *
 * @property Product $pNo
 * @property User $peoNo
 */
class Manage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Manage_date'], 'safe'],
            [['PNo', 'PeoNo', 'Manage_Amount'], 'integer'],
            [['PNo'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['PNo' => 'PNo']],
            [['PeoNo'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['PeoNo' => 'userNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Manage_No' => 'รหัสจัดการสินค้า',
            'Manage_date' => 'วันที่',
            'PNo' => 'รายการสินค้า',
            'PeoNo' => 'ผู้รับผิดชอบ',
            'Manage_Amount' => 'จำนวนสินค้า',
        ];
    }

    /**
     * Gets query for [[PNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPNo()
    {
        return $this->hasOne(Product::className(), ['PNo' => 'PNo']);
    }

    /**
     * Gets query for [[PeoNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeoNo()
    {
        return $this->hasOne(User::className(), ['userNo' => 'PeoNo']);
    }
}
