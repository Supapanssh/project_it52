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



if(isset($_GET['no'])) {

    $no = $_GET['no'];

    $sql = "SELECT userNo,username,nickname,user_email,status FROM `user` WHERE userNo = $no";

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

if(isset($_POST['no'])) {

    $no=$_POST['no'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $user_email=$_POST['user_email'];
    $status = $_POST['status'];
    $password = $_POST['password'];

    if($_POST['password']=='')
        $password = '';
    else
        $password = ',`password` = '."'".$_POST['password']."'";


    $sql = "UPDATE `user` SET `username` = '$username', `nickname` = '$name', `user_email` = '$user_email',`status` = '$status' $password WHERE `userNo` = '$no';";
//    echo $sql;
//    exit();

    $stmt = $mysql_db->query($sql);
    header('Location:admin.php?site=user');


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
        <h1 class="page-header" align="center">ข้อมูลผู้ใช้งาน</h1>

    </div>
    <div class="col-lg-12 " >
        <form action="user_edit.php" method="post" >
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ชื่อผู้ใช้งาน</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="username" value="<?= $row['username'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ชื่อ-สกุล</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="name" value="<?= $row['nickname'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">อีเมล</span>
                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="user_email" value="<?= $row['user_email'] ?>" autocomplete="off">
            </div>
            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">ประเภทผู้ใช้งาน</span>
                <select name="status" class="form-control" style="font-size: 30px;min-height: 50px">
                    <option value="">--selected--</option>
                    <option value="USER" <?php if(strcmp($row['status'],'USER') == 0)echo 'selected'?>>USER</option>
                    <option value="CASHIER" <?php if(strcmp($row['status'],'CASHIER') == 0)echo 'selected'?>>CASHIER</option>
                    <option value="ADMIN" <?php if(strcmp($row['status'],'ADMIN') == 0)echo 'selected'?>>ADMIN</option>
                </select>
<!--                <input  style="font-size: 30px;min-height: 50px" type="text" class="form-control" name="type" value="--><?//= $row['category_name'] ?><!--">-->
            </div>

            <div class="form-group input-group" >
                <span style="font-size: 30px" class="input-group-addon">รหัสผ่าน</span>
                <input  name ="pass" style="font-size: 30px;min-height: 50px" type="password" class="form-control" placeholder="password">
            </div>

            <input name="no" value="<?= $no ?>" hidden>

            <button style="font-size: 25px" type="submit" class="btn btn-success btn-block">อัปเดท</button>

        </form>
    </div>
</div>



</body>

<script>

</script>