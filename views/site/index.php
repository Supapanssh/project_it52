<?php

use app\models\Bill;
use app\models\Product;
use app\models\Supplier;
use app\models\User;
use yii\bootstrap4\Html;
use yii\helpers\Url;



$this->title = 'หน้าหลักของระบบ';
$this->params['breadcrumbs'] = [['label' => $this->title]];

// $rows = Yii::$app->db->createCommand("select * from product")->queryAll();
// for ($i = 0; $i < sizeOf($rows); $i++) {
//     echo $rows[$i]["PNo"];
// }


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
            <a href="<?= Url::to(["bill/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
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
            <a href="<?= Url::to(["products/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
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
            <a href="<?= Url::to(["user/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
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
            <a href="<?= Url::to(["supplier/index"]) ?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- end smallbox -->
<section>
    <div class="row">
        <div class="col-xl-7 col-lg-12 mb-4 pb-2">
            <div class="view view-cascade gradient-card-header blue-gradient">
                <div id="profit-chart" height="400"></div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-12 mr-0 pb-2">
            <div class="card-body card-body-cascade pb-0">
                <div class="row py-3 pl-4">
                    <div class="col-12">
                        <!-- Nav tabs -->
                        <ul class="nav md-tabs nav-justified">
                            <li class="nav-item waves-effect waves-light ">
                                <a class="nav-link <?= !empty($_GET["start_date"]) || !empty($_GET["final_date"]) ? 'active' : '' ?>"
                                    data-toggle="tab" href="#panel1" role="tab">วัน</a>
                            </li>
                            <li class="nav-item waves-effect waves-light ">
                                <a class="nav-link <?= !empty($_GET["start_month"]) || !empty($_GET["final_month"]) ? 'active' : '' ?>"
                                    data-toggle="tab" href="#panel2" role="tab">เดือน</a>
                            </li>
                            <li class="nav-item waves-effect waves-light ">
                                <a class="nav-link <?= !empty($_GET["start_year"]) || !empty($_GET["final_year"]) ? 'active' : '' ?>"
                                    data-toggle="tab" href="#panel3" role="tab">ปี</a>
                            </li>
                        </ul>
                        <!-- Tab panels -->
                        <div class="tab-content card">
                            <!-- Panel 1 -->
                            <div class="tab-pane fade p-3 <?= !empty($_GET["start_date"]) || !empty($_GET["final_date"]) ? 'active show' : '' ?>"
                                id="panel1" role="tabpanel">
                                <form action="">
                                    <p class="lead pt-3 pb-4"><span class="badge info-color p-2">เลือกช่วงวัน</span>
                                    </p>
                                    <div class="form-group">
                                        <label for="date">ตั้งแต่</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.." type="date"
                                            value="<?= $_GET["start_date"] ?? '' ?>" id="from" name="start_date"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">ไม่เกิน</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.." type="date"
                                            value="<?= $_GET["final_date"] ?? '' ?>" id="to" name="final_date"
                                            class="form-control">
                                    </div>
                                    <?= Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"]) ?>
                                </form>
                            </div>
                            <!-- Panel 1 -->
                            <!-- Panel 2 -->
                            <div class="tab-pane fade p-3 <?= !empty($_GET["start_month"]) || !empty($_GET["final_month"]) ? 'active show' : '' ?>"
                                id="panel2" role="tabpanel">
                                <form action="">
                                    <p class="lead pt-3 pb-4"><span class="badge info-color p-2">เลือกช่วงเดือน</span>
                                    </p>
                                    <div class="form-group">
                                        <label>ตั้งแต่</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.."
                                            value="<?= $_GET["start_month"] ?? '' ?>" type="month" id="from"
                                            name="start_month" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>ไม่เกิน</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.."
                                            value="<?= $_GET["final_month"] ?? '' ?>" type="month" id="to"
                                            name="final_month" class="form-control">
                                    </div>
                                    <?= Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"]) ?>
                                </form>
                            </div>
                            <!-- Panel 2 -->
                            <!-- Panel 3 -->
                            <div class="tab-pane fade p-3 <?= !empty($_GET["start_year"]) || !empty($_GET["final_year"]) ? 'active show' : '' ?>"
                                id="panel3" role="tabpanel">
                                <form action="" method="get">
                                    <p class="lead pt-3 pb-4"><span class="badge info-color p-2">ระบุช่วงปี</span>
                                    </p>
                                    <div class="form-group">
                                        <label for="from">ตั้งแต่</label>
                                        <input placeholder="ปี ค.ศ." value="<?= $_GET["start_year"] ?? '' ?>"
                                            type="number" id="from" name="start_year" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="to">ไม่เกิน</label>
                                        <input placeholder="ปี ค.ศ." value="<?= $_GET["final_year"] ?? '' ?>"
                                            type="number" id="to" name="final_year" class="form-control">
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
        <div class="col-12">
            <div class="col-md-12" style="margin-top: 1rem;margin-bottom: 1rem;">
                <div id="low-sale">
                </div>
            </div>
            <div class="col-md-12 " style="margin-top: 1rem;margin-bottom: 1rem;">
                <div id="product-category">
                </div>
            </div>
            <div class="col-md-12 " style="margin-top: 1rem;margin-bottom: 1rem;">
                <div id="container1">
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="col-md-8 " style="margin-top: 1rem;margin-bottom: 1rem;">
                <div id="container4">
                </div>
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
?>

<script>
//scripts
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
        // stackLabels: {
        //     enabled: true,
        //     style: {
        //         fontWeight: 'bold',
        //         color: ( // theme
        //             Highcharts.defaultOptions.title.style &&
        //             Highcharts.defaultOptions.title.style.color
        //         ) || 'gray'
        //     }
        // }
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
    // plotOptions: {
    //     column: {
    //         stacking: 'normal',
    //         dataLabels: {
    //             enabled: true
    //         }
    //     }
    // },
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
</script>


<div class="col-md-6 col-sm-12" style="margin-top: 1rem;margin-bottom: 1rem;">
    <div id="low-sale">
    </div>
    <script>
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
                'ISUZU ROCKY',
                'NISSAN FRONTIER BDI',
                'NISSAN TD',
                'ISUZU TFR NPR120 D-MAX',
                'TOYOTA TIGER-MIGHTY-X',
                'NISSAN SUNNY RN/B11',
                'HONDA CR-V2.0 13-17',
                'HINO KT/FN527',
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
            data: [{
                    name: "ISUZU ROCKY",
                    y: 1150,
                },
                {
                    name: "NISSAN FRONTIER BDI",
                    y: 795,
                },
                {
                    name: "NISSAN TD",
                    y: 890,
                },
                {
                    name: "ISUZU TFR NPR120 D-MAX",
                    y: 970,
                },
                {
                    name: "TOYOTA TIGER-MIGHTY-X",
                    y: 940,
                },
                {
                    name: "NISSAN SUNNY RN/B11",
                    y: 820,
                },
                {
                    name: "HONDA CR-V2.0 13-17",
                    y: 695,
                },
                {
                    name: "HINO KT/FN527",
                    y: 550,
                },
            ]
        }]
    });
    </script>


    <div class="col-md-8" style="margin-top: 1rem;margin-bottom: 1rem;">
        <div id="product-category"></div>
        <script>
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
                pointFormat: '{series.name}: {point.y} รายการ <br><b>{point.percentage:.1f}%</br>'
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
                data: [{
                        name: 'กรองอากาศ',
                        y: 47
                    },
                    {
                        name: 'ฝาถังน้ำมัน',
                        y: 35
                    },
                    {
                        name: 'โช๊คอัพ',
                        y: 31
                    },
                    {
                        name: 'ผ้าเบรคหลัง',
                        y: 28
                    },
                    {
                        name: 'บล็อกวาล์ว',
                        y: 25
                    },
                    {
                        name: 'แบตเตอรี่',
                        y: 24
                    },
                    {
                        name: 'เบ็ดเตล็ด',
                        y: 19
                    },
                    {
                        name: 'สายพาน',
                        y: 16
                    },
                    {
                        name: 'จานคลัช',
                        y: 11
                    },
                ]
            }]
        });
        </script>


        <div class="col-md-8" style="margin-top: 1rem;margin-bottom: 1rem;">
            <div id="container1"></div>
            <script>
            Highcharts.chart('container1', {
                title: {
                    text: 'Sale Vs Margin(%) '
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'March', 'April', 'May']
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
                    data: [50, 75, 60, 80, 90]
                }, {
                    type: 'spline',
                    name: 'Margin(%)',
                    data: [15, 18, 19, 20, 18],
                    marker: {
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }, ]
            });
            </script>

            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/highcharts-more.js"></script>
            <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>

            <figure class="highcharts-figure">

            </figure>





            <div class="col-md-6 col-sm-12 " style="margin-top: 1rem;margin-bottom: 1rem;">
                <div id="container4" style="max-width: 440px;height: 400px;margin: 0px auto">
                </div>
                <script>
                // Uncomment to style it like Apple Watch
                /*
                if (!Highcharts.theme) {
                  Highcharts.setOptions({
                    chart: {
                      backgroundColor: 'black'
                    },
                    colors: ['#F62366', '#9DFF02', '#0CCDD6'],
                    title: {
                      style: {
                        color: 'silver'
                      }
                    },
                    tooltip: {
                      style: {
                        color: 'silver'
                      }
                    }
                  });
                }
                // */

                /**
                 * In the chart render event, add icons on top of the circular shapes
                 */
                function renderIcons() {

                    // Move icon
                    if (!this.series[0].icon) {
                        this.series[0].icon = this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
                            .attr({
                                stroke: '#303030',
                                'stroke-linecap': 'round',
                                'stroke-linejoin': 'round',
                                'stroke-width': 2,
                                zIndex: 10
                            })
                            .add(this.series[2].group);
                    }
                    this.series[0].icon.translate(
                        this.chartWidth / 2 - 10,
                        this.plotHeight / 2 - this.series[0].points[0].shapeArgs.innerR -
                        (this.series[0].points[0].shapeArgs.r - this.series[0].points[0].shapeArgs.innerR) / 2
                    );

                    // Exercise icon
                    if (!this.series[1].icon) {
                        this.series[1].icon = this.renderer.path(
                                ['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8,
                                    'M', 8, -8, 'L', 16, 0, 8, 8
                                ]
                            )
                            .attr({
                                stroke: '#ffffff',
                                'stroke-linecap': 'round',
                                'stroke-linejoin': 'round',
                                'stroke-width': 2,
                                zIndex: 10
                            })
                            .add(this.series[2].group);
                    }
                    this.series[1].icon.translate(
                        this.chartWidth / 2 - 10,
                        this.plotHeight / 2 - this.series[1].points[0].shapeArgs.innerR -
                        (this.series[1].points[0].shapeArgs.r - this.series[1].points[0].shapeArgs.innerR) / 2
                    );

                    // Stand icon
                    if (!this.series[2].icon) {
                        this.series[2].icon = this.renderer.path(['M', 0, 8, 'L', 0, -8, 'M', -8, 0, 'L', 0, -8, 8, 0])
                            .attr({
                                stroke: '#303030',
                                'stroke-linecap': 'round',
                                'stroke-linejoin': 'round',
                                'stroke-width': 2,
                                zIndex: 10
                            })
                            .add(this.series[2].group);
                    }

                    this.series[2].icon.translate(
                        this.chartWidth / 2 - 10,
                        this.plotHeight / 2 - this.series[2].points[0].shapeArgs.innerR -
                        (this.series[2].points[0].shapeArgs.r - this.series[2].points[0].shapeArgs.innerR) / 2
                    );
                }

                Highcharts.chart('container4', {

                    chart: {
                        type: 'solidgauge',
                        height: '110%',
                        events: {
                            render: renderIcons
                        }
                    },

                    title: {
                        text: 'Activity',
                        style: {
                            fontSize: '24px'
                        }
                    },

                    tooltip: {
                        borderWidth: 0,
                        backgroundColor: 'none',
                        shadow: false,
                        style: {
                            fontSize: '16px'
                        },
                        valueSuffix: '%',
                        pointFormat: '{series.name}<br><span style="font-size:2em; color: {point.color}; font-weight: bold">{point.y}</span>',
                        positioner: function(labelWidth) {
                            return {
                                x: (this.chart.chartWidth - labelWidth) / 2,
                                y: (this.chart.plotHeight / 2) + 15
                            };
                        }
                    },

                    pane: {
                        startAngle: 0,
                        endAngle: 360,
                        background: [{ // Track for Move
                            outerRadius: '112%',
                            innerRadius: '88%',
                            backgroundColor: Highcharts.color(Highcharts.getOptions().colors[0])
                                .setOpacity(0.3)
                                .get(),
                            borderWidth: 0
                        }, { // Track for Exercise
                            outerRadius: '87%',
                            innerRadius: '63%',
                            backgroundColor: Highcharts.color(Highcharts.getOptions().colors[1])
                                .setOpacity(0.3)
                                .get(),
                            borderWidth: 0
                        }, { // Track for Stand
                            outerRadius: '62%',
                            innerRadius: '38%',
                            backgroundColor: Highcharts.color(Highcharts.getOptions().colors[2])
                                .setOpacity(0.3)
                                .get(),
                            borderWidth: 0
                        }]
                    },

                    yAxis: {
                        min: 0,
                        max: 100,
                        lineWidth: 0,
                        tickPositions: []
                    },

                    plotOptions: {
                        solidgauge: {
                            dataLabels: {
                                enabled: false
                            },
                            linecap: 'round',
                            stickyTracking: false,
                            rounded: true
                        }
                    },

                    series: [{
                        name: 'Move',
                        data: [{
                            color: Highcharts.getOptions().colors[0],
                            radius: '112%',
                            innerRadius: '88%',
                            y: 80
                        }]
                    }, {
                        name: 'Exercise',
                        data: [{
                            color: Highcharts.getOptions().colors[1],
                            radius: '87%',
                            innerRadius: '63%',
                            y: 65
                        }]
                    }, {
                        name: 'Stand',
                        data: [{
                            color: Highcharts.getOptions().colors[2],
                            radius: '62%',
                            innerRadius: '38%',
                            y: 50
                        }]
                    }]
                });
                </script>

                <?php $this->endBlock(); ?>