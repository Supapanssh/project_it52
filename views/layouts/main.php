<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>

    <?php $this->beginBody() ?>

    <div class="wrap">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= Yii::getAlias('@web')?>">หน้าหลัก<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <a class="nav-link" href="<?= Yii::getAlias('@web') . "/site/login" ?>">เข้าสู่ระบบ</a>
                        <?php else : ?>
                            <a class="nav-link" href="<?= Yii::getAlias('@web') . "/site/logout" ?>" data-method="post">ออกจากระบบ</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>