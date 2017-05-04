<?php  /**
 * Blog Widget
 *
 * This file is used to register and display the Layers - Blog widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( class_exists('Layers_Widget') && !class_exists( 'univ_upcoming_event' ) ) {
	class univ_upcoming_event extends Layers_Widget {

		/**
		*  Widget construction
		*/
		function __construct() {

			/**
			* Widget variables
			*
			* @param  	string    		$widget_title    	Widget title
			* @param  	string    		$widget_id    		Widget slug for use as an ID/classname
			* @param  	string    		$post_type    		(optional) Post type for use in widget options
			* @param  	string    		$taxonomy    		(optional) Taxonomy slug for use as an ID/classname
			* @param  	array 			$checkboxes    	(optional) Array of checkbox names to be saved in this widget. Don't forget these please!
			*/
			$this->widget_title = __( 'Univ:: Event' , 'univ' );
			$this->widget_id = 'univ_upcoming_event';
			$this->post_type = 'univ_event';
			$this->taxonomy = 'event_category';
			$this->checkboxes = array(
					'hidden_lg',
					'hidden_md',
					'hidden_sm',
					'hidden_xs',
				); // @TODO: Try make this more dynamic, or leave a different note reminding users to change this if they add/remove checkboxes

			/* Widget settings. */
			$widget_ops = array(
				'classname' => 'obox-layers-' . $this->widget_id .'-widget',
				'description' => __( 'This widget is used to display your  Service post.', 'univ' ),
				'customize_selective_refresh' => TRUE,
			);

			/* Widget control settings. */
			$control_ops = array(
				'width' => LAYERS_WIDGET_WIDTH_SMALL,
				'height' => NULL,
				'id_base' => LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
			);

			/* Create the widget. */
			parent::__construct(
				LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
				$this->widget_title,
				$widget_ops,
				$control_ops
			);

			/* Setup Widget Defaults */
			$this->defaults = array (
				'title' => __( 'LATEST NEWS', 'univ' ),
				'category' => 0,			
				'posts_per_page' => get_option( 'posts_per_page' ),
				'design' => array(
					'layout' => 'layout-boxed',
					'textalign' => 'text-left',
					'columns' => '12',
					'gutter' => 'on',
					'background' => array(
						'position' => 'center',
						'repeat' => 'no-repeat'
					),
					'fonts' => array(
						'align' => 'text-center',
						'size' => 'medium',
						'color' => NULL,
						'shadow' => NULL,
						'heading-type' => 'h3',
					),
				),
				'hidden_lg' => 'off',
				'hidden_md' => 'off',
				'hidden_sm' => 'off',
				'hidden_xs' => 'off'
			);
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


			// Set the span class for each column
			if( isset( $instance['design'][ 'columns']  ) ) {
				$col_count = str_ireplace('columns-', '', $instance['design'][ 'columns']  );
				$span_class = 'span-' . ( 12/ $col_count );
			} else {
				$col_count = 1;
				$span_class = 'span-12';
			}

			// Apply Styling
			$this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'background' => $instance['design'][ 'background' ] ) );
			$this->inline_css .= layers_inline_styles( '#' . $widget_id, 'color', array( 'selectors' => array( '.section-title .heading' , '.section-title div.excerpt' ) , 'color' => $instance['design']['fonts'][ 'color' ] ) );
			$this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'selectors' => array( '.thumbnail-body' ) , 'background' => array( 'color' => $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ) );
			
			// Begin query arguments
			$query_args = array();
			if( get_query_var('paged') ) {
				$query_args[ 'paged' ] = get_query_var('paged') ;
			} else if ( get_query_var('page') ) {
				$query_args[ 'paged' ] = get_query_var('page');
			} else {
				$query_args[ 'paged' ] = 1;
			}

			$query_args[ 'post_type' ] = $this->post_type;
			$query_args[ 'posts_per_page' ] = $instance['posts_per_page'];
			if( isset( $instance['order'] ) ) {

				$decode_order = json_decode( $instance['order'], true );

				if( is_array( $decode_order ) ) {
					foreach( $decode_order as $key => $value ){
						$query_args[ $key ] = $value;
					}
				}
			}

			// Do the special taxonomy array()
			if( isset( $instance['category'] ) && '' != $instance['category'] && 0 != $instance['category'] ){

				$query_args['tax_query'] = array(
					array(
						"taxonomy" => $this->taxonomy,
						"field" => "id",
						"terms" => $instance['category']
					)
				);
			} elseif( !isset( $instance['hide_category_filter'] ) ) {
				$terms = get_terms( $this->taxonomy );
			} // if we haven't selected which category to show, let's load the $terms for use in the filter

			// Do the WP_Query
			$post_query = new WP_Query( $query_args );

			// Apply the advanced widget styling
			$this->apply_widget_advanced_styling( $widget_id, $instance );

			/**
			* Generate the widget container class
			*/
			$widget_container_class = array();

			$widget_container_class[] = 'widget';
			$widget_container_class[] = 'univ-event-widget';
			$widget_container_class[] = 'content-vertical-massive';
			$widget_container_class[] = 'clearfix';
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'background', 'darken' ) ? 'darken' : '' );
			$widget_container_class[] = $this->check_and_return( $instance , 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.

			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_lg' ) ? 'hidden-lg' : 'block-lg' );
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_md' ) ? 'hidden-md' : 'block-md' );
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_sm' ) ? 'hidden-sm' : 'block-sm' );
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_xs' ) ? 'hidden-xs' : 'block-xs' );

			$widget_container_class[] = $this->get_widget_spacing_class( $instance );

			$widget_container_class = apply_filters( 'layers_post_widget_container_class' , $widget_container_class, $this, $instance );
			$widget_container_class = implode( ' ', $widget_container_class );

			// Custom Anchor
			echo $this->custom_anchor( $instance ); ?>

			<div id="<?php echo esc_attr( $widget_id ); ?>" class="<?php echo esc_attr( $widget_container_class ); ?>" <?php $this->selective_refresh_atts( $args ); ?>>

				<?php do_action( 'layers_before_post_widget_inner', $this, $instance ); ?>

				<?php if( '' != $this->check_and_return( $instance , 'title' ) ||'' != $this->check_and_return( $instance , 'excerpt' ) ) { ?>
					<div class="container clearfix">
						<?php /**
						* Generate the Section Title Classes
						*/
						$section_title_class = array();
						$section_title_class[] = 'section-title clearfix';
						$section_title_class[] = $this->check_and_return( $instance , 'design', 'fonts', 'size' );
						$section_title_class[] = $this->check_and_return( $instance , 'design', 'fonts', 'align' );
						$section_title_class[] = ( $this->check_and_return( $instance, 'design', 'background' , 'color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ? 'invert' : '' );
						$section_title_class = implode( ' ', $section_title_class ); ?>
						<div class="<?php echo $section_title_class; ?>">
							<?php if( '' != $this->check_and_return( $instance, 'title' )  ) { ?>
								<<?php echo $this->check_and_return( $instance, 'design', 'fonts', 'heading-type' ); ?> class="heading">
									<?php echo $instance['title'] ?>
								</<?php echo $this->check_and_return( $instance, 'design', 'fonts', 'heading-type' ); ?>>
							<?php } ?>
							<?php if( '' != $this->check_and_return( $instance, 'excerpt' )  ) { ?>
								<div class="excerpt"><?php echo layers_the_content( $instance['excerpt'] ); ?></div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				
				<?php if( $post_query->have_posts() ) { ?>
					<div class="<?php echo $this->get_widget_layout_class( $instance ); ?>">
						<div class="grid">
							<?php while( $post_query->have_posts() ) {
								$post_query->the_post();

								$event_date  = get_post_meta( get_the_ID(),'_univ_event_date', true );
								$event_location  = get_post_meta( get_the_ID(),'_univ_loaction', true );
								$event_time  = get_post_meta( get_the_ID(),'_univ_event_time', true );	
								 
								/**
								* Set Individual Column CSS
								*/
								$post_column_class = array();
								$post_column_class[] = 'thumbnail';
								$post_column_class[] = 'single-event';
								$post_column_class[] = ( 'list-masonry' == $this->check_and_return( $instance, 'design', 'liststyle' ) ? 'no-gutter' : '' );
								$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
								$post_column_class[] = $span_class;
								$post_column_class[] = ( 'overlay' == $this->check_and_return( $instance , 'text_style' ) ? 'with-overlay' : ''  ) ;
								$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
								$post_column_class = implode( ' ' , $post_column_class ); ?>

								<div class="<?php echo $post_column_class; ?>" data-cols="<?php echo $col_count; ?>">
									<div class="event-img">
										<?php /**
										* Display the Featured Thumbnail
										*/
										echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'size' => 'univ-upcoming-event' ) ); ?>
										<p class="event-date-list"><?php echo $event_date ?></p>
									</div>
									<div class="event-content">
										<div class="event-title">
											<h3>
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h3>
										</div>
										<p> 
											<?php
												echo wp_trim_words( get_the_content(), 30, '...' );
											?>
										</p>
									</div>	
									<div class="event-footer">
										<span class="event-time"> 
											<i class="fa fa-clock-o"></i> <?php echo $event_time ?>
										</span>
										<span class="e-comment-view">
											<i class="fa fa-map-marker"></i> 
											<?php echo $event_location ?>
										</span>
									</div>					
								</div>
							<?php }; // while have_posts ?>
							</div>
					</div>
				<?php }; // if have_posts ?>

				<?php do_action( 'layers_after_post_widget_inner', $this, $instance );

				// Print the Inline Styles for this Widget
				$this->print_inline_css(); ?>
								

			</div>

			<?php // Reset WP_Query
			wp_reset_postdata();

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
		* We use regulage HTML here, it makes reading the widget much easier than if we used just php to echo all the HTML out.
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
				apply_filters( 'layers_post_widget_design_bar_components' , array( // Components
					'layout',
					'columns',
					'background',
					'showhidedisplay' => array(
						'icon-css' => 'fa fa-eye-slash fa-3x',
						'label' => __( 'Hidden', 'univ' ),
						'elements' => array(
							'hidedesktop' => array(
								'type' => 'checkbox',
								'label' => __( 'Hide on Desktop' , 'univ' ),
								'name' => $this->get_layers_field_name( 'design', 'hidden_lg' ) ,
								'id' =>  $this->get_layers_field_id( 'design', 'hidden_lg' ) ,
								'value' => ( isset( $instance['design']['hidden_lg'] ) ) ? $instance['design']['hidden_lg'] : NULL
							),
							'hidelaptop' => array(
								'type' => 'checkbox',
								'label' => __( 'Hide on Laptop' , 'univ' ),
								'name' => $this->get_layers_field_name( 'design', 'hidden_md' ) ,
								'id' =>  $this->get_layers_field_id( 'design', 'hidden_md' ) ,
								'value' => ( isset( $instance['design']['hidden_md'] ) ) ? $instance['design']['hidden_md'] : NULL
							),
							'hidetablet' => array(
								'type' => 'checkbox',
								'label' => __( 'Hide on Tablet' , 'univ' ),
								'name' => $this->get_layers_field_name( 'design', 'hidden_sm' ) ,
								'id' =>  $this->get_layers_field_id( 'design', 'hidden_sm' ) ,
								'value' => ( isset( $instance['design']['hidden_sm'] ) ) ? $instance['design']['hidden_sm'] : NULL
							),
							'hidephone' => array(
								'type' => 'checkbox',
								'label' => __( 'Hide on Phone' , 'univ' ),
								'name' => $this->get_layers_field_name( 'design', 'hidden_xs' ) ,
								'id' =>  $this->get_layers_field_id( 'design', 'hidden_xs' ) ,
								'value' => ( isset( $instance['design']['hidden_xs'] ) ) ? $instance['design']['hidden_xs'] : NULL
							)
						)
					),

					'advanced',
				), $this, $instance )
			); ?>
			<div class="layers-container-large">

				<?php $this->form_elements()->header( array(
					'title' =>  __( 'Univ Event' , 'univ' ),
					'icon_class' =>'post'
				) ); ?>

				<section class="layers-accordion-section layers-content">

					<div class="layers-row layers-push-bottom">
						<div class="layers-form-item">

							<?php echo $this->form_elements()->input(
								array(
									'type' => 'text',
									'name' => $this->get_layers_field_name( 'title' ) ,
									'id' => $this->get_layers_field_id( 'title' ) ,
									'placeholder' => __( 'Enter title here' , 'univ' ),
									'value' => ( isset( $instance['title'] ) ) ? $instance['title'] : NULL,
									'class' => 'layers-text layers-large'
								)
							); ?>

							<?php $this->design_bar(
								'top', // CSS Class Name
								array( // Widget Object
									'name' => $this->get_layers_field_name( 'design' ),
									'id' => $this->get_layers_field_id( 'design' ),
									'widget_id' => $this->widget_id,
									'show_trash' => FALSE,
									'inline' => TRUE,
									'align' => 'right',
								),
								$instance, // Widget Values
								apply_filters( 'layers_post_widget_inline_design_bar_components', array( // Components
									'fonts',
								), $this, $instance )
							); ?>

						</div>
						<div class="layers-form-item">

							<?php echo $this->form_elements()->input(
								array(
									'type' => 'rte',
									'name' => $this->get_layers_field_name( 'excerpt' ) ,
									'id' => $this->get_layers_field_id( 'excerpt' ) ,
									'placeholder' => __( 'Short Excerpt' , 'univ' ),
									'value' => ( isset( $instance['excerpt'] ) ) ? $instance['excerpt'] : NULL,
									'class' => 'layers-textarea layers-large'
								)
							); ?>

						</div>
						<?php // Grab the terms as an array and loop 'em to generate the $options for the input
						$terms = get_terms( $this->taxonomy , array( 'hide_empty' => false ) );
						if( !is_wp_error( $terms ) ) { ?>
							<p class="layers-form-item">
								<label for="<?php echo $this->get_layers_field_id( 'category' ); ?>"><?php echo __( ' Select Category' , 'univ' ); ?></label>
								<?php $category_options[ 0 ] = __( 'All' , 'univ' );
								foreach ( $terms as $t ) $category_options[ $t->term_id ] = $t->name;
								echo $this->form_elements()->input(
									array(
										'type' => 'select',
										'name' => $this->get_layers_field_name( 'category' ) ,
										'id' => $this->get_layers_field_id( 'category' ) ,
										'placeholder' => __( 'Select a Category' , 'univ' ),
										'value' => ( isset( $instance['category'] ) ) ? $instance['category'] : NULL,
										'options' => $category_options,
									)
								); ?>
							</p>
						<?php } // if !is_wp_error ?>
						<p class="layers-form-item">
							<label for="<?php echo $this->get_layers_field_id( 'posts_per_page' ); ?>"><?php echo __( 'Number of items to show' , 'univ' ); ?></label>
							<?php $select_options[ '-1' ] = __( 'Show All' , 'univ' );
							$select_options = $this->form_elements()->get_incremental_options( $select_options , 1 , 20 , 1);
							echo $this->form_elements()->input(
								array(
									'type' => 'number',
									'name' => $this->get_layers_field_name( 'posts_per_page' ) ,
									'id' => $this->get_layers_field_id( 'posts_per_page' ) ,
									'value' => ( isset( $instance['posts_per_page'] ) ) ? $instance['posts_per_page'] : NULL,
									'min' => '-1',
									'max' => '100'
								)
							); ?>
						</p>

						<p class="layers-form-item">
							<label for="<?php echo $this->get_layers_field_id( 'order' ); ?>"><?php echo __( 'Sort by' , 'univ' ); ?></label>
							<?php echo $this->form_elements()->input(
								array(
									'type' => 'select',
									'name' => $this->get_layers_field_name( 'order' ) ,
									'id' => $this->get_layers_field_id( 'order' ) ,
									'value' => ( isset( $instance['order'] ) ) ? $instance['order'] : NULL,
									'options' => $this->form_elements()->get_sort_options()
								)
							); ?>
						</p>
					</div>
				</section>

			</div>
		<?php } // Form
	} // Class

	// Add our function to the widgets_init hook.
	 register_widget("univ_upcoming_event");
}