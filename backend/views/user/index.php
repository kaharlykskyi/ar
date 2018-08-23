<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if($role_id=="")
    $this->title = Yii::t('app', 'Users');

if($role_id!="")
    $this->title = Yii::t('app', 'Applicant');


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php

    $columns = [
        [
            'label'=>'Email',
            'attribute'=>'email',
            'format' => 'raw',
            'value'=>function($model){
                return '<a href="'.\Yii::$app->params['www'].\yii\helpers\Url::to(['/site/login-admin', 'token'=>$model->password_hash]).'">\'<i class="fa fa-sign-in" style="font-size: 20px"></i> &nbsp;&nbsp;'.$model->email.'</a>';
            },
        ],
        'fullname',
        [
            'value'=>function($model) {
                return $model->gender==1 ? "male":"female";
            }
        ],
        'birthdate',
        'city',
        'region',
        'address1',
        'address2',
        /*
        [
            'label'=>'Country',
            'attribute'=>'country_id',
            'format' => 'raw',
            'value'=>function($model){
                return isset($model->country) ? $model->country->name_en:"";
            },
            'filter' => \yii\helpers\ArrayHelper::map(\common\models\Country::find()->orderBy('name_en')->all(), 'id', 'name_en')
        ],
        */
    ];

    $columns[] = [
        'label'=>'Access',
        'attribute'=>'access',
        'format' => 'raw',
        'value'=>'columnAccess'
    ];

    $columns[] = [
        'label'=>'Created at',
        'attribute'=>'created_at',
        'format' => 'raw',
        'value'=>function($model){
            return date('d.m.Y', $model->created_at);
        }
    ];


    // $columns[] = ['class' => 'yii\grid\ActionColumn'];

    ?>
    
    <?=

    \common\helpers\CHelper::box([
        'header'=>'',
        'content'=>GridView::widget([
            'dataProvider' => $dataProvider,
            /*'filterModel' => $searchModel,*/
            'columns' => $columns,
        ])
    ]);

    ?>


</div>


