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



if(isset($_GET['ID'])) {

    $no = $_GET['ID'];

    $sql = "SELECT * FROM `employee` ";

    #excute statement
    $stmt = $mysql_db->query($sql);
    #get result
    $row = $stmt->fetch();

//    print_r($type);

}
else{
    $bill = '';

    $rows = '';
}

if(isset($_POST['ID'])) {
    $id=$_POST['ID'];
    $Emp_ID         =   $_POST['Emp_ID'];
    $Emp_idcard     =   $_POST['Emp_idcard'];
    $Emp_name       =   $_POST['Emp_name'];
    $Emp_lname      =   $_POST['Emp_lname'];
    $Emp_sex        =   $_POST['Emp_sex'];
    $Emp_tel        =   $_POST['Emp_tel'];
    $Emp_address     =  $address;
    $Emp_moo         =   $_POST['Emp_moo'];
    $Emp_tumbol      =   $_POST['Ref_subdist_id'];
    $Emp_amphur      =   $_POST['Ref_dist_id'];
    $Emp_road        =   $_POST['Emp_road'];
    $Emp_province    =   $_POST['Ref_prov_id'];
    $Emp_zipcode     =   $_POST['zip_code'];
    $Emp_mail        =   $_POST['Emp_mail'];
    $Emp_start       =   $_POST['Emp_start'];
    $Emp_quit        =   $_POST['Emp_quit'];
    $Emp_status      =   $_POST['Emp_status'];


    $sql = "UPDATE `employee` SET `Emp_ID` = '$Emp_ID', `Emp_idcard` = '$Emp_idcard', `Emp_name` = '$Emp_name',
    `Emp_lname` = '$Emp_lname' , `Emp_sex` = '$Emp_sex' , `Emp_tel` = '$Emp_tel' , `Emp_address` = '$Emp_address'
    , `Emp_mail` = '$Emp_mail' , `Emp_start` = '$Emp_start', `Emp_quit` = '$Emp_quit' , `Emp_status` = '$Emp_status' WHERE `ID` = '$ID';";
//    echo $sql;
//    exit();

    $stmt = $mysql_db->query($sql);
    header('Location: admin.php?site=employee');


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
        <h1 class="page-header" align="center">Employee detail</h1>

    </div>
    <div class="col-lg-12 " >
        <form action="employee_edit.php" method="post" >
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">รหัสบัตรประจำตัวประชาชน</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_idcard" value="<?= $row['Emp_idcard'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ชื่อ</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_name" value="<?= $row['Emp_name'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">นามสกุล</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_lname" value="<?= $row['Emp_lname'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">เพศ</span>
                    <select style="font-size: 30px;min-height: 50px" class="form-control" name="Emp_sex" id="Emp_sex">
                        <?php $unitOptions = ['ชาย', 'หญิง']; ?>
                        <?php foreach ($unitOptions as $option) : ?>
                            <option value="<?= $option ?>"><?= $option ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">บ้านเลขที่</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_moo" value="<?= $row['Emp_moo'] ?>" autocomplete="off">
            </div>
                <div class="form-group input-group">
                    <span style="font-size: 30px" class="input-group-addon">ที่อยู่</span>
                    <input style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_address" value="<?= $row['Emp_address'] ?>" autocomplete="off">
                </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">เบอร์โทร</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_tel" value="<?= $row['Emp_tel'] ?>" autocomplete="off">
            </div>
            
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">วันที่เริ่มทำงาน</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_start" value="<?= $row['Emp_start'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">วันที่ออกจากงาน</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="Emp_quit" value="<?= $row['Emp_quit'] ?>" autocomplete="off">
            </div>
           

            <input name="ID" value="<?= $ID ?>" hidden>

            <button style="font-size: 25px" type="submit" class="btn btn-success btn-block">Update</button>

        </form>
    </div>
</div>



</body>

<script>

</script>