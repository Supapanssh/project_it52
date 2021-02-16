<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>

<body class="sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render('navbar') ?>
        <?= $this->render('sidebar') ?>
        <?= $this->render('content', ['content' => $content]) ?>
        <?= $this->render('footer') ?>
    </div><?php $this->endBody() ?>
    <?php if (isset($this->blocks['scripts'])) : ?>
    <?= $this->blocks['scripts'] ?>
    <?php endif; ?>
</body>

</html><?php $this->endPage() ?>