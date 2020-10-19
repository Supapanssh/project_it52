<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sell".
 *
 * @property int $SellNo รหัสรายการขาย
 * @property int|null $PNo ผู้รับผิดชอบ
 * @property int $BillNo รหัสใบเสร็จ
 * @property int|null $SellAmount จำนวนที่ขาย
 *
 * @property Product $pNo
 * @property Bill $billNo
 */
class Sell extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sell';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PNo', 'BillNo', 'SellAmount'], 'integer'],
            [['BillNo'], 'required'],
            [['PNo'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['PNo' => 'PNo']],
            [['BillNo'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['BillNo' => 'BillNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SellNo' => 'รหัสรายการขาย',
            'PNo' => 'รหัสสินค้า',
            'BillNo' => 'รหัสใบเสร็จ',
            'SellAmount' => 'จำนวนที่ขาย',
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
     * Gets query for [[BillNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillNo()
    {
        return $this->hasOne(Bill::className(), ['BillNo' => 'BillNo']);
    }
}
