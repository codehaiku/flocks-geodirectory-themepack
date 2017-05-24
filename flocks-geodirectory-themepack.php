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
class FlocksGeoDirectoryThemepack
{
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', array( $this, 'flocks_geodirectory_themepack_enqueue_scripts' ), 50 );
        add_action( 'wp_enqueue_scripts', array( $this, 'flocks_geodirectory_header_carousel_object' ), 50 );
        add_action( 'after_setup_theme', array( $this, 'flocks_geodirectory_action_calls' ), 11);
        add_action( 'geodir_wrapper_open', array( $this, 'flocks_geodirectory_home_header' ) );
        add_action( 'geodir_wrapper_open', array( $this, 'flocks_geodirectory_places_archive_header' ) );
        add_action( 'geodir_wrapper_open', array( $this, 'flocks_gd_the_cover_image' ) );

        add_filter( 'body_class', array( $this, 'flocks_geodirectory_body_class' ) );
        add_filter( 'geodir_breadcrumb_separator', array( $this, 'flocks_change_gd_breadcrumb_separator' ) );
        add_filter( 'geodir_comment_avatar_size', array( $this, 'flocks_change_gd_comment_avatar_size' ) );
        add_filter( 'geodir_filter_media_image_large_height', array( $this, 'flocks_gd_filter_media_image_large_height' ), 10, 3 );
        add_filter( 'geodir_filter_media_image_large_width', array( $this, 'flocks_gd_filter_media_image_large_width' ), 10, 3 );
    }

    /**
     * Enqueue scripts and styles.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return void
     */
    public function flocks_geodirectory_themepack_enqueue_scripts()
    {
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

        wp_register_script(
            'flocks-geodirectory-owl-carousel',
            plugins_url( '/assets/js/owl.carousel.min.js', __FILE__ ),
            array('jquery'),
            '1.0'
        );
        wp_enqueue_script ('flocks-geodirectory-owl-carousel');

        wp_register_style(
            'flocks-geodirectory-themepack-magnific-popup-skin',
            plugins_url( '/assets/css/magnific-popup.css', __FILE__ ),
            array( 'flocks-style' ),
            '1.0'
        );
        wp_enqueue_style( 'flocks-geodirectory-themepack-magnific-popup-skin' );

        wp_register_script(
            'flocks-geodirectory-magnific-popup',
            plugins_url( '/assets/js/jquery.magnific-popup.min.js', __FILE__ ),
            array('jquery'),
            '1.0'
        );
        wp_enqueue_script ('flocks-geodirectory-magnific-popup');

        wp_register_script(
            'flocks-geodirectory-themepack-script',
            plugins_url( '/assets/js/themepack.js', __FILE__ ),
            array('jquery'),
            '1.0'
        );
        wp_enqueue_script ('flocks-geodirectory-themepack-script');

        return;
    }

    /**
     * Action calls for Flocks theme compatibility.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return void
     */
    public function flocks_geodirectory_action_calls()
    {
        // Remove GeoDirectory Breadcrumbs
        remove_action( 'geodir_detail_before_main_content', 'geodir_breadcrumb', 20 );
        remove_action( 'geodir_listings_before_main_content', 'geodir_breadcrumb', 20 );
        remove_action( 'geodir_author_before_main_content', 'geodir_breadcrumb', 20 );
        remove_action( 'geodir_search_before_main_content', 'geodir_breadcrumb', 20 );
        remove_action( 'geodir_home_before_main_content', 'geodir_breadcrumb', 20 );
        remove_action( 'geodir_location_before_main_content', 'geodir_breadcrumb', 20 );

        // Remove GeoDirectory Page Titles
        remove_action( 'geodir_listings_page_title', 'geodir_action_listings_title', 10 );
        remove_action( 'geodir_add_listing_page_title', 'geodir_action_add_listing_page_title', 10 );
        remove_action( 'geodir_details_main_content', 'geodir_action_page_title', 20 );
        remove_action( 'geodir_search_page_title', 'geodir_action_search_page_title', 10 );
        remove_action( 'geodir_author_page_title', 'geodir_action_author_page_title', 10 );

        // Remove Details Slider
        remove_action( 'geodir_details_main_content', 'geodir_action_details_slider', 30 );

        // Remove Taxonomy Section
        remove_action( 'geodir_details_main_content', 'geodir_action_details_taxonomies', 40 );

        // Add Single Header Slider
        add_action( 'geodir_wrapper_open', array( $this, 'flocks_gd_single_header_slider' ), 0 );

        // Add Single Title Header
        add_action( 'geodir_wrapper_open', array( $this, 'flocks_gd_single_title_header' ), 0 );

        // Add Taxonomy Section After Main Content
        add_action( 'geodir_after_single_post', 'geodir_action_details_taxonomies', 10 );

        return;
    }

    /**
     * Add the Flocks GeoDirectory Body class.
     *
     * @param string|array $classes The class list.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return string|array $classes The class list.
     */
    public function flocks_geodirectory_body_class( $classes )
    {
        if ( is_page( geodir_add_listing_page_id() ) ) {
            $classes[] = 'gd_add_listing_page';
        }

        return $classes;
    }

    /**
     * Change the gd breadcrumb separator.
     *
     * @param string $separator The breadcrumb separator HTML.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return string $separator Modified breadcrumb separator.
     */
    public function flocks_change_gd_breadcrumb_separator( $separator )
    {
        $separator  = '<span class="flocks-gd-separator">';
            $separator .= ' / ';
        $separator .= '</span>';

        return $separator;
    }

    /**
     * Change the size of GD comment avatar.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return int $comment_avatar_size Modified GeoDirectory comment avatar.
     */
    public function flocks_change_gd_comment_avatar_size()
    {
        $comment_avatar_size  = 125;

        return $comment_avatar_size;
    }

    /**
     * Change the size of the gd image width.
     *
     * @param int $height          Large image height.
     * @param int $default         Default height.
     * @param string|array $params Image parameters.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return int $height Large image height.
     */
    public function flocks_gd_filter_media_image_large_height( $height, $default, $params )
    {
        $height = 450;

        return $height;
    }

    /**
     * Change the size of the gd image width.
     *
     * @param int $width           Large image width.
     * @param int $default         Default width.
     * @param string|array $params Image parameters.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return int $width Large image width.
     */
    public function flocks_gd_filter_media_image_large_width( $width, $default, $params )
    {
        $width = 850;

        return $width;
    }

    /**
     * Displays the Flocks single GeoDirectory title header.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return void
     */
    public function flocks_gd_single_title_header()
    {
        $post_images = geodir_get_images(
            get_the_ID(), 'thumbnail',
            get_option('geodir_listing_no_img')
        );
        ?>

        <?php if( geodir_is_geodir_page() && is_singular() && ! empty( $post_images ) ) { ?>
            <div class="flocks-single-heading-container">
                <div class="container">
                    <div class="flocks-single-heading-inner-container">

                        <div class="row">

                            <div class="left-section col-lg-8 col-md-8 col-sm-12">

                                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                                <?php if ( ! empty( $meta_header_sub_title ) ) { ?>

                                    <div class="heading-lead">

                                        <?php echo wp_kses( $meta_header_sub_title, wp_kses_allowed_html( 'post' ) ); ?>

                                    </div>

                                <?php } ?>

                                <?php geodir_breadcrumb(); ?>

                			</div>

                            <div class="right-section col-lg-4 col-md-4 col-sm-12">

                                <?php geodir_social_sharing_buttons(); ?>

                			</div>

            			</div>

        			</div>
                </div>
            </div>
    	<?php }

        return;
    }

    /**
     * Displays the Flocks single GeoDirectory header slider.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return void
     */
    public function flocks_gd_single_header_slider()
    {
        global $post;
        $post_images = geodir_get_images( $post->ID, 'thumbnail' );

        if( geodir_is_geodir_page() && is_singular() && ! empty( $post_images ) ) { ?>
            <div class="flocks-single-geodirectory-carousel-container">
                <ul class="flocks-single-header-carousel">

                    <?php foreach( $post_images as $image ) { ?>

                        <li>
                            <a href="<?php echo esc_url($image->src); ?>" class="magnify-link"></a>
                            <img src="<?php echo esc_url($image->src); ?>" title="<?php esc_attr_e($image->title); ?>">
                        </li>

                    <?php } ?>

                </ul>
            </div>
        <?php }

        return;
    }

    /**
     * Displays the [gd_homepage_map] and [gd_advanced_search] shortcode in the GD Home page header.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return void
     */
    public function flocks_geodirectory_home_header()
    {
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

        return;
    }

    /**
     * Displays the [gd_listing_map] and [gd_advanced_search] shortcode in the Places archive page header.
     *
     * @since 1.0.0
     * @package Flocks GeoDirectory Themepack
     *
     * @return void
     */
    public function flocks_geodirectory_places_archive_header()
    {
        $enable_gd_places_archive_header = apply_filters('flocks_enable_gd_places_archive_header', true);
        $enable_map = apply_filters('flocks_enable_gd_places_archive_map', true);
        $map_atts = apply_filters('flocks_gd_places_archive_map_atts', 'width=100% height=425 maptype="ROADMAP" zoom="10" scrollwheel=false');
        $enable_search = apply_filters('flocks_enable_gd_places_archive_search', true);
        $post_type_list = array(
            'gd_place',
            'gd_event',
        );
        $taxonomy_list = array(
            'gd_placecategory',
            'gd_place_tags',
            'gd_eventcategory',
            'gd_event_tags'
        );

        if ( is_tax( $taxonomy_list ) && $enable_gd_places_archive_header || is_post_type_archive( $post_type_list ) ) { ?>
            <div class="flocks-places-archive-map-container">

                <?php do_action('flocks_before_gd_places_archive_map_content'); ?>

                <?php if ($enable_map) { ?>

                    <div class="flocks-map-container">

                        <?php echo do_shortcode( '[gd_listing_map ' . $map_atts . ' ]' ); ?>

                    </div>

                <?php } ?>

                <?php do_action('flocks_after_gd_places_archive_map_content'); ?>

                <div class="flocks-heading-container">

                    <div class="flocks-heading-wrap">

                        <div class="flocks-heading-inner-wrap">

                            <div class="flocks-heading-info-wrap">
                                <?php geodir_action_listings_title(); ?>

                                <?php the_archive_description( '<div class="heading-lead">', '</div>' ); ?>

                                <?php geodir_breadcrumb(); ?>

                            </div>

                            <div class="flocks-widget-container flocks-gd-places-archive-search">

                                <?php do_action('flocks_before_places_archive_header_widget_content'); ?>

                                <?php if ($enable_search) { ?>

                                    <?php echo do_shortcode( '[gd_advanced_search]' ); ?>

                                <?php } ?>

                                <?php do_action('flocks_after_places_archive_header_widget_content'); ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        <?php }

        return;
    }

    /**
     * Displays the Flocks Header Banner if there are no
     * images in the GD carousel of a single post.
     *
     * @return void
     */
    public function flocks_gd_the_cover_image()
    {
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
        $post_type_list = array(
            'gd_place',
            'gd_event',
        );
        $taxonomy_list = array(
            'gd_placecategory',
            'gd_place_tags',
            'gd_eventcategory',
            'gd_event_tags'
        );
        ?>
        <?php if ( ! is_page( array( geodir_home_page_id(), geodir_add_listing_page_id() ) ) && geodir_is_geodir_page() && ! is_tax( $taxonomy_list ) && ! is_post_type_archive( $post_type_list ) && empty( $post_images )) : ?>

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

        <?php
        return;
    }

    /**
     * Displays the Flocks Header Banner if there are no
     *
     * @return void
     */
    public function flocks_geodirectory_header_carousel_object()
    {
        $header_carousel_object = 'flocks-geodirectory-single-carousel';

        if ( geodir_is_geodir_page() && is_singular() )
        {
            $defaults = array (
                'items' => 3,
                'loop' => true,
                'autoWidth' => true,
                'nav' => true,
                'lazyLoad' => true,
                'autoplay' => true,
                'autoplayTimeout' => 1000,
                'autoplayHoverPause' => true,
                'responsiveClass' => true,
                'mobile_screens_items' => true,
                'mobile_autoWidth' => false,
        	);

        	$settings = wp_parse_args(
                apply_filters(
                    'flocks_gd_header_carousel_setting',
                    $args
                ),
                $defaults
            );

            wp_register_script( $header_carousel_object );

            wp_enqueue_script( $header_carousel_object );

            wp_localize_script(
                'flocks-geodirectory-single-carousel',
                'flocks_geodirectory_single_carousel_object',
                $settings
            );
        }

        return;
    }
}

new FlocksGeoDirectoryThemepack;
