<?php
/**
 * This partial is used for displaying single post (or page) content
 *
 * @package Layers
 * @since Layers 1.0.0
 */

		$event_organizer  = get_post_meta( get_the_ID(),'_univ_event_organizer', true );
		$event_phone  = get_post_meta( get_the_ID(),'_univ_event_phone', true );
		$event_website  = get_post_meta( get_the_ID(),'_univ_event_website', true );
		$event_date  = get_post_meta( get_the_ID(),'_univ_event_date', true );
		$event_location  = get_post_meta( get_the_ID(),'_univ_loaction', true );
		$event_time  = get_post_meta( get_the_ID(),'_univ_event_time', true );
		$event_map  = get_post_meta( get_the_ID(),'_univ_event_map', true );
		$event_map_lat  = get_post_meta( get_the_ID(),'_univ_event_map_lat', true );	
		$event_map_lng  = get_post_meta( get_the_ID(),'_univ_event_map_lng', true );	
?>	



<div class="single-event">
		<?php 
		if(has_post_thumbnail() ){  ?>
		<div class="event_img">

					
			<?php 	the_post_thumbnail( 'univ_blog_single_image', array( 'class' => 'img-responsive' ) ); ?>
			
		
		</div>
		<?php }?>
	<div class="event_content">
		<h3><?php the_title(); ?></h3>
		<p><?php the_content(); ?></p>
	</div>
</div>
<div class="event-details">
	<h4 class="section-nav-title"><?php esc_html_e('Event Details' , 'univ'); ?></h4>
	<?php 
	?>
	<div class="grid">
		<div class="column span-6">
		
			<?php $event_info_group_single = get_post_meta( get_the_ID(), '_univ_event_info_group', true ); ?>

			<?php if($event_info_group_single){?>
				<div class="organizer">
					<?php foreach($event_info_group_single as $eventkey => $event){
						$ename=$einfo="";
						if(isset($event['_univ_event_info_name'])){
							$ename=$event['_univ_event_info_name'];
						}
						if(isset($event['_univ_event_info'])){
							$einfo=$event['_univ_event_info'];
						} ?>
						<h4><?php echo esc_html($ename); ?></h4>
						<p><?php echo esc_html($einfo); ?></p>
						<?php } ?>
				</div>
					<?php } ?>

		</div>
		<div class="column span-6">
			<div class="organizer">
			<?php if(!empty($event_location)){?>
				<h4><?php echo esc_html_e('Location' , 'univ'); ?> </h4>
				<p> <?php echo esc_html($event_location); ?></p>
			<?php }?>
			<?php if(!empty($event_date)){?>
				<h4><?php echo esc_html_e('Date: ', 'univ');?></h4>
				<p><?php echo esc_html($event_date); ?></p>
			<?php }?>
			<?php if(!empty($event_time)){?>
				<h4><?php echo esc_html_e('Time: ', 'univ');?></h4>
				<p><?php echo esc_html($event_time); ?></p>
			<?php }?>							
			</div>
		</div>
	</div>
	<?php if(!empty($event_map)){?>
	<div class="map_wrapper">
		<div id="googleMap"></div>
	</div>
	<?php }?>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_html( $event_map ); ?>"></script>
		<script>
			// When the window has finished loading create our google map below
			google.maps.event.addDomListener(window, 'load', init);

			function init() {
				// Basic options for a simple Google Map
				// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
				var mapOptions = {
					// How zoomed in you want the map to start at (always required)
					zoom: 11,

					scrollwheel: false,

					// The latitude and longitude to center the map (always required)
					center: new google.maps.LatLng(<?php echo esc_html( $event_map_lat ); ?>, <?php echo esc_html( $event_map_lng ); ?>), // New York

					// How you would like to style the map. 
					// This is where you would paste any style found on Snazzy Maps.
					styles: [
								{
									"featureType": "administrative",
									"elementType": "labels.text.fill",
									"stylers": [
										{
											"color": "#444444"
										}
									]
							    },
							    {
							        "featureType": "administrative.country",
							        "elementType": "geometry.fill",
							        "stylers": [
							            {
							                "hue": "#ff0000"
							            },
							            {
							                "saturation": "-10"
							            },
							            {
							                "visibility": "simplified"
							            }
							        ]
							    },
							    {
							        "featureType": "landscape",
							        "elementType": "all",
							        "stylers": [
							            {
							                "color": "#fff"
							            }
							        ]
							    },
							    {
							        "featureType": "poi",
							        "elementType": "all",
							        "stylers": [
							            {
							                "visibility": "off"
							            }
							        ]
							    },
							    {
							        "featureType": "road",
							        "elementType": "all",
							        "stylers": [
							            {
							                "saturation": -100
							            },
							            {
							                "lightness": 45
							            }
							        ]
							    },
							    {
							        "featureType": "road.highway",
							        "elementType": "all",
							        "stylers": [
							            {
							                "visibility": "simplified"
							            }
							        ]
							    },
							    {
							        "featureType": "road.arterial",
							        "elementType": "labels.icon",
							        "stylers": [
							            {
							                "visibility": "off"
							            }
							        ]
							    },
							    {
									"featureType": "transit",
									"elementType": "all",
									"stylers": [
										{
											"visibility": "off"
										}
									]
								},
								{
									"featureType": "water",
									"elementType": "all",
									"stylers": [
										{
										"color": "#1BB4B9"
										},
										{
											"visibility": "on"
										}
									]
								}
							]
				};

				// Get the HTML DOM element that will contain your map 
				// We are using a div with id="map" seen below in the <body>
				var mapElement = document.getElementById('googleMap');

				// Create the Google Map using our element and options defined above
				var map = new google.maps.Map(mapElement, mapOptions);

				// Let's also add a marker while we're at it
				var marker = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo esc_html( $event_map_lat ); ?>, <?php echo esc_html( $event_map_lng ); ?>),
				map: map,
				title: 'Univ!'
			});
		}
		</script>


<?php

do_action('layers_before_single_post');



/**
* Display the Post Comments
*/
comments_template();

do_action('layers_after_single_post');
