<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $cateList = app\models\Category::find()->all();
    $arraycate = ArrayHelper::map($cateList, 'category_id', 'category_name');
    ?>
    <?= $form->field($model, 'category_name')->dropDownList($arraycate) ?>

    <?= $form->field($model, 'category_desc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
