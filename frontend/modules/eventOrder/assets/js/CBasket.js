CBasket = {

    _interval:'',
    _element:'',

    init: function()
    {
        CBasket.initEvent();
    },

    initEvent: function(){

        $('body').on('click', '#addProduct, .addProduct', function(){
            console.log('add product click');
            CBasket.add($(this));
        });

        $('body').on('click', '.removeProductOrder', function(){
            CBasket.remove($(this), function(){
                // document.location.reload();
            });
        });

        /*
        $('body').on('click', '.btn-plus-product', function(){
            var $input = $(this).parent().find("input");
            return $input.val(parseInt($input.val()) + 1), $input.change(), !1
        });

        $('body').on('click', '.btn-minus-product', function(){
            var $input = $(this).parent().find("input"), count = parseInt($input.val()) - 1;
            return count = count < 1 ? 1 : count, $input.val(count), $input.change(), !1
        });

        $('body').on('click', '.btn-minus-basket', function(){
            var cnt = $(this).parent().find("input").val();
            cnt = --cnt<1 ? 1:cnt;
            $(this).parent().find("input").val(cnt);

            if(CBasket._interval!="")
            {
                clearInterval(CBasket._interval);
                CBasket._interval = "";
            }

            CBasket._element = $(this);
            CBasket._interval = setTimeout(function(){
                CBasket.set(CBasket._element);
            }, 500);
        });

        $('body').on('click', '.btn-plus-basket', function(){
            var cnt = $(this).parent().find("input").val();
            cnt++;
            $(this).parent().find("input").val(cnt);

            if(CBasket._interval!="")
            {
                clearInterval(CBasket._interval);
                CBasket._interval = "";
            }

            CBasket._element = $(this);
            CBasket._interval = setTimeout(function(){
                CBasket.set(CBasket._element);
            }, 500);
        });

        $('body').on('click', '.product-item .plus', function(){
            var cnt = $(this).closest('.product-item').find('.product-count').val();
            cnt++;
            $(this).closest('.product-item').find('.product-count').val(cnt);
        });

        $('body').on('click', '.product-item .minus', function(){
            var cnt = $(this).closest('.product-item').find('.product-count').val();
            cnt = --cnt<1 ? 1:cnt;
            $(this).closest('.product-item').find('.product-count').val(cnt);
        });
        */


        $('body').on('click', '.removeProduct', function(){
            CBasket.remove($(this));
        });


        $('body').on('click', '.refreshOrder', function(){
            CBasket.set($(this));
        });

    },

    add: function(self){

        var _product = self.closest('.product-element');

        /* CBasket.addToCartEfect(_product); */

        var object_id = _product.data('object_id');
        var object_type = _product.data('object_type');
        var url = _product.data('basket-add-url');

        console.log(url,object_id, object_type);
        var count = 1; // _product.find('.product-count').val();
        $.ajax({
            url: url, /*'index.php?r=basket/add',*/
            type: "POST",
            dataType: "json",
            data: {
                '_csrf':$('#_csrf').val(),
                'object_id':object_id,
                'object_type':object_type,
                'count':count,
            },
            _self:$(this),
            success: function(data) {
                if(data.status == "success")
                {
                    $('.basket-container .basket_count').html(data.basketData.count);
                    // $('#basket-dropbox .dropdown-menu').html(data.basketData.html);
                    // $('#basket-label').html('<i class="fa fa-shopping-bag mr5" aria-hidden="true"></i>Корзина ('+data.basketData.count+')');
                }
                if(data.status == "warning")
                {
                    alert(data.message);
                }
                if(data.status == "error")
                {
                    alert(data.message);
                }
            },
            error: function(response) {
                alert('error');
            }
        });

    },

    set: function(pthis){

        var hash = pthis.closest('tr').attr('hash');
        var count = pthis.closest('tr').find('.product-count').val();
        var _csrf = pthis.closest('form').find('[name="_csrf"]').val();

        var url = $('#_basket_set_url').val();
        
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
                '_csrf':_csrf,
                'hash':hash,
                'count':count
            },
            _self:$(this),
            success: function(data) {
                if(data.status == "success")
                {
                    var html = $($.parseHTML(data.basketData.html));
                    var tr = html.find('[hash="'+data.hash+'"]').html();
                    $('[hash="'+data.hash+'"]').html(tr);

                    $('.basket-container .basket_count').html(data.basketData.count);
                    $('.basket-total').html(data.basketData.sum);
                    $('.basket-delivery-total').html(data.basketData.delivery_sum);
                    $('.basket-total-all').html(data.basketData.sum+parseInt(data.basketData.delivery_sum));
                }
                if(data.status == "warning")
                {
                    alert(data.message);
                }
                if(data.status == "error")
                {
                    alert(data.message);
                }
            },
            error: function(response, a1, a2) {
                //alert('error');
            }
        });

    },

    remove: function(pthis, _callBack){

        var hash = pthis.closest('tr').attr('hash');
        var _csrf = pthis.closest('form').find('[name="_csrf"]').val();
        var url = $('#_basket_remove_url').val();

        // console.log(url);
        // return;
        
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {
                '_csrf':_csrf,
                'hash':hash
            },
            _self:$(this),
            success: function(data) {
                console.log(data);
                if(data.status == "success")
                {
                    /*
                    $('.basket__list--table').html(data.basketData.html);
                    $('.basket-container .basket_count').html(data.basketData.count);
                    $('.basket-total').html(data.basketData.sum);
                    $('.basket-delivery-total').html(data.basketData.delivery_sum);
                    $('.basket-total-all').html(data.basketData.sum+parseInt(data.basketData.delivery_sum));
                    */

                    document.location.reload();

                }
                if(data.status == "warning")
                {
                    alert(data.message);
                }
                if(data.status == "error")
                {
                    alert(data.message);
                }
            },
            error: function(response) {
                //alert('error');
            }
        });

    },

    addToCartEfect: function (_product) {

        console.log('addToCartEfect');

        var deltaTop = 0;
        var imgtodrag = _product.find('.img-container img').eq(0);



        if (imgtodrag.length == 0) return;

        console.log(imgtodrag);
        var cart = $('.basket-container i');

        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top-deltaTop,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.8',
                    'position': 'absolute',
                    'height': imgtodrag.css('height'),
                    'width': imgtodrag.css('width'),
                    'z-index': '2010'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top - 4,
                    'left': cart.offset().left - 2,
                    'width': 20,
                    'height': 25
                }, 1000, 'easeInOutQuint');


            imgclone.animate({
                'opacity': '0'
            }, function () {
                $(this).detach()
            });
        }
    }

}


$(function(){
    CBasket.init();
});