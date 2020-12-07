<?php

use app\models\SiteInfo;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="<?= SiteInfo::web() ?>" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">

        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline"><i class="fa fa-user-circle" aria-hidden="true"></i> <?= !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : null ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    <img src="<?= Yii::getAlias('@web'); ?>/images/admin.png" class="img-circle elevation-2" alt="User Image">
                    <p>
                       <i class="fa fa-user-circle" aria-hidden="true"></i> <?= !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : null ?>
                    </p>
                </li>
                <div class="p-1">
                    <form method="get" action="<?= Url::to(['site/signout']) ?>">
                        <button type="submit" class="btn btn-default btn-flat float-right w-100 p-2">ออกจากระบบ</button>
                    </form>
                </div>
            </ul>

        </li>
    </ul>
</nav>