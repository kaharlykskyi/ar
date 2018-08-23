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
                <ul id="sortable" class="file-list img_list_sortable sortable">
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
                </ul>
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
                    'showPreview' => false,
                    'initialCaption'=>"Download product images",
                    'showUpload' => false,
                    'showCaption' => true,
                ],
                'options' => ['multiple' => true]
            ]);
            ?>
            <label class="label-notes">Total max. 100 MB</label>
        </div>

        <div class="col-md-12">

            <?php

            if(!empty($model->resource))
                echo '<p>'.Html::a('<b><span class="glyphicon glyphicon-download"></span> Download '.$model->resource->name.'</b>', [$model->resource->fullpath]).'</p>';
            ?>

            <?php
            echo \kartik\file\FileInput::widget([
                'model' => $model,
                /*'accept' => 'image/*',*/
                'attribute' => 'resources[]',
                'pluginOptions' => [
                    'initialCaption'=>"Download product data (Jpg, Png, Zip, WinRar)",
                    'showPreview' => false,
                    'showUpload' => false,
                    'showCaption' => true,
                ],
                'options' => ['multiple' => false]
            ]);
            ?>
            <label class="label-notes">Total max. 100 MB</label>
        </div>


        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">Choose the right keywords presenting your product. It helps our customers to find your item.</label>
        </div>

        <div class="col-md-6">
            <?php
            $data = \yii\helpers\ArrayHelper::map(\common\models\Category::getMain(), 'id', 'name');
            echo $form->field($model, 'category_main_id')->dropDownList(
                $data,
                ['prompt'=>'']
            );
            ?>
            <label class="label-notes">Choose the main category, f. ex. invitations</label>
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
            <label class="label-notes">Choose a sub-category, f. ex. Birthday</label>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>
            <label class="label-notes">Tell here about your product. The search machine loves the unique descriptions,  that’s why it is a benefit for you to avoid cloning, even if you post some similar items.  It is better if your text is shorter, but unique, than longer, but copied from other products.</label>
        </div>


        <div class="col-md-4">
            <?= $form->field($model, 'is_physical')->checkbox() ?>
            <label class="label-notes">This item is tangible and can be shipped</label>
        </div>
        <br>
        <div class="col-md-4">
            <?= $form->field($model, 'is_digital')->checkbox() ?>
            <label class="label-notes">This item can be downloaded online</label>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'is_request')->checkbox(); ?>
            <label class="label-notes">Customers can request a special order</label>
        </div>


        <div class="col-md-12">
            <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">How can People find your item? Choose the best words, which make it easier for people to find your content</label>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">Optionally including your local taxes, but without shipping cost</label>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
            <label class="label-notes">This optional field is made for your own inventory management</label>
        </div>

        <div class="col-md-2">
            <?php
            $data = \yii\helpers\ArrayHelper::map(\common\models\Celebration::find()->orderBy('name')->all(), 'id', 'name');
            echo $form->field($model, 'celebration_id')->dropDownList(
                $data,
                ['prompt'=>'']
            );
            ?>
            <label class="label-notes">For digital items like cards, if the final design includes a personal photo</label>

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

            <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>
            <label class="label-notes"></label>


        </div>



        <div class="col-md-12" style="text-align: center">
            <div class="form-group">
                <a href="<?= \yii\helpers\Url::to('/user/product/index')?>" class='btn btn-default btn-md btn-base-min'>Cancel</a>&nbsp;&nbsp;

                <a href="<?= \yii\helpers\Url::to(['/product/item', 'id'=>$model->id])?>" class='btn btn-default btn-md btn-base-min'>Preview</a>&nbsp;&nbsp;

                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-default btn-md btn-base-min']) ?>

                <?php if(!isset($model->id)){ ?>
                    <div style="float: right;; color: #D00">Please Save your<br>new product to proceed<br>to Create a card</div>
                <?php } else {?>
                    <a style="float: right;" href="<?= \yii\helpers\Url::to(['/product-object/editor/edit', 'product_id'=>$model->id])?>" class='btn btn-default btn-md btn-base-min'>Create a card</a>&nbsp;&nbsp;
                <?php }?>
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
/*
$this->registerJsFile('/js/CProduct.js?_='.\Yii::$app->params['version'], [
    'depends' => ['yii\web\JqueryAsset']
]);
*/
?>
