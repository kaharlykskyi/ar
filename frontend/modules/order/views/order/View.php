<?php
\Yii::$app->params['assestEventOrder'] = \frontend\modules\eventOrder\assets\EventOrderAsset::register($this);
?>


<?= $this->render('../common/_header') ?>

    <ul>
        <?php foreach ($model->orderProduct as $item) { ?>
            <li><?= $item->object_id ?></li>
        <?php } ?>
    </ul>

<?= $this->render('history-detailes/index') ?>



<?= $this->render('../common/_footer') ?>