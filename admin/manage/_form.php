<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Manage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Manage_date')->textInput() ?>

    <?= $form->field($model, 'PNo')->textInput() ?>

    <?= $form->field($model, 'PeoNo')->textInput() ?>

    <?= $form->field($model, 'Manage_Amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
