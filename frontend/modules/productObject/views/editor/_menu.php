<?php



?>
<!-- Nav tabs -->
<div class="tab_tools">
    <ul class="nav nav-tabs " role="tablist">
        <li role="presentation" class="active">
            <a href="#j-tools-photo" aria-controls="tools-photos" role="tab" data-toggle="tab">
                <i class="far fa-images"></i>
                <span>Image</span>
            </a>
        </li>
        <li role="presentation">
            <a href="#j-tools-text" aria-controls="tools-text" role="tab" data-toggle="tab">
                <i class="fas fa-font"></i>
                <span>text</span>
            </a>
        </li>
        <li role="presentation">
            <a href="#j-tools-bckgrnd" aria-controls="bckgrnd" role="tab" data-toggle="tab">
                <i class="fas fa-chess-board"></i>
                <span>bckgrnd</span>
            </a>
        </li>
        <li role="presentation">
            <a href="#j-tools-backside" aria-controls="backside" role="tab" data-toggle="tab">
                <i class="far fa-clone"></i>
                <span>backside</span>
            </a>
        </li>
        <li role="presentation">
            <a href="#j-tools-envelope" aria-controls="envelope" role="tab" data-toggle="tab">
                <i class="far fa-envelope-open"></i>
                <span>envelope</span>
            </a>
        </li>
        <li role="presentation">
            <a href="#j-tools-rsvp" aria-controls="RSVP" role="tab" data-toggle="tab">
                <i class="far fa-address-card"></i>
                <span>RSVP</span>
            </a>
        </li>

        <li role="presentation">
            <?php if($model->product_object_type == \common\models\ProductObject\ProductObjectPage::PRODUCT_OBJECT_USER_TYPE) { ?>
                <a class="j-order" href="Javascript:;">
                    <i class=""></i>
                    <span>Order</span>
                </a>
            <?php } else {?>
                <a href="<?= \yii\helpers\Url::to(['/user/product/index']) ?>">
                    <i class=""></i>
                    <span>Save</span>
                </a>
            <?php }?>
        </li>
    </ul>
</div>