<?php
/*
Plugin Name: Rain Custom Post Types
Plugin URI: 
Description: Create and manage customs post types for Rain Position
Version: 1.0
Author: Nestor Jaen
Author URI: 
License: GPLv2
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
//ACF
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
    // update path
    $path = plugin_dir_path(__FILE__) . 'acf/';
    // return
    return $path;
}
// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
    // update path
    $dir = plugin_dir_path(__FILE__) . 'acf/';
    // return
    return $dir;
}
// 3. Hide ACF field group menu item
#add_filter('acf/settings/show_admin', '__return_false');
// 4. Include ACF
include_once( plugin_dir_path(__FILE__) . 'acf/acf.php' );
//

// custom functions
include_once( plugin_dir_path(__FILE__) . 'includes/functions.php' );

require_once(plugin_dir_path(__FILE__).'includes/cpt-products.php');
require_once(plugin_dir_path(__FILE__).'includes/cpt-brands.php');
require_once(plugin_dir_path(__FILE__).'includes/api.php');


function init(){
	wp_register_style( 'wpb-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
	wp_enqueue_style('wpb-fa');
	wp_register_style('print_products_css', plugins_url('css/style.css',__FILE__ ));
	wp_enqueue_style('print_products_css');
    wp_register_script('js_scroll_to_infinite', plugin_dir_url(__FILE__) . 'js/scroll.js', array('jquery'), '1.0', true);
    wp_enqueue_script('js_scroll_to_infinite');
    wp_localize_script('js_scroll_to_infinite', 'scrollToInfinte', array('ajax_dir' => admin_url('admin-ajax.php') ));
	cpt_brands();
	cpt_products();
}
add_action( 'wp_ajax_loadMoreProducts', 'get_more_products' );
add_action( 'wp_ajax_nopriv_loadMoreProducts', 'get_more_products' );
add_action( 'init', 'init', 0 );
