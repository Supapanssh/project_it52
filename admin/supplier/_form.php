<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sup_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_moo')->textInput() ?>

    <?= $form->field($model, 'sup_tumbol')->textInput() ?>

    <?= $form->field($model, 'sup_amphur')->textInput() ?>

    <?= $form->field($model, 'sup_province')->textInput() ?>

    <?= $form->field($model, 'sup_zipcode')->textInput() ?>

    <?= $form->field($model, 'sup_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_detail')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
