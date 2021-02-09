<?php

use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;


//random เลขรหัสสินค้า
while (true) {
    $code = "";
    for ($i = 0; $i < 10; $i++) { //ต่อเลขให้ครบ 10 ตัว
        $code .= rand(0, 9);
    }

    if (Product::find()->where(["Product_code" => $code])->count() == 0) { // เช็คว่าซ้ำหรือไม่ถ้าซ้ำวนไปหาเลข 10 ตัวใหม่
        break;
    }
}

$generator = new Picqer\Barcode\BarcodeGeneratorHTML(); //สร้าง ออบเจ็คของคลาสบาร์โค้ด
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="offset-10 col-2">
            <!-- ปริ้นท์บาร์โค้ดออกหน้าจอ -->
            <?= $generator->getBarcode($code, $generator::TYPE_CODE_128, 2, 50) ?>
            <?= $code ?>
        </div>
        <div class="col-sm-4">
            <!-- กำหนดค่าให้ช่องฟิลด์บาร์โค้ด ['value' => $code]-->
            <?= $form->field($model, 'Product_code')->textInput(['value' => $code]) ?> 
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
        <?php
            $supobject = app\models\Supplier::find()->all();
            $sup_array = ArrayHelper::map($supobject, 'sup_id', 'sup_company');
            ?> 
        <div class="col-sm-4">
            <?= $form->field($model, 'sup_id')->dropDownList($sup_array) ?>  
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
            <?= $form->field($model, 'Product_unit')->dropDownList(['ชิ้น' => 'ชิ้น', "อัน" => 'อัน', "ลิตร" => "ลิตร"], ['prompt' => 'เลือกหน่วยสินค้า']) ?>
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