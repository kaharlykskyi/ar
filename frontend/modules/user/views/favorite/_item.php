<?php
$cImg = new \common\components\CImage();

$model = $model->product;

?>

<div class="product-container" itemscope itemtype="https://schema.org/Product" data-id="<?= $model->id ?>" >
    <div class="left-block">
        <div class="product-image-container">
            <div class="tmproductlistgallery rollover">
                <div class="tmproductlistgallery-images">
                    <?php
                    if(isset($model->pictures[0]))
                    {
                        $cImg = new \common\components\CImage();
                        $img = $cImg->getFile($model->pictures[0]->shortPath, 300, 421, 'center');
                    }
                    else{
                        $img = $cImg->getFile(\Yii::$app->params['nopic'], 300, 421, 'center');
                    }
                    ?>

                    <a class="product_img_link" href="<?= url(['/product/item', 'id'=>$model->id]) ?>" title="<?= e($model->name) ?>" itemprop="url">
                        <img class="img-responsive" src="<?= $img ?>" alt="<?= e($model->name) ?>" title="<?= e($model->name) ?>" />
                    </a>
                </div>
            </div>
            <?php if(1==2) { ?>
                <a class="sale-box" href="#">
                    <span class="sale-label">Sale!</span>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="right-block">
        <h5 itemprop="name">
            <a class="product-name" href="<?= url(['/product/item', 'id'=>$model->id]) ?>" title="<?= e($model->name) ?>" itemprop="url" >
                <span class="grid-name"><?= e($model->name) ?></span>
            </a>
        </h5>
        <p class="" itemprop="description">
            <a class="category-name" href="<?= url(['/category/index', 'id'=>$model->category->id]) ?>"><span class="grid-desc"><?= isset($model->category) ? $model->category->name:"" ?></span></a>
        </p>

        <div class="content_price">
            <span class="price product-price product-price-new">$<?= $model->price ?></span>
            <?php if(1==2) { ?>
                <span class="old-price product-price">$40.00</span>
                <span class="price-percent-reduction">-10%</span>
            <?php } ?>
        </div>
        <div class="clearfix"></div>
        <div class="color-list-container"></div>
        <div class="product-flags">
        </div>
    </div>
    <div class="functional-buttons clearfix">
        <div class="compare favorite">

            <?php
            $classFav = isset($model->favorite->id) ? 'favorite-active':'';
            ?>

            <a class="btn-favorite <?= $classFav ?>" href="javascript:;" title="add to favorite"></a>
        </div>
    </div>

</div>
<!-- .product-container> -->
