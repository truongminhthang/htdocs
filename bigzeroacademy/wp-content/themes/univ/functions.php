<?php 
/*
* Text Domain: univ
* Domain Path: /languages/
*/
 
// Setup constants.
define( 'UNIV_VERSION', '1.0.0' );

// include file
require_once( trailingslashit( get_stylesheet_directory() ). '/includes/presets.php' );
require_once( trailingslashit( get_stylesheet_directory() ). '/includes/customizer.php' );
require_once( trailingslashit( get_stylesheet_directory() ). '/includes/breadcrumb.php' );
require_once( trailingslashit( get_stylesheet_directory() ). '/includes/demo-import.php' );
require_once( trailingslashit( get_stylesheet_directory() ). '/includes/class-activation.php' );
require_once( trailingslashit( get_stylesheet_directory() ). '/includes/custom-footer.php' );

/**
 * Localize
 */
if (!function_exists('univ_localize')) {
	
	function univ_localize() {
		
		load_child_theme_textdomain('univ', get_stylesheet_directory() . '/languages');
	
	}
}
add_action('after_setup_theme', 'univ_localize');

/* Set Font and Theme Defaults*/
if( ! function_exists( 'univ_customizer_defaults' ) ) {	

	function univ_customizer_defaults( $defaults ){

	 $defaults = array(
		   'body-fonts' => 'Open Sans',
		   'form-fonts' => 'Raleway',
		   'header-menu-layout' => 'header-logo-left',
		   'header-background-color' => '#ffffff',
		   'site-accent-color' => '#f5b120',
		   'header-width' => 'layout-boxed',
		   'header-sticky' => '1',
		   'header-overlay' => '0',
		   'heading-fonts' => 'Raleway',	    	
		   'header-sticky-breakpoint' => '400',	     
		   'footer-sidebar-count' => '4',
		   'footer-background-color' => '#0095d9',
		   'footer-link-color' => '#FFF',
		   'footer-body-color' => '#FFF',
	 );

	 return $defaults;
	}
	
}
add_filter( 'layers_customizer_control_defaults', 'univ_customizer_defaults' );

/**
 *Register Fonts
*/
if(!function_exists('univ_fonts_url')){
	
	function univ_fonts_url(){
	 $fonts_url = '';
	 
	 /* Translators: If there are characters in your language that are not
	 * supported by Montserrat, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	 $montserrat = _x( 'on', 'Montserrat font: on or off', 'univ' );
	 $poppins = _x( 'on', 'Poppins font: on or off', 'univ' );
	 
	 if ( 'off' !== $montserrat ) {
	 $font_families = array();
	 if ( 'off' !== $montserrat ) {
	 $font_families[] = 'Montserrat:400,700';
	 }
	 if ( 'off' !== $poppins ) {
	 $font_families[] = 'Poppins:300,400,500,600,700';
	 }
	 $query_args = array(
	 'family' => urlencode( implode( '|', $font_families ) ),
	 'subset' => urlencode( 'latin,latin-ext' ),
	 );
	 $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	 }
	 return esc_url_raw( $fonts_url ); 
	}
	
}

/**
* Load Styles
*/
 
if( ! function_exists( 'univ_styles' ) ) {	

	function univ_styles() {	
	
		wp_enqueue_style( 'layers-font-awesome',
			get_template_directory_uri() . '/core/assets/plugins/font-awesome/font-awesome.min.css',
			array() 
		);
		wp_enqueue_style( 'univ-fonts', univ_fonts_url(), array(), UNIV_VERSION );
		wp_enqueue_style(
			'owl.carousel',
			get_stylesheet_directory_uri() . '/assets/css/owl.carousel.css',
			array(), UNIV_VERSION
		);
		wp_enqueue_style(
			'slick',
			get_stylesheet_directory_uri() . '/assets/css/slick.css',
			array(), UNIV_VERSION
		);
		wp_enqueue_style(
			'venobox',
			get_stylesheet_directory_uri() . '/assets/css/venobox/venobox.css',
			array(), UNIV_VERSION
		);
		wp_enqueue_style(
			'animate',
			get_stylesheet_directory_uri() . '/assets/css/animate.css',
			array(), UNIV_VERSION
		);
		wp_enqueue_style(
			'jquery-ui',
			get_stylesheet_directory_uri() . '/assets/css/jquery-ui.css',
			array(), UNIV_VERSION
		);
		
	}
	
}
add_action( 'wp_enqueue_scripts', 'univ_styles' );	
 
/**
* Load Scripts
*/	
if( ! function_exists( 'univ_scripts' ) ) {
		
	function univ_scripts() {
		
		wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/assets/js/vendor/modernizr-2.8.3.min.js', array('jquery'), '', true  );
		wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true  );
		wp_enqueue_script('imagesloadeds', get_stylesheet_directory_uri() . '/assets/js/imagesloaded.js', array('jquery'), '', true  );
		wp_enqueue_script('owl.carousel', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '', true  );
		wp_enqueue_script('counterup', get_stylesheet_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '', true  );
		wp_enqueue_script('jquery.mixitup', get_stylesheet_directory_uri() . '/assets/js/jquery.mixitup.js', array('jquery'), '', true  );
		wp_enqueue_script('venobox', get_stylesheet_directory_uri() . '/assets/js/venobox.min.js', array('jquery'), '', true  );
		wp_enqueue_script('waypoints', get_stylesheet_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '', true  );
		wp_enqueue_script('wow', get_stylesheet_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '', true  );
		wp_enqueue_script('plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.js', array('jquery'), '', true  );
		wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '', true  );
		wp_enqueue_script('scrollUp', get_stylesheet_directory_uri() . '/assets/js/jquery.scrollUp.min.js', array('jquery'), '', true  );
		
		wp_enqueue_script('textillate', get_stylesheet_directory_uri() . '/assets/js/jquery.textillate.js', array('jquery'), '', true  );
		wp_enqueue_script('lettering', get_stylesheet_directory_uri() . '/assets/js/jquery.lettering.js', array('jquery'), '', true  );
		wp_enqueue_script('fittext', get_stylesheet_directory_uri() . '/assets/js/jquery.fittext.js', array('jquery'), '', true  );
		
		wp_enqueue_script('univ-theme',	get_stylesheet_directory_uri() . '/assets/js/theme.js', array('jquery'), '', true  );
			
	}	
}
add_action('wp_enqueue_scripts', 'univ_scripts'); 
 
 
 
 
 
 /**
 * Univ widget js
 */
 if(!function_exists('univ_media_scripts')){
 function univ_media_scripts() {
  wp_enqueue_media();
  wp_enqueue_script('univ-uploader', get_stylesheet_directory_uri() .'/assets/js/univ_uploader.js', false, '', true );
 }
 }
add_action('admin_enqueue_scripts', 'univ_media_scripts');
 
 
 
 
 
 

/**
* Add Sub Menu Page to the Layers Menu Item
* http://docs.layerswp.com/how-to-add-help-pages-onboarding-to-layers-themes-or-extensions/
*/
if( ! function_exists('univ_register_submenu_page') ) {
	
	function univ_register_submenu_page(){
		add_submenu_page(
			'layers-dashboard',
			esc_html__('Univ Child Help' , 'univ'),
			esc_html__('Univ Documentation' , 'univ'),
			'edit_theme_options',			
			'layers-child-get-started',
			'univ_get_onboarding'
			
		);
	}
	
}

if( ! function_exists('univ_get_onboarding') ) {
	
	function univ_get_onboarding(){
		
		require_once get_stylesheet_directory() . '/includes/theme-help.php';

	}

}
add_action('admin_menu', 'univ_register_submenu_page', 60);
 
 
/**
* Welcome Redirect
* http://docs.layerswp.com/how-to-add-help-pages-onboarding-to-layers-themes-or-extensions/
*/
if( ! function_exists('univ_setup') ) {
	
	function univ_setup(){
		
		$adminlink = esc_url('admin.php?page=layers-child-get-started');
		
		if( isset($_GET["activated"]) && $pagenow = "themes.php" ) { //&& '' == get_option( 'layers_welcome' )
			update_option( 'layers_welcome' , 1);
			wp_safe_redirect( admin_url( $adminlink ));
		}
		
	}
	
}
add_action( 'after_setup_theme' , 'univ_setup', 20 );
 

// breadcume banner
if ( !function_exists('univ_brodcame') ) {
	
	 function univ_brodcame(){
		 
	   get_template_part( 'partials/header' , 'page-title' );
	   
	 }
	 
}
add_action('layers_after_header', 'univ_brodcame');

// Unset page templates inherited from the parent theme.
if(!function_exists('univ_theme_remove_page_template')){
	
	function univ_theme_remove_page_template( $page_templates ) {
				
		unset( $page_templates['template-left-sidebar.php'] );
		unset( $page_templates['template-right-sidebar.php'] );
		unset( $page_templates['template-both-sidebar.php'] );
		return $page_templates;	
	
	}
	
}
add_filter( 'theme_page_templates', 'univ_theme_remove_page_template' );
 

// Crop Thumbnails
if(!function_exists('univ_image_crop')){
	
	function univ_image_crop(){
		
		add_image_size( 'univ_blog_image', 387, 360, true ); 
		add_image_size( 'univ_ablog_image', 770, 400, true ); 
		add_image_size( 'univ_recent_image', 110, 73, true ); 
		add_image_size( 'univ_single_blog_image', 780, 430, true ); 
		add_image_size( 'univ_left_blog_image', 870, 400, true ); 
		add_image_size( 'univ_right_blog_image', 424, 260, true ); 
		add_image_size( 'univ_both_blog_image', 572, 310, true ); 
		add_image_size( 'univ_blog_widget_image', 376, 252, true ); 
		add_image_size( 'univ_dclass_image', 900, 500, true ); 
		add_image_size( 'univ_class_image', 375, 322, true );
		
	}
	
}
add_action('after_setup_theme', 'univ_image_crop');


/**
 * Prints Comment HTML
 *
 * @param    object          $comment        Comment objext
 * @param    array           $args           Configuration arguments.
 * @param    int             $depth          Current depth of comment, for example 2 for a reply
 * @echo     string                          Comment HTML
 */ 
if( !function_exists( 'univ_comment' ) ) {
	
	function univ_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;?>
	
		<li>
		<div class="grid comments-nested push-top">

			<div <?php comment_class( 'content well' ); ?> id="comment-<?php comment_ID(); ?>">
				
				<div class="avatar push-bottom clearfix">
					<?php edit_comment_link(esc_html__('(Edit)' , 'univ' ),'<small class="pull-right">','</small>') ?>
					<a class="avatar-image" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
						<?php echo get_avatar($comment, $size = '70'); ?>
					</a>
					<div class="avatar-body">
						<h5 class="avatar-name"><?php echo get_comment_author_link(); ?></h5>
						<small><?php printf(esc_html__('%1$s at %2$s' , 'univ' ), get_comment_date(),  get_comment_time()) ?></small>
					</div>
				</div>

				<div class="copy small">
					<?php if ($comment->comment_approved == '0') : ?>
						<em><?php esc_html_e('Your comment is awaiting moderation.' , 'univ' ) ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text() ?>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</div>

	<?php }
}


