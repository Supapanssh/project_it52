<?php

use app\models\Product;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseBill */
/* @var $form yii\widgets\ActiveForm */

$products = [];
if (!empty($_GET["sup_id"])) {
    $products = Product::findBySql("select * from product where sup_id = $_GET[sup_id]")->all();
}
if (!empty($model->sup_id)) {
    $products = Product::findBySql("select * from product where sup_id = $model->sup_id")->all();
}
?>

<div class="purchase-bill-form">

    <?php $form = ActiveForm::begin();?>



    <?php
$sobject = app\models\Supplier::find()->all();
$sarray = ArrayHelper::map($sobject, 'sup_id', 'sup_company');
?>
    <?=$form->field($model, 'sup_id')->dropDownList($sarray, ["prompt" => "choose..", "value" => $_GET["sup_id"] ?? $model->sup_id])?>

    <?=$form->field($model, 'date')->textInput(["type" => "date"])?>
    <table class="table table-striped table-inverse data-table">
        <thead class="thead-inverse">
            <tr>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="list-products">
            <?php foreach ($model->purchases as $purchase): ?>
            <tr id="row<?=$purchase->PNo?>">
                <input type="hidden" name="prod_id[]" value="<?=$purchase->PNo?>">
                <input type="hidden" name="prod_qty[]" value="<?=$purchase->quantity?>">
                <td><?=$purchase->pNo->Product_name?></td>
                <td><?=$purchase->quantity?></td>
                <td><?=$purchase->pNo->Product_cost * $purchase->quantity?></td>
                <td><?=$form_mode == "view" ? null : Html::a('ลบ', null, $options = ['class' => 'btn btn-danger', 'onclick' => '$("#row' . $purchase->PNo . '").remove()'])?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <div class="form-group">
        <?=$form_mode == "view" ? null : Html::submitButton('บันทึก', ['class' => 'btn btn-success w-100'])?>
    </div>

    <?php ActiveForm::end();?>
</div>

<tr>
    <th></th>
    <?php if ($form_mode == "edit"): ?>
    <hr>
    <table class="table table-striped table-inverse data-table mt-5">
        <thead class="thead-inverse">
            <th>ชื่อสินค้า</th>
            <th>จำนวนคงเหลือ</th>
            <th>ราคาต้นทุน</th>
            <th></th>
</tr>
</thead>
<tbody>
    <?php foreach ($products as $product) {?>
    <tr>
        <td><?=$product->Product_name?></td>
        <td style="vertical-align:middle;text-align:right;color:
                        /* เช็คเงื่อนไขในการใส่สีถ้าสินค้าน้อยกว่าจุดสั่งซื้อ */
                        <?=$product->Product_quantity < $product->re_orderpoint ? 'red' : 'green'?>"> คงคลัง
            <?=$product->Product_quantity?> ชิ้น<br>
            <!-- ถ้าหากสินค้าน้อยกว่าจุดสั่งซื้อเพิ่มคำแจ้งเตือนว่าน้อยกว่าแล้ว -->
            <?=$product->Product_quantity < $product->re_orderpoint ? "<hr><b>น้อยกว่า<br> จุดสั่งซื้อ " . ($product->re_orderpoint - $product->Product_quantity) . ' ชิ้น' : ''?></b>
        </td>
        <td><?=$product->Product_cost?></td>
        <td>
            <div class="row">
                <div class="col-6">
                    <?=Html::textInput("", 1, ["id" => "productInput$product->PNo", "type" => "number" , "min" =>"0","class" => "form-control"])?>
                </div>
                <div class="col-6">
                    <?=Html::button('สั่งซื้อ', ["class" => "btn btn-info", "onclick" => "addToList($product->PNo,'$product->Product_name',$product->Product_cost)"])?>
                    <?=Html::a('เทียบสินค้าอื่น', Url::to(["product/compare?prod_id=$product->PNo"]), ["class" => "btn btn-success", "target" => "_blank"])?>
                </div>
            </div>
        </td>
    </tr>
    <?php }?>

    <table class="d-none">
        <tr id="template">
            <input type="hidden" name="prod_id[]" id="prod_id%i%">
            <input type="hidden" name="prod_qty[]" id="prod_qty%i%">
            <td>%prodName%</td>
            <td>%prodQty%</td>
            <td>%price%</td>
            <td><?=Html::a('ลบ', null, $options = ['class' => 'btn btn-danger', 'onclick' => "$('#row%i%').remove()"])?>
            </td>
        </tr>
    </table>

</tbody>
</table>


<?php $this->beginBlock("scripts");?>
<script>
$("#purchasebill-sup_id").change(function(e) {
    e.preventDefault();
    <?php if (empty($model->id)): ?>
    window.open("<?=Url::to(["purchase-bill/create?sup_id="])?>" + $("#purchasebill-sup_id").val(),
        "_self");
    <?php else: ?>
    window.open("<?=Url::to(["purchase-bill/update?id=$model->id&sup_id="])?>" + $(
            "#purchasebill-sup_id")
        .val(), "_self");
    <?php endif;?>
});

function addToList(id, name, price) {
    var template = $("#template").html();
    template = template.replaceAll("%i%", id);
    template = template.replace("%prodName%", name);
    template = template.replace("%prodQty%", $("#productInput" + id).val());
    template = template.replace("%price%", price * $("#productInput" + id).val());
    template = "<tr id='row" + id + "'>" + template + "</tr>";
    $("#list-products").append(template);
    $("#prod_id" + id).val(id);
    $("#prod_qty" + id).val($("#productInput" + id).val());
    console.log("#prod_id" + id);
    console.log($("#prod_id" + id).val());
    console.log($("#prod_qty" + id).val());
}
</script>
<?php endif;?>
<?php $this->endBlock();?>