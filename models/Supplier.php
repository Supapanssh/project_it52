<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $sup_id รหัสบริษัทคู่ค้า
 * @property string $sup_company ชื่อบริษัทคู่ค้า
 * @property string $sup_username ชื่อผู้ติดต่อ
 * @property string $sup_address ที่อยู่
 * @property int $sup_moo หมู่
 * @property int|null $sup_tumbol ตำบล
 * @property int|null $sup_amphur อำเภอ
 * @property int|null $sup_province จังหวัด
 * @property int $sup_zipcode รหัสไปรษณีย์
 * @property string $sup_tel เบอร์ติดต่อ
 * @property string $sup_detail รายละเอียด
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sup_company', 'sup_username', 'sup_address', 'sup_moo', 'sup_zipcode', 'sup_tel', 'sup_detail'], 'required'],
            [['sup_moo', 'sup_tumbol', 'sup_amphur', 'sup_province', 'sup_zipcode'], 'integer'],
            [['sup_company', 'sup_detail'], 'string', 'max' => 100],
            [['sup_username'], 'string', 'max' => 50],
            [['sup_address'], 'string', 'max' => 200],
            [['sup_tel'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sup_id' => 'รหัสบริษัทคู่ค้า',
            'sup_company' => 'ชื่อบริษัทคู่ค้า',
            'sup_username' => 'ชื่อผู้ติดต่อ',
            'sup_address' => 'ที่อยู่',
            'sup_moo' => 'หมู่',
            'sup_tumbol' => 'ตำบล',
            'sup_amphur' => 'อำเภอ',
            'sup_province' => 'จังหวัด',
            'sup_zipcode' => 'รหัสไปรษณีย์',
            'sup_tel' => 'เบอร์ติดต่อ',
            'sup_detail' => 'รายละเอียด',
        ];
    }

/**
     * Gets query for [[EmpProvince]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'sup_province']);
    }

    /**
     * Gets query for [[EmpTumbol]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupTumbol()
    {
        return $this->hasOne(Districts::className(), ['id' => 'sup_tumbol']);
    }

    /**
     * Gets query for [[EmpAmphur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupAmphur()
    {
        return $this->hasOne(Amphures::className(), ['id' => 'sup_amphur']);
    }


    
}