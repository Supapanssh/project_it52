<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $category_id
 * @property string|null $category_name
 * @property string $category_desc
 *
 * @property Brand[] $brands
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_desc'], 'required'],
            [['category_name', 'category_desc'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'category_desc' => 'Category Desc',
        ];
    }

    /**
     * Gets query for [[Brands]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrands()
    {
        return $this->hasMany(Brand::className(), ['category_id' => 'category_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'category_id']);
    }
}
