CAnimation = {

    init: function(){

        setTimeout(function(){
            // CAnimation.start();
        }, 2000)

    },

    start: function(){

        $('.bl_envelope').show('fade', [], 2000, function(){

            $('.bl_envelope').addClass('step-move-bootom', 1500, 'easeInQuint', function(){

                $('.layer2').hide();

                $('.layer2').addClass('step-cart-top');

                $("#card").flip();

                $('.layer2').show('fade', [], 3000, function() {

                    setTimeout(function(){
                        $("#card").trigger("click");
                    }, 500);

                    setTimeout(function(){
                        $('.bl_envelope1').show('fade', [], 800);
                    }, 1500);

                    setTimeout(function(){
                        $('.j-block-rsvp').show('fade', [], 800, function() {
                        });
                    }, 3000);

                    setTimeout(function(){
                        $("#card").flip('toggle');
                    }, 4000);

                    setTimeout(function(){
                        $('.j-block-rsvp').trigger('click');
                    }, 5500);
                });
            });
        });
    }
}

$(function(){
    CAnimation.init()
})