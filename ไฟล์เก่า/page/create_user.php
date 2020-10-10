<?php
require('../config.php');
require('../connect.php');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $user_email = $_POST['user_email'];
    $status = $_POST['status'];
    $password = $_POST['password'];


    $sql = "select nickname from user where username = '$username';";
    $num = $mysql_db->query($sql);
    $num = $num->rowCount();
    if ($num == 0) {
        $sql = "INSERT INTO `user` (`userNo`, `username`, `nickname`, `password`, `user_email`, `status`) VALUES (NULL, '$username', '$name', '$password', '$user_email', '$status');";
        $stmt = $mysql_db->query($sql);
    } else {
        //        echo "HHHH";
        //        exit();
    }
    header('Location: admin.php?site=user');
}
