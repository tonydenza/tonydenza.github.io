jQuery(document).ready(function($) {

    // Get the modal
    var modal = document.getElementById('formModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    //mobile-menu
    $('.menu-opener').on( 'click', function() {
        $('body').addClass('menu-open');
        $('.mobile-main-navigation').addClass('toggled');
    });

    
    $(window).on("load, resize", function() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 1025) {
            $('.overlay').on( 'click', function() {
                $('body').removeClass('menu-open');
           $('.mobile-menu-wrapper .primary-menu-list').removeClass('toggled'); 
            });
        }
        else if (viewportWidth> 1025) {
            $('body').removeClass('menu-open');
        }
    });
 
    // CustomJSfor Close button

    $('.close-main-nav-toggle').on( 'click', function() {
        $('body').toggleClass('menu-open');
        $('.mobile-main-navigation').toggleClass('toggled');
    });

    $('.overlay').on( 'click', function() {
        $('body').removeClass('menu-open');
        $('.mobile-main-navigation').toggleClass('toggled');
    });

    //responsive menu
    $('<button class="angle-down"></button>').insertAfter($('.mobile-menu  ul .menu-item-has-children > a'));
    $('.mobile-menu ul li .angle-down').on( 'click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });
    //CustomJS for close of search bar
    $(".close").on( 'click', function() {
        $('.modal').css ('display', 'none');
    });

    $('.mobile-header .search-icon .search-btn').on( 'click', function() {
        $('.mobile-header .search-icon .header-searh-wrap').show();
    });

    $('.mobile-header .header-searh-wrap .btn-form-close').on( 'click', function() {
        $('.header-searh-wrap').hide();
    });

    $('<button class = "angle-down"> </button>').insertAfter($());

    //accessible menu in IE
    $("#site-navigation ul li a").on( 'focus', function() {
        $(this).parents("li").addClass("focus");
    }).on( 'blur', function() {
        $(this).parents("li").removeClass("focus");
    });

    $(".secondary-menu ul li a").on( 'focus', function() {
        $(this).parents("li").addClass("focus");
    }).on( 'blur', function() {
        $(this).parents("li").removeClass("focus");
    });

});

