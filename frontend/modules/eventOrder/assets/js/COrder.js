COrder = {

    init: function()
    {
        $('body').on('click', '.delivery_type a', function(){
            console.log("order-delivery_type_id");
            $('#order-delivery_type_id').val($(this).data('id'));
        });

        $('body').on('click', '.payment_type', function(){
            $('#order-payment_type_id').val($(this).data('id'));
        });

        $('body').on('change', '#order-region_id', function(){


            if(deliveryPegion[$(this).val()]){
                $('.total-sum-delivery').show();
                $('.total-sum').hide();
            }
            else
            {
                $('.total-sum-delivery').hide();
                $('.total-sum').show();
            }


        });

    },

}


$(function(){
    COrder.init();
});