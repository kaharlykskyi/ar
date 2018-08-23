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
        <h2 style="text-align:center ">Рефералы</h2><br>

        <div class="row referal">

            <?php if($model->id != \Yii::$app->user->id){ ?>

                <?php if(isset($model->parent->parent) && isset($model->parent->parent->id) && $model->parent->parent->id != User::REF_ADMIN && 1==2) { ?>
                    <div class="col-md-3">

                        <?php if($model->parent->parent->id != \Yii::$app->user->id){ ?>
                            <h3>уроивень <?= $model->parent->parent->lvl - \Yii::$app->user->identity->lvl ?></h3><br>
                            <?= \yii\helpers\Html::a($model->parent->parent->name, ['/user/lk/referal', 'id'=>$model->parent->parent->id])?>
                        <?php } else { ?>
                            <h3>уроивень 0</h3>
                            <br>
                            <?= \yii\helpers\Html::a('<b>Вы</b>', ['/user/lk/referal'])?>
                        <?php }?>
                    </div>
                <?php } ?>

                <div class="col-md-3">
                    <?php if($model->parent->id != \Yii::$app->user->id){ ?>
                        <h3>уроивень <?= $model->parent->lvl - \Yii::$app->user->identity->lvl ?></h3><br>
                        <?= \yii\helpers\Html::a($model->parent->name, ['/user/lk/referal', 'id'=>$model->parent->id])?>
                    <?php } else { ?>
                        <h3>уроивень 0</h3>
                        <br>
                        <?= \yii\helpers\Html::a('<b>Вы</b>', ['/user/lk/referal'])?>
                    <?php }?>
                </div>

                <div class="col-md-3">

                    <h3>уроивень <?= $model->lvl - \Yii::$app->user->identity->lvl ?></h3><br>

                    <?php foreach ($model->parent->child as $item) { ?>
                        <div>
                            <p>
                                <?php if($model->id == $item->id ) {?>
                                    <?= $model->name ?>
                                <?php } else { ?>
                                    <?= \yii\helpers\Html::a($item->name, ['/user/lk/referal', 'id'=>$item->id])?>
                                <?php } ?>
                            </p>
                        </div>
                    <?php } ?>


                </div>
            <?php } else { ?>
                <div class="col-md-3">
                    <h3>уроивень 0</h3>
                    <br><b>Вы 1</b>
                </div>
            <?php }?>
            <div class="col-md-3">

                <h3>уроивень <?= $model->lvl+1 - \Yii::$app->user->identity->lvl ?></h3><br>
                <?php foreach ($model->child as $item) { ?>
                    <div>
                        <p>
                            <?= \yii\helpers\Html::a($item->name, ['/user/lk/referal', 'id'=>$item->id])?>
                        </p>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>
</div>





