jQuery(function($) {
    // Override the nav search bar click event
    $('#main_navbar .wpdreams_asl_container .probox .promagnifier').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        if($(window).width() >= 992) {
            $('#main_navbar .wpdreams_asl_container .probox form input.orig').trigger('focus');
            $('#main_navbar .wpdreams_asl_container').addClass('ngifocus');
            $('#menu-main-navigation, #menu-main-order-btn').fadeOut(100);
        }
    });
    $('#main_navbar .wpdreams_asl_container .probox form input').blur(function(e){
        $('#main_navbar .wpdreams_asl_container').removeClass('ngifocus');
        $('#menu-main-navigation, #menu-main-order-btn').delay(400).fadeIn();
    });
});
