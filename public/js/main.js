$(document).ready(function(){
    var scrollTop = 0;
    $(window).scroll(function(){
        scrollTop = $(window).scrollTop();

        if (scrollTop >= 50) {
            $('#global-nav').addClass('scrolled-nav');
            $('.nav-link').addClass('scrolled-links');
            $('#anp-logo').attr('src', '/images/anp-logo-white-2.png');
        } else if (scrollTop < 100) {
            $('#global-nav').removeClass('scrolled-nav');
            $('.nav-link').removeClass('scrolled-links');
            $('#anp-logo').attr('src', '/images/anp-logo.png');
        }

    });

});