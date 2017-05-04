<?php



class footer_info_widget extends WP_Widget{
	
	public function __construct(){
		parent::__construct(
		'footer_info_widget',
		esc_html__('Footer Info widget', 'univ'),
		array(
			'description' => esc_html__('This is footer info widget', 'univ'),
		)
		);
	}
	
	public function widget($args, $instance){
		
		$image_uri= ! empty( $instance['image_uri'] ) ? $instance['image_uri'] : '';
		$content= ! empty( $instance['content'] ) ? $instance['content'] : '';
		$facebook= ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter= ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
		$rss= ! empty( $instance['rss'] ) ? $instance['rss'] : '';
		$google= ! empty( $instance['google'] ) ? $instance['google'] : '';
		$pinterest= ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$instagram= ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
		
		?>
		
		<?php echo $args['before_widget']; ?>		
		
		<div class="footer-section">
			<img src="<?php echo esc_url( $image_uri ); ?>" alt="" />

			<p><?php echo $content; ?></p>

			<div class="social-icon">
				<?php if(isset($facebook) && !empty($facebook)){?>
					<a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<?php
				} ?>
				
				<?php if(isset($rss) && !empty($rss)){?>
					<a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-rss"></i></a>
				<?php
				} ?>
				
				<?php if(isset($twitter) && !empty($twitter)){?>
					<a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<?php
				} ?>
				
				<?php if(isset($google) && !empty($google)){?>
					<a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php
				} ?>
				
				<?php if(isset($pinterest) && !empty($pinterest)){?>
					<a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
				<?php
				} ?>
				
				<?php if(isset($pinterest) && !empty($pinterest)){?>
					<a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
				<?php
				} ?>
			</div>
		</div>	
		
		<?php echo $args['after_widget']; ?>	
		
		<?php 
	
	}
	
	public function form($instance){
		$image_uri= ! empty( $instance['image_uri'] ) ? $instance['image_uri'] : '';
		$content= ! empty( $instance['content'] ) ? $instance['content'] : '';
		$facebook= ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter= ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
		$rss= ! empty( $instance['rss'] ) ? $instance['rss'] : '';
		$google= ! empty( $instance['google'] ) ? $instance['google'] : '';
		$pinterest= ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$instagram= ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
		
		?>
		
		<p>
			<label style="display:block;" for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>"><?php esc_html_e('Upload Image:','univ');?></label>
			
			<img class="custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;display:inline-block" />
			
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" value="<?php echo esc_attr($instance['image_uri']); ?>">
			<a href="#" id="custom_media_button" style="margin-top:10px;" class="button button-primary custom_media_button"><?php esc_html_e('Upload', 'univ'); ?></a>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>">
				<?php esc_html_e('Content:', 'univ'); ?>
			</label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" value="<?php echo esc_attr( $content ); ?>"><?php echo esc_attr( $content ); ?></textarea>
		</p>
				
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
				<?php esc_html_e('Facebook:', 'univ'); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $facebook ); ?>" type="text">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
				<?php esc_html_e('Twitter:', 'univ'); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $twitter ); ?>" type="text">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>">
				<?php esc_html_e('Rss:', 'univ'); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss' ) ); ?>" value="<?php echo esc_attr( $rss ); ?>" type="text">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>">
				<?php esc_html_e('Google+:', 'univ'); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google' ) ); ?>" value="<?php echo esc_attr( $google ); ?>" type="text">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>">
				<?php esc_html_e('Pinterest:', 'univ'); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $pinterest ); ?>" type="text">
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
				<?php esc_html_e('Instagram:', 'univ'); ?>
			</label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instagram ); ?>" type="text">
		</p>
		
	<?php }
	
	
}




function footer_info(){
	register_widget('footer_info_widget');
}
add_action('widgets_init','footer_info');