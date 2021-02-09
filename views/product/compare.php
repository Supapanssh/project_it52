<?php

use app\models\Product;
use yii\helpers\Url;

$thisProd = Product::findOne($prod_id);
$compareProd = Product::find()->where(["category_id" => $thisProd->category_id])->all();

?>


<h4>
    <?= $thisProd->Product_name ?> ราคาทุน : <?= $thisProd->Product_cost ?>
</h4>


<div class="card-body p-2">
    <table class="table table-striped table-inverse data-table table-hover">
        <thead class="thead-inverse">
            <tr>
                <th>ชื่อสินค้า</th>
                <th>ราคาทุน</th>
                <th>เปรียบเทียบราคา</th>
                <th>ซัพพลายเออร์</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($compareProd as $prod) : ?>
                <tr>
                    <td scope="row"><a href="<?= Url::to(["product/view?id=$prod->PNo"]) ?>"><?= $prod->Product_name ?></a></td>
                    <td><?= $prod->Product_cost ?></td>
                    <td class="bg-<?= $thisProd->Product_cost < $prod->Product_cost ? 'danger' : 'success' ?>"><?= $thisProd->Product_cost < $prod->Product_cost ? 'แพงกว่า' : 'ถูกกว่า' ?> / <?= number_format($thisProd->Product_cost - $prod->Product_cost > 0 ? $thisProd->Product_cost - $prod->Product_cost : ($thisProd->Product_cost - $prod->Product_cost) * -1)  ?> บาท</td>
                    <td><?= $prod->sup->sup_company ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>