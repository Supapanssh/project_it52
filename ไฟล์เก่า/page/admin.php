<?php
require('../config.php');
require('../connect.php');
require_once('../functions.php');
require('../vendor/autoload.php');
$want = 'CASHIER';
require('check_user.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['ses_id'])) {

    $ses_id = $_SESSION['ses_id'];                                          //สร้าง session สำหรับเก็บค่า ID
    $ses_name = $_SESSION['ses_name'];
    $ses_stat = $_SESSION['ses_status'];
    if ($ses_id <> session_id() || $ses_name == "") {
        //            echo 'yes';
        //            exit();
        header('Location: login.php');
    }
    //        echo 'no';
    //        exit();
} else {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('style.php'); ?>
    <style>
        table.hover-table tr:hover td {
            color: #4cae4c;
            cursor: pointer;
        }



        .grandtotal {
            background-color: #333;
            height: 100%;
            min-width: 270px;
            padding: 11px 10px 10px;
            float: right;
            text-align: left;
            margin-right: 118px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            position: relative;

        }

        .grandtotal h2 {
            color: #999999;
            float: left;
            font-family: 'noto_sansregular', 'Lucida Grande', sans-serif;
            font-size: 16px;
            font-weight: normal;
            line-height: 18px;
            margin: auto auto auto auto;
            padding-left: 5px;
            padding-top: 1px;
            text-align: left;
            width: 45px;
        }

        .grandtotal h1 {
            color: #fff;
            font-family: 'noto_sansregular', 'Lucida Grande', sans-serif;
            font-size: 40px;
            line-height: 100%;
            font-weight: normal;
            text-transform: uppercase;
            margin: auto;
            text-align: center;

            margin-top: -2px;
            float: left;

        }

        .pay-button1 {
            background-color: #20BF25;
            border: 0 none;
            border-radius: 3px;
            color: #FFFFFF;
            cursor: pointer;
            float: right;
            font-family: 'noto_sansregular', 'Lucida Grande', sans-serif;
            font-size: 21px;
            font-weight: normal;
            font-style: normal;
            height: 38px;
            line-height: 21px;
            outline: medium none;
            padding: 8px 9px 10px 10px;
            /*position: absolute;*/
            right: 10px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            top: 10px;

        }

        .modal {
            text-align: center;
            padding: 0 !important;
        }

        .modal:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
            margin-right: -4px;
        }

        .modal-dialog {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }

        .text_modal {

            font-size: 30px;
        }

        .payinput {
            font-size: 40px;
            min-height: 60px;
            text-align: right;
        }

        .navbar-default {
            background-color: #E8F8F5 !important;
            border-color: #EBF5FB !important;
        }

        #page-wrapper {
            padding: 0 15px;
            min-height: 568px;
            background-color: #F8F9F9 !important;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../vendor/raphael/raphael.min.js"></script>
        <script src="../vendor/morrisjs/morris.min.js"></script>
        <script src="../data/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">System</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">BumrungChu Electric</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i><span><?= $ses_name ?></span> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> ออกจากระบบ</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse ">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="admin.php"><i class="fa fa-home fa-fw "></i> ขายสินค้า</a>
                        </li>

                        <?php if (strcmp($ses_stat, 'ADMIN') == 0 || strcmp($ses_stat, 'MANAGER') == 0) { ?>
                            <li>
                                <a href="admin.php?site=manage"><i class="fa fa-edit fa-fw"></i>จัดการสินค้า</a>
                            </li>
                        <?php } ?>
                        <?php if (strcmp($ses_stat, 'ADMIN') == 0) { ?>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> การจัดการ <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="admin.php?site=trad-trans"> ข้อมูลการซื้อขาย</a>
                                    </li>
                                    <li>
                                        <a href="admin.php?site=mang-trans">จัดการซื้อขาย</a>
                                    </li>
                                    <li>
                                        <a href="admin.php?site=report">รายงาน</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="admin.php?site=user"><i class="fa fa-users fa-fw "></i>ผู้ใช้งาน</a>

                            </li>

                            <li>
                                <a href="admin.php?site=employee"><i class="fa fa-users fa-fw "></i>พนักงาน</a>

                            </li>

                            <li>
                                <a href="admin.php?site=supplier"><i class="fa fa-users fa-fw "></i>บริษัทคู่ค้า</a>

                            </li>
                        <?php } ?>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <?php
        $site = null;
        if (!empty($_GET['site'])) {
            $site = $_GET['site'];
        }
        switch ($site) {
            case null:
                include("home.php");
                break;
            case "manage":
                include('manage.php');
                break;
            case "trad-trans":
                include("trad-trans.php");
                break;
            case "mang-trans":
                include("mang-trans.php");
                break;
            case "report":
                include("report.php");
                break;
            case "user":
                include("user.php");
                break;
            case "employee":
                include("employee.php");
                break;
            case "supplier":
                include("supplier.php");
                break;
            default:
                include("home.php");
                break;
        }
        ?>

    </div>

</body>

</html>