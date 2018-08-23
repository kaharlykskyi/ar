<?php
\Yii::$app->params['assestEditor'] = \frontend\modules\productObject\assets\EditorAsset::register($this);



?>


<?= $this->render('_header'); ?>

<div class="constructor_main">
    <a class="j_open_toolsbar c_open_toolsbar">
        <i class="fas fa-bars"></i>
        <i class="i_close">&#10005;</i>
    </a>
    <div class="bl_tools">
        <?= $this->render('_menu', [
            'model'=>$data['model']
        ]); ?>
        <?= $this->render('tools/_tools', [
            'data'=>$data
        ]); ?>
    </div>
    <?= $this->render('_workarea', [
        'model'=>$data['model'],
        'tpl'=>$data['tpl']
    ]); ?>
</div>


<script>
    var glProductObject = {        
    }

    var glProductObjectElements = [];

</script>


<?php

    $fontList = \common\components\CFormatter::getFonts($data['elementData']);
    $fonts = \common\models\font\Font::find()->where(['name'=>$fontList])->all();
?>

<?= $this->render('tools/_fontcss', [
    'fonts'=>$fonts,
]); ?>

<script>
    var glTemplateFont = <?= json_encode($fontList); ?>;

</script>
