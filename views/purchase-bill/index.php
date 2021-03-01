<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchaseBillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบสั่งซื้อสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-bill-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('สร้างใบสั่งซื้อ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 'summary' => '<i class="icon fa fa-file"></i> ข้อมูลตำแหน่งที่ {begin}-{end} (หน้า {page}/{pageCount}) <i class="icon fa fa-file"></i> ข้อมูลทั้งหมด {totalCount} รายการ',
        'pager' => ['class' => LinkPager::className()],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'date',
            'sup.sup_company',

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:180px;'],
                'buttonOptions' => ['class' => 'btn btn-info'],
                'buttons' => [
                    'update' =>  function ($url, $model) {
                        return Html::a('<i class="fas fa-edit"></i>', $url, [
                            'class' => 'btn btn-info',
                            'title' => Yii::t('app', 'update')
                        ]);
                    },
                    'view' =>  function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'class' => 'btn btn-success',
                            'title' => Yii::t('app', 'view')
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'คุณแน่ใจใช่ไหมที่ต้องการลบ?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>