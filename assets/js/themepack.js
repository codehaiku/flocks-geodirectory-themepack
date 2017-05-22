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

    $(single_owl_carousel).owlCarousel({
        items:3,
        margin:0,
        loop:true,
        autoWidth:true,
        nav:true,
        lazyLoad: true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsiveClass: true,
        responsive:{
            0: {
              items: 1,
              autoWidth:false
            },
            480: {
              items: 3,
            }
        }
    });

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
