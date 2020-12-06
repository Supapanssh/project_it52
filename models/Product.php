<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $PNo
 * @property string $Product_no
 * @property int|null $category_id
 * @property int|null $brand_id
 * @property string|null $Product_code
 * @property string|null $Product_name
 * @property string $Product_desc
 * @property float|null $Product_price
 * @property float $Product_cost
 * @property int $Product_quantity
 * @property string $Product_unit
 * @property string $Product_exp
 *
 * @property Category $category
 * @property ProductManage[] $productManages
 * @property Sell[] $sells
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
            [['Product_no', 'Product_desc', 'Product_cost', 'Product_quantity', 'Product_unit', 'Product_exp'], 'required'],
            [['category_id', 'brand_id', 'Product_quantity' , 're_orderpoint'], 'integer'],
            [['Product_price', 'Product_cost'], 'number'],
            [['Product_exp'], 'safe'],
            [['Product_no', 'Product_code'], 'string', 'max' => 11],
            [['Product_name', 'Product_desc'], 'string', 'max' => 200],
            [['Product_unit'], 'string', 'max' => 150],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PNo' => 'ลำดับที่',
            'Product_no' => 'รหัสสินค้า',
            'category_id' => 'หมวดหมู่สินค้า',
            'brand_id' => 'ยี่ห้อสินค้า',
            'Product_code' => 'บาร์โค้ด',
            'Product_name' => 'ชื่อสินค้า',
            'Product_desc' => 'รายละเอียดสินค้า',
            'Product_price' => 'ราคาขาย',
            'Product_cost' => 'ราคาต้นทุน',
            'Product_quantity' => 'จำนวนสินค้า',
            'Product_unit' => 'หน่วยสินค้า',
            'Product_exp' => 'รับประกันสินค้า',
            're_orderpoint'=> 'จุดสั่งซื้อ',
        ];
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
     * Gets query for [[ProductManages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductManages()
    {
        return $this->hasMany(ProductManage::className(), ['PNo' => 'PNo']);
    }

    /**
     * Gets query for [[Sells]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSells()
    {
        return $this->hasMany(Sell::className(), ['PNo' => 'PNo']);
    }
}
