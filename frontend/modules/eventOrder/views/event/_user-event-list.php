<?php 

$eventList = \common\models\event\Event::find()->where('user_id=:user_id', [
   ':user_id'=>\Yii::$app->user->id
])->all();

?>
<div class="vert_scrolle">
    <ul class="nav-list c-event-list" role="tablist">

        <?php foreach($eventList as $item) { ?>

            <li class="c-event-item <?= $model->id == $item->id ? 'active':'' ?>">
                <b><?= $item->host_name ?></b><br>
                <a href="<?= \yii\helpers\Url::to(['/event-order/event/update', 'id'=>$item->id]) ?>" class="c-event-item-edit">view event</a>
                <?php
                $cImg = new \common\components\CImage();
                $img = "";
                if(isset($item->productObjectUser->product))
                    $img = $cImg->getFile($item->productObjectUser->product->firstPictureShortPath, 30, 50, 'center');

                ?>
                <img class="img-responsive img-celebration" src="<?= $img ?>" alt="" title="" height="30" width="30" itemprop="image">

                <?php if($model->id!="" && $model->id == $item->id) { ?>


                    <?php $combo=""; ?>
                    <?php foreach($eventList as $itemCombo) { ?>
                        <?php if($model->id != $itemCombo->id && $itemCombo->payed_at=="") { ?>
                            <?php $combo = '<option value="'.$itemCombo->id.'">'.$itemCombo->event_name.'</option>' ?>
                        <?php } ?>
                    <?php } ?>


                    <?php if($combo != "") {?>
                        <select class="j-copy-to" data-href="<?= \yii\helpers\Url::to(['/event-order/event/clone-guest', 'from'=>$model->id]) ?>">
                            <option value="">Copy guest list to...</option>
                            <?= $combo; ?>
                        </select>
                    <?php } ?>

                    <?php if(1==2) { ?>
                        &nbsp;&nbsp;<a href="<?= \yii\helpers\Url::to(['/event-order/event/clone-guest', 'id'=>$model->id, 'from'=>$item->id]) ?>" class="c-event-item-edit">copy guest list</a>
                    <?php } ?>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
</div>
