// html5lightbox
jQuery(document).ajaxComplete(function () {
    jQuery(".html5lightbox").html5lightbox();
});


/******************************/

// jQuery(document).ready(function($) {
//     var mastHeight = $('#header').outerHeight();
//     $('.main-wrap').css('margin-top', mastHeight); 
//      // When the window resizes
//     $(window).on('resize', function () {
//          // Get the height + padding + border of `#masthead`
//          var mastHeight = $('#header').outerHeight();

//         // Add the height to `.site-content`
//         $('.main-wrap').css('margin-top', mastHeight); 
//     });

//      // Trigger the function on document load.
//     $(window).trigger('resize');
// });

jQuery(document).ready(function ($) {
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 0) {
            jQuery('#header').addClass('small-header');
            jQuery('body').addClass('small-menu');
        } else {
            jQuery('#header').removeClass('small-header');
            jQuery('body').removeClass('small-menu');
        }
    });

    if (jQuery(this).scrollTop() > 0) {
        jQuery('#header').addClass('small-header');
        jQuery('body').addClass('small-menu');
    } else {
        jQuery('#header').removeClass('small-header');
        jQuery('body').removeClass('small-menu');
    }


        if (jQuery(window).width() <= 991) {
        /* Full Menu Bar JS */
        if ($('.menu-bar-wrapper li').hasClass('menu-item-has-children')) {
            $(".menu-item-has-children > a").after("<span class='sidebar-menu-arrow'></span>");
        }

        var $toggleButton = $('.menu-button'),
                $menuWrap = $('.menu-wrap'),
                $sidebarArrow = $('.sidebar-menu-arrow');

        // Hamburger Button
        $toggleButton.on('click', function () {
            $(this).toggleClass('button-open');
            $menuWrap.toggleClass('menu-show');
        });

        $(".close-menu").click(function () {
            alert();
        });

        jQuery('.sidebar-menu-arrow').click(function () {
            // jQuery('.menu-sidebar .menu-bar-wrapper .menu-item-has-children .sub-menu').slideUp(300);
            jQuery(this).next('.sub-menu').slideUp(300);
            if (jQuery(this).next().is(':visible')) {
                jQuery(this).next().slideUp(300);
            } else {
                jQuery(this).next().slideDown(300);
            }
            if (jQuery(this).hasClass('responsive-up-arrow')) {
                jQuery(this).removeClass('responsive-up-arrow');
            } else {
                //  jQuery('.sidebar-menu-arrow.responsive-up-arrow').removeClass('responsive-up-arrow');
                jQuery(this).addClass('responsive-up-arrow');
            }
        });
        jQuery('.menu-button').on('click', function () {
            jQuery('body').toggleClass('nav-open-menu');
        });
    }
});

/***********js for svg*************/
jQuery(function () {
    activate('img[src*=".svg"]');
    function activate(string) {
        jQuery(string).each(function () {
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            jQuery.get(imgURL, function (data) {
                // Get the SVG tag, ignore the rest
                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG
                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG
                $img.replaceWith($svg);

            }, 'xml');
        });
    }
});