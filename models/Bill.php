<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill".
 *
 * @property int $BillNo รหัสใบเสร็จ
 * @property string|null $BillDate วันที่
 * @property int|null $PeoNo ผู้รับผิดชอบ
 * @property string|null $Bill_detail รายละเอียด
 * @property int $BillDiscount ส่วนลด
 * @property int $BillTotal ราคาทั้งหมด
 * @property int $BillCash เงินสด
 * @property float $Billvat ภาษีมูลค่าเพิ่ม
 *
 * @property User $peoNo
 * @property Sell[] $sells
 */
class Bill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BillDate'], 'safe'],
            [['PeoNo', 'BillDiscount', 'BillTotal', 'BillCash'], 'integer'],
            [['BillTotal', 'BillCash', 'Billvat'], 'required'],
            [['Billvat'], 'number'],
            [['Bill_detail'], 'string', 'max' => 100],
            [['PeoNo'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['PeoNo' => 'userNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BillNo' => 'รหัสใบเสร็จ',
            'BillDate' => 'วันที่',
            'PeoNo' => 'ผู้รับผิดชอบ',
            'Bill_detail' => 'รายละเอียด',
            'BillDiscount' => 'ส่วนลด',
            'BillTotal' => 'ราคาทั้งหมด',
            'BillCash' => 'เงินสด',
            'Billvat' => 'ภาษีมูลค่าเพิ่ม',
        ];
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

    /**
     * Gets query for [[Sells]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSells()
    {
        return $this->hasMany(Sell::className(), ['BillNo' => 'BillNo']);
    }
}
