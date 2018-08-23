<div id="views_block" class="clearfix">

    <ul class="j-product-object-user-list">
        <?php
        $productObjectUser =  \common\models\ProductObject\ProductObjectUser::find()->where('user_id=:user_id', [
            ':user_id'=>\Yii::$app->user->id
        ])->all();
        ?>

        <?php foreach ($productObjectUser as $item) { ?>

            <li>
                <div class="j-product-object-user-item <?= $model->product_object_user_id == $item->id ? 'active':''?>">
                    <?php
                    $cImg = new \common\components\CImage();
                    $img = $cImg->getFile($item->product->firstPictureShortPath, 84, 120, 'center');
                    ?>
                    <a href="javascript:;" data-id="<?= $item->id ?>">
                        <img class="img-responsive" id="thumb_24" src="<?= $img ?>" alt="" title="" itemprop="image">
                    </a>
                </div>
                <div>
                    <a href="<?= \yii\helpers\Url::to(['/product-object/editor/use', 'product_id'=>$item->product->id]) ?>">
                        Edit Card
                    </a>
                </div>
            </li>
        <?php } ?>
    </ul>

    <div style="clear:both"></div>
    <?= $form->field($model, 'product_object_user_id')->hiddenInput()->label(false); ?>

</div>