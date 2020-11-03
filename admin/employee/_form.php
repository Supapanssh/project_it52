<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-8">
            <?= $form->field($model, 'Emp_ID')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-4">
            <?= $form->field($model, 'Emp_idcard')->textInput() ?>
        </div>
    </div>


    <!-- //kigigigigi -->

    <?= $form->field($model, 'Emp_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Emp_lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Emp_sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Emp_birth')->textInput() ?>

    <?= $form->field($model, 'Emp_tel')->textInput() ?>

    <?= $form->field($model, 'Emp_address')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Emp_road')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Emp_moo')->textInput() ?>
    <?php
    $provinces = app\models\Provinces::find()->all();
    $arrayProvinces = ArrayHelper::map($provinces, 'id', 'name_th');
    ?>
    <?= $form->field($model, 'Emp_province')->dropDownList($arrayProvinces, []) ?>

    <script>
        $("#employee-emp_province").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= Url::to(["site/get-amphures?province="]) ?>" + $("#employee-emp_province").val(),
                dataType: "json",
                success: function(response) {
                    $("#employee-emp_amphur").html("");
                    console.log(response);
                    for (let index = 0; index < response.length; index++) {
                        const element = response[index];
                        var text = "<option value='" + element.id + "'>" + element.name_th + "</option>";
                        $("#employee-emp_amphur").append(text);
                    }
                }
            });
        });
    </script>
    <?php
    if ($model->Emp_province) {
        $amphures = app\models\Amphures::find()->where("province_id = $model->Emp_province")->all();
    } else {
        $amphures = app\models\Amphures::find()->all();
    }
    $arrayAmphures = ArrayHelper::map($amphures, 'id', 'name_th');
    ?>
    <?= $form->field($model, 'Emp_amphur')->dropDownList($arrayAmphures) ?>
    <script>
        $("#employee-emp_amphur").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= Url::to(["site/get-districts?amphures="]) ?>" + $("#employee-emp_amphur").val(),
                dataType: "json",
                success: function(response) {
                    $("#employee-emp_tumbol").html("");
                    console.log(response);
                    for (let index = 0; index < response.length; index++) {
                        const element = response[index];
                        var text = "<option value='" + element.id + "'>" + element.name_th + "</option>";
                        $("#employee-emp_tumbol").append(text);
                    }
                }
            });
        });
    </script>
    <?php
    if ($model->Emp_amphur) {
        $tumbol = app\models\Amphures::find()->where(['amphure_id' => $model->Emp_amphur])->all();
    } else {
        $tumbol = app\models\Amphures::find()->all();
    }
    $arrayTumbol = ArrayHelper::map($tumbol, 'id', 'name_th');
    ?>
    <?= $form->field($model, 'Emp_tumbol')->dropDownList($arrayTumbol) ?>

    <script>
        $("#employee-emp_tumbol").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= Url::to(["site/get-zip?district="]) ?>" + $("#employee-emp_tumbol").val(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $("#employee-emp_zipcode").prop("value", response.zip_code);
                }
            });
        });
    </script>
    <?= $form->field($model, 'Emp_zipcode')->textInput() ?>

    <?= $form->field($model, 'Emp_mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Emp_start')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'Emp_quit')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'Emp_status')->dropDownList(['ทำงาน' => 'ทำงาน', 'ลาออก' => 'ลาออก',], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>