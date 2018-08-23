<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="wrapper home1 wrap2">
    <div class="row full-width">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container">

            <div class="row">
                <div class="col-lg-12" style="text-align: center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <br>
                </div>
                <div class="col-lg-3">
                </div>
                <div class="col-lg-3" style="border-right: solid 1px #900 ">

                    <p>Please fill out the following fields to signup:</p>

                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'is_subscribe_newsletter')->checkbox() ?>

                    <?= $form->field($model, 'is_subscribe_offers')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-default btn-md btn-base-min', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-lg-1">
                </div>
                <div class="col-lg-5">

                    <div class="clearfix social-login-buttons">
                        <div class="reg-three-elements">
                            <a class="btn btn-md btn-login-google" href="/login/google" title="Register with your Google account">
                                <span>Register with your Google account</span>
                            </a>
                        </div>

                        <div class="reg-three-elements">
                            <a class="btn btn-md btn-login-vk" href="/login/vkontakte" title="Register with your VK account">
                                <span>Register with your VK account</span>
                            </a>
                        </div>

                        <div class="reg-three-elements">
                            <a class="btn btn-md btn-login-facebook" href="/login/facebook" title="Register with your Facebook account">
                                <span>Register with your Facebook account</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-signup">

</div>
