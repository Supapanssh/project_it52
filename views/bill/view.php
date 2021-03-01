<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = $model->BillNo;
$this->params['breadcrumbs'][] = ['label' => 'Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bill-view">

    <h2>ลำดับที่<?= Html::encode($this->title) ?></h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'BillNo',
            'BillDate',

            [
                'attribute' => 'PeoNo',
                'value' => function ($model) {
                    return $model->peoNo->username;
                }
            ],
            // 'Bill_detail',
            // 'BillDiscount',
            // 'Tax',
            'BillTotal',
            'BillCash',
            'Billvat',
        ],
    ]) ?>


</div>
<div class="card">
    <div class="card-header">รายละเอียดรายการ</div>
    <div class="card-body">
        <table class="table data-table">
            <thead>
                <tr>
                    <th>รหัสบาร์โค้ด</th>
                    <th>ชื่อสินค้า</th>
                    <th>รายละเอียดสินค้า</th>
                    <th>จำนวน</th>
                    <th>หน่วยนับ</th>
                    <th>รับประกันสินค้า</th>
                    <th>ราคารวม</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->billDetails as $billdetail) : ?>
                <tr>
                    <td><?= $billdetail->product->Product_code ?></td>
                    <td><?= $billdetail->product->Product_name ?></td>
                    <td><?= $billdetail->product->Product_desc ?></td>
                    <td><?= $billdetail->quantity ?></td>
                    <td><?= $billdetail->product->Product_unit ?></td>
                    <td><?= $billdetail->product->Product_exp ?></td>
                    <td><?= $billdetail->amount ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="card-footer text-right">
            <p>
                <?= Html::button('พิมพ์ข้อมูล', ['onclick' => "testpdf()", 'class' => 'btn btn-warning']) ?>
            </p>
        </div>
    </div>
</div>


<?php $this->beginBlock("scripts"); ?>
<script>
function printBill() {
    var doc = {
        // watermark: "copyright @ศุภาพรรณ ศุภกร",
        pageMargins: pageMargins,
        content: [{
            text: "รายละเอียดรายการรหัส <?= $model->BillNo ?>",
            style: "bigHeader",
            alignment: "center",
        }, {
            table: {
                widths: [100, 100, 100, 100, 100],
                body: [
                    ["สินค้า", "จำนวน", "ราคาต่อหน่วย", "หน่วยนับ", "ราคารวม"],
                    <?php foreach ($model->billDetails as $billdetail) : ?>[
                        "<?= $billdetail->product->Product_name ?>",
                        "<?= $billdetail->quantity ?>",
                        "<?= $billdetail->product->Product_unit ?>",
                        "<?= $billdetail->product->Product_price ?>",
                        "<?= $billdetail->amount ?>"
                    ],
                    <?php endforeach; ?>
                ]
            }
        }],
        defaultStyle: defaultStyle,
        styles: {
            header: header,
            subheader: subheader,
            subheaderNoMargin: subheaderNoMargin,
            bigHeader: bigHeader,
        }
    }
    pdfMake.createPdf(doc).open();
}

function testpdf() {
    var doc = {
        // watermark: "copyright @ssem",
        pageMargins: pageMargins,
        content: [{
                alignment: "center",
                text: 'ใบเสร็จรับเงิน',
                style: "bigHeader"
            },
            {
                stack: [{
                        columns: [{
                                text: 'บิลที่',
                                style: 'invoiceSubTitle',
                                width: '*'

                            },
                            {
                                text: '<?= sprintf('%08d', $model->BillNo) ?>',
                                style: 'invoiceSubValue',
                                width: 100
                            }
                        ]
                    },
                    {
                        columns: [{
                                text: 'วันที่ออกบิล',
                                style: 'invoiceSubTitle',
                                width: '*'
                            },
                            {
                                text: '<?= $model->BillDate ?>',
                                style: 'invoiceSubValue',
                                width: 100
                            }
                        ]
                    },
                ]
            },
            {
                columns: [{
                        text: 'บิลจาก',
                        style: 'invoiceBillingTitle',

                    },

                ]
            },
            // Billing Details
            {
                columns: [{
                        text: 'N/F Bumrungchu',
                        style: 'invoiceBillingDetails'
                    },

                ]
            },
            // Billing Address Title
            {
                columns: [{
                        text: 'ที่อยู่',
                        style: 'invoiceBillingAddressTitle'
                    },

                ]
            },
            // Billing Address
            {
                columns: [{
                        text: ' ถนนมิตรภาพ โคราช 30170 ',
                        style: 'invoiceBillingAddress'
                    },

                ]
            },
            // Line breaks
            '\n\n',
            // Items
            {
                table: {
                    // headers are automatically repeated if the table spans over multiple pages
                    // you can declare how many rows should be treated as headers
                    widths: ['*', 120, 30, 60, 60, 60, '*'],
                    body: [
                        // Table Header
                        [{
                                text: 'บาร์โค้ด',
                                style: 'itemsHeader'
                            },
                            {
                                text: 'สินค้า',
                                style: 'itemsHeader'
                            },
                            {
                                text: 'จำนวน',
                                style: ['itemsHeader', 'center']
                            },
                            {
                                text: 'ราคา/ชิ้น',
                                style: ['itemsHeader', 'center']
                            },
                            {
                                text: 'VAT7%',
                                style: ['itemsHeader', 'center']
                            },
                            {
                                text: 'ราคารวม',
                                style: ['itemsHeader', 'center']
                            },
                            {
                                text: 'คิดเป็นทั้งหมด',
                                style: ['itemsHeader', 'center']
                            }
                        ],
                        // Items
                        <?php $sum = 0;
                            $sumNoTax = 0;
                            foreach ($model->billDetails as $billdetail) :
                                $vat = (0.07 * ($billdetail->product->Product_price * $billdetail->quantity));
                                $amount =  $vat + $billdetail->amount;
                                $sum += $amount;
                                $sumNoTax += $billdetail->amount;  ?>[{
                            text: '<?= $billdetail->product->Product_code ?>',
                            style: 'itemTitle'
                        }, {
                            text: '<?= $billdetail->product->Product_name ?>',
                            style: 'itemTitle'
                        }, {
                            text: '<?= $billdetail->quantity ?>',
                            style: 'itemSubTitle'
                        }, {
                            text: '<?= $billdetail->product->Product_price ?>',
                            style: 'itemNumber'
                        }, {
                            text: '<?= $vat ?>',
                            style: 'itemNumber'
                        }, {
                            text: '<?= $amount - $vat ?>',
                            style: 'itemNumber'
                        }, {
                            text: '<?= $amount ?>',
                            style: 'itemNumber'
                        }],
                        <?php endforeach; ?>

                        // END Items
                        [{
                            colSpan: 6,
                            alignment: 'left',
                            text: 'ราคาไม่รวม VAT',
                            style: ['itemsFooterSubTitle']
                        }, {}, {}, {}, {}, {}, {
                            text: '<?= $sumNoTax ?>',
                            style: 'itemsFooterSubValue'
                        }],
                        [{
                                colSpan: 6,
                                alignment: 'left',
                                text: 'ราคาทั้งหมด',
                                style: 'itemsFooterTotalTitle'
                            },
                            {}, {}, {}, {}, {},
                            {
                                text: '<?= $sum ?>',
                                style: 'itemsFooterTotalValue'
                            }
                        ],
                    ]
                }, // table
                layout: 'lightHorizontalLines'
            },
        ],
        defaultStyle: defaultStyle,
        styles: {
            header: header,
            subheader: subheader,
            subheaderNoMargin: subheaderNoMargin,
            bigHeader: bigHeader,
        }
    }
    pdfMake.createPdf(doc).open();
}
</script>
<?php $this->endBlock(); ?>