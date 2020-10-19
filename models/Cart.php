<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id ไอดีตะกร้าสินค้า
 * @property int $quantity จำนวน
 * @property int|null $PNo รหัสสินค้า
 * @property int|null $userNo รหัสผู้ใช้งาน
 *
 * @property User $userNo0
 * @property Product $pNo
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity'], 'required'],
            [['quantity', 'PNo', 'userNo'], 'integer'],
            [['userNo'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userNo' => 'userNo']],
            [['PNo'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['PNo' => 'PNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ไอดีตะกร้าสินค้า',
            'quantity' => 'จำนวน',
            'PNo' => 'รหัสสินค้า',
            'userNo' => 'รหัสผู้ใช้งาน',
        ];
    }

    /**
     * Gets query for [[UserNo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserNo0()
    {
        return $this->hasOne(User::className(), ['userNo' => 'userNo']);
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
}
