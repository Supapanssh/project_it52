<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PurchaseBill */

$this->title = "รหัสใบสั่งซื้อ " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Purchase Bills', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="purchase-bill-view">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (empty($_GET['print'])) : ?>
    <p>
        <?= Html::a('พิมพ์', ["view?id=$model->id&print=true"], ['class' => 'btn btn-primary', "target" => "_blank"]) ?>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
    </p>
    <?php endif; ?>
    <?= $this->render('_form', [
        'model' => $model, 'form_mode' => "view"
    ]) ?>

</div>

<?php if (!empty($_GET["print"])) : ?>

<script>
print();
</script>
<?php endif; ?>