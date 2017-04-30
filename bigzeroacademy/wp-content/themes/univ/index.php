<?php
/**
 * Standard blog index page
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header(); ?>

<div class="container content-main pdb-60 archive clearfix">
    <?php if( have_posts() ) : ?>
	<div class="grid">

            <?php while( have_posts() ) : the_post(); ?>
			
				<div class="column span-4 sk">
					<?php get_template_part( 'partials/content' , 'blog' ); ?>
				</div>
				
            <?php endwhile; // while has_post(); ?>
			     
	</div>
	<div class="extra-paginition">
		<?php layers_pagination( array( 'query' => $wp_query ) ); ?>
	</div>	
    <?php endif; // if has_post() ?>	
</div>
<?php get_footer();