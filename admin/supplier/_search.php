<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'sup_id') ?>

    <?= $form->field($model, 'sup_company') ?>

    <?= $form->field($model, 'sup_username') ?>

    <?= $form->field($model, 'sup_address') ?>

    <?= $form->field($model, 'sup_moo') ?>

    <?php // echo $form->field($model, 'sup_tumbol') ?>

    <?php // echo $form->field($model, 'sup_amphur') ?>

    <?php // echo $form->field($model, 'sup_province') ?>

    <?php // echo $form->field($model, 'sup_zipcode') ?>

    <?php // echo $form->field($model, 'sup_tel') ?>

    <?php // echo $form->field($model, 'sup_detail') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
