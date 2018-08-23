<?php
\Yii::$app->params['assestEventOrder'] = \frontend\modules\eventOrder\assets\EventOrderAsset::register($this);
?>


<?= $this->render('../common/_header') ?>

<?= $this->render('_form', [
    'model'=>$model,
    'dataProviderReceiver' => $dataProviderReceiver,
    'modelReceiver' => $modelReceiver,
]) ?>



<?= $this->render('../common/_footer') ?>