<div class="header-container">
    <header id="header">
        <div class="wrapper header1 wrap1">
            <div class="row full-width">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container">
                    <div class="row menu-bg">
                        <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 ">
                            <div class="module">
                                <!-- Block permanent links module HEADER -->
                                <ul id="header_links">
                                    <li id="header_link_home">
                                        <a href="/" title="Lunalin">home</a>
                                    </li>
                                    <li id="header_link_sitemap">
                                        <a href="sitemap.html" title="sitemap">sitemap</a>
                                    </li>
                                    <li id="header_link_blog">
                                        <a href="smartblog.html">blog</a>
                                    </li>
                                    <li id="header_link_freebies">
                                        <a href="#" title="freebies">freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Block permanent links module HEADER -->
                            <div class="module ">
                                <div id="tmhtmlcontent_top">
                                    <ul class="tmhtmlcontent-top clearfix row">
                                        <li class="tmhtmlcontent-item-1 ">
                                            <div class="item-html">
                                                <ul>
                                                    <li>
                                                        <a href="#" class="fa fa-facebook"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="fa fa-twitter"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="fa fa-pinterest"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="fa fa-instagram"></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="fa fa-linkedin"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 wishlist-button compare-button">
                            <div class="module ">
                                <!-- Block currencies module -->
                                <div id="currencies-block-top">
                                    <form id="setCurrency" action="/" method="post">
                                        <div class="current">
                                            <input type="hidden" name="id_currency" id="id_currency" value="" />
                                            <input type="hidden" name="SubmitCurrency" value="" />
                                            <strong>$</strong>
                                        </div>
                                        <ul id="first-currencies" class="currencies_ul toogle_content">
                                            <li class="selected"><a href="javascript:setCurrency(1);" rel="nofollow" title="Dollar (USD)">$</a></li>
                                            <li><a href="javascript:setCurrency(2);" rel="nofollow" title="Euro (EUR)">€</a></li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <!-- /Block currencies module -->
                            <div class="module ">
                                <!-- Block languages module -->
                                <div id="languages-block-top" class="languages-block">
                                    <div class="current">
                                        <span>en</span>
                                    </div>
                                    <ul id="first-languages" class="languages-block_ul toogle_content">
                                        <li class="selected"><span>en</span></li>
                                        <li>
                                            <a href="#" title="Deutsch (German)" rel="alternate" hreflang="de">
                                                <span>de</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Русский (Russian)" rel="alternate" hreflang="ru">
                                                <span>ru</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Español (Spanish)" rel="alternate" hreflang="es">
                                                <span>es</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Français (French)" rel="alternate" hreflang="fr">
                                                <span>fr</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /Block languages module -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper header1 wrap2">
            <div class="row full-width">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">
                            <div class="module ">
                                        <span class="shop-offer">
                                            <span>OFFER OF THE DAY:</span>
                                            <a href="#">10% OFF</a>
                                            <span>IN THIS STORE</span>
                                        </span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
                            <div id="header_logo">
                                <!-- a href="/" title="Lunalin">
                                    <img class="logo img-responsive" src="/img/logo2.png" alt="Lunalin" width="375" height="109" />
                                </a -->

                                <a href="/" title="Lunalin">
                                    <img class="logo img-responsive" src="/img/logo3.png" alt="Lunalin" width="375" height="109" />
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right">
                            <div class="module ">
                                <!-- MODULE Block cart -->
                                <div class="clearfix blockcart">
                                    <div class="shopping_cart">
                                        <?php
                                        $bascetController = new \frontend\modules\eventOrder\controllers\BasketController("", "");
                                        $data =  $bascetController->actionGet();
                                        ?>

                                        <a class="basket-container" href="<?= \yii\helpers\Url::to(['/order/order/create'])?>" title="View my shopping cart" rel="nofollow">
                                            <span class="ajax_cart_no_product basket_count"><?= $data['count'] ?></span>
                                        </a>

                                        <!-- .cart_block -->
                                    </div>
                                </div>
                                <div id="layer_cart">
                                    <div class="clearfix">
                                        <div class="layer_cart_product col-xs-12">
                                            <span class="cross" title="Close window"></span>
                                            <span class="title"><i class="fa-check"></i>Product successfully added to your shopping cart</span>
                                            <div class="product-image-container layer_cart_img"></div>
                                            <div class="layer_cart_product_info">
                                                <span id="layer_cart_product_title" class="product-name"></span>
                                                <span id="layer_cart_product_attributes"></span>
                                                <div>
                                                    <strong class="dark">Quantity</strong>
                                                    <span id="layer_cart_product_quantity"></span>
                                                </div>
                                                <div>
                                                    <strong class="dark">Total</strong>
                                                    <span id="layer_cart_product_price"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layer_cart_cart col-xs-12">
                                                    <span class="title">
                                                        <!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
                                                        <span class="ajax_cart_product_txt_s  unvisible">There are <span class="ajax_cart_quantity">0</span> items in your cart.</span>
                                                        <!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
                                                        <span class="ajax_cart_product_txt ">There is 1 item in your cart.</span>
                                                    </span>
                                            <div class="layer_cart_row">
                                                <strong class="dark">Total products</strong>
                                                <span class="ajax_block_products_total"></span>
                                            </div>
                                            <div class="layer_cart_row">
                                                <strong class="dark unvisible">Total shipping&nbsp;</strong>
                                                <span class="ajax_cart_shipping_cost unvisible">To be determined</span>
                                            </div>
                                            <div class="layer_cart_row">
                                                <strong class="dark">Total</strong>
                                                <span class="ajax_block_cart_total"></span>
                                            </div>
                                            <div class="button-container">
                                                        <span class="continue btn btn-default btn-base" title="Continue shopping">
                                                            <span>Continue shopping</span>
                                                        </span>
                                                <br />
                                                <a class="btn btn-default btn-base1" href="order-opc.html" title="Proceed to checkout" rel="nofollow">
                                                    <span>Proceed to checkout</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="crossseling"></div>
                                </div>
                                <!-- #layer_cart -->
                                <div class="layer_cart_overlay"></div>
                            </div>
                            <!-- /MODULE Block cart -->
                            <div class="module ">
                                <div id="header-login">
                                    <div class="current header_user_info">

                                        <a href="javascript:;" class="dropdown"><span>Sign in</span></a>

                                    </div>


                                    <ul class="header-login-content toogle_content">

                                        <?php if(\Yii::$app->user->isGuest) { ?>
                                            <?=
                                            $this->render('_login_modal');
                                            ?>
                                        <?php } else { ?>
                                            <li class="logined-content">
                                                <h3>Hi <?= \Yii::$app->user->identity->name ?></h3><hr><br>
                                                <p><a href="<?= \yii\helpers\Url::to(['/user/lk/index']) ?>" class=""><i class="fa fa-user"></i> <span>View profile</span></a></p><br>
                                                <p><a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>" class=""><i class="fa fa-sign-out"></i> <span>logout</span></a></p><br>

                                            </li>
                                        <?php } ?>
                                        <li class="forgot-password-content hidden">
                                            <p>Please enter the email address you used to register. We will then send you a new password.</p>
                                            <form action="/" method="post" class="std">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="alert alert-success" style="display:none;"></div>
                                                        <div class="alert alert-danger" style="display:none;"></div>
                                                        <label for="email-forgot">Email address</label>
                                                        <input class="form-control" type="email" name="email" id="email-forgot" value="" />
                                                    </div>
                                                    <p class="submit">
                                                        <button type="submit" class="btn btn-default btn-md btn-base">
                                                            <span>Retrieve Password</span>
                                                        </button>
                                                    </p>
                                                    <p>
                                                        <a href="#" class="btn btn-primary btn-md signin btn-base1"><span>Sign in</span></a>
                                                    </p>
                                                </fieldset>
                                            </form>
                                        </li>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>


                    <?= \frontend\widgets\TopCategory::widget([
                    ]) ?>


                </div>
            </div>
        </div>
        <div class="wishlist-link">
            <a href="#" title="My wishlists"><span>Wishlist</span></a>
        </div>
        <form method="post" action="#" class="compare-form">
            <button type="submit" class="bt_compare" disabled="disabled">
                <span>YOUR SHOP(<strong class="total-compare-val">0</strong>)</span>
            </button>
            <input type="hidden" name="compare_product_count" class="compare_product_count" value="0" />
            <input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
        </form>
    </header>
</div>
    