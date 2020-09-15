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

$sql = "SELECT Product_code,Product_name,Product_price,Product_cost,Product_Quantity,category_name,Product_desc,Product_unit FROM `product` LEFT JOIN category ON product.category_id = category.category_id" ;

#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();
//print_r($rows);
//exit();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('style.php'); ?>
    <style>
        table.hover-table tr:hover td {
            color: #4cae4c;
            cursor: pointer;
        }

        .modal {
            text-align: center;
            padding: 0!important;
        }

        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }


    </style>
</head>


<body>
<div id="wrapper">
    <?php include('header.php'); ?>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="align-content: center">จัดการสินค้า</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <button class="btn btn-info btn-block" onclick="click_add()" >เพิ่มสินค้าใหม่</button>
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
                    <div class="panel-body" >


                        <table width="100%" class="table table-striped table-bordered  hover-table"
                               id="product-table" >
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
<!--                            <col width="5%">-->

                            <thead>
                            <tr >
                                <th style="text-align:center">บาร์โค้ด</th>

                                <th style="text-align:center">ชื่อสินค้า</th>
                                <th style="text-align:center">หมวดหมู่</th>
                                <th style="text-align:center">รายละเอียด</th>
                                <th style="text-align:center">หน่วยสินค้า</th>
                                <th style="text-align:center">ราคาขาย</th>
                                <th style="text-align:center">ราคาต้นทุน</th>
                                <th style="text-align:center">จำนวน</th>
                               


                            </tr>
                            </thead>

                            <tbody >
                            <?php foreach ($rows as $row) { ?>
                                <tr onclick="click_product(<?= $row['Product_code'] ?>)">
                                    <td style="horiz-align:center;text-align:center">
                                        <img src="data:image/png;base64,<?= base64_encode($generator->getBarcode($row['Product_code'], $generator::TYPE_CODE_128))?>
                                        "><p >  <?= $row['Product_code'] ?> </p></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_name'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['category_name'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_desc'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_unit'] ?></td>
                                    <td style="vertical-align:middle;text-align:right"><?= $row['Product_price'] ?></td>
                                    <td style="vertical-align:middle;"><?= $row['Product_cost'] ?></td>
                                    <td style="vertical-align:middle;text-align:right"><?= $row['Product_Quantity'] ?></td>


                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
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
            <div class="modal-body " >


            </div>

            <!-- Modal footer -->


        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

<script>
    $(document).ready(function() {
        $('#product-table').DataTable(
            {
                responsive: true

            });
    });

    function click_product(x) {
        // window.location.href = "product_manage.php?no=" + x;
        $('#product_info').modal('show').find('.modal-body').load('product_manage.php?no='+x);
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
</body>