<?php
\Yii::$app->params['assestEvent'] = \frontend\assets\EventAsset::register($this);
?>

<?= $this->render('_envelope', [
    'model'=>$model,
    'modelReceiverEvent'=>$modelReceiverEvent,
    'id'=>$id
]); ?>

<?= $this->render('_content', [
    'model'=>$model,
    'modelReceiverEvent'=>$modelReceiverEvent,
    'id'=>$id
]); ?>

<?= $this->render('common/footer', [
    'model'=>$model,
    'modelReceiverEvent'=>$modelReceiverEvent,
    'id'=>$id
]); ?>



<?php

$productObjectUser = $model->productObjectUser;

$page = 'card';
$productPage = $productObjectUser->$page;
$cardData = $productPage->getPageElement('');


$fontList = \common\components\CFormatter::getFonts($cardData);
$fonts = \common\models\font\Font::find()->where(['name'=>$fontList])->all();
?>

<?= $this->render('_fontcss', [
    'fonts'=>$fonts,
]); ?>

<script>
    var glTemplateFont = <?= json_encode($fontList); ?>;

</script>
