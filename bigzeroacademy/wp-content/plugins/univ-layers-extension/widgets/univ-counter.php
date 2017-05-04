<?php  /**
 * Counter Widget
 *
 * This file is used to register and display the Layers - counter widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( class_exists('Layers_Widget') && !class_exists( 'univ_counters_Widget' ) ) {	 
	class univ_counters_Widget extends Layers_Widget {

		/**
		*  Widget construction
		*/
		function __construct(){

			/**
			* Widget variables
			*
			* @param  	string    		$widget_title    	Widget title
			* @param  	string    		$widget_id    		Widget slug for use as an ID/classname
			* @param  	string    		$post_type    		(optional) Post type for use in widget options
			* @param  	string    		$taxonomy    		(optional) Taxonomy slug for use as an ID/classname
			* @param  	array 			$checkboxes    	(optional) Array of checkbox names to be saved in this widget. Don't forget these please!
			*/
			$this->widget_title = __( 'Univ:: Counter' , 'univ' );
			$this->widget_id = 'counter';
			$this->post_type = '';
			$this->taxonomy = '';
			$this->checkboxes = array();

			/* Widget settings. */
			$widget_ops = array(

				'classname'   => 'obox-layers-' . $this->widget_id .'-widget',
				'description' => __( 'This widget is used to display text and images in a flexible grid.', 'univ' ),
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'   => LAYERS_WIDGET_WIDTH_LARGE,
				'height'  => NULL,
				'id_base' => LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
			);

			/* Create the widget. */
			parent::__construct(
				LAYERS_THEME_SLUG . '-widget-' . $this->widget_id ,
				$this->widget_title,
				$widget_ops,
				$control_ops
			);


			/* Setup Widget Repeater Defaults */
			$this->register_repeater_defaults( 'column', 4, array(
				'icon' => __( 'bank', 'univ' ),
				'number' => __( '20', 'univ' ),
				'excerpt' => __( 'Campus', 'univ' ),
				'width' => '3',
				'design' => array(
					'background' => NULL,
					'fonts' => array(
						'align' => 'text-center',
						'size' => 'medium',
						'color' => NULL,
						'shadow' => NULL,
						'heading-type' => 'h2',
					),
				),
			) );
		}

		/**
		*  Widget front end display
		*/
		function widget( $args, $instance ) {
			global $wp_customize;

			$this->backup_inline_css();

			// Turn $args array into variables.
			extract( $args );

			// Use defaults if $instance is empty.
			if( empty( $instance ) && ! empty( $this->defaults ) ) {
				$instance = wp_parse_args( $instance, $this->defaults );
			}

			// Mix in new/unset defaults on every instance load (NEW)
			$instance = $this->apply_defaults( $instance );
			

			// Set the background styling
			if( !empty( $instance['design'][ 'background' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'background' => $instance['design'][ 'background' ] ) );
			//if( !empty( $instance['design']['fonts'][ 'color' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id, 'color', array( 'selectors' => array( '.section-title .heading' , '.section-title div.excerpt' ) , 'color' => $instance['design']['fonts'][ 'color' ] ) );

			/**
			* Generate the widget container class
			*/
			$widget_container_class = array();
			$widget_container_class[] = 'widget';
			$widget_container_class[] = 'counter-widget';
			$widget_container_class[] = 'content-vertical-massive';
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'background', 'darken' ) ? 'darken' : '' );
			$widget_container_class[] = $this->check_and_return( $instance , 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.
			$widget_container_class[] = $this->get_widget_spacing_class( $instance );

			$widget_container_class = apply_filters( 'layers_content_widget_container_class' , $widget_container_class, $this, $instance );
			$widget_container_class = implode( ' ', $widget_container_class ); ?>

			<?php echo $this->custom_anchor( $instance ); ?>
			<div id="<?php echo esc_attr( $widget_id ); ?>" class="fun-factor-area <?php echo esc_attr( $widget_container_class ); ?>">

				<?php do_action( 'layers_before_content_widget_inner', $this, $instance ); ?>

				<?php if ( ! empty( $instance[ 'columns' ] ) ) {

					$column_ids = explode( ',', $instance[ 'column_ids' ] );

					// Set total width
					$col_no = 0;
					$first_last_class = '';
					$row_width = 0; ?>
					<div class="<?php echo $this->get_widget_layout_class( $instance ); ?>">
						<div class="grid">
							<?php foreach ( $column_ids as $column_key ) {

								// Make sure we've got a column going on here
								if( !isset( $instance[ 'columns' ][ $column_key ] ) ) continue;

								// Setup Internal Vars.
								$item_instance = $instance[ 'columns' ][ $column_key ];
								$item_id_attr  = "{$widget_id}-tabs-{$column_key}";
								
								// Mix in new/unset defaults on every instance load (NEW)
								$item_instance = $this->apply_defaults( $item_instance, 'column' );
								
								// Get the Next Column for use later.
								if( isset( $column_ids[ ($col_no+1) ] ) ) {
									$next_item = $instance[ 'columns' ][ $column_ids[ ($col_no+1) ] ];
								}
								
								// Set the background styling
								if( !empty( $item_instance['design'][ 'background' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id . '-' . $column_key , 'background', array( 'background' => $item_instance['design'][ 'background' ] ) );
								if( !empty( $item_instance['design']['fonts'][ 'color' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id . '-' . $column_key , 'color', array( 'selectors' => array( 'single-fun-factor','.single-fun-factor h2', '.fun-factor-icon' , '.single-fun-factor span'  ) , 'color' => $item_instance['design']['fonts'][ 'color' ] ) );
								if( !empty( $item_instance['design']['fonts'][ 'shadow' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id . '-' . $column_key , 'text-shadow', array( 'selectors' => array( '.single-fun-factor h2', '.fun-factor-icon' , '.single-fun-factor span' )  , 'text-shadow' => $item_instance['design']['fonts'][ 'shadow' ] ) );

								// Set column margin & padding
								if ( !empty( $item_instance['design']['advanced']['margin'] ) ) $this->inline_css .= layers_inline_styles( "#{$widget_id}-{$column_key}", 'margin', array( 'margin' => $item_instance['design']['advanced']['margin'] ) );
								if ( !empty( $item_instance['design']['advanced']['padding'] ) ) $this->inline_css .= layers_inline_styles( "#{$widget_id}-{$column_key}", 'padding', array( 'padding' => $item_instance['design']['advanced']['padding'] ) );

								if( !isset( $item_instance[ 'width' ] ) ) $item_instance[ 'width' ] = $this->column_defaults[ 'width' ];
								


								// Add the correct span class
								$span_class = 'span-' . $item_instance[ 'width' ];

								$col_no++;
								$max = 12;
								$initial_width = $row_width;
								$item_width = $item_instance[ 'width' ];
								$next_item_width = ( isset( $next_item[ 'width' ] ) ? $next_item[ 'width' ] : 0 );
								$row_width += $item_width;

								if(  $max == $row_width ){
									$first_last_class = 'last';
									$row_width = 0;
								} elseif(  $max < $next_item_width + $row_width ){
									$first_last_class = 'last';
									$row_width = 0;
								} elseif( 0 == $initial_width ){
									$first_last_class = 'first';
								} else {
									$first_last_class = '';
								}



								/**
								* Set Individual Column CSS
								*/
								$classes = array();
								$classes[] = $this->id_base . '-' . $column_key;
								$classes[] = $span_class;
								$classes[] = ( 'on' == $this->check_and_return( $item_instance , 'design', 'background', 'darken' ) ? 'darken' : '' );
								$classes[] = ( '' != $first_last_class ? $first_last_class : '' );
								$classes[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
								$classes[] = $this->check_and_return( $item_instance, 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.
								if( $this->check_and_return( $item_instance, 'design' , 'background', 'image' ) || '' != $this->check_and_return( $item_instance, 'design' , 'background', 'color' ) )
									$classes[] = 'content';


								$classes = apply_filters( 'layers_content_widget_item_class', $classes, $this, $item_instance );
								$classes = implode( ' ', $classes ); ?>

								<div id="<?php echo $widget_id; ?>-<?php echo $column_key; ?>" class="<?php echo esc_attr( $classes ); ?>">
									<?php
									/**
									* Set Overlay CSS Classes
									*/
									$column_inner_classes = array();
									$column_inner_classes[] = 'media';
									if( !$this->check_and_return( $instance, 'design', 'gutter' ) ) {
										$column_inner_classes[] = 'no-push-bottom';
									}
									if( $this->check_and_return( $item_instance, 'design', 'background' , 'color' ) ) {
										if( 'dark' == layers_is_light_or_dark( $this->check_and_return( $item_instance, 'design', 'background' , 'color' ) ) ) {
											$column_inner_classes[] = 'invert';
										}
									} else {
										if( $this->check_and_return( $instance, 'design', 'background' , 'color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ) {
											$column_inner_classes[] = 'invert';
										}
									}

									$column_inner_classes[] = $this->check_and_return( $item_instance, 'design', 'fonts' , 'size' );
									$column_inner_classes = implode( ' ', $column_inner_classes );
									?>

									<div class="<?php echo $column_inner_classes; ?>">
									<?php if( $this->check_and_return( $item_instance, 'icon' ) || $this->check_and_return( $item_instance, 'number' ) || $this->check_and_return( $item_instance, 'excerpt' )){?>
									
											<div class="single-fun-factor <?php echo ( isset( $item_instance['design']['fonts'][ 'align' ] ) ) ? $item_instance['design']['fonts'][ 'align' ] : ''; ?>">
												<div class="fun-factor-icon">
												<?php if( $this->check_and_return( $item_instance, 'icon' ) ) { ?>
													<i class="fa fa-<?php echo $item_instance['icon']; ?>"></i>
													<?php } ?>
												</div>
												
												<<?php echo $this->check_and_return( $item_instance, 'design', 'fonts', 'heading-type' ) ?>>
												<span class="counter"><?php echo $item_instance['number']; ?></span>
												</<?php echo $this->check_and_return( $item_instance, 'design', 'fonts', 'heading-type' ) ?>>
												
												<?php if( $this->check_and_return( $item_instance, 'excerpt' ) ) { ?>
												<?php layers_the_content( $item_instance['excerpt'] ); ?>
												<?php } ?>
											</div>
																		
									<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div><!-- /row -->
					</div>
				<?php }
				do_action( 'layers_after_content_widget_inner', $this, $instance );

				// Print the Inline Styles for this Widget
				$this->print_inline_css();
			?>

			</div>
		<?php
			
			// Apply the advanced widget styling
			$this->apply_widget_advanced_styling( $widget_id, $instance );
		}

		/**
		*  Widget update
		*/

		function update($new_instance, $old_instance) {
			if ( isset( $this->checkboxes ) ) {
				foreach( $this->checkboxes as $cb ) {
					if( isset( $old_instance[ $cb ] ) ) {
						$old_instance[ $cb ] = strip_tags( $new_instance[ $cb ] );
					}
				} // foreach checkboxes
			} // if checkboxes
			return $new_instance;
		}

		/**
		*  Widget form
		*
		* We use regular HTML here, it makes reading the widget much easier than if we used just php to echo all the HTML out.
		*
		*/
		function form( $instance ){

			// Use defaults if $instance is empty.
			if( empty( $instance ) && ! empty( $this->defaults ) ) {
				$instance = wp_parse_args( $instance, $this->defaults );
			}

			// Mix in new/unset defaults on every instance load (NEW)
			$instance = $this->apply_defaults( $instance );

			$this->design_bar(
				'side', // CSS Class Name
				array( // Widget Object
					'name' => $this->get_layers_field_name( 'design' ),
					'id' => $this->get_layers_field_id( 'design' ),
					'widget_id' => $this->widget_id,
				),
				$instance, // Widget Values
				apply_filters( 'layers_column_widget_design_bar_components', array( // Components
					'layout',
					'background',
					'advanced',
				), $this, $instance )
			); ?>
			<div class="layers-container-large" id="layers-column-widget-<?php echo $this->number; ?>">

				<?php $this->form_elements()->header( array(
					'title' =>'Counter Section',
					'icon_class' =>'text'
				) ); ?>

				<section class="layers-accordion-section layers-content">
					<div class="layers-form-item">
					
						<?php $this->repeater( 'column', $instance ); ?>
						
					</div>
				</section>

			</div>

		<?php }

		function column_item( $item_guid, $item_instance ) {
			
			// Mix in new/unset defaults on every instance load (NEW)
			$item_instance = $this->apply_defaults( $item_instance, 'column' );
			?>
			<li class="layers-accordion-item" data-guid="<?php echo esc_attr( $item_guid ); ?>">
				<a class="layers-accordion-title">
					<span>
						<?php _e( 'Single Counter' , 'univ' ); ?><span class="layers-detail"><?php echo ( isset( $item_instance['title'] ) ? ': ' . substr( stripslashes( strip_tags( $item_instance['title'] ) ), 0 , 50 ) : NULL ); ?><?php echo ( isset( $item_instance['title'] ) && strlen( $item_instance['title'] ) > 50 ? '...' : NULL ); ?></span>
					</span>
				</a>
				<section class="layers-accordion-section layers-content">
					<?php $this->design_bar(
						'top', // CSS Class Name
						array( // Widget Object
							'name' => $this->get_layers_field_name( 'design' ),
							'id' => $this->get_layers_field_id( 'design' ),
							'widget_id' => $this->widget_id . '_item',
							'number' => $this->number,
							'show_trash' => TRUE,
						),
						$item_instance, // Widget Values
						apply_filters( 'layers_column_widget_column_design_bar_components', array( // Components
							'background',
							'fonts',
							'width' => array(
								'icon-css' => 'icon-columns',
								'label' => 'Column Width',
								'elements' => array(
									'layout' => array(
										'type' => 'select',
										'label' => __( '' , 'univ' ),
										'name' => $this->get_layers_field_name( 'width' ),
										'id' => $this->get_layers_field_id( 'width' ),
										'value' => ( isset( $item_instance['width'] ) ) ? $item_instance['width'] : NULL,
										'options' => array(
											'1' => __( '1 of 12 columns' , 'univ' ),
											'2' => __( '2 of 12 columns' , 'univ' ),
											'3' => __( '3 of 12 columns' , 'univ' ),
											'4' => __( '4 of 12 columns' , 'univ' ),
											'5' => __( '5 of 12 columns' , 'univ' ),
											'6' => __( '6 of 12 columns' , 'univ' ),
											'7' => __( '7 of 12 columns' , 'univ' ),
											'8' => __( '8 of 12 columns' , 'univ' ),
											'9' => __( '9 of 12 columns' , 'univ' ),
											'10' => __( '10 of 12 columns' , 'univ' ),
											'11' => __( '11 of 12 columns' , 'univ' ),
											'12' => __( '12 of 12 columns' , 'univ' )
										)
									)
								)
							),
							'advanced' => array(
								'elements' => array(
									'customclass',
									'padding' => array(
										'type' => 'trbl-fields',
										'label' => __( 'Padding (px)', 'univ' ),
										'name' => $this->get_layers_field_name( 'design', 'advanced', 'padding' ),
										'id' => $this->get_layers_field_id( 'design', 'advanced', 'padding' ),
										'value' => ( isset( $item_instance['design']['advanced']['padding'] ) ) ? $item_instance['design']['advanced']['padding'] : NULL,
										'fields' => array(
											'top',
											'right',
											'bottom',
											'left',
										),
									),
									'margin' => array(
										'type' => 'trbl-fields',
										'label' => __( 'Margin (px)', 'univ' ),
										'name' => $this->get_layers_field_name( 'design', 'advanced', 'margin' ),
										'id' => $this->get_layers_field_id( 'design', 'advanced', 'margin' ),
										'value' => ( isset( $item_instance['design']['advanced']['margin'] ) ) ? $item_instance['design']['advanced']['margin'] : NULL,
										'fields' => array(
											'top',
											'bottom',
										),
									),
								),
								'elements_combine' => 'replace',
							),
						), $this, $item_instance )
					); ?>
					<div class="layers-row">
						<p class="layers-form-item">
							<label for="<?php echo $this->get_layers_field_id( 'icon' ); ?>"><?php _e( 'Icon' , 'univ' ); ?></label>
							<?php echo $this->form_elements()->input(
								array(
									'type' => 'text',
									'name' => $this->get_layers_field_name( 'icon' ),
									'id' => $this->get_layers_field_id( 'icon' ),
									'placeholder' => __( 'Enter icon here' , 'univ' ),
									'value' => ( isset( $item_instance['icon'] ) ) ? $item_instance['icon'] : NULL ,
									'class' => 'layers-text'
								)
							); ?>
						</p>
						<p class="layers-form-item">
							<label for="<?php echo $this->get_layers_field_id( 'number' ); ?>"><?php _e( 'Number' , 'univ' ); ?></label>
							<?php echo $this->form_elements()->input(
								array(
									'type' => 'number',
									'name' => $this->get_layers_field_name( 'number' ),
									'id' => $this->get_layers_field_id( 'number' ),
									'placeholder' => __( 'Enter number here' , 'univ' ),
									'value' => ( isset( $item_instance['number'] ) ) ? $item_instance['number'] : NULL ,
									'class' => 'layers-text'
								)
							); ?>
						</p>
						
						<p class="layers-form-item">
							<label for="<?php echo $this->get_layers_field_id( 'excerpt' ); ?>"><?php _e( 'Excerpt' , 'univ' ); ?></label>
							<?php echo $this->form_elements()->input(
								array(
									'type' => 'rte',
									'name' => $this->get_layers_field_name( 'excerpt' ),
									'id' => $this->get_layers_field_id( 'excerpt' ),
									'placeholder' => __( 'Short Excerpt' , 'univ' ),
									'value' => ( isset( $item_instance['excerpt'] ) ) ? $item_instance['excerpt'] : NULL ,
									'class' => 'layers-form-item layers-textarea',
									'rows' => 6
								)
							); ?>
						</p>


					</div>
				</section>
			</li>
			<?php
		}

	} // Class

	// Add our function to the widgets_init hook.
	 register_widget("univ_counters_Widget");
}