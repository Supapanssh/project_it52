<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $PNo
 * @property string $Product_no รหัสสินค้า
 * @property int|null $category_id รหัสหมวดหมู่สินค้า
 * @property int|null $sup_id รหัสบริษัทคู่ค้า
 * @property int|null $brand_id รหัสยี่ห้อสินค้า
 * @property string|null $Product_code บาร์โค้ด
 * @property string|null $Product_name ชื่อสินค้า
 * @property string $Product_desc รายละเอียดสินค้า
 * @property float|null $Product_price ราคาขาย
 * @property float $Product_cost ราคาต้นทุน
 * @property int $Product_quantity จำนวนสินค้า
 * @property string $Product_unit หน่วยสินค้า
 * @property string $Product_exp รับประกันสินค้า
 * @property int $re_orderpoint
 *
 * @property BillDetail[] $billDetails
 * @property Cart[] $carts
 * @property Manage[] $manages
 * @property Category $category
 * @property Supplier $sup
 * @property Purchase[] $purchases
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Product_no', 'Product_desc', 'Product_cost', 'Product_quantity', 'Product_unit', 'Product_exp', 're_orderpoint'], 'required'],
            [['category_id', 'sup_id', 'brand_id', 'Product_quantity', 're_orderpoint'], 'integer'],
            [['Product_price', 'Product_cost', 'target_sale'], 'number'],
            [['Product_exp'], 'safe'],
            [['Product_no', 'Product_code'], 'string', 'max' => 11],
            [['Product_name', 'Product_desc'], 'string', 'max' => 200],
            [['Product_unit'], 'string', 'max' => 150],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['sup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['sup_id' => 'sup_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PNo' => 'P No',
            'Product_no' => 'รหัสสินค้า',
            'category_id' => 'รหัสหมวดหมู่สินค้า',
            'sup_id' => 'รหัสบริษัทคู่ค้า',
            'brand_id' => 'รหัสยี่ห้อสินค้า',
            'Product_code' => 'บาร์โค้ด',
            'Product_name' => 'ชื่อสินค้า',
            'Product_desc' => 'รายละเอียดสินค้า',
            'Product_price' => 'ราคาขาย',
            'Product_cost' => 'ราคาต้นทุน',
            'Product_quantity' => 'จำนวนสินค้า',
            'Product_unit' => 'หน่วยสินค้า',
            'Product_exp' => 'รับประกันสินค้า (ต่อปี)',
            'target_sale' => "เป้าหมายยอดขาย",
            're_orderpoint' => 'จุดสั่งซื้อซ้ำ',

        ];
    }

    /**
     * Gets query for [[BillDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBillDetails()
    {
        return $this->hasMany(BillDetail::className(), ['pno' => 'PNo']);
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['PNo' => 'PNo']);
    }

    /**
     * Gets query for [[Manages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManages()
    {
        return $this->hasMany(Manage::className(), ['PNo' => 'PNo']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * Gets query for [[Sup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSup()
    {
        return $this->hasOne(Supplier::className(), ['sup_id' => 'sup_id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['PNo' => 'PNo']);
    }
}
