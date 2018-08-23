$(document).ready(function() {
	$(window).load(function() {
		$('.blueberry').blueberry();
	});

    /*if (window.matchMedia('(min-width: 768px)').matches) {
        var offset = $('.fixed').offset(); //фиксация баннера при скроллинге
        var topPadding = 160;
        $(window).scroll(function() {
            if ($(window).scrollTop() > offset.top) {
                $('.fixed').stop().animate({ marginTop: $(window).scrollTop() - offset.top + topPadding }, 0);
            } else {
                $('.fixed').stop().animate({ marginTop: 0 });
            }
        });
    }*/



});



