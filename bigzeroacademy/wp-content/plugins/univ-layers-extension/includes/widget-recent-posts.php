<?php
/**
 * Widget Univ Recent Posts
 */
// Register and load the widget
	function univ_load_widget() {

	    register_widget( 'Univ_Recent_Posts_Widget' );

	}
	add_action( 'widgets_init', 'univ_load_widget' );
	
	class Univ_Recent_Posts_Widget extends WP_Widget {
	
	/* ---------------------------------------------------------------------------
	 * Constructor
	 * --------------------------------------------------------------------------- */
	 
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_recent_data',
			'description' => esc_html__( 'The most recent posts on your site.', 'univ' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'Univ_Recent_Posts_Widget', esc_html__( 'Univ Recent Posts','univ' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_data';
	}	

	
	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) $args['widget_id'] = null;
		extract( $args, EXTR_SKIP );

		echo $before_widget;
		
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base);
		
	?>
	<div class="single-widget-item">
		<?php if( $title ) echo $before_title . $title . $after_title;?>
		<?php 			
		$args = array(
			'posts_per_page' => $instance['count'] ? intval($instance['count']) : 0,
			'no_found_rows' => true,
			'post_status' => 'publish',
			'ignore_sticky_posts' => true
		);
		$r = new WP_Query( apply_filters( 'widget_posts_args', $args ) );
		
		if ($r->have_posts()){
		while ( $r->have_posts() ){
					$r->the_post();
				
			?>		
			<div class="recent-post-item">
				<div class="recent-post-image">
				<?php if( has_post_thumbnail( get_the_ID() ) ){?>
					<a href="<?php echo esc_url( get_permalink() ); ?>">
					
					<?php echo get_the_post_thumbnail( get_the_ID(), 'univ_recent_image' );?>
					
					</a>
				<?php } ?>

				</div>
				<div class="recent-post-text">
					<h4><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title();?></a></h4>
					<span class="commentss"> <?php echo get_comments_number();?> <?php esc_html_e('Comment' , 'univ' ); ?>  </span><br>
					<span class="commentsm"><i class="fa fa-calendar"></i><?php echo get_the_time('F j, Y');?></span>
				</div>
			</div>
		<?php }?>
		<?php 
		wp_reset_postdata();
		
		}?>
	</div>
	<?php 
 	echo $after_widget;
	
	}
 

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = (int) $new_instance['count'];
		
		return $instance;
	}

	
	/* ---------------------------------------------------------------------------
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 * --------------------------------------------------------------------------- */
	public function form( $instance ) {
		
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 2;

		?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'univ' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>			
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'univ' ); ?></label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" size="4"/>
			</p>
			
		<?php
	}
}
