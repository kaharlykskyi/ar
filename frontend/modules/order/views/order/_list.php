<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label'=>'Name',
            'value'=>function($model){
                return date('d.m.Y', $model->created_at);
            }
        ],
        [
            'label'=>'sum',
            'value'=>function($model){
                return $model->sum;
            }
        ],
        [
            'label'=>'',
            'format'=>'raw',
            'value'=>function($model){
                return Html::a('view order', ['/order/order/view', 'id'=>$model->id]);
            }
        ],


        //'sended_at',
        //'created_at',
        /* ['class' => 'yii\grid\ActionColumn'],*/
        /*
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => "{delete}"
        ],
        */
    ],
]); ?>


