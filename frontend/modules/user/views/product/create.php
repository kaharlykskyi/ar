<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = Yii::t('app', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('../common/_header') ?>

    <div class="row alert alert-warning">
        <div class="col-sm-4 block">
            <?= $this->render('../common/_menu'); ?>
        </div>
        <div class="col-sm-8 block">
            <h2 style="text-align:center "><?= Html::encode($this->title) ?></h2><br>

            

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

<?= $this->render('../common/_footer') ?>