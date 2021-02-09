<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property int $purchase_id รหัสสั่งซื้อ
 * @property int|null $PNo รหัสสินค้า
 * @property int $quantity
 * @property int $bill_id
 *
 * @property Product $pNo
 * @property PurchaseBill $bill
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PNo', 'quantity', 'bill_id'], 'integer'],
            [['quantity', 'bill_id'], 'required'],
            [['PNo'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['PNo' => 'PNo']],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseBill::className(), 'targetAttribute' => ['bill_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'purchase_id' => 'รหัสสั่งซื้อ',
            'PNo' => 'รหัสสินค้า',
            'quantity' => 'Quantity',
            'bill_id' => 'Bill ID',
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
     * Gets query for [[Bill]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(PurchaseBill::className(), ['id' => 'bill_id']);
    }
}
