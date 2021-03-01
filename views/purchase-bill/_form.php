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

<?php $form = ActiveForm::begin(); ?>
<?php
$sobject = app\models\Supplier::find()->all();
$sarray = ArrayHelper::map($sobject, 'sup_id', 'sup_company');
?>
<div class="row">
    <div class="col-6">
        <div class="card p-3">
            <?= $form->field($model, 'sup_id')->dropDownList($sarray, ["prompt" => "choose..", "value" => $_GET["sup_id"] ?? $model->sup_id, "onchange" => "getSup()"]) ?>
            <?= $form->field($model, 'date')->textInput(["type" => "date"]) ?>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> รายการสินค้า</h1>
            </div>
            <ul class="list-group list-group-flush" style="height:40vh;overflow:auto;">
                <li v-for="(object,index) in carts" class="list-group-item">
                    <input type="hidden" name="prod_id[]" v-model="object.id">
                    {{ object.name }}
                    <div class="form-group">
                        <label>จำนวน (ชิ้น)</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control" name="prod_qty[]" v-model="object.qty">
                            </div>
                            <div class="col-2">
                                <strong id="helpId" class="form-text text-muted">{{ object.cost * object.qty }} บาท</strong>
                            </div>
                            <div class="col-4">
                                <?= $form_mode == "view" ? null : Html::a("<i class='fa fa-trash' aria-hidden='true'></i> ลบออก", null, $options = ['class' => 'btn btn-danger w-100', "v-on:click" => "removeItem(index)"]) ?>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?= $form_mode == "view" ? null : Html::submitButton('<i class="fas fa-save"></i> บันทึก', ['class' => 'btn btn-success w-100']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
<?php if ($form_mode == "edit") : ?>
    <div class="card">
        <div class="card-header bg-info">
            <h1 class="card-title"><i class="fa fa-industry" aria-hidden="true"></i> สินค้าจาก Supplier</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead class="thead-inverse">
                    <th>สินค้า</th>
                    <th>จำนวนคงเหลือ</th>
                    <th>ราคาต้นทุน</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                        <tr>
                            <td><?= $product->Product_name ?></td>
                            <td style="vertical-align:middle;text-align:right;color:
                        <?= $product->Product_quantity < $product->re_orderpoint ? 'red' : 'green' ?>"> คงคลัง
                                <?= $product->Product_quantity ?> ชิ้น<br>
                                <?= $product->Product_quantity < $product->re_orderpoint ? "<hr><b>น้อยกว่า<br> จุดสั่งซื้อ " . ($product->re_orderpoint - $product->Product_quantity) . ' ชิ้น' : '' ?></b>
                            </td>
                            <td><?= $product->Product_cost ?></td>
                            <td>
                                <?= Html::button('<i class="fa fa-cart-plus" aria-hidden="true"></i> หยิบ', ["class" => "btn btn-info", "v-on:click" => "addToList($product->PNo,'$product->Product_name',$product->Product_cost,1)"]) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php $this->beginBlock("scripts"); ?>
<script>
    function getSup() {
        <?php if (empty($model->id)) : ?>
            window.open("<?= Url::to(["purchase-bill/create?sup_id="]) ?>" + $("#purchasebill-sup_id").val(), "_self");
        <?php else : ?>
            window.open("<?= Url::to(["purchase-bill/update?id=$model->id&sup_id="]) ?>" + $("#purchasebill-sup_id").val(), "_self");
        <?php endif; ?>
    }

    var app = new Vue({
        el: '#app',
        data: {
            carts: []
        },
        mounted() {
            <?php foreach ($model->purchases as $purchase) : ?>
                this.addToList(<?= $purchase->PNo ?>, "<?= $purchase->pNo->Product_name ?>", <?= $purchase->pNo->Product_cost ?>, <?= $purchase->quantity ?>);
            <?php endforeach; ?>
        },
        methods: {
            addToList: function(id, name, cost, qty) {
                if (qty == null) {
                    qty = $("#productInput" + id).val();
                }
                obj = {
                    id: id,
                    name: name,
                    cost: cost,
                    qty: qty
                };
                console.log(obj);
                this.carts.push(obj);
            },
            removeItem: function(index) {
                this.carts.splice(index, 1);
            }
        }
    })
</script>
<?php $this->endBlock(); ?>