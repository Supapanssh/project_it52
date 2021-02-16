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


<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_CHASIER): ?>
<h4> Welcome Chashier</h4>
<?php endif;?>

<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_MANAGER): ?>
<h5>Welcome Manager</h5>

<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
<div id="container"></div>
<table id="datatable">
    <thead>
        <tr>
            <th></th>
            <th>ยอดขาย</th>
            <th>กำไร</th>
            <th>ต้นทุน</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>เดือนกันยายน</th>
            <td>216.4 K</td>
            <td>91.2 K</td>
            <td>47.6 K</td>
        </tr>
        <tr>
            <th>เดือนตุลาคม</th>
            <td>194.1 K</td>
            <td>83.5 K</td>
            <td>39.1 K</td>
        </tr>
        <tr>
            <th>เดือนมิถุนายน</th>
            <td>176.0 K</td>
            <td>84.5 K</td>
            <td>75.5 K</td>
        </tr>
    </tbody>
</table>
</figure>

<script>
Highcharts.chart('container', {
    chart: {
        renderTo: 'exm',
        type: 'column'
    },
    title: {
        text: 'สถิติการขายสินค้า'
    },
    subtitle: {
        text: 'ประจำปี2020'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'จำนวนสินค้า (ชิ้น)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} K</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'ยอดขาย',
        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

    }, {
        name: 'กำไร',
        data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

    }, {
        name: 'ต้นทุน',
        data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

    }]
});

chart = new Highcharts.Chart({
    chart: {
        renderTo: 'exb',
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false
    },
    title: {
        text: 'กราฟแสดงยอดขายในแต่ละปี'
    },

    subtitle: {
        text: 'ยอดขายสินค้าย้อนหลัง 5 ปี'
    },

    yAxis: {
        title: {
            text: 'ยอดขาย'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 2015 to 2020'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2015
        }
    },

    series: [{
        name: 'แบตเตอรี่',
        data: [43934, 52503, 57177, 69658, 97031, 99931, 107133, 109175]
    }, {
        name: 'กรองอากาศ',
        data: [24744, 27722, 36005, 29771, 40185, 54377, 57147, 69387]
    }, {
        name: 'คอยล์เย็น',
        data: [11744, 17722, 16005, 19771, 20185, 24377, 45147, 39387]
    }, {
        name: 'สายพาน',
        data: [10744, 19722, 16505, 13571, 11185, 22377, 31147, 46387]
    }, {
        name: 'โช๊คอัพ',
        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
// Next career move for Canadian digital media practitioners
chart = new Highcharts.Chart({
    chart: {
        renderTo: 'exo',
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false
    },
    title: {
        text: 'ยอดขายอะไหล่รถยนต์ประจำเดือนพฤศจิกายน',
        style: {
            Color: '#666'
        }
    },
    tooltip: {
        formatter: function() {
            return '<strong>' + this.point.name + '</strong>: ' + this.y + ' %';
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true
            },
            showInLegend: true
        }
    },
    series: [{
        type: 'pie',
        name: 'ยอดขายอะไหล่รถยนต์ คิดเป็นเปอร์เซ็นต์',
        data: [
            ['แบตเตอรี่', 37.4],
            ['ฝาถังน้ำมัน', 25.5],
            ['กรองอากาศ', 13.8],

            ['มู่เล่', 8.5],
            ['สายพาน', 10.2],
            ['คอยล์เย็น', 2.0],
            ['คอมแอร์', 2.6]
        ]
    }],
    legend: {
        borderColor: '#666'
    }
});
</script>
<?php endif;?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?=Bill::find()->count()?></h3>
                <p>รายการขาย</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?=Url::to(["bill/index"])?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?=Product::find()->count()?><sup style="font-size: 20px"></sup></h3>

                <p>รายการสินค้า</p>
            </div>
            <div class="icon">
                <i class="fa fa-product-hunt" aria-hidden="true"></i>
            </div>
            <a href="<?=Url::to(["products/index"])?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?=User::find()->count()?></h3>

                <p>ผู้ใช้งาน</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="<?=Url::to(["user/index"])?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?=Supplier::find()->count()?></h3>

                <p>บริษัทคู่ค้า</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?=Url::to(["supplier/index"])?>" class="small-box-footer">ดูข้อมูลเพิ่มเติม <i
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
                                <a class="nav-link <?=!empty($_GET["start_date"]) || !empty($_GET["final_date"]) ? 'active' : ''?>"
                                    data-toggle="tab" href="#panel1" role="tab">วัน</a>
                            </li>
                            <li class="nav-item waves-effect waves-light ">
                                <a class="nav-link <?=!empty($_GET["start_month"]) || !empty($_GET["final_month"]) ? 'active' : ''?>"
                                    data-toggle="tab" href="#panel2" role="tab">เดือน</a>
                            </li>
                            <li class="nav-item waves-effect waves-light ">
                                <a class="nav-link <?=!empty($_GET["start_year"]) || !empty($_GET["final_year"]) ? 'active' : ''?>"
                                    data-toggle="tab" href="#panel3" role="tab">ปี</a>
                            </li>
                        </ul>
                        <!-- Tab panels -->
                        <div class="tab-content card">
                            <!-- Panel 1 -->
                            <div class="tab-pane fade p-3 <?=!empty($_GET["start_date"]) || !empty($_GET["final_date"]) ? 'active show' : ''?>"
                                id="panel1" role="tabpanel">
                                <form action="">
                                    <p class="lead pt-3 pb-4"><span class="badge info-color p-2">เลือกช่วงวัน</span></p>
                                    <div class="form-group">
                                        <label for="date">ตั้งแต่</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.." type="date"
                                            value="<?=$_GET["start_date"] ?? ''?>" id="from" name="start_date"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">ไม่เกิน</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.." type="date"
                                            value="<?=$_GET["final_date"] ?? ''?>" id="to" name="final_date"
                                            class="form-control">
                                    </div>
                                    <?=Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"])?>
                                </form>
                            </div>
                            <!-- Panel 1 -->
                            <!-- Panel 2 -->
                            <div class="tab-pane fade p-3 <?=!empty($_GET["start_month"]) || !empty($_GET["final_month"]) ? 'active show' : ''?>"
                                id="panel2" role="tabpanel">
                                <form action="">
                                    <p class="lead pt-3 pb-4"><span class="badge info-color p-2">เลือกช่วงเดือน</span>
                                    </p>
                                    <div class="form-group">
                                        <label>ตั้งแต่</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.." value="<?=$_GET["start_month"] ?? ''?>"
                                            type="month" id="from" name="start_month" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>ไม่เกิน</label>
                                        <input placeholder="คลิกเพื่อเลือกวัน.." value="<?=$_GET["final_month"] ?? ''?>"
                                            type="month" id="to" name="final_month" class="form-control">
                                    </div>
                                    <?=Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"])?>
                                </form>
                            </div>
                            <!-- Panel 2 -->
                            <!-- Panel 3 -->
                            <div class="tab-pane fade p-3 <?=!empty($_GET["start_year"]) || !empty($_GET["final_year"]) ? 'active show' : ''?>"
                                id="panel3" role="tabpanel">
                                <form action="" method="get">
                                    <p class="lead pt-3 pb-4"><span class="badge info-color p-2">ระบุช่วงปี</span></p>
                                    <div class="form-group">
                                        <label for="from">ตั้งแต่</label>
                                        <input placeholder="ปี ค.ศ." value="<?=$_GET["start_year"] ?? ''?>"
                                            type="number" id="from" name="start_year" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="to">ไม่เกิน</label>
                                        <input placeholder="ปี ค.ศ." value="<?=$_GET["final_year"] ?? ''?>"
                                            type="number" id="to" name="final_year" class="form-control">
                                    </div>
                                    <?=Html::button("ค้นหา", ["type" => "submit", "class" => "btn btn-primary w-100"])?>
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
</section>

<?php $this->beginBlock("scripts");?>
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
            <?php foreach ($profit->all() as $category):
    if ($unit["type"] == 1) {
        $format = "Y-m-d";
    } elseif ($unit["type"] == 2) {
    $format = "Y-m";
} else {
    $format = "Y";
}
$showCate = new DateTime($category->BillDate);
$showCate = $showCate->format($format);
echo "\"$showCate\",";
endforeach;?>
        ],
        title: {
            text: "<?=$unit["text"]?>"
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'จำนวน (บาท)'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: ( // theme
                    Highcharts.defaultOptions.title.style &&
                    Highcharts.defaultOptions.title.style.color
                ) || 'gray'
            }
        }
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
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.2f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true
            }
        }
    },
    series: [{
        name: 'ค้นทุน',
        data: [<?php foreach ($profit->all() as $value): ?> <?=$value->cost?>,
            <?php endforeach;?>
        ],
    }, {
        name: 'กำไร',
        data: [<?php foreach ($profit->all() as $value): ?> <?=$value->profit?>,
            <?php endforeach;?>
        ],
    }, {
        name: 'ภาษี',
        data: [<?php foreach ($profit->all() as $value): ?> <?=$value->vat?>, <?php endforeach;?>],
    }]
});
</script>
<?php $this->endBlock();?>