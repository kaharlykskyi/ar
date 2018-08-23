


$(function(){

    initSwitcher($(".switcher"));

    var spinnerInterval = "";
    $('.spinner .btn:first-of-type').on('click', function() {

        var spinner_block = $(this).closest('.spinner_block');
        var max = spinner_block.find('input').data('max');

        var val = parseInt(spinner_block.find('input').val(), 10) + 1;
        if(val>max) val = max;

        if(spinnerInterval != "") clearInterval(spinnerInterval);

        spinner_block.find('input').val(val);
        spinnerInterval = setTimeout(function(){
            spinner_block.find('input').trigger('change');
        }, 1000);
    });
    $('.spinner .btn:last-of-type').on('click', function() {

        var spinner_block = $(this).closest('.spinner_block');
        var min =  spinner_block.find('input').data('min');
        var val = parseInt(spinner_block.find('input').val(), 10) - 1;
        if(val<min) val = min;

        if(spinnerInterval != "") clearInterval(spinnerInterval);
        spinner_block.find('input').val(val);
        spinnerInterval = setTimeout(function(){
            spinner_block.find('input').trigger('change');
        }, 1000);
    });


    $('.spinner input').each(function(){

        $(this).change(function(){

            if($(this).attr('href-data') != undefined )
            {
                var max = $(this).data('max');
                var min = $(this).data('min');


                var val = parseInt($(this).val(), 10);
                if(val>max) val = max;
                if(val<min) val = min;
                $(this).val(val);

                var data = {};
                data[$(this).attr('name')] = val;
                data['action-type'] = 'ajax';

                    $.ajax({ type:"POST",
                        cache:false,
                        /*url: "index.php?r="+$(this).attr('href-data'),*/
                        url: $(this).attr('href-data'),
                        dataType:"json",
                        data:data,
                        success: function(data)
                        {

                        }
                    });
            }
        });
    });

    /*
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })
    */
    
    $('.notific_table tr.is-click td').click(function(e) {

        console.log('aaaaaa');

        e.preventDefault();

        $(".notific_table").find('.full').hide();
        $(".notific_table").find('.half').show();

        $(".notific_table tr").removeClass('active');
        $(this).parent('tr').addClass('active');

        $(this).parent('tr').find('.full').show();
        $(this).parent('tr').find('.half').hide();

    });







    $('body').on('click', 'form[form-ajax] [type="submit"]', function(){

        var form = $(this).closest('form');
        var url = form.attr('action');

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
                data: form.serialize(),
            success: function(data) {
                if(data.status == "success")
                {
                    $('#'+form.attr('contener')).html(data.html);
                }
            },
            error: function(response) {
                //console.log(response);
            }
        });

        return false;
    });




    $("body").on("click", ".dropdown-menu li a", function(){
        var selText = $(this).text();

        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        $(this).parents('.btn-group').find('.dropdown-toggle').val($(this).data('par'));

        // find object
        var fn = window[$(this).parents('ul').data('callback')];
        if (typeof fn === "function") fn();

    });


    $(document).on('change', '.file-upload-group :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $('.file-upload-group :file').on('.file-upload-group fileselect', function(event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });


});


function initSwitcher(pthis){

    pthis.bootstrapSwitch();

    pthis.on('switchChange.bootstrapSwitch', function (event, state) {

        if($(this).attr('href-data') != undefined )
        {
            var val = typeof $(this).attr('value') != "undefined" ? $(this).attr('value'):(state ? 1 : 0);
            
            var data = {};
            data[$(this).attr('name')] = val;
            data['action-type'] = 'ajax';

            $.ajax({ type:"POST",
                cache:false,
                /*url: "index.php?r="+$(this).attr('href-data'),*/
                url: $(this).attr('href-data'),
                dataType:"json",
                data:data,
                success: function(data)
                {

                }
            });
        }

    });

}
