<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Shipping */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipping-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $data = \yii\helpers\ArrayHelper::map(\common\models\ShippingRegion::find()->orderBy('name')->all(), 'id', 'name');
    echo $form->field($model, 'shipping_region_id')->dropDownList(
        $data,
        ['prompt'=>'']
    );
    ?>

    <?= $form->field($model, 'processing_time')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-md btn-base-min']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
