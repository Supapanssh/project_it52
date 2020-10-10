<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Signup</p>
        <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin([
                'id' => 'signup-form',
                'layout' => 'horizontal',
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="col-lg-offset-1" style="color:#999;">
                You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                To modify the username/password, please check out the code <code>app\models\User::$users</code>.
            </div>
        </div>
    </div>
</div>