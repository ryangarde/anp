$(document).ready(function(){
    var scrollTop = 0;
    $(window).scroll(function(){
        scrollTop = $(window).scrollTop();

        if (scrollTop >= 50) {
            $('#global-nav').addClass('scrolled-nav');
        } else if (scrollTop < 100) {
            $('#global-nav').removeClass('scrolled-nav');
        }

    });

});