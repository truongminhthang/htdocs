<?php  /**
 * Teacher Widget
 *
 * This file is used to register and display the Layers - Teacher widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( class_exists('Layers_Widget') && !class_exists( 'univ_Teacher_Widget' ) ) {	
	class univ_Teacher_Widget extends Layers_Widget {

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
			$this->widget_title = __( 'Univ:: Teacher' , 'univ' );
			$this->widget_id = 'teacher';
			$this->post_type = 'univ_teacher';
			$this->taxonomy = 'teacher_category';
			$this->checkboxes = array(
					'show_media',
					'show_titles',
					'stylet1',
					'stylet2',
					'showcarsolt',
					'show_pagination',
					'show_content',
					'show_excerpts',
					'show_categories',
				); // @TODO: Try make this more dynamic, or leave a different note reminding users to change this if they add/remove checkboxes

			/* Widget settings. */
			$widget_ops = array(

				'classname'   => 'obox-layers-' . $this->widget_id .'-widget',
				'description' => __( 'This widget is used to display your posts in a flexible grid.', 'univ' ),
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'   => LAYERS_WIDGET_WIDTH_SMALL,
				'height'  => NULL,
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
				'title' => __( 'Our Teacher ', 'univ' ),
				'excerpt' => __( 'Stay up to date with all our latest news and launches. Only the best quality makes it onto our blog!', 'univ' ),
				'category' => 0,
				'show_media' => 'on',
				'show_titles' => 'on',
				'stylet1' => 'on',
				'showcarsolt' => 'on',
				'stylet2' => 'off',
				'show_pagination' => 'off',
				'show_content' => 'on',
				'show_excerpts' => 'on',
				'show_categories' => 'on',
				'excerpt_length' => 200,
				'posts_per_page' => get_option( 'posts_per_page' ),
				'design' => array(
					'layout' => 'layout-boxed',
					'textalign' => 'text-center',
					'columns' => '3',
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
					)
				)
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
				$col_count = 3;
				$span_class = 'span-4';
			}

			// Apply Styling
			$this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'background' => $instance['design'][ 'background' ] ) );
			$this->inline_css .= layers_inline_styles( '#' . $widget_id, 'color', array( 'selectors' => array( '.section-title h3' , '.section-title p' ) , 'color' => $instance['design']['fonts'][ 'color' ] ) );
			$this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'selectors' => array( '' ) , 'background' => array( 'color' => $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ) );



			// Begin query arguments

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

			// Set the meta to display
			global $layers_post_meta_to_display;
			$layers_post_meta_to_display = array();
			if( isset( $instance['show_dates'] ) ) $layers_post_meta_to_display[] = 'date';
			if( isset( $instance['show_author'] ) ) $layers_post_meta_to_display[] = 'author';
			if( isset( $instance['show_categories'] ) ) $layers_post_meta_to_display[] = 'categories';
			if( isset( $instance['show_tags'] ) ) $layers_post_meta_to_display[] = 'tags';

			/**
			* Generate the widget container class
			*/
			$widget_container_class = array();

			$widget_container_class[] = 'widget';
			$widget_container_class[] = 'clearfix';
			$widget_container_class[] = 'content-vertical-massive';
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'background', 'darken' ) ? 'darken' : '' );
			$widget_container_class[] = $this->check_and_return( $instance , 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.
			$widget_container_class[] = $this->get_widget_spacing_class( $instance );

			$widget_container_class = apply_filters( 'layers_post_widget_container_class' , $widget_container_class, $this, $instance );
			$widget_container_class = implode( ' ', $widget_container_class ); ?>
			<?php echo $this->custom_anchor( $instance ); ?>
			<div id="<?php echo esc_attr( $widget_id ); ?>" class="<?php echo esc_attr( $widget_container_class ); ?>">

				<?php do_action( 'layers_before_post_widget_inner', $this, $instance ); ?>

				<?php if( '' != $this->check_and_return( $instance , 'title' ) ||'' != $this->check_and_return( $instance , 'excerpt' ) ) { ?>
					<div class="container clearfix">
						<?php /**
						* Generate the Section Title Classes
						*/
						$section_title_class = array();
						$section_title_class[] = 'section-title clearfix';
						$section_title_class[] = 'section-title-wrapper';
						$section_title_class[] = $this->check_and_return( $instance , 'design', 'fonts', 'size' );
						$section_title_class[] = $this->check_and_return( $instance , 'design', 'fonts', 'align' );
						$section_title_class[] = ( $this->check_and_return( $instance, 'design', 'background' , 'color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'background' , 'color' ) ) ? 'invert' : '' );
						$section_title_class = implode( ' ', $section_title_class );
						?>
						<div class="<?php echo $section_title_class; ?>">
						
							<?php if( '' != $this->check_and_return( $instance, 'title' )  ) { ?>
								<<?php echo $this->check_and_return( $instance, 'design', 'fonts', 'heading-type' ); ?> class="hadding">
									<?php echo $instance['title'] ?>
								</<?php echo $this->check_and_return( $instance, 'design', 'fonts', 'heading-type' ); ?>>
							<?php } ?>
							<?php if( '' != $this->check_and_return( $instance, 'excerpt' )  ) { ?>
								<?php echo layers_the_content( $instance['excerpt'] ); ?>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				
				
				
				<?php if( $post_query->have_posts() ) { ?>
					<div class="<?php echo $this->get_widget_layout_class( $instance ); ?>">
						
						<?php if( isset( $instance['stylet1'] ) ) { ?>
								<?php if( isset( $instance['showcarsolt'] ) ) { ?>
								<div class="grid">
								 <div class="teacher-carousel carousel-style-one">
								 <?php } else { ?>	
								  <div class="noclass">
								  <div class="grid">
								 <?php } //end carsol show/hide ?>						
						 
								<?php while( $post_query->have_posts() ) {
									$post_query->the_post();

										/**
										* Set Individual Column CSS
										*/
										$post_column_class = array();
										$post_column_class[] = 'teacher-large-item';
										$post_column_class[] = 'text-center';
										$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
										$post_column_class[] = $span_class;
										$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
										$post_column_class = implode( ' ' , $post_column_class );
										?>
			
																		
									<div class="<?php echo $post_column_class; ?>" data-cols="<?php echo $col_count; ?>">
											<div class="teacher-large-image">
												<a href="<?php the_permalink();?>">
													<?php if( isset( $instance['show_media'] ) ) {?>
														<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' );	?>" alt="">
													<?php } //end meadia?>
												</a>
											</div>										
											<?php if( isset( $instance['show_content'] ) ) { ?>
												<div class="single-teacher-large-carousel">
													<?php if( isset( $instance['show_titles'] ) ) { ?>
														<h4><?php the_title();?></h4>
													<?php } //end title ?>

													<?php  $tsubtitle  = get_post_meta( get_the_ID(),'_univ_tsubtitle', true );?>
													<?php  $groupfield  = get_post_meta( get_the_ID(),'_univ_teacherid', true );?>
													<span><?php echo $tsubtitle;?></span>	
													<div class="social-links">
														<?php if($groupfield){?>
														<?php foreach($groupfield as $ticons){?>
															<a href="<?php echo $ticons['_univ_turl'];?>"><i class="fa fa-<?php echo $ticons['_univ_ticon'];?>"></i></a>
														<?php }}?>
													</div>
												</div> 
											<?php }//end content ?>	
									</div>													
	
								<?php }; // while have_posts ?>
						</div><!-- /carsol -->
						<?php } elseif( isset( $instance['stylet2'] ) ) { ?>
								<?php if( isset( $instance['showcarsolt'] ) ) { ?>
									<div class="grid">
										<div class="teachers-column-carousel carousel-style-one">
									 <?php } else { ?>	
									  <div class="noclass">
										<div class="grid">
								 <?php } //end carsol show/hide ?>	
						
								<?php while( $post_query->have_posts() ) {
									$post_query->the_post();

										/**
										* Set Individual Column CSS
										*/
										$post_column_class = array();
										$post_column_class[] = 'single-teachers-column';
										$post_column_class[] = 'text-center';
										$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
										$post_column_class[] = $span_class;
										$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
										$post_column_class = implode( ' ' , $post_column_class );
										?>																				
									<div class="<?php echo $post_column_class; ?>" data-cols="<?php echo $col_count; ?>">
											<div class="teachers-image-column">
												<a href="<?php the_permalink();?>">
													<?php if( isset( $instance['show_media'] ) ) {?>
														<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' );	?>" alt="">
													<?php } //end meadia?>
												</a>
											</div>
											<?php if( isset( $instance['show_content'] ) ) { ?>
											
												<div class="teacher-column-carousel-text">
													<?php if( isset( $instance['show_titles'] ) ) { ?>
														<h4><?php the_title();?></h4>
													<?php } //end title ?>
													<?php  $tsubtitle  = get_post_meta( get_the_ID(),'_univ_tsubtitle', true );?>
													<?php  $groupfield  = get_post_meta( get_the_ID(),'_univ_teacherid', true );?>
													<span><?php echo $tsubtitle;?></span>
													
														<?php if($groupfield){?>
															<div class="social-links">
															<?php foreach($groupfield as $ticons){?>
																<a href="<?php echo $ticons['_univ_turl'];?>"><i class="fa fa-<?php echo $ticons['_univ_ticon'];?>"></i></a>
															<?php } ?>	
															</div>
														<?php } ?>
																											
												</div>
											
											<?php }//end content ?>	
									</div>			
										
	
								<?php }; // while have_posts ?>
						</div><!-- /carsol -->
						
						<?php } // if show div data ?>	
						</div><!-- /row -->
					</div>
				<?php }; // if have_posts ?>
					<?php if( isset( $instance['show_pagination'] ) ) { ?>
						<div class="container">					
							<div class="pagination-content">
								<div class="pagination-button">
								<?php layers_pagination( array( 'query' => $post_query ), 'div', 'pagination clearfix' );?>
								  
								</div>
							</div>						
						</div>
					<?php } //end pagination?>		
				<?php do_action( 'layers_after_post_widget_inner', $this, $instance );

				// Print the Inline Styles for this Widget
				$this->print_inline_css();
				?>

			</div>

			<?php // Reset WP_Query
			wp_reset_postdata();

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
					'display' => array(
						'icon-css' => 'icon-display',
						'label' => __( 'Display', 'univ' ),
						'elements' => array(
							'stylet1' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'stylet1' ) ,
							'id' => $this->get_layers_field_id( 'stylet1' ) ,
							'value' => ( isset( $instance['stylet1'] ) ) ? $instance['stylet1'] : NULL,
							'label' => __( 'show style 1' , 'univ' )
							),
							'stylet2' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'stylet2' ) ,
							'id' => $this->get_layers_field_id( 'stylet2' ) ,
							'value' => ( isset( $instance['stylet2'] ) ) ? $instance['stylet2'] : NULL,
							'label' => __( 'show style 2' , 'univ' )
							),
							'showcarsolt' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'showcarsolt' ) ,
							'id' => $this->get_layers_field_id( 'showcarsolt' ) ,
							'value' => ( isset( $instance['showcarsolt'] ) ) ? $instance['showcarsolt'] : NULL,
							'label' => __( 'show carousel' , 'univ' )
							),
							'show_pagination' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_pagination' ) ,
							'id' => $this->get_layers_field_id( 'show_pagination' ) ,
							'value' => ( isset( $instance['show_pagination'] ) ) ? $instance['show_pagination'] : NULL,
							'label' => __( 'show pagination' , 'univ' )
							),
							
							'show_media' => array(
								'type' => 'checkbox',
								'name' => $this->get_layers_field_name( 'show_media' ) ,
								'id' => $this->get_layers_field_id( 'show_media' ) ,
								'value' => ( isset( $instance['show_media'] ) ) ? $instance['show_media'] : NULL,
								'label' => __( 'Show Featured Images' , 'univ' )
							),
							'show_titles' => array(
								'type' => 'checkbox',
								'name' => $this->get_layers_field_name( 'show_titles' ) ,
								'id' => $this->get_layers_field_id( 'show_titles' ) ,
								'value' => ( isset( $instance['show_titles'] ) ) ? $instance['show_titles'] : NULL,
								'label' => __( 'Show  Post Titles' , 'univ' )
							),
							'show_content' => array(
								'type' => 'checkbox',
								'name' => $this->get_layers_field_name( 'show_content' ) ,
								'id' => $this->get_layers_field_id( 'show_content' ) ,
								'value' => ( isset( $instance['show_content'] ) ) ? $instance['show_content'] : NULL,
								'label' => __( 'Show  Post Content' , 'univ' )
							),														
							'show_excerpts' => array(
								'type' => 'checkbox',
								'name' => $this->get_layers_field_name( 'show_excerpts' ) ,
								'id' => $this->get_layers_field_id( 'show_excerpts' ) ,
								'value' => ( isset( $instance['show_excerpts'] ) ) ? $instance['show_excerpts'] : NULL,
								'label' => __( 'Show Post Excerpts' , 'univ' ),
							),
							'excerpt_length' => array(
								'type' => 'number',
								'name' => $this->get_layers_field_name( 'excerpt_length' ) ,
								'id' => $this->get_layers_field_id( 'excerpt_length' ) ,
								'min' => 0,
								'max' => 10000,
								'value' => ( isset( $instance['excerpt_length'] ) ) ? $instance['excerpt_length'] : NULL,
								'label' => __( 'Excerpts Length' , 'univ' ),
								'data' => array( 'show-if-selector' => '#' . $this->get_layers_field_id( 'show_excerpts' ), 'show-if-value' => 'true' ),
							),
							),
							'show_categories' => array(
								'type' => 'checkbox',
								'name' => $this->get_layers_field_name( 'show_categories' ) ,
								'id' => $this->get_layers_field_id( 'show_categories' ) ,
								'value' => ( isset( $instance['show_categories'] ) ) ? $instance['show_categories'] : NULL,
								'label' => __( 'Show Categories' , 'univ' ),
								'data' => array(
									'show-if-selector' => '#' . $this->get_layers_field_id( 'text_style' ),
									'show-if-value' => 'overlay',
									'show-if-operator' => '!='
								),
							),
						),
					'columns',
					'background',
					'advanced',
				), $this, $instance )
			); ?>
			<div class="layers-container-large">

				<?php $this->form_elements()->header( array(
					'title' =>  __( 'Classes Post' , 'univ' ),
					'icon_class' =>'classess'
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
								<label for="<?php echo $this->get_layers_field_id( 'category' ); ?>"><?php echo __( 'Category to Display' , 'univ' ); ?></label>
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
	 register_widget("univ_Teacher_Widget");
}