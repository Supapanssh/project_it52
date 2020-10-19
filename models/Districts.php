<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property int $id
 * @property int $zip_code
 * @property string $name_th
 * @property string $name_en
 * @property int $amphure_id
 *
 * @property Employee[] $employees
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'zip_code', 'name_th', 'name_en'], 'required'],
            [['id', 'zip_code', 'amphure_id'], 'integer'],
            [['name_th', 'name_en'], 'string', 'max' => 150],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zip_code' => 'Zip Code',
            'name_th' => 'Name Th',
            'name_en' => 'Name En',
            'amphure_id' => 'Amphure ID',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['Emp_tumbol' => 'id']);
    }
}
