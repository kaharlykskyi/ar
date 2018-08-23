<?php
use \yii\bootstrap\ActiveForm;
?>

<div role="tabpanel" class="tab-pane active j-tools-block j-tools-block-photo-transparent" id="j-tools-photo">

    <div class="pg15">


        <ul class="nav nav-tabs text_style_tab" role="tablist">
            <li role="presentation" class="active"><a href="#Photos-images" aria-controls="Photos-images" role="tab" data-toggle="tab">Background</a></li>
            <li role="presentation"><a href="#Photos-transparent" aria-controls="Photos-transparent" role="tab" data-toggle="tab">Transparent</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Photos-images">

                <br>
                <br>
                <div class="j-upload-photo" style="">

                    <div style="display: none">
                        <?php $form = \yii\bootstrap\ActiveForm::begin([
                            'options' => ['enctype' => 'multipart/form-data']
                        ]); ?>

                        <input type="text" class="j-upload-element-type" value="<?= \common\models\ProductObject\ElementType::TYPE_CARD_IMAGE ?>">

                        <?php
                        echo \kartik\file\FileInput::widget([
                            'model' => $model,
                            'name' => 'attachments',
                            /*'accept' => 'image/*',*/
                            'attribute' => 'attachments[]',
                            'pluginOptions' => [
                                'uploadAsync' => false,
                                'showUpload' => false,
                                'showCaption' => false,
                                    'filebatchuploadcomplete' => "function(event, files, extra) {
                                    console.log(files);
                                    console.log('File batch upload complete');
                                }",
                            ],
                            'options' => ['multiple' => true]
                        ]);
                        ?>
                        <?php ActiveForm::end(); ?>
                    </div>




                    <div class="file-loading">
                        <input id="attachments-card-image" name="Photo[attachments][]" type="file" multiple>
                    </div>


                </div>


                <ul class="bl_backgraund_list j-photo-list">
                    <?php foreach(\common\models\ProductObject\Photo::getList(\common\models\ProductObject\ElementType::TYPE_CARD_IMAGE, $product_object_id) as $item) { ?>
                        <?php if(isset($item->pictures[0])) { ?>

                            <li>
                                <a href="javascript:;" class="j-photo-item">
                                    <img src="<?= $item->pictures[0]->fullPath ?>" data-id="<?= $item->id ?>" >
                                </a>
                                <a href="javascript:;" class="close_photo" data-id="<?= $item->id ?>">&#10005;</a>
                            </li>

                        <?php } ?>
                    <?php } ?>
                </ul>



            </div>
            <div role="tabpanel" class="tab-pane" id="Photos-transparent">

                <br>
                <br>
                <a href="javascript:;" class="btn btn-default j-add-shape">Choose a place</a>
                <a href="javascript:;" class="btn btn-default j-delete-shape">Delete place</a>

                <br>
                <br>
                Please choose a place for a photo, if it is suggested in your design

            </div>

        </div>
    </div>


</div>
