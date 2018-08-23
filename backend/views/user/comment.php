<?php

use yii\helpers\Html;
use \yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Comment').' - '.$model->email;
?>
<div class="user-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <!-- Avatar -->
        <div class="col-md-12">

            <?= $form->field($model, 'comment')->textArea(['autofocus' => true, 'rows'=>8]) ?>
            <br>

            <div style="text-align: center">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
