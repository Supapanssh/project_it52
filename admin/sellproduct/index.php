<?php

use yii\helpers\Url;
?>

<div class="card">
    <div class="card-header">ตะกร้าสินค้า</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ชื่อสินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sum = 0;
                foreach (Yii::$app->user->identity->carts as $cart) :
                ?>
                    <tr>
                        <td><?= $cart->pNo->Product_name ?></td>
                        <td><?= $cart->quantity ?> (<?= $cart->pNo->Product_price ?> บาท/ชิ้น)</td>
                        <td><?= $cart->pNo->Product_price * $cart->quantity ?></td>
                        <?php $sum += $cart->pNo->Product_price * $cart->quantity; ?>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>ราคารวม</td>
                    <td></td>
                    <td><?= $sum ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<table width="100%" class="table table-striped table-bordered  hover-table" id="product-table">
    <col width="20%">
    <col width="30%">
    <col width="30%">
    <col width="10%">
    <col width="40%">
    <thead>
        <tr>
            <th>บาร์โค้ด</th>
            <th>ชื่อสินค้า</th>
            <th>รายละเอียดสินค้า</th>
            <th>หน่วย</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td><?= $product->Product_code ?></td>
                <td><?= $product->Product_name ?></td>
                <td><?= $product->Product_desc ?></td>
                <td><?= $product->Product_unit ?></td>
                <td>
                    <form action="<?= Url::to('sellproduct/add-to-cart') ?>" method="GET">
                        <input type="number" name="quantity" id="quantity" class="form-control">
                        <input type="hidden" name="prod_id" value="<?= $product->PNo ?>">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus "></i></button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>