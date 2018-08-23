<?php

use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;

?>
<li class="login-content">
    <h4>Login</h4>


    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'dialog__form validate__form',
            'data' => ['pjax' => 1]
        ],
        'enableClientValidation' => true,
        'id'=>'log-form',
        'action' => ['/site/login'],
    ]);
    ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div style="color:#999;margin:1em 0">
        If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
    </div>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-md btn-base1', 'name' => 'login-button']) ?>
        <br>
        <br>
        <a href="<?= \yii\helpers\Url::to(['site/signup']) ?>" class="btn btn-primary btn-md btn-base1">Create an account</a>

    </div>

    <div class="form-group">
        <div style="text-align: center; font-size: 20px; padding: 15px; font-weight: 600;">- OR Login -</div>
        <div class="clearfix social-login-buttons">
            <div class="reg-three-elements">
                <a class="btn btn-md btn-login-google" href="/login/google" title="Register with your Google account">
                    <span>Login with your Google account</span>
                </a>
            </div>

            <div class="reg-three-elements">
                <a class="btn btn-md btn-login-vk" href="/login/vkontakte" title="Register with your VK account">
                    <span>Login with your VK account</span>
                </a>
            </div>

            <div class="reg-three-elements">
                <a class="btn btn-md btn-login-facebook" href="/login/facebook" title="Register with your Facebook account">
                    <span>Login with your Facebook account</span>
                </a>
            </div>
        </div>
    </div>




    <!-- div class="clearfix social-login-buttons">
        <div class="two-elements">
            <a class="btn btn-md btn-login-google" href="/login/google" title="Login with your Google account">
                <span>Google Login</span>
            </a>
        </div>
        <div class="two-elements">
            <a class="btn btn-md btn-login-vk" href="/login/facebook" title="Login with your Fb account">
                <span>Fb Login</span>
            </a>
        </div>
        <div class="two-elements">
            <a class="btn btn-md btn-login-vk" href="/login/vkontakte" title="Login with your VK account">
                <span>VK Login</span>
            </a>
        </div>
    </div -->

    <?php ActiveForm::end(); ?>

</li>
