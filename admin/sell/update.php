<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sell */

$this->title = 'Update Sell: ' . $model->SellNo;
$this->params['breadcrumbs'][] = ['label' => 'Sells', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SellNo, 'url' => ['view', 'id' => $model->SellNo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sell-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>