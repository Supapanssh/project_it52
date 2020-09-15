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

do{
    $rand = rand(0,9);

    for($i=0; $i<9; $i++) {
        $rand .= rand(0,9);
    }
    $sql = "select * from product where PNo like '$rand';";
    $num = $mysql_db->query($sql);
    $num = $num->rowCount();
}while( $num > 0);

$stmt = $mysql_db->query("SELECT * FROM category");
#get result
$type = $stmt->fetchAll();


if(isset($_POST['name'])) {


    $name = $_POST['name']  ;
    if($_POST['type']=='')
        $type = 'NULL';
    else
        $type    = $_POST['type'];
    $price       = $_POST['price'];
    $quan        = $_POST['quan'];
    $Product_detail  =$_POST['Product_detail'];
    $Product_cost   =$_POST['Product_cost'];
    $Product_unit   =$_POST['Product_unit'];

    $sql = "INSERT INTO `product` (`PNo`, `Product_code`, `Product_name`, `Product_price`, `Product_Quantity`, `Product_detail` , `Product_unit`, `Product_cost`,`category_id` ) VALUES (NULL, '$rand', '$name', '$price', '$Product_detail', '$Product_unit','$Product_cost', '$quan', $type);";
//    $sql = "INSERT INTO `product`  `Product_name` = '$name', `Product_price` = '$price', $type WHERE `product`.`Product_code` = '$Pno';";
//    echo $sql;
//    exit();

    $stmt = $mysql_db->query($sql);
    $last_order_id = $mysql_db->lastInsertId();
    $sql = "INSERT INTO `product_manage` (`Manage_No`, `Manage_Date`, `PNo`, `PeoNo`, `Manage_Amount`) VALUES (NULL, CURRENT_DATE(), '$last_order_id', $ses_userNo, '$quan')";
    $stmt = $mysql_db->query($sql);


    header('Location: manage.php');


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
<div class="row">
    <div class="col-lg-12 " style="vertical-align:middle;text-align:center">
        <h1 class="page-header" align="center">เพิ่มสินค้าใหม่</h1>
        <img style="min-height: 50px;" src="data:image/png;base64,
        <?= base64_encode($generator->getBarcode($rand, $generator::TYPE_CODE_128))?>">
        <p style="font-size: 30px">  <?= $rand ?> </p>
    </div>
    <div class="col-lg-12 " >
        <form action="product_new.php" method="post" >
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ชื่อสินค้า</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="name" placeholder="name" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">หมวดหมู่สินค้า</span>
                <select name="type" class="form-control" style="font-size: 30px;min-height: 50px">
                    <option value="">ไม่มีชนิดสินค้า</option>
                    <?php
                    foreach ($type as $t) {
                        if($t['category_id'] == $row['category_id'] ){?>
                            <option value="<?= $t['category_id']?>" selected><?= $t['category_name']?></option>
                        <?php }else{ ?>
                            <option value="<?= $t['category_id']?>"><?= $t['category_name']?></option>


                        <?php }} ?>
                    <!--                    <option value="1">1</option>-->
                    <!--                    <option value="2" selected>2</option>-->
                    <!--                    <option value="3">3</option>-->
                    <!--                    <option value="4">4</option>-->

                </select>
                <!--                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="type" value="--><?//= $row['TName'] ?><!--">-->
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ราคา</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="price" placeholder="price" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">รายละเอียด</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_detail" placeholder="detaiil" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">หน่วยสินค้า</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_unit" placeholder="unit" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ราคาต้นทุน</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Product_cost" placeholder="unit" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">จำนวน</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="quan" placeholder="quantity" autocomplete="off">
            </div>

            <button style="font-size: 25px" type="submit" class="btn btn-success btn-block">บันทึก</button>


        </form>
    </div>
</div>


</body>

<script>

</script>