<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Shop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'payment_refunds')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shipping_police')->textarea(['rows' => 6]) ?>

    <?php if(1==2) { ?>
        <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-md btn-base-min']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
