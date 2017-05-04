<?php  /**
 * Sliders Widget
 *
 * This file is used to register and display the Univ - Slider widget.
 *
 * @package Layers
 * @since Layers 1.0.0
 */
if( class_exists('Layers_Widget') && !class_exists( 'univ_New_Slider_Widget' ) ) {
	class univ_New_Slider_Widget extends Layers_Widget {

		/**
		*  Widget construction
		*/
	 	function __construct() {

			/**
			* Widget variables
			*
			* @param  	string    		$this->widget_id    	Widget title
			* @param  	string    		$widget_id    		Widget slug for use as an ID/classname
			* @param  	string    		$post_type    		(optional) Post type for use in widget options
			* @param  	string    		$taxonomy    		(optional) Taxonomy slug for use as an ID/classname
			* @param  	array 			$checkboxes    	(optional) Array of checkbox names to be saved in this widget. Don't forget these please!
			*/
			$this->widget_title = __( 'Univ:: Slider' , 'univ' );
			$this->widget_id = 'univ_new_slider';
			$this->post_type = '';
			$this->taxonomy = '';
			$this->checkboxes = array(
				'show_slider_arrows',
				'show_slider_dots',
				'autoplay_slides',
				'autoheight_slides',
				'show_slider_btn',
				'show_slider_title',
				'show_slider_title2',
				'show_slider_excerpt',
				'hidden_lg',
				'hidden_md',
				'hidden_sm',
				'hidden_xs',
			);

	 		/* Widget settings. */
			$widget_ops = array(
				'classname' => 'obox-layers-' . $this->widget_id .'-widget',
				'description' => __( 'This widget is used to display slides and can be used to display a page-banner.', 'univ' ) ,
				'customize_selective_refresh' => TRUE,
			);

			/* Widget control settings. */
			$control_ops = array(
				'width' => LAYERS_WIDGET_WIDTH_LARGE,
				'height' => NULL,
				'id_base' => LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
			);

			/* Create the widget. */
			parent::__construct(
				LAYERS_THEME_SLUG . '-widget-' . $this->widget_id ,
				$this->widget_title,
				$widget_ops,
				$control_ops
			);

			/* Setup Widget Defaults */
			$this->defaults = array (
				'title' => NULL,
				'excerpt' => NULL,
				'slider_excerpt' => NULL,
				'slide_height' => '768',
				'show_slider_arrows' => 'on',
				'show_slider_dots' => 'on',
				'animation_type' => 'slide',
				'show_slider_btn' => 'on',
				'show_slider_title' => 'on',
				'show_slider_title2' => 'on',
				'show_slider_excerpt' => 'on',
				'hidden_lg' => 'off',
				'hidden_md' => 'off',
				'hidden_sm' => 'off',
				'hidden_xs' => 'off',
			);

			/* Setup Widget Repeater Defaults */
			$this->register_repeater_defaults( 'slide', 1, array(
				'title' => __( 'Welcome to Univ','univ' ),
				'title2' => __( 'Make your business on Univ', 'univ' ),
				'excerpt' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel volutpat felis, eu condimentum massa. Pellentesque mollis eros vel mattis tempor. Aliquam eu efficitur enim, vitae fermentum orci. Sed et feugiat nulla.', 'univ' ),

				'univ_slider_bg_video_type' => 'none',
				'univ_slider_bg_youtube_video' => '',
				'univ_slider_bg_vimeo_video' => '',
				'univ_slider_bg_local_video' => '',


				'slider_btn1' => __( 'App Store', 'univ' ),
				'slider_btn1_smt' => __( 'Available on the', 'univ' ),
				'slider_btn1_icon' => 'apple',
				'slider_btn1_link' => '#',
				'slider_btn1_target' => '_self',

				'slider_btn2' => __( 'Play Store', 'univ' ),
				'slider_btn2_smt' => __( 'Available on the', 'univ' ),
				'slider_btn2_icon' => 'google-play',
				'slider_btn2_link' => '#',
				'slider_btn2_target' => '_self',


				'at_overlay' => '7',
				'atsfontsize' => '72',
				'atssubfontsize' => '72',
				'atsexcfontsize' => '16',
				'atsexclineheight' => '24',
				'title_start_animation' => 'none',
				'title_end_animation' => 'none',
				'title2_start_animation' => 'none',
				'title2_end_animation' => 'none',

				'design' => array(
					'imagealign' => 'image-top',
					'imageratios' => NULL,
					'background' => array(
						'color' => '#1879FD',
						'position' => 'center',
						'repeat' => 'no-repeat',
						'size' => 'cover'
					),
					'fonts' => array(
						'color' => NULL,
						'align' => 'text-left',
						'size' => 'large',
						'shadow' => '',
						'heading-type' => 'h3',
					)
				),
				'button1' => array(
					'link_type' => 'custom',
					'link_type_custom' => '#more',
					'link_text' => __( 'App Store', 'univ' ),
				),
				'button2' => array(
					'link_type' => 'custom',
					'link_type_custom' => '#more',
					'link_text' => __( 'Play Store', 'univ' ),
				),
			) );

		}

		/**
		* Enqueue Scripts
		*/
		function enqueue_scripts(){

			// Enqueue Swiper Slider
			wp_enqueue_script( LAYERS_THEME_SLUG . '-slider-js' );
			wp_enqueue_style( LAYERS_THEME_SLUG . '-slider' );
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

			// Enqueue Scipts when needed
			$this->enqueue_scripts();

			// Apply slider arrow color
			if( $this->check_and_return( $instance, 'slider_arrow_color' ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id, 'color', array( 'selectors' => array( '.arrows a' ), 'color' => $this->check_and_return( $instance, 'slider_arrow_color' ) ) );
			if( $this->check_and_return( $instance, 'slider_arrow_color' ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id, 'border', array( 'selectors' => array( 'span.swiper-pagination-switch' ), 'border' => array( 'color' => $this->check_and_return( $instance, 'slider_arrow_color' ) ) ) );
			if( $this->check_and_return( $instance, 'slider_arrow_color' ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'selectors' => array( 'span.swiper-pagination-switch' ), 'background' => array( 'color' => $this->check_and_return( $instance, 'slider_arrow_color' ) ) ) );
			if( $this->check_and_return( $instance, 'slider_arrow_color' ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id, 'background', array( 'selectors' => array( 'span.swiper-pagination-switch.swiper-active-switch' ), 'background' => array( 'color' => 'transparent !important' ) ) );


			// Get slider height css
			$slider_height_css = '';
			if( 'layout-full-screen' != $this->check_and_return( $instance , 'design', 'layout' ) && FALSE == $this->check_and_return( $instance , 'autoheight_slides' ) && $this->check_and_return( $instance , 'slide_height' ) ) {
				$slider_height_css = 'height: ' . $instance['slide_height'] . 'px; ';
			}

			// Apply the advanced widget styling
			$this->apply_widget_advanced_styling( $widget_id, $instance );

			/**
			* Generate the widget container class
			*/

			$widget_container_class = array();
			$widget_container_class[] = 'widget';
			$widget_container_class[] = 'row';
			$widget_container_class[] = 'slide';
			$widget_container_class[] = 'layers-slider-widget';
			$widget_container_class[] = 'swiper-container';
			$widget_container_class[] = 'at-slider-wrapper';
			$widget_container_class[] = 'loading'; // `loading` will be changed to `loaded` to fade in the slider.
			$widget_container_class[] = $this->check_and_return( $instance , 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.

			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_lg' ) ? 'hidden-lg' : 'block-lg' );
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_md' ) ? 'hidden-md' : 'block-md' );
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_sm' ) ? 'hidden-sm' : 'block-sm' );
			$widget_container_class[] = ( 'on' == $this->check_and_return( $instance , 'design', 'hidden_xs' ) ? 'hidden-xs' : 'block-xs' );

			$widget_container_class[] = $this->get_widget_spacing_class( $instance );
			$widget_container_class[] = $this->get_widget_layout_class( $instance );

			if( $this->check_and_return( $instance , 'autoheight_slides' ) ) {
				if( FALSE !== ( $fullwidth = array_search( 'full-screen', $widget_container_class ) ) ){
					unset( $widget_container_class[ $fullwidth ] );
				}
				$widget_container_class[] = 'auto-height';
			}

			if( $this->check_and_return( $instance , 'design', 'layout') ) {
				// Slider layout eg 'slider-layout-full-screen'
				$widget_container_class[] = 'slider-' . $instance['design']['layout'];
			}
			if( ( ! isset( $instance['design']['layout'] ) || ( isset( $instance['design']['layout'] ) && 'layout-full-screen' != $instance['design']['layout'] ) ) ) {
				// If slider is not full screen
				$widget_container_class[] = 'not-full-screen';
			}
			if( 1 == count( $instance[ 'slides' ] ) ) {
				// If only one slide
				$widget_container_class[] = 'single-slide';
			}

			$widget_container_class = apply_filters( 'layers_slider_widget_container_class' , $widget_container_class, $this, $instance );
			$widget_container_class = implode( ' ', $widget_container_class );

			/**
			 * Slider HTML
			 */

			if( ! empty( $instance[ 'slides' ] ) ) { ?>

				<?php
				// Custom Anchor
				echo $this->custom_anchor( $instance ); ?>

				<div id="<?php echo esc_attr( $widget_id ); ?>" class="<?php echo esc_attr( $widget_container_class ); ?>" style="<?php echo esc_attr( $slider_height_css ); ?>" <?php $this->selective_refresh_atts( $args ); ?>>

					<?php do_action( 'layers_before_slider_widget_inner', $this, $instance ); ?>

					<?php if( 1 < count( $instance[ 'slides' ] ) && isset( $instance['show_slider_arrows'] ) ) { ?>
						 <div class="arrows">
							<a href="" class="l-left-arrow animate"></a>
							<a href="" class="l-right-arrow animate"></a>
						</div>
					<?php } ?>

					<div class="<?php echo $this->get_layers_field_id( 'pages' ); ?> pages animate">
						<?php for( $i = 0; $i < count( $instance[ 'slides' ] ); $i++ ) { ?>
							<a href="" class="page animate <?php if( 0 == $i ) echo 'active'; ?>"></a>
						<?php } ?>
					</div>

			 		<div class="swiper-wrapper at-slider-wrap">
						<?php foreach ( wp_parse_id_list( $instance[ 'slide_ids' ] ) as $slide_key ) {

							// Make sure we've got a column going on here
							if( !isset( $instance[ 'slides' ][ $slide_key ] ) ) continue;

							// Setup the relevant slide
							$item_instance = $instance[ 'slides' ][ $slide_key ];

							// Mix in new/unset defaults on every instance load (NEW)
							$item_instance = $this->apply_defaults( $item_instance, 'slide' );

							// Set the background styling
							if( !empty( $item_instance['design'][ 'background' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id . '-' . $slide_key , 'background', array( 'background' => $item_instance['design'][ 'background' ] ) );
							if( !empty( $item_instance['design']['fonts'][ 'color' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id . '-' . $slide_key , 'color', array( 'selectors' => array( '.heading', '.heading a', 'div.excerpt' ) , 'color' => $item_instance['design']['fonts'][ 'color' ] ) );
							if( !empty( $item_instance['design']['fonts'][ 'shadow' ] ) ) $this->inline_css .= layers_inline_styles( '#' . $widget_id . '-' . $slide_key , 'text-shadow', array( 'selectors' => array( '.heading', '.heading a',  'div.excerpt' )  , 'text-shadow' => $item_instance['design']['fonts'][ 'shadow' ] ) );

							// Set the button styling
							$button_size = '';
							if ( function_exists( 'layers_pro_apply_widget_button_styling' ) ) {
								$button_size = $this->check_and_return( $item_instance , 'design' , 'buttons-size' ) ? 'btn-' . $this->check_and_return( $item_instance , 'design' , 'buttons-size' ) : '' ;
								$this->inline_css .= layers_pro_apply_widget_button_styling( $this, $item_instance, array( "#{$widget_id}-{$slide_key} .button" ) );
							}

							// Set Featured Media
							$featureimage = $this->check_and_return( $item_instance , 'design' , 'featuredimage' );
							$featurevideo = $this->check_and_return( $item_instance , 'design' , 'featuredvideo' );

							// Set Image Sizes
							if( isset( $item_instance['design'][ 'imageratios' ] ) ){

									// Translate Image Ratio into something usable
									$image_ratio = layers_translate_image_ratios( $item_instance['design'][ 'imageratios' ] );
									$use_image_ratio = $image_ratio . '-medium';

							} else {
								$use_image_ratio = 'large';
							}

							// Get the button array.
							// $link_array       = $this->check_and_return_link( $item_instance, 'button' );
							// $link_href_attr   = ( $link_array['link'] ) ? 'href="' . esc_url( $link_array['link'] ) . '"' : '';
							// $link_target_attr = ( '_blank' == $link_array['target'] ) ? 'target="_blank"' : '';

 							/**
							* Set Individual Slide CSS
							*/
							$slide_class = array();
							$slide_class[] = 'swiper-slide';
							if( $this->check_and_return( $item_instance, 'design', 'background' , 'color' ) ) {
								if( 'dark' == layers_is_light_or_dark( $this->check_and_return( $item_instance, 'design', 'background' , 'color' ) ) ) {
									$slide_class[] = 'invert';
								}
							} else {
								$slide_class[] = 'invert';
							}
							if( false != $this->check_and_return( $item_instance , 'image' ) || 'image-left' == $item_instance['design'][ 'imagealign' ] || 'image-top' == $item_instance['design'][ 'imagealign' ] ) {
								$slide_class[] = 'has-image';
							}
							if( isset( $item_instance['design'][ 'imagealign' ] ) && '' != $item_instance['design'][ 'imagealign' ] ) {
								$slide_class[] = $item_instance['design'][ 'imagealign' ];
							}
							if( isset( $item_instance['design']['fonts'][ 'align' ] ) && '' != $item_instance['design']['fonts'][ 'align' ] ) {
								$slide_class[] = $item_instance['design']['fonts'][ 'align' ];
							}
							$slide_class[] = $this->check_and_return( $item_instance, 'design', 'advanced', 'customclass' ); // Apply custom class from design-bar's advanced control.

							$slide_class = apply_filters( 'layers_slider_widget_item_class', $slide_class, $this, $item_instance, $instance );
							$slide_class = implode( ' ', $slide_class );

							// Set link entire slide or not
							$slide_wrapper_tag = 'div';
							$slide_wrapper_href = '';

							?>

							<<?php echo $slide_wrapper_tag; ?> class="<?php echo $slide_class; ?>" id="<?php echo $widget_id; ?>-<?php echo $slide_key; ?>" style="float: left; <?php echo $slider_height_css; ?>">

								<?php do_action( 'layers_before_slider_widget_item_inner', $this, $item_instance, $instance ); ?>

								<?php



								
								

								/**
								* Set Overlay CSS Classes
								*/
								$overlay_class = array();
								$overlay_class[] = 'overlay';
								if( isset( $item_instance['design'][ 'background' ][ 'darken' ] ) ) {
									$overlay_class[] = 'darken';
								}
								if( '' != $this->check_and_return( $item_instance, 'design' , 'background', 'image' ) || '' != $this->check_and_return( $item_instance, 'design' , 'background', 'color' ) ) {
									$overlay_class[] = 'content';
								}
								
								$overlay_classes = implode( ' ', $overlay_class ); ?>
								

								
								<!-- Start video bg area -->
								<?php
									$youtubevideolink = $this->check_and_return( $item_instance, 'univ_slider_bg_youtube_video' );
									$youtubevideourl = $youtubevideolink;
									if(isset($youtubevideourl) && !empty($youtubevideourl)){
										$youtube_videoid = layers_get_youtube_id( $youtubevideourl );
									}
									$autoplay = '&autoplay=1';
								 ?>

								<?php
									$vimeovideolink = $this->check_and_return( $item_instance, 'univ_slider_bg_vimeo_video' );
									$vimeovideourl = $vimeovideolink;
									if(isset($vimeovideourl) && !empty($vimeovideourl)){
										$vimeo_videoid = layers_get_vimeo_id( $vimeovideourl );
									}
									$autoplay = '&autoplay=1';
								 ?>

								<?php
									$localvideolink = $this->check_and_return( $item_instance, 'univ_slider_bg_local_video' );
									$local_autoplay = 'autoplay';
								 ?>

								<?php if( 'none' == $this->check_and_return( $item_instance, 'univ_slider_bg_video_type' )){ ?>
								<?php }elseif( 'asb_youtube' == $this->check_and_return( $item_instance, 'univ_slider_bg_video_type' ) && '' != $this->check_and_return( $item_instance, 'univ_slider_bg_youtube_video' ) ) { ?>
						            <div class="univ-slider-video fitvidsignore layers-slider-video-wide">
										<iframe frameborder="0" src="//www.youtube.com/embed/<?php echo $youtube_videoid; ?>?enablejsapi=1&controls=0&loop=1&playlist=<?php echo $youtube_videoid; ?>&rel=0&showinfo=0&autohide=1&wmode=transparent&hd=1<?php echo $autoplay; ?>"></iframe>
									</div>

								<?php }elseif( 'asb_vimeo' == $this->check_and_return( $item_instance, 'univ_slider_bg_video_type' ) && '' != $this->check_and_return( $item_instance, 'univ_slider_bg_vimeo_video' ) ) { ?>
						            <div class="univ-slider-video fitvidsignore layers-slider-video-wide">
										<iframe frameborder="0" src="//player.vimeo.com/video/<?php echo $vimeo_videoid; ?>?title=0&controls=0&byline=0&portrait=0&loop=1&background=1<?php echo $autoplay; ?>" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									</div>


								<?php }elseif( 'asb_selfhost' == $this->check_and_return( $item_instance, 'univ_slider_bg_video_type' ) && '' != $this->check_and_return( $item_instance, 'univ_slider_bg_local_video' ) ) { ?>
						            <div class="univ-slider-video fitvidsignore layers-slider-video-wide">

										<video <?php if( $wp_customize ) echo 'customizer'; ?> <?php echo $local_autoplay; ?> loop >
										<?php if( $localvideolink ) { ?>
											<source src="<?php echo wp_get_attachment_url( $localvideolink ); ?>" type="video/mp4" />
										<?php } ?>
										</video>
									</div>

								<?php }?>
								<!-- End video bg area -->




								<!-- End univ bg video  -->

								<div class="<?php echo $overlay_classes; ?>" data-overlay="<?php echo $item_instance['at_overlay']?>">
						
									<div class="container clearfix">
										<?php if( '' != $item_instance['title'] || '' != $item_instance['slider_excerpt']  || '' != $item_instance['title2'] ) { ?>
											<div class="copy-container">
												<div class="section-title  <?php echo ( isset( $item_instance['design']['fonts'][ 'size' ] ) ? $item_instance['design']['fonts'][ 'size' ] : '' ); ?>">

													<?php if( $this->check_and_return( $item_instance , 'title' ) ) { ?>
														<<?php echo $this->check_and_return( $item_instance, 'design', 'fonts', 'heading-type' ); ?> 
														data-swiper-parallax="-100" style="font-size:<?php echo $item_instance['atsfontsize']?>px" class="heading univ-ani-heading wow" data-in-effect="<?php echo $item_instance['title_start_animation']?>"  data-out-effect="<?php echo $item_instance['title_end_animation']?>"><?php if( isset( $instance['show_slider_title'] ) ) { ?>
																<?php echo $item_instance['title']; ?>									
															<?php } ?>

														</<?php echo $this->check_and_return( $item_instance, 'design', 'fonts', 'heading-type' ); ?>>
													<?php } ?>
													
													<?php if( $this->check_and_return( $item_instance , 'title2' ) ) { ?>
														<<?php echo $this->check_and_return( $item_instance, 'design', 'fonts', 'heading-type' ); ?> 
														data-swiper-parallax="-200" style="font-size:<?php echo $item_instance['atssubfontsize']?>px" class="heading slider-subtitle wow" data-in-effect="<?php echo $item_instance['title2_start_animation']?>"  data-out-effect="<?php echo $item_instance['title2_end_animation']?>" ><?php if( isset( $instance['show_slider_title2'] ) ) { ?>
																<?php echo $item_instance['title2']; ?>
															<?php } ?>
														</<?php echo $this->check_and_return( $item_instance, 'design', 'fonts', 'heading-type' ); ?>>
													<?php } ?>

													<?php if( $this->check_and_return( $item_instance , 'excerpt' ) ) { ?>
														<?php if( isset( $instance['show_slider_excerpt'] ) ) { ?>
														<div data-swiper-parallax="-300" class="excerpt"><?php echo $item_instance['excerpt']; ?></div>
														<?php } ?>
													<?php } ?>
													<!-- Start slider button -->
													<?php if( 'div' == $slide_wrapper_tag ) { ?>
														<?php if( isset( $instance['show_slider_btn'] ) ) { ?>
														<div class="button-set at-slider-btn-grp">

															<?php if( $this->check_and_return( $item_instance , 'slider_btn1' ) ) { ?>

																 <a class="button active <?php echo $button_size; ?>" href="<?php echo $item_instance['slider_btn1_link']?>" target="<?php echo $item_instance['slider_btn1_target']?>"  data-swiper-parallax="-200">
			                                                        <i class="zmdi zmdi-<?php echo $item_instance['slider_btn1_icon']; ?>"></i>
			                                                        <span>
			                                                            <?php echo $item_instance['slider_btn1_smt']; ?>
			                                                            <span class="large-text"><?php echo $item_instance['slider_btn1']; ?></span>
			                                                        </span>
			                                                    </a>

															<?php } ?>

															<?php if( $this->check_and_return( $item_instance , 'slider_btn2' ) ) { ?>

																 <a class="button active <?php echo $button_size; ?>" href="<?php echo $item_instance['slider_btn2_link']?>" target="<?php echo $item_instance['slider_btn2_target']?>"  data-swiper-parallax="-200">
			                                                        <i class="zmdi zmdi-<?php echo $item_instance['slider_btn2_icon']; ?>"></i>
			                                                        <span>
			                                                            <?php echo $item_instance['slider_btn2_smt']; ?>
			                                                            <span class="large-text"><?php echo $item_instance['slider_btn2']; ?></span>
			                                                        </span>
			                                                    </a>

															<?php } ?>

		                                                </div>
													<?php } }?>
													<!-- End Slider Button -->
												</div>
											</div>
										<?php } // if title || excerpt ?>
										<?php if( $featureimage || $featurevideo ) { ?>
											<div class="image-container <?php echo ( 'image-round' ==  $this->check_and_return( $item_instance, 'design',  'imageratios' ) ? 'image-rounded' : '' ); ?>">
												<?php echo layers_get_feature_media(
													$featureimage ,
													$use_image_ratio ,
													$featurevideo
												); ?>
											</div>
										<?php } // if $item image  ?>
									</div> <!-- .container -->
								</div> <!-- .overlay -->





								<?php do_action( 'layers_after_slider_widget_item_inner', $this, $item_instance, $instance ); ?>

							</<?php echo $slide_wrapper_tag; ?>>
						<?php } // foreach slides ?>
					</div>

					<?php do_action( 'layers_after_slider_widget_inner', $this, $instance );

					// Print the Inline Styles for this Widget
					$this->print_inline_css();
					
					
					?>
					 <style type="text/css">
						  #<?php echo esc_html( $widget_id . '-' . $slide_key ); ?> .excerpt p{
						   font-size: <?php echo $item_instance['atsexcfontsize']?>px;
						   line-height: <?php echo $item_instance['atsexclineheight']?>px;
						  }
					 </style> <?php

					/**
					 * Slider javascript initialize
					 */
					$swiper_js_obj = str_replace( '-' , '_' , $this->get_layers_field_id( 'slider' ) ); ?>
					<script type='text/javascript'>
						jQuery(function($){

							var <?php echo $swiper_js_obj; ?> = $('#<?php echo $widget_id; ?>').swiper({
							mode:'horizontal'
							,onInit: function(s){
								$(document).trigger( 'layers-slider-init', s);
							}
							,bulletClass: 'swiper-pagination-switch'
							,bulletActiveClass: 'swiper-active-switch swiper-visible-switch'
							,paginationClickable: true
							,watchActiveIndex: true
							<?php if( 'fade' ==  $this->check_and_return( $instance, 'animation_type' ) ) { ?>
								,effect: '<?php echo $instance['animation_type']; ?>'
							<?php } else if( 'parallax' ==  $this->check_and_return( $instance, 'animation_type' ) ) { ?>
								,speed: 700
								,parallax: true
								<?php } ?>

								<?php if( isset( $instance['show_slider_dots'] ) && ( !empty( $instance[ 'slides' ] ) && 1 < count( $instance[ 'slides' ] ) ) ) { ?>
								,pagination: '.<?php echo $this->get_layers_field_id( 'pages' ); ?>'
								<?php } ?>
								<?php if( 1 < count( $instance[ 'slides' ] ) ) { ?>
									,loop: true
							<?php } else { ?>
								,loop: false
								,noSwiping: true
								,allowSwipeToPrev: false
								,allowSwipeToNext: false
								<?php } ?>
								<?php if( isset( $instance['autoplay_slides'] ) && isset( $instance['slide_time'] ) && is_numeric( $instance['slide_time'] ) ) {?>
									, autoplay: <?php echo ($instance['slide_time']*1000); ?>
								<?php }?>
								<?php if( isset( $wp_customize ) && $this->check_and_return( $instance, 'focus_slide' ) ) { ?>
									,initialSlide: <?php echo $this->check_and_return( $instance, 'focus_slide' ); ?>
								<?php } ?>
							});

							<?php if( 1 < count( $instance[ 'slides' ] ) ) { ?>
								// Allow keyboard control
								<?php echo $swiper_js_obj; ?>.enableKeyboardControl();
							<?php } // if > 1 slide ?>

							<?php if( TRUE == $this->check_and_return( $instance , 'autoheight_slides' ) ) { ?>
								$( '#<?php echo esc_attr( $widget_id ); ?>' ).imagesLoaded(function(){
									layers_swiper_resize( <?php echo $swiper_js_obj; ?> );
								});

								$(window).resize(function(){
									layers_swiper_resize( <?php echo $swiper_js_obj; ?> );
								});
							<?php } ?>

							$('#<?php echo $widget_id; ?>').find('.arrows a').on( 'click' , function(e){
								e.preventDefault();

								// "Hi Mom"
								$that = $(this);

								if( $that.hasClass( 'swiper-pagination-switch' ) ){
									// Anchors
									<?php echo $swiper_js_obj; ?>.slideTo( $that.index() );
								} else if( $that.hasClass( 'l-left-arrow' ) ){
									// Previous
									<?php echo $swiper_js_obj; ?>.slidePrev();
								} else if( $that.hasClass( 'l-right-arrow' ) ){
									// Next
									<?php echo $swiper_js_obj; ?>.slideNext();
								}

								return false;
							});

							<?php echo $swiper_js_obj; ?>.init();

							// Do stuff if this is the first widget.
							if ( ! $('#<?php echo $widget_id; ?>').prev('.widget').length ) {
								if ( ! $('#<?php echo $widget_id; ?>').hasClass( '.full-screen' ) ) {
									jQuery('.header-site.header-overlay').css( 'transition', '0s' );
									setTimeout( function(){ jQuery('.header-site.header-overlay').css( 'transition', '' ); }, 1000 );
									jQuery('body').addClass( 'header-overlay-no-push' );
								}
							}

							// Fade-in slider after it's been initilaized (FOUC).
							$( '#<?php echo $widget_id; ?>' ).removeClass('loading').addClass('loaded');
						});
					</script>

				</div>
			<?php }

		}

		/**
		*  Widget update
		*/
	 	function update( $new_instance, $old_instance ) {

	 		if ( isset( $this->checkboxes ) ) {
				foreach( $this->checkboxes as $cb ) {
					if( isset( $old_instance[ $cb ] ) ) {
						$old_instance[ $cb ] = strip_tags( $new_instance[ $cb ] );
					}
				} // foreach checkboxes
			} // if checkboxes

			// Don't break the slider when
			if ( !isset( $new_instance['slides'] ) ) {
				$new_instance['slides'] = array();
			}

			return $new_instance;
		}

		/**
		*  Widget form
		*
		* We use regular HTML here, it makes reading the widget much easier than if we used just php to echo all the HTML out.
		*/
		function form( $instance ){

			// Use defaults if $instance is empty.
			if( empty( $instance ) && ! empty( $this->defaults ) ) {
				$instance = wp_parse_args( $instance, $this->defaults );
			}

			// Mix in new/unset defaults on every instance load (NEW)
			$instance = $this->apply_defaults( $instance );

			$components = apply_filters( 'layers_slide_widget_design_bar_components', array(
				'layout' => array(
					'icon-css' => 'icon-layout-fullwidth',
					'label' => __( 'Layout', 'univ' ),
					'wrapper-class' => 'layers-pop-menu-wrapper layers-small',
					'elements' => array(
						'layout' => array(
							'type' => 'select-icons',
							'label' => __( '' , 'univ' ),
							'name' => $this->get_layers_field_name( 'design', 'layout' ) ,
							'id' => $this->get_layers_field_id( 'design', 'layout' ) ,
							'value' => ( isset( $instance['design']['layout'] ) ) ? $instance['design']['layout'] : NULL,
							'options' => array(
								'layout-boxed' => __( 'Boxed' , 'univ' ),
								'layout-fullwidth' => __( 'Full Width' , 'univ' ),
								'layout-full-screen' => __( 'Full Screen' , 'univ' )
							),
						),
					),
				),
				'display' => array(
					'icon-css' => 'icon-slider',
					'label' => __( 'Slider', 'univ' ),
					'elements' => array(
						'autoheight_slides' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'autoheight_slides' ) ,
							'id' => $this->get_layers_field_id( 'autoheight_slides' ) ,
							'value' => ( isset( $instance['autoheight_slides'] ) ) ? $instance['autoheight_slides'] : NULL,
							'label' => __( 'Auto Height Slides' , 'univ' ),
						),
						'slide_height' => array(
							'type' => 'number',
							'name' => $this->get_layers_field_name( 'slide_height' ) ,
							'id' => $this->get_layers_field_id( 'slide_height' ) ,
							'value' => ( isset( $instance['slide_height'] ) ) ? $instance['slide_height'] : NULL,
							'label' => __( 'Slider Height (px)' , 'univ' ),
							
						),
						'show_slider_arrows' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_slider_arrows' ) ,
							'id' => $this->get_layers_field_id( 'show_slider_arrows' ) ,
							'value' => ( isset(  $instance['show_slider_arrows'] ) ) ?  $instance['show_slider_arrows'] : NULL,
							'label' => __( 'Show Slider Arrows' , 'univ' ),
						),
						'slider_arrow_color' => array(
							'type' => 'color',
							'name' => $this->get_layers_field_name( 'slider_arrow_color' ) ,
							'id' => $this->get_layers_field_id( 'slider_arrow_color' ) ,
							'value' => ( isset( $instance['slider_arrow_color'] ) ) ? $instance['slider_arrow_color'] : NULL,
							'label' => __( 'Slider Controls Color' , 'univ' ),
							'data' => array(
								'show-if-selector' => '#' . $this->get_layers_field_id( 'show_slider_arrows' ),
								'show-if-value' => 'true',
							),
						),
						'show_slider_dots' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_slider_dots' ) ,
							'id' => $this->get_layers_field_id( 'show_slider_dots' ) ,
							'value' => ( isset(  $instance['show_slider_dots'] ) ) ?  $instance['show_slider_dots'] : NULL,
							'label' => __( 'Show Slider Dots' , 'univ' ),
						),
						'animation_type' => array(
							'type' => 'select',
							'name' => $this->get_layers_field_name( 'animation_type' ) ,
							'id' => $this->get_layers_field_id( 'animation_type' ) ,
							'value' => ( isset(  $instance['animation_type'] ) ) ?  $instance['animation_type'] : 'slide',
							'label' => __( 'Animation Type' , 'univ' ),
							'options' => array(
								'slide' => __( 'Slide', 'univ' ),
								'fade' => __( 'Fade', 'univ' ),
								'parallax' => __( 'Parallax', 'univ' ),
							),
						),
						'autoplay_slides' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'autoplay_slides' ) ,
							'id' => $this->get_layers_field_id( 'autoplay_slides' ) ,
							'value' => ( isset( $instance['autoplay_slides'] ) ) ? $instance['autoplay_slides'] : NULL,
							'label' => __( 'Autoplay Slides' , 'univ' ),
						),
						'slide_time' => array(
							'type' => 'number',
							'name' => $this->get_layers_field_name( 'slide_time' ) ,
							'id' => $this->get_layers_field_id( 'slide_time' ) ,
							'min' => 1,
							'max' => 10,
							'placeholder' => __( 'Time in seconds, eg. 2' , 'univ' ),
							'value' => ( isset( $instance['slide_time'] ) ) ? $instance['slide_time'] : NULL,
							'label' => __( 'Slide Interval (seconds)' , 'univ' ),
							'data' => array(
								'show-if-selector' => '#' . $this->get_layers_field_id( 'autoplay_slides' ),
								'show-if-value' => 'true',
							),
						),
					),
				),
				'asdisplay' => array(
					'icon-css' => 'icon-display',
					'label' => __( 'Display', 'univ' ),
					'elements' => array(
						'show_slider_btn' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_slider_btn' ) ,
							'id' => $this->get_layers_field_id( 'show_slider_btn' ) ,
							'value' => ( isset( $instance['show_slider_btn'] ) ) ? $instance['show_slider_btn'] : NULL,
							'label' => __( 'Show Button' , 'univ' ),
						),
						'show_slider_title' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_slider_title' ) ,
							'id' => $this->get_layers_field_id( 'show_slider_title' ) ,
							'value' => ( isset( $instance['show_slider_title'] ) ) ? $instance['show_slider_title'] : NULL,
							'label' => __( 'Show Title' , 'univ' ),
						),
						'show_slider_excerpt' => array(
							'type' => 'checkbox',
							'name' => $this->get_layers_field_name( 'show_slider_excerpt' ) ,
							'id' => $this->get_layers_field_id( 'show_slider_excerpt' ) ,
							'value' => ( isset( $instance['show_slider_excerpt'] ) ) ? $instance['show_slider_excerpt'] : NULL,
							'label' => __( 'Show Excerpt' , 'univ' ),
						)
					)
				),
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
			), $this, $instance );

			// Legacy application of this filter - Do Not Use! (will be removed soon)
			$components = apply_filters( 'layers_slide_widget_design_bar_custom_components', $components );

			$this->design_bar(
				'side', // CSS Class Name
				array( // Widget Object
					'name' => $this->get_layers_field_name( 'design' ),
					'id' => $this->get_layers_field_id( 'design' ),
					'widget_id' => $this->widget_id,
				),
				$instance, // Widget Values
				$components // Components
			); ?>
			<div class="layers-container-large" id="layers-slide-widget-<?php echo esc_attr( $this->number ); ?>">

				<?php $this->form_elements()->header( array(
					'title' =>'Sliders',
					'icon_class' =>'slider'
				) ); ?>

				<?php echo $this->form_elements()->input(
					array(
						'type' => 'hidden',
						'name' => $this->get_layers_field_name( 'focus_slide' ) ,
						'id' => $this->get_layers_field_id( 'focus_slide' ) ,
						'value' => ( isset( $instance['focus_slide'] ) ) ? $instance['focus_slide'] : NULL,
						'data' => array(
							'focus-slide' => 'true'
						)
					)
				); ?>

				<section class="layers-accordion-section layers-content">
					<div class="layers-form-item">
						<?php $this->repeater( 'slide', $instance ); ?>
					</div>
				</section>

			</div>

		<?php }

		function slide_item( $item_guid, $item_instance ) {

			// Required - Get the name of this type.
			$type = str_replace( '_item', '', __FUNCTION__ );

			// Mix in new/unset defaults on every instance load (NEW)
			$item_instance = $this->apply_defaults( $item_instance, 'slide' );
			?>
			<li class="layers-accordion-item <?php echo $this->item_count; ?>" data-guid="<?php echo $item_guid; ?>">

				<a class="layers-accordion-title">
					<span>
						<?php echo ucfirst( $type ); ?><span class="layers-detail"><?php if ( isset( $item_instance['title'] ) ) echo $this->format_repeater_title( $item_instance['title'] ); ?></span>
					</span>
				</a>

				<section class="layers-accordion-section layers-content">
					<?php $this->design_bar(
						'top', // CSS Class Name
						array(
							'name' => $this->get_layers_field_name( 'design' ),
							'id' => $this->get_layers_field_id( 'design' ),
							'widget_id' => $this->widget_id . '_item',
							'number' => $this->number,
							'show_trash' => TRUE
						), // Widget Object
						$item_instance, // Widget Values
						apply_filters( 'layers_slide_widget_slide_design_bar_components', array( // Components
							'background' => array(
								'elements' => array(
									'univoverlayrange' => array(
										'type' => 'range',
										'label' => __( 'Select Overlay' , 'univ' ),
										'name' => $this->get_layers_field_name( 'at_overlay' ),
										'id' => $this->get_layers_field_id( 'at_overlay' ),
										'value' => ( isset( $item_instance['at_overlay'] ) ) ? $item_instance['at_overlay'] : NULL,
										'min' => 0,
										'max' => 10,
										'step' => 1,
									),
									'aps-video-type' => array(
										'type' => 'select',
										'label' => __( 'Select video type' , 'univ' ),
									    'name' => $this->get_layers_field_name( 'univ_slider_bg_video_type' ),
									    'id' => $this->get_layers_field_id( 'univ_slider_bg_video_type' ),
									    'value' => ( isset( $item_instance['univ_slider_bg_video_type'] ) ) ? $item_instance['univ_slider_bg_video_type'] : NULL ,
									    'options' => array(
									        'asb_none' => 'None',
									        'asb_youtube' => 'YouTube',
									        'asb_vimeo' => 'Vimeo',
									        'asb_selfhost' => 'Self Hosted',
									    )
									),
									'aps-video-type-youtube' => array(
										'type' => 'text',
										'label' => __( 'Insert Youtube Video URL' , 'univ' ),
										'name' => $this->get_layers_field_name( 'univ_slider_bg_youtube_video' ),
										'id' => $this->get_layers_field_id( 'univ_slider_bg_youtube_video' ),
										'placeholder' => __( 'Enter Video URL here' , 'univ' ),
										'value' => ( isset( $item_instance['univ_slider_bg_youtube_video'] ) ) ? $item_instance['univ_slider_bg_youtube_video'] : NULL ,
									),
									'aps-video-type-vimeo' => array(
										'type' => 'text',
										'label' => __( 'Insert Vimeo Video URL' , 'univ' ),
										'name' => $this->get_layers_field_name( 'univ_slider_bg_vimeo_video' ),
										'id' => $this->get_layers_field_id( 'univ_slider_bg_vimeo_video' ),
										'placeholder' => __( 'Enter Video URL here' , 'univ' ),
										'value' => ( isset( $item_instance['univ_slider_bg_vimeo_video'] ) ) ? $item_instance['univ_slider_bg_vimeo_video'] : NULL ,
										'class' => 'layers-text',
									),
									'aps-video-type-local' => array(
										'type' => 'upload',
										'label' => __( 'Background MP4' , 'univ' ),
										'name' => $this->get_layers_field_name( 'univ_slider_bg_local_video' ),
										'id' => $this->get_layers_field_id( 'univ_slider_bg_local_video' ),
										'button_label' => __( 'Choose mp4 file', 'univ' ),
										'value' => ( isset( $item_instance['univ_slider_bg_local_video'] ) ) ? $item_instance['univ_slider_bg_local_video'] : NULL ,
										'class' => 'layers-upload',
									),
								)
							),
							'featuredimage',
							'imagealign' => array(
								'elements' => array(
									'imagealign' => array(
										'options' => array(
											'image-left' => __( 'Left', 'univ' ),
											'image-right' => __( 'Right', 'univ' ),
											'image-top' => __( 'Top', 'univ' ),
											'image-bottom' => __( 'Bottom', 'univ' ),
										),
									),
								),
							),
							'fonts',
							'advanced' => array(
								'elements' => array(
									'customclass'
								),
								'elements_combine' => 'replace',
							),
						), $this, $item_instance )
					); ?>
					
					
					
					<div class="layers-row clearfix">

						<!-- Start header box -->
						<div class="layers-panel">
							<div class="layers-content">
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'title' ); ?>"><?php esc_html_e( 'Title' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'text',
											'name' => $this->get_layers_field_name( 'title' ),
											'id' => $this->get_layers_field_id( 'title' ),
											'placeholder' => __( 'Enter a Title' , 'univ' ),
											'value' => ( isset( $item_instance['title'] ) ) ? $item_instance['title'] : NULL ,
											'class' => 'layers-text'
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'atsfontsize' ); ?>"><?php esc_html_e( 'Font Size' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'range',
											'name' => $this->get_layers_field_name( 'atsfontsize' ),
											'id' => $this->get_layers_field_id( 'atsfontsize' ),
											'value' => ( isset( $item_instance['atsfontsize'] ) ) ? $item_instance['atsfontsize'] : NULL ,
											'min' => 0,
											'max' => 300,
											'step' => 1
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'title_start_animation' ); ?>"><?php esc_html_e( 'Start Animation' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'select',
											'name' => $this->get_layers_field_name( 'title_start_animation' ),
											'id' => $this->get_layers_field_id( 'title_start_animation' ),
											'value' => ( isset( $item_instance['title_start_animation'] ) ) ? $item_instance['title_start_animation'] : NULL ,
											'class' => 'layers-select',
											'options' => array(
										        'none' => 'None',
										        'flash' => 'flash',
										        'shake' => 'shake',
										        'tada' => 'tada',
										        'swing' => 'swing',
										        'wobble' => 'wobble',
										        'pulse' => 'pulse',
										        'flip' => 'flip',
										        'flipInX' => 'flipInX',
										        'flipInY' => 'flipInY',
										        'fadeIn' => 'fadeIn',
										        'fadeInUp' => 'fadeInUp',
										        'fadeInDown' => 'fadeInDown',
										        'fadeInLeft' => 'fadeInLeft',
										        'fadeInRightBig' => 'fadeInRightBig',
										        'bounceIn' => 'bounceIn',
										        'bounceInDown' => 'bounceInDown',
										        'bounceInUp' => 'bounceInUp',
										        'bounceInLeft' => 'bounceInLeft',
										        'bounceInRight' => 'bounceInRight',
										        'rotateIn' => 'rotateIn',
										        'rotateInDownLeft' => 'rotateInDownLeft',
										        'rotateInUpRight' => 'rotateInUpRight',
										        'rollIn' => 'rollIn',
										    )
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'title_end_animation' ); ?>"><?php esc_html_e( 'End Animation' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'select',
											'name' => $this->get_layers_field_name( 'title_end_animation' ),
											'id' => $this->get_layers_field_id( 'title_end_animation' ),
											'value' => ( isset( $item_instance['title_end_animation'] ) ) ? $item_instance['title_end_animation'] : NULL ,
											'class' => 'layers-select',
											'options' => array(
										        'none' => 'None',
										        'flash' => 'flash',
										        'shake' => 'shake',
										        'tada' => 'tada',
										        'swing' => 'swing',
										        'wobble' => 'wobble',
										        'pulse' => 'pulse',
										        'flip' => 'flip',
										        'flipOutX' => 'flipOutX',
										        'flipOutY' => 'flipOutY',
										        'fadeOut' => 'fadeOut',
										        'fadeOutUp' => 'fadeOutUp',
										        'fadeOutDown' => 'fadeOutDown',
										        'fadeOutLeft' => 'fadeOutLeft',
										        'fadeOutRight' => 'fadeOutRight',
										        'fadeOutUpBig' => 'fadeOutUpBig',
										        'fadeOutDownBig' => 'fadeOutDownBig',
										        'bounceOut' => 'bounceOut',
										        'bounceOutDown' => 'bounceOutDown',
										        'bounceOutUp' => 'bounceOutUp',
										        'bounceOutLeft' => 'bounceOutLeft',
										        'bounceOutRight' => 'bounceOutRight',
										        'hinge' => 'hinge',
										        'rollOut' => 'rollOut',
										    )
										)
									); ?>
								</p>
							</div>
						</div>
						<!-- End Header box -->

						<!-- Start Sub header box -->
						<div class="layers-panel">
							<div class="layers-content">
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'title2' ); ?>"><?php esc_html_e( 'Sub Title' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'text',
											'name' => $this->get_layers_field_name( 'title2' ),
											'id' => $this->get_layers_field_id( 'title2' ),
											'placeholder' => __( 'Enter a title2' , 'univ' ),
											'value' => ( isset( $item_instance['title2'] ) ) ? $item_instance['title2'] : NULL ,
											'class' => 'layers-text'
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'atssubfontsize' ); ?>"><?php esc_html_e( 'Font Size' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'range',
											'name' => $this->get_layers_field_name( 'atssubfontsize' ),
											'id' => $this->get_layers_field_id( 'atssubfontsize' ),
											'value' => ( isset( $item_instance['atssubfontsize'] ) ) ? $item_instance['atssubfontsize'] : NULL ,
											'min' => 0,
											'max' => 200,
											'step' => 1
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'title2_start_animation' ); ?>"><?php esc_html_e( 'Start Animation' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'select',
											'name' => $this->get_layers_field_name( 'title2_start_animation' ),
											'id' => $this->get_layers_field_id( 'title2_start_animation' ),
											'value' => ( isset( $item_instance['title2_start_animation'] ) ) ? $item_instance['title2_start_animation'] : NULL ,
											'class' => 'layers-select',
											'options' => array(
										        'none' => 'None',
										        'flash' => 'flash',
										        'shake' => 'shake',
										        'tada' => 'tada',
										        'swing' => 'swing',
										        'wobble' => 'wobble',
										        'pulse' => 'pulse',
										        'flip' => 'flip',
										        'flipInX' => 'flipInX',
										        'flipInY' => 'flipInY',
										        'fadeIn' => 'fadeIn',
										        'fadeInUp' => 'fadeInUp',
										        'fadeInDown' => 'fadeInDown',
										        'fadeInLeft' => 'fadeInLeft',
										        'fadeInRightBig' => 'fadeInRightBig',
										        'bounceIn' => 'bounceIn',
										        'bounceInDown' => 'bounceInDown',
										        'bounceInUp' => 'bounceInUp',
										        'bounceInLeft' => 'bounceInLeft',
										        'bounceInRight' => 'bounceInRight',
										        'rotateIn' => 'rotateIn',
										        'rotateInDownLeft' => 'rotateInDownLeft',
										        'rotateInUpRight' => 'rotateInUpRight',
										        'rollIn' => 'rollIn',
										    )
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'title2_end_animation' ); ?>"><?php esc_html_e( 'End Animation' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'select',
											'name' => $this->get_layers_field_name( 'title2_end_animation' ),
											'id' => $this->get_layers_field_id( 'title2_end_animation' ),
											'value' => ( isset( $item_instance['title2_end_animation'] ) ) ? $item_instance['title2_end_animation'] : NULL ,
											'class' => 'layers-select',
											'options' => array(
										        'none' => 'None',
										        'flash' => 'flash',
										        'shake' => 'shake',
										        'tada' => 'tada',
										        'swing' => 'swing',
										        'wobble' => 'wobble',
										        'pulse' => 'pulse',
										        'flip' => 'flip',
										        'flipOutX' => 'flipOutX',
										        'flipOutY' => 'flipOutY',
										        'fadeOut' => 'fadeOut',
										        'fadeOutUp' => 'fadeOutUp',
										        'fadeOutDown' => 'fadeOutDown',
										        'fadeOutLeft' => 'fadeOutLeft',
										        'fadeOutRight' => 'fadeOutRight',
										        'fadeOutUpBig' => 'fadeOutUpBig',
										        'fadeOutDownBig' => 'fadeOutDownBig',
										        'bounceOut' => 'bounceOut',
										        'bounceOutDown' => 'bounceOutDown',
										        'bounceOutUp' => 'bounceOutUp',
										        'bounceOutLeft' => 'bounceOutLeft',
										        'bounceOutRight' => 'bounceOutRight',
										        'hinge' => 'hinge',
										        'rollOut' => 'rollOut',
										    )
										)
									); ?>
								</p>
							</div>
						</div>
						<!-- End Sub Header box -->
						<div class="layers-panel">
							<div class="layers-content">
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'excerpt' ); ?>"><?php esc_html_e( 'Excerpt' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'rte',
											'name' => $this->get_layers_field_name( 'excerpt' ),
											'id' => $this->get_layers_field_id( 'excerpt' ),
											'placeholder' => __( 'Short Excerpt' , 'univ' ),
											'value' => ( isset( $item_instance['excerpt'] ) ) ? $item_instance['excerpt'] : NULL ,
											'disallow_buttons' => array( 'insertOrderedList','insertUnorderedList' ),
											'class' => 'layers-textarea',
											'rows' => 6
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'atsexcfontsize' ); ?>"><?php esc_html_e( 'Font Size' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'range',
											'name' => $this->get_layers_field_name( 'atsexcfontsize' ),
											'id' => $this->get_layers_field_id( 'atsexcfontsize' ),
											'value' => ( isset( $item_instance['atsexcfontsize'] ) ) ? $item_instance['atsexcfontsize'] : NULL ,
											'min' => 0,
											'max' => 50,
											'step' => 1
										)
									); ?>
								</p>
								<p class="layers-form-item">
									<label for="<?php echo $this->get_layers_field_id( 'atsexclineheight' ); ?>"><?php esc_html_e( 'Line Height' , 'univ' ); ?></label>
									<?php echo $this->form_elements()->input(
										array(
											'type' => 'range',
											'name' => $this->get_layers_field_name( 'atsexclineheight' ),
											'id' => $this->get_layers_field_id( 'atsexclineheight' ),
											'value' => ( isset( $item_instance['atsexclineheight'] ) ) ? $item_instance['atsexclineheight'] : NULL ,
											'min' => 0,
											'max' => 50,
											'step' => 1
										)
									); ?>
								</p>
							</div>
						</div>
						<div class="layers-row clearfix">
							<div class="layers-panel">
								<div class="layers-content">

									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button 1 Text' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn1' ),
												'id' => $this->get_layers_field_id( 'slider_btn1' ),
												'value' => ( isset( $item_instance['slider_btn1'] ) ) ? $item_instance['slider_btn1'] : NULL,
											)
										); ?>
									</p>

									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button sm Text' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn1_smt' ),
												'id' => $this->get_layers_field_id( 'slider_btn1_smt' ),
												'value' => ( isset( $item_instance['slider_btn1_smt'] ) ) ? $item_instance['slider_btn1_smt'] : NULL,
											)
										); ?>
									</p>

									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button Icon' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn1_icon' ),
												'id' => $this->get_layers_field_id( 'slider_btn1_icon' ),
												'value' => ( isset( $item_instance['slider_btn1_icon'] ) ) ? $item_instance['slider_btn1_icon'] : NULL,
											)
										); ?>
										<span class="layers-form-item-description">
										Want more icons  <a href="http://zavoloklom.github.io/material-design-iconic-font/icons.html" class="customizer-link" target="_blank">click here</a>.</span>
									</p>

									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button 1 Link' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn1_link' ),
												'id' => $this->get_layers_field_id( 'slider_btn1_link' ),
												'value' => ( isset( $item_instance['slider_btn1_link'] ) ) ? $item_instance['slider_btn1_link'] : NULL,
											)
										); ?>
									</p>

									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Select Button target' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'select',
												'name' => $this->get_layers_field_name( 'slider_btn1_target' ),
												'id' => $this->get_layers_field_id( 'slider_btn1_target' ),
												'value' => ( isset( $item_instance['slider_btn1_target'] ) ) ? $item_instance['slider_btn1_target'] : NULL,
												'options' => array(
											        '_blank' => '_blank',
											        '_parent' => '_parent',
											        '_self' => '_self',
											        '_top' => '_top',
											    )
											)

										); ?>
									</p>
								</div>
							</div>
						</div>
						
						<div class="layers-row clearfix">
							<div class="layers-panel">
								<div class="layers-content">
									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button 2 Text' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn2' ),
												'id' => $this->get_layers_field_id( 'slider_btn2' ),
												'value' => ( isset( $item_instance['slider_btn2'] ) ) ? $item_instance['slider_btn2'] : NULL,
											)
										); ?>
									</p>
									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button 2 SM Text' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn2_smt' ),
												'id' => $this->get_layers_field_id( 'slider_btn2_smt' ),
												'value' => ( isset( $item_instance['slider_btn2_smt'] ) ) ? $item_instance['slider_btn2_smt'] : NULL,
											)
										); ?>
									</p>
									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button Icon' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn2_icon' ),
												'id' => $this->get_layers_field_id( 'slider_btn2_icon' ),
												'value' => ( isset( $item_instance['slider_btn2_icon'] ) ) ? $item_instance['slider_btn2_icon'] : NULL,
											)
										); ?>
										<span class="layers-form-item-description">
										Want more icons  <a href="http://zavoloklom.github.io/material-design-iconic-font/icons.html" class="customizer-link" target="_blank">click here</a>.</span>
									</p>
									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Insert Button 2 Link' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'text',
												'name' => $this->get_layers_field_name( 'slider_btn2_link' ),
												'id' => $this->get_layers_field_id( 'slider_btn2_link' ),
												'value' => ( isset( $item_instance['slider_btn2_link'] ) ) ? $item_instance['slider_btn2_link'] : NULL,
											)
										); ?>
									</p>
									<p class="layers-form-item">
										<label>
											<?php esc_html_e( 'Select Button target' , 'univ' ); ?>
										</label>
										<?php echo $this->form_elements()->input(
											array(
												'type' => 'select',
												'name' => $this->get_layers_field_name( 'slider_btn2_target' ),
												'id' => $this->get_layers_field_id( 'slider_btn2_target' ),
												'value' => ( isset( $item_instance['slider_btn2_target'] ) ) ? $item_instance['slider_btn2_target'] : NULL,
												'options' => array(
											        '_blank' => '_blank',
											        '_parent' => '_parent',
											        '_self' => '_self',
											        '_top' => '_top',
											    )
											)
										); ?>
									</p>
						

								</div>
							</div>
						</div>

					</div>
				</section>
			</li>
			<?php
		}

	} // Class

	// Add our function to the widgets_init hook.
	 register_widget("univ_New_Slider_Widget");
}