<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\bootstrap4\LinkPager;

$this->title = 'Bills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bill', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'BillNo',
            'BillDate',

            [ 'attribute'=>'PeoNo',
            'value'=>function($model){

            return $model->peoNo->nickname;
            }
        ],
            //'Bill_detail',
            //'BillDiscount',
            'BillTotal',
           // 'BillCash',
            'Billvat',

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
