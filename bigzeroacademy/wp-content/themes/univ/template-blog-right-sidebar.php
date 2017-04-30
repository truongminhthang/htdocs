<?php
/**
 * Template Name: Univ Blog Right Sidebar
 *
 * The template for displaying blog page with right sidebar
 *
 * @package Layers
 * @since Layers 1.0.0
 */

get_header(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'container content-main clearfix pdb-60' ); ?>>
    <div class="grid">

		<article class="column span-9" >
			<div class="grid">	
				<?php global $post; ?>
				<?php
					$page = ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
					$paged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : $page );
					$wp_query = new WP_Query( array(
						'post_type' => 'post',
						'paged'     => $paged,
						'page'      => $paged,
					) );

				if ( $wp_query->have_posts() ) : ?>
					
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
						<div class="blog-info-left column span-6" id="post-<?php the_ID(); ?>">
						
							<div class="single-blog-item overlay-hover single-blog-pading">
								<?php if ( has_post_thumbnail() ) { ?>
								<div class="single-blog-image">
										<?php /**
										* Display the Featured Thumbnail
										*/
										echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'overlay-effect', 'size' => 'univ_right_blog_image' ) ); ?>
								</div>
								<?php }else{ ?>
									<?php /**
										* Display the Featured Thumbnail
										*/
										echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'overlay-effect', 'size' => 'univ_right_blog_image' ) ); ?>
								<?php } ?>
								<div class="single-blog-text pd-0">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
									<div class="blog-date">
										<span><i class="fa fa-calendar"></i> <?php echo get_the_time(get_option('date_format')); ?></span>
										<span><i class="fa fa-folder-o"></i><?php the_category( ' / ' ); ?></span>
									</div>
										<p>
											<?php echo wp_trim_words( get_the_content(), 24, ' ...' ); ?>
										</p>
									<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more.','univ' ); ?></a>
								</div>	
							</div>	

						</div>
					<?php endwhile; // while has_post(); ?>
					<div class="extra-paginition">
						<?php layers_pagination( array( 'query' => $wp_query ) ); ?>
					</div>
				<?php endif; // if has_post() ?>			
	
			 </div>
		 </article>
		
		<div class="column span-3 pull-right sidebar">
		
		   <?php if ( is_active_sidebar( 'layers-right-sidebar' ) ) : ?>
		   
				<?php dynamic_sidebar( 'layers-right-sidebar' ); ?>
				
			<?php endif; ?>
			
		</div>    
	</div>
</div>

<?php get_footer();