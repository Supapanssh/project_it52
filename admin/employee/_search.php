<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Emp_ID') ?>

    <?= $form->field($model, 'Emp_idcard') ?>

    <?= $form->field($model, 'Emp_name') ?>

    <?= $form->field($model, 'Emp_lname') ?>

    <?php // echo $form->field($model, 'Emp_sex') ?>

    <?php // echo $form->field($model, 'Emp_birth') ?>

    <?php // echo $form->field($model, 'Emp_tel') ?>

    <?php // echo $form->field($model, 'Emp_address') ?>

    <?php // echo $form->field($model, 'Emp_moo') ?>

    <?php // echo $form->field($model, 'Emp_tumbol') ?>

    <?php // echo $form->field($model, 'Emp_amphur') ?>

    <?php // echo $form->field($model, 'Emp_road') ?>

    <?php // echo $form->field($model, 'Emp_province') ?>

    <?php // echo $form->field($model, 'Emp_zipcode') ?>

    <?php // echo $form->field($model, 'Emp_mail') ?>

    <?php // echo $form->field($model, 'Emp_start') ?>

    <?php // echo $form->field($model, 'Emp_quit') ?>

    <?php // echo $form->field($model, 'Emp_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
