//var serialScrollNbImagesDisplayed;
var selectedCombination = [];
var globalQuantity = 0;
//var colors = [];
var original_url = window.location + '';
var first_url_check = true;
var firstTime = true;

$(document).ready(function() {
    var url_found = checkUrl();
    if (!url_found) {
        if (typeof productHasAttributes != 'undefined' && productHasAttributes) { findCombination(); } else { refreshProductImages(0); } }
    if (typeof(jqZoomEnabled) !== 'undefined' && jqZoomEnabled) {
        if ($('#thumbs_list .shown img').length) {
            var new_src = $('#thumbs_list .shown img').attr('src').replace('cart_', 'large_');
            if ($('.jqzoom img').attr('src') != new_src) { $('.jqzoom img').attr('src', new_src).parent().attr('href', new_src); } }
        $('.jqzoom').jqzoom({ zoomType: 'standart', zoomWidth: 400, position: 'left', lens: true, zoomHeight: 400, xOffset: 100, yOffset: -50, title: false });
    }
    if (typeof(contentOnly) !== 'undefined') {
        if (!contentOnly && !!$.prototype.fancybox) { $('li:visible .fancybox, .fancybox.shown').fancybox({ 'hideOnContentClick': true, 'openEffect': 'elastic', 'closeEffect': 'elastic' }); } else if (contentOnly) { $('#buy_block').attr('target', '_top'); } }
    if (!!$.prototype.uniform) {
        if (typeof product_fileDefaultHtml !== 'undefined') { $.uniform.defaults.fileDefaultHtml = product_fileDefaultHtml; }
        if (typeof product_fileButtonHtml !== 'undefined') { $.uniform.defaults.fileButtonHtml = product_fileButtonHtml; }
    }
    if ($('#customizationForm').length) {
        var url = window.location + '';
        if (url.indexOf('#') != -1) { getProductAttribute(); } }
    $('.product-info-tabs li:first, #product .tab-content > div:first, #product .tab-content > h3:first').addClass('active');
});



function function_exists(function_name) {
    if (typeof function_name === 'string') { function_name = this.window[function_name]; }
    return typeof function_name === 'function';
}



function updateDisplay() {
    var productPriceDisplay = productPrice;
    var productPriceWithoutReductionDisplay = productPriceWithoutReduction;
    if (!selectedCombination['unavailable'] && quantityAvailable > 0 && productAvailableForOrder == 1) {
        $('#quantity_wanted_p:hidden').show('slow');
        $('#add_to_cart:hidden').fadeIn(600);
        //$('#oosHook').hide();
        $('#availability_date').fadeOut();
        /*if (stock_management && availableNowValue != '') { $('#availability_value').removeClass('warning_inline').text(availableNowValue).show();
            $('#availability_statut:hidden').show('slow'); } else { $('#availability_statut:visible').hide('slow'); }*/
        if (!allowBuyWhenOutOfStock) {
            if (quantityAvailable <= maxQuantityToAllowDisplayOfLastQuantityMessage) { $('#last_quantities').show('slow'); } else { $('#last_quantities').hide('slow'); } }
        if (quantitiesDisplayAllowed) { $('#pQuantityAvailable:hidden').show('slow');
            $('#quantityAvailable').text(quantityAvailable);
            if (quantityAvailable < 2) { $('#quantityAvailableTxt').show();
                $('#quantityAvailableTxtMultiple').hide(); } else { $('#quantityAvailableTxt').hide();
                $('#quantityAvailableTxtMultiple').show(); } }
    } else {
        /*if (productAvailableForOrder == 1) { $('#oosHook').show();
            if ($('#oosHook').length > 0 && function_exists('oosHookJsCode')) { oosHookJsCode(); } }
        $('#last_quantities:visible').hide('slow');
        $('#pQuantityAvailable:visible').hide('slow');
        if (!allowBuyWhenOutOfStock) { $('#quantity_wanted_p:visible').hide('slow'); }
        if (!selectedCombination['unavailable']) { $('#availability_value').text(doesntExistNoMore + (globalQuantity > 0 ? ' ' + doesntExistNoMoreBut : ''));
            if (!allowBuyWhenOutOfStock) { $('#availability_value').removeClass('label-success').addClass('label-warning'); } } else { $('#availability_value').text(doesntExist).removeClass('label-success').addClass('label-warning');
            $('#oosHook').hide(); }*/
        /*if ((stock_management == 1 && !allowBuyWhenOutOfStock) || (!stock_management && selectedCombination['unavailable'])) { $('#availability_statut:hidden').show(); }*/
        if (typeof(selectedCombination['available_date']) !== 'undefined' && typeof(selectedCombination['available_date']['date_formatted']) !== 'undefined' && selectedCombination['available_date']['date'].length != 0) {
            var available_date = selectedCombination['available_date']['date'];
            var tab_date = available_date.split('-');
            var time_available = new Date(tab_date[0], tab_date[1], tab_date[2]);
            time_available.setMonth(time_available.getMonth() - 1);
            var now = new Date();
            if (now.getTime() < time_available.getTime() && $('#availability_date_value').text() != selectedCombination['available_date']['date_formatted']) { $('#availability_date').fadeOut('normal', function() { $('#availability_date_value').text(selectedCombination['available_date']['date_formatted']);
                    $(this).fadeIn(); }); } else if (now.getTime() < time_available.getTime()) { $('#availability_date').fadeIn(); } } else { $('#availability_date').fadeOut(); }
        /*if (allowBuyWhenOutOfStock && !selectedCombination['unavailable'] && productAvailableForOrder) { $('#add_to_cart:hidden').fadeIn(600);
            if (stock_management && availableLaterValue != '') { $('#availability_value').addClass('label-warning').text(availableLaterValue).show('slow');
                $('#availability_statut:hidden').show('slow'); } else { $('#availability_statut:visible').hide('slow'); } } else { $('#add_to_cart:visible').fadeOut(600);
            if (stock_management == 1 && productAvailableForOrder) { $('#availability_statut:hidden').show('slow'); } }
        if (productAvailableForOrder == 0) { $('#availability_statut:visible').hide(); }*/
    }
    /*if (selectedCombination['reference'] || productReference) {
        if (selectedCombination['reference']) { $('#product_reference span').text(selectedCombination['reference']); } else if (productReference) { $('#product_reference span').text(productReference); }
        $('#product_reference:hidden').show('slow');
    } else { $('#product_reference:visible').hide('slow'); }
    if (productHasAttributes) { updatePrice(); }*/
}

function updatePrice() {
    var combID = $('#idCombination').val();
    var combination = combinationsFromController[combID];
    if (typeof combination == 'undefined') {
        return; }
    var basePriceWithoutTax = +productPriceTaxExcluded;
    var basePriceWithTax = +productPriceTaxIncluded;
    var priceWithGroupReductionWithoutTax = 0;
    priceWithGroupReductionWithoutTax = basePriceWithoutTax * (1 - groupReduction);
    basePriceWithoutTax = basePriceWithoutTax + +combination.price;
    basePriceWithTax = basePriceWithTax + +combination.price * (taxRate / 100 + 1);
    if (combination.specific_price && combination.specific_price.price > 0) { basePriceWithoutTax = +combination.specific_price.price;
        basePriceWithTax = +combination.specific_price.price * (taxRate / 100 + 1); }
    var priceWithDiscountsWithoutTax = basePriceWithoutTax;
    var priceWithDiscountsWithTax = basePriceWithTax;
    if (default_eco_tax) { priceWithDiscountsWithoutTax = priceWithDiscountsWithoutTax + default_eco_tax * (1 + ecotaxTax_rate / 100);
        priceWithDiscountsWithTax = priceWithDiscountsWithTax + default_eco_tax * (1 + ecotaxTax_rate / 100);
        basePriceWithTax = basePriceWithTax + default_eco_tax * (1 + ecotaxTax_rate / 100);
        basePriceWithoutTax = basePriceWithoutTax + default_eco_tax * (1 + ecotaxTax_rate / 100); }
    if (combination.specific_price && combination.specific_price.reduction > 0) {
        if (combination.specific_price.reduction_type == 'amount') {
            if (typeof combination.specific_price.reduction_tax !== 'undefined' && combination.specific_price.reduction_tax === '0') {
                var reduction = combination.specific_price.reduction;
                if (combination.specific_price.id_currency == 0) { reduction = reduction * currencyRate * (1 - groupReduction); }
                priceWithDiscountsWithoutTax -= reduction;
                priceWithDiscountsWithTax -= reduction * (taxRate / 100 + 1);
            }
        } else if (combination.specific_price.reduction_type == 'percentage') { priceWithDiscountsWithoutTax = priceWithDiscountsWithoutTax * (1 - +combination.specific_price.reduction);
            priceWithDiscountsWithTax = priceWithDiscountsWithTax * (1 - +combination.specific_price.reduction); }
    }
    if (noTaxForThisProduct || customerGroupWithoutTax) { basePriceDisplay = basePriceWithoutTax;
        priceWithDiscountsDisplay = priceWithDiscountsWithoutTax; } else { basePriceDisplay = basePriceWithTax;
        priceWithDiscountsDisplay = priceWithDiscountsWithTax; }
    if (combination.specific_price && combination.specific_price.reduction > 0) {
        if (combination.specific_price.reduction_type == 'amount') {
            if (typeof combination.specific_price.reduction_tax === 'undefined' || (typeof combination.specific_price.reduction_tax !== 'undefined' && combination.specific_price.reduction_tax === '1')) {
                var reduction = combination.specific_price.reduction;
                if (typeof specific_currency !== 'undefined' && specific_currency && parseInt(combination.specific_price.id_currency) && combination.specific_price.id_currency != currency.id) { reduction = reduction / currencyRate; } else if (!specific_currency) { reduction = reduction * currencyRate; }
                if (typeof groupReduction !== 'undefined' && groupReduction > 0) { reduction *= 1 - parseFloat(groupReduction); }
                priceWithDiscountsDisplay -= reduction;
                priceWithDiscountsWithoutTax = priceWithDiscountsDisplay - reduction * (1 / (1 + taxRate / 100));
            }
        }
    }
    if (priceWithDiscountsDisplay < 0) { priceWithDiscountsDisplay = 0; }
    if (basePriceDisplay != priceWithDiscountsDisplay) {
        var discountValue = basePriceDisplay - priceWithDiscountsDisplay;
        var discountPercentage = (1 - (priceWithDiscountsDisplay / basePriceDisplay)) * 100; }
    var unit_impact = +combination.unit_impact;
    if (productUnitPriceRatio > 0 || unit_impact) {
        if (unit_impact) { baseUnitPrice = productBasePriceTaxExcl / productUnitPriceRatio;
            unit_price = baseUnitPrice + unit_impact;
            if (!noTaxForThisProduct || !customerGroupWithoutTax) { unit_price = unit_price * (taxRate / 100 + 1); } } else { unit_price = priceWithDiscountsDisplay / productUnitPriceRatio; } }
    $('#reduction_percent').hide();
    $('#reduction_amount').hide();
    $('#our_price_display').removeClass('new-price');
    $('#old_price, #old_price_display, #old_price_display_taxes').hide();
    $('.price-ecotax').hide();
    $('.unit-price').hide();
    if (priceWithDiscountsDisplay > 0) {
        if (findSpecificPrice()) { $('#our_price_display').text(findSpecificPrice()).trigger('change'); } else { $('#our_price_display').text(formatCurrency(priceWithDiscountsDisplay, currencyFormat, currencySign, currencyBlank)).trigger('change'); } } else { $('#our_price_display').text(formatCurrency(0, currencyFormat, currencySign, currencyBlank)).trigger('change'); }
    if (priceWithDiscountsDisplay.toFixed(2) != basePriceDisplay.toFixed(2)) {
        $('#old_price_display span.price').text(formatCurrency(basePriceDisplay, currencyFormat, currencySign, currencyBlank));
        $('#old_price, #old_price_display, #old_price_display_taxes').removeClass('hidden').show();
        if (priceWithDiscountsWithoutTax != priceWithGroupReductionWithoutTax) {
            if (combination.specific_price.reduction_type == 'amount') { $('#reduction_amount_display').html('-' + formatCurrency(discountValue, currencyFormat, currencySign, currencyBlank));
                $('#reduction_amount').show();
                $('#our_price_display').addClass('new-price'); } else {
                var toFix = 2;
                if ((parseFloat(discountPercentage).toFixed(2) - parseFloat(discountPercentage).toFixed(0)) == 0) { toFix = 0; }
                $('#reduction_percent_display').html('-' + parseFloat(discountPercentage).toFixed(toFix) + '%');
                $('#reduction_percent').show();
                $('#our_price_display').addClass('new-price');
            }
        }
    }
    if (default_eco_tax) {
        ecotax = default_eco_tax;
        if (combination.ecotax) { ecotax = +combination.ecotax; }
        if (!noTaxForThisProduct) { ecotax = ecotax * (1 + ecotaxTax_rate / 100); }
        $('#ecotax_price_display').text(formatCurrency(ecotax * currencyRate, currencyFormat, currencySign, currencyBlank));
        $('.price-ecotax').show();
    }
    if (productUnitPriceRatio > 0) { $('#unit_price_display').text(formatCurrency(unit_price * currencyRate, currencyFormat, currencySign, currencyBlank));
        $('.unit-price').show(); }
    if (noTaxForThisProduct || customerGroupWithoutTax) { updateDiscountTable(priceWithDiscountsWithoutTax); } else { updateDiscountTable(priceWithDiscountsWithTax); }
}



function serialScrollFixLock(event, targeted, scrolled, items, position) {
    serialScrollNbImagesDisplayed = 2;
    if ($('body').find('#image-block').parent().innerWidth() > 300 && $('body').find('#image-block').parent().innerWidth() <= 550) { serialScrollNbImagesDisplayed = 3; } else if ($('body').find('#image-block').parent().innerWidth() > 550 && $('body').find('#image-block').parent().innerWidth() <= 750) { serialScrollNbImagesDisplayed = 4; } else if ($('body').find('#image-block').parent().innerWidth() > 750 && $('body').find('#image-block').parent().innerWidth() <= 950) { serialScrollNbImagesDisplayed = 5; } else if ($('body').find('#image-block').parent().innerWidth() > 950 && $('body').find('#image-block').parent().innerWidth() <= 1150) { serialScrollNbImagesDisplayed = 6; } else if ($('body').find('#image-block').parent().innerWidth() > 1150) { serialScrollNbImagesDisplayed = 7; }
    serialScrollNbImages = $('#thumbs_list li:visible').length;
    var leftArrow = position == 0 ? true : false;
    var rightArrow = position + serialScrollNbImagesDisplayed >= serialScrollNbImages ? true : false;
    $('#view_scroll_left').css('cursor', leftArrow ? 'default' : 'pointer').fadeTo(0, leftArrow ? 0 : 1).css('display', leftArrow ? 'none' : 'block');
    $('#view_scroll_right').css('cursor', rightArrow ? 'default' : 'pointer').fadeTo(0, rightArrow ? 0 : 1).css('display', rightArrow ? 'none' : 'block');
    return true;
}

function refreshProductImages(id_product_attribute) {
    $('#thumbs_list_frame').scrollTo('li:eq(0)', 500, { axis: 'x' });
    id_product_attribute = parseInt(id_product_attribute);
    if (id_product_attribute > 0 && typeof(combinationImages) !== 'undefined' && typeof(combinationImages[id_product_attribute]) !== 'undefined') { $('#thumbs_list li').hide();
        $('#thumbs_list').trigger('goto', 0);
        for (var i = 0; i < combinationImages[id_product_attribute].length; i++) {
            if (typeof(jqZoomEnabled) !== 'undefined' && jqZoomEnabled) { $('#thumbnail_' + parseInt(combinationImages[id_product_attribute][i])).show().children('a.shown').trigger('click'); } else { $('#thumbnail_' + parseInt(combinationImages[id_product_attribute][i])).show(); } } } else {
        $('#thumbs_list li').show();
        var choice = [];
        var radio_inputs = parseInt($('#attributes .checked > input[type=radio]').length);
        if (radio_inputs) { radio_inputs = '#attributes .checked > input[type=radio]'; } else { radio_inputs = '#attributes input[type=radio]:checked'; }
        $('#attributes select, #attributes input[type=hidden], ' + radio_inputs).each(function() { choice.push(parseInt($(this).val())); });
        if (typeof combinationsHashSet !== 'undefined') {
            var combination = combinationsHashSet[choice.sort().join('-')];
            if (combination) {
                if (combination['image'] && combination['image'] != -1) { displayImage($('#thumb_' + combination['image']).parent()); } } }
    }
    if (parseInt($('#thumbs_list_frame >li:visible').length) != parseInt($('#thumbs_list_frame >li').length)) { $('#wrapResetImages').stop(true, true).show(); } else { $('#wrapResetImages').stop(true, true).hide(); }
    setTimeout(function() {
        var image_margin = 10;
        var image_count = 3;
        var thumb_width = ($('.pb-left-column').width() - image_margin * (image_count - 1)) / image_count;
        $('#thumbs_list_frame li').width(thumb_width + 'px');
        var thumb_count = $('#thumbs_list_frame >li').length;
        $('#thumbs_list_frame').width((parseInt((thumb_width) * thumb_count + image_margin * (thumb_count - 1)) + 1) + 'px');
        $('#thumbs_list').trigger('goto', 0);
        serialScrollFixLock('', '', '', '', 0);
    }, 500);
}

function galeryReload() { $('#thumbs_list').serialScroll({ items: 'li:visible', prev: '#view_scroll_left', next: '#view_scroll_right', axis: 'x', offset: 0, start: 0, stop: true, onBefore: serialScrollFixLock, duration: 700, step: 1, lazy: true, lock: false, force: false, cycle: false });
    $('#thumbs_list').trigger('goto', 1);
    $('#thumbs_list').trigger('goto', 0); }
$(document).ready(galeryReload);
if (!isMobile) { $(window).resize(refreshProductImages); } else { $(window).on("orientationchange", function() {
        var orientation_time;
        clearTimeout(orientation_time);
        orientation_time = setTimeout(function() { refreshProductImages(); }, 500); }); }



function checkUrl() {
    if (original_url != window.location || first_url_check) {
        first_url_check = false;
        var url = window.location + '';
        if (url.indexOf('#/') != -1) {
            params = url.substring(url.indexOf('#') + 1, url.length);
            tabParams = params.split('/');
            tabValues = [];
            if (tabParams[0] == '') { tabParams.shift(); }
            var len = tabParams.length;
            for (var i = 0; i < len; i++) { tabParams[i] = tabParams[i].replace(attribute_anchor_separator, '-');
                tabValues.push(tabParams[i].split('-')); }
            $('.color_pick').removeClass('selected').parent().parent().children().removeClass('selected');
            count = 0;
            for (var z in tabValues) {
                for (var a in attributesCombinations) {
                    if (attributesCombinations[a]['group'] === decodeURIComponent(tabValues[z][1]) && attributesCombinations[a]['id_attribute'] === decodeURIComponent(tabValues[z][0])) { count++;
                        $('#color_' + attributesCombinations[a]['id_attribute']).addClass('selected').parent().addClass('selected');
                        $('input:radio[value=' + attributesCombinations[a]['id_attribute'] + ']').prop('checked', true);
                        $('input[type=hidden][name=group_' + attributesCombinations[a]['id_attribute_group'] + ']').val(attributesCombinations[a]['id_attribute']);
                        $('select[name=group_' + attributesCombinations[a]['id_attribute_group'] + ']').val(attributesCombinations[a]['id_attribute']);
                        if (!!$.prototype.uniform) { $.uniform.update('input[name=group_' + attributesCombinations[a]['id_attribute_group'] + '], select[name=group_' + attributesCombinations[a]['id_attribute_group'] + ']'); } } } }
            if (count) {
                if (firstTime) { firstTime = false;
                    findCombination(); }
                original_url = url;
                return true;
            } else { window.location.replace(url.substring(0, url.indexOf('#'))); }
        }
    }
    return false;
}
$(document).ready(function() {
    countItemsProducts();
    if ($('#bxslider li').length && !!$.prototype.bxSlider) { products_slider = $('#bxslider').bxSlider({ minSlides: products_carousel_items, maxSlides: products_carousel_items, slideWidth: 500, slideMargin: 20, pager: false, nextText: '', prevText: '', moveSlides: 1, infiniteLoop: false, hideControlOnEnd: true, responsive: true, useCSS: false, autoHover: false, speed: 500, pause: 3000, controls: true, autoControls: false }); }
    if (!$('#bxslider').length) { $('.accessories-block').parent().remove(); }
});
if (!isMobile) { $(window).resize(function() {
        if ($('#bxslider').length) { resizeCarouselProducts() } }); } else { $(window).on("orientationchange", function() {
        var orientation_time;
        clearTimeout(orientation_time);
        orientation_time = setTimeout(function() {
            if ($('#bxslider').length) { resizeCarouselProducts() } }, 500); }); }

function resizeCarouselProducts() { countItemsProducts();
    products_slider.reloadSlider({ minSlides: products_carousel_items, maxSlides: products_carousel_items, slideWidth: 500, slideMargin: 20, pager: false, nextText: '', prevText: '', moveSlides: 1, infiniteLoop: false, hideControlOnEnd: true, responsive: true, useCSS: false, autoHover: false, speed: 500, pause: 3000, controls: true, autoControls: false }); }

function countItemsProducts() {
    if ($('.page-product-box').width() < 400)
        products_carousel_items = 2;
    if ($('.page-product-box').width() > 400)
        products_carousel_items = 2;
    if ($('.page-product-box').width() >= 550)
        products_carousel_items = 2;
    if ($('.page-product-box').width() >= 900)
        products_carousel_items = 3;
    if ($('.page-product-box').width() >= 1200)
        products_carousel_items = 4;
    if ($('.page-product-box').width() >= 1500)
        products_carousel_items = 5;
    if ($('.page-product-box').width() >= 1800)
        products_carousel_items = 5;
    if ($('.page-product-box').width() >= 2048)
        products_carousel_items = 6;
}
