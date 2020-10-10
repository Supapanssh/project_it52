<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require('../config.php');
require('../connect.php');
//require_once('../functions.php');
require('../vendor/autoload.php');
$want = 'MANAGER';
require('check_user.php');
$generator = new \Picqer\Barcode\BarcodeGeneratorPNG();


if (isset($_GET['no'])) {

    $no = $_GET['no'];

    $sql = "SELECT * FROM product LEFT JOIN category ON product.category_id = category.category_id WHERE Product_code LIKE '%$no%'";
    #excute statement
    $stmt = $mysql_db->query($sql);
    #get result
    $row = $stmt->fetch();


    $stmt = $mysql_db->query("SELECT * FROM category");
    #get result
    $type = $stmt->fetchAll();


    //    print_r($type);

} else {
}

if (isset($_POST['no'])) {

    $code = $_POST['no'];
    $name = $_POST['name'];
    $product_desc = $_POST['Product_desc'];
    $product_unit = $_POST['Product_unit'];
    $product_price = $_POST['Product_price'];
    $product_cost = $_POST['Product_cost'];
    $category_id = $_POST['category_id'];
    $product_exp = $_POST['Product_exp'];

    if (empty($category_id)) {
        $category_id = 'null';
    }

    $sql = "UPDATE product SET 
     Product_name = '$name',
     Product_price = '$product_price', 
     Product_desc = '$product_desc',
     category_id = '$category_id',
     Product_cost = '$product_cost',
     Product_unit = '$product_unit',
     Product_exp = '$product_exp'  
     WHERE product_code like '%" . $code . "%';";

    $stmt = $mysql_db->query($sql);
    header('Location: admin.php?site=manage');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('style.php'); ?>
    <style>

    </style>
</head>


<body>
    <?php $code = base64_encode($generator->getBarcode($no, $generator::TYPE_CODE_128)); ?>
    <div class="row">
        <div class="col-lg-12 " style="vertical-align:middle;text-align:center">
            <h1 class="page-header" align="center">รายละเอียดสินค้า</h1>
            <img style="min-height: 50px;" src="data:image/png;base64,
        <?= $code ?>">
            <p style="font-size: 30px"> <?= $no ?> </p>
        </div>
        <div class="col-lg-12 ">
            <form action="product_manage.php" method="post">
                <input type="hidden" name="code" value="<?= $code ?>">
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">รหัสสินค้า</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_no" value="<?= $row['Product_no'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ชื่อสินค้า</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="name" value="<?= $row['Product_name'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">หมวดหมู่สินค้า</span>
                    <select name="category_id" class="form-control" style="font-size: 30px;min-height: 50px">
                        <option value="">เลือกชนิดสินค้า</option>
                        <?php
                        foreach ($type as $t) {
                            if ($t['category_id'] == $row['category_id']) { ?>
                                <option value="<?= $t['category_id'] ?>" selected><?= $t['category_name'] ?></option>
                            <?php } else { ?>
                                <option value="<?= $t['category_id'] ?>"><?= $t['category_name'] ?></option>


                        <?php }
                        } ?>
                        <!--                    <option value="1">1</option>-->
                        <!--                    <option value="2" selected>2</option>-->
                        <!--                    <option value="3">3</option>-->
                        <!--                    <option value="4">4</option>-->

                    </select>
                    <!--                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="type" value="-->
                    <?//= $row['TName'] ?>
                    <!--">-->
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">รายละเอียด</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_desc" value="<?= $row['Product_desc'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">หน่วยสินค้า</span>
                    <select style="font-size: 30px;min-height: 50px" class="form-control" name="Product_unit" id="Product_unit">
                        <?php $unitOptions = ['ไม่มีหน่วยสินค้า', 'ลิตร', 'ชิ้น', 'อัน']; ?>
                        <?php foreach ($unitOptions as $option) : ?>
                            <option value="<?= $option ?>"><?= $option ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ราคาขาย</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_price" value="<?= $row['Product_price'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ราคาต้นทุน</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_cost" value="<?= $row['Product_cost'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">คงเหลือ</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" value="<?= $row['Product_quantity'] ?>" >
                </div> <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">รับประกันสินค้า</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_exp" value="<?= $row['Product_exp'] ?>" autocomplete="off">
                </div>


                <input name="no" value="<?= $no ?>" hidden>

                <button style="font-size: 25px" type="submit" class="btn btn-success btn-block">อัปเดท</button>
                <button style="font-size: 25px" type="button" onclick="click_add(<?= $no ?>)" class="btn btn-info btn-block">เพิ่มจำนวนสินค้า</button>

            </form>
        </div>
    </div>


</body>

<script>
    function click_add(x) {
        // window.location.href = "product_manage.php?no=" + x;
        $('#product_info').modal('show').find('.modal-body').load('product_add.php?no=' + x);
    }
</script>