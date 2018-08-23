<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>



<?= $this->render('../common/_header') ?>

<div class="row">
    <div class="col-sm-3 block">
        <?= $this->render('../common/_menu'); ?>
    </div>
    <div id="center_column" class="col-sm-9 block center_column">

        <?= $this->render('_filter'); ?>
        <!-- Products list -->

        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => [
                /*'class' => 'par-1'*/
                'tag' => false,
            ],

            'itemView' => '_item',
            'options' => [
                /*
                'class' => 'ajax_block_product col-xs-6 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line',
                'id' => '',
                'style'=>'',
                'tag' => 'li',
                */
            ],
            'viewParams'=> [
                'searchmodel'=>$searchModel,
            ],
            'pager' => [
                'maxButtonCount'=>5,
            ],
            'layout' => "<ul class='goods-product product_list grid row'>{items}</ul>\n<div class='clearfix'></div>{pager}"
        ]);
        ?>

    </div>
</div>

<?= $this->render('../common/_footer') ?>