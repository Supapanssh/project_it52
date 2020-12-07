<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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

    <?php
    $provinces = app\models\Provinces::find()->all();
    $arrayProvinces = ArrayHelper::map($provinces, 'id', 'name_th');
    ?>
     <?= $form->field($model, 'Sup_province')->dropDownList($arrayProvinces,[]) ?>

     <script>
        $("#supplier-sup_province").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= Url::to(["site/get-amphures?province="]) ?>" + $("#supplier-sup_province").val(),
                dataType: "json",
                success: function(response) {
                    $("#supplier-sup_amphur").html("");
                    console.log(response);
                    for (let index = 0; index < response.length; index++) {
                        const element = response[index];
                        var text = "<option value='" + element.id + "'>" + element.name_th + "</option>";
                        $("#supplier-sup_amphur").append(text);
                    }
                }
            });
        });
    </script>

<?php
    if ($model->Sup_province) {
        $amphures = app\models\Amphures::find()->where("province_id = $model->Sup_province")->all();
    } else {
        $amphures = app\models\Amphures::find()->all();
    }
    $arrayAmphures = ArrayHelper::map($amphures, 'id', 'name_th');
    ?>
    <?= $form->field($model, 'Sup_amphur')->dropDownList($arrayAmphures) ?>
    <script>
        $("#supplier-sup_amphur").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= Url::to(["site/get-districts?amphures="]) ?>" + $("#supplier-sup_amphur").val(),
                dataType: "json",
                success: function(response) {
                    $("#supplier-sup_tumbol").html("");
                    console.log(response);
                    for (let index = 0; index < response.length; index++) {
                        const element = response[index];
                        var text = "<option value='" + element.id + "'>" + element.name_th + "</option>";
                        $("#supplier-sup_tumbol").append(text);
                    }
                }
            });
        });
    </script>
    <?php
    if ($model->Sup_amphur) {
        $tumbol = app\models\Amphures::find()->where(['amphure_id' => $model->Sup_amphur])->all();
    } else {
        $tumbol = app\models\Amphures::find()->all();
    }
    $arrayTumbol = ArrayHelper::map($tumbol, 'id', 'name_th');
    ?>
    <?= $form->field($model, 'Sup_tumbol')->dropDownList($arrayTumbol) ?>

    <script>
        $("#supplier-sup_tumbol").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "<?= Url::to(["site/get-zip?district="]) ?>" + $("#supplier-sup_tumbol").val(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $("#supplier-sup_zipcode").prop("value", response.zip_code);
                }
            });
        });
    </script>

    <?= $form->field($model, 'sup_zipcode')->textInput() ?>

    <?= $form->field($model, 'sup_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_detail')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>