<?php
$want = 'ADMIN';
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    switch ($date) {
        case 'TODAY':
            $cond = 'WHERE BillDate LIKE CURDATE()';
            break;
        case 'MONTH':
            $cond = 'WHERE MONTH(BillDate) LIKE MONTH(CURDATE())';
            break;
        case 'YEAR':
            $cond = 'WHERE YEAR(BillDate) LIKE YEAR(CURDATE())';
            break;
        default:
            $cond = '';
    }
} else if (isset($_GET['sdate']) && $_GET['sdate'] != '') {

    $xx = $_GET['sdate'];

    $cond = "WHERE BillDate >= '$xx'";
    if (isset($_GET['edate']) && $_GET['edate'] != '') {
        $yy = $_GET['edate'];
        $cond = $cond . " AND BillDate <= '$yy' ";
    }
} else if (isset($_GET['edate']) && $_GET['edate'] != '') {
    $yy = $_GET['edate'];
    $cond = "WHERE BillDate <= '$yy'";
} else {
    $cond = '';
}

//echo '<br/>';

$sql = "SELECT BillNo,BillDate,Bill_detail,BillDiscount,BillTotal,BillCash,Billvat,nickname FROM `bill` LEFT JOIN user ON bill.PeoNo=user.userNo $cond ORDER BY BillNo ASC";
//echo $sql;
#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();



?>


<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        table.hover-table tr:hover td {
            color: #4cae4c;
            cursor: pointer;
        }
    </style>
</head>


<body>


    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="align-content: center"> ข้อมูลการซื้อขาย </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel-body ">
                    <form method="get">
                        <input class="btn btn-success" type="submit" name="date" value="ทั้งหมด" />
                        <input class="btn btn-success" type="submit" name="date" value="วันนี้" />
                        <input class="btn btn-success" type="submit" name="date" value="เดือน" />
                        <input class="btn btn-success" type="submit" name="date" value="ปี" />
                        <!--                        <div class="form-group col-xs-2">-->
                        <span>เริ่มวันที่ </span><input style="max-width: 150px" type="datetime-local" name='sdate' id="start-date" />
                        <span>ถึงวันที่ </span><input style="max-width: 150px" type="datetime-local" name="edate" id="end-date" />
                        <!--                        </div>-->


                        <button class="btn btn-success" type="submit" id="custom-date">ตกลง</button>
                    </form>


                </div>

            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <b>ข้อมูลการซื้อขาย</b>
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered  hover-table" id="bill-table">
                            <col width="5%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                            <col width="10%">



                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>วันเวลา</th>
                                    <th>ราคาสินค้าทั้งหมด</th>
                                    <th>ส่วนลด</th>
                                    <th>ราคาสุทธิ</th>
                                    <th>ภาษีมูลเพิ่ม VAT7%</th>
                                    <th>ชื่อผู้ขาย</th>
                                    <th>รายละเอียด</th>


                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($rows as $row) { ?>
                                    <tr onclick="click_bill(<?= $row['BillNo'] ?>)" align="center">
                                        <td><?= $row['BillNo'] ?></td>
                                        <td><?= date_format(date_create($row['BillDate']), 'd M Y') ?></td>
                                        <td align="right"><?= $row['BillTotal'] ?></td>
                                        <td align="right"><?= $row['BillDiscount'] ?></td>
                                        <td align="right"><?= $row['BillCash'] ?></td>
                                        <td align="right"><?= $row['Billvat'] ?></td>
                                        <td style="text-align: center;"><?= $row['nickname'] ?></td>
                                        <td align="right"><?= $row['Bill_detail'] ?></td>
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

    <script>
        $(document).ready(function() {
            $('#bill-table').DataTable({
                responsive: true

            });



            $('#start-date').datepicker({
                format: 'yyyy/mm/dd'

            });
            $('#end-date').datepicker({
                format: 'yyyy/mm/dd'
            });



        });

        $(document).on("click", "#custom-date", function() {

            $('#choose-date').modal();
        });

        function click_bill(x) {
            window.location.href = "bill_detail.php?bill=" + x;
        }
    </script>
</body>

</html>