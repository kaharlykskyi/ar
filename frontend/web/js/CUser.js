CUser = {

    init: function(){

        CUser.initEvent();

    },

    initEvent: function(){

        if($('#ca').length>0)
        {
            $('#ca').calendar({
                // view: 'month',
                width: 320,
                height: 320,
                // startWeek: 0,
                // selectedRang: [new Date(), null],
                data: [
                    {
                        date: '2017/12/24',
                        value: 'Christmas Eve'
                    },
                    {
                        date: '2017/12/25',
                        value: 'Merry Christmas'
                    },
                    {
                        date: '2018/01/01',
                        value: 'Happy New Year'
                    }]
            });
        }

      

        /*
        if($('#editable_2').length>0){
            $('#editable_2').editable();
        }
        */
    },

}

$(function(){
    console.log('CUser');
    CUser.init();
});