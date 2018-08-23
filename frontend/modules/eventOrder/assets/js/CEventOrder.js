CEventOrder = {

    init: function(){
        CEventOrder.initEvent();
    },

    initEvent: function () {
        $('.j-product-object-user-list a').click(function(){

            $('.j-product-object-user-item').removeClass('active');
            $(this).closest('.j-product-object-user-item').addClass('active');

            console.log('aaaaaaaaaaa', $(this).data('id'));

            $('#event-product_object_user_id').val($(this).data('id'));

        });

        $('body').on('change', '.j-copy-to', function(){

            if($(this).val() !=""){

                document.location.href = $(this).data('href') + "&id="+$(this).val();

            }

        });
    },



    
}

$(function(){
    CEventOrder.init();
})

