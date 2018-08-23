<div class="catalog__grid--item product-element <?= $model->in_stock=="1" ? "":"not-available" ?>" product_id="<?= $model->id ?>">
    <div class="catalog__grid--item__price">
        <?php if($model->price_old != "") { ?>
            <span class="old-price"><?= $model->price_old ?></span>
        <?php } ?>
        <span class="new-price"> <span><?= round($model->price) ?><small>.00</small></span><span><?= \Yii::t('app', 'леев') ?></span></span></div>
    <div class="catalog__grid--item__image img-container"><img src="/img/item_image(760x760).png" alt="">
        <div class="catalog__grid--item__control">
            <div class="number">
                <input type="text" value="1" min="1" class="product-count">
                <span class="btn btn-plus-product"><i class="fa fa-angle-up"></i></span>
                <span class="btn btn-minus-product"><i class="fa fa-angle-down"> </i></span>
            </div>
            <button class="btn btn__accent addProduct"><?= \Yii::t('app', 'Купить') ?></button>
        </div>
    </div>
    <div class="catalog__grid--item__title">
        <a href="<?= \yii\helpers\Url::to(['product/item', 'product_id'=>$model->id])?>"><?= $model->name ?></a></div>
</div>
