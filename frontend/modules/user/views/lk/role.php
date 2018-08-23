<?php

use \yii\widgets\Pjax;
use \yii\bootstrap\ActiveForm;

?>

<?php
$form = ActiveForm::begin([
    'options' => [
        'class' => '',
    ],
    'enableClientValidation' => false,
    'action' => ['/user/lk/role'],
]);
?>

<div class="row">
    <div class="col-md-5">
        <?php
        $data = [\common\models\User::ROLE_SELLER=>"Seller", \common\models\User::ROLE_USER=>"User"];

        echo $form->field($model, 'role_id', ['options' => ['class' => 'form-group styleSelect']])->dropDownList(
            $data,
            ['prompt'=>'выберите тип акоунта']
        )->label(false);
        ?>

        <button type="submit" class="btn btn-warning btn-register default-btn"><?= \Yii::t('app', 'Подтверждать') ?></button>

    </div>
</div>


<?php
ActiveForm::end();
?>

