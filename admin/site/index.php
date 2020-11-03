<?php
$this->title = 'หน้าหลักของระบบ';
$this->params['breadcrumbs'] = [['label' => $this->title]];

use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            จำนวนผู้ป่วยในแยกรายเดือน</h3>
    </div>
    <div class="panel-body">
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'Fruit Consumption'],
                'xAxis' => [
                    'categories' => ['Apples', 'Bananas', 'Oranges']
                ],
                'yAxis' => [
                    'title' => ['text' => 'Fruit eaten']
                ],
                'series' => [
                    ['name' => 'Jane', 'data' => [1, 0, 4]],
                    ['name' => 'John', 'data' => [5, 7, 3]]
                ]
            ]
        ]);
        ?>
    </div>
</div>