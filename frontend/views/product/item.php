<?php

$cImg = new \common\components\CImage();

?>
<div class="container">
    <div class="row">
        <div class="large-left col-sm-12">
            <div class="row">
                <div id="center_column" class="center_column col-xs-12 col-sm-12">
                    <!--Replaced theme 1 -->
                    <div itemscope itemtype="#">
                        <meta itemprop="url" content="#">
                        <div class="primary_block row">
                            <!-- left infos-->
                            <div class="pb-left-column col-sm-4 col-md-4 col-lg-4">
                                <!-- product img-->
                                <div id="image-block" class="clearfix is_caroucel">
                                    <span class="sale-box no-print">
                                        <span class="sale-label">Sale!</span>
                                    </span>
                                    <span id="view_full_size">

                                        <?php
                                        if(isset($model->pictures[0]))
                                            $img = $cImg->getFile($model->pictures[0]->shortPath, 600, 800, 'center');
                                        else
                                            $img = $cImg->getFile(\Yii::$app->params['nopic'], 600, 800, 'center');
                                        ?>
                                        <a class="jqzoom" title="<?= $model->name ?>" rel="gal1" href="<?= $img ?>">
                                            <img itemprop="image" src="<?= $img ?>" title="<?= $model->name ?>" alt="<?= $model->name ?>" />
                                        </a>
                                    </span>
                                </div>
                                <!-- end image-block -->
                                <!-- thumbnails -->
                                <div id="views_block" class="clearfix">
                                    <a id="view_scroll_left" class="" title="Other views" href="javascript:{}">Previous</a>
                                    <div id="thumbs_list">
                                        <ul id="thumbs_list_frame">
                                            <?php  foreach ($model->pictures as $item) { ?>
                                                <?php
                                                $img = $cImg->getFile($item->shortPath, 150, 200, 'center');
                                                $imgMedium = $cImg->getFile($item->shortPath, 600, 800, 'center');
                                                $imgLarg = $cImg->getFile($item->shortPath, 600, 800, 'center');
                                                ?>
                                                <li id="thumbnail_24">
                                                    <a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?= $imgMedium ?>',largeimage: '<?= $imgLarg ?>'}" title="<?= $model->name ?>">
                                                        <img class="img-responsive" id="thumb_24" src="<?= $img ?>" title="<?= $model->name ?>" alt="<?= $model->name ?>" height="80" width="80" itemprop="image" />
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- end thumbs_list -->
                                    <a id="view_scroll_right" title="Other views" href="javascript:{}">Next</a>
                                </div>
                                <!-- end views-block -->
                                <!-- end thumbnails -->
                                <p class="resetimg clear no-print">
                                                    <span id="wrapResetImages" style="display: none;">
                                                        <a href="#" data-id="resetImages">
                                                            <i class="fa fa-repeat"></i>Display all pictures
                                                        </a>
                                                    </span>
                                </p>
                            </div>
                            <!-- center infos -->
                            <div class="pb-right-column col-sm-4 col-md-4 col-lg-4">
                                <p class="warning_inline" id="last_quantities" style="display: none">Warning: Last items in stock!</p>
                                <p id="availability_date" style="display: none;">
                                    <span id="availability_date_label">Availability date:</span>
                                    <span id="availability_date_value"></span>
                                </p>
                                <!-- Out of stock hook -->
                                <div id="oosHook" style="display: none;">
                                </div>
                                <h1 itemprop="name">Acqua di Gio by Giorgio Armani</h1>
                            </div>
                            <!-- end center infos-->
                            <div class="pb-right-column-second col-sm-4 col-md-4 col-lg-4">
                                <!-- add to cart form-->
                                <form id="buy_block" action="" method="post">
                                    <!-- hidden datas -->
                                    <p class="hidden">
                                        <input type="hidden" name="token" value="" />
                                        <input type="hidden" name="id_product" value="8" id="product_page_product_id" />
                                        <input type="hidden" name="add" value="1" />
                                        <input type="hidden" name="id_product_attribute" id="idCombination" value="" />
                                    </p>
                                    <div class="box-info-product">
                                        <div class="content_prices clearfix">
                                            <!-- prices -->
                                            <div class="all-price-info">
                                                <p class="our_price_display" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                                    <link itemprop="availability" href="https://schema.org/InStock" /><span id="our_price_display" itemprop="price" content="36">$36.00</span>
                                                    <meta itemprop="priceCurrency" content="USD" /> </p>
                                                <p id="old_price"><span id="old_price_display"><span class="price">$40.00</span></span>
                                                </p>
                                                <p id="reduction_percent"><span id="reduction_percent_display">-10%</span></p>
                                                <p id="reduction_amount" style="display:none"><span id="reduction_amount_display"></span></p>
                                            </div>
                                            <!-- end prices -->
                                            <div class="clear"></div>
                                        </div>
                                        <!-- end content_prices -->
                                        <div class="product_attributes clearfix">
                                            <!-- attributes -->
                                            <div id="attributes">
                                                <div class="clearfix"></div>
                                                <fieldset class="attribute_fieldset">
                                                    <label class="attribute_label" for="group_4">Options</label>
                                                    <div class="attribute_list">
                                                        <select name="group_4" id="group_4" class="form-control attribute_select no-print">
                                                            <option value="26" selected="selected" title="50 ml">50 ml</option>
                                                            <option value="27" title="100 ml">100 ml</option>
                                                        </select>
                                                    </div>
                                                    <!-- end attribute_list -->
                                                </fieldset>
                                                <fieldset class="attribute_fieldset">
                                                    <label class="attribute_label">Shipping price</label>
                                                    <div class="attribute_list">
                                                        <ul>
                                                            <li>
                                                                <input type="radio" class="attribute_radio" name="group_5" value="29" checked="checked" />
                                                                <label>Europe</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" class="attribute_radio" name="group_5" value="30" />
                                                                <label>North America</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" class="attribute_radio" name="group_5" value="31" />
                                                                <label>Asia</label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" class="attribute_radio" name="group_5" value="32" />
                                                                <label>South America</label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- end attribute_list -->
                                                </fieldset>
                                            </div>
                                            <!-- end attributes -->
                                            <div class="clearfix">
                                                <!-- quantity wanted -->
                                                <p id="quantity_wanted_p">
                                                    <label for="quantity_wanted">Quantity</label>
                                                    <a href="#" data-field-qty="qty" class="btn btn-default button-minus product_quantity_down">
                                                        <span><i class="fa fa-minus"></i></span>
                                                    </a>
                                                    <input type="text" min="1" name="qty" id="quantity_wanted" class="text" value="1" />
                                                    <a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up">
                                                        <span><i class="fa fa-plus"></i></span>
                                                    </a>
                                                    <span class="clearfix"></span>
                                                </p>
                                                <div id="add_to_cart_product_page_button">
                                                    <p id="add_to_cart" class="buttons_bottom_block no-print">
                                                        <a href="<?= \yii\helpers\Url::to(['/product-object/editor/use', 'product_id'=>$model->id]) ?>" class="btn btn-sm btn-default btn-base1 ajax_add_to_cart_product_button">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- minimal quantity wanted -->
                                            <p id="minimal_quantity_wanted_p" style="display: none;">
                                                The minimum purchase order quantity for the product is
                                                <b id="minimal_quantity_label">1</b>
                                            </p>
                                        </div>
                                        <!-- end product_attributes -->
                                        <div class="box-cart-bottom">
                                        </div>
                                        <!-- end box-cart-bottom -->
                                    </div>
                                    <!-- end box-info-product -->
                                </form>
                                <!-- social -->
                                <div class="extra-right">
                                    <p class="socialsharing_product no-print">
                                        <button data-type="twitter" type="button" class="btn btn-twitter social-sharing">
                                            <i class="fa fa-twitter"></i>
                                        </button>
                                        <button data-type="facebook" type="button" class="btn btn-facebook social-sharing">
                                            <i class="fa fa-facebook"></i>
                                        </button>
                                        <button data-type="google-plus" type="button" class="btn btn-google-plus social-sharing">
                                            <i class="fa fa-google-plus"></i>
                                        </button>
                                        <button data-type="pinterest" type="button" class="btn btn-pinterest social-sharing">
                                            <i class="fa fa-pinterest"></i>
                                        </button>
                                    </p>
                                </div>
                                <div class="shop-group">
                                    <a href="#">
                                        <p>NAME OF THE SHOP</p>
                                    </a>
                                    <a href="#">
                                        <span class="favorite-item"><i class="fa fa-heart" aria-hidden="true"></i> Favorite</span>
                                    </a>
                                </div>
                                <!-- end social -->
                            </div>
                            <!-- end center infos-->
                        </div>

                        <?php if(1==2) { ?>
                            <!-- end primary_block -->
                            <div class="clearfix product-information">
                                <ul class="product-info-tabs nav nav-stacked col-sm-12 col-md-12 col-lg-8">
                                    <li class="product-description-tab"><a data-toggle="tab" href="#product-description-tab-content">More info</a></li>
                                    <li class="product-customizable-tab"><a data-toggle="tab" href="#product-customizable-tab-content">Request the custom order</a></li>
                                    <li class="product-description-tab"><a data-toggle="tab" href="#product-policies-tab-content">Shipping &amp; Store Policies</a></li>
                                    <li class="product-description-tab"><a data-toggle="tab" href="#product-payment-tab-content">Payment &amp; Refunds</a></li>
                                    <li class="product-description-tab"><a data-toggle="tab" href="#product-feedback-tab-content">Feedback</a></li>
                                    <li class="product-video-tab">
                                        <a href="#product-video-tab-content" data-toggle="tab">Video</a>
                                    </li>
                                </ul>
                                <div class="tab-content col-sm-12 col-md-12 col-lg-8">
                                    <h3 class="page-product-heading">More info</h3>
                                    <div id="product-description-tab-content" class="product-description-tab-content tab-pane">
                                        <div class="rte">
                                            <p>Traditions are the cornerstone of our noble business and we know how to observe them. Being one of the leading perfume manufacturers, our company has priceless experience in creating new scents and successful brands. We are glad to welcome you at our first online store for real perfume connoisseurs.</p>
                                            <p>If you want to sell perfumes you should know that nice fragrance is not enough for success. You must tell original story that will give your perfumes enough charm to attract customers. So we are here to tell you many interesting stories with charming aroma.  </p>
                                            <p>We are here to open you the absolutely new world – a world full of sensuality, passion and positive emotions. Go ahead and pick one and you’ll see how it could change your life. Write your own story with our perfumes! Satisfied clients and perfect customer service are our main rules, so leave your hesitations behind and let’s start shopping!  </p>
                                        </div>
                                    </div>
                                    <!-- quantity discount -->
                                    <!--Customization -->
                                    <h3 class="page-product-heading">Request the custom order</h3>
                                    <div id="product-customizable-tab-content" class="product-customizable-tab-content tab-pane">
                                        <form method="post" action="" enctype="multipart/form-data" id="customizationForm" class="clearfix">
                                            <p class="infoCustomizable">
                                                After saving your customized product, remember to add it to your cart.
                                                <br /> Allowed file formats are: GIF, JPG, PNG </p>
                                            <div class="customizableProductsFile">
                                                <h5 class="product-heading-h5">Pictures</h5>
                                                <ul id="uploadable_files" class="clearfix">
                                                    <li class="customizationUploadLine required">
                                                        <div class="customizationUploadBrowse form-group">
                                                            <label class="customizationUploadBrowseDescription">
                                                                Please select an image file from your computer
                                                                <sup>*</sup> </label>
                                                            <input type="file" name="file1" id="img0" class="form-control customization_block_input " />
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="customizableProductsText">
                                                <h5 class="product-heading-h5">Text</h5>
                                                <ul id="text_fields">
                                                    <li class="customizationUploadLine required">
                                                        <label for="textField0">
                                                            <sup>*</sup> </label>
                                                        <textarea name="textField2" class="form-control customization_block_input" id="textField0" rows="3" cols="20">Text description</textarea>
                                                    </li>
                                                </ul>
                                            </div>
                                            <p id="customizedDatas">
                                                <input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
                                                <input type="hidden" name="submitCustomizedDatas" value="1" />
                                                <button class="btn btn-default btn-sm btn-base-min" name="saveCustomization">
                                                    <span>Save</span>
                                                </button>
                                                <span id="ajax-loader" class="unvisible"><img src="img/loader.gif" alt="loader" /></span>
                                            </p>
                                            <span class="required"><sup>*</sup> required fields</span>
                                        </form>
                                    </div>
                                    <!--end Customization -->
                                    <!-- regulations -->
                                    <h3 class="page-product-heading">Shipping &amp; Store Policies</h3>
                                    <div id="product-policies-tab-content" class="product-description-tab-content tab-pane">
                                        <div class="rte">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus veritatis perferendis, enim ipsum similique fugit nihil expedita, iste, consectetur fugiat aspernatur sequi dolore blanditiis dolorem, eum magni quam. Incidunt, asperiores?</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus veritatis perferendis, enim ipsum similique fugit nihil expedita, iste, consectetur fugiat aspernatur sequi dolore blanditiis dolorem, eum magni quam. Incidunt, asperiores?</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus veritatis perferendis, enim ipsum similique fugit nihil expedita, iste, consectetur fugiat aspernatur sequi dolore blanditiis dolorem, eum magni quam. Incidunt, asperiores?</p>
                                        </div>
                                    </div>
                                    <h3 class="page-product-heading">Payment &amp; Refunds</h3>
                                    <div id="product-payment-tab-content" class="product-description-tab-content tab-pane">
                                        <div class="rte">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus veritatis perferendis, enim ipsum similique fugit nihil expedita, iste, consectetur fugiat aspernatur sequi dolore blanditiis dolorem, eum magni quam. Incidunt, asperiores?</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus veritatis perferendis, enim ipsum similique fugit nihil expedita, iste, consectetur fugiat aspernatur sequi dolore blanditiis dolorem, eum magni quam. Incidunt, asperiores?</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus veritatis perferendis, enim ipsum similique fugit nihil expedita, iste, consectetur fugiat aspernatur sequi dolore blanditiis dolorem, eum magni quam. Incidunt, asperiores?</p>
                                        </div>
                                    </div>
                                    <!-- feedback -->
                                    <h3 class="page-product-heading">Feedback</h3>
                                    <div id="product-feedback-tab-content" class="product-description-tab-content tab-pane">
                                        <div class="rte">
                                            <div class="quote col-sm-12">
                                                <div class="col-sm-2 user-wrap">
                                                    <div class="avatar-wrap">
                                                        <img src="img/cms/user-amy-garza-70x70.jpg" width="70" height="70" alt="">
                                                    </div>
                                                    <div class="avatar-wrap">
                                                        <h6><a href="#">Amy Garza</a></h6>
                                                        <p>Manager, New York</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10 rating-wrap">
                                                    <div class="rating-time">
                                                        <span style="width: 110px;"></span>
                                                        <time>16.07.2017</time>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel voluptatibus numquam voluptas doloremque eaque voluptatem iure velit? Sit distinctio error fugiat, vel blanditiis deleniti ipsam ex odio veniam atque sint!</p>
                                                </div>
                                            </div>
                                            <div class="quote col-sm-12">
                                                <div class="col-sm-2 user-wrap">
                                                    <div class="avatar-wrap">
                                                        <img src="img/cms/user-ronald-hall-70x70.jpg" width="70" height="70" alt="">
                                                    </div>
                                                    <div class="avatar-wrap">
                                                        <h6><a href="#">Ronald Hall</a></h6>
                                                        <p>Web Developer, Chicago</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10 rating-wrap">
                                                    <div class="rating-time">
                                                        <span style="width: 110px;"></span>
                                                        <time>16.07.2017</time>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel voluptatibus numquam voluptas doloremque eaque voluptatem iure velit? Sit distinctio error fugiat, vel blanditiis deleniti ipsam ex odio veniam atque sint!</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end feedback -->
                                    <!-- end regulations -->
                                    <div id="product-video-tab-content" class="product-video-tab-content tab-pane">
                                        <div class="videowrapper">
                                            <iframe src="https://www.youtube.com/embed/9ruZdfWNb94?enablejsapi=1&version=3&html5=1&wmode=transparent&controls=1&autoplay=&autohide=&disablekb=&fs=1&iv_load_policy=3&loop=&showinfo=1&theme=dark" frameborder="0" wmode="Opaque">
                                            </iframe>
                                        </div>
                                        <h4 class="video-name">Gucci Guilty</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- description & features -->
                            <!--Accessories -->
                            <section class="page-product-box">
                                <h3 class="page-product-heading">Accessories</h3>
                                <div class="block products_block accessories-block clearfix">
                                    <div class="block_content">
                                        <ul id="bxslider" class="bxslider clearfix">
                                            <li class="item product-box ajax_block_product first_item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="Cool-Water-By-Davidoff-For-Men.-Mild-Deodorant-Spray" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/5/4/54-tm_home_default.jpg" alt="Cool-Water-By-Davidoff-For-Men.-Mild-Deodorant-Spray" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="Cool Water By Davidoff For Men. Mild Deodorant Spray" href="#">Cool Water By Davidoff...</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$20.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="12" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item product-box ajax_block_product item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="Cool-Water-Game-By-Davidoff-For-Women" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/6/0/60-tm_home_default.jpg" alt="Cool-Water-Game-By-Davidoff-For-Women" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="Cool Water Game By Davidoff For Women" href="#">Cool Water Game By Dav...</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$35.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="13" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item product-box ajax_block_product item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="DAVIDOFF-Women&#039;s-Cool-Water-Eau-de-Toilette-Spray" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/6/6/66-tm_home_default.jpg" alt="DAVIDOFF-Women&#039;s-Cool-Water-Eau-de-Toilette-Spray" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="DAVIDOFF Women&#039;s Cool Water Eau de Toilette Spray" href="#">DAVIDOFF Women&#039;s Cool ...</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$20.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="14" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item product-box ajax_block_product item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="Echo-Woman-By-Davidoff-For-Women.-Eau-De-Parfum-Spray" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/7/2/72-tm_home_default.jpg" alt="Echo-Woman-By-Davidoff-For-Women.-Eau-De-Parfum-Spray" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="Echo Woman By Davidoff For Women. Eau De Parfum Spray" href="#">Echo Woman By Davidoff...</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$19.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="15" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item product-box ajax_block_product item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="Fendi-L`Acquarossa" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/7/8/78-tm_home_default.jpg" alt="Fendi-L`Acquarossa" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="Fendi L`Acquarossa" href="#">Fendi L`Acquarossa</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$48.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="16" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item product-box ajax_block_product item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="Happy-By-Clinique-For-Men.-Cologne-Spray" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/8/4/84-tm_home_default.jpg" alt="Happy-By-Clinique-For-Men.-Cologne-Spray" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="Happy By Clinique For Men. Cologne Spray" href="#">Happy By Clinique For ...</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$40.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="17" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item product-box ajax_block_product last_item product_accessories_description">
                                                <div class="product_desc">
                                                    <a href="#" title="Jean-Paul-Gaultier-Le-Male-By-Jean-Paul-Gaultier" class="product-image product_image">
                                                        <img class="lazyOwl" src="img/p/9/0/90-tm_home_default.jpg" alt="Jean-Paul-Gaultier-Le-Male-By-Jean-Paul-Gaultier" width="500" height="500" />
                                                    </a>
                                                    <div class="block_description">
                                                        <a href="#" title="More" class="product_description">Traditions are the...</a>
                                                    </div>
                                                </div>
                                                <div class="s_title_block">
                                                    <h5 class="product-name">
                                                        <a title="Jean Paul Gaultier Le Male By Jean Paul Gaultier" href="#">Jean Paul Gaultier Le ...</a>
                                                    </h5>
                                                </div>
                                                <p class="price_display">
                                                    <span class="price">$32.00</span>
                                                </p>
                                                <div class="clearfix">
                                                    <div class="no-print">
                                                        <a class="btn btn-default btn-xs ajax_add_to_cart_button" href="#" data-id-product="18" title="Add to cart">
                                                            <span>Add to cart</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <!--end Accessories -->
                            <section class="page-product-box blockproductscategory">
                                <h3 class="productscategory_h3 page-product-heading">19 other products in the same category:</h3>
                                <div id="productscategory_list" class="clearfix">
                                    <ul id="bxslider1" class="bxslider clearfix">
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Bvlgari Aqva Amara Eau de Toilette Spray">
                                                <img src="img/p/3/1/31-tm_home_default.jpg" alt="Bvlgari Aqva Amara Eau de Toilette Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Bvlgari Aqva Amara Eau de Toilette Spray">Bvlgari Aqva Amara Eau...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$40.00</span>
                                                <span class="price-percent-reduction small">-20%</span>
                                                <span class="old-price">$50.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Bvlgari Aqva Marine Pour Homme by Bvlgari">
                                                <img src="img/p/4/2/42-tm_home_default.jpg" alt="Bvlgari Aqva Marine Pour Homme by Bvlgari" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Bvlgari Aqva Marine Pour Homme by Bvlgari">Bvlgari Aqva Marine...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$36.00</span>
                                                <span class="price-percent-reduction small">-20%</span>
                                                <span class="old-price">$45.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="10" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Calvin Klein euphoria Eau de Parfum">
                                                <img src="img/p/4/8/48-tm_home_default.jpg" alt="Calvin Klein euphoria Eau de Parfum" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Calvin Klein euphoria Eau de Parfum">Calvin Klein euphoria...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$81.00</span>
                                                <span class="price-percent-reduction small">-10%</span>
                                                <span class="old-price">$90.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="11" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Cool Water By Davidoff For Men. Mild Deodorant Spray">
                                                <img src="img/p/5/4/54-tm_home_default.jpg" alt="Cool Water By Davidoff For Men. Mild Deodorant Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Cool Water By Davidoff For Men. Mild Deodorant Spray">Cool Water By Davidoff...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$20.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="12" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Cool Water Game By Davidoff For Women">
                                                <img src="img/p/6/0/60-tm_home_default.jpg" alt="Cool Water Game By Davidoff For Women" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Cool Water Game By Davidoff For Women">Cool Water Game By...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$35.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="13" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="DAVIDOFF Women's Cool Water Eau de Toilette Spray">
                                                <img src="img/p/6/6/66-tm_home_default.jpg" alt="DAVIDOFF Women's Cool Water Eau de Toilette Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="DAVIDOFF Women's Cool Water Eau de Toilette Spray">DAVIDOFF Women&#039;s Cool...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$20.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="14" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Echo Woman By Davidoff For Women. Eau De Parfum Spray">
                                                <img src="img/p/7/2/72-tm_home_default.jpg" alt="Echo Woman By Davidoff For Women. Eau De Parfum Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Echo Woman By Davidoff For Women. Eau De Parfum Spray">Echo Woman By Davidoff...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$19.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="15" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Fendi L`Acquarossa">
                                                <img src="img/p/7/8/78-tm_home_default.jpg" alt="Fendi L`Acquarossa" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Fendi L`Acquarossa">Fendi L`Acquarossa</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$48.00</span>
                                                <span class="price-percent-reduction small">-20%</span>
                                                <span class="old-price">$60.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="16" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Happy By Clinique For Men. Cologne Spray">
                                                <img src="img/p/8/4/84-tm_home_default.jpg" alt="Happy By Clinique For Men. Cologne Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Happy By Clinique For Men. Cologne Spray">Happy By Clinique For...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$40.00</span>
                                                <span class="price-percent-reduction small">-20%</span>
                                                <span class="old-price">$50.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="17" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Jean Paul Gaultier Le Male By Jean Paul Gaultier">
                                                <img src="img/p/9/0/90-tm_home_default.jpg" alt="Jean Paul Gaultier Le Male By Jean Paul Gaultier" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Jean Paul Gaultier Le Male By Jean Paul Gaultier">Jean Paul Gaultier Le...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$32.00</span>
                                                <span class="price-percent-reduction small">-20%</span>
                                                <span class="old-price">$40.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="18" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Kenzo Amour By Kenzo For Women Eau De Parfum Spray">
                                                <img src="img/p/9/6/96-tm_home_default.jpg" alt="Kenzo Amour By Kenzo For Women Eau De Parfum Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Kenzo Amour By Kenzo For Women Eau De Parfum Spray">Kenzo Amour By Kenzo...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price special-price">$38.40</span>
                                                <span class="price-percent-reduction small">-20%</span>
                                                <span class="old-price">$48.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="19" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Kenzo Flower By Kenzo For Women. Eau De Parfum Spray">
                                                <img src="img/p/1/0/2/102-tm_home_default.jpg" alt="Kenzo Flower By Kenzo For Women. Eau De Parfum Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Kenzo Flower By Kenzo For Women. Eau De Parfum Spray">Kenzo Flower By Kenzo...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$70.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="20" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="LANVIN women ECLAT D'ARPEGE">
                                                <img src="img/p/1/0/8/108-tm_home_default.jpg" alt="LANVIN women ECLAT D'ARPEGE" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="LANVIN women ECLAT D'ARPEGE">LANVIN women ECLAT...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$30.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="21" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Nina By Nina Ricci For Women. Eau De Toilette Spray">
                                                <img src="img/p/1/1/4/114-tm_home_default.jpg" alt="Nina By Nina Ricci For Women. Eau De Toilette Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Nina By Nina Ricci For Women. Eau De Toilette Spray">Nina By Nina Ricci For...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$44.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="22" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="NINA RICCI FAROUCHE LALIQUE PERFUME">
                                                <img src="img/p/1/2/0/120-tm_home_default.jpg" alt="NINA RICCI FAROUCHE LALIQUE PERFUME" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="NINA RICCI FAROUCHE LALIQUE PERFUME">NINA RICCI FAROUCHE...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$130.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="23" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Versace Eros Eau de Toilette 100">
                                                <img src="img/p/1/2/6/126-tm_home_default.jpg" alt="Versace Eros Eau de Toilette 100" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Versace Eros Eau de Toilette 100">Versace Eros Eau de...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$60.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="24" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Versace Man Eau Fraiche By Gianni Versace For Men Edt Spray">
                                                <img src="img/p/1/3/2/132-tm_home_default.jpg" alt="Versace Man Eau Fraiche By Gianni Versace For Men Edt Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Versace Man Eau Fraiche By Gianni Versace For Men Edt Spray">Versace Man Eau...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$35.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="25" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Vince Camuto Eau De Parfume Spray for Women">
                                                <img src="img/p/1/3/8/138-tm_home_default.jpg" alt="Vince Camuto Eau De Parfume Spray for Women" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Vince Camuto Eau De Parfume Spray for Women">Vince Camuto Eau De...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$40.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="26" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="product-box item">
                                            <a href="#" class="lnk_img product-image" title="Zino Davidoff Hot Water By Zino Davidoff For Men Eau De Toilette Spray">
                                                <img src="img/p/1/4/0/140-tm_home_default.jpg" alt="Zino Davidoff Hot Water By Zino Davidoff For Men Eau De Toilette Spray" />
                                            </a>
                                            <h5 itemprop="name" class="product-name">
                                                <a href="#" title="Zino Davidoff Hot Water By Zino Davidoff For Men Eau De Toilette Spray">Zino Davidoff Hot...</a>
                                            </h5>
                                            <p class="price_display">
                                                <span class="price">$10.00</span>
                                            </p>
                                            <div class="clearfix" style="margin-top:5px">
                                                <div class="no-print">
                                                    <a class="btn btn-default ajax_add_to_cart_button btn-xs" href="#" data-id-product="27" title="Add to cart">
                                                        <span>Add to cart</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        <?php } ?>



                    </div>
                    <!-- itemscope product wrapper -->
                </div>
                <!-- #center_column -->
            </div>
            <!--.large-left-->
        </div>
        <!--.row-->
    </div>
    <!-- .row -->
</div>
<!-- .container -->