<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'shop_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'h1') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'meta_desc') ?>

    <?php // echo $form->field($model, 'is_physical') ?>

    <?php // echo $form->field($model, 'is_digital') ?>

    <?php // echo $form->field($model, 'is_request') ?>

    <?php // echo $form->field($model, 'tag') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
