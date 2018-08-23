<?php

use yii\helpers\Html;

?>


<?php
\Yii::$app->params['assestEventOrder'] = \frontend\modules\eventOrder\assets\EventOrderAsset::register($this);
?>


<?= $this->render('../common/_header') ?>

<div class="basket">
    <?php if($data['count'] > 0) { ?>

        <!-- bascket list -->
        <div class="basket__list">
            <?= $this->render('_form', [
                'model' => $model,
                'data'=>$data,
                'address'=>$address,
                'fio'=>$fio
            ]) ?>

        </div>


        <!-- delivery  -->

    <?php } else { ?>
        <h4><?= \Yii::t('app', 'Корзина пусто.') ?></h4>
        <br>
        <br>
    <?php }  ?>
</div>


<?= $this->render('../common/_footer') ?>