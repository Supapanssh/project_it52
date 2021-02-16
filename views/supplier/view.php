<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title = $model->sup_id;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="supplier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sup_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sup_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sup_id',
            'sup_company',
            'sup_username',
            'sup_address',
            'sup_moo',
            ['label' => 'ตำบล', 'value' => $model->supTumbol->name_th],
            ['label'=> 'อำเภอ','value' =>$model->supAmphur->name_th],
            ['label'=> 'จังหวัด','value' =>$model->supProvince->name_th],
            'sup_zipcode',
            'sup_tel',
            'sup_detail',
        ],
    ]) ?>

</div>