<h1 class="page-heading step-num"><span>1</span> Addresses</h1>
<div id="opc_account" class="opc-main-block">
    <div id="opc_account-overlay" class="opc-overlay" style="display: none;"></div>
    <div class="addresses clearfix">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="address_delivery select form-group selector1">
                    <label for="id_address_delivery">Choose a delivery address:</label>
                    <span style="width: 247px; user-select: none;">My address</span>
                    <select name="id_address_delivery" id="id_address_delivery" class="address_select form-control">
                        <option value="8" selected="selected">
                            My address
                        </option>
                    </select>
                    <span class="waitimage"></span>
                </div>
                <p class="checkbox addressesAreEquals">
                    <input type="checkbox" name="same" id="addressesAreEquals" value="1" checked="checked">
                    <label for="addressesAreEquals">Use the delivery address as the billing address.</label>
                </p>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div id="address_invoice_form" class="select form-group selector1" style="display: none;">
                    <a href="#" title="Add" class="btn-sm btn btn-default btn-base-min">
                        <span>Add a new address</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <ul class="address item box" id="address_delivery">
                    <li class="address_title">
                        <h3 class="page-subheading">Your delivery address</h3></li>
                    <li class="address_firstname address_lastname">Aaaa aaaa</li>
                    <li class="address_address1 address_address2">aaaa </li>
                    <li class="address_city address_state_name address_postcode">aaaa, Alabama 72202</li>
                    <li class="address_country_name">United States</li>
                    <li class="address_phone">1111111111</li>
                    <li class="address_phone_mobile">11111111</li>
                    <li class="address_update"><a class="btn-sm btn btn-success" href="#" title="Update"><span>Update<i class="fa fa-refresh right"></i></span></a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6">
                <ul class="address alternate_item box" id="address_invoice">
                    <li class="address_title">
                        <h3 class="page-subheading">Your billing address</h3></li>
                    <li class="address_firstname address_lastname">Aaaa aaaa</li>
                    <li class="address_address1 address_address2">aaaa </li>
                    <li class="address_city address_state_name address_postcode">aaaa, Alabama 72202</li>
                    <li class="address_country_name">United States</li>
                    <li class="address_phone">1111111111</li>
                    <li class="address_phone_mobile">11111111</li>
                    <li class="address_update"><a class="btn-sm btn btn-success" href="#" title="Update"><span>Update<i class="fa fa-refresh right"></i></span></a></li>
                </ul>
            </div>
        </div>
        <!-- end row -->
        <p class="address_add submit">
            <a href="#" title="Add" class="btn-sm btn btn-default btn-base-min">
                <span>Add a new address</span>
            </a>
        </p>
    </div>
    <!-- end addresses -->
</div>
<!-- end opc_account -->
<!-- Carrier -->
<div id="carrier_area" class="opc-main-block">
    <h1 class="page-heading step-num"><span>2</span> Delivery methods</h1>
    <div id="opc_delivery_methods" class="opc-main-block">
        <div id="opc_delivery_methods-overlay" class="opc-overlay" style="display: none;"></div>
        <div class="order_carrier_content box">
            <div id="HOOK_BEFORECARRIER"></div>
            <div class="delivery_options_address">
                <p class="carrier_title">
                    Choose a shipping option for this address: My address
                </p>
                <div class="delivery_options">
                    <div class="delivery_option item">
                        <div>
                            <table class="resume table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="delivery_option_radio input_without_label">
                                        <input id="delivery_option_8_0" class="delivery_option_radio" type="radio" name="delivery_option[8]" data-key="5," data-id_address="8" value="5," checked="checked">
                                    </td>
                                    <td class="delivery_option_logo">
                                        <img class="order_carrier_logo" src="img/s/5.jpg" alt="new store">
                                    </td>
                                    <td>
                                        <strong>new store</strong>
                                        <br>Delivery time:&nbsp;Pick up in-store
                                        <br>
                                        <span class="best_grade best_grade_price best_grade_speed">The best price and speed</span>
                                    </td>
                                    <td class="delivery_option_price">
                                        <div class="delivery_option_price">
                                            Free
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end delivery_option -->
                    <div class="delivery_option alternate_item">
                        <div>
                            <table class="resume table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="delivery_option_radio input_without_label">
                                        <input id="delivery_option_8_1" class="delivery_option_radio" type="radio" name="delivery_option[8]" data-key="6," data-id_address="8" value="6,">
                                    </td>
                                    <td class="delivery_option_logo">
                                        <img class="order_carrier_logo" src="img/s/6.jpg" alt="My carrier">
                                    </td>
                                    <td>
                                        <strong>My carrier</strong>
                                        <br>Delivery time:&nbsp;Delivery next day!
                                        <br>
                                    </td>
                                    <td class="delivery_option_price">
                                        <div class="delivery_option_price">
                                            Free
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end delivery_option -->
                </div>
                <!-- end delivery_options -->
                <div class="hook_extracarrier" id="HOOK_EXTRACARRIER_8"></div>
            </div>
            <!-- end delivery_options_address -->
            <div id="extra_carrier" style="display: none;"></div>
            <p class="carrier_title">Leave a message</p>
            <div>
                <p>If you would like to add a comment about your order, please write it in the field below.</p>
                <textarea class="form-control" cols="120" rows="2" name="message" id="message"></textarea>
            </div>
            <p id="gift_div" style="display: block;">1
                <label for="gift_message">If you'd like, you can add a note to the gift:</label>
                <textarea rows="2" cols="120" id="gift_message" class="form-control" name="gift_message"></textarea>
            </p>
            <hr style="">
            <p class="checkbox">
                <input type="checkbox" name="cgv" id="cgv" value="1" checked="checked">
                <label for="cgv">I agree to the terms of service and will adhere to them unconditionally.</label>
                <a href="#" class="iframe" rel="nofollow">(Read the Terms of Service)</a>
            </p>
        </div>
        <!-- end delivery_options_address -->
    </div>
    <!-- end opc_delivery_methods -->
</div>
<!-- end carrier_area -->
<!-- end carrier_area -->
<!-- end carrier_area -->
<!-- END Carrier -->
<!-- Payment -->
<h1 class="page-heading step-num"><span>3</span> Please choose your payment method</h1>
<div id="opc_payment_methods" class="opc-main-block">
    <div id="opc_payment_methods-overlay" class="opc-overlay" style="display: none;"></div>
    <div class="paiement_block">
        <div id="HOOK_TOP_PAYMENT"></div>
        <div id="opc_payment_methods-content">
            <div id="HOOK_PAYMENT">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <p class="payment_module">
                            <a class="bankwire" href="#" title="Pay by bank wire">Pay by bank wire <span>(order processing will be longer)</span></a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <p class="payment_module">
                            <a class="cheque" href="#" title="Pay by check.">Pay by check<span> (order processing will be longer)</span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end opc_payment_methods-content -->
    </div>
    <!-- end opc_payment_methods -->
</div>
<!-- end HOOK_TOP_PAYMENT -->
<!-- END Payment -->

                