$(document).ready(function(){
    var scrollTop = 0;
    var $L = 1200,
        $cart_trigger = $('#cd-cart-trigger'),
        $lateral_cart = $('#cd-cart'),
        $shadow_layer = $('#cd-shadow-layer');

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

    $cart_trigger.on('click', function(event){
        event.preventDefault();
        toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
    });

    $shadow_layer.on('click', function(){
        $shadow_layer.removeClass('is-visible');
        // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
        if( $lateral_cart.hasClass('speed-in') ) {
            $lateral_cart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
                $('body').removeClass('overflow-hidden');
            });
        } else {
            $lateral_cart.removeClass('speed-in');
        }
    });
});

function toggle_panel_visibility ($lateral_panel, $background_layer, $body) {
    if( $lateral_panel.hasClass('speed-in') ) {
        // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
        $lateral_panel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
            $body.removeClass('overflow-hidden');
        });
        $background_layer.removeClass('is-visible');

    } else {
        $lateral_panel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
            $body.addClass('overflow-hidden');
        });
        $background_layer.addClass('is-visible');
    }
}