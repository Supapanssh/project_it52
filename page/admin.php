<?php
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
    </style>
</head>

<body>
    <div if="wrapper">


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
                    <span class="sr-only">Toggle navigation</span>
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

                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="index.php"><i class="fa fa-home fa-fw "></i> Cashier</a>
                        </li>

                        <?php if (strcmp($ses_stat, 'ADMIN') == 0 || strcmp($ses_stat, 'MANAGER') == 0) { ?>
                            <li>
                                <a href="manage.php"><i class="fa fa-edit fa-fw"></i> Manage Product</a>
                            </li>
                        <?php } ?>
                        <?php if (strcmp($ses_stat, 'ADMIN') == 0) { ?>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Transactions <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="trad-trans.php"> Trading transaction</a>
                                    </li>
                                    <li>
                                        <a href="mang-trans.php"> Manage transaction</a>
                                    </li>
                                    <li>
                                        <a href="report.php"> Report</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                <a href="user.php"><i class="fa fa-users fa-fw "></i> USER</a>

                            </li>

                            <li>
                                <a href="employee.php"><i class="fa fa-users fa-fw "></i>EMPLOYEE</a>

                            </li>

                            <li>
                                <a href="supplier.php"><i class="fa fa-users fa-fw "></i>SUPPLIER</a>

                            </li>
                        <?php } ?>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="container">
            <?php
            $site = null;
            if (!empty($_GET['site'])) {
                $site = $_GET['site'];
            }
            switch ($site) {
                case null:
                    include("home.php");
                    break;
                case "test":
                    include('testContent.php');
                    break;
                case "user":
                    include("user.php");
                    break;
                default:
                    include("home.php");
                    break;
            }
            ?>
        </div>
    </div>

</body>

</html>