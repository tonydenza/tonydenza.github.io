jQuery(document).ready(function ($) {
    /** Show Ticker after js load */
    $('.newsticker-wrapper').fadeIn();

    /** Header Slider */
    /** Variables from Customizer for Slider settings */
    $('.header-slider-warp').fadeIn('slow');

    if( rm_data.rtl == '1' ){
        rtl = true;
        nrtl = 'rtl';
    }else{
        rtl = false;
        nrtl = 'ltr';
    }

    $(".top-news-slide").owlCarousel({
        items       : 8,
        autoplay    : false, //slider_auto,
        loop        : true,
        nav         : true,
        margin      : 10,
        dots        : false, 
        mouseDrag   : false,
        rtl         : rtl,
        responsive  : {
            0 : {
                items: 2,
            },
            769 : {
                items: 5,
            },
            993 : {
                items: 8,
            }
        } 
    });

    /** Breaking News Ticker */
    $('#news-ticker').ticker({
        controls: false,        // Whether or not to show the jQuery News Ticker controls
        titleText: '',
        direction : nrtl
    });
});
