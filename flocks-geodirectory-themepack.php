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
    wp_register_style( 'flocks-geodirectory-themepack-stylesheet', plugins_url( '/assets/css/themepack.css', __FILE__ ), array( 'flocks-style' ), '1.0' );
    wp_enqueue_style( 'flocks-geodirectory-themepack-stylesheet' );
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
}


add_action('geodir_wrapper_open', 'flocks_geodirectory_home_map');
/**
 * Adds [gd_homepage_map] and [gd_advanced_search] shortcode in the GD Home page.
 *
 * @since 1.0.0
 * @package Flocks GeoDirectory Themepack
 */
function flocks_geodirectory_home_map() {
    if (is_page(geodir_home_page_id())) {
        echo '<div class="flocks-home-map-container">';
            echo do_shortcode( '[gd_homepage_map width=100% height=425 scrollwheel=false]' );
            echo do_shortcode( '[gd_advanced_search]' );
        echo '</div>';
    }
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
	?>
    <?php if ( ! is_page( geodir_home_page_id() ) ): ?>

    	<div class="flocks-gd-cover-image" id="cover-image">

    		<div id="cover-image-wrap" class="<?php echo sanitize_html_class( $meta_header_size ); ?> <?php echo sanitize_html_class( $meta_header_alignment ); ?>">

    			<div id="cover-image-inner-wrap">

    				<div id="cover-image-copy">

    				<div class="container">

                        <?php if ( geodir_is_geodir_page() ) : ?>

                            <?php geodir_breadcrumb(); ?>

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

                        <?php endif; ?>

                        </div><!--.container-->
                    </div><!--#cover-image-copy-->
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php }
