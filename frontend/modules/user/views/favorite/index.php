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
    <div id="center_column" class="col-sm-9 block center_column favorite-list">

        <?= $this->render('_result', [
            'dataProvider'=>$dataProvider,
            'model'=>$model,
        ]) ?>

    </div>
</div>

<?= $this->render('../common/_footer') ?>



