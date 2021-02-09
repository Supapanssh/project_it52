<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_bill".
 *
 * @property int $id
 * @property string $date
 * @property int $sup_id
 *
 * @property Purchase[] $purchases
 * @property Supplier $sup
 */
class PurchaseBill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_bill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'sup_id'], 'required'],
            [['date'], 'safe'],
            [['sup_id'], 'integer'],
            [['sup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['sup_id' => 'sup_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'วันที่',
            'sup_id' => 'ซัพพลายเออร์',
        ];
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['bill_id' => 'id']);
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
}
