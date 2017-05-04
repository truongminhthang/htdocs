<?php 

// Register Post Types




// Service post type
if ( !post_type_exists('univ_service') ) {
	function register_layers_univ_service_type() {
	

	$labels = array(
		'name'               => _x( 'Services', 'univ' ),
		'singular_name'      => _x( 'Service', 'univ' ),
		'menu_name'          => _x( 'Services', 'univ' ),
		'name_admin_bar'     => _x( 'Services', 'univ' ),
		'add_new'            => _x( 'Add New Services', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Services', 'univ' ),
		'new_item'           => esc_html__( 'New Services', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Featurep', 'univ' ),
		'view_item'          => esc_html__( 'View Services', 'univ' ),
		'all_items'          => esc_html__( 'All Services', 'univ' ),
		'search_items'       => esc_html__( 'Search Services', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Services:', 'univ' ),
		'not_found'          => esc_html__( 'No Services found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Services found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_service' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);
	// post type service
	register_post_type( 'univ_service', $args );	
	
	}	
} // END if
add_action('init','register_layers_univ_service_type');







// Classes post type
if ( !post_type_exists('univ_classes') ) {
	function register_layers_univ_classes_type() {
	
	$labels = array(
		'name'               => _x( 'Courses', 'univ' ),
		'singular_name'      => _x( 'Course', 'univ' ),
		'menu_name'          => _x( 'Courses', 'univ' ),
		'name_admin_bar'     => _x( 'Courses', 'univ' ),
		'add_new'            => _x( 'Add New Courses', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Courses', 'univ' ),
		'new_item'           => esc_html__( 'New Courses', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Courses', 'univ' ),
		'view_item'          => esc_html__( 'View Courses', 'univ' ),
		'all_items'          => esc_html__( 'All Courses', 'univ' ),
		'search_items'       => esc_html__( 'Search Courses', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Courses:', 'univ' ),
		'not_found'          => esc_html__( 'No Courses found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Courses found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'     => 'dashicons-format-image',		
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_classes' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt','comments' )
	);
	
	register_post_type( 'univ_classes', $args );
	// post type classes
	$labels = array(
		'name'              => _x( 'Courses Categories', 'univ' ),
		'singular_name'     => _x( 'Courses Category', 'univ' ),
		'search_items'      => esc_html__( 'Courses Category' ),
		'all_items'         => esc_html__( 'All Category' ),
		'parent_item'       => esc_html__( 'Parent Category' ),
		'parent_item_colon' => esc_html__( 'Parent Category:' ),
		'edit_item'         => esc_html__( 'Edit Category' ),
		'update_item'       => esc_html__( 'Update Category' ),
		'add_new_item'      => esc_html__( 'Add New Category' ),
		'new_item_name'     => esc_html__( 'New Category Name' ),
		'menu_name'         => esc_html__( 'Courses Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'classes_category' ),
	);
	// Taxonomy classes
	register_taxonomy('classes_category','univ_classes',$args);
	
	}	
} // END if
add_action('init','register_layers_univ_classes_type');








// Teacher post type
if ( !post_type_exists('univ_teacher') ) {
	function register_layers_univ_teacher_type() {
	
	$labels = array(
		'name'               => _x( 'Teachers', 'univ' ),
		'singular_name'      => _x( 'Teacher', 'univ' ),
		'menu_name'          => _x( 'Teacher', 'univ' ),
		'name_admin_bar'     => _x( 'Teacher', 'univ' ),
		'add_new'            => _x( 'Add New Teacher', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Teacher', 'univ' ),
		'new_item'           => esc_html__( 'New Teacher', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Teacher', 'univ' ),
		'view_item'          => esc_html__( 'View Teacher', 'univ' ),
		'all_items'          => esc_html__( 'All Teacher', 'univ' ),
		'search_items'       => esc_html__( 'Search Teacher', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Teacher:', 'univ' ),
		'not_found'          => esc_html__( 'No Teacher found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Teacher found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'     => 'dashicons-welcome-view-site',		
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_teacher' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','editor', 'thumbnail', 'excerpt','comments')
	);
	register_post_type( 'univ_teacher', $args );
	// post type teacher
	$labels = array(
		'name'              => _x( 'Teacher Categories', 'univ' ),
		'singular_name'     => _x( 'Teacher Category', 'univ' ),
		'search_items'      => esc_html__( 'Search Category' ),
		'all_items'         => esc_html__( 'All Category' ),
		'parent_item'       => esc_html__( 'Parent Category' ),
		'parent_item_colon' => esc_html__( 'Parent Category:' ),
		'edit_item'         => esc_html__( 'Edit Category' ),
		'update_item'       => esc_html__( 'Update Category' ),
		'add_new_item'      => esc_html__( 'Add New Category' ),
		'new_item_name'     => esc_html__( 'New Category Name' ),
		'menu_name'         => esc_html__( 'Teacher Category' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'teacher_category' ),
	);

	register_taxonomy('teacher_category','univ_teacher',$args);
	// Taxonomy teacher	
	}	
} // END if
add_action('init','register_layers_univ_teacher_type');













// =================================
// Portfolio post type
// =================================
if ( !post_type_exists('univ_gallery') ) {
	function register_layers_univ_gallery_type() {
	
	$labels = array(
		'name'               => _x( 'Portfolio', 'univ' ),
		'singular_name'      => _x( 'Portfolio', 'univ' ),
		'menu_name'          => _x( 'Portfolio', 'univ' ),
		'name_admin_bar'     => _x( 'Portfolio', 'univ' ),
		'add_new'            => _x( 'Add New Portfolio', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Portfolio', 'univ' ),
		'new_item'           => esc_html__( 'New Portfolio', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Portfolio', 'univ' ),
		'view_item'          => esc_html__( 'View Portfolio', 'univ' ),
		'all_items'          => esc_html__( 'All Portfolio', 'univ' ),
		'search_items'       => esc_html__( 'Search Portfolio', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'univ' ),
		'not_found'          => esc_html__( 'No Portfolio found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'     => 'dashicons-category',			
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_gallery' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title','editor', 'thumbnail')
	);
	register_post_type( 'univ_gallery', $args );
	// post type gallery	
	$labels = array(
		'name'              => _x( 'Gallery Categories', 'univ' ),
		'singular_name'     => _x( 'Gallery Category', 'univ' ),
		'search_items'      => esc_html__( 'Search Category' ),
		'all_items'         => esc_html__( 'All Category' ),
		'parent_item'       => esc_html__( 'Parent Category' ),
		'parent_item_colon' => esc_html__( 'Parent Category:' ),
		'edit_item'         => esc_html__( 'Edit Category' ),
		'update_item'       => esc_html__( 'Update Category' ),
		'add_new_item'      => esc_html__( 'Add New Category' ),
		'new_item_name'     => esc_html__( 'New Category Name' ),
		'menu_name'         => esc_html__( 'Gallery Category' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'gallery_category' ),
	);
	// Taxonomy gallery
	register_taxonomy('gallery_category','univ_gallery',$args);
	}	
} // END if
add_action('init','register_layers_univ_gallery_type');




// =================================
// testimonial post type
// =================================
if ( !post_type_exists('univ_testimonial') ) {
	function register_layers_univ_testimonial_type() {
	
	$labels = array(
		'name'               => _x( 'Testimonial', 'univ' ),
		'singular_name'      => _x( 'Testimonial', 'univ' ),
		'menu_name'          => _x( 'Testimonial', 'univ' ),
		'name_admin_bar'     => _x( 'Testimonial', 'univ' ),
		'add_new'            => _x( 'Add New Testimonial', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Testimonial', 'univ' ),
		'new_item'           => esc_html__( 'New Testimonial', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Testimonial', 'univ' ),
		'view_item'          => esc_html__( 'View Testimonial', 'univ' ),
		'all_items'          => esc_html__( 'All Testimonial', 'univ' ),
		'search_items'       => esc_html__( 'Search Testimonial', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Testimonial:', 'univ' ),
		'not_found'          => esc_html__( 'No Testimonial found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Testimonial found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'     => 'dashicons-format-status',		
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	// post type testimonial
	register_post_type( 'univ_testimonial', $args );	
	$labels = array(
		'name'              => _x( 'Testimonial Categories', 'univ' ),
		'singular_name'     => _x( 'Testimonial Category', 'univ' ),
		'search_items'      => esc_html__( 'Search Category' ),
		'all_items'         => esc_html__( 'All Category' ),
		'parent_item'       => esc_html__( 'Parent Category' ),
		'parent_item_colon' => esc_html__( 'Parent Category:' ),
		'edit_item'         => esc_html__( 'Edit Category' ),
		'update_item'       => esc_html__( 'Update Category' ),
		'add_new_item'      => esc_html__( 'Add New Category' ),
		'new_item_name'     => esc_html__( 'New Category Name' ),
		'menu_name'         => esc_html__( 'Testimonial Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'testimonial_category' ),
	);
	// Taxonomy testimonial
	register_taxonomy('testimonial_category','univ_testimonial',$args);;
	}	
} // END if
add_action('init','register_layers_univ_testimonial_type');


// =================================
// Pricing post type
// =================================
if ( !post_type_exists('univ_pricing') ) {
	function register_layers_univ_pricing_type() {
	
	$labels = array(
		'name'               => _x( 'Pricing', 'univ' ),
		'singular_name'      => _x( 'Pricing', 'univ' ),
		'menu_name'          => _x( 'Pricing', 'univ' ),
		'name_admin_bar'     => _x( 'Pricing', 'univ' ),
		'add_new'            => _x( 'Add New Pricing', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Pricing', 'univ' ),
		'new_item'           => esc_html__( 'New Pricing', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Pricing', 'univ' ),
		'view_item'          => esc_html__( 'View Pricing', 'univ' ),
		'all_items'          => esc_html__( 'All Pricing', 'univ' ),
		'search_items'       => esc_html__( 'Search Pricing', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Pricing:', 'univ' ),
		'not_found'          => esc_html__( 'No Pricing found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Pricing found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'     => 'dashicons-plus',		
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_pricing' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	// post type pricing
	register_post_type( 'univ_pricing', $args );	
	$labels = array(
		'name'              => _x( 'Pricing Categories', 'univ' ),
		'singular_name'     => _x( 'Pricing Category', 'univ' ),
		'search_items'      => esc_html__( 'Search Category' ),
		'all_items'         => esc_html__( 'All Category' ),
		'parent_item'       => esc_html__( 'Parent Category' ),
		'parent_item_colon' => esc_html__( 'Parent Category:' ),
		'edit_item'         => esc_html__( 'Edit Category' ),
		'update_item'       => esc_html__( 'Update Category' ),
		'add_new_item'      => esc_html__( 'Add New Category' ),
		'new_item_name'     => esc_html__( 'New Category Name' ),
		'menu_name'         => esc_html__( 'Pricing Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'pricing_category' ),
	);
	// Taxonomy Pricing
	register_taxonomy('pricing_category','univ_pricing',$args);;
	}	
} // END if
add_action('init','register_layers_univ_pricing_type');


// =================================
// Brand post type
// =================================
if ( !post_type_exists('univ_brand') ) {
	function register_layers_univ_brand_type() {
	
	$labels = array(
		'name'               => _x( 'Brand', 'univ' ),
		'singular_name'      => _x( 'Brand', 'univ' ),
		'menu_name'          => _x( 'Brand', 'univ' ),
		'name_admin_bar'     => _x( 'Brand', 'univ' ),
		'add_new'            => _x( 'Add New Brand', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Brand', 'univ' ),
		'new_item'           => esc_html__( 'New Brand', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Brand', 'univ' ),
		'view_item'          => esc_html__( 'View Brand', 'univ' ),
		'all_items'          => esc_html__( 'All Brand', 'univ' ),
		'search_items'       => esc_html__( 'Search Brand', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Brand:', 'univ' ),
		'not_found'          => esc_html__( 'No Brand found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Brand found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'     => 'dashicons-plus',		
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_brand' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	// post type pricing
	register_post_type( 'univ_brand', $args );	
	$labels = array(
		'name'              => _x( 'Pricing Categories', 'univ' ),
		'singular_name'     => _x( 'Pricing Category', 'univ' ),
		'search_items'      => esc_html__( 'Search Category' ),
		'all_items'         => esc_html__( 'All Category' ),
		'parent_item'       => esc_html__( 'Parent Category' ),
		'parent_item_colon' => esc_html__( 'Parent Category:' ),
		'edit_item'         => esc_html__( 'Edit Category' ),
		'update_item'       => esc_html__( 'Update Category' ),
		'add_new_item'      => esc_html__( 'Add New Category' ),
		'new_item_name'     => esc_html__( 'New Category Name' ),
		'menu_name'         => esc_html__( 'Pricing Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'brand_category' ),
	);
	// Taxonomy Pricing
	register_taxonomy('brand_category','univ_brand',$args);;
	}	
} // END if
add_action('init','register_layers_univ_brand_type');




// Feature post type
if ( !post_type_exists('univ_event') ) {
	function univ_upcoming_event() {

	$labels = array(
		'name'               => _x( 'Events', 'univ' ),
		'singular_name'      => _x( 'Event', 'univ' ),
		'menu_name'          => _x( 'Event', 'univ' ),
		'name_admin_bar'     => _x( 'Event', 'univ' ),
		'add_new'            => _x( 'Add New Event', 'About', 'univ' ),
		'add_new_item'       => esc_html__( 'Add New Event', 'univ' ),
		'new_item'           => esc_html__( 'New Event', 'univ' ),
		'edit_item'          => esc_html__( 'Edit Event', 'univ' ),
		'view_item'          => esc_html__( 'View Event', 'univ' ),
		'all_items'          => esc_html__( 'All Event', 'univ' ),
		'search_items'       => esc_html__( 'Search Event', 'univ' ),
		'parent_item_colon'  => esc_html__( 'Parent Event:', 'univ' ),
		'not_found'          => esc_html__( 'No Event found.', 'univ' ),
		'not_found_in_trash' => esc_html__( 'No Event found in Trash.', 'univ' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'univ' ),
		'public'             => true,
		'menu_icon'   => 'dashicons-calendar-alt',
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'univ_event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);
	// post type service
	register_post_type( 'univ_event', $args );

	$labels = array(
		'name'              => _x( 'Event Categories', 'univ' ),
		'singular_name'     => _x( 'Event Category', 'univ' ),
		'search_items'      => esc_html__( 'Search Category', 'univ' ),
		'all_items'         => esc_html__( 'All Category', 'univ' ),
		'parent_item'       => esc_html__( 'Parent Category', 'univ' ),
		'parent_item_colon' => esc_html__( 'Parent Category:', 'univ' ),
		'edit_item'         => esc_html__( 'Edit Category', 'univ' ),
		'update_item'       => esc_html__( 'Update Category', 'univ' ),
		'add_new_item'      => esc_html__( 'Add New Category', 'univ' ),
		'new_item_name'     => esc_html__( 'New Category Name', 'univ' ),
		'menu_name'         => esc_html__( 'Event Category', 'univ' ),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'event_category' ),
	);

	// Taxonomy Feature
	register_taxonomy('event_category','univ_event',$args);	
	
	}

} // END if
add_action('init','univ_upcoming_event');


