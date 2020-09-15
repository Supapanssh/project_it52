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

$sql = "SELECT * FROM `supplier` ";

#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();


if (isset($_POST['sup_username'])) {
    // บ้านเลขที่ หมู่
    $address = 'บ้านเลขที่ ' . $_POST['supaddress'] . ' หมู่ ' . $_POST['sup_moo'];

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


    $sup_id = $_POST['sup_id'];
    $sup_username = $_POST['sup_username'];
    $sup_company = $_POST['sup_company'];
    $sup_address = $address;
    $sup_moo         =   $_POST['sup_moo'];
    $sup_tumbol      =   $_POST['Ref_subdist_id'];
    $sup_amphur      =   $_POST['Ref_dist_id'];
    $Emp_province    =   $_POST['Ref_prov_id'];
    $Emp_zipcode     =   $_POST['zip_code'];
    $sup_tel = $_POST['sup_tel'];
    $sup_detail = $_POST['sup_detail'];


    $sql = "select sup_name from supplier where sup_id = '$sup_id';";
    $num = $mysql_db->query($sql);
    $num = $num->rowCount();
    if ($num == 0) {
        $sql = "INSERT INTO `supplier` (`sup_company`, `sup_username`, `sup_address`, `sup_moo`, `sup_tumbol`, `sup_amphur`
        , `sup_province`, `sup_zipcode`, `sup_tel`, `sup_detail`) VALUES 
        ('$sup_company', '$sup_username', '$sup_address', '$sup_moo', '$sup_tumbol', '$sup_amphur', '$sup_province', '$sup_zipcode', '$sup_tel'
        , '$sup_detail');";
        $stmt = $mysql_db->query($sql);
    } else {
        //        echo "HHHH";
        //        exit();
    }
    header('Location: supplier.php');
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
                        <h1 class="page-header" style="align-content: center">ข้อมูลบริษัทคู่ค้า</h1>
                        <form method="post">
                            <div class="form-group row">
                                <div class="col-xs-3">
                                    <label>ชื่อบริษัท</label>
                                    <input class="form-control" name="sup_company" placeholder="Company" autocomplete="off">
                                </div>
                                <div class="col-xs-3">
                                    <label>ชื่อ-นาสกุล</label>
                                    <input class="form-control" name="sup_username" placeholder="Username" autocomplete="off">
                                </div>
                                <div class="col-xs-3">
                                <label>หมู่</label>
                                <input class="form-control" name="sup_moo" placeholder="moo" autocomplete="off">
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

                                <div class="col-xs-3">
                                    <label>เบอร์โทรศัพท์</label>
                                    <input class="form-control" type="text" name="sup_tel" placeholder="Tel" maxlength="10" autocomplete="off" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
                                </div>
                                <div class="col-xs-3">
                                    <label>รายละเอียด</label>
                                    <input class="form-control" name="sup_detail" placeholder="Detail" autocomplete="off">
                                </div>
                                <div class="col-xs-3">
                                    <br>
                                    <br><br>
                                    <button class="btn btn-info" onclick="click_add()">Add Supplier </button>
                                </div>
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
                                <b>รายชื่อบริษัทคู่ค้า</b>
                            </div>
                            <div class="panel-body">

                                <table width="100%" class="table table-striped table-bordered  hover-table " id="user-table">


                                    <!--                            <col width="5%">-->

                                    <thead>
                                        <tr>
                                            <th style="text-align:center">ID</th>
                                            <th style="text-align:center">Company</th>
                                            <th style="text-align:center">Username</th>
                                            <th style="text-align:center">Address</th>
                                            <th style="text-align:center">Tel</th>
                                            <th style="text-align:center">Detail</th>



                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($rows as $row) { ?>
                                            <tr onclick="click_user(<?= $row['sup_id'] ?>)">
                                                <td style="text-align:center"><?= $row['sup_id'] ?></td>
                                                <td style="text-align:center"><?= $row['sup_company'] ?></td>
                                                <td style="text-align:center"><?= $row['sup_username'] ?></td>
                                                <td style="text-align:center"><?= $row['sup_address'] ?></td>
                                                <td style="text-align:center"><?= $row['sup_tel'] ?></td>
                                                <td style="text-align:center"><?= $row['sup_detail'] ?></td>

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
                $('#user-info').modal('show').find('.modal-body').load('supplier_edit.php?no=' + x);
            }
        </script>
    </body>
    <?php include('script.php'); ?>