<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="align-content: center">Cashier</h1>
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
                        <thead>
                            <tr>
                                <th>บาร์โค้ด</th>
                                <th>ชื่อสินค้า</th>
                                <th>รายละเอียดสินค้า</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr onclick="click_product(<?= $row['Product_code'] ?>)">
                                    <td><?= $row['Product_code'] ?></td>
                                    <td><?= $row['Product_name'] ?></td>
                                    <td><?= $row['Product_desc'] ?></td>
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
                            <div class=" panel panel-default">
                    <div class="panel-heading" align="center">
                        <b>รายการใบสั่งซื้อ</b>
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
                                        if (isset($_SESSION["cart_product"])) {
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
                                            <td style="vertical-align:middle;" align=middle><button type="submit" class="btn btn-info">Update <i class="fa fa-refresh"></i>
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
                                <span id="TEST_TOTAL" class="input-group-addon text_modal">ราคาสินค้า</span>
                                <input id="total" type="number" class="form-control payinput" style="color: ;" value="<?= $item_total ?>" disabled>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon text_modal">ภาษีมูลค่าเพิ่ม(VAT)7%</span>
                                <input id="total" type="number" class="form-control payinput" style="color: ;" value="<?= $item_total * 0.07 ?>" disabled>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon text_modal">ส่วนลด</span>
                                <input name="discount" type="number" id="discount" class="form-control payinput" min="0" value="0" onchange="calExact()">
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon text_modal">ชำระเงิน</span>
                                <input name="cash" type="number" id="cash" class="form-control payinput" min="0" value="<?= $item_total * 0.07 + $item_total ?>" placeholder="">
                                <span class="input-group-btn text_modal">
                                    <button id="exact" class="btn btn-secondary text_modal" style="min-height: 60px" type="button">Exact</button>

                                </span>
                            </div>
                            <tr>

                                <?php if ($_SESSION['ses_status'] == "ADMIN") : ?>
                                    <button type="button" id="click-pay" class="btn pay-button1" style="min-width: 200px">
                                        PAY
                                    </button>
                                <?php elseif ($_SESSION['ses_status'] == "MANAGER") : ?>
                                    <button type="button" id="click-pay" class="btn pay-button1" style="min-width: 200px">
                                        PAY
                                    </button>
                                <?php else : ?>
                                    You are user
                                <?php endif; ?>

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
                                            <h2>ราคาสินค้า: <?= $item_total ?></h2>
                                            <h2>ภาษี 7%: <?= $item_total * 0.07 ?></h2>
                                            <h2>ราคาสุทธิ : <?= $item_total * 0.07 + $item_total ?></h2>
                                            <h2 id="modal_disc">ส่วนลด: </h2>
                                            <h2 id="modal_cash">เงินสด: </h2>
                                            <h2 id="modal_balance">คงเหลือ: </h2>


                                        </div>
                                        <div class="col-lg-6">
                                            <h2 style="font-size: 20px">Detail</h2>
                                            <textarea class="form-control" rows="7" name="note"></textarea>
                                            <input type="hidden" name="opt" value="confirm">
                                            <input type="hidden" id="i_disc" name="n_disc">
                                            <input type="hidden" id="i_cash" name="n_cash">
                                            <input type="hidden" name="total" value="<?= $item_total ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-center" style="min-width: 200px">
                                            <button type="submit" class="btn btn-success" style="background-color: #20BF25;">CONFIRM</button>
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


            var discount = parseInt($('#discount').val());
            var cash = parseInt($('#cash').val());
            var total = parseInt($('#total').val());

            var balance = cash - total + discount;
            $('#modal_disc').text("Discount: " + discount);
            $('#i_disc').val(discount);
            $('#modal_cash').text("Cash: " + cash);
            $('#i_cash').val(cash);
            $('#modal_balance').text("Balance: " + (balance));


            if (balance >= 0) {
                $('#paymodal').modal();
            } else {
                alert("จำนวนเงินไม่เพียงพอ");
            }
        });

        function calExact() {
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