<?php 

// Footer Social media Menu
if( !function_exists( 'hast_social_menu' ) ) {
function hast_social_menu(){
  register_nav_menu('hast-social-menu' ,'Footer Social Menu');
}}
add_action( 'after_setup_theme' , 'hast_social_menu' );


// Footer top styles
add_filter('layers_customizer_sections','layers_child_customizer_sections', 100);
add_filter( 'layers_customizer_controls', 'layers_child_customizer_controls', 100 );

if( !function_exists( 'layers_child_customizer_sections' ) ) {
   function layers_child_customizer_sections( $sections ){
      $sections[ 'hastech-footer-top' ] = array(
        'title' => esc_html__( 'Footer Top Styling' , 'univ' ),
        'panel' => 'footer',
      );
      return $sections;
   }
}


if( !function_exists( 'layers_child_customizer_controls' ) ) {
  function layers_child_customizer_controls( $controls ){
  	// Add Theme Badge
	$hast_badge='<span class="layers-control-title-marker">' . esc_html__( 'Hastech', 'univ' ) . '</span>';
    $controls[ 'hastech-footer-top' ] = array(

    	'footer-top-showhide' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Show Footer Top', 'univ' ),
			'class' => 'group',
			'default' => 'no',
			'choices' => array(
				'yes' => esc_html__( 'Yes', 'univ' ),
				'no' => esc_html__( 'no', 'univ' ),
			),
		),

		'social_separetor_foo_top5' => array(
			'type'		=> 'layers-seperator'
		),
		'show-foo-top-logo' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Show logo', 'univ' ),
			'class' => 'group',
			'default' => 'yes',
			'choices' => array(
				'yes' => esc_html__( 'Yes', 'univ' ),
				'no' => esc_html__( 'no', 'univ' ),
			),
		),
		'the_custom_footer_top_logo' => array(
			'label' => esc_html__('Upload your logo', 'univ'),
			'type'		=> 'layers-select-images',
			'linked' => array(
				'show-if-selector' => "#layers-show-foo-top-logo",
				'show-if-value' => 'yes',
			),

		),
		'footer-top-logo-size' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Logo Size', 'univ' ),
			'class' => 'group layers-push-top',
			'choices' => array(
				'' => esc_html__( 'Auto', 'univ' ),
				'small' => esc_html__( 'Small', 'univ' ),
				'medium' => esc_html__( 'Medium', 'univ' ),
				'large' => esc_html__( 'Large', 'univ' ),
				'massive' => esc_html__( 'Massive', 'univ' ),
				'custom' => esc_html__( 'Custom', 'univ' ),
			),
			'linked' => array(
				'show-if-selector' => "#layers-show-foo-top-logo",
				'show-if-value' => 'yes',
			),
		),
		'footer-top-logo-size-custom' => array(
			'type'  => 'layers-range',
			'label' => esc_html__( 'Logo Custom Size', 'univ' ),
			'class' => 'group',
			'min' => 1,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-footer-top-logo-size",
				'show-if-value' => 'custom',
			),
		),
		'footer-top-logo-padding-top' => array(
			'type'  => 'layers-range',
			'label' => esc_html__( 'Padding Top (px)', 'univ' ),
			'class' => 'group',
			'default' => 10,
			'min' => 1,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-show-foo-top-logo",
				'show-if-value' => 'yes',
			),
		),
		'footer-top-logo-padding-bottom' => array(
			'type'  => 'layers-range',
			'label' => esc_html__( 'Padding Bottom (px)', 'univ' ),
			'class' => 'group',
			'default' => 10,
			'min' => 1,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-show-foo-top-logo",
				'show-if-value' => 'yes',
			),
		),


		'social_separetor_foo_top4' => array(
			'type'		=> 'layers-seperator'
		),
      	'foo-top-single-info11' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Information Type', 'univ' ),
			'class' => 'group',
			'default' => '',
			'choices' => array(
				'' => esc_html__( 'None', 'univ' ),
				'text' => esc_html__( 'Plain Text', 'univ' ),
				'email' => esc_html__( 'Email', 'univ' ),
				'phone' => esc_html__( 'Phone', 'univ' ),
			),
		),
      	// text choose
		'foo-top-single-info1-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'map-marker',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'text',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single-info1-value' => array(
			'type'  => 'layers-rte',
			'label' => esc_html__( 'Insert Your Text', 'univ' ),
			'class' => 'text',
			'default' => esc_html__( 'Floor. 4 House. 15, Block C Banasree Main Rd, Dhaka.', 'univ' ),
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'text',
			),
		),
		// email choose 
		'foo-top-single-info2-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'envelope',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'email',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single-info2-value' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Insert Your Email', 'univ' ),
			'class' => 'text',
			'default' => 'admin@hastech.company',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'email',
			),
		),
		// phone choose 
		'foo-top-single-info3-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'phone',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'phone',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single-info3-value-cc' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Insert Your Country Code', 'univ' ),
			'class' => 'text',
			'default' => '+880',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'phone',
			),
		),
		'foo-top-single-info3-value' => array(
			'type'  => 'layers-number',
			'label' => esc_html__( 'Insert Your Phone Number', 'univ' ),
			'class' => 'text',
			'default' => 1973833508,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single-info11",
				'show-if-value' => 'phone',
			),
		),
		'social_separetor_foo_top1' => array(
			'type'		=> 'layers-seperator'
		),
		// Start footer top 2nd information
      	'foo-top-single2-info22' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Information Type', 'univ' ),
			'class' => 'group ',
			'default' => '',
			'choices' => array(
				'' => esc_html__( 'None', 'univ' ),
				'text' => esc_html__( 'Plain Text', 'univ' ),
				'email' => esc_html__( 'Email', 'univ' ),
				'phone' => esc_html__( 'Phone', 'univ' ),
			),
		),
      	// text choose
		'foo-top-single2-info1-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'map-marker',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'text',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single2-info1-value' => array(
			'type'  => 'layers-rte',
			'label' => esc_html__( 'Insert Your Text', 'univ' ),
			'class' => 'text',
			'default' => esc_html__( 'Floor. 4 House. 15, Block C Banasree Main Rd, Dhaka.', 'univ' ),
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'text',
			),
		),
		// email choose 
		'foo-top-single2-info2-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'envelope',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'email',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single2-info2-value' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Insert Your Email', 'univ' ),
			'class' => 'text',
			'default' => 'admin@hastech.company',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'email',
			),
		),
		// phone choose 
		'foo-top-single2-info3-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'mobile',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'phone',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single2-info3-value-cc' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Insert Your Country Code', 'univ' ),
			'class' => 'text',
			'default' => '+880',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'phone',
			),
		),
		'foo-top-single2-info3-value' => array(
			'type'  => 'layers-number',
			'label' => esc_html__( 'Insert Your Phone Number', 'univ' ),
			'class' => 'text',
			'default' => 1973833508,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single2-info22",
				'show-if-value' => 'phone',
			),
		),
		'social_separetor_foo_top2' => array(
			'type'		=> 'layers-seperator'
		),
		// Start footer top 3nd information
      	'foo-top-single3-info33' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Information Type', 'univ' ),
			'class' => 'group ',
			'default' => '',
			'choices' => array(
				'' => esc_html__( 'None', 'univ' ),
				'text' => esc_html__( 'Plain Text', 'univ' ),
				'email' => esc_html__( 'Email', 'univ' ),
				'phone' => esc_html__( 'Phone', 'univ' ),
			),
		),
      	// text choose
		'foo-top-single3-info1-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'map-marker',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'text',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single3-info1-value' => array(
			'type'  => 'layers-rte',
			'label' => esc_html__( 'Insert Your Text', 'univ' ),
			'class' => 'text',
			'default' => esc_html__( 'Floor. 4 House. 15, Block C Banasree Main Rd, Dhaka.', 'univ' ),
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'text',
			),
		),

		// email choose 
		'foo-top-single3-info2-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'envelope',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'email',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single3-info2-value' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Insert Your Email', 'univ' ),
			'class' => 'text',
			'default' => 'admin@hastech.company',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'email',
			),
		),

		// phone choose 
		'foo-top-single3-info3-icon' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Icon Name', 'univ' ),
			'class' => 'text',
			'default' => 'mobile',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'phone',
			),
			'description' => __( 'You want more icons <a  href="http://fontawesome.io/icons" target="_blank">Click here</a>.', 'univ' ),
		),
		'foo-top-single3-info3-value-cc' => array(
			'type'  => 'layers-text',
			'label' => esc_html__( 'Insert Your Country Code', 'univ' ),
			'class' => 'text',
			'default' => '+880',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'phone',
			),
		),
		'foo-top-single3-info3-value' => array(
			'type'  => 'layers-number',
			'label' => esc_html__( 'Insert Your Phone Number', 'univ' ),
			'class' => 'text',
			'default' => 1973833508,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-single3-info33",
				'show-if-value' => 'phone',
			),
		),


		'separetor_foo_top77' => array(
			'type'		=> 'layers-seperator'
		),
		
		'foo-top-information-option' => array(
			'type'  => 'layers-heading',
			'label' => esc_html__('Information Customize Option', 'univ') .$hast_badge,
			'description' => esc_html__( 'Customize options for your footer top information settings.' , 'univ' ),
			
		),
		'foo-top-information-option-set' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Information Design', 'univ' ),
			'class' => 'group',
			'default' => '',
			'choices' => array(
				'' => esc_html__( 'Default Style', 'univ' ),
				'ftcustomize' => esc_html__( 'Custom Style', 'univ' ),
			),
		),
		'foo-top-information-font-size' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Font size (px)' , 'univ' ),
			'default' => 14,
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-information-option-set",
				'show-if-value' => 'ftcustomize',
			),
		),
		'foo-top-information-font-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Text Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-information-option-set",
				'show-if-value' => 'ftcustomize',
			),
		),
		'foo-top-information-font-transform' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Text Transform', 'univ' ),
			'class' => 'group',
			'default' => 'none',
			'choices' => array(
				'none' => esc_html__( 'None', 'univ' ),
				'capitalize' => esc_html__( 'Capitalize', 'univ' ),
				'uppercase' => esc_html__( 'Uppercase', 'univ' ),
				'lowercase' => esc_html__( 'Lowercase', 'univ' ),
				'full-width' => esc_html__( 'Full-width', 'univ' ),
				'inherit' => esc_html__( 'Inherit', 'univ' ),
				'initial' => esc_html__( 'Initial', 'univ' ),
				'unset' => esc_html__( 'Unset', 'univ' ),
			),
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-information-option-set",
				'show-if-value' => 'ftcustomize',
			),
		),
		'foo-top-information-display' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Icon Position', 'univ' ),
			'class' => 'group',
			'default' => 'inline',
			'choices' => array(
				'inline' => esc_html__( 'Icon on Left', 'univ' ),
				'block' => esc_html__( 'Icon on Top', 'univ' ),
			),
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-information-option-set",
				'show-if-value' => 'ftcustomize',
			),
		),
		'foo-top-information-display-imb' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Icon Size (px)' , 'univ' ),
			'default' => 14,
			'min' => 0,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-information-display",
				'show-if-value' => 'block',
			),
		),
		'foo-top-information-display-fmb' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Margin Bottom (px)' , 'univ' ),
			'default' => 10,
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-information-display",
				'show-if-value' => 'block',
			),
		),





		'separetor_foo_top777' => array(
			'type'		=> 'layers-seperator'
		),

		'foo-top-styleing-option' => array(
			'type'  => 'layers-heading',
			'label' => esc_html__('Footer Top Setting', 'univ') .$hast_badge,
			'description' => esc_html__( 'Customize options for your footer top settings.' , 'univ' ),
			
		),
		'separetor_foo_top7' => array(
			'type'		=> 'layers-seperator'
		),
		'foo-top-content-alignment' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Content Alignment', 'univ' ),
			'class' => 'group ',
			'default' => 'text-center',
			'choices' => array(
				'text-left' => esc_html__( 'Left', 'univ' ),
				'text-center' => esc_html__( 'Center', 'univ' ),
				'text-right' => esc_html__( 'Right', 'univ' ),
			),
		),
		'foo-top-background-type' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Background Type', 'univ' ),
			'class' => 'group ',
			'default' => 'ftbcolor',
			'choices' => array(
				'' => esc_html__( 'None', 'univ' ),
				'ftbcolor' => esc_html__( 'Background Color', 'univ' ),
				'ftbimage' => esc_html__( 'Background Image', 'univ' ),
			),
		),
		'foo-top-background-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Background Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-background-type",
				'show-if-value' => 'ftbcolor',
			),
		),
		
		'foo-top-background-image' => array(
			'label' => esc_html__('Upload Background Image', 'univ'),
			'type'		=> 'layers-select-images',
			'default'		=> '',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-background-type",
				'show-if-value' => 'ftbimage',
			),
		),
		'foo-top-background-overlay-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Overlay Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-background-type",
				'show-if-value' => 'ftbimage',
			),
		),
		'foo-top-background-overlay-opacity' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Overlay Opacity' , 'univ' ),
			'default' => 5,
			'min' => 0,
			'max' => 10,
			'step' => 1,

			'linked' => array(
				'show-if-selector' => "#layers-foo-top-background-type",
				'show-if-value' => 'ftbimage',
			),
		),


		// basic setting


		'foo-top-padding-margin-option' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Padding / Margin', 'univ' ),
			'class' => 'group ',
			'default' => '',
			'choices' => array(
				'' => esc_html__( 'Default Option', 'univ' ),
				'footoppaddingmargin' => esc_html__( 'Custom Option', 'univ' ),
			),
		),
		'foo-top-padding-option-top' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Padding Top (px)' , 'univ' ),
			'default' => 50,
			'min' => 0,
			'max' => 250,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-padding-margin-option",
				'show-if-value' => 'footoppaddingmargin',
			),
		),
		'foo-top-padding-option-bottom' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Padding Bottom (px)' , 'univ' ),
			'default' => 50,
			'min' => 0,
			'max' => 250,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-padding-margin-option",
				'show-if-value' => 'footoppaddingmargin',
			),
		),
		// Margin option
		'foo-top-margin-option-top' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Margin Top (px)' , 'univ' ),
			'default' => 50,
			'min' => 0,
			'max' => 250,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-padding-margin-option",
				'show-if-value' => 'footoppaddingmargin',
			),
		),
		'foo-top-margin-option-bottom' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Margin Bottom (px)' , 'univ' ),
			'default' => 50,
			'min' => 0,
			'max' => 250,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-foo-top-padding-margin-option",
				'show-if-value' => 'footoppaddingmargin',
			),
		),

    );
    return $controls;
  }
}













// Footer Standard styles
add_filter('layers_customizer_sections','layers_child_customizer_sections_foo_standard', 100);
add_filter( 'layers_customizer_controls', 'layers_child_customizer_controls_foo_standard', 100 );

if( !function_exists( 'layers_child_customizer_sections_foo_standard' ) ) {
   function layers_child_customizer_sections_foo_standard( $sections ){
      $sections[ 'hastech-footer-standard' ] = array(
        'title' => esc_html__( 'Footer Styling' , 'univ' ),
        'panel' => 'footer',
      );
      return $sections;
   }
}

if( !function_exists( 'layers_child_customizer_controls_foo_standard' ) ) {
  function layers_child_customizer_controls_foo_standard( $controls ){
 	 	// Add Theme Badge
	$hast_badge='<span class="layers-control-title-marker">' . esc_html__( 'Hastech', 'univ' ) . '</span>';
    $controls[ 'hastech-footer-standard' ] = array(
      	// Footer top start

		'hastech_option_title1' => array(
			'type'  => 'layers-heading',
			'label' => esc_html__('Footer Setting', 'univ') .$hast_badge,
			'description' => esc_html__( 'Customize options for your footer settings.' , 'univ' ),
			
		),
		'hastech_footer_top_widget_title' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Widget Title Color' , 'univ' ),
			'default' => '#fff',
		),
		'hastech_footer_top_widget_content_color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Widget Content Color' , 'univ' ),
			'default' => '#fff',
		),
		'hastech_footer_top_widget_title_font_size' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Widget Title font size' , 'univ' ),
			'default' => 14,
			'max' => 100,
			'min' => 0,
		),


		'foo-background-type' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Background Type', 'univ' ),
			'class' => 'group',
			'default' => 'foobcolor',
			'choices' => array(
				'' => esc_html__( 'None', 'univ' ),
				'foobcolor' => esc_html__( 'Background Color', 'univ' ),
				'foobimage' => esc_html__( 'Background Image', 'univ' ),
			),
		),
		'foo-background-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Background Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-foo-background-type",
				'show-if-value' => 'foobcolor',
			),
		),
		
		'foo-background-image' => array(
			'label' => esc_html__('Upload Background Image', 'univ'),
			'type'		=> 'layers-select-images',
			'default'		=> '',
			'linked' => array(
				'show-if-selector' => "#layers-foo-background-type",
				'show-if-value' => 'foobimage',
			),
		),
		'foo-background-overlay-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Overlay Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-foo-background-type",
				'show-if-value' => 'foobimage',
			),
		),
		'foo-background-overlay-opacity' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Overlay Opacity' , 'univ' ),
			'default' => 5,
			'min' => 0,
			'max' => 10,
			'step' => 1,

			'linked' => array(
				'show-if-selector' => "#layers-foo-background-type",
				'show-if-value' => 'foobimage',
			),
		),

		'hastech_top_footer_top_padding' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Padding Top' , 'univ' ),
			'default' => 30,
			'max' => 250,
			'min' => 0,
		),
		'hastech_top_footer_bottom_padding' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Padding Bottom' , 'univ' ),
			'default' => 20,
			'max' => 250,
			'min' => 0,
		),
		'hastech_top_footer_top_margin' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Margin Top' , 'univ' ),
			'default' => 0,
			'max' => 200,
			'min' => 0,
			'step' => 1,
		),
		'hastech_top_footer_bottom_margin' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Margin Bottom' , 'univ' ),
			'default' => 0,
			'max' => 200,
			'min' => 0,
			'step' => 1,
		),
    );
    return $controls;
  }
}






// Footer bottom styles
add_filter('layers_customizer_sections','layers_child_customizer_sections_foo_bottom', 100);
add_filter( 'layers_customizer_controls', 'layers_child_customizer_controls_foo_bottom', 100 );

if( !function_exists( 'layers_child_customizer_sections_foo_bottom' ) ) {
   function layers_child_customizer_sections_foo_bottom( $sections ){
      $sections[ 'hastech-footer-bottom' ] = array(
        'title' => esc_html__( 'Copyright Styling' , 'univ' ),
        'panel' => 'footer',
      );
      return $sections;
   }
}

if( !function_exists( 'layers_child_customizer_controls_foo_bottom' ) ) {
  function layers_child_customizer_controls_foo_bottom( $controls ){
 
 	// Add Theme Badge
	$hast_badge='<span class="layers-control-title-marker">' . esc_html__( 'Hastech', 'univ' ) . '</span>';
    $controls[ 'hastech-footer-bottom' ] = array(
		// Footer bottom start
		'hastech_option_title2' => array(
			'label' => esc_html__('Copyright Setting', 'univ') .$hast_badge,
			'description' => esc_html__( 'Customize options for your copyright section settings.' , 'univ' ),  
			'type'  => 'layers-heading',
		),

		'copyrightstyle' => array(
			'type'     => 'layers-select',
			'heading_divider'    => esc_html__( 'Copyright Style' , 'univ' ),
			'default' => 'ht-copyright-s1',
			'sanitize_callback' => FALSE,
			'choices' => array(
				'ht-copyright-s1' => esc_html__( 'Style 1' , 'univ' ),
				'ht-copyright-s2' => esc_html__( 'Style 2' , 'univ' ),
				'ht-copyright-s3' => esc_html__( 'Style 3' , 'univ' ),
				'ht-copyright-s4' => esc_html__( 'Style 4' , 'univ' ),
				'ht-copyright-s5' => esc_html__( 'Style 5' , 'univ' ),
				'ht-copyright-s6' => esc_html__( 'Style 6' , 'univ' ),
				'ht-copyright-s7' => esc_html__( 'Style 7' , 'univ' ),
				'ht-copyright-s8' => esc_html__( 'Style 8' , 'univ' ),
				'ht-copyright-s9' => esc_html__( 'Style 9' , 'univ' ),
				'ht-copyright-s10' => esc_html__( 'Style 10' , 'univ' ),
				'ht-copyright-s11' => esc_html__( 'Style 11' , 'univ' ),
				'ht-copyright-s12' => esc_html__( 'Style 12' , 'univ' ),
				'ht-copyright-s13' => esc_html__( 'Style 13' , 'univ' ),
			),
		),
		'footer_content_alignment' => array(
			'type'     => 'layers-select',
			'heading_divider'    => esc_html__( 'Content Align' , 'univ' ),
			'default' => 'text-center',
			'sanitize_callback' => FALSE,
			'choices' => array(
				'text-left' => esc_html__( 'Left' , 'univ' ),
				'text-right' => esc_html__( 'Right' , 'univ' ),
				'text-center' => esc_html__( 'Center' , 'univ' ),
			),
		),



		'copyright-background-type' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Select Background Type', 'univ' ),
			'class' => 'group',
			'default' => 'copybcolor',
			'choices' => array(
				'' => esc_html__( 'None', 'univ' ),
				'copybcolor' => esc_html__( 'Background Color', 'univ' ),
				'copybimage' => esc_html__( 'Background Image', 'univ' ),
			),
		),
		'copyright-background-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Background Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-copyright-background-type",
				'show-if-value' => 'copybcolor',
			),
		),
		'copyright-background-image' => array(
			'label' => esc_html__('Upload Background Image', 'univ'),
			'type'		=> 'layers-select-images',
			'default'		=> '',
			'linked' => array(
				'show-if-selector' => "#layers-copyright-background-type",
				'show-if-value' => 'copybimage',
			),
		),
		'copyright-background-overlay-color' => array(
			'type'     => 'layers-color',
			'label'    => esc_html__( 'Overlay Color' , 'univ' ),
			'default' => '#2b2b2b',
			'linked' => array(
				'show-if-selector' => "#layers-copyright-background-type",
				'show-if-value' => 'copybimage',
			),
		),
		'copyright-background-overlay-opacity' => array(
			'type'     => 'layers-range',
			'label'    => esc_html__( 'Overlay Opacity' , 'univ' ),
			'default' => 5,
			'min' => 0,
			'max' => 10,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-copyright-background-type",
				'show-if-value' => 'copybimage',
			),
		),

		'custom_footer_padding_top' => array(
			'label' => esc_html__('Padding Top', 'univ'), 
			'type'		=> 'layers-range',
			'default' => 0,
			'max' => 250,
			'min' => 0,
			'step' => 1,
		),
		'custom_footer_padding_bottom' => array(
			'label' => esc_html__('Padding Bottom', 'univ'),
			'type'		=> 'layers-range',
			'default' => 30,
			'max' => 250,
			'min' => 0,
			'step' => 1
		),
		'custom_footer_margin_top' => array(
			'label' => esc_html__('Margin Top', 'univ'),
			'type'		=> 'layers-range',
			'default' => 0,
			'max' => 250,
			'min' => 0,
			'step' => 1
		),
		'custom_footer_margin_bottom' => array(
			'label' => esc_html__('Margin Bottom', 'univ'),
			'type'		=> 'layers-range',
			'default' => 0,
			'max' => 250,
			'min' => 0,
			'step' => 1
		),
  		'social_separetor8' => array(
			'type'		=> 'layers-seperator'
		),
  		// Footer bottom end
		'show_foo_logo' => array(
			'label' => esc_html__('Show footer logo', 'univ') .$hast_badge,
			'type'		=> 'layers-checkbox',
			'default' => true
		),
		'the_custom_footer_logo' => array(
			'label' => esc_html__('Upload your logo', 'univ'),
			'type'		=> 'layers-select-images',
		),
		'footer-logo-size' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Logo Size', 'univ' ),
			'class' => 'group layers-push-top',
			'choices' => array(
				'' => esc_html__( 'Auto', 'univ' ),
				'small' => esc_html__( 'Small', 'univ' ),
				'medium' => esc_html__( 'Medium', 'univ' ),
				'large' => esc_html__( 'Large', 'univ' ),
				'massive' => esc_html__( 'Massive', 'univ' ),
				'custom' => esc_html__( 'Custom', 'univ' ),
			),
		),
		'footer-logo-size-custom' => array(
			'type'  => 'layers-range',
			'label' => esc_html__( 'Logo Custom Size', 'univ' ),
			'class' => 'group',
			'min' => 1,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-footer-logo-size",
				'show-if-value' => 'custom',
			),
		),
		'social_separetor6' => array(
			'type'		=> 'layers-seperator'
		),


  		'heading-title' => array(
			'type'  => 'layers-heading',
			'label'    => esc_html__( 'Social Option' , 'univ' ) .$hast_badge,
			'description' => esc_html__( 'Design Option to change the styles and appearance of your social icons.' , 'univ' ),  
		),
  		'social_separetor3' => array(
			'type'		=> 'layers-seperator'
		),
		'show_footer_social' => array(
			'label' => esc_html__('Show Social media', 'univ' ),
			'type'		=> 'layers-checkbox',
			'default' => true,
		),
		'footer_social_icon_color' => array(
			'label' => esc_html__('Icon Color', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#666',
		),
		'footer_social_icon_hover_color' => array(
			'label' => esc_html__('Hover Color', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#fff',
		),
		'footer_social_icon_bg_color' => array(
			'label' => esc_html__('background', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '',
		),
		'footer_social_icon_bg_hover_color' => array(
			'label' => esc_html__('Hover background', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#1879FD',
		),
		'footer_social_icon_border_color' => array(
			'label' => esc_html__('Border Color', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#f3f3f3',
		),
		'footer_social_icon_border_hover_color' => array(
			'label' => esc_html__('Border Hover Color', 'univ' ),
			'type'		=> 'layers-color',
			'default'	=> '#1879fd',
		),
		'footer_social_icon_font_size' => array(
			'label' => esc_html__('Font Size (px)', 'univ' ),
			'type'		=> 'layers-range',
			'default'	=> 25,
			'max'	=> 50,
			'min'	=> 5,
		),
		'footer_social_icon_width' => array(
			'label' => esc_html__('Icon width (px)', 'univ' ),
			'type'		=> 'layers-range',
			'default'	=> 40,
			'max'	=> 80,
			'min'	=> 10,
		),
		'footer_social_icon_border_size' => array(
			'label' => esc_html__('Border size (px)', 'univ' ),
			'type'		=> 'layers-range',
			'default' => 1,
			'max' => 10,
			'min' => 0
		),
		'footer_social_icon_rounded_size' => array(
			'label' => esc_html__('Rounded Corner Size (%)', 'univ' ),
			'type'		=> 'layers-range',
			'default' => 10,
			'max' => 100,
			'min' => 0
		),
		'footer_social_menu_link_spacing' => array(
			'label' => esc_html__('Link Spacing (px)', 'univ' ),
			'type'		=> 'layers-range',
			'default'	=> 15,
			'max'	=> 100,
			'min'	=> 0,
			'step'	=> 1
		),

  		// Footer bottom end
		'social_separetor66' => array(
			'type'		=> 'layers-seperator'
		),
		'payment-heading-title' => array(
			'type'  => 'layers-heading',
			'label'    => esc_html__( 'Credit Cards Option' , 'univ' ) .$hast_badge,
			'description' => esc_html__( 'Customize options for your payment section settings. ' , 'univ' ),  
		),
		'social_separetor5' => array(
			'type'		=> 'layers-seperator'
		),
		'show_foo_payment_icon' => array(
			'label' => esc_html__('Show Credit Cards', 'univ'),
			'type'		=> 'layers-checkbox',
			'default' => true
		),
		'the_custom_credit_cards' => array(
			'label' => esc_html__('Upload your Credit', 'univ'),
			'type'		=> 'layers-select-images',
			'default'		=> '',

		),
		'the-custom-credit-cards-size' => array(
			'type'  => 'layers-select',
			'label' => esc_html__( 'Credit Cards Size', 'univ' ),
			'class' => 'group layers-push-top',
			'choices' => array(
				'' => esc_html__( 'Auto', 'univ' ),
				'small' => esc_html__( 'Small', 'univ' ),
				'medium' => esc_html__( 'Medium', 'univ' ),
				'large' => esc_html__( 'Large', 'univ' ),
				'massive' => esc_html__( 'Massive', 'univ' ),
				'custom' => esc_html__( 'Custom', 'univ' ),
			),
		),
		'the-custom-credit-cards-size-custom' => array(
			'type'  => 'layers-range',
			'label' => esc_html__( 'Custom Size', 'univ' ),
			'class' => 'group',
			'min' => 1,
			'max' => 200,
			'step' => 1,
			'linked' => array(
				'show-if-selector' => "#layers-the-custom-credit-cards-size",
				'show-if-value' => 'custom',
			),
		),

		// Copyright text
		'social_separetor33' => array(
			'type'		=> 'layers-seperator'
		),
		
		'footer-menu-area' => array(
			'type'  => 'layers-heading',
			'label'    => esc_html__( 'Footer Menu style' , 'univ' ) .$hast_badge,
			'description' => esc_html__( 'Customize options for your footer menu style. ' , 'univ' ),  
		),
		'social_separetor44' => array(
			'type'		=> 'layers-seperator'
		),
		'show-footer-menu' => array(
			'label' => esc_html__('Show Footer Menu', 'univ'),
			'type'		=> 'layers-checkbox',
			'default' => true
		),
		'footer-menu-font-size' => array(
			'label' => esc_html__('Font Size', 'univ' ),
			'type'		=> 'layers-range',
			'default'	=> 12,
			'max'	=> 40,
			'min'	=> 0,
			'step'	=> 1
		),
		'footer-menu-text-color' => array(
			'label' => esc_html__('Text color', 'univ'),
			'type'		=> 'layers-color',
			'default'	=> '#f1f1f1',
		),
		'footer-menu-hover-text-color' => array(
			'label' => esc_html__('Hover Text color', 'univ'),
			'type'		=> 'layers-color',
			'default'	=> '#f1f1f1',
		),
		'footer-menu-hover-text-color' => array(
			'label' => esc_html__('Hover Text color', 'univ'),
			'type'		=> 'layers-color',
			'default'	=> '#f1f1f1',
		),
		'footer-menu-text-transform' => array(
			'type'     => 'layers-select',
			'heading_divider'    => esc_html__( 'Text Transform' , 'univ' ),
			'default' => 'normal',
			'sanitize_callback' => FALSE,
			'choices' => array(
				'normal' => esc_html__( 'Normal' , 'univ' ),
				'uppercase' => esc_html__( 'Uppercase' , 'univ' ),
				'capitalize' => esc_html__( 'Capitalize' , 'univ' ),
				'lowercase' => esc_html__( 'Lowercase' , 'univ' ),
			),
		),
		'footer-menu-link-spacing' => array(
			'label' => esc_html__('Link Spacing', 'univ' ),
			'type'		=> 'layers-range',
			'default'	=> 25,
			'max'	=> 100,
			'min'	=> 0,
			'step'	=> 1
		),
    );
    return $controls;
  }
}



// Costomizer API layers
add_filter( 'layers_customizer_controls' , 'hastech_customizer_footer_sections', 100 );
if( !function_exists( 'hastech_customizer_footer_sections' ) ) {
   function hastech_customizer_footer_sections( $controls){
	
   		// Unset footer default style
	   	unset($controls['footer-layout']['show-layers-badge']);
	   	unset($controls['footer-layout']['header-position-styling']);
	   	unset($controls['footer-layout']['footer-background-color']);
	   	unset($controls['footer-layout']['footer-height']);

	   	// Add Theme Badge
		$hast_badge='<span class="layers-control-title-marker">' . esc_html__( 'Hastech', 'univ' ) . '</span>';

      	$hastech_controls = array(

      		'footer-copyright-text' => array(
				'type'     => 'layers-text',
				'label'    => esc_html__( 'Copyright Text' , 'univ' ),
				'default' => esc_html__( 'Made at the tip of Bangladesh. &copy;' , 'univ' ),
				'sanitize_callback' => FALSE
			),
      		// Start copy right option
	  		'heading-title-copyright' => array(
				'type'  => 'layers-heading',
				'label'    => esc_html__( 'Copyright text Setting' , 'univ' ) .$hast_badge,
				'description' => esc_html__( 'Change the font size and color of your copyright test.' , 'univ' ),  
			),
			'footer_font_size' => array(
				'label' => esc_html__('Font Size', 'univ' ),
				'type'		=> 'layers-range',
				'default'	=> 14,
				'max'	=> 30,
				'min'	=> 5,
			),
	  		'footer_text_color' => array(
				'label' => esc_html__('Copyright color', 'univ'),
				'type'		=> 'layers-color',
				'default'	=> '#7a9757',
			),
	  		// end copy right option
	  		
		);

    $controls['footer-layout'] = array_merge( $controls['footer-layout'], $hastech_controls );
 
    return $controls;
    }
}


//output result	
add_action( 'wp_enqueue_scripts', 'hastech_child_customizer_styles', 100 );

if( !function_exists( 'hastech_child_customizer_styles' ) ) {
	
    function hastech_child_customizer_styles() {
    	// Add Theme Badge
		$hast_badge='<span class="layers-control-title-marker">' . esc_html__( 'Hastech', 'univ' ) . '</span>';
		/**
		 * Footer - information
		 */
		$foo_top_info_font_size = layers_get_theme_mod( 'foo-top-information-font-size');
		$foo_top_info_design_option = layers_get_theme_mod( 'foo-top-information-option-set');
		
		if ( 'ftcustomize' === $foo_top_info_design_option && '' !== $foo_top_info_font_size ) {
			// Apply Styles.
			layers_inline_styles( '.footer-top-info .info-sin, .footer-top-info .info-sin a, .footer-top-info .info-sin a i', array( 'css' => array(
				'font-size'    => "{$foo_top_info_font_size}"."px",
			) ) );
		}

		$foo_top_info_transform = layers_get_theme_mod( 'foo-top-information-font-transform');
		
		if ( 'ftcustomize' === $foo_top_info_design_option && '' !== $foo_top_info_transform ) {
			// Apply Styles.
			layers_inline_styles( '.footer-top-info .info-sin', array( 'css' => array(
				'text-transform'    => "{$foo_top_info_transform}",
			) ) );
		}

		$foo_top_info_font_color = layers_get_theme_mod( 'foo-top-information-font-color');
		if ( 'ftcustomize' === $foo_top_info_design_option && '' !== $foo_top_info_font_color ) {
			// Apply Styles.
			layers_inline_styles( '.footer-top-info .info-sin, .footer-top-info .info-sin a i, .footer-top-info .info-sin a', array( 'css' => array(
				'color'    => "{$foo_top_info_font_color}",
			) ) );
		}

		$foo_top_info_display = layers_get_theme_mod( 'foo-top-information-display');
		if ( 'ftcustomize' === $foo_top_info_design_option && '' !== $foo_top_info_display ) {
			// Apply Styles.
			layers_inline_styles( '.footer-top-info .info-sin a i, .footer-top-info .info-sin i', array( 'css' => array(
				'display'    => "{$foo_top_info_display}",
			) ) );
		}

		$foo_top_info_display_isz = layers_get_theme_mod( 'foo-top-information-display-imb');
		$foo_top_icon_display_block = layers_get_theme_mod( 'foo-top-information-display');
		if ( 'ftcustomize' === $foo_top_info_design_option && 'inline' !== $foo_top_icon_display_block &&  '' !== $foo_top_info_display_isz ) {
			// Apply Styles.
			layers_inline_styles( '.footer-top-info .info-sin a i, .footer-top-info .info-sin i', array( 'css' => array(
				'font-size'    => "{$foo_top_info_display_isz}"."px",
			) ) );
		}
		$foo_top_info_display_fmb = layers_get_theme_mod( 'foo-top-information-display-fmb');
		if ( 'ftcustomize' === $foo_top_info_design_option && '' !== $foo_top_info_display_fmb ) {
			// Apply Styles.
			layers_inline_styles( '.footer-top-info .info-sin a i, .footer-top-info .info-sin i', array( 'css' => array(
				'margin-bottom'    => "{$foo_top_info_display_fmb}"."px",
			) ) );
		}




		/**
		* Footer overlay color
		*/
		$footer_overlay_color = layers_get_theme_mod( 'foo-background-overlay-color');
		if ( '' !== $footer_overlay_color ) {
			// Apply Styles.
			layers_inline_styles( '[data-foo-overlay]:before', array( 'css' => array(
				'background'    => "{$footer_overlay_color}",
			) ) );
		}
		/**
		 * Footer - Top overlay color
		 */
		$theme_overlay_color = layers_get_theme_mod( 'foo-top-background-overlay-color');
		
		if ( '' !== $theme_overlay_color ) {
			// Apply Styles.
			layers_inline_styles( '[data-top-overlay]:before', array( 'css' => array(
				'background'    => "{$theme_overlay_color}",
			) ) );
		}
		/**
		 * Copyright - overlay color
		 */
		$copyright_overlay_color = layers_get_theme_mod( 'copyright-background-overlay-color');
		
		if ( '' !== $copyright_overlay_color ) {
			// Apply Styles.
			layers_inline_styles( '[data-copyright-overlay]:before', array( 'css' => array(
				'background'    => "{$copyright_overlay_color}",
			) ) );
		}
		/**
		 * Footer - Logo Size
		 */
		$ftsize = layers_get_theme_mod( 'footer-top-logo-size');
		$ftmax_height = layers_get_theme_mod( 'footer-top-logo-size-custom');
		if ( 'custom' === $ftsize && '' !== $ftmax_height ) {

			// Apply Styles.
			layers_inline_styles( '.footer-top-logo .footer-logo-custom img', array( 'css' => array(
				'width' => 'auto',
				'max-height'    => "{$ftmax_height}px",
			) ) );
		}
		/**
		 * Footer - Top margin padding
		 */
		$foo_top_logo_padding_top = layers_get_theme_mod( 'footer-top-logo-padding-top');
		$showhide_foo_tpo_logo = layers_get_theme_mod( 'show-foo-top-logo');
		if ( 'yes' === $showhide_foo_tpo_logo && '' !== $foo_top_logo_padding_top ) {

			// Apply Styles.
			layers_inline_styles( '.footer-top-logo', array( 'css' => array(
				'padding-top'    => "{$foo_top_logo_padding_top}px",
			) ) );
		}
		$foo_top_logo_padding_bottom = layers_get_theme_mod( 'footer-top-logo-padding-bottom');
		if ( 'yes' === $showhide_foo_tpo_logo && '' !== $foo_top_logo_padding_bottom ) {

			// Apply Styles.
			layers_inline_styles( '.footer-top-logo', array( 'css' => array(
				'padding-bottom'    => "{$foo_top_logo_padding_bottom}px",
			) ) );
		}

		/**
		 * Footer - Logo Size
		 */
		$fbsize = layers_get_theme_mod( 'footer-logo-size');
		$fbmax_height = layers_get_theme_mod( 'footer-logo-size-custom');
		if ( 'custom' === $fbsize && '' !== $fbmax_height ) {

			// Apply Styles.
			layers_inline_styles( '.footer-logo img', array( 'css' => array(
				'width' => 'auto',
				'max-height'    => "{$fbmax_height}px",
			) ) );
		}

		/**
		 * Footer - Cadits cards size
		 */
		$cdsize = layers_get_theme_mod( 'the-custom-credit-cards-size');
		$cdmax_height = layers_get_theme_mod( 'the-custom-credit-cards-size-custom');
		if ( 'custom' === $cdsize && '' !== $cdmax_height ) {

			// Apply Styles.
			layers_inline_styles( '.credit-card img', array( 'css' => array(
				'width' => 'auto',
				'max-height'    => "{$cdmax_height}px",
			) ) );
		}

		/**
		 * Footer - menu style
		 */
		$textcolor = layers_get_theme_mod( 'footer-menu-text-color');
		if (isset($textcolor)) {

			// Apply Styles.
			layers_inline_styles( '.copyright .nav-horizontal.footermenu a', array( 'css' => array(
				'color'    => "{$textcolor}",
			) ) );
		}

		$hovertextcolor = layers_get_theme_mod( 'footer-menu-hover-text-color');
		if (isset($hovertextcolor)) {

			// Apply Styles.
			layers_inline_styles( '.copyright .nav-horizontal.footermenu a:hover', array( 'css' => array(
				'color'    => "{$hovertextcolor}",
			) ) );
		}

		$texttransform = layers_get_theme_mod( 'footer-menu-text-transform');
		switch ($texttransform) {
		    case "normal":
		        layers_inline_styles( '.copyright .nav-horizontal.footermenu a', array( 'css' => array(
						'text-transform'    => "{$texttransform}",
					) ) );
		        break;
		    case "uppercase":
		        layers_inline_styles( '.copyright .nav-horizontal.footermenu a', array( 'css' => array(
						'text-transform'    => "{$texttransform}",
					) ) );
		        break;
		    case "capitalize":
		        layers_inline_styles( '.copyright .nav-horizontal.footermenu a', array( 'css' => array(
						'text-transform'    => "{$texttransform}",
					) ) );
		        break;
		    case "lowercase":
		        layers_inline_styles( '.copyright .nav-horizontal.footermenu a', array( 'css' => array(
						'text-transform'    => "{$texttransform}",
					) ) );
		        break;
		    default:
		        layers_inline_styles( '.copyright .nav-horizontal.footermenu a', array( 'css' => array(
						'text-transform'    => "normal",
					) ) );
		}

		$linkspaching = layers_get_theme_mod( 'footer-menu-link-spacing');
		if ( '' !== $linkspaching ) {

			// Apply Styles.
			layers_inline_styles( '.copyright .nav-horizontal li', array( 'css' => array(
				'margin-left'    => "{$linkspaching}px",
			) ) );
		}

		$footermenufontsize = layers_get_theme_mod( 'footer-menu-font-size');
		if ( '' !== $footermenufontsize ) {

			// Apply Styles.
			layers_inline_styles( '.copyright .nav-horizontal li a', array( 'css' => array(
				'font-size'    => "{$footermenufontsize}px",
			) ) );
		}








        $hastech_controls_footer_color = layers_get_theme_mod( 
            'footer_text_color' , 
             TRUE 
        );
			
		// inline css 		
		if( '' != $hastech_controls_footer_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.site-text
			'),
				'css' => array(
				'color' => $hastech_controls_footer_color,
				),
			  )		
			);// End theme color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_color = layers_get_theme_mod( 
            'footer_social_icon_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a i
			'),
				'css' => array(
				'color' => $hastech_controls_footer_social_icon_color,
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_hover_color = layers_get_theme_mod( 
            'footer_social_icon_hover_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_hover_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a:hover i
			'),
				'css' => array(
				'color' => $hastech_controls_footer_social_icon_hover_color,
				),
			  )		
			);// End social color		
		} // edn check condition function



        $hastech_controls_footer_social_icon_bg_color = layers_get_theme_mod( 
            'footer_social_icon_bg_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_bg_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a
			'),
				'css' => array(
				'background-color' => $hastech_controls_footer_social_icon_bg_color,
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_bg_hover_color = layers_get_theme_mod( 
            'footer_social_icon_bg_hover_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_bg_hover_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a:hover
			'),
				'css' => array(
				'background-color' => $hastech_controls_footer_social_icon_bg_hover_color,
				),
			  )		
			);// End social color		
		} // edn check condition function



        $hastech_controls_footer_social_icon_border_size = layers_get_theme_mod( 
            'footer_social_icon_border_size' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_border_size ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a, .footer-icon ul li a:hover
			'),
				'css' => array(
				'border-width' => $hastech_controls_footer_social_icon_border_size.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_border_color = layers_get_theme_mod( 
            'footer_social_icon_border_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_border_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a
			'),
				'css' => array(
				'border-color' => $hastech_controls_footer_social_icon_border_color,
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_border_hover_color = layers_get_theme_mod( 
            'footer_social_icon_border_hover_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_border_hover_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a:hover
			'),
				'css' => array(
				'border-color' => $hastech_controls_footer_social_icon_border_hover_color,
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_rounded_size = layers_get_theme_mod( 
            'footer_social_icon_rounded_size' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_rounded_size ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a
			'),
				'css' => array(
				'border-radius' => $hastech_controls_footer_social_icon_rounded_size.'%',
				),
			  )		
			);// End social color		
		} // edn check condition function

        $hastech_controls_footer_social_icon_link_spacing = layers_get_theme_mod( 
            'footer_social_menu_link_spacing' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_link_spacing ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li + li
			'),
				'css' => array(
				'margin-left' => $hastech_controls_footer_social_icon_link_spacing.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_font_size = layers_get_theme_mod( 
            'footer_font_size' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_font_size ){
			layers_inline_styles( array(
			'selectors' => array('
				.copyright .site-text
			'),
				'css' => array(
				'font-size' => $hastech_controls_footer_font_size.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function

        $hastech_controls_footer_social_icon_font_size = layers_get_theme_mod( 
            'footer_social_icon_font_size' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_font_size ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a
			'),
				'css' => array(
				'font-size' => $hastech_controls_footer_social_icon_font_size.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_social_icon_size = layers_get_theme_mod( 
            'footer_social_icon_width' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_social_icon_size ){
			
			$define_plus_number = 3;
			$social_line_height = $hastech_controls_footer_social_icon_size + $define_plus_number;
			
			layers_inline_styles( array(
			'selectors' => array('
				.footer-icon ul li a
			'),
				'css' => array(
				'height' => $hastech_controls_footer_social_icon_size.'px',
				'width' => $hastech_controls_footer_social_icon_size.'px',
				'line-height' => $social_line_height.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function



        $hastech_controls_footer_top_top_padding = layers_get_theme_mod( 
            'hastech_top_footer_top_padding' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_top_top_padding ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .grid.footer-top-grid
			'),
				'css' => array(
				'padding-top' => $hastech_controls_footer_top_top_padding.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function

        $hastech_controls_footer_bottom_top_padding = layers_get_theme_mod( 
            'hastech_top_footer_bottom_padding' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_bottom_top_padding ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .grid.footer-top-grid
			'),
				'css' => array(
				'padding-bottom' => $hastech_controls_footer_bottom_top_padding.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function

		$hastech_controls_footer_top_top_margin = layers_get_theme_mod( 
            'hastech_top_footer_top_margin' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_top_top_margin ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .grid.footer-top-grid
			'),
				'css' => array(
				'margin-top' => $hastech_controls_footer_top_top_margin.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function


        $hastech_controls_footer_top_bottom_margin = layers_get_theme_mod( 
            'hastech_top_footer_bottom_margin' , 
             TRUE 
        );
        // inline css 		
		if( '' != $hastech_controls_footer_top_bottom_margin ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .grid.footer-top-grid
			'),
				'css' => array(
				'margin-bottom' => $hastech_controls_footer_top_bottom_margin.'px',
				),
			  )		
			);// End social color		
		} // edn check condition function



        $hastech_controls_footer_top_background = layers_get_theme_mod( 
            'hastech_footer_top_background' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_top_background ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site
			'),
				'css' => array(
				'background' => $hastech_controls_footer_top_background,
				),
			  )		
			);// End social color		
		} // edn check condition function
        $hastech_controls_footer_top_widget_title_color = layers_get_theme_mod( 
            'hastech_footer_top_widget_title' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_top_widget_title_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .section-nav-title, .footer-site.invert .section-nav-title
			'),
				'css' => array(
				'color' => $hastech_controls_footer_top_widget_title_color,
				),
			  )		
			);// End social color		
		} // edn check condition function
        $hastech_controls_footer_top_widget_content_color = layers_get_theme_mod( 
            'hastech_footer_top_widget_content_color' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_top_widget_content_color ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .widget ul li a, .footer-site .widget ul li, .footer-site .widget ul li p, .footer-site .widget p, .footer-site .widget table th , .footer-site .widget table td , .footer-site .widget caption
			'),
				'css' => array(
				'color' => $hastech_controls_footer_top_widget_content_color,
				),
			  )		
			);// End social color		
		} // edn check condition function
        $hastech_controls_footer_top_widget_title_font_size = layers_get_theme_mod( 
            'hastech_footer_top_widget_title_font_size' , 
             TRUE 
        );
		// inline css 		
		if( '' != $hastech_controls_footer_top_widget_title_font_size ){
			layers_inline_styles( array(
			'selectors' => array('
				.footer-site .section-nav-title
			'),
				'css' => array(
				'font-size' => $hastech_controls_footer_top_widget_title_font_size .'px',
				),
			  )		
			);// End social color		
		} // edn check condition function

	}// end function
} // edn condition function

