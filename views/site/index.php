<?php

use app\models\Bill;
use app\models\Product;
use app\models\Supplier;
use app\models\User;
use yii\bootstrap4\Html;
use yii\helpers\Url;



$this->title = 'หน้าหลักของระบบ';
$this->params['breadcrumbs'] = [['label' => $this->title]];


$targetChart = clone ($chartObject);

?>


<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_CHASIER) : ?>
    <h4> Welcome Chashier</h4>
<?php endif; ?>

<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_MANAGER) : ?>
    <h5>Welcome Manager</h5>

<?php endif; ?>
<!-- Small boxes (Stat box) -->

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= Bill::find()->count() ?></h3>
                <p>รายการขาย</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= Url::to(["bill/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= Product::find()->count() ?><sup style="font-size: 20px"></sup></h3>

                <p>รายการสินค้า</p>
            </div>
            <div class="icon">
                <i class="fa fa-product-hunt" aria-hidden="true"></i>
            </div>
            <a href="<?= Url::to(["products/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= User::find()->count() ?></h3>

                <p>ผู้ใช้งาน</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= Url::to(["user/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= Supplier::find()->count() ?></h3>

                <p>บริษัทคู่ค้า</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= Url::to(["supplier/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- end smallbox -->
<section>
    <div class="row">
        <div class="col-lg-12 mr-0 pb-2">
            <div class="card">
                <div class="card-header">
                    <h3>ค้นประวัติ</h3>
                </div>
                <div class="card-body card-body-cascade pb-0">
                    <div class="row py-3 pl-4">
                        <div class="col-12">
                            <!-- Nav tabs -->
                            <ul class="nav md-tabs nav-justified">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link <?= !empty($_GET["start_date"]) || !empty($_GET["final_date"]) ? 'active' : '' ?>" data-toggle="tab" href="#panel1" role="tab">วัน</a>
                                </li>
                                <li class="nav-item waves-effect waves-light ">
                                    <a class="nav-link <?= !empty($_GET["start_month"]) || !empty($_GET["final_month"]) ? 'active' : '' ?>" data-toggle="tab" href="#panel2" role="tab">เดือน</a>
                                </li>
                                <li class="nav-item waves-effect waves-light ">
                                    <a class="nav-link <?= !empty($_GET["start_year"]) || !empty($_GET["final_year"]) ? 'active' : '' ?>" data-toggle="tab" href="#panel3" role="tab">ปี</a>
                                </li>
                            </ul>
                            <!-- Tab panels -->
                            <div class="tab-content card">
                                <!-- Panel 1 -->
                                <div class="tab-pane fade p-3 <?= !empty($_GET["start_date"]) || !empty($_GET["final_date"]) || empty($_GET) ? 'active show' : '' ?>" id="panel1" role="tabpanel">
                                    <form action="">
                                        <p class="lead pt-3 pb-4"><span class="badge info-color p-2">เลือกช่วงวัน</span>
                                        </p>
                                        <div class="form-group">
                                            <label for="date">ตั้งแต่</label>
                                            <input placeholder="คลิกเพื่อเลือกวัน.." type="date" value="<?= $_GET["start_date"] ?? '' ?>" id="from" name="start_date" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">ไม่เกิน</label>
                                            <input placeholder="คลิกเพื่อเลือกวัน.." type="date" value="<?= $_GET["final_date"] ?? '' ?>" id="to" name="final_date" class="form-control">
                                        </div>
                                        <?= Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"]) ?>
                                    </form>
                                </div>
                                <!-- Panel 1 -->
                                <!-- Panel 2 -->
                                <div class="tab-pane fade p-3 <?= !empty($_GET["start_month"]) || !empty($_GET["final_month"]) ? 'active show' : '' ?>" id="panel2" role="tabpanel">
                                    <form action="">
                                        <p class="lead pt-3 pb-4"><span class="badge info-color p-2">เลือกช่วงเดือน</span>
                                        </p>
                                        <div class="form-group">
                                            <label>ตั้งแต่</label>
                                            <input placeholder="คลิกเพื่อเลือกวัน.." value="<?= $_GET["start_month"] ?? '' ?>" type="month" id="from" name="start_month" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>ไม่เกิน</label>
                                            <input placeholder="คลิกเพื่อเลือกวัน.." value="<?= $_GET["final_month"] ?? '' ?>" type="month" id="to" name="final_month" class="form-control">
                                        </div>
                                        <?= Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"]) ?>
                                    </form>
                                </div>
                                <!-- Panel 2 -->
                                <!-- Panel 3 -->
                                <div class="tab-pane fade p-3 <?= !empty($_GET["start_year"]) || !empty($_GET["final_year"]) ? 'active show' : '' ?>" id="panel3" role="tabpanel">
                                    <form action="" method="get">
                                        <p class="lead pt-3 pb-4"><span class="badge info-color p-2">ระบุช่วงปี</span>
                                        </p>
                                        <div class="form-group">
                                            <label for="from">ตั้งแต่</label>
                                            <input placeholder="ปี ค.ศ." value="<?= $_GET["start_year"] ?? '' ?>" type="number" id="from" name="start_year" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="to">ไม่เกิน</label>
                                            <input placeholder="ปี ค.ศ." value="<?= $_GET["final_year"] ?? '' ?>" type="number" id="to" name="final_year" class="form-control">
                                        </div>
                                        <?= Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"]) ?>
                                    </form>
                                </div>
                                <!-- Panel 3 -->
                            </div>
                        </div>
                        <div class="col-12 mt-3 ">
                            <p>รวมทั้งสิ้น: <strong></strong> บาท
                            </p>
                            <p>เฉลี่ยวันละ: <strong></strong> บาท
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-4 pb-2">
        <div class="view view-cascade gradient-card-header blue-gradient">
            <div id="profit-chart" height="400"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-2">
            <div id="low-sale">
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div id="product-category">
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div id="container1">
            </div>
        </div>
        <div class="col-md-12 mt-2">

            <div style="height:150px" id="bullet1"></div>
            <?php $clone1 = clone ($chartObject);
            ?>
            <?php foreach ($clone1->groupBy("PNo")->andWhere("target_sale is not null")->all() as $target) : ?>
                <div style="height:150px" id="bulletPO<?= $target->PNo ?>"></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php $this->beginBlock("scripts"); ?>
<?php
$unit = ["text" => "วันที่ (ป/ด/ว)", "type" => 1, "format" => "Y-m-d"];
$profit = $profit->orderBy("BillDate");
$profit = $profit->groupBy("day(BillDate),month(BillDate),year(BillDate)");
if (!empty($_GET["start_month"]) || !empty($_GET["final_month"])) {
    $unit = ["text" => "เดือนที่ (ป/ด)", "type" => 2, "format" => "Y-m"];
    $profit = $profit->groupBy("month(BillDate),year(BillDate)");
} elseif (!empty($_GET["start_year"]) || !empty($_GET["final_year"])) {
    $unit = ["text" => "ปี", "type" => 3, "format" => "Y"];
    $profit = $profit->groupBy("year(BillDate)");
}

$lowSale = clone ($chartObject);
$lowSale = $lowSale->groupBy("Product_name")->select("Product_name,sum(price) as price")->orderBy("price asc")->limit(10)->all();
$highChart = clone ($chartObject);
$highChart = $highChart->groupBy("Product_name")->select("Product_name,sum(price) as price")->orderBy("price desc")->limit(10)->all();
$monthSale = clone ($chartObject);
$monthSale = $monthSale->groupBy("month(BillDate),year(BillDate)")->select("BillDate,sum(cost) as cost,sum(price) as price,sum(profit) as profit")->orderBy("year(BillDate) asc,month(BillDate) asc")->limit(10)->all();
?>

<script>
    var profitChart = Highcharts.chart('profit-chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'กำไรจากยอดขาย'
        },
        xAxis: {
            categories: [
                <?php foreach ($profit->all() as $category) :
                    if ($unit["type"] == 1) {
                        $format = "D/d-M-Y";
                    } elseif ($unit["type"] == 2) {
                        $format = "M-Y";
                    } else {
                        $format = "Y";
                    }
                    $showCate = new DateTime($category->BillDate);
                    $showCate = $showCate->format($format);
                    echo "\"$showCate\",";
                endforeach; ?>
            ],
            title: {
                text: "<?= $unit["text"] ?>"
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'จำนวน (บาท)'
            },

        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
            shared: true
        },
        series: [{
                name: 'ต้นทุน',
                data: [<?php foreach ($profit->all() as $value) : ?> <?= $value->cost ?>,
                    <?php endforeach; ?>
                ],
            }, {
                name: 'กำไร',
                data: [<?php foreach ($profit->all() as $value) : ?> <?= $value->profit ?>,
                    <?php endforeach; ?>
                ],
            }, {
                name: 'ภาษี',
                data: [<?php foreach ($profit->all() as $value) : ?> <?= $value->vat ?>,
                    <?php endforeach; ?>
                ],
            },
            {
                name: 'ยอดสุทธิ',
                data: [<?php foreach ($profit->all() as $value) : ?> <?= $value->price ?>,
                    <?php endforeach; ?>
                ],
            }
        ]
    });

    Highcharts.chart('low-sale', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'สินค้าที่ยอดขายต่ำ'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [
                <?php foreach ($lowSale as $sale) : ?> "<?= $sale->Product_name ?>",
                <?php endforeach; ?>
            ],
            type: 'ชื่อสินค้า'
        },
        yAxis: {
            title: {
                text: 'ยอดรวม'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} บาท'
        },

        series: [{
            name: "ยอดขายทั้งหมด",
            colorByPoint: true,
            data: [<?php foreach ($lowSale as $sale) : ?> {
                        name: "<?= $sale->Product_name ?>",
                        y: <?= $sale->price ?>
                    },
                <?php endforeach; ?>
            ]
        }]
    });

    Highcharts.chart('low-sale', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'สินค้าที่ยอดขายต่ำ'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [
                <?php foreach ($lowSale as $sale) : ?> "<?= $sale->Product_name ?>",
                <?php endforeach; ?>
            ],
            type: 'ชื่อสินค้า'
        },
        yAxis: {
            title: {
                text: 'ยอดรวม'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y} บาท'
        },

        series: [{
            name: "ยอดขายทั้งหมด",
            colorByPoint: true,
            data: [<?php foreach ($lowSale as $sale) : ?> {
                        name: "<?= $sale->Product_name ?>",
                        y: <?= $sale->price ?>
                    },
                <?php endforeach; ?>
            ]
        }]
    });

    Highcharts.chart('container1', {
        title: {
            text: 'Sale Vs Margin(%) '
        },
        xAxis: {
            categories: [<?php foreach ($monthSale as $sale) : ?> "<?php
                                                                    $showCate = new DateTime($sale->BillDate);
                                                                    $showCate = $showCate->format("M-Y");
                                                                    echo "$showCate"; ?>",
                <?php endforeach; ?>
            ]
        },
        labels: {
            items: [{
                html: 'Total consumption',
                style: {
                    left: '50px',
                    top: '18px',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Sale',
            data: [<?php foreach ($monthSale as $sale) : ?> <?= $sale->cost ?>,
                <?php endforeach; ?>
            ]
        }, {
            type: 'spline',
            name: 'Margin(%)',
            data: [<?php foreach ($monthSale as $sale) : ?> <?= $sale->profit  ?>,
                <?php endforeach; ?>
            ],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, ]
    });

    Highcharts.chart('product-category', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'ประเภทสินค้าที่ขายดี'
        },
        tooltip: {
            pointFormat: '{series.name}: {point.y} บาท <br><b>{point.percentage:.1f}%</br>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'จำนวนที่ขายทั้งหมด',
            colorByPoint: true,
            data: [<?php foreach ($lowSale as $sale) : ?> {
                        name: "<?= $sale->Product_name ?>",
                        y: <?= $sale->price ?>
                    },
                <?php endforeach; ?>
            ]

        }]
    });

    Highcharts.setOptions({
        chart: {
            inverted: true,
            marginLeft: 135,
            type: 'bullet'
        },
        title: {
            text: null
        },
        legend: false
    });

    Highcharts.chart('bullet1', {
        chart: {
            inverted: true,
            marginLeft: 135,
            type: 'bullet'
        },
        chart: {
            marginTop: 40
        },
        title: {
            text: 'เป้าหมายและยอดขาย'
        },
        xAxis: {
            categories: ['<span class="hc-cat-title">ยอดขาย</span><br/>บาท']
        },
        yAxis: {
            title: null
        },
        series: [{
            data: [{
                y: <?= $chartObject->sum('price') ?? 0 ?>,
                target: <?= Product::find()->sum("target_sale") ?>,
                color: "rgba(30,87,237,1)"
            }]
        }],
        tooltip: {
            pointFormat: '<b>{point.y}</b> (เป้าหมาย {point.target} บาท)'
        }
    });

    <?php
    $clone = clone ($chartObject);
    foreach ($clone->select("Product_name,PNo,sum(price) as price")->andWhere("target_sale is not null")->groupBy("PNo")->all() as $target) : ?>
        Highcharts.chart('bulletPO<?= $target->PNo ?>', {
            chart: {
                inverted: true,
                marginLeft: 135,
                type: 'bullet'
            },
            chart: {
                marginTop: 40
            },
            xAxis: {
                categories: ['<span class="hc-cat-title"><?= $target->Product_name ?></span><br/>บาท']
            },
            yAxis: {
                title: null
            },
            series: [{
                data: [{
                    y: <?= $target->price ?>,
                    target: <?= Product::findOne($target->PNo)->target_sale ?>,
                }]
            }],
            tooltip: {
                pointFormat: '<b>{point.y}</b> (เป้าหมาย {point.target} บาท)'
            }
        });
    <?php endforeach; ?>
</script>
<?php $this->endBlock(); ?>