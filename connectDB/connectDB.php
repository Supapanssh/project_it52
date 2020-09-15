<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "market";
$conn = new mysqli($server, $username, $password, $db_name);
//connect database
mysqli_query($conn, "SET NAMES 'utf8' ");
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
if ($conn->connect_errno) {
    printf("เชื่อมต่อฐานข้อมูลไม่ได้", $conn->connect_error);
    exit();
}
mysqli_set_charset($conn, 'utf8');
