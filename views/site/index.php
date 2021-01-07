<?php
$this->title = 'หน้าหลักของระบบ';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>


<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_CHASIER) : ?>
    <h4> Welcome Chashier</h4>
<?php endif; ?>

<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_MANAGER) : ?>
    <h5>Welcome Manager</h5>
    <div id="exm"></div>
    <div id="exb"></div>
    <div id="exo"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
            },{
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


<?php endif; ?>

<?php if (Yii::$app->user->identity->roles == \app\models\User::ROLE_ADMIN) : ?>
    <div id="exm"></div>
    <div id="exb"></div>
    <div id="exo"></div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
            },{
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


<?php endif; ?>