<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */

?>




<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'Product_code')->textInput() ?>


            <?php
            $object = app\models\Category::find()->all();
            $array = ArrayHelper::map($object, 'category_id', 'category_name');
            ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'Product_no')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-sm-4">
            <?= $form->field($model, 'category_id')->dropDownList($array) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'brand_id')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'Product_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'Product_desc')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'Product_price')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'Product_cost')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'Product_quantity')->textInput() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 're_orderpoint')->textInput(['type' => 'number']) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'Product_unit')->dropDownList(['ชิ้น' => 'ชิ้น', "อัน" => 'อัน', "ลิตร" => "ลิตร"], ['prompt' => '']) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'Product_exp')->textInput(['type' => 'date']) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>