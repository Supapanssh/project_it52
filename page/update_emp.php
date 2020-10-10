<?php
require('../config.php');
require('../connect.php');
if (isset($_GET['ID'])) {

    $ID = $_GET['ID'];

    $sql = "SELECT * FROM `employee` ";

    #excute statement
    $stmt = $mysql_db->query($sql);
    #get result
    $row = $stmt->fetch();

    //print_r($type);

} else {
    $bill = '';

    $rows = '';
}

if (isset($_POST['ID'])) {
    $ID = $_POST['ID'];
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
    , `Emp_mail` = '$Emp_mail' , `Emp_start` = '$Emp_start', `Emp_quit` = '$Emp_quit' , `Emp_status` = '$Emp_status' WHERE `ID` = '$id';";
    //    echo $sql;
    //    exit();

    $stmt = $mysql_db->query($sql);
    header('Location: admin.php?site=employee');
}

?>