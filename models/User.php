<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $auth_key
 * @property string $password_hash
 * @property int $roles
 * @property string $email
 * @property int $status
 */

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    const ROLE_CHASIER = 0;
    const ROLE_MANAGER = 10;
    const ROLE_ADMIN = 30;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [

            ['roles', 'default', 'value' => self::ROLE_ADMIN],
            ['roles', 'in', 'range' => [self::ROLE_CHASIER, self::ROLE_MANAGER, self::ROLE_ADMIN]],

            [['username', 'nickname', 'password_hash'], 'required'],
            [['roles'], 'integer'],
            [['username', 'password_hash', 'email'], 'string', 'max' => 100],
            [['nickname'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 20],
            [['auth_key', 'password_reset_token'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userNo' => 'ไอดีผู้ใช้',
            'username' => 'ชื่อผู้ใช้',
            'nickname' => 'ชื่อ',
            'password_hash' => 'รหัสผ่าน',
            'email' => 'อีเมล์',
            'status' => 'สถานะ',
            'auth_key' => 'คีย์',
            'roles' => 'บทบาท',
            'password_reset_token' => 'โทเค่นตั้งรหัสผ่านใหม่',
        ];
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }
    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        return strtotime('+7 days', $timestamp) >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);

        return $this->password_hash == $password;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public static function getRoleName($roleID)
    {
        $roles = array(
            0 => 'ผู้ขายสินค้า',
            30 => 'ผู้ดูแลระบบ',
            10 => 'ผู้จัดการ',
            // 20 => 'พนักงาน',
            // 40 => 'ลูกค้า',
        );
        if (!empty($roles[$roleID])) {
            return $roles[$roleID];
        } else {
            return $roles;
        }
    }

    public static function getStatusName($status)
    {
        $array = array(
            0 => "Deactive",
            1 => "Active",
        );
        if (!empty($array[$status])) {
            return $array[$status];
        } else {
            return "ไม่ระบุสถานะ";
        }
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bill::className(), ['PeoNo' => 'userNo']);
    }

    public function getManages()
    {
        return $this->hasMany(Manage::className(), ['PeoNo' => 'userNo']);
    }

    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['userNo' => 'userNo']);
    }
}
