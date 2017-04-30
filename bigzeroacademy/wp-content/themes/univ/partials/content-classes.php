<?php
	/**
	 * This partial is used for displaying single class post (or page) content
	 *
	 * @package Layers
	 * @since Layers 1.0.0
	 */
?>
<?php do_action('layers_before_single_post'); ?>
	<div class="column span-8">
		
		<?php do_action('layers_after_single_post_title'); ?>
		
		<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('univ_dclass_image'); 
			} 
		?>
		<?php  $age  = get_post_meta( get_the_ID(),'_univ_age', true );?>
		<?php  $size  = get_post_meta( get_the_ID(),'_univ_size', true );?>
		<div class="class-schedule details-schedule">											
			<span><?php esc_html_e( 'Duration:' , 'univ' ); ?> <?php echo $age;?></span>
			<span><?php esc_html_e( 'Sit Available:' , 'univ' ); ?> <?php echo $size;?></span>
		</div>	

		<?php do_action('layers_before_single_post_title'); ?>
		
			<header class="section-title large">
			
				<?php do_action('layers_before_single_title'); ?>
				
					<h1 class="heading"><?php the_title(); ?></h1>
					
				<?php do_action('layers_after_single_title'); ?>
				
			</header>	
			<?php	

		if ( '' != get_the_content() ) { ?>
			<?php do_action('layers_before_single_content'); ?>
			<div class="story">
			<?php ?>
				<div class="class-details-tab tbd">
					<div class="class-details-tab-menu">
						<ul role="tablist" class="single-tab nav-tabs">
							<li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="overview" href="#overview"><i class="fa fa-graduation-cap"></i><?php esc_html_e('Overview' , 'univ' ); ?></a></li>
							<li role="presentation"><a data-toggle="tab" role="tab" aria-controls="schedule" href="#schedule"><i class="fa fa-calendar"></i><?php esc_html_e('Week Courses Schedule' , 'univ' ); ?></a></li>
							<li role="presentation"><a data-toggle="tab" role="tab" aria-controls="comments" href="#commentss"><i class="fa fa-comments"></i><?php esc_html_e('Comments' , 'univ' ); ?> &#40; <?php comments_number( esc_html__('no','univ'), esc_html__('1','univ'), esc_html__('%','univ') ); ?> &#41;</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<div class="tab-content">
						<div id="overview" class="tab-pane active" role="tabpanel">

								<?php /**
								* Display the Content
								*/
								the_content(); ?>
						</div>
						<div id="schedule" class="tab-pane" role="tabpanel">
							<?php  $ctitle  = get_post_meta( get_the_ID(),'_univ_ctitle', true );?>
							<?php  $cdes  = get_post_meta( get_the_ID(),'_univ_cdes', true );?>
							<?php  $fcdes  = get_post_meta( get_the_ID(),'_univ_fcdes', true );?>
								<?php if( $ctitle || $cdes  ){?>
									<h3><?php echo esc_html( $ctitle );?></h3>
									<p><?php echo esc_html( $cdes );?></p>	
								<?php } ?>	
								<div class="table-content table-responsive">
									<table>
										<thead>
											<tr>
											<?php  $daygrops  = get_post_meta( get_the_ID(),'_univ_daygrop', true );?>
											<?php if( $daygrops ){?>
												<?php
												foreach ( (array) $daygrops as $daygropd => $daygropss ){
												$day1 = $day2 = $day3 = $day4 = $day5 ='';
												if ( isset( $daygropss['_univ_day1'] ) ) {
													$day1 =  $daygropss['_univ_day1'];	
												}	
												if ( isset( $daygropss['_univ_day2'] ) ) {
													$day2 =  $daygropss['_univ_day2'];	
												}
												if ( isset( $daygropss['_univ_day3'] ) ) {
													$day3 =  $daygropss['_univ_day3'];	
												}
												if ( isset( $daygropss['_univ_day4'] ) ) {
													$day4 =  $daygropss['_univ_day4'];	
												}
												if ( isset( $daygropss['_univ_day5'] ) ) {
													$day5 =  $daygropss['_univ_day5'];	
												} ?>
												
												<td><div><?php echo esc_html( $day1 );?></div></td>
												<td><div><?php echo esc_html( $day2 );?></div></td>
												<td><div><?php echo esc_html( $day3 );?></div></td>
												<td><div><?php echo esc_html( $day4 );?></div></td>
												<td><div><?php echo esc_html( $day5 );?></div></td>													
											<?php }} ?>
											</tr>
										</thead>
										<tbody>
											<tr>
											<?php  $timegrop  = get_post_meta( get_the_ID(),'_univ_timegrop', true );?>
											<?php foreach ( (array) $timegrop as $timegropst => $timegrops ){
												$time1 = $time2 = $time3 = $time4 = $time5 = $week1 = $week2 = $week3 = $week4 = $week5 = '';
												if ( isset( $timegrops['_univ_time1'] ) ) {
													$time1 =  $timegrops['_univ_time1'];	
												}
												if ( isset( $timegrops['_univ_time2'] ) ) {
													$time2 =  $timegrops['_univ_time2'];	
												}
												if ( isset( $timegrops['_univ_time3'] ) ) {
													$time3 =  $timegrops['_univ_time3'];	
												}
												if ( isset( $timegrops['_univ_time4'] ) ) {
													$time4 =  $timegrops['_univ_time4'];	
												}
												if ( isset( $timegrops['_univ_time5'] ) ) {
													$time5 =  $timegrops['_univ_time5'];	
												}
												
												if ( isset( $timegrops['_univ_week1'] ) ) {
													$week1 =  $timegrops['_univ_week1'];	
												}
												if ( isset( $timegrops['_univ_week2'] ) ) {
													$week2 =  $timegrops['_univ_week2'];	
												}
												if ( isset( $timegrops['_univ_week3'] ) ) {
													$week3 =  $timegrops['_univ_week3'];	
												}
												if ( isset( $timegrops['_univ_week4'] ) ) {
													$week4 =  $timegrops['_univ_week4'];	
												}
												if ( isset( $timegrops['_univ_week5'] ) ) {
													$week5 =  $timegrops['_univ_week5'];	
												}

											?>
												<td class="sub-title"><div><?php echo esc_html( $time1 );?><span><?php echo esc_html( $week1 );?></span></div></td>
												<td class="sub-title"><div><?php echo esc_html( $time2 );?><span><?php echo esc_html( $week2 );?></span></div></td>
												<td class="sub-title"><div><?php echo esc_html( $time3 );?><span><?php echo esc_html( $week3 );?></span></div></td>
												<td class="sub-title"><div><?php echo esc_html( $time4 );?><span><?php echo esc_html( $week4 );?></span></div></td>
												<td class="sub-title"><div><?php echo esc_html( $time5 );?><span><?php echo esc_html( $week5 );?></span></div></td>													
											<?php } ?>												
											</tr>											
											<?php  $edaygrop  = get_post_meta( get_the_ID(),'_univ_edaygrop', true );?>
												<?php foreach ( (array) $edaygrop as $edaygropstm => $edaygrops ){
												$shtime1 = $shtime2 = $shtime3 = $shtime4 = $shtime5 ='';
												if ( isset( $edaygrops['_univ_etime1'] ) ) {
													$shtime1 =  $edaygrops['_univ_etime1'];	
												}	
												if ( isset( $edaygrops['_univ_etime2'] ) ) {
													$shtime2 =  $edaygrops['_univ_etime2'];	
												}
												if ( isset( $edaygrops['_univ_etime3'] ) ) {
													$shtime3 =  $edaygrops['_univ_etime3'];	
												}
												if ( isset( $edaygrops['_univ_etime4'] ) ) {
													$shtime4 =  $edaygrops['_univ_etime4'];	
												}
												if ( isset( $edaygrops['_univ_etime5'] ) ) {
													$shtime5 =  $edaygrops['_univ_etime5'];	
												} ?>

												<tr>
													<td><div><?php echo esc_html( $shtime1 );?></div></td>
													<td><div><?php echo esc_html( $shtime2 );?></div></td>
													<td><div><?php echo esc_html( $shtime3 );?></div></td>
													<td><div><?php echo esc_html( $shtime4 );?></div></td>
													<td><div><?php echo esc_html( $shtime5 );?></div></td>
												</tr>												
											<?php } ?>
										</tbody>
									</table>
								</div>
								<?php if( $fcdes ){?>
									<p><?php echo esc_html( $fcdes );?></p>
								<?php } ?>
						</div>
						<div id="commentss" class="tab-pane" role="tabpanel">
							<?php 								/**
							* Display the Post Comments
							*/
							comments_template();
							?>
						</div>				
					</div>
				</div>
				<?php /**
				* Display In-Post Pagination
				*/
				wp_link_pages( array(
					'link_before'   => '<span>',
					'link_after'    => '</span>',
					'before'        => '<p class="inner-post-pagination">' . esc_html__('<span>Pages:</span>', 'ocmx'),
					'after'     => '</p>'
				)); ?>
			</div>
			<?php do_action('layers_after_single_content'); ?>
			<?php } // '' != get_the_content()?>
	</div>		
	<div class="column span-4">             
		<div class="single-widget-item">
			<?php  $infoclasstitle  = get_post_meta( get_the_ID(),'_univ_infoclasstitle', true );?>
			<?php if( $infoclasstitle ){?>
			<div class="single-title">
				<h3><?php echo esc_html( $infoclasstitle ); ?></h3>
			</div>
			<?php } ?>
			<div class="single-widget-container">											
				<ul class="class-infos">
					<?php  $single_teacher_info  = get_post_meta( get_the_ID(),'_univ_infoclass', true );?>
					<?php if( $single_teacher_info ){?>
						<?php foreach ( (array) $single_teacher_info as $steacher_infos => $steacher_info ){
							$strat1 = $strat2 = $strat3 = $strat4 = $strat5 = $strat6 = $strat7 ='';
								
								if ( isset( $steacher_info['_univ_stdate'] ) ) {
									$strat1 =  $steacher_info['_univ_stdate'];	
								}	
								if ( isset( $steacher_info['_univ_yold'] ) ) {
									$strat2 =  $steacher_info['_univ_yold'];	
								}
								if ( isset( $steacher_info['_univ_clsize'] ) ) {
									$strat3 =  $steacher_info['_univ_clsize'];	
								}
								if ( isset( $steacher_info['_univ_claduration'] ) ) {
									$strat4 =  $steacher_info['_univ_claduration'];	
								}
								if ( isset( $steacher_info['_univ_transportation'] ) ) {
									$strat5 =  $steacher_info['_univ_transportation'];	
								}
								if ( isset( $steacher_info['_univ_clmonigfood'] ) ) {
									$strat6 =  $steacher_info['_univ_clmonigfood'];	
								}
								if ( isset( $steacher_info['_univ_clasttaf'] ) ) {
									$strat7 =  $steacher_info['_univ_clasttaf'];	
								}
							?>
												
						<li><i class="fa fa-calendar"></i><?php esc_html_e('Start Date:' , 'univ' ); ?> <?php echo esc_html( $strat1 );?></li>
						<li><i class="fa fa-birthday-cake"></i><?php esc_html_e('Years Old:' , 'univ' ); ?> <?php echo esc_html( $strat2 );?></li>
						<li><i class="fa fa-bank"></i><?php esc_html_e('Class Size:' , 'univ' ); ?> <?php echo esc_html( $strat3 );?></li>
						<li><i class="fa fa-clock-o"></i><?php esc_html_e('Class Duration:' , 'univ' ); ?> <?php echo esc_html( $strat4 );?></li>
						<li><i class="fa fa-bus"></i><?php esc_html_e('Transportation:' , 'univ' ); ?> <?php echo esc_html( $strat5 );?></li>
						<li><i class="fa fa-cutlery"></i><?php esc_html_e('Morning Foods:' , 'univ' ); ?> <?php echo esc_html( $strat6 );?></li>
						<li><i class="fa fa-users"></i><?php esc_html_e('Class Starff:' , 'univ' ); ?> <?php echo esc_html( $strat7 );?></li>
					<?php }}?>									
				</ul>
			</div>
		</div>
		<div class="single-widget-item">
			<?php  $classttitle  = get_post_meta( get_the_ID(),'_univ_classttitle', true );?>
			<?php if( $classttitle ){?>
			<div class="single-title">
				<h3><?php echo esc_html( $classttitle ); ?></h3>
			</div>
			<?php } ?>						
			<div class="single-widget-container">
				<?php  $single_teacher  = get_post_meta( get_the_ID(),'_univ_cteacher', true );?>
				<?php if( $single_teacher ){?>
				
						<?php foreach ( (array) $single_teacher as $steachert => $steacher ){
							$class_teacher1 = $class_teacher2 = $class_teacher3 = $class_teacher4 = '';
								if ( isset( $steacher['_univ_teacherurl'] ) ) {
									$class_teacher1 =  $steacher['_univ_teacherurl'];	
								}
								if ( isset( $steacher['_univ_timage'] ) ) {
									$class_teacher2 =  $steacher['_univ_timage'];	
								}
								if ( isset( $steacher['_univ_ttitle'] ) ) {
									$class_teacher3 =  $steacher['_univ_ttitle'];	
								}
								if ( isset( $steacher['_univ_tdesig'] ) ) {
									$class_teacher4 =  $steacher['_univ_tdesig'];	
								}
							?>					
						<div class="teacher-info-widget">
							<div class="widget-image">
								<a  target="_blank" href="<?php echo esc_url( $class_teacher1 ); ?>"><img src="<?php echo esc_url( $class_teacher2 ); ?>" alt=""></a>
							</div>
							<div class="widget-infos">
								<h4><a target="_blank" href="<?php echo esc_url( $class_teacher1 ); ?>"><?php echo esc_html( $class_teacher3 ); ?></a></h4>
								<p><?php echo esc_html( $class_teacher4 ); ?></p>
							</div>
						</div>										
				<?php }}?>																											
			</div>
		</div>
		<?php  $rclass  = get_post_meta( get_the_ID(),'_univ_contract_form_s', true );?>
		<?php if( $single_teacher ){?>	
		<div class="single-widget-item">
			<?php echo do_shortcode( $rclass ); ?>	
		</div>  
			<?php } ?>	
			   
	</div>
<?php do_action('layers_after_single_post'); ?>