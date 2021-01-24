<?php

use app\models\Product;
use app\models\User;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Manage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manage-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'Manage_date')->textInput(['type' => 'date']) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'PNo')->dropDownList(ArrayHelper::map(Product::find()->orderBy("Product_name")->all(), "PNo", "Product_name")) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'PeoNo')->dropDownList(ArrayHelper::map(User::find()->all(), "userNo", "username")) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'Manage_Amount')->textInput() ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>