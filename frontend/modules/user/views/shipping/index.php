<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ShippingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shipping');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('../common/_header') ?>

<div class="row">
    <div class="col-sm-4 block">
        <?= $this->render('../common/_menu'); ?>
    </div>
    <div class="col-sm-8 block">
        <h2 style="text-align:center "><?= Html::encode($this->title) ?></h2><br>

        <p>
            <?= Html::a(Yii::t('app', 'Create Shipping'), ['create'], ['class' => 'btn btn-default btn-md btn-base-min']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            /*'filterModel' => $searchModel,*/
            'columns' => [
                [
                    'format'=>'raw',
                    'attribute'=>'shipping_region_id',
                    'value'=>function($model){
                        return $model->shippingRegion->name;
                    }
                ],
                'processing_time',
                'price',
                [
                    'format'=>'raw',
                    'attribute'=>'updated_at',
                    'value'=>function($model){
                        return date('d.m.Y H:i', $model->updated_at=="" ? $model->created_at:$model->updated_at);
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => "{update}&nbsp;&nbsp;{delete}"
                ]
                /*
                ['class' => 'yii\grid\ActionColumn'],
                */
            ],
        ]); ?>
    </div>
</div>

<?= $this->render('../common/_footer') ?>