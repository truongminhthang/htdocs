<?php 
/*
* Plugin Name: Univ Layer Extension
* Plugin URI: http://bootexperts.com/
* Description: This plugin is mandatory for fantasic Child Theme, This plugin is managing custom content( Teaacher, Class, portfolio, blog , Testiminial, contract, counterdown, Counter ).
* Version: 1.0
* Author: bootexperts
* Author URI: http://bootexperts.com/
*
* Text Domain: univ
* Domain Path: /languages/
*/


// Secure it
if ( ! defined( 'ABSPATH' ) ) exit;

// define constants 
define( 'UNIV_LAYERS_EXTENSION_DIR' , trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'UNIV_LAYERS_EXTENSION_URI' , trailingslashit( plugin_dir_url( __FILE__ ) ) );

// Load plugin class files
require_once( UNIV_LAYERS_EXTENSION_DIR. 'includes/class-layer-univ.php' );
require_once( UNIV_LAYERS_EXTENSION_DIR. 'includes/post-type.php' );
require_once( UNIV_LAYERS_EXTENSION_DIR. 'includes/widget-recent-posts.php' );
require_once( UNIV_LAYERS_EXTENSION_DIR. 'includes/shortcode.php' );
require_once( UNIV_LAYERS_EXTENSION_DIR. 'includes/about_us_widget.php' );

// Instantiate Plugin
if ( !function_exists('univ_extension_init') ) {
	
	function univ_extension_init() {

		global $univ_layers;

		$univ_layers = Univ_Layers_Extension::get_instance();
		// Localization
		load_plugin_textdomain('univ', FALSE, dirname(plugin_basename(__FILE__)) . "/languages");		
		
	}
	
}
add_action( 'plugins_loaded', 'univ_extension_init' );