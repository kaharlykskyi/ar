$(document).ready(function(){wishlistBtn();compareBtn();createSlider();mobileMenu();$(window).resize(function(){mobileMenu();});});var isMobile2=false;function wishlistBtn(){var wishlist_lnk=$('header .wishlist-link');var wishlist_div=$('header .wishlist-button');if(wishlist_div&&wishlist_lnk){wishlist_lnk.appendTo(wishlist_div);}}
function compareBtn(){var compare_lnk=$('header .compare-form');var compare_div=$('header .compare-button');if(compare_div&&compare_lnk){compare_lnk.appendTo(compare_div);}}
function createSlider(){$('#daydeal-products ul.products').slick({slidesToShow:1,slidesToScroll:1,autoplay:false,autoplaySpeed:2000,speed:700,infinite:true,cssEase:'linear',easing:'easeOutQuint',dots:true,prevArrow:'<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button"></button>',nextArrow:'<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button"></button>',});return true;}
function mobileMenu(){var languages=$('#languages-block-top');var currencies=$('#currencies-block-top');var compare=$('.compare-form');var wishlist=$('.wishlist-link');var header_links=$('#header_links');var tmhtmlcontent_top=$('#tmhtmlcontent_top');var options_content;if($(document).width()<=767&&!isMobile2){$('#header').prepend('<div class="options"><span id="options-toggle"></span><div class="options-content"></div></div>');options_content=$('#header').find('.options-content');if(languages.length){languages.parent().addClass('languages');languages.appendTo(options_content);}
if(currencies.length){currencies.parent().addClass('currencies');currencies.appendTo(options_content);}
if(compare.length){compare.parent().addClass('compare');compare.appendTo(options_content);}
if(wishlist.length){wishlist.parent().addClass('wishlist');wishlist.appendTo(options_content);}
if(header_links.length){header_links.parent().addClass('header_links');header_links.appendTo(options_content);}
if(tmhtmlcontent_top.length){tmhtmlcontent_top.parent().addClass('tmhtmlcontent_top');tmhtmlcontent_top.appendTo(options_content);}
var options_div=$('header .options');if(options_div){$('#options-toggle').on('click',function(){if(options_content.is(':visible')){options_div.removeClass('active');options_content.slideUp();}else{options_div.addClass('active');options_content.slideDown();}});$(document).mouseup(function(e){if(options_div.has(e.target).length===0){options_div.removeClass('active');options_content.slideUp();}});}
isMobile2=true;}else if($(document).width()>767&&isMobile2){if(languages.length){languages.appendTo($('header .languages'));}
if(currencies.length){currencies.appendTo($('header .currencies'));}
if(wishlist.length){wishlist.appendTo($('header .wishlist'));}
if(compare.length){compare.appendTo($('header .compare'));}
if(header_links.length){header_links.appendTo($('header .header_links'));}
if(tmhtmlcontent_top.length){tmhtmlcontent_top.appendTo($('header #tmhtmlcontent_top'));}
$('#header').find('.options').remove();isMobile2=false;}}