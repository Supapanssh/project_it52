<?php
require('../config.php');
require('../connect.php');
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
