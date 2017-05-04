<?php

add_action( 'cmb2_admin_init', 'univ_layer_metabox' );
/*
**	Setting up custom fields for custom post types belongs to fantasic child theme for LayersWP
*/ 

if ( !function_exists('univ_layer_metabox') ) {
	function univ_layer_metabox() {
		$prefix = '_univ_';

	//Teacher metabox
		$teacher = new_cmb2_box( array(
			'id'            => $prefix . 'teacher',
			'title'         => __( 'Teacher Option', 'univ' ),
			'object_types'  => array( 'univ_teacher', ), // Post type
			'priority'   => 'high',
		) );
				$teacher->add_field( array(
					'name'       => __( 'Sub Title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'tsubtitle',
					'type'       => 'text',
				) );	
				// $group_field_id is the field id string, so in this case: $prefix . 'univ'
				$teachergrop = $teacher->add_field( array(
					'id'          => $prefix . 'teacherid',
					'type'        => 'group',
					'description' => __( 'Add Second Icon', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'Social Icon {#}', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Another Icon', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$teacher->add_group_field( $teachergrop, array(
					'name'       => __( 'Social Icon', 'univ' ),
					'desc'       => __( 'insert Icon', 'univ' ),
					'id'         => $prefix . 'ticon',
					'type'       => 'text',
				) );
				$teacher->add_group_field( $teachergrop, array(
					'name'       => __( 'Enter Link', 'univ' ),
					'desc'       => __( 'insert link here', 'univ' ),
					'id'  => $prefix . 'turl',
					'type' => 'text_url',					
				) );

			// teacher address
				$teachergrop1 = $teacher->add_field( array(
					'id'          => $prefix . 'taddress',
					'type'        => 'group',
					'description' => __( 'Add Address Icon', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'info Icon {#}', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Another info', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$teacher->add_group_field( $teachergrop1, array(
					'name'       => __( 'Icon', 'univ' ),
					'desc'       => __( 'insert Icon', 'univ' ),
					'id'         => $prefix . 'addressicon',
					'type'       => 'text',
				) );
				$teacher->add_group_field( $teachergrop1, array(
					'name'       => __( 'Enter Address', 'univ' ),
					'desc'       => __( 'insert address here', 'univ' ),
					'id'  => $prefix . 'addressname',
					'type' => 'text',				
				) );
			// teacher professional info	
				$teacher->add_field( array(
					'name'       => __( 'About Title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'abouttitle',
					'type'       => 'text',
				) );
				$teachergrop2 = $teacher->add_field( array(
					'id'          => $prefix . 'tprofessional',
					'type'        => 'group',
					'description' => __( 'Add Icon', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'Professional info {#}', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Professional info', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$teacher->add_group_field( $teachergrop2, array(
					'name'       => __( 'Icon', 'univ' ),
					'desc'       => __( 'insert Icon', 'univ' ),
					'id'         => $prefix . 'professionicon',
					'type'       => 'text',
				) );
				$teacher->add_group_field( $teachergrop2, array(
					'name'       => __( 'Enter professional title', 'univ' ),
					'desc'       => __( 'insert address here', 'univ' ),
					'id'  => $prefix . 'professionaladdress',
					'type' => 'text',				
				) );
			// teacher  Schedule
				$teacher->add_field( array(
					'name'       => __( 'Schedule Title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'scheduletitle',
					'type'       => 'text',
				) );
				$teachergrop3 = $teacher->add_field( array(
					'id'          => $prefix . 'tschedule',
					'type'        => 'group',
					'description' => __( 'Teacher Schedule', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'schedule info {#}', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add schedule info', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$teacher->add_group_field( $teachergrop3, array(
					'name'       => __( 'Day', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'tschedule',
					'type'       => 'text',
				) );
				$teacher->add_group_field( $teachergrop3, array(
					'name'       => __( 'time', 'univ' ),
					'desc'       => __( 'insert time here', 'univ' ),
					'id'  => $prefix . 'tschedulet',
					'type' => 'text',				
				) );
			// teacher  Skills
				$teacher->add_field( array(
					'name'       => __( 'Skills Title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'skilltitle',
					'type'       => 'text',
				) );
				$teachergrop4 = $teacher->add_field( array(
					'id'          => $prefix . 'tskills',
					'type'        => 'group',
					'description' => __( 'Teacher Skills', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'Skills info {#}', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Skills info', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$teacher->add_group_field( $teachergrop4, array(
					'name'       => __( 'Name', 'univ' ),
					'desc'       => __( 'insert name', 'univ' ),
					'id'         => $prefix . 'tskillname',
					'type'       => 'text',
				) );
				$teacher->add_group_field( $teachergrop4, array(
					'name'       => __( 'Value', 'univ' ),
					'desc'       => __( 'insert value here', 'univ' ),
					'id'  => $prefix . 'tskillvalue',
					'type' => 'text',				
				) );
				$teacher->add_group_field( $teachergrop4, array(
					'name'       => __( 'Fornt-color', 'univ' ),
					'desc'       => __( 'insert code here', 'univ' ),
					'id'  => $prefix . 'tfcolor',
					'type'    => 'colorpicker',
					'default' => '#F5B120',			
				) );
				$teacher->add_group_field( $teachergrop4, array(
					'name'       => __( 'backen-color', 'univ' ),
					'desc'       => __( 'insert code here', 'univ' ),
					'id'  => $prefix . 'tbackend',
					'type'    => 'colorpicker',
					'default' => '#f5f5f5',			
				) );





		//classes metabox
		
		$classes = new_cmb2_box( array(
			'id'            => $prefix . 'classesid',
			'title'         => __( 'Classes Option', 'univ' ),
			'object_types'  => array( 'univ_classes', ), // Post type
			'priority'   => 'high',
		) );
				$classes->add_field( array(
					'name'       => __( 'Duration', 'univ' ),
					'desc'       => __( 'insert duration here', 'univ' ),
					'id'         => $prefix . 'duration',
					'type'       => 'text',
				) );
				$classes->add_field( array(
					'name'       => __( 'Sit Available', 'univ' ),
					'desc'       => __( 'insert Sit here', 'univ' ),
					'id'         => $prefix . 'sit',
					'type'       => 'text',
				) );

			 // class info option
				$classes->add_field( array(
					'name'       => __( 'Info Class title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'infoclasstitle',
					'type'       => 'text',
				) );
			 $classesgropinfo = $classes->add_field( array(
			  'id'          => $prefix . 'infoclass',
			  'type'        => 'group',
			  'description' => __( 'Add Info class section', 'univ' ),
			  'options'     => array(
			   'group_title'   => __( 'Info Classes', 'univ' ), // {#} gets replaced by row number
			   'add_button'    => __( 'Add Classes', 'univ' ),
			   'remove_button' => __( 'Remove Icon', 'univ' ),
			   'sortable'      => true, // beta
			  ),
			 ) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Start Date:', 'univ' ),
					'desc'       => __( 'insert Start Date:', 'univ' ),
					'id'         => $prefix . 'stdate',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Years Old', 'univ' ),
					'desc'       => __( 'insert Years Old', 'univ' ),
					'id'  => $prefix . 'yold',
					'type' => 'text',		
				) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Class Size', 'univ' ),
					'desc'       => __( 'insert Class Size', 'univ' ),
					'id'         => $prefix . 'clsize',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Class Duratione', 'univ' ),
					'desc'       => __( 'insert Class Duration', 'univ' ),
					'id'         => $prefix . 'claduration',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Transportation', 'univ' ),
					'desc'       => __( 'insert Transportation', 'univ' ),
					'id'         => $prefix . 'transportation',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Morning Foods', 'univ' ),
					'desc'       => __( 'insert Morning Foods', 'univ' ),
					'id'         => $prefix . 'clmonigfood',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropinfo, array(
					'name'       => __( 'Class Starff', 'univ' ),
					'desc'       => __( 'insert Class Starff', 'univ' ),
					'id'         => $prefix . 'clasttaf',
					'type'       => 'text',
				) );

				
			 // class teacher option
			  // class info option
				$classes->add_field( array(
					'name'       => __( 'Class Teacher title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'classttitle',
					'type'       => 'text',
				) );
			 $classesgropt = $classes->add_field( array(
			  'id'          => $prefix . 'cteacher',
			  'type'        => 'group',
			  'description' => __( 'Add Teacher section', 'univ' ),
			  'options'     => array(
			   'group_title'   => __( 'Teacher {#}', 'univ' ), // {#} gets replaced by row number
			   'add_button'    => __( 'Add Teacher', 'univ' ),
			   'remove_button' => __( 'Remove Icon', 'univ' ),
			   'sortable'      => true, // beta
			  ),
			 ) );
				$classes->add_group_field( $classesgropt, array(
					'name'       => __( 'Title', 'univ' ),
					'desc'       => __( 'insert title', 'univ' ),
					'id'         => $prefix . 'ttitle',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropt, array(
					'name'       => __( 'Link', 'univ' ),
					'desc'       => __( 'insert link', 'univ' ),
					'id'  => $prefix . 'teacherurl',
					'type' => 'text_url',		
					'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				) );
				$classes->add_group_field( $classesgropt, array(
					'name'       => __( 'Designation', 'univ' ),
					'desc'       => __( 'insert E-time', 'univ' ),
					'id'         => $prefix . 'tdesig',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgropt, array(
					'name'       => __( 'Teacher Image', 'univ' ),
					'desc'       => __( 'insert image', 'univ' ),
					'id'         => $prefix . 'timage',
					'type'       => 'file',
				) );
				//contact-form-7	
				$classes->add_field( array(
					'name'       => __( 'Register Classes', 'univ' ),
					'desc'       => __( 'insert contact form shortcode here', 'univ' ),
					'id'         => $prefix . 'contract_form_s',
					'type'       => 'text',
				) );				
				//courcse title
				$classes->add_field( array(
					'name'       => __( 'Course title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'ctitle',
					'type'       => 'text',
				) );
				$classes->add_field( array(
					'name'       => __( 'Weekly Course Description', 'univ' ),
					'desc'       => __( 'insert Description here', 'univ' ),
					'id'         => $prefix . 'cdes',
					'type'       => 'textarea',
				) );			
				$classes->add_field( array(
					'name'       => __( 'Weekly Course Footer Description', 'univ' ),
					'desc'       => __( 'insert Footer Description here', 'univ' ),
					'id'         => $prefix . 'fcdes',
					'type'       => 'textarea',
				) );	
				// class single meta field
				$classesgrop = $classes->add_field( array(
					'id'          => $prefix . 'daygrop',
					'type'        => 'group',
					'description' => __( 'Add Day section', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'Day Name', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add day', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$classes->add_group_field( $classesgrop, array(
					'name'       => __( 'Day 1', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'day1',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop, array(
					'name'       => __( 'Day 2', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'day2',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop, array(
					'name'       => __( 'Day 3', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'day3',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop, array(
					'name'       => __( 'Day 4', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'day4',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop, array(
					'name'       => __( 'Day 5', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'day5',
					'type'       => 'text',
				) );	
				
				// class single meta field for time
				$classesgrop1 = $classes->add_field( array(
					'id'          => $prefix . 'timegrop',
					'type'        => 'group',
					'description' => __( 'Add weekly time section', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'Weekly Time', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add time', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Time 1', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'time1',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Week 1', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'week1',
					'type'       => 'text',
				) );
				
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Time 2', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'time2',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Week 2', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'week2',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Time 3', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'time3',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Week 3', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'week3',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Time 4', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'time4',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Week 4', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'week4',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Time 5', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'time5',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop1, array(
					'name'       => __( 'Week 5', 'univ' ),
					'desc'       => __( 'insert day', 'univ' ),
					'id'         => $prefix . 'week5',
					'type'       => 'text',
				) );		
				
				
			 // class single meta field every day time
				$classesgrop3 = $classes->add_field( array(
				  'id'          => $prefix . 'edaygrop',
				  'type'        => 'group',
				  'description' => __( 'Add Every Day Time section', 'univ' ),
				  'options'     => array(
				   'group_title'   => __( 'Everyday time {#}', 'univ' ), // {#} gets replaced by row number
				   'add_button'    => __( 'Add Everyday Time', 'univ' ),
				   'remove_button' => __( 'Remove Icon', 'univ' ),
				   'sortable'      => true, // beta
					),
				) );
				$classes->add_group_field( $classesgrop3, array(
					'name'       => __( 'E-time 1', 'univ' ),
					'desc'       => __( 'insert E-time', 'univ' ),
					'id'         => $prefix . 'etime1',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop3, array(
					'name'       => __( 'E-time 2', 'univ' ),
					'desc'       => __( 'insert E-time', 'univ' ),
					'id'         => $prefix . 'etime2',
					'type'       => 'text',
				) );
				$classes->add_group_field( $classesgrop3, array(
					'name'       => __( 'E-time 3', 'univ' ),
					'desc'       => __( 'insert E-time', 'univ' ),
					'id'         => $prefix . 'etime3',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop3, array(
					'name'       => __( 'E-time 4', 'univ' ),
					'desc'       => __( 'insert E-time', 'univ' ),
					'id'         => $prefix . 'etime4',
					'type'       => 'text',
				) );	
				$classes->add_group_field( $classesgrop3, array(
					'name'       => __( 'E-time 5', 'univ' ),
					'desc'       => __( 'insert E-time', 'univ' ),
					'id'         => $prefix . 'etime5',
					'type'       => 'text',
				) );	



		//end classes metabox


		//page metabox
		$page_breadcrumb = new_cmb2_box( array(
			'id'            => $prefix . 'pageid1',
			'title'         => __( 'Breadcumb Option', 'univ' ),
			'object_types'  => array( 'post','page' ), // Post type
			'priority'   => 'high',
		) );
		$page_breadcrumb->add_field( array(
			'name'    => 'Breadcrumb',
			'id'      => $prefix . 'breadcrumbs',
			'type'    => 'radio_inline',
			'options' => array(
				'0' => __( 'Show breadcrumb', 'univ' ),
				'1'   => __( 'Hide breadcrumb', 'univ' ),
			),
			'default' =>0,
		) );
		$page_breadcrumb->add_field(array(
			'name' => __( 'Breadcrumb Padding Top', 'univ' ),
			'id'   => $prefix .'bread_padding_top',
			'desc'  => __( 'Set padding ex-"100"', 'univ' ),		
			'type'  => 'text',
		) );
		$page_breadcrumb->add_field(array(
			'name' => __( 'Breadcrumb Padding Bottom', 'univ' ),
			'id'   => $prefix .'bread_padding_bottom',
			'desc'  => __( 'Set padding ex-"100"', 'univ' ),		
			'type'  => 'text',
		) );				
		$page_breadcrumb->add_field(array(
			'name' => __( 'Page Breadcrumb Image', 'univ' ),
			'id'   => $prefix .'pageimagess',
			'desc'       => __( 'insert image here', 'univ' ),		
			'type' => 'file',
		) );
		$page_breadcrumb->add_field(array(
			'name' => __( 'Page Background', 'univ' ),
			'id'   => $prefix .'page_background',
			'desc'  => __( 'Set background color', 'univ' ),		
			'type'  => 'colorpicker',
			'default' => '#dcdcdc',
		) );				
		$page_breadcrumb->add_field(array(
			'name' => __( 'Page Text Color', 'univ' ),
			'id'   => $prefix .'text_color_page',
			'desc'       => __( 'Set title color', 'univ' ),		
			 'type'    => 'colorpicker',
			'default' => '#5e5e5e',
		) );
		$page_breadcrumb->add_field(array(
			'name' => __( 'Current Page Text Color', 'univ' ),
			'id'   => $prefix .'current_color_page',
			'desc'       => __( 'Set Current color', 'univ' ),		
			 'type'    => 'colorpicker',
			'default' => '#686868',
		) );				
		$page_breadcrumb->add_field( array(
			'name'             => 'Text Align',
			'desc'             => 'Select an option',
			'id'   => $prefix .'page_text_align',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'center',
			'options'          => array(
				'left' => __( 'Align Left', 'univ' ),
				'center'   => __( 'Align Middle', 'univ' ),
				'right'     => __( 'Alige Right', 'univ' ),
			),
		) );
		$page_breadcrumb->add_field( array(
			'name'             => 'Text Transform',
			'desc'             => 'Select an option',
			'id'   => $prefix .'page_text_transform',
			'type'             => 'select',
			'show_option_none' => true,
			'default'          => 'uppercase',
			'options'          => array(
				'lowercase' => __( 'Transform lowercase', 'univ' ),
				'uppercase'   => __( 'Transform uppercase', 'univ' ),
				'capitalize'     => __( 'Transform capitalize', 'univ' ),
			),
		) );



		//===================================	
		//Teacher metabox
		//===================================
		$teacher = new_cmb2_box( array(
			'id'            => $prefix . 'teacher',
			'title'         => __( 'Teacher Option', 'univ' ),
			'object_types'  => array( 'univ_team', ), // Post type
			'priority'   => 'high',
		) );
				$teacher->add_field( array(
					'name'       => __( 'Sub Title', 'univ' ),
					'desc'       => __( 'insert title here', 'univ' ),
					'id'         => $prefix . 'tsubtitle',
					'type'       => 'text',
				) );	
				// $group_field_id is the field id string, so in this case: $prefix . 'univ'
				$teachergrop = $teacher->add_field( array(
					'id'          => $prefix . 'teacheridssssss',
					'type'        => 'group',
					'description' => __( 'Add Second Icon', 'univ' ),
					'options'     => array(
						'group_title'   => __( 'Social Icon {#}', 'univ' ), // {#} gets replaced by row number
						'add_button'    => __( 'Add Another Icon', 'univ' ),
						'remove_button' => __( 'Remove Icon', 'univ' ),
						'sortable'      => true, // beta
					),
				) );

				$teacher->add_group_field( $teachergrop, array(
					'name'       => __( 'Social Icon', 'univ' ),
					'desc'       => __( 'insert Icon', 'univ' ),
					'id'         => $prefix . 'tticon',
					'type'       => 'text',
				) );
				$teacher->add_group_field( $teachergrop, array(
					'name'       => __( 'Enter Link', 'univ' ),
					'desc'       => __( 'insert link here', 'univ' ),
					'id'  => $prefix . 'turl',
					'type' => 'text_url',					
				) );


		//end classes metabox
		
		$testimonial = new_cmb2_box( array(
			'id'            => $prefix . 'testimonial',
			'title'         => __( 'Testimonial Option', 'univ' ),
			'object_types'  => array( 'univ_testimonial', ), // Post type
			'priority'   => 'high',
		) );

				$testimonial->add_field( array(
					'name'       => __( 'Name', 'univ' ),
					'desc'       => __( 'insert name here', 'univ' ),
					'id'         => $prefix . 'name',
					'type'       => 'text',
				) );
				$testimonial->add_field( array(
					'name'       => __( 'Degree', 'univ' ),
					'desc'       => __( 'insert degree here', 'univ' ),
					'id'         => $prefix . 'degree',
					'type'       => 'text',
				) );
				$testimonial->add_field( array(
					'name'       => __( 'Batch Name', 'univ' ),
					'desc'       => __( 'insert batch name here', 'univ' ),
					'id'         => $prefix . 'batch_name',
					'type'       => 'text',
				) );





		//Event meta metabox
		$event = new_cmb2_box( array(
			'id'            => $prefix . 'event',
			'title'         => esc_html__( 'Event Option', 'univ' ),
			'object_types'  => array( 'univ_event', ), // Post type
			'priority'   => 'high',
		) );
		
			$event->add_field( array(
				'name'       => esc_html__( 'Event Date', 'univ' ),
				'desc'       => esc_html__( 'Event Date', 'univ' ),
				'id'         => $prefix . 'event_date',
				'type'       => 'text_date',
		        'date_format' => 'j M'
			) );
			$event->add_field( array(
				'name'       => esc_html__( 'Event Loaction', 'univ' ),
				'desc'       => esc_html__( 'Insert  loaction here', 'univ' ),
				'id'         => $prefix . 'loaction',
				'type'       => 'text',
			) );
			$event->add_field( array(
				'name'       => esc_html__( 'Time picker', 'univ' ),
				'desc'       => esc_html__( 'Event Time', 'univ' ),
				'id'         => $prefix . 'event_time',
				'type'       => 'text_time',
			) );

			$event->add_field( array(
				'name'       => esc_html__( 'Google Map API', 'univ' ),
				'desc'       => esc_html__( 'Instert google map api', 'univ' ),
				'id'         => $prefix . 'event_map',
				'type'       => 'text',
			) );
			$event->add_field( array(
				'name'       => esc_html__( 'Map lat', 'univ' ),
				'desc'       => esc_html__( 'Map lat ex:- 23.7612256', 'univ' ),
				'id'         => $prefix . 'event_map_lat',
				'type'       => 'text',
			) );
			$event->add_field( array(
				'name'       => esc_html__( 'Map Lng', 'univ' ),
				'desc'       => esc_html__( 'Map Lng ex:- 90.420766', 'univ' ),
				'id'         => $prefix . 'event_map_lng',
				'type'       => 'text',
			) );

	    // $group_field_id is the field id string, so in this case: $prefix . 'univ'
	    $eventgrop = $event->add_field( array(
	     'id'          => $prefix . 'event_info_group',
	     'type'        => 'group',
	     'description' => esc_html__( 'Add Second Icon', 'univ' ),
	     'options'     => array(
	      'group_title'   => esc_html__( 'Event Info {#}', 'univ' ), // {#} gets replaced by row number
	      'add_button'    => esc_html__( 'Add Another Info', 'univ' ),
	      'remove_button' => esc_html__( 'Remove Info', 'univ' ),
	      'sortable'      => true, // beta
	     ),
	    ) );

	    $event->add_group_field( $eventgrop, array(
	     'name'       => esc_html__( 'Event Info Name', 'univ' ),
	     'desc'       => esc_html__( 'insert info name', 'univ' ),
	     'id'         => $prefix .'event_info_name',
	     'type'       => 'text',
	    ) );
	    $event->add_group_field( $eventgrop, array(
	     'name'       => esc_html__( 'Event Info', 'univ' ),
	     'desc'       => esc_html__( 'insert event info', 'univ' ),
	     'id'  => $prefix .'event_info',
	     'type' => 'text',     
	    ) );
	  //end classes metabox

		
		
	}
}


