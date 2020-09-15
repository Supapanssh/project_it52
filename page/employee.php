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
require_once('../functions.php');
$want = 'ADMIN';
require('check_user.php');

$sql = "SELECT * FROM `employee` ";



#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();

if (isset($_POST['Emp_name'])) {

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


    $sql = "select Emp_name from employee where Emp_ID = '$Emp_ID';";
    $num = $mysql_db->query($sql);
    $num = $num->rowCount();
    if ($num == 0) {
        $sql = "INSERT INTO `employee` (`Emp_idcard`, `Emp_name`, `Emp_lname`, `Emp_sex`, `Emp_tel`, `Emp_address`, `Emp_moo`, `Emp_tumbol`, `Emp_amphur`
        , `Emp_road`, `Emp_province`, `Emp_zipcode`, `Emp_mail`, `Emp_start`,  `Emp_status`) VALUES 
        ('$Emp_idcard', '$Emp_name', '$Emp_lname', '$Emp_sex', '$Emp_tel', '$Emp_address', '$Emp_moo', '$Emp_tumbol', '$Emp_amphur'
        , '$Emp_road', '$Emp_province', '$Emp_zipcode', '$Emp_mail', '$Emp_start', '$Emp_status');";
        $stmt = $mysql_db->query($sql);
    } else {
        //        echo "HHHH";
        //        exit();
    }
    header('Location: employee.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php include('style.php'); ?>
    <style>
        table.hover-table tr:hover td {
            color: #4cae4c;
            cursor: pointer;
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
    </style>
</head>

<body>
    <?php
    $sql_provinces = "SELECT * FROM provinces";
    $query = mysqli_query($con, $sql_provinces);
    ?>

    <div id="wrapper">
        <?php include('header.php'); ?>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="align-content: center">ข้อมูลพนักงาน</h1>
                    <form method="post">
                        <div class="form-group row">
                            <div class="col-xs-3">
                                <label>รหัสบัตรประจำตัวประชาชน</label>
                                <input class="form-control" name="Emp_idcard" placeholder="idcard" autocomplete="off" maxlength="13" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
                            </div>
                            <div class="col-xs-3">
                                <label>ชื่อ</label>
                                <input class="form-control" name="Emp_name" placeholder="username" autocomplete="off">
                            </div>
                            <div class="col-xs-3">
                                <label>นามสกุล</label>
                                <input class="form-control" name="Emp_lname" placeholder="lastname" autocomplete="off">
                            </div>

                            <div class="col-xs-3">
                                <label>เพศ</label>
                                <select name="Emp_sex" class="form-control">
                                    <option value="">--เลือกเพศ--</option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                </select>
                            </div>

                            <div class="col-xs-3">
                                <label>เบอร์โทร</label>
                                <input class="form-control" name="Emp_tel" placeholder="tel" autocomplete="off" maxlength="10" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
                            </div>
                            <div class="col-xs-3">
                                <label>บ้านเลขที่</label>
                                <input class="form-control" name="Emp_address" placeholder="address" autocomplete="off">
                            </div>
                            <div class="col-xs-3">
                                <label>หมู่</label>
                                <input class="form-control" name="Emp_moo" placeholder="moo" autocomplete="off">
                            </div>


                            <div class='col-xs-3'>
                                <label>จังหวัด</label>
                                <select class="form-control" name="Ref_prov_id" id="provinces">
                                    <option value="" selected disabled>-กรุณาเลือกจังหวัด-</option>
                                    <?php foreach ($query as $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name_th'] ?></option>
                                    <?php } ?>
                                </select></div>
                            <br>


                            <div class='col-xs-3'>
                                <label>อำเภอ</label>
                                <select class="form-control" name="Ref_dist_id" id="amphures" placeholder="amphures">
                                </select></div>


                            <div class='col-xs-3'>
                                <label>ตำบล</label>
                                <select class="form-control" name="Ref_subdist_id" id="districts" placeholder="tumbol">
                                </select>
                                <br></div>

                            <div class='col-xs-3'>
                                <label>รหัสไปรษณีย์</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="zipcode">
                            </div>

                            <div class='col-xs-3'>
                                <label>อีเมล</label>
                                <input type="email" name="Emp_mail" class="form-control" id="Emp_mail" required placeholder="email">
                            </div>

                            <div class='col-xs-3'>
                                <label>วันที่เริ่มทำงาน</label>
                                <input type="datetime-local" class="form-control" name="Emp_start" id="Emp_start">
                            </div>


                                <div class='col-xs-3'>
                                <label>วันที่ออกจากงาน</label>
                                <input type="datetime-local" class="form-control" name="Emp_quit" id="Emp_quit">
                            </div>


                            <div class='col-xs-3'>
                                <label>สถานะ</label>
                                <div id="Emp_status" required>
                                    <input type="radio" name="Emp_status" id="Emp_status" value='ทำงาน'> ทำงาน
                                    <input type="radio" name="Emp_status" id="Emp_status" value='ลาออก'> ลาออก
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <br>
                                <button class="btn btn-info" onclick="click_add()">ADD Employee</button>
                            </div>
                    </form>

                    <div class="panel-body">

                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" align="center">
                            <b>Employee list</b>
                        </div>
                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered  hover-table " id="user-table">


                                <!--                            <col width="5%">-->

                                <thead>
                                    <tr>
                                        <th style="text-align:center">ID</th>

                                        <th style="text-align:center">IDcard</th>
                                        <th style="text-align:center">Username</th>
                                        <th style="text-align:center">Lastname</th>
                                        <th style="text-align:center">Gender</th>
                                        <th style="text-align:center">Tel</th>
                                        <th style="text-align:center">Address</th>
                                        <th style="text-align:center">Email</th>
                                        <th style="text-align:center">Start</th>
                                        <th style="text-align:center">Quit</th>
                                        <th style="text-align:center">Status</th>



                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($rows as $row) { ?>
                                        <tr onclick="click_user(<?= $row['ID'] ?>)">

                                            <td style="text-align:center"><?= $row['ID'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_ID'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_name'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_lname'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_sex'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_tel'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_address'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_email'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_start'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_quit'] ?></td>
                                            <td style="text-align:center"><?= $row['Emp_status'] ?></td>


                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="modal fade" id="user-info">
        <div class="modal-dialog ">
            <div class="modal-content">


                <!-- Modal Header -->
                <!--            <div class="modal-header">-->
                <!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
                <!--                <h4 class="modal-title" id="myModalLabel">Product Detail</h4>-->
                <!--            </div>-->
                <!-- Modal body -->
                <div class="modal-body ">


                </div>

                <!-- Modal footer -->


            </div>
        </div>
    </div>

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


    <script>
        $(document).ready(function() {
            $('#user-table').DataTable({
                responsive: true

            });
        });

        function click_user(x) {
            // alert("HELLO");
            // window.location.href = "product_manage.php?no=" + x;
            $('#user-info').modal('show').find('.modal-body').load('user_edit.php?no=' + x);
        }
    </script>
</body>
<?php include('script.php'); ?>