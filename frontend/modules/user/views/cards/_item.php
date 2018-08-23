<?php


$cImg = new \common\components\CImage();

?>
<li class="ajax_block_product col-xs-6 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line <?= $model->is_active == 1 ? "":"deactive"?>">
    <div class="product-container" itemscope itemtype="https://schema.org/Product">
        <div class="left-block">
            <div class="product-image-container">
                <div class="tmproductlistgallery rollover">
                    <div class="tmproductlistgallery-images">

                        <?php
                        if(isset($model->pictures[0]))
                        {
                            $item = $model->pictures[0];

                            $cImg = new \common\components\CImage();
                            $img = $cImg->getFile($item->shortPath, 300, 421, 'center');

                            echo '<a class="product_img_link cover-image" href="'.\yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]).'" title="'.$model->name.'" itemprop="url">';
                            echo '<img class="img-responsive" src="'.$img.'" alt="'.$model->name.'" title="'.$model->name.'" />';
                            echo '</a>';
                        }
                        else{
                            $img = $cImg->getFile(\Yii::$app->params['nopic'], 300, 421, 'center');

                            echo '<a class="product_img_link cover-image" href="'.\yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]).'" title="'.$model->name.'" itemprop="url">';
                            echo '<img class="img-responsive" src="'.$img.'" alt="'.$model->name.'" title="'.$model->name.'" />';
                            echo '</a>';
                        }

                        if(isset($model->pictures[1]))
                        {
                            $item = $model->pictures[1];

                            $cImg = new \common\components\CImage();
                            $img = $cImg->getFile($item->shortPath, 300, 421, 'center');

                            echo '<a class="product_img_link rollover-hover" href="'.\yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]).'" title="'.$model->name.'" itemprop="url">';
                            echo '<img class="img-responsive" src="'.$img.'" alt="'.$model->name.'" title="'.$model->name.'" />';
                            echo '</a>';
                        }
                        ?>

                    </div>
                </div>
                <a class="sale-box" href="<?= \yii\helpers\Url::to(['/product-object/editor/use', 'product_id'=>$model->id])?>">
                    <span class="sale-label">Edit card</span>
                </a>
            </div>
        </div>
        <div class="right-block">
            <h5 itemprop="name">
                <a class="product-name" href="#" title="<?= $model->name ?>" itemprop="url" >
                    <span class="grid-name"><?= $model->name; ?></span>
                    <span class="grid-name"><?= isset($model->category) ? $model->category->name:"" ?></span>
                </a>
            </h5>
            <!-- меню редактирования товара -->


            <!-- /меню редактирования товара -->
            <!-- блок promote -->
            
        </div>
        <div class="functional-buttons clearfix">
            <div class="content_price">
                <span class="price product-price product-price-new">$<?= $model->price ?></span>
            </div>
        </div>
    </div>
</li>