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
        <h2 style="text-align:center ">Edit your account information</h2><br>
        <?php
        $form = ActiveForm::begin([
            'options' => ['enctype'=>'multipart/form-data'],
            'enableClientValidation' => false,

            /*'action' => ['/site/signup'],*/
            'id'=>'profile-form'
        ]); ?>


        <div class="row">
            <?php if(1==2) { ?>
                <div class="col-md-4">
                    <div class='avatarWrapper j-avatar'>
                        <?php
                        $img = (isset($model->avatar)  ? $model->avatar->shortPath:"");
                        $img = $cImg->getFile($img, 160, 180, 'center');
                        $img = \Yii::$app->params['www'].$img;
                        ?>
                        <div class='avatar j-avatar-contener' style='background-image: url(<?= $img ?>)'></div>
                        <input type='file' class="j-chooseFile" id="" name="User[avatar]" />
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-8">

                <?php if($model->email == "-") { ?>
                    <?= $form->field($model, 'email')->textInput() ?>
                <?php  } else { ?>
                    <h4><?= $model->email ?></h4>
                <?php  }  ?>

                <?= $form->field($model, 'fullname')->textInput() ?>

                <?= $form->field($model, 'gender')->radioList(array('1'=>'male',2=>'female')); ?>

                <?=
                $form->field($model, 'birthdate')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter birth date ...'],
                    'type' => DatePicker::TYPE_INPUT,
                    'value' => '23-Feb-1982',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);

                ?>

                <?= $form->field($model, 'phone')->textInput() ?>

                <?= $form->field($model, 'phone_home')->textInput() ?>

                <?= $form->field($model, 'company_name')->textInput() ?>

                <?= $form->field($model, 'address1')->textInput() ?>

                <?= $form->field($model, 'address2')->textInput() ?>

                <?= $form->field($model, 'region')->textInput() ?>

                <?= $form->field($model, 'city')->textInput() ?>

                <?= $form->field($model, 'zip_code')->textInput() ?>

                <?= $form->field($model, 'is_subscribe_newsletter')->checkbox() ?>

                <?= $form->field($model, 'is_subscribe_offers')->checkbox() ?>

                <?php
                $data = \yii\helpers\ArrayHelper::map(\common\models\Country::find()->orderBy('name_en')->all(), 'id', 'name_en');
                echo $form->field($model, 'country_id')->dropDownList(
                    $data,
                    ['prompt'=>'']
                );
                ?>


                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-md btn-base-min', 'id'=>'btnSave']) ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>


    </div>
</div>

<?= $this->render('../common/_footer') ?>

<?php
/*
$this->registerJsFile('/js/CImage.js?_='.\Yii::$app->params['version'], [
    'depends' => ['yii\web\JqueryAsset']
]);
$this->registerJsFile('/js/CUser.js?_='.\Yii::$app->params['version'], [
    'depends' => ['yii\web\JqueryAsset']
]);
*/
?>
