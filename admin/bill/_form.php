<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'BillDate')->textInput() ?>

    <?php
    $peonoList = app\models\User::find()->all();
    $arraypeono = ArrayHelper::map($peonoList, 'userNo', 'user_name');
    ?>
    <?= $form->field($model, 'PeoNo')->dropDownList($arraypeono) ?>

    <!-- <?= $form->field($model, 'Bill_detail')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'BillDiscount')->textInput() ?> -->

    <?= $form->field($model, 'BillTotal')->textInput() ?>

    <!-- <?= $form->field($model, 'BillCash')->textInput() ?> -->

    <?= $form->field($model, 'Billvat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
