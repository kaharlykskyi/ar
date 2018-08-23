<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Event\Event */
/* @var $form yii\widgets\ActiveForm */
?>




<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

    <div class="product-element"

         data-object_type="<?= \common\models\order\OrderProduct::OBJECT_TYPE_EVENT ?>"
         data-object_id="<?= $model->id ?>"
         data-basket-add-url="<?= \yii\helpers\Url::to(['/event-order/basket/add']) ?>"
    >

    <div class="row c-event-form">

        <?php if($model->id == "") { ?>

            <div class="alert alert-warning col-sm-12">
                <div class="col-lg-8 nav-list-left" style="text-align: right">
                        <div class="col-lg-12 tab-section-wrap" style="color: #D00; font-size: 14px">
                            <br>
                            <br>
                            <p>Please Save your new Event and add emails</p>
                            <br>
                        </div>
                </div>
            </div>

        <?php } ?>
        <div class="alert alert-warning col-sm-12">
            <div class="new-event-info">
                <!-- Left column -->
                <div class="col-md-3">
                    <ul class="footer_links footer_links-goods">
                        <li>
                            <a class="btn btn-default btn-sm btn-base-min" href="<?= \yii\helpers\Url::to(['/event-order/event/index'])?>" title="New event">
                                <span>New Event</span>
                            </a>
                        </li>
                        <li>
                            <?= $form->field($model, 'host_name')->textInput(['maxlength' => true])->label('Enter your name') ?>
                        </li>
                        <li>
                            <?= $form->field($model, 'event_name')->textInput(['maxlength' => true])->label('Enter event name') ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-md-push-1 new-event-list">
                    <!-- thumbnails -->
                    <div class="col-md-6 new-event-list">
                        <div class="">
                            <ul class="footer_links footer_links-goods">
                                <li>
                                    <a class="btn btn-default btn-sm btn-base-min" href="#" title="Choose invitation">
                                        <span>Choose invitation</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="pb-left-column thumbs-list-wrap">

                            <?= $this->render("_product-object-user", [
                                'model'=>$model,
                                'form'=>$form,
                            ]) ?>


                        </div>
                    </div>
                    <!-- end thumbs_list -->
                </div>
                <!-- /right column -->
            </div>
            <!--.large-left-->
        </div>
        <!--.row-->
        <div class="alert alert-warning col-sm-12">
            <div class="row send-cards-wrap">
                <div class="col-lg-12">
                    <div class="text-left">
                        <p>Sent cards</p>
                        text text text text text text text text text text text text text text text text text text
                    </div>
                </div>

            </div>
        </div>

        <div class="alert alert-warning col-sm-12">
            <?php if($model->id!="") { ?>
                <div class="col-lg-8 nav-list-left" style="text-align: right">
                    &nbsp;
                </div>
                <div class="col-lg-4 nav-list-left" style="text-align: right">
                    <?php
                    echo \kartik\file\FileInput::widget([
                        'model' => $model,
                        /*'accept' => 'image/*',*/
                        'attribute' => 'attachments[]',
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showUpload' => false,
                            'showCaption' => true,
                            /*'allowedFileTypes'=>['csv'],*/
                            'allowedFileExtensions'=>['csv'],
                            'browseLabel' =>  'Choose csv file'
                        ],
                        'options' => [
                            'multiple' => false,
                        ],
                    ]);
                    ?>
                    <br>
                    <br>
                </div>
            <?php } ?>

            <div class="col-lg-2 nav-list-left">
                <?= $this->render("_user-event-list", [
                    'model'=>$model,
                    'form'=>$form,
                ]) ?>
            </div>

            <?php if($model->id!="") { ?>
                <div class="col-lg-10 tab-section-wrap">
                    <?= $this->render("../receiver-event/_receiver", [
                        'model'=>$model,
                        'form'=>$form,
                        'dataProvider'=>$dataProviderReceiver,
                        'modelReceiver'=>$modelReceiver,
                    ]) ?>
                </div>
            <?php } ?>

        </div>


        <div class="alert alert-warning col-sm-12">
            <div class="row col-group">
                <div class="col-sm-12 clearfix">

                    <div class="col-sm-8">
                        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-sm-2">
                        <?= $form->field($model, 'start_date')->textInput() ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'end_date')->textInput() ?>
                    </div>

                    <div style="clear: both"></div>
                    <div class="col-sm-2">
                        <? /* $form->field($model, 'date_to_send')->textInput() */ ?>

                        <?php
                        // echo '<label class="control-label">Date to send</label>';

                        echo $form->field($model, 'date_to_send_text')->widget(\kartik\date\DatePicker::classname(), [
                            'model' => $model,
                            'attribute' => 'date_to_send_text',
                            'removeButton' => false,
                            /*'pickerButton' => false,*/
                            'type' => \kartik\date\DatePicker::TYPE_COMPONENT_APPEND,
                            'options' => ['placeholder' => 'date to send'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy'
                            ]
                        ]);
                        ?>
                    </div>

                    <div class="col-sm-10">
                        <?= $form->field($model, 'notes')->textInput() ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- .row -->
    <div class="row">
        <div class="alert alert-warning clearance-button col-sm-12">

            <?php if($model->payed_at=="") {?>
                <ul class="footer_links footer_links-goods clearfix">
                    <li>
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-sm btn-base-min']) ?>
                    </li>

                    <?php if($model->id != "") { ?>
                        <li>
                            <a class="btn btn-default btn-sm btn-base-min" href="<?= \yii\helpers\Url::to(['/event-order/event/delete', 'id'=>$model->id])?>" title="">
                                <span>Delete</span>
                            </a>
                        </li>


                        <li>
                            <a class="btn btn-default btn-sm btn-base-min" href="javascript:;" title="Publish" id="addProduct">
                                <span>Add to basket</span>
                            </a>
                        </li>


                        <li class="send-test">
                            <a href="<?= \yii\helpers\Url::to(['/event-order/event/test-send', 'id'=>$model->id])?>" title="">
                                <span><i class="fa fa-envelope" aria-hidden="true"></i> Get a free test card</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else {?>
                <p>This product has already been paid</p>
            <?php } ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

