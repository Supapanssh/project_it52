<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BillDate')->textInput() ?>

    <?= $form->field($model, 'PeoNo')->textInput() ?>

    <!-- <?= $form->field($model, 'Bill_detail')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'BillDiscount')->textInput() ?> -->

    <?= $form->field($model, 'BillTotal')->textInput() ?>

    <!-- <?= $form->field($model, 'BillCash')->textInput() ?> -->

    <?= $form->field($model, 'Billvat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
