<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'PNo') ?>

    <?= $form->field($model, 'Product_no') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'brand_id') ?>

    <?= $form->field($model, 'Product_code') ?>

    <?php // echo $form->field($model, 'Product_name') ?>

    <?php // echo $form->field($model, 'Product_desc') ?>

    <?php // echo $form->field($model, 'Product_price') ?>

    <?php // echo $form->field($model, 'Product_cost') ?>

    <?php // echo $form->field($model, 'Product_quantity') ?>

    <?php // echo $form->field($model, 'Product_unit') ?>

    <?php // echo $form->field($model, 'Product_exp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
