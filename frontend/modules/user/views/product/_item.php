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

                            echo '<a class="product_img_link" href="'.\yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]).'" title="'.$model->name.'" itemprop="url">';
                            echo '<img class="img-responsive" src="'.$img.'" alt="'.$model->name.'" title="'.$model->name.'" />';
                            echo '</a>';
                        }
                        else{
                            $img = $cImg->getFile(\Yii::$app->params['nopic'], 300, 421, 'center');

                            echo '<a class="product_img_link" href="'.\yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]).'" title="'.$model->name.'" itemprop="url">';
                            echo '<img class="img-responsive" src="'.$img.'" alt="'.$model->name.'" title="'.$model->name.'" />';
                            echo '</a>';
                        }

                        if(1==2){
                            if(isset($model->pictures[1]))
                            {
                                $item = $model->pictures[1];

                                $cImg = new \common\components\CImage();
                                $img = $cImg->getFile($item->shortPath, 300, 421, 'center');

                                echo '<a class="product_img_link rollover-hover" href="'.\yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]).'" title="'.$model->name.'" itemprop="url">';
                                echo '<img class="img-responsive" src="'.$img.'" alt="'.$model->name.'" title="'.$model->name.'" />';
                                echo '</a>';
                            }
                        }

                        ?>

                    </div>
                </div>
                <a class="sale-box" href="<?= \yii\helpers\Url::to(['/product/item', 'id'=>$model->id])?>">
                    <span class="sale-label">View</span>
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
            <div class="goods-mnu">
                <ul>
                    <li><a href="<?= \yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]) ?>">Edit</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/user/product/copy', 'id'=>$model->id]) ?>">Copy</a></li>
                    <li><a href="#">Renew</a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/user/product/active', 'id'=>$model->id]) ?>"><?= $model->is_active == 1 ? "Deactivate":"Active"?></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/user/product/delete', 'id'=>$model->id]) ?>">Delete</a></li>
                </ul>
            </div>
            <hr>
            <!-- /меню редактирования товара -->
            <!-- блок promote -->
            <div class="goods-promote">
                <p>Promote</p>
                <div class="promote-button">
                    <button id="my-button" type="" class="btn btn-sm btn-base">
                        <span>Improve placement</span>
                    </button>
                    <button id="my-button-banner" type="" class="btn btn-sm btn-default btn-base">
                        <span>Banner advertising</span>
                    </button>
                </div>
            </div>

            <?php if(1==2) { ?>
                <div class="goods-promote">
                    <div class="promote-button">
                        <a class="btn btn-sm btn-base" style="width: 100%" href="<?= \yii\helpers\Url::to(['/user/product/update', 'id'=>$model->id]) ?>">
                            <span>Edit</span>
                        </a>
                        <a href="<?= \yii\helpers\Url::to(['/user/product/delete', 'id'=>$model->id]) ?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post" class="btn btn-sm btn-danger btn-base" style="width: 100%">
                            <span>delete</span>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="functional-buttons clearfix">
            <div class="content_price">
                <span class="price product-price product-price-new">$<?= $model->price ?></span>
            </div>
        </div>
    </div>
</li>