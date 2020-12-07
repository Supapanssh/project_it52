<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Manage */

$this->title = 'แก้ไขข้อมูลสินค้า: ' . $model->Manage_No;
$this->params['breadcrumbs'][] = ['label' => 'Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Manage_No, 'url' => ['view', 'id' => $model->Manage_No]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
