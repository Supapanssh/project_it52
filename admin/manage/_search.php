<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Manage_No') ?>

    <?= $form->field($model, 'Manage_date') ?>

    <?= $form->field($model, 'PNo') ?>

    <?= $form->field($model, 'PeoNo') ?>

    <?= $form->field($model, 'Manage_Amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
