<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>



<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-us"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7" lang="en-us"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8" lang="en-us"><![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9" lang="en-us"><![endif]-->
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />

    <meta name="description" content="Shop powered by PrestaShop" />
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.0, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="icon" type="image/vnd.microsoft.icon" href="img/favicon.ico" />
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&subset=latin-ext" type="text/css" media="all" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arizonia&amp;subset=latin-ext" type="text/css" media="all" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700&subset=cyrillic,latin-ext" type="text/css" media="all" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <script>
        var jqZoomEnabled = true;
    </script>
</head>

<body id="index" class="index hide-left-column hide-right-column lang_en  one-column">

<?php $this->beginBody() ?>

<?php

// \Yii::$app->params['cid'] = \Yii::$app->controller->id."-".\Yii::$app->controller->action->id;


?>
<div id="page">

    <?= $this->render('//common/_header'); ?>

    <div id="columns" style="padding-top: 20px;">

        <div class="container">
            <?= Alert::widget() ?>
        </div>
    </div>

    <div class="columns-container">
        <div id="columns">
            <div class="container">
                <?= Alert::widget() ?>
            </div>
            
            <?= $content ?>

            <?php if(\Yii::$app->params['mca'] == "site-index") { ?>
                <?= \frontend\widgets\TopBrands::widget([]) ?>
            <?php } ?>

            <!-- .container -->
        </div>



        <?php if(\Yii::$app->params['mca'] == "site-index") { ?>
            <?= \frontend\widgets\HotCollection::widget([]) ?>

            <?= \frontend\widgets\FeaturedProducts::widget([]) ?>

            <?= \frontend\widgets\LimitedOffers::widget([]) ?>

            <?= \frontend\widgets\MainPageBanners::widget([]) ?>
        <?php } ?>

        <!-- #columns -->


    </div>
    <!-- .columns-container -->


    <?= $this->render('//common/_footer'); ?>
</div>
<!-- #page -->

<script type="text/javascript">
    var CUSTOMIZE_TEXTFIELD = 1;
    var FancyboxI18nClose = 'Close';
    var FancyboxI18nNext = 'Next';
    var FancyboxI18nPrev = 'Previous';
    var TMHEADERACCOUNT_DISPLAY_STYLE = 'onecolumn';
    var TMHEADERACCOUNT_DISPLAY_TYPE = 'dropdown';
    var TMHEADERACCOUNT_FAPPID = null;
    var TMHEADERACCOUNT_FAPPSECRET = null;
    var TMHEADERACCOUNT_FSTATUS = null;
    var TMHEADERACCOUNT_GAPPID = 'demo';
    var TMHEADERACCOUNT_GAPPSECRET = 'demo';
    var TMHEADERACCOUNT_GREDIRECT = 'demo';
    var TMHEADERACCOUNT_GSTATUS = '1';
    var TMHEADERACCOUNT_USE_AVATAR = '1';
    var TMHEADERACCOUNT_USE_REDIRECT = '0';
    var TMHEADERACCOUNT_VKAPPID = 'demo';
    var TMHEADERACCOUNT_VKAPPSECRET = 'demo';
    var TMHEADERACCOUNT_VKREDIRECT = 'demo';
    var TMHEADERACCOUNT_VKSTATUS = '1';
    var ajax_allowed = true;
    var ajaxsearch = true;
    // var baseDir = 'https://ld-prestashop.template-help.com/prestashop_61408/';
    // var baseUri = 'https://ld-prestashop.template-help.com/prestashop_61408/index.php';
    var blocking_popup = '1';
    var comparator_max_item = 2;
    var comparedProductsIds = [];
    var contentOnly = false;
    var countries = {
        "21": {
            "id_country": "21",
            "id_lang": "1",
            "name": "United States",
            "id_zone": "2",
            "id_currency": "0",
            "iso_code": "US",
            "call_prefix": "1",
            "active": "1",
            "contains_states": "1",
            "need_identification_number": "0",
            "need_zip_code": "1",
            "zip_code_format": "NNNNN",
            "display_tax_label": "0",
            "country": "United States",
            "zone": "North America",
            "states": [{
                "id_state": "1",
                "id_country": "21",
                "id_zone": "2",
                "name": "Alabama",
                "iso_code": "AL",
                "tax_behavior": "0",
                "active": "1" }]
        }
    };

    var currency = {
        "id": 1,
        "name": "Dollar",
        "iso_code": "USD",
        "iso_code_num": "840",
        "sign": "$",
        "blank": "0",
        "conversion_rate": "1.000000",
        "deleted": "0",
        "format": "1",
        "decimals": "1",
        "active": "1",
        "prefix": "$ ",
        "suffix": "",
        "id_shop_list": null,
        "force_id": false
    };
    var currencyBlank = 0;
    var currencyFormat = 1;
    var currencyRate = 1;
    var currencySign = '$';
    var customizationIdMessage = 'Customization #';
    var delete_txt = 'Delete';
    var displayList = false;
    var email_create = false;
    var freeProductTranslation = 'Free!';
    var freeShippingTranslation = 'Free shipping!';
    var generated_date = 1493327298;
    var googleScriptStatus = false;
    var hasDeliveryAddress = false;
    var hasStoreIcon = true;
    var highDPI = false;
    var homeslider_loop = 1;
    var homeslider_pause = 3000;
    var homeslider_speed = 500;
    var homeslider_width = 10000;
    var idSelectedCountry = false;
    var idSelectedCountryInvoice = false;
    var idSelectedState = false;
    var idSelectedStateInvoice = false;
    var id_lang = 1;
    // var img_dir = 'https://ld-prestashop.template-help.com/prestashop_61408/themes/theme1388/img/';
    // var img_ps_dir = 'https://ld-prestashop.template-help.com/prestashop_61408/img/';
    // var img_store_dir = 'https://ld-prestashop.template-help.com/prestashop_61408/img/st/';
    var infoWindow = '';
    var instantsearch = true;
    var isGuest = 0;
    var isLogged = 0;
    var isMobile = false;
    var is_logged = false;
    var l_code = 'en_US';
    var map = '';
    var map_scroll_zoom = 0;
    var map_street_view = 1;
    var map_type = 'roadmap';
    var map_type_control = 1;
    var map_zoom = 10;
    var markers = [];
    var max_item = 'You cannot add more than 2 product(s) to the product comparison';
    var min_item = 'Please select at least one product';
    // var module_url = 'https://ld-prestashop.template-help.com/prestashop_61408/index.php?fc=module&amp;module=tmnewsletter&amp;controller=default&amp;id_lang=1';
    var nbItemsPerLine = 4;
    var nbItemsPerLineMobile = 2;
    var nbItemsPerLineTablet = 3;
    var page_name = 'index';
    var placeholder_blocknewsletter = 'Enter your e-mail';
    var popup_status = true;
    var priceDisplayMethod = 1;
    var priceDisplayPrecision = 2;
    var quickView = true;
    var removingLinkText = 'remove this product from my cart';
    var roundMode = 2;
    //var search_url_local = 'https://ld-prestashop.template-help.com/prestashop_61408/index.php?fc=module&module=tmsearch&controller=ajaxsearch&id_lang=1';
    // var search_url_local_instant = 'https://ld-prestashop.template-help.com/prestashop_61408/index.php?fc=module&module=tmsearch&controller=instantsearch&id_lang=1';
    var static_token = 'd920fbc0ca92842d62c4018cd80b5426';
    var tmdefaultLat = '25.948969';
    var tmdefaultLong = '-80.226439';
    var tmlogo_store = 'new-store-logo_stores-1478696711.gif';
    var tmnewsletter_status = '2';
    var tmolarkchat_status = '2';
    // var tmsearchUrl = 'https://ld-prestashop.template-help.com/prestashop_61408/index.php?controller=stores';
    var tmsearch_highlight = false;
    var tmsearch_itemstoshow = '3';
    var tmsearch_minlength = '3';
    var tmsearch_navigation = '1';
    var tmsearch_navigation_position = 'bottom';
    var tmsearch_pager = '1';
    var tmsearch_showall_text = 'Display all results(%s more)';
    var tmsearch_showallresults = '1';
    var toBeDetermined = 'To be determined';
    var token = '9b29c03879de26e34b7b7e3c871f36f0';
    var translation_1 = 'Phone:';
    var translation_2 = 'Get directions';
    var use_tm_ajax_search = true;
    var use_tm_instant_search = true;
    var user_newsletter_status = 0;
    var usingSecureMode = true;
</script>



<?php $this->endBody() ?>

<script type="text/javascript">
    var TM_PLG_TYPE = 'rollover';
    var TM_PLG_ROLLOVER_ANIMATION = 'horizontal_slide';
    var TM_PLG_DISPLAY_ITEMS = 20;
    var TM_PLG_INFINITE = 1;
    var TM_PLG_USE_PAGER = 1;
    var TM_PLG_USE_CONTROLS = 1;
    var TM_PLG_USE_THUMBNAILS = 1;
    var TM_PLG_USE_CAROUSEL = 1;
    var TM_PLG_USE_CONTROLS_THUMBNAILS = 1;
    var TM_PLG_USE_PAGER_THUMBNAILS = 1;
    var TM_PLG_CENTERING_THUMBNAILS = false;
    var TM_PLG_POSITION_THUMBNAILS = 'horizontal';
    var TM_PLG_NB_THUMBNAILS = 3;
    var TM_PLG_NB_SCROLL_THUMBNAILS = 1;
</script>
<script>
    $(document).ready(function() {
        var elem = $('#htmlcontent_top');
        if (elem.length) {
            $('body').append('        <div class=\"rd-parallax rd-parallax-1\">\r\n                                                                                                                            <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0.3\" data-type=\"media\" data-fade=\"false\" data-url=\"/prestashop_61408/img/cms/parallax_img.jpg\" data-direction=\"inverse\"><\/div>\r\n                                                <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0\" data-type=\"html\" data-fade=\"false\" data-direction=\"inverse\"><div class=\"parallax-main-layout\"><\/div><\/div>\r\n        <\/div>\r\n    ');
            var wrapper = $('.rd-parallax-1');
            elem.before(wrapper);
            $('.rd-parallax-1 .parallax-main-layout').replaceWith(elem);
            win = $(window);
        }
    });
</script>
<script>
    $(document).ready(function() {
        var elem = $('.block-parallax');
        if (elem.length) {
            $('body').append('        <div class=\"rd-parallax rd-parallax-2\">\r\n                                                                                                                            <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0.3\" data-type=\"media\" data-fade=\"false\" data-url=\"img/cms/bg_mosiac.jpg\" data-direction=\"normal\"><\/div>\r\n                                                <div class=\"rd-parallax-layer\" data-offset=\"0\" data-speed=\"0\" data-type=\"html\" data-fade=\"false\" data-direction=\"normal\"><div class=\"parallax-main-layout\"><\/div><\/div>\r\n        <\/div>\r\n    ');
            var wrapper = $('.rd-parallax-2');
            elem.before(wrapper);
            $('.rd-parallax-2 .parallax-main-layout').replaceWith(elem);
            win = $(window);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(window).on('load', function() {
            $.RDParallax();
            $('.rd-parallax-layer video').each(function() {
                $(this)[0].play();
            });
        });
    });
</script>

<?=
$this->render('common/modal');
?>


</body>
</html>
<?php $this->endPage() ?>