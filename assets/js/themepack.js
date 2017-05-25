jQuery(document).ready( function($) {
    "use strict";

    $('#secondary .widget .geodir_category_list_view, #site-footer-widgets.site-footer-section .widget .geodir_category_list_view, #geodir-sidebar .widget .geodir_category_list_view, #geodir-sidebar-left .widget .geodir_category_list_view, #geodir-sidebar-right .widget .geodir_category_list_view').addClass('owl-carousel flocks_geodirectory_owl_carousel');

    $('.flocks_geodirectory_owl_carousel').owlCarousel({
        items:1,
        nav:true,
        lazyLoad: true,
        margin:10
    });

    $('.flocks-single-header-carousel').addClass('owl-carousel flocks-single-geodirectory-carousel');

    var single_owl_carousel = $('.flocks-single-geodirectory-carousel');

    if (typeof flocks_geodirectory_single_carousel_object !== 'undefined' && flocks_geodirectory_single_carousel_object !== null) {
        $(single_owl_carousel).owlCarousel({
            items:flocks_geodirectory_single_carousel_object.items,
            margin:0,
            loop:flocks_geodirectory_single_carousel_object.loop,
            autoWidth:flocks_geodirectory_single_carousel_object.autoWidth,
            nav:flocks_geodirectory_single_carousel_object.nav,
            lazyLoad:flocks_geodirectory_single_carousel_object.lazyLoad,
            autoplay:flocks_geodirectory_single_carousel_object.autoplay,
            autoplayTimeout:flocks_geodirectory_single_carousel_object.autoplayTimeout,
            autoplayHoverPause:flocks_geodirectory_single_carousel_object.autoplayHoverPause,
            responsiveClass:flocks_geodirectory_single_carousel_object.responsiveClass,
            responsive:{
                0: {
                  items:flocks_geodirectory_single_carousel_object.mobile_screens_items,
                  autoWidth:flocks_geodirectory_single_carousel_object.mobile_autoWidth
                },
                480: {
                  items:flocks_geodirectory_single_carousel_object.items,
                }
            }
        });
    }

    $('.flocks-single-header-carousel .owl-item li').magnificPopup({
        delegate: '.magnify-link',
        type: 'image',
		mainClass: 'mfp-no-margins mfp-fade mfp-with-zoom flocks-gd-mfp-wrap',
        gallery: {
            enabled: true
        },
        image: {
        	verticalFit: true
        }
    });

    if ( $('#site-footer-widgets #widget-collections').find('.flocks_geodirectory_owl_carousel, .geodir_event_listing_calendar').length != 0 ) {
        $('#site-footer-widgets #widget-collections').isotope({
            layoutMode: 'fitRows'
        });
    }

});
