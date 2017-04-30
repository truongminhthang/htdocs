<?php do_action( 'layers_before_footer' ); ?>


<!-- Start footer top area -->
<?php 
	 $show_hide_footop = layers_get_theme_mod( 'footer-top-showhide');  
?>
<?php if ('yes' == $show_hide_footop): ?>
	<?php 
		$foo_top_bg_type = layers_get_theme_mod( 'foo-top-background-type');
		if ('ftbcolor' == $foo_top_bg_type) {
			$foo_top_bg_color = layers_get_theme_mod('foo-top-background-color');
		  	if( $foo_top_bg_color ){
			 $set_foo_top_bg = 'background-color: '.$foo_top_bg_color.';';
			}
		}elseif ('ftbimage' == $foo_top_bg_type) {
			$foo_top_bg_img = wp_get_attachment_url( layers_get_theme_mod('foo-top-background-image') , 'full' );
		  	if( $foo_top_bg_img ){
			 $set_foo_top_bg = 'background: rgba(0, 0, 0, 0) url('.$foo_top_bg_img.') no-repeat scroll center top / cover;';
			}
			$foo_top_overlay_opacity = layers_get_theme_mod( 'foo-top-background-overlay-opacity');
			$set_foo_top_data_opacity = 'data-top-overlay='.$foo_top_overlay_opacity.'';
		}
		
	 ?>
	 <?php 
	 	$foo_top_padding_margin_option = layers_get_theme_mod( 'foo-top-padding-margin-option');
	 	$foo_top_content_aligment = layers_get_theme_mod( 'foo-top-content-alignment');

	 	if ( 'footoppaddingmargin' == $foo_top_padding_margin_option) {
	 		$foo_top_padding_top = layers_get_theme_mod( 'foo-top-padding-option-top');
	 		$foo_top_padding_bottom = layers_get_theme_mod( 'foo-top-padding-option-bottom');
	 		$foo_top_margin_top = layers_get_theme_mod( 'foo-top-margin-option-top');
	 		$foo_top_margin_bottom = layers_get_theme_mod( 'foo-top-margin-option-bottom');

	 		if(isset($foo_top_padding_top)){
	 			$setfoo_top_padding_top = $foo_top_padding_top.'px;';
	 		}
	 		if(isset($foo_top_padding_bottom)){
	 			$setfoo_top_padding_bottom = $foo_top_padding_bottom.'px;';
	 		}
	 		if(isset($foo_top_margin_top)){
	 			$setfoo_top_margin_top = $foo_top_margin_top.'px;';
	 		}
	 		if(isset($foo_top_margin_bottom)){
	 			$setfoo_top_margin_bottom = $foo_top_margin_bottom.'px;';
	 		}

	 		$ftpt =	'padding-top: '.$setfoo_top_padding_top.'';
	 		$ftpb =	'padding-bottom: '.$setfoo_top_padding_bottom.'';
	 		$ftmt =	'margin-top: '.$setfoo_top_margin_top.'';
	 		$ftmb =	'margin-bottom: '.$setfoo_top_margin_bottom.'';

	 	}if ('' == $foo_top_padding_margin_option) {
	 		$ftpt =	'padding-top: 50px;';
	 		$ftpb =	'padding-bottom: 50px;';
	 		$ftmt =	'margin-top: 0px;';
	 		$ftmb =	'margin-bottom: 0px;';
	 	} else {
	 		# code...
	 	}
	 	
	 	
	 ?>
	<div class="footer-top-area <?php echo esc_attr($foo_top_content_aligment) ?>" style="<?php echo esc_attr($set_foo_top_bg) ?> <?php echo esc_attr($ftpt) ?> <?php echo esc_attr($ftpb) ?> <?php echo esc_attr($ftmt) ?> <?php echo esc_attr($ftmb) ?>" <?php if(isset($foo_top_bg_img)){ echo esc_attr($set_foo_top_data_opacity);} ?> >
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="footer-top-inner grid">
				<div class="column span-12">
					<div class="footer-top-logo">
							<?php 
								 $set_show_foo_top_logo = layers_get_theme_mod( 'show-foo-top-logo');  
							?>
							<?php if ('yes' == $set_show_foo_top_logo): ?>
							<?php $ftfoologosize = layers_get_theme_mod( 'footer-top-logo-size');  ?>
							<div class="footer-logo-<?php echo esc_attr($ftfoologosize) ?>">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php  $hastech_footer_top_logo = wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_top_logo') , 'full' );
									if(isset($hastech_footer_top_logo) && !empty($hastech_footer_top_logo)){
										?><img src="<?php echo esc_url($hastech_footer_top_logo); ?>" alt=""><?php
									}
								?>
									
								</a>
			                </div>
			            <?php endif ?>
					</div>
					<div class="footer-top-info">
						
						<!-- foo-top-single-info1 -->
						<?php
							$var_foo_top_single_info1 = layers_get_theme_mod( 'foo-top-single-info11' );
							$var_foo_top_single_info1_icon = layers_get_theme_mod( 'foo-top-single-info1-icon' );
							$var_foo_top_single_info1_value = layers_get_theme_mod( 'foo-top-single-info1-value' );
							if(isset($var_foo_top_single_info1_icon) && !empty($var_foo_top_single_info1_icon)){
								$var_set_foo_top_single_info1_icon = layers_get_theme_mod( 'foo-top-single-info1-icon' );
							}
							if(isset($var_foo_top_single_info1_icon) && !empty($var_foo_top_single_info1_icon)){
								$var_set_foo_top_single_info1_value = layers_get_theme_mod( 'foo-top-single-info1-value' );
							}
							$var_foo_top_single_info2_icon = layers_get_theme_mod( 'foo-top-single-info2-icon' );
							$var_foo_top_single_info2_value = layers_get_theme_mod( 'foo-top-single-info2-value' );
							if(isset($var_foo_top_single_info2_icon) && !empty($var_foo_top_single_info2_icon)){
								$var_set_foo_top_single_info2_icon = layers_get_theme_mod( 'foo-top-single-info2-icon' );
							}
							if(isset($var_foo_top_single_info2_value) && !empty($var_foo_top_single_info2_value)){
								$var_set_foo_top_single_info2_value = layers_get_theme_mod( 'foo-top-single-info2-value' );
							}
							$var_foo_top_single_info3_icon = layers_get_theme_mod( 'foo-top-single-info3-icon' );
							$var_foo_top_single_info3_value = layers_get_theme_mod( 'foo-top-single-info3-value' );
							$var_foo_top_single_info3_cc = layers_get_theme_mod( 'foo-top-single-info3-value-cc' );
							if(isset($var_foo_top_single_info3_icon) && !empty($var_foo_top_single_info3_icon)){
								$var_set_foo_top_single_info3_icon = layers_get_theme_mod( 'foo-top-single-info3-icon' );
							}
							if(isset($var_foo_top_single_info3_value) && !empty($var_foo_top_single_info3_value)){
								$var_set_foo_top_single_info3_value = layers_get_theme_mod( 'foo-top-single-info3-value' );
							}
							if(isset($var_foo_top_single_info3_cc) && !empty($var_foo_top_single_info3_cc)){
								$var_set_foo_top_single_info3_cc = layers_get_theme_mod( 'foo-top-single-info3-value-cc' );
							}
							if ( 'text' === $var_foo_top_single_info1 && '' !== $var_foo_top_single_info1 ) {
								?><div class="info-sin"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single_info1_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single_info1_value); ?></div><?php
							}elseif ('email' === $var_foo_top_single_info1 && '' !== $var_foo_top_single_info1 ) {
								?><div class="info-sin"><a href="<?php echo esc_html_e('mailto:', 'univ') ?><?php echo esc_html($var_set_foo_top_single_info2_value); ?>" target="_top"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single_info2_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single_info2_value); ?></a></div><?php
							}elseif ('phone' === $var_foo_top_single_info1 && '' !== $var_foo_top_single_info1 ) {
								?><div class="info-sin"><a href="<?php echo esc_html_e('tel:' , 'univ') ?><?php echo esc_html($var_set_foo_top_single_info3_cc); ?><?php echo esc_html($var_set_foo_top_single_info3_value); ?>"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single_info3_icon) ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single_info3_cc); ?>&nbsp;<?php echo esc_html($var_set_foo_top_single_info3_value); ?></a></div><?php
							}
						?>





						<!-- Start footer top 2nd information -->
						<?php
							$var_foo_top_single2_info1 = layers_get_theme_mod( 'foo-top-single2-info22' );
							$var_foo_top_single2_info1_icon = layers_get_theme_mod( 'foo-top-single2-info1-icon' );
							$var_foo_top_single2_info1_value = layers_get_theme_mod( 'foo-top-single2-info1-value' );
							if(isset($var_foo_top_single2_info1_icon) && !empty($var_foo_top_single2_info1_icon)){
								$var_set_foo_top_single2_info1_icon = layers_get_theme_mod( 'foo-top-single2-info1-icon' );
							}
							if(isset($var_foo_top_single2_info1_icon) && !empty($var_foo_top_single2_info1_icon)){
								$var_set_foo_top_single2_info1_value = layers_get_theme_mod( 'foo-top-single2-info1-value' );
							}
							$var_foo_top_single2_info2_icon = layers_get_theme_mod( 'foo-top-single2-info2-icon' );
							$var_foo_top_single2_info2_value = layers_get_theme_mod( 'foo-top-single2-info2-value' );
							if(isset($var_foo_top_single2_info2_icon) && !empty($var_foo_top_single2_info2_icon)){
								$var_set_foo_top_single2_info2_icon = layers_get_theme_mod( 'foo-top-single2-info2-icon' );
							}
							if(isset($var_foo_top_single2_info2_value) && !empty($var_foo_top_single2_info2_value)){
								$var_set_foo_top_single2_info2_value = layers_get_theme_mod( 'foo-top-single2-info2-value' );
							}
							$var_foo_top_single2_info3_icon = layers_get_theme_mod( 'foo-top-single2-info3-icon' );
							$var_foo_top_single2_info3_value = layers_get_theme_mod( 'foo-top-single2-info3-value' );
							$var_foo_top_single2_info3_cc = layers_get_theme_mod( 'foo-top-single2-info3-value-cc' );
							if(isset($var_foo_top_single2_info3_icon) && !empty($var_foo_top_single2_info3_icon)){
								$var_set_foo_top_single2_info3_icon = layers_get_theme_mod( 'foo-top-single2-info3-icon' );
							}
							if(isset($var_foo_top_single2_info3_value) && !empty($var_foo_top_single2_info3_value)){
								$var_set_foo_top_single2_info3_value = layers_get_theme_mod( 'foo-top-single2-info3-value' );
							}
							if(isset($var_foo_top_single2_info3_cc) && !empty($var_foo_top_single2_info3_cc)){
								$var_set_foo_top_single2_info3_cc = layers_get_theme_mod( 'foo-top-single2-info3-value-cc' );
							}
							if ( 'text' === $var_foo_top_single2_info1 && '' !== $var_foo_top_single2_info1 ) {
								?><div class="info-sin"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single2_info1_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single2_info1_value); ?></div><?php
								
							}elseif ('email' === $var_foo_top_single2_info1 && '' !== $var_foo_top_single2_info1 ) {
								?><div class="info-sin"><a href="<?php echo esc_html_e('mailto:', 'univ') ?><?php echo esc_html($var_set_foo_top_single2_info2_value); ?>" target="_top"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single2_info2_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single2_info2_value); ?></a></div><?php
							}elseif ('phone' === $var_foo_top_single2_info1 && '' !== $var_foo_top_single2_info1 ) {
								?><div class="info-sin"><a href="<?php echo esc_html_e('tel:' , 'univ') ?><?php echo esc_html($var_set_foo_top_single2_info3_cc); ?><?php echo esc_html($var_set_foo_top_single2_info3_value); ?>"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single2_info3_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single2_info3_cc); ?>&nbsp;<?php echo esc_html($var_set_foo_top_single2_info3_value); ?></a></div><?php
							}
						?>




						<!-- Start footer top 3nd information -->
						<?php
							$var_foo_top_single3_info1 = layers_get_theme_mod( 'foo-top-single3-info33' );
							$var_foo_top_single3_info1_icon = layers_get_theme_mod( 'foo-top-single3-info1-icon' );
							$var_foo_top_single3_info1_value = layers_get_theme_mod( 'foo-top-single3-info1-value' );
							if(isset($var_foo_top_single3_info1_icon) && !empty($var_foo_top_single3_info1_icon)){
								$var_set_foo_top_single3_info1_icon = layers_get_theme_mod( 'foo-top-single3-info1-icon' );
							}
							if(isset($var_foo_top_single3_info1_icon) && !empty($var_foo_top_single3_info1_icon)){
								$var_set_foo_top_single3_info1_value = layers_get_theme_mod( 'foo-top-single3-info1-value' );
							}
							$var_foo_top_single3_info2_icon = layers_get_theme_mod( 'foo-top-single3-info2-icon' );
							$var_foo_top_single3_info2_value = layers_get_theme_mod( 'foo-top-single3-info2-value' );
							if(isset($var_foo_top_single3_info2_icon) && !empty($var_foo_top_single3_info2_icon)){
								$var_set_foo_top_single3_info2_icon = layers_get_theme_mod( 'foo-top-single3-info2-icon' );
							}
							if(isset($var_foo_top_single3_info2_value) && !empty($var_foo_top_single3_info2_value)){
								$var_set_foo_top_single3_info2_value = layers_get_theme_mod( 'foo-top-single3-info2-value' );
							}
							$var_foo_top_single3_info3_icon = layers_get_theme_mod( 'foo-top-single3-info3-icon' );
							$var_foo_top_single3_info3_value = layers_get_theme_mod( 'foo-top-single3-info3-value' );
							$var_foo_top_single3_info3_cc = layers_get_theme_mod( 'foo-top-single3-info3-value-cc' );
							if(isset($var_foo_top_single3_info3_icon) && !empty($var_foo_top_single3_info3_icon)){
								$var_set_foo_top_single3_info3_icon = layers_get_theme_mod( 'foo-top-single3-info3-icon' );
							}
							if(isset($var_foo_top_single3_info3_value) && !empty($var_foo_top_single3_info3_value)){
								$var_set_foo_top_single3_info3_value = layers_get_theme_mod( 'foo-top-single3-info3-value' );
							}
							if(isset($var_foo_top_single3_info3_cc) && !empty($var_foo_top_single3_info3_cc)){
								$var_set_foo_top_single3_info3_cc = layers_get_theme_mod( 'foo-top-single3-info3-value-cc' );
							}
							if ( 'text' === $var_foo_top_single3_info1 && '' !== $var_foo_top_single3_info1 ) {
								?><div class="info-sin"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single3_info1_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single3_info1_value); ?></div><?php
								
							}elseif ('email' === $var_foo_top_single3_info1 && '' !== $var_foo_top_single3_info1 ) {
								?><div class="info-sin"><a href="<?php echo esc_html_e('mailto:', 'univ') ?><?php echo esc_html($var_set_foo_top_single3_info2_value); ?>" target="_top"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single3_info2_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single3_info2_value); ?></a></div><?php
							}elseif ('phone' === $var_foo_top_single3_info1 && '' !== $var_foo_top_single3_info1 ) {
								?><div class="info-sin"><a href="<?php echo esc_html_e('tel:' , 'univ') ?><?php echo esc_html($var_set_foo_top_single3_info3_cc); ?><?php echo esc_html($var_set_foo_top_single3_info3_value); ?>"><i class="fa fa-<?php echo esc_html($var_set_foo_top_single3_info3_icon); ?>"></i>&nbsp;&nbsp;&nbsp;<?php echo esc_html($var_set_foo_top_single3_info3_cc); ?>&nbsp;<?php echo esc_html($var_set_foo_top_single3_info3_value); ?></a></div><?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>	
<?php endif ?>	
<!-- End footer top area -->


<?php 
	$foo_bg_type = layers_get_theme_mod( 'foo-background-type');
	if ('foobcolor' == $foo_bg_type) {
		$foo_bg_color = layers_get_theme_mod('foo-background-color');
	  	if( $foo_bg_color ){
		 $set_foo_bg = 'background-color: '.$foo_bg_color.'';
		}
	}elseif ('foobimage' == $foo_bg_type) {
		$foo_bg_img = wp_get_attachment_url( layers_get_theme_mod('foo-background-image') , 'full' );
	  	if( $foo_bg_img ){
		 $set_foo_bg = 'background: rgba(0, 0, 0, 0) url('.$foo_bg_img.') no-repeat scroll center top / cover;';
		}
	}
	$foo_overlay_opacity = layers_get_theme_mod( 'foo-background-overlay-opacity');
	$set_foo_data_opacity = 'data-foo-overlay='.$foo_overlay_opacity.'';
	
 ?>

<section id="footer" <?php layers_wrapper_class( 'footer_site', 'footer-site' ); ?>  style="<?php echo esc_attr($set_foo_bg) ?>" <?php if(isset($set_foo_bg)){ echo esc_attr($set_foo_data_opacity);} ?> >
	<?php do_action( 'layers_before_footer_inner' ); ?>
	<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
		<?php // Do logic related to the footer widget area count
		$footer_sidebar_count = layers_get_theme_mod( 'footer-sidebar-count' ); ?>

		<?php if( 0 != $footer_sidebar_count ) { ?>
			<?php do_action( 'layers_before_footer_sidebar' ); ?>
			<div class="grid footer-top-grid">
				<?php // Default Sidebar count to 4
				if( '' == $footer_sidebar_count ) $footer_sidebar_count = 4;

				// Get the sidebar class
				$footer_sidebar_class = floor( 12/$footer_sidebar_count ); ?>
				<?php for( $footer = 1; $footer <= $footer_sidebar_count; $footer++ ) { ?>
					<div class="column span-<?php echo esc_attr( $footer_sidebar_class ); ?> <?php if( $footer == $footer_sidebar_count ) echo esc_attr( 'last' ); ?>">
						<?php dynamic_sidebar( LAYERS_THEME_SLUG . '-footer-' . $footer ); ?>
					</div>
				<?php } ?>
			</div>

			<?php do_action( 'layers_after_footer_sidebar' ); ?>
		<?php } // if 0 != sidebars ?>
	</div>
	<?php do_action( 'layers_after_footer_inner' ); ?>

	<?php do_action( 'layers_before_footer_copyright' ); ?>
	<?php  $hastech_footer_bottom_bg=wp_get_attachment_url( layers_get_theme_mod('hastech_footer_bottom_background_image') , 'full' );?>


<?php 
	$copyrightstylevar = layers_get_theme_mod( 'copyrightstyle');  

	// Copyright bg option
	$copyright_bg_type = layers_get_theme_mod( 'copyright-background-type');
	if ('copybcolor' == $copyright_bg_type) {
		$copyright_bg_color = layers_get_theme_mod('copyright-background-color');
	  	if( $copyright_bg_color ){
		 $set_copyright_bg = 'background-color: '.$copyright_bg_color.';';
		}
	}elseif ('copybimage' == $copyright_bg_type) {
		$copyright_bg_img = wp_get_attachment_url( layers_get_theme_mod('copyright-background-image') , 'full' );
	  	if( $copyright_bg_img ){
		 $set_copyright_bg = 'background: rgba(0, 0, 0, 0) url('.$copyright_bg_img.') no-repeat scroll center top / cover;';
		}
		$copyright_overlay_opacity = layers_get_theme_mod( 'copyright-background-overlay-opacity');
		$set_copyright_data_opacity = 'data-copyright-overlay='.$copyright_overlay_opacity.'';
	}
?>

<?php if( 'ht-copyright-s1' == $copyrightstylevar ){?> 

	<div class="copyright-footer-bg" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?> >
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">

				<div class="column span-12">

					<?php if( false != layers_get_theme_mod( 'show_foo_logo' ) ) { ?>
						<?php $foologosize = layers_get_theme_mod( 'footer-logo-size');  ?>
						<div class="footer-logo footer-logo-<?php echo esc_attr($foologosize); ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php  $hastech_footer_logo=wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_logo') , 'full' );?>
								<img src="<?php echo esc_url($hastech_footer_logo); ?>" alt="">
							</a>
		                </div>
		            <?php } ?>

					<!-- Start Footer social icons -->
					<?php if( false != layers_get_theme_mod( 'show_footer_social' ) ) { ?>
					<?php if ( has_nav_menu( 'hast-social-menu' ) ) { ?>
					<div class="footer-icon">
						<?php
							wp_nav_menu(array(
								'theme_location' => 'hast-social-menu'
							));
						?>
		            </div>
		            <?php }} ?>
		            <!-- End Footer social icons -->

		            <?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
						<p class="site-text"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
					<?php } ?>

				</div>
				<div class="column span-12 clearfix">
					<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
						<?php } ?>
				</div>
			</div>
		</div>
	</div>


<?php } elseif ('ht-copyright-s2' == $copyrightstylevar) {?>

	<div class="copyright-footer-bg foo-copyright-style-2" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">

				<div class="column span-12">
					<?php if( false != layers_get_theme_mod( 'show_foo_logo' ) ) { ?>
						<?php $foologosize = layers_get_theme_mod( 'footer-logo-size');  ?>
						<div class="footer-logo footer-logo-<?php echo esc_attr($foologosize); ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php  $hastech_footer_logo=wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_logo') , 'full' );?>
								<img src="<?php echo esc_url($hastech_footer_logo); ?>" alt="">
							</a>
		                </div>
		            <?php } ?>
					<!-- Start Footer social icons -->
					<?php if( false != layers_get_theme_mod( 'show_footer_social' ) ) { ?>
					<?php if ( has_nav_menu( 'hast-social-menu' ) ) { ?>
					<div class="footer-icon">
						<?php
							wp_nav_menu(array(
								'theme_location' => 'hast-social-menu'
							));
						?>
		            </div>
		            <?php }} ?>
		            <!-- End Footer social icons -->
				</div>
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-2 grid">

						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-left"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
						<div class="column span-7 clearfix foo-menu text-right">
							<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
						<?php } ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s3' == $copyrightstylevar) {?>

	<div class="copyright-footer-bg foo-copyright-style-3" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">

				<div class="column span-12">
					<?php if( false != layers_get_theme_mod( 'show_foo_logo' ) ) { ?>
						<?php $foologosize = layers_get_theme_mod( 'footer-logo-size');  ?>
						<div class="footer-logo footer-logo-<?php echo esc_attr($foologosize); ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php  $hastech_footer_logo=wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_logo') , 'full' );?>
								<img src="<?php echo esc_url($hastech_footer_logo); ?>" alt="">
							</a>
		                </div>
		            <?php } ?>
					<!-- Start Footer social icons -->
					<?php if( false != layers_get_theme_mod( 'show_footer_social' ) ) { ?>
					<?php if ( has_nav_menu( 'hast-social-menu' ) ) { ?>
					<div class="footer-icon">
						<?php
							wp_nav_menu(array(
								'theme_location' => 'hast-social-menu'
							));
						?>
		            </div>
		            <?php }} ?>
		            <!-- End Footer social icons -->
				</div>
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-3 grid">
						<div class="column span-7 clearfix foo-menu text-left">
							<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
								<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
							<?php } ?>
						</div>
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-right"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s4' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-4" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-4 grid">
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-left"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
						<div class="column span-7 clearfix foo-menu text-right">
							<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s5' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-5" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-5 grid">
						<div class="column span-7 clearfix foo-menu text-left">
							<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
								<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
							<?php } ?>
						</div>
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-right"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s6' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-6" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-6 grid">
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-left"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
						<div class="column span-7 clearfix text-right">
				            <!-- Start Footer social icons -->
							<?php if( false != layers_get_theme_mod( 'show_footer_social' ) ) { ?>
							<?php if ( has_nav_menu( 'hast-social-menu' ) ) { ?>
							<div class="footer-icon social-foo-right">
								<?php
									wp_nav_menu(array(
										'theme_location' => 'hast-social-menu'
									));
								?>
				            </div>
				            <?php }} ?>
				            <!-- End Footer social icons -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s7' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-7" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-7 grid">
						<div class="column span-7 clearfix text-left">
				           <!-- Start Footer social icons -->
							<?php if( false != layers_get_theme_mod( 'show_footer_social' ) ) { ?>
							<?php if ( has_nav_menu( 'hast-social-menu' ) ) { ?>
							<div class="footer-icon social-foo-right">
								<?php
									wp_nav_menu(array(
										'theme_location' => 'hast-social-menu'
									));
								?>
				            </div>
				            <?php }} ?>
				            <!-- End Footer social icons -->
						</div>
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-right"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s8' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-8" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-8 grid">
						
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-left"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
						<div class="column span-2 clearfix center-logo">
							<?php if( false != layers_get_theme_mod( 'show_foo_logo' ) ) { ?>
								<?php $foologosize = layers_get_theme_mod( 'footer-logo-size');  ?>
								<div class="footer-logo footer-logo-<?php echo esc_attr($foologosize); ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php  $hastech_footer_logo=wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_logo') , 'full' );?>
										<img src="<?php echo esc_url($hastech_footer_logo); ?>" alt="">
									</a>
				                </div>
				            <?php } ?>
						</div>
						<div class="column span-5 clearfix text-right social-foo-flex-center">
							<!-- Start Footer social icons -->
							<?php if( false != layers_get_theme_mod( 'show_footer_social' ) ) { ?>
							<?php if ( has_nav_menu( 'hast-social-menu' ) ) { ?>
							<div class="footer-icon social-foo-right">
								<?php
									wp_nav_menu(array(
										'theme_location' => 'hast-social-menu'
									));
								?>
				            </div>
				            <?php }} ?>
				            <!-- End Footer social icons -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s9' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-9" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-9 grid">
						
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-left"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
						<div class="column span-2 clearfix center-logo">
							<?php if( false != layers_get_theme_mod( 'show_foo_logo' ) ) { ?>
								<?php $foologosize = layers_get_theme_mod( 'footer-logo-size');  ?>
								<div class="footer-logo footer-logo-<?php echo esc_attr($foologosize); ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php  $hastech_footer_logo=wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_logo') , 'full' );?>
										<img src="<?php echo esc_url($hastech_footer_logo); ?>" alt="">
									</a>
				                </div>
				            <?php } ?>
						</div>
						<div class="column span-5 clearfix credit-card-area text-right">
							<?php if( false != layers_get_theme_mod( 'show_foo_payment_icon' ) ) { ?>
								<?php $creditcardsimg = layers_get_theme_mod( 'the-custom-credit-cards-size');  ?>
								<div class="credit-card credit-card-<?php echo esc_attr($creditcardsimg); ?>">
									<?php  $hastech_credit_cards=wp_get_attachment_url( layers_get_theme_mod('the_custom_credit_cards') , 'full' );?>
										<img src="<?php echo esc_url($hastech_credit_cards); ?>" alt="">
				                </div>
				            <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s10' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-10" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-10 grid">
						<div class="column span-5 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-left"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
						<div class="column span-2 clearfix center-logo">
							<?php if( false != layers_get_theme_mod( 'show_foo_logo' ) ) { ?>
								<?php $foologosize = layers_get_theme_mod( 'footer-logo-size');  ?>
								<div class="footer-logo footer-logo-<?php echo esc_attr($foologosize); ?>">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php  $hastech_footer_logo=wp_get_attachment_url( layers_get_theme_mod('the_custom_footer_logo') , 'full' );?>
										<img src="<?php echo esc_url($hastech_footer_logo); ?>" alt="">
									</a>
				                </div>
				            <?php } ?>
						</div>
						<div class="column span-5 clearfix foo-menu text-right">
							<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s11' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-11" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-11 grid">
						<div class="column span-7 clearfix foo-menu text-left">
						<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
						<?php } ?>
						</div>
						<div class="column span-5 clearfix credit-card-area text-right">
							<?php if( false != layers_get_theme_mod( 'show_foo_payment_icon' ) ) { ?>
								<?php $creditcardsimg = layers_get_theme_mod( 'the-custom-credit-cards-size');  ?>
								<div class="credit-card credit-card-<?php echo esc_attr($creditcardsimg); ?>">
									<?php  $hastech_credit_cards=wp_get_attachment_url( layers_get_theme_mod('the_custom_credit_cards') , 'full' );?>
										<img src="<?php echo esc_url($hastech_credit_cards); ?>" alt="">
				                </div>
				            <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s12' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-12" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-12 grid">
						<div class="column span-12 clearfix foo-menu text-center">
							<?php if( false != layers_get_theme_mod( 'show-footer-menu' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => LAYERS_THEME_SLUG . '-footer' , 'container' => 'nav', 'container_class' => 'nav nav-horizontal footermenu', 'fallback_cb' => false )); ?>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php } elseif ('ht-copyright-s13' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-13" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-13 grid">
						<div class="column span-12 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-center"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } elseif ('ht-copyright-s14' == $copyrightstylevar) {?>
	<div class="copyright-footer-bg foo-copyright-style-13" style="<?php if(isset($set_copyright_bg)){ echo esc_html( $set_copyright_bg ); } ?> margin-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_top' )); ?>px; margin-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_margin_bottom' )); ?>px;" <?php if(isset($copyright_bg_img)){ echo esc_attr($set_copyright_data_opacity); } ?>>
		<div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'footer-width' ) ) echo esc_attr('container'); ?> content clearfix">
			<div class="grid copyright <?php echo esc_html(layers_get_theme_mod( 'footer_content_alignment' )); ?>" style="padding-top: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_top' )); ?>px;  padding-bottom: <?php echo esc_html(layers_get_theme_mod( 'custom_footer_padding_bottom' )); ?>px;">
				<div class="column span-12">
					<div class="foo-copyright-foomenu-layout-13 grid">
						<div class="column span-12 clearfix copytest">
							<?php if( '' != layers_get_theme_mod( 'footer-copyright-text' ) ) {  ?>
								<p class="site-text text-center"><?php echo esc_html(layers_get_theme_mod( 'footer-copyright-text' )); ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php }else{
} ?>

	<?php do_action( 'layers_after_footer_copyright' ); ?>

</section><!-- END / FOOTER -->



<?php do_action( 'layers_after_footer' ); ?>