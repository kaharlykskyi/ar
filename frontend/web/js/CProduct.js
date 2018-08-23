CProduct = {

    init: function(){

        CProduct.initEvent();

        console.log('CProduct.initEvent();');

    },

    initEvent: function(){

        var $element = $("#product-attachments");

        if($element.length != 0){
            $element.fileinput({
                uploadAsync: false,
                showUpload: false, // hide upload button
                showCaption: false, // hide upload button
                showRemove: false, // hide remove button
                showPreview: false, // hide remove button
                overwriteInitial: true,
                /*minFileCount: 1,
                 maxFileCount: 5,*/
                initialPreviewAsData: false
            }).on("filebatchselected", function(event, files) {
                $element.fileinput("upload");
            })
                .on("filebatchuploadsuccess", function(event, data) {
                    console.log('load');
                });

        }


        if($('#product-category_main_id').length>0){
            $('#product-category_main_id').change(function(){
                $("#product-category_id").val([]);
                CProduct.selectCategory();
            });
            CProduct.selectCategory();
        }


        $("body").on('click',  '.product-list .btn-favorite', function () {
            if($(this).hasClass('favorite-active'))
            {
                CProduct.removeFavorit(
                    $(this).closest('.product-container').data('id'),
                    $(this),
                    'product-list'
                );
            }
            else
            {
                CProduct.addFavorit(
                    $(this).closest('.product-container').data('id'),
                    $(this)
                );
            }
        });

        $("body").on('click', '.favorite-list .btn-favorite', function () {
            CProduct.removeFavorit(
                $(this).closest('.product-container').data('id'),
                $(this),
                'favorite-list'
            );
        });

        $("body").on('click', '.last-view .a_close', function () {
            CProduct.removeLastView(
                $(this).closest('.last-view').data('id'),
                $(this).closest('.last-view')
            );
        });


    },

    selectCategory: function(){

        $('#product-category_id option').hide();
        $('#product-category_id option[parent="'+$('#product-category_main_id').val()+'"]').show();
    },


    addFavorit: function(id, self){

        console.log("add Favorite", id, self);

        $.ajax({
            url: '/user/favorite/add',
            type: "POST",
            dataType: "json",
            data: {
                id:id
            },
            self:self,
            success: function(data) {
                this.self.addClass('favorite-active');
            },
            error: function(response) {
            }
        });
    },



    removeFavorit: function(id, self, type){

        console.log(id, self, type);

        $.ajax({
            url: '/user/favorite/remove',
            type: "POST",
            dataType: "json",
            data: {
                id:id
            },
            self:self,
            success: function(data) {
                if(type == "favorite-list")
                    this.self.closest('li').remove();
                else{
                    this.self.removeClass('favorite-active');
                }
            },
            error: function(response) {
            }
        });
    },
}

$(function(){
    CProduct.init();
});

