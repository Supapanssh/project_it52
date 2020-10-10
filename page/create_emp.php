<?php
require('../config.php');
require('../connect.php');

if (!empty($_POST['Emp_name'])) {

    // บ้านเลขที่ หมู่
    $address = 'บ้านเลขที่ ' . $_POST['Emp_address'] . ' หมู่ ' . $_POST['Emp_moo'];

    //ตำบล
    $subDistSql = "SELECT districts.name_th FROM districts WHERE districts.id = {$_POST['Ref_subdist_id']}";
    $statement = $mysql_db->query($subDistSql)->fetch();
    $address .= ' ' . $statement[0];

    // อำเภอ
    $district = "SELECT amphures.name_th FROM amphures WHERE amphures.id = {$_POST['Ref_dist_id']}";
    $statement = $mysql_db->query($district)->fetch();
    $address .= ' ' . $statement[0];

    // จังหวัด
    $provinceSql = "SELECT provinces.name_th FROM provinces WHERE provinces.id = {$_POST['Ref_prov_id']}";
    $statement = $mysql_db->query($provinceSql)->fetch();
    $address .= ' ' . $statement[0] . ' ' . $_POST['zip_code'];
    // [Emp_moo] => 1 [Ref_prov_id] => 3 [Ref_dist_id] => 61 [Ref_subdist_id] => 120403 [zip_code] => 11110
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


    $sql = "select Emp_name from employee where Emp_ID = '.$Emp_ID.';";
    $num = $mysql_db->query($sql);
    $num = $num->rowCount();
    if ($num == 0) {
        $sql = "INSERT INTO `employee` (`Emp_ID`,`Emp_idcard`, `Emp_name`, `Emp_lname`, `Emp_sex`, `Emp_tel`, `Emp_address`, `Emp_moo`, `Emp_tumbol`, `Emp_amphur`
        , `Emp_road`, `Emp_province`, `Emp_zipcode`, `Emp_mail`, `Emp_start`,  `Emp_status`) VALUES 
        ('$Emp_ID','$Emp_idcard', '$Emp_name', '$Emp_lname', '$Emp_sex', '$Emp_tel', '$Emp_address', '$Emp_moo', '$Emp_tumbol', '$Emp_amphur'
        , '$Emp_road', '$Emp_province', '$Emp_zipcode', '$Emp_mail', '$Emp_start', '$Emp_status');";
        $stmt = $mysql_db->query($sql);
    } else {
        // echo $sql;
        //exit();
    }
    header('Location: admin.php?site=employee');
}



?>
