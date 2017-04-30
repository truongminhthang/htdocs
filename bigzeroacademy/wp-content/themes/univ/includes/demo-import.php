<?php
function univ_import_files() {
  return array(
    array(
      'import_file_name'           => 'Standard Demo',
      'local_import_file'            => get_stylesheet_directory() . '/demo/default/univ.xml',
      'local_import_widget_file'     => get_stylesheet_directory() . '/demo/default/univ-wid.wie',
      'local_import_customizer_file' => get_stylesheet_directory() . '/demo/default/univ-export.dat',
      'import_preview_image_url'     => get_stylesheet_directory_uri().'/demo/img/1.jpg',
    ),
    array(
      'import_file_name'           => 'Comming Soon',
      'local_import_file'            => get_stylesheet_directory() . '/demo/default/univ.xml',
      'import_widget_file_url'     => get_stylesheet_directory() . '/demo/default/univ-wid.wie',
      'local_import_customizer_file' => get_stylesheet_directory() . '/demo/default/univ-export.dat',
      
      ),
      'import_preview_image_url'     => get_stylesheet_directory_uri().'/demo/img/1.jpg',
    );


////////////////////////////////////////////////////////////////////
 
}
add_filter( 'pt-ocdi/import_files', 'univ_import_files' );

function univ_after_import_setup() {
    // Assign menus to their locations.
    $header_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations' , array( 
				'layers-primary' => $header_menu->term_id,
			  
             ) 
        );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'univ_after_import_setup' );





