





<div class="row j-receiver-add-form"
     data-url-add="<?= \yii\helpers\Url::to(['/event-order/receiver-event/create']) ?>"
     data-url-update="<?= \yii\helpers\Url::to(['/event-order/receiver-event/update']) ?>"
     data-url-delete="<?= \yii\helpers\Url::to(['/event-order/receiver-event/delete']) ?>"

>
    <input type="hidden" name="<?= \Yii::$app->request->csrfParam; ?>" id="<?= \Yii::$app->request->csrfParam; ?>" value="<?= \Yii::$app->request->csrfToken; ?>" />
    <input type="hidden" id="receiverevent-event_id"  value="<?= $model->id ?>" />

    <div class="col-md-4">
        <div class="form-group field-receiverevent-name">
            <label class="control-label" for="receiverevent-name">Name</label>
            <input type="text" id="receiverevent-name" class="form-control" name="ReceiverEvent[name]" maxlength="128">
            <p class="help-block help-block-error"></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group field-receiverevent-email">
            <label class="control-label" for="receiverevent-email">Email</label>
            <input type="text" id="receiverevent-email" class="form-control" name="ReceiverEvent[email]" maxlength="128">
            <p class="help-block help-block-error"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group field-receiverevent-invited">
            <label class="control-label" for="receiverevent-invited">Invited</label>
            <input type="text" id="receiverevent-invited" class="form-control" name="ReceiverEvent[invited]">
            <p class="help-block help-block-error"></p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group field-receiverevent-email">
            <label class="control-label" for="receiverevent-email">&nbsp;</label><br>
            <button type="button" class="btn btn-default btn-sm btn-base-min btn-small1">Add guest</button>
        </div>
    </div>
    <div class="col-md-12 status">
    </div>
</div>
