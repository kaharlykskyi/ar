<?php
\Yii::$app->params['assestEventOrder'] = \frontend\modules\eventOrder\assets\EventOrderAsset::register($this);
?>


<?= $this->render('../common/_header') ?>


<div class="row">
    <div class="large-left col-sm-12">
        <div class="row">
            <div id="center_column" class="center_column col-xs-12 col-sm-12">
                <h1 class="page-heading bottom-indent">Order history</h1>
                <p class="info-title">Here are the orders you&#039;ve placed since your account was created.</p>

                <div class="block-center" id="block-history">

                    <table id="order-list" class="table table-bordered footab default footable-loaded footable">
                        <thead>
                        <tr>
                            <th class="first_item footable-first-column" data-sort-ignore="true">Product name</th>
                            <th class="item footable-sortable">Date<span class="footable-sort-indicator"></span></th>
                            <th data-hide="phone" class="item footable-sortable">Total price<span class="footable-sort-indicator"></span></th>
                            <th data-sort-ignore="true" data-hide="phone,tablet" class="item">Invoice</th>
                            <th data-sort-ignore="true" data-hide="phone,tablet" class="last_item footable-last-column" width="15%">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?= \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            /*'itemOptions' => ['class' => 'column_6'],*/
                            'itemView' => '_details',
                            /* 'options' => ['tag' => 'ul', 'class' => 'feed-posts-list', 'id' => 'feed-list'], */
                            //'layout' => "\n{items}\n<div class='clearfix'></div><div style='text-align: center'>{pager}</div>",
                            'layout' => "{items}",
                            /*'itemOptions' => ['tag' => 'li'],*/
                        ]) ?>

                        </tbody>
                    </table>

                    <?php if(1==2) { ?>

                        <!-- <div id="block-order-detail" class="unvisible">&nbsp;</div> -->
                        <div id="block-order-detail" class="unvisible" style="display: block;">
                            <div class="box box-small clearfix">
                                <form id="submitReorder" action="" method="post" class="submit">
                                    <input type="hidden" value="6" name="id_order">
                                    <input type="hidden" value="" name="submitReorder">
                                    <a href="#" onclick="$(this).closest('form').submit(); return false;" class="btn btn-default btn-md btn-base-min pull-right"><span>Reorder</span></a>
                                    <button type="submit" name="submitMessage" class="btn btn-default btn-md btn-base-min order-download">
                                        <span>Download</span>
                                    </button>
                                </form>
                                <p class="dark">
                                    <strong>Order Reference GHLDBXVJY - placed on 08/13/2017</strong>
                                </p>
                            </div>


                                <div class="order-rating info-order box">
                                    <h3 class="orders-page-heading page-heading bottom-indent">Your feedbeak</h3>
                                    <!-- <p><strong class="dark">Your</strong> feedbeak</p> -->
                                    <p class="form-group">
                                        <textarea class="form-control" cols="67" rows="3" name="msgText"></textarea>
                                    </p>
                                    <div class="rating"></div>
                                    <div class="submit">
                                        <button type="submit" name="submitMessage" class="btn btn-default btn-md btn-base-min">
                                            <span>Send</span>
                                        </button>
                                    </div>
                                </div>
                                <h1 class="page-heading">Follow your order's status step-by-step</h1>
                                <div class="table_block">
                                    <table class="detail_step_by_step table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="first_item">Date</th>
                                            <th class="last_item">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="first_item item">
                                            <td class="step-by-step-date">08/13/2017</td>
                                            <td><span style="background-color:#4169E1; border-color:#4169E1;" class="label">Awaiting check payment</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="adresses_bloc">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <ul class="address alternate_item box">
                                                <li>
                                                    <h3 class="page-subheading">Delivery address (My address)</h3></li>
                                                <li>
                                                    <span class="address_firstname">Aaaa</span>
                                                    <span class="address_lastname">aaaa</span>
                                                </li>
                                                <li class="address_company"></li>
                                                <li><span class="address_address1">aaaa</span> <span class="address_address2"></span></li>
                                                <li><span class="address_city">aaaa,</span> <span class="address_State:name">Alabama</span> <span class="address_postcode">72202</span></li>
                                                <li><span class="address_Country:name">United States</span></li>
                                                <li><span class="address_phone">1111111111</span></li>
                                                <li class="address_phone_mobile">11111111</li>
                                            </ul>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <ul class="address item  box">
                                                <li>
                                                    <h3 class="page-subheading">Invoice address (My address)</h3></li>
                                                <li><span class="address_firstname">Aaaa</span> <span class="address_lastname">aaaa</span></li>
                                                <li class="address_company"></li>
                                                <li><span class="address_address1">aaaa</span> <span class="address_address2"></span></li>
                                                <li><span class="address_city">aaaa,</span> <span class="address_State:name">Alabama</span> <span class="address_postcode">72202</span></li>
                                                <li><span class="address_Country:name">United States</span></li>
                                                <li><span class="address_phone">1111111111</span></li>
                                                <li class="address_phone_mobile">11111111</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <form action="">
                                    <div id="order-detail-content" class="table_block table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="first_item">Reference</th>
                                                <th class="item">Product</th>
                                                <th class="item">Quantity</th>
                                                <th class="item">Unit price</th>
                                                <th class="last_item">Total price</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr class="item">
                                                <td colspan="1">
                                                    <strong>Items (tax excl.)</strong>
                                                </td>
                                                <td colspan="4">
                                                    <span class="price">$81.00</span>
                                                </td>
                                            </tr>
                                            <tr class="item">
                                                <td colspan="1">
                                                    <strong>Items (tax incl.) </strong>
                                                </td>
                                                <td colspan="4">
                                                    <span class="price">$84.24</span>
                                                </td>
                                            </tr>
                                            <tr class="item">
                                                <td colspan="1">
                                                    <strong>Discount/Coupon</strong>
                                                </td>
                                                <td colspan="4">
                                                    <span class="price-wrapping">$2.08</span>
                                                </td>
                                            </tr>
                                            <tr class="item">
                                                <td colspan="1">
                                                    <strong>Shipping &amp; handling (tax incl.) </strong>
                                                </td>
                                                <td colspan="4">
                                                    <span class="price-shipping">$0.00</span>
                                                </td>
                                            </tr>
                                            <tr class="totalprice item">
                                                <td colspan="1">
                                                    <strong>Total</strong>
                                                </td>
                                                <td colspan="4">
                                                    <span class="price">$86.32</span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            <!-- Customized products -->
                                            <!-- Classic products -->
                                            <tr class="item">
                                                <td>
                                                    <label for="cb_16">00104</label>
                                                </td>
                                                <td class="bold">
                                                    <label for="cb_16">
                                                        Calvin Klein euphoria Eau de Parfum - Volume : 30 ml, Intensity : Parfum
                                                    </label>
                                                </td>
                                                <td class="return_quantity">
                                                    <label for="cb_16"><span class="order_qte_span editable">1</span></label>
                                                </td>
                                                <td class="price">
                                                    <label for="cb_16">
                                                        $81.00
                                                    </label>
                                                </td>
                                                <td class="price">
                                                    <label for="cb_16">
                                                        $81.00
                                                    </label>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <table class="table table-bordered footab footable-loaded footable">
                                    <thead>
                                    <tr>
                                        <th class="first_item footable-sortable">Date<span class="footable-sort-indicator"></span></th>
                                        <th class="item" data-sort-ignore="true">Carrier</th>
                                        <th data-hide="phone" class="item footable-sortable">Weight<span class="footable-sort-indicator"></span></th>
                                        <th data-hide="phone" class="item footable-sortable">Shipping cost<span class="footable-sort-indicator"></span></th>
                                        <th data-hide="phone" class="last_item" data-sort-ignore="true">Tracking number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="item">
                                        <td data-value="20170813043059">08/13/2017</td>
                                        <td>new store</td>
                                        <td data-value="0">-</td>
                                        <td data-value="0.000000">$0.00</td>
                                        <td>
                                            <span id="shipping_number_show">-</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="alert alert-warning box-comment">
                                    <div class="row">
                                        <div class="comment-wrap col-sm-12">
                                            <div class="unit-left col-xs-4 col-sm-2 col-md-1">
                                                <img class="img-circle img-responsive" src="img/cms/user-amy-garza-70x70.jpg" alt="">
                                            </div>
                                            <div class="unit-body col-xs-8 col-sm-10 col-md-11">
                                                <div class="member-name"><a href="#">Amy Garza</a></div>
                                                <div class="member-date"><p>June 21, 2017</p></div>
                                                <div class="member-comment"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore repudiandae aperiam quasi ducimus reprehenderit illo repellendus excepturi, fugit dicta cupiditate, veritatis vero repellat omnis nesciunt, at ipsa eveniet itaque commodi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est mollitia quisquam quidem, adipisci omnis quasi modi animi, debitis, veniam minus perferendis esse repudiandae nostrum sit corporis rem explicabo! Rem, pariatur.</p></div>
                                                <div class="member-reply">
                                                    <a href="#">
                                                        <span class="fa fa-mail-reply"></span>
                                                        <span class="text-middle">Reply</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-wrap col-xs-10">
                                            <div class="unit-left col-xs-4 col-sm-2 col-md-1">
                                                <img class="img-circle img-responsive" src="img/cms/user-ronald-hall-70x70.jpg" alt="">
                                            </div>
                                            <div class="unit-body col-xs-8 col-sm-10 col-md-11">
                                                <div class="member-name"><a href="#">Ronald Hall</a></div>
                                                <div class="member-date"><p>June 21, 2017</p></div>
                                                <div class="member-comment"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore repudiandae aperiam quasi ducimus reprehenderit illo repellendus excepturi, fugit dicta cupiditate, veritatis vero repellat omnis nesciunt, at ipsa eveniet itaque commodi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est mollitia quisquam quidem, adipisci omnis quasi modi animi, debitis, veniam minus perferendis esse repudiandae nostrum sit corporis rem explicabo! Rem, pariatur.</p></div>
                                                <div class="member-reply">
                                                    <a href="#">
                                                        <span class="fa fa-mail-reply"></span>
                                                        <span class="text-middle">Reply</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-wrap col-xs-10">
                                            <div class="unit-left col-xs-4 col-sm-2 col-md-1">
                                                <img class="img-circle img-responsive" src="img/cms/user-amy-garza-70x70.jpg" alt="">
                                            </div>
                                            <div class="unit-body col-xs-8 col-sm-10 col-md-11">
                                                <div class="member-name"><a href="#">Amy Garza</a></div>
                                                <div class="member-date"><p>June 21, 2017</p></div>
                                                <div class="member-comment"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore repudiandae aperiam quasi ducimus reprehenderit illo repellendus excepturi, fugit dicta cupiditate, veritatis vero repellat omnis nesciunt, at ipsa eveniet itaque commodi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est mollitia quisquam quidem, adipisci omnis quasi modi animi, debitis, veniam minus perferendis esse repudiandae nostrum sit corporis rem explicabo! Rem, pariatur.</p></div>
                                                <div class="member-reply">
                                                    <a href="#">
                                                        <span class="fa fa-mail-reply"></span>
                                                        <span class="text-middle">Reply</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="" class="std" id="sendOrderMessage">
                                    <h3 class="orders-page-heading page-heading bottom-indent">Add a message</h3>
                                    <p>If you would like to add a comment about your order, please write it in the field below.</p>
                                    <p class="form-group">
                                        <label for="id_product">Product</label>
                                        <select name="id_product" class="form-control">
                                            <option value="0">-- Choose --</option>
                                            <option value="11">Calvin Klein euphoria Eau de Parfum - Volume : 30 ml, Intensity : Parfum</option>
                                        </select>
                                    </p>
                                    <p class="form-group">
                                        <textarea class="form-control" cols="67" rows="3" name="msgText"></textarea>
                                    </p>
                                    <div class="submit">
                                        <input type="hidden" name="id_order" value="6">
                                        <input type="submit" class="unvisible" name="submitMessage" value="Send">
                                        <button type="submit" name="submitMessage" class="btn btn-default btn-md btn-base-min"><span>Send</span></button>
                                    </div>
                                </form>

                        </div>
                    <?php } ?>
                </div>



                <ul class="footer_links clearfix">
                    <li>
                        <a class="btn btn-default btn-sm btn-base-min" href="<?= \yii\helpers\Url::to(['/user/lk/index'])?>" title="Back to Your Account">
                            <span>Back to Your Account</span>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-default btn-sm btn-base-min" href="/" title="Home">
                            <span>Home</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #center_column -->
        </div>
        <!--.large-left-->
    </div>
    <!--.row-->
</div>




<?= $this->render('../common/_footer') ?>