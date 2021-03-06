<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manage */

$this->title = $model->Manage_No;
$this->params['breadcrumbs'][] = ['label' => 'Manages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="manage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->Manage_No], ['class' => 'btn btn-primary']) ?>
        <!--?= Html::a('Delete', ['delete', 'id' => $model->Manage_No], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?-->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Manage_No',
            'Manage_date',
            'PNo',
           // 'PeoNo',
            
            'Manage_Amount',
        ],
    ]) ?>

</div>