<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
// ใส่ชื่อ attribute ผิดต้องเป็น s เล็กให้หมด
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-sm-4"> <?= $form->field($model, 'sup_company')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-4"><?= $form->field($model, 'sup_username')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_address')->textInput(['maxlength' => true]) ?></div>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_moo')->textInput() ?></div>
        <?php
    $provinces = app\models\Provinces::find()->all();
    $arrayProvinces = ArrayHelper::map($provinces, 'id', 'name_th');
    ?> <?php
    if ($model->sup_province) {
        $amphures = app\models\Amphures::find()->where("province_id = $model->sup_province")->all();
    } else {
        $amphures = app\models\Amphures::find()->all();
    }
    $arrayAmphures = ArrayHelper::map($amphures, 'id', 'name_th');
    ?>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_province')->dropDownList($arrayProvinces, []) ?></div>

        <?php
    if ($model->sup_amphur) {
        $tumbol = app\models\Districts::find()->where(['amphure_id' => $model->sup_amphur])->all();
    } else {
        $tumbol = app\models\Districts::find()->all();
    }
    $arrayTumbol = ArrayHelper::map($tumbol, 'id', 'name_th');
    ?>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_amphur')->dropDownList($arrayAmphures) ?></div>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_tumbol')->dropDownList($arrayTumbol) ?></div>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_zipcode')->textInput() ?></div>
        <div class="col-sm-4"> <?= $form->field($model, 'sup_tel')->textInput(['maxlength' => true]) ?></div>
        <div class="col-6"> <?= $form->field($model, 'sup_detail')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>


    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php $this->beginBlock("scripts"); ?>
<script>
$(" #supplier-sup_province").change(function(e) {
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
                var
                    text = "<option value='" + element.id + "'>" + element.name_th + "</option>";
                $("#supplier-sup_amphur").append(text);
            }
        }
    });
});
</script>
<script>
$("#supplier-sup_amphur").change(function(e) {
    e.preventDefault();
    $.ajax({
        type: "get",
        url: "<?= Url::to(["site/get-districts?amphures="]) ?>" + $(
                "#supplier-sup_amphur")
            .val(),
        dataType: "json",
        success: function(response) {
            $("#supplier-sup_tumbol").html("");
            console.log(response);
            for (let index = 0; index < response.length; index++) {
                const element = response[index];
                var text = "<option value='" + element.id + "'>" + element
                    .name_th +
                    "</option>";
                $("#supplier-sup_tumbol").append(text);
            }
        }
    });
});
</script>

<script>
$("#supplier-sup_tumbol").change(function(e) {
    e.preventDefault();
    $.ajax({
        type: "get",
        url: "<?= Url::to(["site/get-zip?district="]) ?>" + $(
                "#supplier-sup_tumbol")
            .val(),
        dataType: "json",
        success: function(response) {
            console.log(response);
            $("#supplier-sup_zipcode").prop("value", response.zip_code);
        }
    });
});
</script>
<?php $this->endBlock(); ?>