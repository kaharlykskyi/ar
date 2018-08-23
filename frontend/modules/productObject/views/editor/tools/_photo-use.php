<?php
use \yii\bootstrap\ActiveForm;
?>

<div role="tabpanel" class="tab-pane active j-tools-block j-tools-block-photo" id="j-tools-photo">
    <div class="pg15">
        <ul class="nav nav-tabs text_style_tab" role="tablist">
            <li role="presentation" class="active"><a href="#Photos-images" aria-controls="Photos-images" role="tab" data-toggle="tab">Photo</a></li>
            <li role="presentation"><a href="#Photos-edit" aria-controls="Photos-edit" role="tab" data-toggle="tab">Edit Photo</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Photos-images">
                <br>
                <br>
                <ul class="bl_backgraund_list j-photo-list css-photo-list">
                    <li>
                        <div class="j-upload-photo">

                            <div style="display: none">
                                <?php $form = \yii\bootstrap\ActiveForm::begin([

                                    'options' => ['enctype' => 'multipart/form-data']
                                ]); ?>

                                <input type="text" class="j-upload-element-type" value="<?= \common\models\ProductObject\ElementType::TYPE_PHOTO ?>">

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
                                    'options' => ['multiple' => true],

                                ])
                                ?>
                                <?php ActiveForm::end(); ?>
                            </div>


                            <div class="file-loading">
                                <input id="attachments-photo" name="PhotoUser[attachments][]" type="file" multiple>
                            </div>
                        </div>

                    </li>
                    <?php foreach(\common\models\ProductObject\PhotoUser::getList(\common\models\ProductObject\ElementType::TYPE_PHOTO) as $item) { ?>
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
            <div role="tabpanel" class="tab-pane" id="Photos-edit">

                <div class="text_style_bl_title">
                    <span >Scale</span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- div>
                            <div id="j-text-font-size" class="slider_bar" data-keys="ctrl" style="background-color:#069; border-radius:10px; height:40px"></div>
                        </div -->
                        <div class="range_slider j-photo-scale-block">
                            <a href="javascript:;" class="down"></a>
                            <input type="range" id="j-photo-scale" max="40" min="1">
                            <a href="javascript:;" class="up"></a>
                        </div>
                    </div>
                </div>
                <div class="text_style_bl_title">
                    <span >Rotation</span>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <a href="javascript:;" class="css-photo-rotate j-photo-rotate"></a>
                        </div>
                    </div>
                </div>
                <div class="text_style_bl_title">
                    <span >Filter</span>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <ul class="bl_backgraund_list j-photo-filter">
                            <li>
                                <a href="javascript:;" class="j-photo-filter photo-filter_empty" data-index="0">
                                    <span>No Filter</span>
                                </a>
                            </li>
                            <?php for ($i=1; $i<15; $i++) { ?>
                                <li>
                                    <a href="javascript:;" class="j-photo-filter" data-index="<?= $i ?>">
                                        <img src="/uploads/pe-photo/5/wIMXCvgwI1vcJhSCDd9H1Q4cpeA_RXcIyaQJ94LA0DtH4k3vmG05fDBMICbmFn3V_1521380377.png" >
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>

        </div>


    </div>

    

</div>
