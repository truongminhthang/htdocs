<?php  /**
 * Blog  Widget
 *
 * This file is used to register and display the Layers - blog widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( class_exists('Layers_Widget') && !class_exists( 'Univ_Blog_Widget' ) ) {	
	class Univ_Blog_Widget extends Layers_Widget {

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
			$this->widget_title = __( 'Univ:: News Post' , 'univ' );
			$this->widget_id = 'ourblog';
			$this->post_type = 'post';
			$this->taxonomy = 'category';
			$this->checkboxes = array(
					'show_media',
					'show_titles',
					'styleclass1',
					'styleclass2',
					'carsolshow',
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
				'title' => __( 'OUR BLOG', 'univ' ),
				'excerpt' => __( 'Latest news & event of our Company', 'univ' ),
				'text_style' => 'regular',
				'category' => 0,
				'show_media' => 'on',
				'show_titles' => 'on',
				'styleclass1' => 'on',
				'styleclass2' => 'off',
				'carsolshow' => 'on',
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
						'align' => 'text-left',
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

			/**
			* Generate the widget container class
			*/
			$widget_container_class = array();

			$widget_container_class[] = 'widget';
			$widget_container_class[] = 'content-vertical-massive';
			$widget_container_class[] = 'clearfix';
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
					
					<?php if( isset( $instance['styleclass1'] ) ) { ?>
								<?php if( isset( $instance['carsolshow'] ) ) { ?>
									<div class="grid">
										<div class="blog-carousel carousel-style-one">
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
										$post_column_class[] = 'single-blog-item overlay-hover';
										$post_column_class[] = 'single-blog-pading';
										$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
										$post_column_class[] = $span_class;
										$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
										$post_column_class = implode( ' ' , $post_column_class );
										?>																			
									<div class="<?php echo $post_column_class; ?>" data-cols="<?php echo $col_count; ?>">

									<?php if ( has_post_thumbnail() ) { ?>
										<div class="single-blog-image">
											<div class="overlay-effect">
											<?php // Layers Featured Media											
													if( isset( $instance['show_media'] ) ) {?>
														<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
														
														<?php  the_post_thumbnail('Univ_blog_widget_image'); ?>
														
														
														</a>
												<?php } //end meadia?>	
											</div>    
										</div>	
										
										<?php  }else{ ?>
											<?php /**
										* Display the Featured Thumbnail
										*/
										echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'overlay-effect', 'size' => 'univ_right_blog_image' ) ); ?>
										
										<?php } ?>
										
										<?php if( isset( $instance['show_content'] ) ) { ?>
										<div class="single-blog-text wb">
										
										   <?php if( isset( $instance['show_titles'] ) ) { ?>
														<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
											<?php } //end title ?>	
													
											<div class="blog-date">
												<span><i class="fa fa-calendar"></i><?php the_time('F j, Y'); ?></span>
												<span><i class="fa fa-folder-o"></i><?php the_category( ' / ' ); ?></span>
												<span>
													<a class="right" href="">
														<i class="fa fa-comment"></i> <?php comments_number( '0', '1', '%' ); ?>
													</a>
												</span>
											</div>
												<p>
												<?php if( isset( $instance['show_excerpts'] ) ) {
															if( isset( $instance['excerpt_length'] ) && '' == $instance['excerpt_length'] ) {
															
																	the_content();
															
															} else if( isset( $instance['excerpt_length'] ) && 0 != $instance['excerpt_length'] && strlen( get_the_excerpt() ) > $instance['excerpt_length'] ){
																echo  substr( get_the_excerpt() , 0 , $instance['excerpt_length'] ) . '&#8230;';
															} else if( '' != get_the_excerpt() ){
																echo  get_the_excerpt();
															}
														}; 
												//end Content?>	
												</p>
											<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more' , 'univ' ); ?></a>
										</div>
										<?php }//end content ?>		
									</div>														
								<?php }; // while have_posts ?>
							</div><!-- /carsol -->
						</div><!-- /row -->
						<?php } elseif( isset( $instance['styleclass2'] ) ) { ?>
							<?php if( isset( $instance['carsolshow'] ) ) { ?>
									<div class="grid blog-style-three bfs">
										<div class="blog-carousel carousel-style-one">
								 <?php } else { ?>	
									<div class="noclass">
										<div class="grid blog-style-three bfs">
								 <?php } //end carsol show/hide ?>										
								
								<?php while( $post_query->have_posts() ) {
									$post_query->the_post();

										/**
										* Set Individual Column CSS
										*/
										$post_column_class = array();
										$post_column_class[] = 'single-blog-pading';
										$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
										$post_column_class[] = $span_class;
										$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
										$post_column_class = implode( ' ' , $post_column_class );
										?>			
																
									<div class="<?php echo $post_column_class; ?>" data-cols="<?php echo $col_count; ?>">		
										<div class="single-blog-item border overlay-hover">
										<?php if ( has_post_thumbnail() ) {?>
											<div class="single-blog-image">
												<div class="overlay-effect">
													<?php // Layers Featured Media											
														if( isset( $instance['show_media'] ) ) {?>
															<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
															<?php the_post_thumbnail('Univ_blog_widget_image'); ?>
																
															
															</a>
													<?php } //end meadia?>	
												</div>
											</div>
										<?php  }else{ ?>
										
											<?php /**
											* Display the Featured Thumbnail
											*/
												echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'overlay-effect', 'size' => 'univ_right_blog_image' ) ); ?>
											
											<?php } ?>
											
											<?php if( isset( $instance['show_content'] ) ) { ?>
											<div class="single-blog-text wb">
												 <?php if( isset( $instance['show_titles'] ) ) { ?>
														<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
												<?php } //end title ?>
												<p>
													<?php if( isset( $instance['show_excerpts'] ) ) {
																if( isset( $instance['excerpt_length'] ) && '' == $instance['excerpt_length'] ) {
																
																		the_content();
																
																} else if( isset( $instance['excerpt_length'] ) && 0 != $instance['excerpt_length'] && strlen( get_the_excerpt() ) > $instance['excerpt_length'] ){
																	echo  substr( get_the_excerpt() , 0 , $instance['excerpt_length'] ) . '&#8230;';
																} else if( '' != get_the_excerpt() ){
																	echo  get_the_excerpt();
																}
															}; 
													//end Content?>	
												</p>
												<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more' , 'univ' ); ?></a>
											</div>
											<?php }//end content ?>	
										</div>
									</div>			
											
								<?php }; // while have_posts ?>
							</div><!-- /carsol -->
						</div><!-- /row -->						
						<?php } // if show style 2 ?>						
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
							'styleclass1' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'styleclass1' ) ,
							'id' => $this->get_layers_field_id( 'styleclass1' ) ,
							'value' => ( isset( $instance['styleclass1'] ) ) ? $instance['styleclass1'] : NULL,
							'label' => __( 'show style 1' , 'univ' )
							),
							'styleclass2' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'styleclass2' ) ,
							'id' => $this->get_layers_field_id( 'styleclass2' ) ,
							'value' => ( isset( $instance['styleclass2'] ) ) ? $instance['styleclass2'] : NULL,
							'label' => __( 'show style 2' , 'univ' )
							),
							
							'carsolshow' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'carsolshow' ) ,
							'id' => $this->get_layers_field_id( 'carsolshow' ) ,
							'value' => ( isset( $instance['carsolshow'] ) ) ? $instance['carsolshow'] : NULL,
							'label' => __( 'Show/hide Carousel' , 'univ' )
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
							'show_pagination' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_pagination' ) ,
							'id' => $this->get_layers_field_id( 'show_pagination' ) ,
							'value' => ( isset( $instance['show_pagination'] ) ) ? $instance['show_pagination'] : NULL,
							'label' => __( 'show pagination' , 'univ' )
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
								'label' => __( 'Show Post Excerpts' , 'univ' )
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
						),
					'columns',
					'background',
					'advanced',
				), $this, $instance )
			); ?>
			<div class="layers-container-large">

				<?php $this->form_elements()->header( array(
					'title' =>  __( 'News Post' , 'univ' ),
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
	 register_widget("Univ_Blog_Widget");
}