<?php
$con = mysqli_connect("localhost", "root", "", "stock") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
?>

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require('../config.php');
require('../connect.php');
//require_once('../functions.php');
require('../vendor/autoload.php');
$want = 'ADMIN';
require('check_user.php');



if (isset($_GET['sup_id'])) {

    $sup_id = $_GET['sup_id'];

    $sql = "SELECT * FROM `supplier`";

    #excute statement
    $stmt = $mysql_db->query($sql);
    #get result
    $row = $stmt->fetch();

    //    print_r($type);

} else {
    $bill = '';

    $rows = '';
}

if (isset($_POST['sup_id'])) {

    $sup_username = $_POST['sup_username'];
    $sup_company = $_POST['sup_company'];
    $sup_address = $s_address;
    $sup_moo         =   $_POST['sup_moo'];
    $sup_tumbol      =   $_POST['Ref_subdist_id'];
    $sup_amphur      =   $_POST['Ref_dist_id'];
    $Emp_province    =   $_POST['Ref_prov_id'];
    $Emp_zipcode     =   $_POST['zip_code'];
    $sup_tel         = $_POST['sup_tel'];
    $sup_detail      = $_POST['sup_detail'];

    $sql = "UPDATE `supplier` SET `sup_company` = '$sup_company', `sup_username` = '$sup_username', `sup_address` = '$sup_adrress',`sup_tel` = '$sup_tel' ,`sup_detail` = '$sup_detail' WHERE `sup_id` = '$sup_id';";
    //    echo $sql;
    //    exit();

    $stmt = $mysql_db->query($sql);
    header('Location:admin.php?site=supplier');
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
            <h1 class="page-header" align="center">รายละเอียดบริษัทคู่ค้า</h1>

        </div>
        <div class="col-lg-12 ">
            <form action="update_supplier.php" method="post">
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ชื่อบริษัทคู่ค้า</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="sup_company" value="<?= $row['sup_company'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ชื่อ-นามสกุล</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="sup_username" value="<?= $row['sup_username'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ที่อยู่</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="sup_address" value="<?= $row['sup_address'] ?>" autocomplete="off">
                </div>

                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">เบอร์โทร</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="sup_tel" value="<?= $row['sup_tel'] ?>" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">รายละเอียด</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="sup_detail" value="<?= $row['sup_detail'] ?>" autocomplete="off">
                </div>

                <input name="sup_id" value="<?= $sup_id ?>" hidden>

                <button style="font-size: 25px" type="submit" class="btn btn-success btn-block">อัปเดท</button>

            </form>
        </div>
    </div>



</body>

<script>

</script>