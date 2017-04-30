<?php
/**
 * This partial is used for displaying empty page content
 *
 * @package Layers
 * @since Layers 1.0.0
 */ ?>
<header class="not-foundt404 ">
	<?php do_action('layers_before_single_title'); ?>
		<h1 class="notfound-title"><?php esc_html_e( 'No posts found' , 'univ' ) ; ?></h1>
	<?php do_action('layers_after_single_title'); ?>
</header>
<div class="ns notfound btn-search">
	<p><?php esc_html_e( 'Use the search form below to find the page you\'re looking for:' , 'univ' ) ; ?></p>
	<?php get_search_form(); ?>
</div>