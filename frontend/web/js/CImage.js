var CImage = {

    index : 1,

    init: function()
    {
        CImage.initEvent();
        CImage.sortable();
        CImage.setSort();
    },

    initEvent:function()
    {
        $('body').on('click', '.photo_list_item_delete', function(){
            CImage.deleteImage($(this));
        });

        $("body").on("change", ".empty_photo .chooseFile",  function(){
            CImage.readURL(this);
        });
    },

    deleteImage: function(pthis)
    {
        var deletePictureUrl = $('[deletePictureUrl]').attr('deletePictureUrl');
        var url = "index.php?r="+deletePictureUrl;
        var this_is = pthis ;
        if(this_is.data('id') != undefined ){
            $.post(url,{
                'id': this_is.data('id')
            },function(data){
                if (data.status == 'success'){
                    this_is.closest('.bl_img').remove();
                }
                else
                {
                    alert(data.message);
                }
            },'json');
            return false;
        }
        else{
            // var t = this_is.parent().attr("id").split("_");
            // $('#fileItem_'+t[1]).remove();
            this_is.closest('.photo_list_item').remove();
        }
    },


    readURL: function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            self = $(input);

            reader.onload = function (e) {

                self.closest('[data-view="addpicture"]').find('#fileItem_'+CImage.index).hide();


                var input = $('<input/>')
                    .attr('type', 'file')
                    .attr('class', 'chooseFile')
                    .attr('id', 'fileItem_'+(CImage.index+1))
                    .attr('name', 'Picture[imageFiles][]');

                self.closest('[data-view="addpicture"]').find('.empty_photo').append(input);
                console.log(CImage.index);

                var html = $('#img_tpl').html().replace("imgItem_", "imgItem_"+CImage.index);
                    html = html.replace("imgid", CImage.index);

                self.closest('[data-view="addpicture"]').find('.img_list .img_list_sortable').append(html);

                self.closest('[data-view="addpicture"]').find("#imgItem_"+CImage.index+" img").attr('src', e.target.result);

                CImage.index = CImage.index + 1;

                CImage.setSort();
            }

            reader.readAsDataURL(input.files[0]);
            CImage.sortable();
        }
    },

    sortable: function()
    {

        $('.sortable').sortable('destroy');

        setTimeout(function(){
            $('.sortable').sortable().bind('sortupdate', function() {
                CImage.setSort();
            });

            $('.handles').sortable({
                handle: 'span'
            });
            $('.connected').sortable({
                connectWith: '.connected'
            });
            $('.exclude').sortable({
                items: ':not(.disabled)'
            });
        }, 500);
    },

    setSort: function(){
        var ind = 0;
        var oldIds = "";
        var newIds = "";
        $('.img_list_sortable .bl_img').each(function(item){
            ind++;

            if($(this).attr('data-type')=="old")
                oldIds+=$(this).attr('image_id')+":"+ind+",";
            else
                newIds+=ind+",";

        });

        $('[data-view="addpicture"] [name="old_img"]').val(oldIds);
        $('[data-view="addpicture"] [name="new_img"]').val(newIds);
    }


}
$(function(){

    CImage.init();

})
