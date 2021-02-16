<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'เพิ่มพนักงาน';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

<?php $this->beginBlock("scripts"); ?>
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
                var text = "<option value='" +
                    element.id + "'>" + element.name_th + "</option>";
                $("#employee-emp_amphur").append(text);
            }
        }
    });
});
$("#employee-emp_amphur").change(function(e) {
    e.preventDefault();
    $.ajax({
        type: "get",
        url: "<?= Url::to(["site/get-districts?amphures="]) ?>" + $("#employee-emp_amphur").val(),
        dataType: "json",
        success: function(response) {
            $("#employee-emp_tumbol").html("");
            console.log(response);
            for (let index = 0; index <
                response.length; index++) {
                const element = response[index];
                var text = "<option value='" + element.id + "'>" +
                    element.name_th + "</option>";
                $("#employee-emp_tumbol").append(text);
            }
        }
    });
});
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
<?php $this->endBlock(); ?>