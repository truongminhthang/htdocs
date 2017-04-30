<?php
/* Create Custom Customizer Controls
* http://docs.layerswp.com/reference/layers_customizer_controls/
* @return $controls
*/
add_filter( 'layers_customizer_controls' , 'univ_color_customizer_sections', 100 );

if( !function_exists( 'univ_color_customizer_sections' ) ) {
	
   function univ_color_customizer_sections( $controls){
	  
		
      	$univ_color_controls = array(	
	  		'heading-title' => array(
				'type'  => 'layers-heading',
				'label'    => esc_html__( 'Theme Color Option' , 'univ' ),
				'description' => esc_html__( 'These options allow you to change the key colors of your website.' , 'univ' ),  
			),
	  		'theme-hover-menu-color' => array(
			'label' => '',
			'subtitle'		=> esc_html__( 'Sub Menu Hover Border Color' , 'univ' ),
			'description' => esc_html__( 'This affects change sub menu top border color.', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#1bb4b9',
			),				
	  		'theme-icon-color' => array(
			'label' => '',
			'subtitle'		=> esc_html__( 'Icon color' , 'univ' ),
			'description' => esc_html__( 'This affects all border color of your website.', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#1bb4b9',
			),
	  		'theme-icon-bar-color' => array(
			'label' => '',
			'subtitle'		=> esc_html__( 'Icon bar color' , 'univ' ),
			'description' => esc_html__( 'This affects all border color of your website.', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#1bb4b9',
			)			
		);
		
		
 
		$controls['site-colors'] = array_merge( $controls['site-colors'], $univ_color_controls );
	 
		return $controls;
	
    }
}

//output result	
add_action( 'wp_enqueue_scripts', 'univ_child_customizer_styles', 100 );

if( !function_exists( 'univ_child_customizer_styles' ) ) {
    function univ_child_customizer_styles() {
		$univ_controls_border_color = layers_get_theme_mod( 
            'theme-hover-menu-color' , 
             TRUE 
        );	
		$univ_controls_icon_color = layers_get_theme_mod( 
            'theme-icon-color' , 
             TRUE 
        );		
		$univ_controls_icon_bar_color = layers_get_theme_mod( 
            'theme-icon-bar-color' , 
             TRUE 
        );				
	
		
		// inline css 		
		if( '' != $univ_controls_icon_color || '' != $univ_controls_icon_bar_color) {

			
			layers_inline_styles( array(
			'selectors' => array('
			
			.sub-menu, .nav .children,
			.header-site.invert .sub-menu, .header-site .sub-menu
			
			'),
				'css' => array(
				'border-top-color' => $univ_controls_border_color,
				),
			  )		
			);			
			
			layers_inline_styles( array(
			'selectors' => array('				
			.icon-content .section-title::after, .section-title-wrapper::after
			
			'),
				'css' => array(
				'color' => $univ_controls_icon_color,
				),
			  )		
			);					
			layers_inline_styles( array(
			'selectors' => array('				
			
			.icon-content .section-title::before, .section-title-wrapper::before
			'),
				'css' => array(
				'background' => $univ_controls_icon_bar_color,
				),
			  )		
			);					

				
			
		} // End check condition function
	}// End function
} // End condition function