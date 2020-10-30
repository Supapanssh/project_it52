<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

       

      
<div class="product-form" >

    <?php $form = ActiveForm::begin(); ?>
    
      <?= $form->field($model, 'Product_no')->textInput(['maxlength' => true]) ?> 

     <?php
    $object = app\models\Category::find()->all();
    $array = ArrayHelper::map($object, 'category_id', 'category_name');
    ?> 
    
     <?= $form->field($model, 'category_id')->dropDownList($array) ?> 
    

  
        <?= $form->field($model, 'brand_id')->textInput() ?> 

         <?= $form->field($model, 'Product_code')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'Product_name')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'Product_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Product_price')->textInput() ?>

    <?= $form->field($model, 'Product_cost')->textInput() ?>

    <?= $form->field($model, 'Product_quantity')->textInput() ?>

   <?= $form->field($model, 'Product_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Product_exp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
