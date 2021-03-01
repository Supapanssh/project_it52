<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseBill */

$this->title = 'สร้างใบสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'Purchase Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
    'model' => $model, 'form_mode' => "edit"
]) ?>