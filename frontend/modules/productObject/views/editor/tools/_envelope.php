<?php

use \yii\bootstrap\ActiveForm;

?>
<div role="tabpanel" class="tab-pane c-tools-block-envelope j-tools-block j-tools-block-envelope" id="j-tools-envelope">
    <div class="scroll">
        <div class="pg15">
            <div class="j-upload-photo" style="display: none">
                <div style="display: none">
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data']
                    ]); ?>

                    <input type="text" class="j-upload-element-type" value="<?= \common\models\ProductObject\ElementType::TYPE_ENVELOPE_IMAGE ?>">

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
                    <input id="attachments-envelope" name="Photo[attachments][]" type="file" multiple>
                </div>
            </div>

            <ul class="bl_backgraund_list j-photo-list">
                <?php foreach(\common\models\ProductObject\Photo::getList(\common\models\ProductObject\ElementType::TYPE_ENVELOPE_IMAGE) as $item) { ?>
                    <?php if(isset($item->pictures[0])) { ?>

                        <li>
                            <a href="javascript:;" class="j-photo-item">
                                <?php

                                $cImg = new \common\components\CImage();

                                // echo $item->pictures[0]->shortPathNoId;

                                $img = $cImg->getFile($item->pictures[0]->shortPathNoId, 50, 70, 'center');

                                $imgBg = $cImg->getFile($item->pictures[0]->shortPathNoId, 500, 700, 'center');

                                ?>


                                <img src="<?= $img ?>" data-src="<?= $imgBg /*$item->pictures[0]->fullPath*/ ?>" data-id="<?= $item->id ?>" >
                            </a>
                        </li>

                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>


</div>