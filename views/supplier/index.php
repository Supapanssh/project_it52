<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//เพิ่มบรรทัดด้านล่าง
use yii\bootstrap4\LinkPager;

$this->title = 'ข้อมูลบริษัทคู่ค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('เพิ่มบริษัทคู่ค้า', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //
        'filterModel' => $searchModel, 'summary' => '<i class="icon fa fa-file"></i> ข้อมูลตำแหน่งที่ {begin}-{end} (หน้า {page}/{pageCount}) <i class="icon fa fa-file"></i> ข้อมูลทั้งหมด {totalCount} รายการ',
        'pager' => ['class' => LinkPager::class],
        //
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sup_id',
            'sup_company',
            'sup_username',
            'sup_address',
           // 'sup_moo',
            //'sup_tumbol',
            //'sup_amphur',
            //'sup_province',
            //'sup_zipcode',
            'sup_tel',
            'sup_detail',

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:180px;'],
                'buttonOptions' => ['class' => 'btn btn-info'],
                'buttons' => [
                    'update' =>  function ($url) {
                        return Html::a('<i class="fas fa-edit"></i>', $url, [
                            'class' => 'btn btn-info',
                            'title' => Yii::t('app', 'update')
                        ]);
                    },
                    'view' =>  function ($url) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'class' => 'btn btn-success',
                            'title' => Yii::t('app', 'view')
                        ]);
                    },
                    'delete' => function ($url) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'title' => Yii::t('app', 'delete'),
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
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