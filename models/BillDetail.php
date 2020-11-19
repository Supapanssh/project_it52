<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bill_detail".
 *
 * @property int $id ไอดี
 * @property int $quantity จำนวนสินค้า
 * @property int $pno รหัสสินค้า
 * @property float $amount ราคารวม
 *
 * @property Product $pno0
 */
class BillDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'pno', 'amount'], 'required'],
            [['quantity', 'pno'], 'integer'],
            [['amount'], 'number'],
            [['pno'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pno' => 'PNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ไอดี',
            'quantity' => 'จำนวนสินค้า',
            'pno' => 'รหัสสินค้า',
            'amount' => 'ราคารวม',
        ];
    }

    /**
     * Gets query for [[Pno0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['PNo' => 'pno']);
    }
}
