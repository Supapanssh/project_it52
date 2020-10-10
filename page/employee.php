<?php
$con = mysqli_connect("localhost", "root", "", "stock") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Asia/Bangkok');

$want = 'ADMIN';
$sql = "SELECT * FROM `employee` ";

#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();
$sql_provinces = "SELECT * FROM provinces";
$query = mysqli_query($con, $sql_provinces);
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="align-content: center">ข้อมูลพนักงาน</h1>
            <form method="post" action="create_emp.php">
                <div class="form-group row">
                    <div class="col-xs-3">
                        <label>รหัสพนักงาน</label>
                        <input class="form-control" name="Emp_ID" placeholder="รหัสพนักงาน" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>รหัสบัตรประจำตัวประชาชน</label>
                        <input class="form-control" name="Emp_idcard" placeholder="รหัสประชาชน" autocomplete="off" maxlength="13" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
                    </div>
                    <div class="col-xs-3">
                        <label>ชื่อ</label>
                        <input class="form-control" name="Emp_name" placeholder="ชื่อ" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>นามสกุล</label>
                        <input class="form-control" name="Emp_lname" placeholder="นามสกุล" autocomplete="off">
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
                        <input class="form-control" name="Emp_tel" placeholder="เบอร์โทร" autocomplete="off" maxlength="10" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
                    </div>
                    <div class="col-xs-3">
                        <label>บ้านเลขที่</label>
                        <input class="form-control" name="Emp_address" placeholder="ที่อยู่" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>หมู่</label>
                        <input class="form-control" name="Emp_moo" placeholder="หมู่" autocomplete="off">
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
                        <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
                    </div>

                    <div class='col-xs-3'>
                        <label>อีเมล</label>
                        <input type="email" name="Emp_mail" class="form-control" id="Emp_mail" required placeholder="อีเมล">
                    </div>

                    <div class='col-xs-3'>
                        <label>วันที่เริ่มทำงาน</label>
                        <input type="datetime-local" class="form-control" name="Emp_start" id="Emp_start">
                    </div>


                    <div class='col-xs-3'>
                        <label>วันที่ออกจากงาน</label>
                        <input type="datetime-local" class="form-control" name="Emp_quit" id="Emp_quit" disabled>
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
                        <button class="btn btn-info" onclick="click_add()">เพิ่มข้อมูล</button>
                    </div>
            </form>

            <div class="panel-body">

            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default" >
                <div class="panel-heading" align="center">
                    <b>รายชื่อพนักงาน</b>
                </div>
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-bordered  hover-table " id="emp-table">
                        <thead>
                            <tr>
                                <th style="text-align:center">ลำดับ</th>
                                <th style="text-align:center">รหัสพนักงาน</th>
                                <th style="text-align:center">รหัสประชาชน</th>
                                <th style="text-align:center">ชื่อ</th>
                                <th style="text-align:center">นามสกุล</th>
                                <th style="text-align:center">เพศ</th>
                                <th style="text-align:center">เบอร์โทร</th>
                                <th style="text-align:center">ที่อยู่</th>
                                <th style="text-align:center">อีเมล</th>
                                <th style="text-align:center">เริ่มทำงาน</th>
                                <th style="text-align:center">ลาออก</th>
                                <th style="text-align:center">สถานะ</th>



                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr onclick="click_user(<?= $row['ID'] ?>)">

                                    <td style="text-align:center"><?= $row['ID'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_ID'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_idcard'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_name'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_lname'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_sex'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_tel'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_address'] ?></td>
                                    <td style="text-align:center"><?= $row['Emp_mail'] ?></td>
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

<div class="modal fade" id="user-info">
    <div class="modal-dialog ">
        <div class="modal-content">


            <!-- Modal Header -->
            <!--            <div class="modal-header">-->
            <!--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
            <!--                <h4 class="modal-title" id="myModalLabel">Product Detail</h4>-->
            <!--            </div>-->
            <!-- Modal body -->
            <div class="modal-body " id="edit-modal">


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

        var x;
        $.ajax({
            type: "get",
            url: 'employee_edit.php?ID=' + x,
            success: function(response) {
                $("#edit-modal").html(response);
                $('#user-info').modal('show');
            }
        });
         $('#user-info').modal('show').find('.modal-body').load('employee_edit.php?ID=' + x);
    }
</script>
<?php include('script.php'); ?>

