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
        if (!Yii::$app->user->isGuest) {
            return Yii::$app->user->identity->roles;
        } else {
            return null;
        }
    }
}
