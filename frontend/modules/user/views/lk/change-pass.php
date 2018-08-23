<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\User;
use \kartik\date\DatePicker;

// $model = \Yii::$app->user->getIdentity();
$cid = Yii::$app->controller->id."-".Yii::$app->controller->action->id;

?>

<?= $this->render('../common/_header') ?>

<div class="row">

    <div class="col-sm-4 block">
        <?= $this->render('../common/_menu'); ?>
    </div>

    <div class="col-sm-8 block">
        <h2 style="text-align:center ">Change Password</h2><br>
        <?php
        $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data'],
            'enableClientValidation' => false,

            /*'action' => ['/site/signup'],*/
            'id'=>'profile-form'
        ]); ?>


        <div class="row">
            <div class="col-md-8">


                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-md btn-base-min', 'id'=>'btnSave']) ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>

    </div>
</div>

<?= $this->render('../common/_footer') ?>
