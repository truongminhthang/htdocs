<?php
/**
 * This template is used for displaying posts in post lists
 *
 * @package Layers
 * @since Layers 1.0.0
 */
 ?>

	<div <?php post_class(); ?>>
		<div class="single-blog-item overlay-hover single-blog-pading">	
			<?php if ( has_post_thumbnail() ) { ?>	
			<div class="single-blog-image">
					<?php /**
					* Display the Featured Thumbnail
					*/
					echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'overlay-effect', 'size' => 'univ_blog_image' ) ); ?>
   
			</div>
			<?php }else{ ?>
				<?php /**
					* Display the Featured Thumbnail
					*/
					echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'overlay-effect', 'size' => 'univ_blog_image' ) ); ?>
				
			<?php } ?>
			<div class="single-blog-text pd-0">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
				<div class="blog-date">
					<span><i class="fa fa-calendar"></i>
					 <?php echo get_the_time(get_option('date_format')); ?>
					</span>
					<span><i class="fa fa-folder-o"></i><?php the_category( ' / ' ); ?></span>
					<span>
						<a class="right" href="">
							<i class="fa fa-comment"></i> <?php comments_number( '0', '1', '%' ); ?>
						</a>
					</span>
				</div>
					<p>
						<?php echo wp_trim_words( get_the_content(), 20, ' ...' ); ?>
					</p>
				<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more.','univ' ); ?></a>
			</div>	
		</div>	
	</div>
	