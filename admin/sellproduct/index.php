<?php

use yii\helpers\Url;
?>

<div class="card">
    <div class="card-header">ตะกร้าสินค้า</div>
    <div class="card-body">
        <table class="table data-table">
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
                foreach (Yii::$app->user->identity->carts as $cart) : //แสดงชื่อผู้ใช้งานที่ทำการขายสินค้า ณ ตอนนี้
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
    <div class="card-footer text-right">
        <a href="#" data-toggle="modal" data-target="#modelId" class="btn btn-primary active" role="button">สั่งซื้อสินค้า</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดรายการ / Description</h5>
                    <?= date("Y-m-d H:i:s") ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-striped ">
                            <tbody>
                                <?php
                                $sum = 0;
                                foreach (Yii::$app->user->identity->carts as $cart) : //แสดงชื่อผู้ใช้งานที่ทำการขายสินค้า ณ ตอนนี้
                                ?>
                                    <tr>
                                        <td><?= $cart->pNo->Product_name ?></td>
                                        <td><?= $cart->quantity ?> (<?= $cart->pNo->Product_price ?> บาท/ชิ้น)</td>

                                        <?php $sum += $cart->pNo->Product_price * $cart->quantity; ?>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><?= $cart->pNo->Product_price * $cart->quantity ?> บาท</td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-6">
                                <h3>ราคารวม: </h3>
                                <h3>VAT7% </h3>
                                <h2>ราคารวมสุทธิ: </h2>
                            </div>
                            <div class="col-6">
                                <h3>:<?= $sum ?> </h3>
                                <h3>:<?= $sum * 0.07   ?></h3>
                                <h2>:<?= $sum * 0.07 + $sum   ?> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- ทำการสั่งซื้อสินค้าโดยลิงค์ไปที่หน้า sellproduct/make-order ซึ่งเป็นฟังชั่นสร้างคำสั่งซื้อจากสินค้าในตะกร้า -->
                        <a href="<?= Url::to('sellproduct/make-order') ?>" class="btn btn-primary">ทำรายการสั่งซื้อ</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#exampleModal').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Use above variables to manipulate the DOM

            });
        </script>
    </div>

    <div class="card">
        <div class="card-header">รายการสินค้า</div>
        <div class="card-body">
            <table width="100%" class="data-table table table-striped table-bordered  hover-table" id="product-table">
                <col width="20%">
                <col width="30%">
                <col width="30%">
                <col width="10%">
                <col width="30%">
                <thead>
                    <tr>
                        <th>บาร์โค้ด</th>
                        <th>ชื่อสินค้า</th>
                        <th>รายละเอียดสินค้า</th>
                        <th>หน่วยสินค้า</th>
                        <th>จัดการ</th>
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
        </div>
    </div>