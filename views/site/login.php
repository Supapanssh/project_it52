<?php

use yii\helpers\Html;
?>


<div class="card" ">
    <div class=" card-body login-card-body">
    <p class=" login-box-msg">ร้านบำรุงชูการไฟฟ้า</p>

    <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

    <?= $form->field($model, 'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

    <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <div class="form-group field-loginform-rememberme validating">
                    <div class="custom-control custom-checkbox">
                        <input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox"
                            id="loginform-rememberme" class="custom-control-input is-valid" name="LoginForm[rememberMe]"
                            value="1" checked="" aria-invalid="false">
                        <label class="custom-control-label" for="loginform-rememberme">จำฉันไว้</label>
                        <div class="invalid-feedback"></div>

                    </div>
                </div>
            </div>
            คุณลืมรหัสผ่านใช่ไหม? <?= Html::a('รีเซ็ต', ['site/request-password-reset']) ?>.
            <br>
        </div>
        <div class="col-4">
            <?= Html::submitButton('เข้าสู่ระบบ', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>

    <?php \yii\bootstrap4\ActiveForm::end(); ?>

    <!-- /.social-auth-links -->
</div>
<!-- /.login-card-body -->
</div>
</div>