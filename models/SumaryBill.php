<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sumary_bill".
 *
 * @property int $PNo
 * @property string|null $Product_name ชื่อสินค้า
 * @property string|null $category_name ชื่อหมวดหมู่
 * @property int $quantity จำนวนสินค้า
 * @property float $cost
 * @property float|null $price
 * @property float|null $profit
 * @property float|null $vat
 * @property string|null $BillDate วันที่
 */
class SumaryBill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sumary_bill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PNo', 'quantity'], 'integer'],
            [['quantity'], 'required'],
            [['cost', 'price', 'profit', 'vat'], 'number'],
            [['BillDate'], 'safe'],
            [['Product_name'], 'string', 'max' => 200],
            [['category_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PNo' => 'P No',
            'Product_name' => 'ชื่อสินค้า',
            'category_name' => 'ชื่อหมวดหมู่',
            'quantity' => 'จำนวนสินค้า',
            'cost' => 'Cost',
            'price' => 'Price',
            'profit' => 'Profit',
            'vat' => 'Vat',
            'BillDate' => 'วันที่',
        ];
    }
}
