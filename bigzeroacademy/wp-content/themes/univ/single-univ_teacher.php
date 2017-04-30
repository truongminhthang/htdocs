<?php
/**
 * The template for displaying a single post
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header(); ?>
<div <?php post_class( 'content-main clearfix' ); ?>>
	<?php do_action('layers_before_post_loop'); ?>
	
		<?php if( have_posts() ) : ?>

			<?php while( have_posts() ) : the_post(); ?>
	
				<article  id="post-<?php the_ID(); ?>" class="padding90">
				
				<div class="grid">	
				
					<?php get_template_part( 'partials/content', 'teacher' ); ?>
					
				</div>	
				
				</article>

			<?php endwhile; // while has_post(); ?>

		<?php endif; // if has_post() ?>				
	
	<?php do_action('layers_after_post_loop'); ?>
</div>

<?php get_footer();