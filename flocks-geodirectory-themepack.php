<?php
/**
 * Plugin Name: Flocks GeoDirectory Themepack
 * Plugin URI: http://themeforest.net/user/dunhakdis
 * Description: A third party plugin for Flocks WordPress theme that will add style to the 'GeoDirectory – Directory Plugin.'
 * Version: 1.0
 * Author: Dunhakdis
 * Author URI: https://dunhakdis.com/
 * Text Domain: flocks-geodirectory-themepack
 * License: GPL2
 *
 * @since   1.0
 * @package Flocks GeoDirectory Themepack
 */
 if ( ! defined( 'ABSPATH' ) ) {
 	exit();
 }

 add_action( 'wp_enqueue_scripts', 'flocks_geodirectory_themepack_enqueue_scripts', 50 );
 /**
  * Enqueue scripts and styles.
  */
 function flocks_geodirectory_themepack_enqueue_scripts() {
    $gd_related_listing_postview = is_active_widget( false, '', 'geodir_related_listing_postview' );
    $gd_popular_postview = is_active_widget( false, '', 'geodir_popular_postview' );

    wp_register_style(
        'flocks-geodirectory-themepack-stylesheet',
        plugins_url( '/assets/css/themepack.css', __FILE__ ),
        array( 'flocks-style' ),
        '1.0'
    );
    wp_enqueue_style( 'flocks-geodirectory-themepack-stylesheet' );

    wp_register_style(
        'flocks-geodirectory-themepack-owl-carousel',
        plugins_url( '/assets/css/owl.carousel.min.css', __FILE__ ),
        array( 'flocks-style' ),
        '1.0'
    );
    wp_enqueue_style( 'flocks-geodirectory-themepack-owl-carousel' );

    wp_register_style(
        'flocks-geodirectory-themepack-owl-carousel-skin',
        plugins_url( '/assets/css/owl.theme.default.min.css', __FILE__ ),
        array( 'flocks-style' ),
        '1.0'
    );
    wp_enqueue_style( 'flocks-geodirectory-themepack-owl-carousel-skin' );

    wp_enqueue_script(
        'flocks-geodirectory-owl-carousel',
        plugins_url( '/assets/js/owl.carousel.min.js', __FILE__ ),
        array('jquery'),
        '1.0'
    );


    wp_enqueue_script(
        'flocks-geodirectory-themepack-script',
        plugins_url( '/assets/js/themepack.js', __FILE__ ),
        array('jquery'),
        '1.0'
    );

	return;
}

add_action('after_setup_theme', 'flocks_geodirectory_action_calls', 11);
/**
 * Action calls for Flocks theme compatibility.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 */
function flocks_geodirectory_action_calls()
{
    // Remove GeoDirectory Breadcrumbs
    remove_action('geodir_detail_before_main_content', 'geodir_breadcrumb', 20);
    remove_action('geodir_listings_before_main_content', 'geodir_breadcrumb', 20);
    remove_action('geodir_author_before_main_content', 'geodir_breadcrumb', 20);
    remove_action('geodir_search_before_main_content', 'geodir_breadcrumb', 20);
    remove_action('geodir_home_before_main_content', 'geodir_breadcrumb', 20);
    remove_action('geodir_location_before_main_content', 'geodir_breadcrumb', 20);

    // Remove GeoDirectory Page Titles
    remove_action('geodir_listings_page_title', 'geodir_action_listings_title', 10);
    remove_action('geodir_add_listing_page_title', 'geodir_action_add_listing_page_title', 10);
    remove_action('geodir_details_main_content', 'geodir_action_page_title', 20);
    remove_action('geodir_search_page_title', 'geodir_action_search_page_title', 10);
    remove_action('geodir_author_page_title', 'geodir_action_author_page_title', 10);

    // Remove Details Slider
    // remove_action('geodir_details_main_content', 'geodir_action_details_slider', 30);

    // Add the DetailsSlider
    // add_action('flocks_action_header_slider', 'geodir_action_details_slider', 10);

}


add_filter('geodir_filter_media_image_large_height', 'flocks_gd_filter_media_image_large_height', 10, 3 );
/**
 * Change the size of the gd image width.
 *
 * @param int $height          Large image height.
 * @param int $default         Default height.
 * @param string|array $params Image parameters.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 */
function flocks_gd_filter_media_image_large_height( $height, $default, $params ) {

    $height = 1500;

    return $height;

}

add_filter('geodir_filter_media_image_large_width', 'flocks_gd_filter_media_image_large_width', 10, 3 );
/**
 * Change the size of the gd image width.
 *
 * @param int $width           Large image width.
 * @param int $default         Default width.
 * @param string|array $params Image parameters.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 */
function flocks_gd_filter_media_image_large_width( $width, $default, $params ) {

    $width = 1500;

    return $width;

}


add_action('geodir_wrapper_open', 'flocks_geodirectory_home_header');
/**
 * Adds [gd_homepage_map] and [gd_advanced_search] shortcode in the GD Home page.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 */
function flocks_geodirectory_home_header() {
    $enable_gd_home_header = apply_filters('flocks_enable_gd_home_header', true);
    $enable_map = apply_filters('flocks_enable_gd_home_map', true);
    $map_atts = apply_filters('flocks_gd_home_map_atts', 'width=100% height=425 maptype="ROADMAP" zoom="10" scrollwheel=false');
    $enable_search = apply_filters('flocks_enable_gd_home_search', true);

    if (is_page(geodir_home_page_id()) && $enable_gd_home_header) { ?>
        <div class="flocks-home-map-container">

            <?php do_action('flocks_before_gd_home_map_content'); ?>

            <?php if ($enable_map) { ?>

                <div class="flocks-map-container">

                    <?php echo do_shortcode( '[gd_homepage_map ' . $map_atts . ' ]' ); ?>

                </div>

            <?php } ?>

            <?php do_action('flocks_after_gd_home_map_content'); ?>

            <div class="flocks-widget-container">

                <?php do_action('flocks_before_header_widget_content'); ?>

                <?php if ($enable_search) { ?>

                    <?php echo do_shortcode( '[gd_advanced_search]' ); ?>

                <?php } ?>

                <?php do_action('flocks_after_header_widget_content'); ?>

            </div>

        </div>
    <?php }
}


add_filter('geodir_breadcrumb_separator', 'flocks_change_gd_breadcrumb_separator');
/**
 * change the gd breadcrumb separator.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 * @param string $separator The breadcrumb separator HTML.
 * @return string Modified breadcrumb separator HTML.
 */
function flocks_change_gd_breadcrumb_separator($separator)
{
    $separator  = '<span class="flocks-gd-separator">';
        $separator .= ' / ';
    $separator .= '</span>';
    return $separator;
}


add_filter('geodir_comment_avatar_size', 'flocks_change_gd_comment_avatar_size');
/**
 * change the gd breadcrumb separator.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 * @param string $separator The breadcrumb separator HTML.
 * @return string Modified breadcrumb separator HTML.
 */
function flocks_change_gd_comment_avatar_size()
{
    $comment_avatar_size  = 125;
    return $comment_avatar_size;
}


add_action('geodir_wrapper_open', 'flocks_gd_the_cover_image');
/**
 * The cover photo for wordpress posts and taxonomies
 */
function flocks_gd_the_cover_image() { ?>
	<?php
	$content_header = flocks_get_content_header_meta();
	$meta_header_background = $content_header['image'];
	$meta_header_sub_title = $content_header['sub_title'];
	$meta_header_background_color = $content_header['background_color'];
	$meta_header_text_color = $content_header['text_color'];
	$meta_header_size = $content_header['header_size'];
	$meta_header_alignment = $content_header['header_alignment'];
    $post_images = geodir_get_images(
        get_the_ID(), 'thumbnail',
        get_option('geodir_listing_no_img')
    );
	?>
    <?php if ( ! is_page( geodir_home_page_id() ) && geodir_is_geodir_page() ) : ?>

        <div class="flocks-gd-cover-image" id="cover-image">

            <div id="cover-image-wrap" class="<?php echo sanitize_html_class( $meta_header_size ); ?> <?php echo sanitize_html_class( $meta_header_alignment ); ?>">

                <div id="cover-image-inner-wrap">

                    <div id="cover-image-copy">

                        <div class="container">

                            <?php if ( is_singular() ): ?>

                                <?php  the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                                <?php if ( ! empty( $meta_header_sub_title ) ) { ?>

                                    <div class="heading-lead">

                                        <?php echo wp_kses( $meta_header_sub_title, wp_kses_allowed_html( 'post' ) ); ?>

                                    </div>

                                <?php } ?>

                            <?php endif; ?>

                            <?php if ( is_archive() ): ?>

                                <?php geodir_action_listings_title(); ?>

                                <?php the_archive_description( '<div class="heading-lead">', '</div>' ); ?>

                            <?php endif; ?>

                            <?php if ( geodir_is_page('search') ): ?>

                                <?php geodir_action_listings_title(); ?>

                            <?php endif; ?>

                            <?php if ( geodir_is_page('author') ): ?>

                                <?php geodir_action_listings_title(); ?>

                            <?php endif; ?>

                            <?php geodir_breadcrumb(); ?>

                        </div><!--.container-->
                    </div><!--#cover-image-copy-->
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php }
