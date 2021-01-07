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
            // 'BillDate',
            ['attribute'=>'PeoNo',
            'value'=>function ($model){
                return $model->peoNo->username;
            }
        ],
            // 'Bill_detail',
            // 'BillDiscount',
            'Tax',
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
                    <th>ราคารวม</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($model->billDetails as $billdetail) : ?>
                        <td><?= $billdetail->product->Product_code ?></td>
                        <td><?= $billdetail->product->Product_name ?></td>
                        <td><?= $billdetail->product->Product_desc ?></td>
                        <td><?= $billdetail->quantity ?></td>
                        <td><?= $billdetail->amount ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <div class="card-footer text-right">
        <p>
        <?= Html::a('พิมพ์ใบเสร็จ', ['print'], ['class' => 'btn btn-success']) ?>
    </p>
        </div>


        <!-- <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->BillNo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->BillNo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
    