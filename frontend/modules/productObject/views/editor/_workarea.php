<?php
use \common\models\ProductObject\ElementType;
?>


<div class="bl_content j-element-bg">
    <div class="j-order-confirm c-order-confirm" >
        <a href="javascript:;" class="btn btn-primary btn-lg">Confirm card</a>
    </div>
    <div class="bl_view j-block-view">
        <div class="bl_canvas j-block-canvas" width="<?= \Yii::$app->params['canvas-width'] ?>" height="<?= \Yii::$app->params['canvas-height'] ?>">



            <canvas id="j-work-area" width="<?= \Yii::$app->params['canvas-width'] ?>" height="<?= \Yii::$app->params['canvas-height'] ?>" ></canvas>

            <div class="canvas_margin_lr">

            </div>
            <div class="canvas_margin_tb">

            </div>
        </div>
        
        <div class="bl_envelope j-block-envelope" style="background: #fdffe6; display: none">

        </div>
        <div class="bl_rsvp j-block-rsvp" style="display: none">
            <div class="rsvp_content">
                <div class="rsvp_h1">
                    Your guest's name.
                </div>
                <div class="row rsvp_btn_row">
                    <div class="col-md-12">
                        <textarea class="form-control">

                        </textarea>
                    </div>
                </div>
                <div class="row rsvp_btn_row">
                    <div class="col-md-12 numb_row">
                        Enter&nbsp;<input type="text" value="00">&nbsp;number of guests
                    </div>
                </div>
                <div class="row rsvp_btn_row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <a href="javascript:;" class="btn btn-block btn-default btn_rborder">Will attend</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <a href="javascript:;" class="btn btn-block btn-default btn_rborder">Will not attend</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    
</div>




<div style="display: none">
    <form id="sfg-pdf" action="<?= \yii\helpers\Url::to(['/product-object/editor/confirm']) ?>" method="post">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <input type="hidden" name="page_id" value="<?= $model->id; ?>" />
        <textarea id="svg" class="form-control" name="svg" rows="6" aria-invalid="false"></textarea>
    </form>
</div>
