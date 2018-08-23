<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$cImg = new \common\components\CImage();

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>


    <div class="row">

        <div class="col-md-12">
            <div style="text-align: center" data-view="addpicture">
                <ul id="sortable" class="file-list img_list_sortable sortable">';
                <?php  foreach ($model->pictures as $item) { ?>
                    <?php
                        $cImg = new \common\components\CImage();
                        $img = $cImg->getFile($item->shortPath, 150, 210, 'center');
                    ?>
                    <li class="bl_img" data-type="old" image_id="<?= $item->id ?>" >
                        <div style="background-image: url(<?= $img ?>)" > </div>
                        <a href="<?= \yii\helpers\Url::to(['/user/product/file-set-primery', 'id'=>$item->id]) ?>" title="Primery" data-pjax="0" data-method="post" class="primery"><span class="glyphicon <?= $item->sort==0 ? 'glyphicon-star':'glyphicon glyphicon-star-empty' ?>"></span></a>&nbsp;
                        <a href="<?= \yii\helpers\Url::to(['/user/product/file-delete', 'id'=>$item->id]) ?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post" class="delete"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;
                    </li>
                <?php } ?>
            </div>
            <div style="clear: both"></div>
        </div>
        <div class="col-md-12">
            <?php
            echo \kartik\file\FileInput::widget([
                'model' => $model,
                /*'accept' => 'image/*',*/
                'attribute' => 'attachments[]',
                'pluginOptions' => [
                    'showUpload' => false,
                    'showCaption' => false,
                ],
                'options' => ['multiple' => true]
            ]);
            ?>
            <label class="label-notes">Use up to ten photos to show your item's most important qualities.</label>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">Include keywords that buyers would use to search for your item.</label>
        </div>

        <div class="col-md-6">
            <?php
            $data = \yii\helpers\ArrayHelper::map(\common\models\Category::getMain(), 'id', 'name');
            echo $form->field($model, 'category_main_id')->dropDownList(
                $data,
                ['prompt'=>'']
            );
            ?>
            <label class="label-notes">Can’t find the perfect category or attributes? Pick whatever’s closest to make sure buyers can find your item. Learn more about getting found in search</label>
        </div>

        <div class="col-md-6">
            <?php
            $catModule = \common\models\Category::find()->orderBy('name')->all();

            $data = \yii\helpers\ArrayHelper::map($catModule, 'id', 'name');

            $options = [];
            foreach ($catModule as $item)
            {
                $options[$item->id] = [
                    'style'=>'display:none',
                    'parent'=>$item->parent_id,
                ];
            }

            echo $form->field($model, 'category_id')->dropDownList(
                $data,
                [
                    'prompt'=>'',
                    'options' => $options
                ]
            );
            ?>
            <label class="label-notes">Can’t find the perfect category or attributes? Pick whatever’s closest to make sure buyers can find your item. Learn more about getting found in search</label>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>
            <label class="label-notes">Start with a brief overview that describes your item's finest features.
                List details like dimensions and key features in easy-to-read bullet points.
                Tell buyers a bit about your process or the story behind this item.</label>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'is_physical')->checkbox() ?>
            <label class="label-notes">A tangible item that you will ship to buyers.</label>
        </div>
        <br>
        <div class="col-md-4">
            <?= $form->field($model, 'is_digital')->checkbox() ?>
            <label class="label-notes">A digital file that buyers will download.</label>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'is_request')->checkbox(); ?>
            <label class="label-notes">Buyers can request customisation</label>
        </div>


        <div class="col-md-12">
            <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">What words might someone use to search for your listings? Use all 13 tags to get found. Get ideas for tags.</label>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">Factor in the costs of materials and labor, plus any related business expenses.</label>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">SKUs are for your use only—buyers won’t see them. Learn more about SKU.</label>
        </div>

        <div class="col-md-2">
            <?php
            $data = \yii\helpers\ArrayHelper::map(\common\models\Celebration::find()->orderBy('name')->all(), 'id', 'name');
            echo $form->field($model, 'celebration_id')->dropDownList(
                $data,
                ['prompt'=>'']
            );
            ?>
            <label class="label-notes"></label>

        </div>

        <div class="col-md-3">
            <?php
            $data = \yii\helpers\ArrayHelper::map(\common\models\Format::find()->orderBy('name')->all(), 'id', 'name');
            echo $form->field($model, 'format_id')->dropDownList(
                $data,
                ['prompt'=>'']
            );
            ?>
            <label class="label-notes"></label>
        </div>

        <div class="col-md-3">
            <?php
            $data = \yii\helpers\ArrayHelper::map(\common\models\Section::find()->orderBy('name')->all(), 'id', 'name');
            echo $form->field($model, 'section_id')->dropDownList(
                $data,
                ['prompt'=>'']
            );
            ?>
            <label class="label-notes"></label>
        </div>



        <div class="col-md-12" style="text-align: center">
            <div class="form-group">
                <a href="<?= \yii\helpers\Url::to('/user/product/index')?>" class='btn btn-default btn-md btn-base-min'>Cancel</a>&nbsp;&nbsp;

                <a href="<?= \yii\helpers\Url::to('/user/product/index')?>" class='btn btn-default btn-md btn-base-min'>Preview</a>&nbsp;&nbsp;

                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-md btn-base-min']) ?>
            </div>
        </div>



    </div>


    <?php if(1==2) {?>
        <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>
    <?php }?>



    <?php ActiveForm::end(); ?>

</div>

<?php
/*

$this->registerJsFile('/js/jquery/jquery-ui.min.js', [
    'depends'=>[
        '\\yii\web\JqueryAsset'
    ],
    ['position' => \yii\web\View::POS_READY]
]);
*/
/*
$this->registerJsFile('/js/CImage.js', [
    'depends'=>[
        '\\yii\\web\\JqueryAsset'
    ]
]);
*/

// $this->registerCssFile('/css/img.css');
// $this->registerCssFile('/css/sortable.css?_='.\Yii::$app->params['version']);


?>