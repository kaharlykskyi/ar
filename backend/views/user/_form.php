<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$cImg = new \common\components\CImage();

?>
<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>


    <div class="row">
        <!-- Avatar -->
        <div class="col-md-3">
            <?php
            $img = $cImg->getFile($model->avatar, 200, 200, 'width');
            ?>

            <div style="text-align: center">
                <img src="<?= $img ?>" alt="">
            </div>
            <br>

            <?php
            echo \kartik\file\FileInput::widget([
                'model' => $model,
                /*'accept' => 'image/*',*/
                'attribute' => 'attachments[]',
                'pluginOptions' => [
                    'showUpload' => false,
                ]
                /*'options' => ['multiple' => true]*/
            ]);
            ?>
            <br>
        </div>

        <!-- data -->
        <div class="col-md-9">
            <?php
            // var_dump($model->getErrors());
            ?>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'firstname')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'lastname')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'address')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'city')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'region')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?php

                    $data = \yii\helpers\ArrayHelper::map(\common\models\Country::find()->orderBy('name_en')->asArray()->all(), 'id', 'name_en');

                    echo $form->field($model, 'country_id')->widget(\kartik\select2\Select2::classname(), [
                        'value' => $model->country_id, // initial value
                        'data' => $data,
                        'options' => [
                            'placeholder' => \Yii::t('app', ''),
                        ],
                        'pluginOptions' => [
                            'tags' => true,
                            'tokenSeparators' => [],
                            'maximumInputLength' => 1024
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'phone_home')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'phone_cell')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'postal_code')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'company')->textInput() ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <?php

                    $data = \common\models\User::getRoleTypeLabels();

                    echo $form->field($model, 'role_id')->widget(\kartik\select2\Select2::classname(), [
                        'value' => $model->role_id, // initial value
                        'data' => $data,
                        'options' => [
                            'placeholder' => \Yii::t('app', ''),
                        ],
                        'pluginOptions' => [
                            'tags' => true,
                            'tokenSeparators' => [],
                            'maximumInputLength' => 1024
                        ]
                    ]);
                    ?>
                </div>                

                <div class="col-md-4">
                    <?= $form->field($model, 'password_admin')->textInput()->label('Password') ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br>
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>