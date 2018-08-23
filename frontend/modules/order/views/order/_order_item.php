<tr class="first_item ">
    <td class="history_link bold footable-first-column">

        <?php foreach ($model->orderProduct as $item) { ?>
            <div>
                <?php
                $cImg = new \common\components\CImage();
                $img = $cImg->getFile($item->product->firstPictureShortPath, 84, 120, 'center');
                ?>

                <a href="<?= \yii\helpers\Url::to(['/product/item', 'id'=>$item->product->id]) ?>">
                    <img src="<?= $img ?>" alt="">
                </a>
                <p class="orders-product-name product-name">
                    <a href="<?= \yii\helpers\Url::to(['/product/item', 'id'=>$item->product->id]) ?>"><?= $item->product->name ?></a>
                </p>
            </div>
        <?php } ?>
    </td>
    <td data-value="20170813043059" class="history_date bold">
        <?= date('d.m.Y', $model->created_at); ?>
    </td>
    <td class="history_price" data-value="86.320000">
        <span class="price">$<?= $model->total; ?></span>
    </td>
    <td class="history_invoice">
        <span class="footable-toggle"></span>
        <a class="color-myaccount" href="#" title="GHLDBXVJY">GHLDBXVJY</a>
    </td>
    <td class="history_detail footable-last-column">
        <a class="btn btn-default btn-sm btn-base-min" href="<?= \yii\helpers\Url::to(['/order/order/details', 'id'=>$model->id]) ?>" title="Details">
            <span>Details</span>
        </a>
    </td>
</tr>