<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BillSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'BillNo') ?>

    <?= $form->field($model, 'BillDate') ?>

    <?= $form->field($model, 'PeoNo') ?>

    <!-- <?= $form->field($model, 'Bill_detail') ?> -->

    <!-- <?= $form->field($model, 'BillDiscount') ?> -->

    <?php // echo $form->field($model, 'BillTotal') ?>

    <?php // echo $form->field($model, 'BillCash') ?>

    <?php // echo $form->field($model, 'Billvat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
