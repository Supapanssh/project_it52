<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'ID',
            'Emp_ID',
            'Emp_idcard',
            'Emp_name',
            'Emp_lname',
            'Emp_sex',
            'Emp_birth',
            'Emp_tel',
            'Emp_address:ntext',
            'Emp_moo',
            ['label' => 'ตำบล', 'value' => $model->empTumbol->name_th],
            'Emp_amphur',
            'Emp_road',
            'empProvince.name_th',
            'Emp_zipcode',
            'Emp_mail',
            'Emp_start',
            'Emp_quit',
            'Emp_status',
        ],
    ]) ?>

</div>