<tr class="first_item ">
    <td class="history_link bold footable-first-column">

        <?php
        $cImg = new \common\components\CImage();
        $img = $cImg->getFile($model->product->firstPictureShortPath, 84, 120, 'center');
        ?>

        <a href="<?= \yii\helpers\Url::to(['/product/item', 'id'=>$model->product->id]) ?>">
            <img src="<?= $img ?>" alt="">
        </a>
        <p class="orders-product-name product-name">
            <a href="<?= \yii\helpers\Url::to(['/product/item', 'id'=>$model->product->id]) ?>"><?= $model->product->name ?></a>
        </p>

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
        <a class="btn btn-default btn-sm btn-base-min" href="<?= \yii\helpers\Url::to(['/order/order/pdf', 'id'=>$model->id]) ?>" title="Details">
            <span>Download pdf</span>
        </a>
    </td>
</tr>