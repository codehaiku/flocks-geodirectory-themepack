<?php
/**
 * Plugin Name: Flocks GeoDirectory Themepack
 * Description: A third party plugin for Flocks WordPress theme that will add style to the 'GeoDirectory – Directory Plugin.'
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
 /**
  * Enqueue scripts and styles.
  */
 function flocks_geodirectory_themepack_enqueue_scripts() {
    wp_register_style( 'flocks-geodirectory-themepack-stylesheet', plugins_url( '/assets/css/themepack.css', __FILE__ ), array( 'flocks-style' ), '1.0' );
    wp_enqueue_style( 'flocks-geodirectory-themepack-stylesheet' );
	return;
}
add_action( 'wp_enqueue_scripts', 'flocks_geodirectory_themepack_enqueue_scripts', 50 );



function flocks_geodirectory_home_map() {
    the_widget( 'geodir_homepage_map' );
}
// add_action('geodir_wrapper_open', 'flocks_geodirectory_home_map');
