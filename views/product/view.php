<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->PNo;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->PNo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->PNo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการลบใช่ไหม?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PNo',
            'Product_no',
            'category.category_name',
            'brand_id',
            'Product_code',
            'Product_name',
            'Product_desc',
            'Product_price',
            'Product_cost',
            'Product_quantity',
            're_orderpoint',
            'Product_unit',
            'Product_exp',
        ],
    ]) ?>

</div>