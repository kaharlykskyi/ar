<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\User;

$cImg = new \common\components\CImage();

// $model = \Yii::$app->user->getIdentity();
$cid = Yii::$app->controller->id."-".Yii::$app->controller->action->id;

?>

<div class="row">

    <div class="col-md-2">
        <?= $this->render('_menu'); ?>
    </div>
    <div class="col-md-10">
        <h2 style="text-align:center ">Выплаты</h2><br>

        <?= \yii\helpers\Html::a('Дарить подарок', ['/user/lk/payed'])?>
    </div>
</div>
