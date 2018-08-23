

    

        <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['tag' => 'li', 'class'=>'ajax_block_product col-xs-6 col-sm-6 col-md-4 first-in-line first-item-of-tablet-line first-item-of-mobile-line'],
            /*'itemOptions' => ['class' => $class],*/
            'itemView' => '_item',
            'options' => ['tag' => 'ul', 'class' => 'product_list grid row', 'id' => 'feed-list'],
            /*'options' => ['class' => '', 'id' => 'product-list', 'style'=>''],*/
            'viewParams'=> [
                'searchmodel'=>$model,
            ],
            'pager' => [
                'maxButtonCount'=>5,
            ],
            'layout' => "{items}\n<div class='clearfix'></div>{pager}"
        ])
        ?>

    <?php if(1==2) { ?>
    <div class="content_sortPagiBar pagiBarBottom">
        <div class="bottom-pagination-content clearfix">
            <!-- Pagination -->
            <div id="pagination_bottom" class="pagination clearfix">

    <?php } ?>


<?php /* \frontend\widgets\CompatibleProducts::widget([
    'prod_attr_width_id'=>$model->prod_attr_width_id,
    'prod_attr_height_id'=>$model->prod_attr_height_id,
]) */?>
