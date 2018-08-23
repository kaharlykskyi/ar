<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<?php if($modelReceiver != "" && $model->payed_at==""){ ?>
    <?= $this->render('_receiver-add',[
        'modelReceiver'=>$modelReceiver,
        'model'=>$model
    ]); ?>
<?php } ?>

<?php

$columns = [
    [
        'label'=>'Name',
        'value'=>function($model){
            return $model->name;
        }
    ],
    [
        'label'=>'Email',
        'value'=>function($model){
            return $model->email;
        }
    ],
    [
        'label'=>'Status',
        'format'=>'raw',
        'value'=>function($model){
            $t = "";
            if($model->status == 1)
                $t = '<span class="label">Opened</span>';
            else
                $t = '<span class="label not-open">Not opened</span>';

            return $t;
        }
    ],
    [
        'label'=>'Invited',
        'format'=>'raw',
        'value'=>function($model){

            if($model->invited == "")
                return "";
            else
                return $model->invited;
        }
    ],
    [
        'label'=>'Attempt',
        'format'=>'raw',
        'value'=>function($model){
            if($model->attempt == "")
                return "";
            else
                return $model->attempt;
        }
    ],
    [
        'label'=>'Replies',
        'format'=>'raw',
        'value'=>function($model){
            if($model->replies == "")
                return "";
            else
                return $model->replies;
        }
    ],
    [
        'label'=>'Resend',
        'format'=>'raw',
        'value'=>function($model){
            return "<a href='".\yii\helpers\Url::to(['/event-order/event/resend', 'id'=>$model->id])."' class='btn btn-success resend'><i class='fa fa-recycle' aria-hidden='true'></i></a>";
        }
    ],
];

if($model->payed_at==""){

    $columns[]=[
            'format'=>'raw',
            'value'=>function($model){

                return '<div style="text-align: center">'
                .'<a href="'.\yii\helpers\Url::to(['/event-order/receiver-event/delete', 'id'=>$model->id]).'" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;'
                .'<a href="javascript:;" class="j-receiver-item-edit" data-href="'.\yii\helpers\Url::to(['/event-order/receiver-event/update']).'" title="Edit" data-pjax="0" data-method="get"><span class="glyphicon glyphicon-pencil"></span></a>'
                .'</div>';
            }
        ];

}


//'sended_at',
//'created_at',
/* ['class' => 'yii\grid\ActionColumn'],*/
/*
[
    'class' => 'yii\grid\ActionColumn',
    'template' => "{delete}"
],
*/

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns
]); ?>
