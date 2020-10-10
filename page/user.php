<?php
$want = 'ADMIN';

$sql = "SELECT userNo,username,nickname,user_email,status FROM `user` ";

#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();


?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="align-content: center">ข้อมูลผู้ใช้งาน</h1>
            <form method="post" action="create_user.php">
                <div class="form-group row">
                    <div class="col-xs-3">
                        <label>ชื่อ</label>
                        <input class="form-control" name="username" placeholder="username" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>ชื่อเล่น</label>
                        <input class="form-control" name="name" placeholder="name" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>รหัสผ่าน</label>
                        <input class="form-control" type="password" name="password" placeholder="password">
                    </div>
                    <div class="col-xs-3">
                        <label>อีเมล</label>
                        <input class="form-control" type="user_email" name="user_email" placeholder="email" autocomplete="off">
                    </div>
                    <div class="col-xs-3">
                        <label>ตำแหน่ง</label>
                        <select name="status" class="form-control">

                            <option value="CASHIER">Cashier</option>
                            <option value="MANAGER">Manager</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <br>
                        <br><br> 
                        <button class="btn btn-info" onclick="click_add()">เพิ่มผู้ใช้งาน</button>
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
                    <b>รายชื่อผู้ใช้งาน</b>
                </div>
                <div class="panel-body">

                    <table width="100%" class="table table-striped table-bordered  hover-table " id="user-table">


                        <!--                            <col width="5%">-->

                        <thead>
                            <tr>
                                <th style="text-align:center">ชื่อผู้ใช้</th>

                                <th style="text-align:center">ชื่อ-นามสกุล</th>
                                <th style="text-align:center">อีเมล</th>
                                <th style="text-align:center">สถานะ</th>


                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr onclick="click_user(<?= $row['userNo'] ?>)">

                                    <td style="text-align:center"><?= $row['username'] ?></td>
                                    <td style="text-align:center"><?= $row['nickname'] ?></td>
                                    <td style="text-align:center"><?= $row['user_email'] ?></td>
                                    <td style="text-align:center"><?= $row['status'] ?></td>


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
            <div class="modal-body ">


            </div>

            <!-- Modal footer -->


        </div>
    </div>
</div>

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