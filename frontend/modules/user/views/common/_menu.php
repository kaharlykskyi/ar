<?php

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\User;

?>


<h3><i class="fa fa-user" aria-hidden="true"></i> My Account</h3>
<div class="block_content list-block">
    <ul>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/lk/profile']) ?>">Edit your account information</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/lk/change-pass']) ?>">Change your password</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/lk/address-book']) ?>">The address book</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/favorite/index']) ?>">My favorites</a>
        </li>
        <li>
            <a href="#">Finances</a>
        </li>
    </ul>
</div>





<h3><i class="fa fa-calendar-o" aria-hidden="true"></i> My Orders</h3>
<div class="block_content list-block">
    <ul>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/order/order/index']) ?>">View your order history</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/event-order/event/index']) ?>">View your event history</a>
        </li>
        <li>
            <a href="#">Your Transactions</a>
        </li>
    </ul>
</div>


<h3><i class="fa fa-shopping-basket" aria-hidden="true"></i> My Shop</h3>
<div class="block_content list-block">
    <ul>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/shop/update']) ?>">Edit shop</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/shipping/index']) ?>">Shipping cost</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/product/index']) ?>">My Goods</a>
        </li>
        <li>
            <a href="<?= \yii\helpers\Url::to(['/user/cards/index']) ?>">Cards</a>
        </li>
    </ul>
</div>


