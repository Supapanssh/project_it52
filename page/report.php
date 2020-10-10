<?php
$want = 'MANAGER';
$sql = "SELECT YEAR(bill.BillDate) Year, SUM(bill.BillTotal) Total,SUM(bill.BillDiscount) Discount FROM bill GROUP BY YEAR(bill.BillDate)";
//echo $sql;
#excute statement
$stmt = $mysql_db->query($sql);
#get result
$year_rows = $stmt->fetchAll();

$sql = "SELECT YEAR(bill.BillDate) Year, MONTH(bill.BillDate) Month, SUM(bill.BillTotal) Total,SUM(bill.BillDiscount) Discount FROM bill GROUP BY YEAR(bill.BillDate), MONTH(bill.BillDate) ORDER BY 1,2";
//echo $sql;
#excute statement
$stmt = $mysql_db->query($sql);
#get result
$month_rows = $stmt->fetchAll();

$sql = "SELECT BillDate,SUM(BillTotal)BillTotal,SUM(BillDiscount)BillDiscount From bill GROUP BY bill.BillDate";
//echo $sql;
#excute statement
$stmt = $mysql_db->query($sql);
#get result
$day_rows = $stmt->fetchAll();


?>

<div id="wrapper">

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="align-content: center">สรุปรายงานการขาย</h1>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" align="center">
                                <b>รายปี</b>
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered  hover-table">
                                    <col width="20%">
                                    <col width="40%">
                                    <col width="40%">

                                    <thead>
                                        <tr>
                                            <th style="text-align:center">ปี</th>
                                            <th style="text-align:center">ราคาสินค้าทั้งหมด</th>
                                            <th style="text-align:center">ส่วนลด</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($year_rows as $row) { ?>

                                            <td style="text-align:center"><?= $row['Year'] ?></td>
                                            <td style="text-align:center"><?= $row['Total'] ?></td>
                                            <td style="text-align:center"><?= $row['Discount'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" align="center">
                                <b>รายเดือน</b>
                            </div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered  hover-table">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="30%">
                                    <col width="30%">

                                    <thead>
                                        <tr>
                                            <th style="text-align:center">ปี</th>
                                            <th style="text-align:center">เดือน</th>
                                            <th style="text-align:center">ราคาสินค้าทั้งหมด</th>
                                            <th style="text-align:center">ส่วนลด</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($month_rows as $row) { ?>

                                            <td style="text-align:center"><?= $row['Year'] ?></td>
                                            <td style="text-align:center"><?= $row['Month'] ?></td>
                                            <td style="text-align:center"><?= $row['Total'] ?></td>
                                            <td style="text-align:center"><?= $row['Discount'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" align="center">
                        <b>รายวัน</b>
                    </div>
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered  hover-table" id="day_report">
                            <col width=30%">
                            <col width="35%">
                            <col width="35%">

                            <thead>
                                <tr>
                                    <th style="text-align:center">วันที่</th>
                                    <th style="text-align:center">ราคาสินค้าทั้งหมด</th>
                                    <th style="text-align:center">ส่วนลด</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($day_rows as $row) { ?>

                                    <td style="text-align:center"><?= $row['BillDate'] ?></td>
                                    <td style="text-align:center"><?= $row['BillTotal'] ?></td>
                                    <td style="text-align:center"><?= $row['BillDiscount'] ?></td>
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
    $('#day_report').DataTable({
        responsive: true

    });
</script>
</body>