<?php
$sql = "SELECT Product_code,Product_name,Product_desc,Product_price,Product_unit FROM `product` ";
//$sql = "SELECT * FROM 'category' INNER JOIN category.category_id == product.category_id ";
#excute statement
$stmt = $mysql_db->query($sql);
#get result
$rows = $stmt->fetchAll();
//print_r($rows);
$item_total = 0;
//print ("After Sort");
//print_r($rows);
//exit();

if (isset($_GET['opt'])) {
    if ($_GET['opt'] == 'cart') {
        /*
         * process cart operation
         */
        $action = $_GET['action'];
        if ($action == 'empty') {
            empty_cart();
        } else if ($action == 'add') {
            $code = $_GET['code'];
            cart_operation($mysql_db, 'product', $action, $code);
            //empty_cart();
        } else if ($action == 'remove') {

            $code = $_GET['code'];
            cart_operation($mysql_db, 'product', $action, $code);
        } else if ($action == 'update') {

            foreach ($_SESSION["cart_product"] as $item) {
                $no = $item['no'];

                update_product($no, $_GET['qtn' . $no]);
                //            $_SESSION["cart_product"][$no]['quantity'] = $_GET['qtn'.$no];
            }
        }
    }
}

if (isset($_POST['opt'])) {
    if ($_POST['opt'] == 'confirm') {
        $note = "";
        if (isset($_POST['note'])) {
            $note = $_POST['note'];
        }

        $disc = $_POST['n_disc'];
        $cash = $_POST['n_cash'];
        //$date = 'CURDATE()';
        $total = $_POST['total'];
        $vat = $_POST['vat'];
        //echo $item_total;
        $s = "INSERT INTO bill (BillNo, BillDate, PeoNo, Bill_detail, BillDiscount, BillTotal, BillCash, Billvat) VALUES (NULL, CURRENT_DATE(), $ses_userNo, '$note', '$disc', '$total','$cash','$vat');";
        //        var_dump($s);
        //        print($s);
        $num = $mysql_db->query($s);

        $last_order_id = $mysql_db->lastInsertId();
        //echo $last_order_id;

        $prods = get_cart_products();
        $i = 0;
        foreach ($prods as $prod) {
            $pid = $prod['no'];
            $qty = $prod['quantity'];
            $i = $i + 1;


            $sql = "INSERT INTO `sell` (`SellNo`, `PNo`, `BillNo`, `SellAmount`) VALUES ($i, '$pid', '$last_order_id', '$qty');";
            $num = $mysql_db->exec($sql);

            $sql = "UPDATE `product` SET `Product_Quantity` = Product_Quantity - $qty WHERE `product`.`PNo` = $pid";
            $num = $mysql_db->exec($sql);
        }
        empty_cart();
    }
}


?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="align-content: center">ขายสินค้า</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                    <b>รายการสินค้า</b>
                </div>
                <div class="panel-body">


                    <table width="100%" class="table table-striped table-bordered  hover-table" id="product-table">
                        <col width="20%">
                        <col width="80%">
                        <col width="50%">
                        <col width="30%">
                        <col width="30%">
                    
                        <thead>
                            <tr>
                                <th>บาร์โค้ด</th>
                                <th>ชื่อสินค้า</th>
                                <th>รายละเอียดสินค้า</th>
                                <th>ราคาสินค้า</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr onclick="click_product(<?= $row['Product_code'] ?>)">
                                    <td><?= $row['Product_code'] ?></td>
                                    <td><?= $row['Product_name'] ?></td>
                                    <td><?= $row['Product_desc'] ?></td>
                                    <td><?= $row['Product_price'] ?></td>
                                    <td><?= $row['Product_unit'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- end product list -->

        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12" ">
                            <div class=" Morris Charts">
                    <div class="panel-heading" align="center">
                        <b>รายการขาย</b>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table class="table table-striped" style="alignment: center;margin-bottom: 0px">

                                <col width="30%">
                                <col width="35%">
                                <col width="15%">
                                <col width="15%">
                                <col width="5%">
                                <form method="get">
                                    <input type="hidden" name="opt" value="cart">
                                    <input type="hidden" name="action" value="update">
                                    <thead>
                                        <tr>
                                            <th>บาร์โค้ด</th>
                                            <th style="text-align:left">ชื่อสินค้า</th>
                                            <th style="text-align:right">ราคาสินค้า</th>
                                            <th style="text-align:center">จำนวน</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        if (!empty($_SESSION["cart_product"])) {
                                            $item_total = 0;
                                            foreach ($_SESSION["cart_product"] as $item) {
                                                $item_total += $item["quantity"] * $item['price'];
                                                if (true) { ?>
                                                    <tr>
                                                        <td style="vertical-align:middle;"><?= $item['code'] ?></td>
                                                        <td style="vertical-align:middle;"><?= $item['name'] ?></td>
                                                        <td style="vertical-align:middle;" align=right><?= $item['price'] ?></td>
                                                        <td align="center">

                                                            <input style="text-align:center;width: 50%;padding-right: 0px" type="number" class="form-control" name="qtn<?= $item['no'] ?>" autocomplete="off" value="<?= $item['quantity'] ?>" min="0">


                                                        </td>
                                                        <!--                                                            <td style="vertical-align:middle;" align=center>-->
                                                        <? //= $item['quantity']
                                                                                                                                                                                    ?>
                                                        <!--</td>-->
                                                        <td style="vertical-align:middle;" align=left><button onclick="remove_product(<?= $item['code'] ?>)" type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></i>
                                                            </button></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="vertical-align:middle;" align=middle><button type="submit" class="btn btn-info">อัปเดท <i class="fa fa-refresh"></i>
                                                </button></td>
                                            <td style="vertical-align:middle;" align=left><button onclick="empty()" type="button" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </button></td>
                                        </tr>
                                    </tfoot>
                                <?php } ?>



                                </form>
                                </tbody>


                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>


                </div>
            </div>


            <div class="col col-lg-12" style="margin-top: 0px;padding-top: 0px ;">

                <div class="panel panel-default">
                    <form method="get">
                        <div class="panel-body">
                            <div class="form-group input-group ">
                                <span id="TEST_TOTAL" class="input-group-addon text_modal">จำนวนเงินทั้งหมด</span>
                                <input id="total" type="number" class="form-control payinput" style="color: ;" value="<?= $item_total ?>" disabled>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon text_modal">ภาษีมูลค่าเพิ่ม(VAT)7%</span>
                                <input name="vat" id="vat" type="number" class="form-control payinput" style="color: ;" value="<?= $item_total * 0.07 ?>" disabled>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon text_modal">ส่วนลด</span>
                                <input name="discount" type="number" id="discount" class="form-control payinput" min="0" value="0" onchange="calExact()">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon text_modal">ราคาสุทธิ</span>
                                <input name="cash" type="number" id="cash" class="form-control payinput" min="0" value="<?= $item_total * 0.07 + $item_total ?>" placeholder="">
                                <span class="input-group-btn text_modal">
                                    <button id="exact" class="btn btn-secondary text_modal" style="min-height: 60px" type="button">Exact</button>
                                    <button type="button" id="click-pay" class="btn pay-button1" style="min-width: 100px">
                                        ชำระเงิน
                                    </button>
                                </span>
                            </div>
                            <tr>

                                <!-- <?php if ($_SESSION['ses_status'] == "ADMIN") : ?> 
                                    <button type="button" id="click-pay" class="btn pay-button1" style="min-width: 200px">
                                        PAY
                                    </button>
                                <?php elseif ($_SESSION['ses_status'] == "MANAGER") : ?>
                                    <button type="button" id="click-pay" class="btn pay-button1" style="min-width: 200px">
                                        PAY
                                    </button>
                                <?php else : ?>
                                    You are user
                                <?php endif; ?> -->

                        </div>



                    </form>




                </div>



                <div class="modal fade" id="paymodal">
                    <div class="modal-dialog ">
                        <div class="modal-content">


                            <!-- Modal Header -->


                            <!-- Modal body -->
                            <div class="modal-body ">

                                <form method="post">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <h2>จำนวนเงินทั้งหมด: <?= $item_total ?></h2>
                                            <h2>ภาษีมูลค่าเพิ่ม 7%: <?= $item_total * 0.07 ?></h2>
                                            <h2 id="modal_cash"> ราคาสุทธิ : <?= $item_total * 0.07 + $item_total ?></h2>
                                            <h2 id="modal_disc"> ส่วนลด: </h2>
                                            <!--<h2 id="modal_balance"> เงินทอน: </h2>-->


                                        </div>
                                        <div class="col-lg-6">
                                            <h2 style="font-size: 20px">รายละเอียด</h2>
                                            <textarea class="form-control" rows="7" name="note"></textarea>
                                            <input type="hidden" name="opt" value="confirm">
                                            <input type="hidden" id="i_disc" name="n_disc">
                                            <input type="hidden" id="i_cash" name="n_cash">
                                            <input type="hidden" name="total" value="<?= $item_total ?>">
                                            <input type="hidden" name="vat" value=" <?= $item_total * 0.07 ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center" style="min-width: 200px">
                                            <button type="submit" class="btn btn-success" style="background-color: #20BF25;">ยืนยัน</button>
                                        </div>
                                    </div>

                                </form>







                            </div>

                            <!-- Modal footer -->


                        </div>
                    </div>
                </div>

            </div>




            <!--                        <div class="col col-lg-12">-->
            <!--                            <div class="panel panel-default" >-->
            <!---->
            <!--                                --><?php //print_r($_SESSION["cart_product"]) ;echo($item_total)
                                                    ?>
            <!--                            </div>-->
            <!--                        </div>-->


        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#product-table').DataTable({
                responsive: true

            });
        });

        $(document).on("click", "#click-pay", function() {

            var vat = parseInt($('#vat').val());
            var discount = parseInt($('#discount').val());
            var cash = parseInt($('#cash').val());
            var total = parseInt($('#total').val());

            var balance = cash - total*(0.07) + discount;
            $('#modal_vat').text("vat: " + vat);
            $('#modal_disc').text("ส่วนลด: " + discount);
            $('#i_disc').val(discount);
            $('#modal_cash').text("ราคาสุทธิ: " + cash);
            $('#i_cash').val(cash);
            //$('#modal_balance').text("เงินทอน: " + (balance));


            if (balance >= 0) {
                $('#paymodal').modal();
            } else {
                alert("จำนวนเงินไม่เพียงพอ");
            }
        });

        function calExact() {
            var vat = $('#vat').val();
            var discount = $('#discount').val();
            var total = $('#total').val();
            var price = $('#cash').val();
            $('#cash').val(price - discount);
        }

        $(document).on("click", "#exact", function() {
            // var discount = $('#discount').val();
            // var total = $('#total').val();

            // $('#cash').val(total-discount);
            calExact();

        });

        function click_product(x) {
            window.location.href = "?opt=cart&action=add&code=" + x;
        }

        function remove_product(x) {
            window.location.href = "?opt=cart&action=remove&code=" + x;
        }

        function empty() {
            window.location.href = "?opt=cart&action=empty";
        }
    </script>

    <script type="text/javascript">
        var x = <?php echo $item_total; ?>;
        document.getElementById("cash").innerText(x);
    </script>
    <!-- end order list -->
</div>