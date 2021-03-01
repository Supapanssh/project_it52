<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_ID')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_idcard')->textInput(['maxlength' => '13']) ?>
        </div>
        <!-- //kigigigigi -->
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_lname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_sex')->label('เพศ')->radioList(array('ชาย' =>'ชาย', 'หญิง' =>'หญิง')) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_birth')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'Emp_address')->textarea() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_tel')->textInput(['maxlength' => '10']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_road')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_moo')->textInput() ?>
        </div>



        <?php
        $provinces = app\models\Provinces::find()->all();
        $arrayProvinces = ArrayHelper::map($provinces, 'id', 'name_th');
        ?>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_province')->dropDownList($arrayProvinces, []) ?>
        </div>

        <?php
        if ($model->Emp_province) {
            $amphures = app\models\Amphures::find()->where("province_id = $model->Emp_province")->all();
        } else {
            $amphures = app\models\Amphures::find()->all();
        }
        $arrayAmphures = ArrayHelper::map($amphures, 'id', 'name_th');
        ?>

        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_amphur')->dropDownList($arrayAmphures) ?>
        </div>

        <?php
        if ($model->Emp_amphur) {
            $tumbol = app\models\Districts::find()->where(['amphure_id' => $model->Emp_amphur])->all();
        } else {
            $tumbol = app\models\Districts::find()->all();
        }
        $arrayTumbol = ArrayHelper::map($tumbol, 'id', 'name_th');
        ?>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_tumbol')->dropDownList($arrayTumbol) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_zipcode')->textInput(['maxlength' => '5']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_mail')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_start')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_quit')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Emp_status')->dropDownList(['ทำงาน' => 'ทำงาน', 'ลาออก' => 'ลาออก',], ['prompt' => '']) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-auto">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>