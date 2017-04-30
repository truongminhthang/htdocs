<?php
	/**
	 * This partial is used for displaying single teacher post (or page) content
	 *
	 * @package Layers
	 * @since Layers 1.0.0
	 */
?>
<?php do_action('layers_before_single_post'); ?>
	<div class="column span-4">
		<div class="ts teacher-details-image">
			<?php
			echo layers_post_featured_media( array( 'postid' => get_the_ID(), 'wrap_class' => 'thumbnail push-bottom', 'size' => 'large' ) );
			?>
		</div>
		<div class="story">
			<div class="col-md-4">
				<div class="ts teacher-details-image">	
					<?php  $groupfield  = get_post_meta( get_the_ID(),'_univ_teacherid', true ); ?>
					<?php  $tsubtitle  = get_post_meta( get_the_ID(),'_univ_tsubtitle', true ); ?>
					<?php  $taddress  = get_post_meta( get_the_ID(),'_univ_taddress', true ); ?>
					
					<?php if( $groupfield ){?>
						<div class="social-links">
							<?php
							foreach ( (array) $groupfield as $ticonss => $ticons )	{
								$tsocial1 = $tsocial2 = '';
								if ( isset( $ticons['_univ_turl'] ) ) {
									$tsocial1 =  $ticons['_univ_turl'];	
								}
								if ( isset( $ticons['_univ_ticon'] ) ) {
									$tsocial2 = $ticons['_univ_ticon'];	
								}
								?>
														
							<a href="<?php echo esc_url( $tsocial1 );?>"><i class="fa fa-<?php echo esc_html( $tsocial2 );?>"></i></a>
							<?php }?>	
						</div>
					<?php }?>													                           
				</div>
				<div class="teacher-details-info">
					<h4><?php the_title();?></h4>							
					<?php if( $tsubtitle ){?>						
					<span><?php echo esc_html( $tsubtitle ); ?></span>
					<?php } ?>


					<?php if( $taddress ){?>
						<div class="teacher-info-text">
							<?php
							foreach ( (array) $taddress as $taddresss => $taddress )	{
								$taddress1 = $taddress2 = '';
								if ( isset( $taddress['_univ_addressicon'] ) ) {
									$taddress1 =  $taddress['_univ_addressicon'];	
								}
								if ( isset( $taddress['_univ_addressname'] ) ) {
									$taddress2 = $taddress['_univ_addressname'];	
								}
								?>
							
								<span><i class="fa fa-<?php echo esc_html( $taddress1 );?>"></i><?php echo esc_html( $taddress2 );?></span>
							<?php }?>	
						</div>
					<?php }?>							
				</div>
			</div>
		</div>
	</div>
	<div class="column span-8">           
		<?php  $about_title  = get_post_meta( get_the_ID(),'_univ_abouttitle', true ); ?>
		<?php  $tprofessional  = get_post_meta( get_the_ID(),'_univ_tprofessional', true ); ?>
		<div class="teacher-about-info">
			<?php if( $about_title ){?>	
				<div class="single-title">
					<h3><?php echo esc_html( $about_title ); ?></h3>
				</div>							
			<?php } ?>						


			<?php if( $tprofessional ){?>
				 <div class="teacher-info-text">
					<?php					
						foreach ( (array) $tprofessional as $tprofes => $tprofess )	{
								$tprofess1 = $tprofess2 = '';
								if ( isset( $tprofess['_univ_professionicon'] ) ) {
									$tprofess1 =  $tprofess['_univ_professionicon'];	
								}
								if ( isset( $tprofess['_univ_professionaladdress'] ) ) {
									$tprofess2 = $tprofess['_univ_professionaladdress'];	
								}
								?>
					
						<span><i class="fa fa-<?php echo esc_html( $tprofess1 );?>"></i><?php echo esc_html( $tprofess2 );?></span>
					<?php }?>	
				</div>
			<?php }?>											
				<?php /**
					* Display the Content
					*/
				the_content(); ?>	
		</div>
		<div class="schedule-skill-wrapper">
			<div class="grid">
				<div class="column span-6">
				<?php  $schedule_title  = get_post_meta( get_the_ID(),'_univ_scheduletitle', true ); ?>
				<?php  $tschedule = get_post_meta( get_the_ID(),'_univ_tschedule', true ); ?>
					<?php if( $schedule_title ){?>	
						<div class="single-title">
							<h3><?php echo esc_html( $schedule_title ); ?></h3>
						</div>							
					<?php } ?>

				<?php if( $tschedule ){?>
					  <div class="schedule-text tx"> 
						<?php 					
						foreach ( (array) $tschedule as $tschedul => $tschedules )	{
								$tschedules1 = $tschedules2 = '';
								if ( isset( $tschedules['_univ_tschedule'] ) ) {
									$tschedules1 =  $tschedules['_univ_tschedule'];	
								}
								if ( isset( $tschedules['_univ_tschedulet'] ) ) {
									$tschedules2 = $tschedules['_univ_tschedulet'];	
								}
								?>
							<span><?php echo esc_html( $tschedules1 ); ?> <span class="schedule-time"><?php echo esc_html( $tschedules2 ); ?></span></span> 										
						<?php }?>	
					</div>
				<?php }?>										
				</div>
				<div class="column span-6">
				<?php  $skilltitle  = get_post_meta( get_the_ID(),'_univ_skilltitle', true ); ?>
				<?php  $tskills = get_post_meta( get_the_ID(),'_univ_tskills', true ); ?>															
					<?php if( $skilltitle ){?>	
						<div class="single-title">
							<h3><?php echo esc_html( $skilltitle ); ?></h3>
						</div>							
					<?php } ?>
					
					
					<div class="skill-bars orange">
					<?php if( $tskills ){
							foreach ( (array) $tskills as $tskills_sin => $tskills_single )	{
								$tskills_single1 = $tskills_single2 = ''; 
								if ( isset( $tskills_single['_univ_tskillname'] ) ) {
									$tskills_single1 =  $tskills_single['_univ_tskillname'];	
								}
								if ( isset( $tskills_single['_univ_tbackend'] ) ) {
									$tskills_single2 =  $tskills_single['_univ_tbackend'];	
								}
								if ( isset( $tskills_single['_univ_tskillvalue'] ) ) {
									$tskills_single3 =  $tskills_single['_univ_tskillvalue'];	
								}
								if ( isset( $tskills_single['_univ_tfcolor'] ) ) {
									$tskills_single4 =  $tskills_single['_univ_tfcolor'];	
								}
								
								?>											
							<div class="tt skill-bar-item">
								<span><?php echo esc_html( $tskills_single1 );?></span>
								<div class="steacher progress" style="background-color:<?php echo esc_html( $tskills_single2 );?>">
									<div class="orange progress-bar wow fadeInLeft" data-progress="<?php echo esc_html( $tskills_single3 );?>%" style="width:<?php echo esc_html( $tskills_single3 );?>%; background-color:<?php echo esc_html( $tskills_single4 );?>" data-wow-duration="1.5s" data-wow-delay="1.2s">
										<span class="text-top"><?php echo esc_html( $tskills_single3 );?>%</span>
									</div>
								</div>
							</div>												
						<?php }}?>										
					</div>
				</div>
			</div>
		</div>            
	</div>
<?php do_action('layers_after_post_loop'); ?>