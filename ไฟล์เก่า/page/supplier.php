<?php
$con = mysqli_connect("localhost", "root", "", "stock") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
?>

<?php
$want = 'ADMIN';

$sql = "SELECT * FROM `supplier` ";

#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();


if (isset($_POST['sup_username'])) {
    // บ้านเลขที่ หมู่
    $s_address = 'บ้านเลขที่ ' . $_POST['sup_address'] . ' หมู่ ' . $_POST['sup_moo'];

    //ตำบล
    $subDistSql = "SELECT districts.name_th FROM districts WHERE districts.id = {$_POST['Ref_subdist_id']}";
    $statement = $mysql_db->query($subDistSql)->fetch();
    $s_address .= ' ' . $statement[0];

    // อำเภอ
    $district = "SELECT amphures.name_th FROM amphures WHERE amphures.id = {$_POST['Ref_dist_id']}";
    $statement = $mysql_db->query($district)->fetch();
    $s_address .= ' ' . $statement[0];

    // จังหวัด
    $provinceSql = "SELECT provinces.name_th FROM provinces WHERE provinces.id = {$_POST['Ref_prov_id']}";
    $statement = $mysql_db->query($provinceSql)->fetch();
    $s_address .= ' ' . $statement[0] . ' ' . $_POST['zip_code'];
    // [Emp_moo] => 1 [Ref_prov_id] => 3 [Ref_dist_id] => 61 [Ref_subdist_id] => 120403 [zip_code] => 11110


    $sup_id = $_POST['sup_id'];
    $sup_username = $_POST['sup_username'];
    $sup_company = $_POST['sup_company'];
    $sup_address = $s_address;
    $sup_moo         =   $_POST['sup_moo'];
    $sup_tumbol      =   $_POST['Ref_subdist_id'];
    $sup_amphur      =   $_POST['Ref_dist_id'];
    $sup_province    =   $_POST['Ref_prov_id'];
    $sup_zipcode     =   $_POST['zip_code'];
    $sup_tel = $_POST['sup_tel'];
    $sup_detail = $_POST['sup_detail'];


    $sql = "select sup_username from supplier where sup_id = '$sup_id';";
    $num = $mysql_db->query($sql);
    $num = $num->rowCount();
    if ($num == 0) {
        $sql = "INSERT INTO `supplier` (`sup_company`, `sup_username`, `sup_address`, `sup_moo`, `sup_tumbol`, `sup_amphur`
        , `sup_province`, `sup_zipcode`, `sup_tel`, `sup_detail`) VALUES 
        ('$sup_company', '$sup_username', '$sup_address', '$sup_moo', '$sup_tumbol', '$sup_amphur', '$sup_province', '$sup_zipcode', '$sup_tel'
        , '$sup_detail');";
        $stmt = $mysql_db->query($sql);
    } else {
        // echo "HHHH";
        // exit();
    }
    // header('Location:admin.php?site=supplier');
}

?>

<?php
$sql_provinces = "SELECT * FROM provinces";
$query = mysqli_query($con, $sql_provinces);
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="align-content: center">ข้อมูลบริษัทคู่ค้า</h1>
            <form method="post">
                <div class="form-group row">
                    <div class="col-xs-3">
                        <label>ชื่อบริษัท</label>
                        <input class="form-control" name="sup_company" placeholder="ชื่อบริษัทคู่ค้า" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>ชื่อ-นาสกุลผู้ติดต่อ</label>
                        <input class="form-control" name="sup_username" placeholder="ชื่อ-นามสกุล" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>หมู่</label>
                        <input class="form-control" name="sup_moo" placeholder="หมู่" autocomplete="off">
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
                        <select class="form-control" name="Ref_dist_id" id="amphures" placeholder="อำเภอ">
                        </select></div>


                    <div class='col-xs-3'>
                        <label>ตำบล</label>
                        <select class="form-control" name="Ref_subdist_id" id="districts" placeholder="ตำบล">
                        </select>
                        <br></div>

                    <div class='col-xs-3'>
                        <label>รหัสไปรษณีย์</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
                    </div>

                    <div class="col-xs-3">
                        <label>เบอร์โทรศัพท์</label>
                        <input class="form-control" type="text" name="sup_tel" placeholder="เบอร์โทร" maxlength="10" autocomplete="off" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
                    </div>
                    <div class="col-xs-3">
                        <label>รายละเอียด</label>
                        <input class="form-control" name="sup_detail" placeholder="รายละเอียด" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <br>
                        <br><br>
                        <button class="btn btn-info" onclick="click_add()">เพิ่มข้อมูล </button>
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
                                <th style="text-align:center">ลำดับ</th>
                                <th style="text-align:center">ชื่อบริษัทคู่ค้า</th>
                                <th style="text-align:center">ชื่อ-นามสกุล</th>
                                <th style="text-align:center">ที่อยู่</th>
                                <th style="text-align:center">เบอร์โทร</th>
                                <th style="text-align:center">รายละเอียด</th>



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


<script>
    $(document).ready(function() {
        $('table').DataTable({
            responsive: true

        });
    });

    function click_user(x) {
        // alert("HELLO");
        // window.location.href = "product_manage.php?no=" + x;
        $('#user-info').modal('show').find('.modal-body').load('supplier_edit.php?sup_id=' + x);
    }
</script>
</body>
<?php include('script.php'); ?>