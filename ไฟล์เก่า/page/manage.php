<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../config.php');
require('../connect.php');
require_once('../functions.php');
require('../vendor/autoload.php');
$want = 'MANAGER';
require('check_user.php');
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
//$barcode = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
//Product_code,Product_name,Product_price,Product_desc,Product_Quantity,Product_unit,Product_cost,category_name
$sql = "SELECT * FROM `product` LEFT JOIN category ON product.category_id = category.category_id";
//$sql = "INSERT INTO 'web_config' ('master_k', 'avali') VALUES ('alert_low_stock', '20');";
//$sql = "SELECT * from 'web_config' where master_k='alert_low_stock';";

#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();
//print_r($rows);
//exit();


?>

<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="align-content: center">จัดการสินค้า</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <button class="btn btn-info btn-block" onclick="click_add()">เพิ่มสินค้าใหม่</button>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <button class="btn btn-info btn-block" onclick="click_type()">เพิ่มหมวดหมู่</button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                    <b>รายการสินค้า</b>
                </div>
                <div class="panel-body">


                    <table width="100%" class="table table-striped table-bordered  hover-table" id="product-table">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">

                        <!--                            <col width="5%">-->

                        <thead>
                            <tr>
                                <th style="text-align:center">บาร์โค้ด</th>

                                <th style="text-align:center">รหัสสินค้า</th>
                                <th style="text-align:center">ชื่อสินค้า</th>
                                <th style="text-align:center">หมวดหมู่</th>
                                <th style="text-align:center">รายละเอียด</th>
                                <th style="text-align:center">หน่วยสินค้า</th>
                                <th style="text-align:center">ราคาขาย</th>
                                <th style="text-align:center">ราคาต้นทุน</th>
                                <th style="text-align:center">คงเหลือ</th>
                                <th style="text-align:center">รับประกันสินค้า</th>


                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($rows as $row) { ?>
                                <tr onclick="click_product(<?= $row['Product_code'] ?>)">
                                    <td style="horiz-align:center;text-align:center">
                                        <img src="data:image/png;base64,<?= base64_encode($generator->getBarcode($row['Product_code'], $generator::TYPE_CODE_128)) ?>
                                        ">
                                        <p> <?= $row['Product_code'] ?> </p>
                                    </td>
                                    <td style="vertical-align:middle;"><?= $row['Product_no'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_name'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['category_name'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_desc'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_unit'] ?></td>
                                    <td style="vertical-align:middle;text-align:right"><?= $row['Product_price'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_cost'] ?></td>
                                    <td style="vertical-align:middle;text-align:right;color:<?= (int)$row['Product_quantity'] < 20 ? 'red' : 'green' ?>"><?= $row['Product_quantity'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_exp'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="product_info">
    <div class="modal-dialog ">
        <div class="modal-content">


            <!-- Modal Header -->
            <!--            <div class="modal-header">-->
            <!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
            <!--                <h4 class="modal-title" id="myModalLabel">Product Detail</h4>-->
            <!--            </div>-->
            <!-- Modal body -->
            <div class="modal-body ">


            </div>

            <!-- Modal footer -->


        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#product-table').DataTable({
            responsive: true

        });
    });

    function click_product(x) {
        // window.location.href = "product_manage.php?no=" + x;
        $('#product_info').modal('show').find('.modal-body').load('product_manage.php?no=' + x);
    }

    function click_add() {
        // window.location.href = "product_manage.php?no=" + x;
        $('#product_info').modal('show').find('.modal-body').load('product_new.php');
    }

    function click_type() {
        // window.location.href = "product_manage.php?no=" + x;
        $('#product_info').modal('show').find('.modal-body').load('type_new.php');
    }
</script>