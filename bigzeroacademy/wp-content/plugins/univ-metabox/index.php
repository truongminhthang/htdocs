<?php
/*
Plugin Name: Univ metaboxes
Description: Add univ metabox field
Version: 1.0
Author: bootexperts
Author URI: http://bootexperts.com/
License: GPL2
*/

add_action( 'admin_init', 'univ_child_plugin_has_parent_plugin' );
if ( !function_exists('univ_child_plugin_has_parent_plugin') ) {
	function univ_child_plugin_has_parent_plugin() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'cmb2/init.php' ) ) {
			add_action( 'admin_notices', 'univ_child_plugin_notice' );
			deactivate_plugins( plugin_basename( __FILE__ ) ); 
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}
	}
}
function univ_child_plugin_notice(){
    ?><div class="error"><p><strong><?php esc_html_e('Sorry, but Install metaboxes Plugin, requires the CMB2 plugin to be installed and active.','univ');?></strong></p></div><?php
}
include( plugin_dir_path( __FILE__ ) . 'metaboxs.php');