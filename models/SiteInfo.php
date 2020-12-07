<?php

namespace  app\models;

use Yii;

class SiteInfo
{
    public static function web()
    {
        return Yii::getAlias("@web") . "/";
    }

    public static function getUserRole()
    {
        return Yii::$app->user->identity->roles;
    }
}
