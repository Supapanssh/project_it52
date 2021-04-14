<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

//เพิ่มบรรทัดด้านล่าง
use yii\bootstrap4\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้ใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('เพิ่มผู้ใช้งาน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //
        'filterModel' => $searchModel, 'summary' => '<i class="icon fa fa-file"></i> ข้อมูลตำแหน่งที่ {begin}-{end} (หน้า {page}/{pageCount}) <i class="icon fa fa-file"></i> ข้อมูลทั้งหมด {totalCount} รายการ',
        'pager' => ['class' => LinkPager::className()],
        //
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'userNo',
            'username',
            'nickname',
            // 'password_hash',
            'email:email',
            //'status',
            //'auth_key',
            ['attribute' => 'roles', 'value' => function ($model) {
                switch ($model->roles) {
                    case 0:
                        $result = 'แคชเชียร์';
                        break;
                    case 10:
                        $result = 'ผู้จัดการ';
                        break;
                    case 30:
                        $result = "แอดมิน";
                    default:
                        # code...
                        $result = 'ไม่ระบุสถานะ';
                        break;
                }
                return $result;
            }],
            //'password_reset_token',

            //แก้ไขตามนี้
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