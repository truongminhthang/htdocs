<?php  /**
 * Gellary Widget
 *
 * This file is used to register and display the Layers - Gellary widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( class_exists('Layers_Widget') && !class_exists( 'univ_Portfolios_Widget' ) ) {	
	class univ_Portfolios_Widget extends Layers_Widget {

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
			$this->widget_title = __( 'Univ:: Portfolio' , 'univ' );
			$this->widget_id = 'portfolios';
			$this->post_type = 'univ_gallery';
			$this->taxonomy = 'gallery_category';
			$this->checkboxes = array(
					'stylet1',
					'stylet2',
					'show_media',					
					'show_pagination',
					'show_cat',
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
				'title' => __( 'Our Gallery ', 'univ' ),
				'excerpt' => __( 'Stay up to date with all our latest news and launches. Only the best quality makes it onto our blog!', 'univ' ),
				'category' => 0,
				'show_media' => 'on',
				'stylet1' => 'on',
				'stylet2' => 'off',
				'show_pagination' => 'off',
				'show_cat' => 'on',
				'show_categories' => 'on',
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
					<!-- style strat 1 -->		
					<?php if( isset( $instance['stylet1'] ) ) { ?>							
						<!-- Filter Nav Cat-->
						 <div class="container filter-menu">
								<ul>
								   <li class="filter" data-filter="all"><?php esc_html_e( 'All' , 'univ' ); ?></li>
									<?php foreach( $terms as $cats ) {							
										$slug = $cats->slug;
										$name = $cats->name;									
									?>
									<li class="filter" data-filter=".<?php echo $slug ;?>"><?php echo $name; ?></li>
									<?php } ?>
								</ul>
						 </div>
						 <!-- Filter post Query-->
						<?php if( $post_query->have_posts() ) { ?>
							<div class="<?php echo $this->get_widget_layout_class( $instance ); ?>">
							   <div class="gallery-row">
									<div class="filter-items">
										<div class="grid fportfolio">							 
												<?php while( $post_query->have_posts() ) {
													$post_query->the_post();
														/**
														* Set Individual Column CSS
														*/
														$post_column_class = array();
														$post_column_class[] = '';
														$post_column_class[] = 'cols';
														$post_column_class[] = ' mix single-items';
														$post_column_class[] = 'gimage';
														$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
														$post_column_class[] = $span_class;
														$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
														$post_column_class = implode( ' ' , $post_column_class );
														?>																								
											<?php 
												$categories = get_the_terms(get_the_id(),'gallery_category');
											?>									
											<div class="<?php echo $post_column_class; ?> <?php foreach($categories as $single_slug){echo $single_slug->slug. ' ';}	?> overlay-hover" data-cols="<?php echo $col_count; ?>">
												<div class="overlay-effect">
													<?php if( isset( $instance['show_media'] ) ) {?>
															<a href="#">
																<?php 
																	if ( has_post_thumbnail() ) {
																		 the_post_thumbnail(); 
																	} ?>
															</a>
														<?php } //end meadia?>
													<?php if( isset( $instance['show_cat'] ) ) {?>
													<div class="gallery-hover-effect">
														<a class="gallery-icon venobox" data-gall="myGallery" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' );?>"><i class="fa fa-search"></i></a>

													<?php if( $categories ){?>	
														<div class="cat-wrapper">
															<?php foreach( $categories as $single_slug ){?>
																<span class="category-text">
																   <?php echo $single_slug->name ;?>
																</span>	
															<?php }?>
														</div>
													<?php } ?>
													</div>
													<?php } ?>
												</div>		
											</div>										
										<?php }; // while have_posts ?>
										</div><!-- /row -->
									</div><!-- /filter item -->
								</div><!-- /gallery row -->
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
					<!-- style strat 2 -->	
					<?php } elseif( isset( $instance['stylet2'] ) ) { ?>
					
						<?php if( $post_query->have_posts() ) { ?>
							<div class="<?php echo $this->get_widget_layout_class( $instance ); ?>">
								<div class="grid sportfolio">
					 
										<?php while( $post_query->have_posts() ) {
											$post_query->the_post();
												/**
												* Set Individual Column CSS
												*/
												$post_column_class = array();
												$post_column_class[] = 'single-items';
												$post_column_class[] = 'gimage';
												$post_column_class[] = 'column' . ( 'on' != $this->check_and_return( $instance, 'design', 'gutter' ) ? '-flush' : '' );
												$post_column_class[] = $span_class;
												$post_column_class[] = ( '' != $this->check_and_return( $instance, 'design', 'column-background-color' ) && 'dark' == layers_is_light_or_dark( $this->check_and_return( $instance, 'design', 'column-background-color' ) ) ? 'invert' : '' );
												$post_column_class = implode( ' ' , $post_column_class );
												?>
												<?php 
													$categories = get_the_terms(get_the_id(),'gallery_category');		
												?>
													<div class="<?php echo $post_column_class; ?>  overlay-hover" data-cols="<?php echo $col_count; ?>">
														<div class="overlay-effect sea-green-overlay">
														<?php if( isset( $instance['show_media'] ) ) {?>
															<a href="#">
																<?php 
																	if ( has_post_thumbnail() ) {
																		 the_post_thumbnail(); 
																	} ?>
															</a>
														<?php } //end meadia?>	
															<?php if( isset( $instance['show_cat'] ) ) {?>
															<div class="gallery-hover-effect">
																<a class="gallery-icon venobox" data-gall="myGallery" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), 'full' );?>"><i class="fa fa-search-plus"></i></a>
																<?php if( $categories ){?> 
																	<div class="cat-wrapper">
																		<?php foreach( $categories as $single_slug ){?>
																			<span class="category-text">
																			   <?php echo $single_slug->name ;?>
																			</span>	
																		<?php }?>
																	</div>																
																<?php } ?>
																
															</div> 
															<?php } ?>
														</div>
													</div>		
										<?php }; // while have_posts ?>
								</div><!-- /row -->
							</div><!-- /filter item -->
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
					<?php } // if show div data ?>							
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
							'show_cat' => array(
								'type' => 'checkbox',
								'name' => $this->get_layers_field_name( 'show_cat' ) ,
								'id' => $this->get_layers_field_id( 'show_cat' ) ,
								'value' => ( isset( $instance['show_cat'] ) ) ? $instance['show_cat'] : NULL,
								'label' => __( 'Show Category' , 'univ' )
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
					'title' =>  __( 'Gallery Section' , 'univ' ),
					'icon_class' =>'gallery'
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
	 register_widget("univ_Portfolios_Widget");
}