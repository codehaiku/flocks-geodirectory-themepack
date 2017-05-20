jQuery(document).ready( function($) {
    "use strict";

    $('#secondary .widget .geodir_category_list_view, #site-footer-widgets.site-footer-section .widget .geodir_category_list_view, #geodir-sidebar .widget .geodir_category_list_view, #geodir-sidebar-left .widget .geodir_category_list_view, #geodir-sidebar-right .widget .geodir_category_list_view').addClass('owl-carousel flocks_geodirectory_owl_carousel');

    $('.flocks_geodirectory_owl_carousel').owlCarousel({
        items:1,
        nav:true,
        lazyLoad: true,
        margin:10
    });

    if ( $('#site-footer-widgets #widget-collections').find('.flocks_geodirectory_owl_carousel, .geodir_event_listing_calendar').length != 0 ) {
        $('#site-footer-widgets #widget-collections').isotope({
            layoutMode: 'fitRows'
        });
    }

});
