<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $ID คีย์
 * @property string $Emp_ID รหัสพนักงาน
 * @property int $Emp_idcard เลขบัตรประชาชน
 * @property string $Emp_name ชื่อ
 * @property string $Emp_lname นามสกุล
 * @property string $Emp_sex เพศ
 * @property string $Emp_birth วันเกิด
 * @property int $Emp_tel เบอร์โทร
 * @property string $Emp_address ที่อยู่
 * @property int $Emp_moo หมู่
 * @property int|null $Emp_tumbol ตำบล
 * @property int|null $Emp_amphur อำเภอ
 * @property string $Emp_road ถนน
 * @property int|null $Emp_province จังหวัด
 * @property int $Emp_zipcode รหัสไปรษณีย์
 * @property string $Emp_mail อีเมล์
 * @property string $Emp_start เริ่มทำงาน
 * @property string $Emp_quit ลาออก
 * @property string $Emp_status สถานะ
 *
 * @property Provinces $empProvince
 * @property Districts $empTumbol
 * @property Amphures $empAmphur
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Emp_ID', 'Emp_idcard', 'Emp_name', 'Emp_lname', 'Emp_sex', 'Emp_birth', 'Emp_tel', 'Emp_address', 'Emp_moo', 'Emp_road', 'Emp_zipcode', 'Emp_mail', 'Emp_start', 'Emp_status'], 'required'],
            [['Emp_idcard', 'Emp_tel', 'Emp_moo', 'Emp_tumbol', 'Emp_amphur', 'Emp_province', 'Emp_zipcode'], 'integer'],
            [['Emp_birth', 'Emp_start', 'Emp_quit'], 'safe'],
            [['Emp_address', 'Emp_status'], 'string'],
            [['Emp_ID', 'Emp_sex'], 'string', 'max' => 5],
            [['Emp_name'], 'string', 'max' => 50],
            [['Emp_lname'], 'string', 'max' => 10],
            [['Emp_road', 'Emp_mail'], 'string', 'max' => 45],
            [['Emp_province'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['Emp_province' => 'id']],
            [['Emp_tumbol'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['Emp_tumbol' => 'id']],
            [['Emp_amphur'], 'exist', 'skipOnError' => true, 'targetClass' => Amphures::className(), 'targetAttribute' => ['Emp_amphur' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'คีย์',
            'Emp_ID' => 'รหัสพนักงาน',
            'Emp_idcard' => 'เลขบัตรประชาชน',
            'Emp_name' => 'ชื่อ',
            'Emp_lname' => 'นามสกุล',
            'Emp_sex' => 'เพศ',
            'Emp_birth' => 'วันเกิด',
            'Emp_tel' => 'เบอร์โทร',
            'Emp_address' => 'บ้านเลขที่',
            'Emp_moo' => 'หมู่',
            'Emp_tumbol' => 'ตำบล',
            'Emp_amphur' => 'อำเภอ',
            'Emp_road' => 'ถนน',
            'Emp_province' => 'จังหวัด',
            'Emp_zipcode' => 'รหัสไปรษณีย์',
            'Emp_mail' => 'อีเมล์',
            'Emp_start' => 'เริ่มทำงาน',
            'Emp_quit' => 'ลาออก',
            'Emp_status' => 'สถานะ',
        ];
    }

    /**
     * Gets query for [[EmpProvince]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'Emp_province']);
    }

    /**
     * Gets query for [[EmpTumbol]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpTumbol()
    {
        return $this->hasOne(Districts::className(), ['id' => 'Emp_tumbol']);
    }

    /**
     * Gets query for [[EmpAmphur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpAmphur()
    {
        return $this->hasOne(Amphures::className(), ['id' => 'Emp_amphur']);
    }
}
