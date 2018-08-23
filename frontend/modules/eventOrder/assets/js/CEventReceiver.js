CEventReceiver = {

    init: function(){
        CEventReceiver.initEvent();
    },

    initEvent: function () {
        
        $('.j-receiver-add-form button').click(function(){

            $('.j-receiver-add-form .status').html("");
            $.ajax({
                type: "POST",
                url: $('.j-receiver-add-form').data('url-add'),
                data: {
                    ReceiverEvent:{
                        'name':$('#receiverevent-name').val(),
                        'email':$('#receiverevent-email').val(),
                        'invited':$('#receiverevent-invited').val(),
                        'event_id':$('#receiverevent-event_id').val(),
                        '_csrf':$('#_csrf').val()
                    }
                },
                dataType: "json",
                success: function(data) {

                    if(data.status == "error")
                    {
                        var t = CUtils.jsonToUL(data.msg);
                        console.log(t);
                        $('.j-receiver-add-form .status').html(t);
                    }
                    else{
                        document.location.reload();
                    }

                    //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                    // do what ever you want with the server response
                },
            });

        });

        $('body').on('click', '.j-receiver-item-edit', function(){

            $('#j-popup-larg').modal('show');
            $.ajax({
                url: $(this).data('href'),
                type: "get",
                data: {
                    'id': $(this).closest('tr').data('key')
                },
                success: function (data) {

                    console.log(data);

                    $('#j-popup-larg .modal-body').html(data);
                },
                error: function (response) {
                }
            });
        });

        $('.j-receiver-add-form').serialize()
    },

    
}

$(function(){
    CEventReceiver.init();
})

