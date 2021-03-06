<?php
   /*
   Plugin Name: SafeDrivers Addons
   Plugin URI: https://elpuas.com
   description: A plugin to create awesomeness and spread joy
   Version: 1.2
   Author: el.puas
   Author URI: https://elpuas.com
   License: GPL2
   */

if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * wp enqueue styles & scripts
 */

function safed_styles() {

  wp_enqueue_style( 'safed-fonts', plugin_dir_url( __FILE__ ) . 'fonts/fonts.min.css', array(), get_the_time('U'));
  wp_enqueue_style( 'safed-icons', plugin_dir_url( __FILE__ ) . 'assets/css/all.min.css', array(), get_the_time('U'));

}
  add_action( 'wp_enqueue_scripts', 'safed_styles' );

  function safed_scripts() {
    wp_enqueue_script( 'safed-icons-script', plugin_dir_url( __FILE__ ) . 'assets/js/all.min.js', array( ), get_the_time('U'));
    wp_enqueue_script( 'safed-script', plugin_dir_url( __FILE__ ) . 'assets/js/safed-scripts.js', array( 'jquery' ), get_the_time('U'));
  }

  add_action( 'wp_enqueue_scripts', 'safed_scripts' );

  function prefix_add_footer_styles() {
    wp_enqueue_style( 'safed-styles', plugin_dir_url( __FILE__ ) . 'assets/css/safed-style.css', array(), get_the_time('U'));
};
add_action( 'get_footer', 'prefix_add_footer_styles' );  

  /**
  * Add SVG Support
  */
  function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');


/*
 * Page Slug Body Class
 */
  function add_slug_body_class( $classes ) {
  	global $post;
  	if ( isset( $post ) ) {
  	$classes[] = $post->post_type . '-' . $post->post_name;
  	}
  	return $classes;
  	}
    add_filter( 'body_class', 'add_slug_body_class' );

/*
 * Page New Dynamic Sidebar
 */
    
  function safed_widgets_init() {
 
      register_sidebar( array(
          'name' => __( 'Widget Banner 1', 'safed' ),
          'id' => 'banner_area_1',
          'description' => __( 'Appears with [banner_one]', 'safed' ),
          'before_widget' => '<div id="%1$s" class="widget %2$s safed__dynamic-module">',
          'after_widget' => '</div>',
          'before_title' => '<h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
   
      register_sidebar( array(
          'name' =>__( 'Widget Banner 2', 'safed'),
          'id' => 'banner_area_2',
          'description' => __( 'Appears with [banner_two]', 'safed' ),
          'before_widget' => '<div id="%1$s" class="widget %2$s safed__dynamic-module">',
          'after_widget' => '</div>',
          'before_title' => '<h3 class="widget-title">',
          'after_title' => '</h3>',
      ) );
      }
   
  add_action( 'widgets_init', 'safed_widgets_init' );

/*
 * Add Dynamic Modules by Shortcut
 */

function safed_sidebar_shortcode(){
  ob_start(); 
  dynamic_sidebar( 'banner_area_1' );
  return ob_get_clean(); 

}
add_shortcode('banner_one', 'safed_sidebar_shortcode'); 

function safed2_sidebar_shortcode(){
  ob_start(); 
  dynamic_sidebar( 'banner_area_2' );
  return ob_get_clean(); 

}
add_shortcode('banner_two', 'safed2_sidebar_shortcode');

/*
* Admin footer modification
*/
function remove_footer_admin ()
{
    echo '<span id="footer-thankyou">Developed by <a href="https://www.elpuas.com" target="_blank">el.puas();</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

    