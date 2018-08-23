<?php



?>
<div class="container_card j-container_card j-element-bg" 
    data-get-envelope-url="<?= \yii\helpers\Url::to(['/event/get-envelope', 'id'=>$model->id]) ?>"
>
    <div class="bl_envelope1" style="display: none">
        <div class="layer1" style=""></div>
        <div class="layer3" style=""></div>
    </div>

    <div class="bl_envelope" style="display: none">
        <div class="layer1" style=""></div>
        <div class="layer2">
                <div id="card">
                <div class="front" style="">
                    <canvas id="j-work-area" width="<?= \Yii::$app->params['canvas-width'] ?>" height="<?= \Yii::$app->params['canvas-height'] ?>" ></canvas>
                </div>
                <div class="back" style="">
                    <canvas id="j-work-area-backside" width="<?= \Yii::$app->params['canvas-width'] ?>" height="<?= \Yii::$app->params['canvas-height'] ?>" ></canvas>
                </div>
            </div>
        </div>
        <div class="layer3" style=""></div>
    </div>

    <div class="bl_rsvp j-block-rsvp" style="display: none">
        <div class="rsvp_content">
            <div class="rsvp_h1">
                <?= $modelReceiverEvent->name ?>
            </div>
            <div class="row rsvp_btn_row">
                <div class="col-md-12">
                        <textarea class="form-control c-replies j-replies" name="replies"></textarea>
                </div>
            </div>
            <div class="row rsvp_btn_row">
                <div class="col-md-12 numb_row">
                    Enter&nbsp;<input type="text" class="j-invited" value="<?= $modelReceiverEvent->attempt ?>">&nbsp;number of guests
                </div>
            </div>
            <div class="row rsvp_btn_row">
                <div class="col-md-6 col-sm-6 col-xs-6">

                    <?php

                    $urlAttend = "";
                    $urlNotAttend = "javascript:;";
                    if(isset($modelReceiverEvent->id)){
                        $urlAttend = \yii\helpers\Url::to(['/event/attend', 'id'=>$modelReceiverEvent->id]);
                        $urlNotAttend = \yii\helpers\Url::to(['/event/not-attend', 'id'=>$id]);
                    }

                    ?>

                    <a href="javascript:;" data-href="<?=  $urlAttend ?>" class="btn btn-block btn-default btn_rborder j-btn-attend">Will attend</a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <a href="<?= $urlNotAttend ?>" class="btn btn-block btn-default btn_rborder">Will not attend</a>
                </div>
            </div>

        </div>
    </div>
</div>