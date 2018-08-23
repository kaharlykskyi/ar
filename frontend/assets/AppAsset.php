<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "/themes/css/global.css",
        "/themes/css/autoload/highdpi.css",
        "/themes/css/autoload/jquery.bxslider.css",
        "/themes/css/autoload/responsive-tables.css",
        "/themes/css/autoload/slick.css",
        "/themes/css/autoload/slick-theme.css",
        /* "/themes/css/autoload/uniform.default.css", */
        "/js/jquery/plugins/fancybox/jquery.fancybox.css",
        "/themes/css/product.css",
        "/js/jquery/plugins/jqzoom/jquery.jqzoom.css",
        "/themes/css/product_list.css",
        "/themes/css/modules/blockcart/blockcart.css",
        "/js/jquery/plugins/bxslider/jquery.bxslider.css",
        "/themes/css/modules/blockcategories/blockcategories.css",
        "/themes/css/modules/blockcurrencies/blockcurrencies.css",
        "/themes/css/my_goods.css",
        "/themes/css/modules/blocklanguages/blocklanguages.css",
        "/themes/css/modules/blockcontact/blockcontact.css",
        "/themes/css/modules/blocknewsletter/blocknewsletter.css",
        "/themes/css/modules/blocktags/blocktags.css",
        "/themes/css/modules/blockviewed/blockviewed.css",
        "/themes/css/modules/homeslider/homeslider.css",
        "/themes/css/modules/homefeatured/homefeatured.css",
        "/themes/css/modules/themeconfigurator/css/hooks.css",
        "/themes/css/modules/blockpermanentlinks/blockpermanentlinks.css",
        "/themes/css/modules/tmheaderaccount/views/css/tmheaderaccount.css",
        "/modules/tmproductlistgallery/views/css/slick.css",
        "/modules/tmproductlistgallery/views/css/slick-theme.css",
        "/modules/tmproductlistgallery/views/css/tmproductlistgallery.css",
        "/themes/css/modules/tmmegamenu/views/css/tmmegamenu.css",
        "/themes/css/modules/tmnewsletter/views/css/tmnewsletter.css",
        "/modules/tmproductvideos/views/css/video/video-js.css",
        "/modules/tmproductvideos/views/css/tmproductvideos.css",
        "/themes/css/modules/tmmegalayout/views/css/tmmegalayout.css",
        "/themes/css/modules/tmmosaicproducts/views/css/tmmosaicproducts.css",
        "/modules/tmmosaicproducts/views/css/video/video-js.css",
        "/themes/css/modules/tmdaydeal/views/css/tmdaydeal.css",
        "/themes/css/modules/tmmediaparallax/views/css/tmmediaparallax.css",
        "/modules/tmmediaparallax/views/css/rd-parallax.css",
        "/themes/css/modules/tmhtmlcontent/css/hooks.css",
        "/themes/css/modules/tmsearch/views/css/tmsearch.css",
        "/js/jquery/plugins/autocomplete/jquery.autocomplete.css",
        "/themes/css/modules/themeconfigurator/css/live_configurator.css",
        "/themes/css/modules/tmmegalayout/views/css/layouts/Header1.css",
        "/themes/css/modules/tmmegalayout/views/css/layouts/Home1.css",
        "/themes/css/modules/tmmegalayout/views/css/layouts/Footer1.css",
        "/themes/css/product_list.css",
        "/js/jquery/plugins/PrettyEventCalendar/calendar.css",
        "/css/site.css",
    ];
    public $js = [
        "/js/jquery/jquery-migrate-1.2.1.min.js",
        "/js/jquery/plugins/jquery.easing.js",
        "/js/tools.js",
        "/themes/js/product.js",
        "/js/jquery/plugins/jqzoom/jquery.jqzoom.js",

        "/modules/tmproductlistgallery/views/js/slick.min.js",
        "/modules/tmproductlistgallery/views/js/arrive.min.js",
        "/modules/tmproductlistgallery/views/js/tmproductlistgallery.js",

        "/themes/js/global.js",
        "/themes/js/autoload/10-bootstrap.min.js",
        "/themes/js/autoload/14-device.min.js",
        "/themes/js/autoload/15-jquery.total-storage.min.js",
        /* "/themes/js/autoload/15-jquery.uniform-modified.js",*/
        "/themes/js/autoload/16-jquery.scrollmagic.min.js",
        "/themes/js/autoload/17-jquery.scrollmagic.debug.js",
        "/themes/js/autoload/18-TimelineMax.min.js",
        "/themes/js/autoload/19-TweenMax.min.js",
        "/themes/js/autoload/20-jquery.bxslider.js",
        "/themes/js/autoload/21-slick.js",
        "/js/jquery/plugins/fancybox/jquery.fancybox.js",
        "/themes/js/products-comparison.js",
        "/themes/js/modules/blockcart/ajax-cart.js",
        "/js/jquery/plugins/jquery.scrollTo.js",
        "/js/jquery/plugins/jquery.serialScroll.js",
        "/js/jquery/plugins/bxslider/jquery.bxslider.js",
        "/themes/js/tools/treeManagement.js",
        "/themes/js/modules/blocknewsletter/blocknewsletter.js",
        "/themes/js/modules/homeslider/js/homeslider.js",
        "/js/validate.js",
        "/modules/tmheaderaccount/views/js/tmheaderaccount.js",
        "/modules/tmmegamenu/views/js/hoverIntent.js",
        "/modules/tmmegamenu/views/js/superfish.js",
        "/themes/js/modules/tmmegamenu/views/js/tmmegamenu.js",
        "/modules/tmnewsletter/views/js/tmnewsletter.js",
        "/modules/tmproductvideos/views/js/video/video.js",
        "/themes/js/modules/tmmegalayout/views/js/tmmegalayout.js",
        "/modules/tmmosaicproducts/views/js/tmmosaicproducts.js",
        "/modules/tmmosaicproducts/views/js/video/video.js",
        "/modules/tmdaydeal/views/js/jquery.countdown.js",
        "/modules/tmdaydeal/views/js/tmdaydeal.js",
        "/modules/tmmediaparallax/views/js/jquery.rd-parallax.min.js",
        "/modules/tmmediaparallax/views/js/jquery.youtubebackground.js",
        "/modules/tmmediaparallax/views/js/jquery.vide.min.js",
        "/modules/tmmediaparallax/views/js/tmmediaparallax.js",
        "/js/jquery/plugins/autocomplete/jquery.autocomplete.js",
        "/themes/js/modules/tmsearch/views/js/tmsearch.js",
        "/js/jquery/plugins/uitotop/jquery.ui.totop.min.js",
        "js/jquery/plugins/PrettyEventCalendar/calendar.js",
        "/themes/js/index.js",
        "/js/CProduct.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];


    public function init(){

        $_version = \Yii::$app->params['version'];

        foreach ($this->js as $key=>$item)
        {
            $this->js[$key] = $this->js[$key]."?_=".$_version;
        }

        foreach ($this->css as $key=>$item)
        {
            $this->css[$key] = $this->css[$key]."?_=".$_version;
        }

    }
}
