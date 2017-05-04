<?php
/**
* Univ Extension
* http://docs.layerswp.com/create-an-extension-setup-your-plugin-class/#setup-class
*/
if( !class_exists( 'Univ_Layers_Extension' ) ) {
	class Univ_Layers_Extension {

		// Setup Instance
		
		private static $_instance=null;
		
		public static function get_instance() {
			if ( is_null( self::$_instance ) )
				
				self::$_instance = new Univ_Layers_Extension();

			return self::$_instance;
		}
		
		// Constructor		
		private function __construct() {							
		// Register custom widgets
		add_action( 'widgets_init' , array( $this, 'univ_register_widgets' ), 50 );	
		}

		// Register Widgets		
		public function univ_register_widgets(){
			
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-teacher.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/blog.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/portfolio.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/testimonial.php' );		  
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/slider.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-contact.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-classes.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-event.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-counter.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-get-in-touch.php' );
		  require_once( UNIV_LAYERS_EXTENSION_DIR. 'widgets/univ-course.php' );
		  
		  

		}
	
	} // END Class
	
} 
