<?php
function fioxen_register_meta_boxes(){
	$prefix = 'fioxen_';
	global $meta_boxes;
	$meta_boxes = array();

	/* ====== Metabox Template ====== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_page',
		'title' => esc_html__('Page Meta', 'fioxen'),
		'pages' => array( 'gva__template'),
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => esc_html__('Template Type', 'fioxen'),
				'id'   => "gva_template_type",
				'type' => 'text'
			),
		)
	);

	/* ====== Metabox Page ====== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_page',
		'title' => esc_html__('Page Meta', 'fioxen'),
		'pages' => array( 'page'),
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => esc_html__('Layout Page', 'fioxen'),
				'id'   => "{$prefix}template_layout",
				'type' => 'select',
				'options' => fioxen_get_page_layout(),
				'desc' => esc_html__('Use "_Default Page Content" when create page content default without Elementor Page Builder', 'fioxen'),
				'multiple' => false,
				'std'  => '',
			),
			array(
				'name' => esc_html__('Extra page class', 'fioxen'),
				'id' => $prefix . 'extra_page_class',
				'desc' => esc_html__("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'fioxen'),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
		)
	);

	/* ====== Metabox Page Title ====== */
	$meta_boxes[] = array(
		'id' => 'gavias_metaboxes_page_heading',
		'title' => esc_html__('Page Title & Breadcrumb', 'fioxen'),
		'pages' => array( 'post', 'page', 'product', 'portfolio', 'tribe_events'),
		'context' => 'normal',
		'priority'   => 'high',
		'fields' => array(
		  	array(
				'name' => esc_html__('Remove Title of Page', 'fioxen'),   
				'id'   => "{$prefix}disable_page_title",
				'type' => 'switch',
				'std'  => 0,
		  	),
		  	array(
			 	'name' => esc_html__('Disable Breadcrumbs', 'fioxen'),
			 	'id'   => "{$prefix}no_breadcrumbs",
			 	'type' => 'switch',
			 	'desc' => esc_html__('Disable the breadcrumbs from under the page title on this page.', 'fioxen'),
			 	'std' => 0,
		  	),
		  	array(
			 	'name' => esc_html__('Breadcrumb Layout', 'fioxen'),
			 	'id'   => "{$prefix}breadcrumb_layout",
			 	'type' => 'select',
			 	'options' => array(
				 	'layout_options'    => esc_html__('Default Options in Layout Template', 'fioxen'),
				 	'page_options'      => esc_html__('Individuals Options This Page', 'fioxen')
			 	),
			 	'multiple' => false,
			 	'std'  => 'theme_options',
			 	'desc' => esc_html__('You can use breadcrumb settings default in Layout Template or individuals this page', 'fioxen')
		  	),
		  	array(
			 	'name' 	=> esc_html__( 'Background Overlay Color', 'fioxen' ),
			 	'id'   	=> "{$prefix}breacrumb_bg_color",
			 	'desc' 	=> esc_html__( "Set an overlay color for hero heading image.", 'fioxen' ),
			 	'type' 	=> 'color',
			 	'class' => 'breadcrumb_setting',
			 	'std'  	=> '',
		  	),
		  	array(
			 	'name'       => esc_html__( 'Overlay Opacity', 'fioxen' ),
			 	'id'         => "{$prefix}breacrumb_bg_opacity",
			 	'desc'       => esc_html__( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'fioxen' ),
			 	'clone'      => false,
			 	'type'       => 'slider',
			 	'prefix'     => '',
			 	'class'   	  => 'breadcrumb_setting',
			 	'js_options' => array(
				  	'min'  => 0,
				  	'max'  => 100,
				  	'step' => 1,
			 	),
			 	'std'   => '50'
		  	),
		  	array(
			 	'name'  	=> esc_html__('Breadcrumb Background Image', 'fioxen'),
			 	'id'    	=> "{$prefix}breacrumb_image",
			 	'type'  	=> 'image_advanced',
			 	'class'   	=> 'breadcrumb_setting',
			 	'max_file_uploads' => 1
		  	),
		)
	);

	/* ====== Metabox Listing ====== */
	$meta_boxes[] = array(
	 	'id'    => 'metaboxes_listings_images',
	 	'title' => esc_html__('Logo & Banner Image', 'fioxen'),
	 	'post_types' => array( 'job_listing' ),
	 	'context'	=> 'side',
	 	'priority'	=> 'low',
	 	'fields' => array(
			array (
			  'name'   		=> esc_html__('Logo Image', 'fioxen'),
			  'id'    		=> "_lt_logo_image",
			  'type'       => 'single_image',
			),
			array (
			  'name'   		=> esc_html__('Banner Image', 'fioxen'),
			  'id'    		=> "_lt_banner_image",
			  'type'       => 'single_image',
			),
	 	)
  	);

	/* ====== Metabox Listing ====== */
	$meta_boxes[] = array(
	 	'id'    => 'metaboxes_listings_layout',
	 	'title' => esc_html__('Layout Demo', 'fioxen'),
	 	'post_types' => array( 'job_listing' ),
	 	'context'	=> 'side',
	 	'priority'	=> 'low',
	 	'fields' => array(
			array(
				'name' => esc_html__('Layout Single Listing', 'fioxen'),
				'id'   => "{$prefix}template_layout",
				'type' => 'select',
				'options' => fioxen_get_single_listing_layout(),
				'multiple' => false,
				'std'  => '',
			),
	 	)
  	);
  	

  	/* Listing Page Box Page
	================================================== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_listings_page',
		'title' => esc_html__('Listings Page Options', 'fioxen'),
		'pages' => array('page'),
		'priority'   => 'high',
		'fields' => array(

			// SIDEBAR CONFIG
			array(
				'name' => esc_html__('Layout Listings Page', 'fioxen'),
				'id'   => "{$prefix}lt_layout_page",
				'type' => 'select',
				'options' => array(
				  ''                   	=> esc_html__('--Default--', 'fioxen'),
				  'half_map'        	  	=> esc_html__('Half Map', 'fioxen'),
				  'half_map_2'    		=> esc_html__('Half Map II', 'fioxen'),
				  'filters_left'       	=> esc_html__('Sidebar Filters Left', 'fioxen'),
				  'filters_right'       => esc_html__('Sidebar Filters Right', 'fioxen'),
				  'filters_hidden'		=> esc_html__('Hidden Filters', 'fioxen'),
				  'full_map'				=> esc_html__( 'Full Map', 'fioxen' )
				),
				'class'	=> 'setting-lt_layout_page',
				'multiple' => false,
			),

			array(
				'name' => esc_html__('Show Map Top Page', 'fioxen'),
				'id'   => "{$prefix}lt_show_map_top",
				'type' => 'select',
				'options' => array(
				  ''                   	=> esc_html__('--Default--', 'fioxen'),
				  'disable'             => esc_html__('Disable Map', 'fioxen'),
				  'container'           => esc_html__('Container', 'fioxen'),
				  'contain-fw'          => esc_html__('Full Width', 'fioxen'),
				),
				'class'	=> 'setting-lt_show_map_top',
				'default'  => 'container',
				'multiple' => false,
			),

			array(
				'name' => esc_html__('Layout Item', 'fioxen'),
				'id'   => "{$prefix}lt_layout_item",
				'type' => 'select',
				'options' => array(
				  ''                   	=> esc_html__('--Default--', 'fioxen'),
				  'item-grid-1'        	=> esc_html__('Grid', 'fioxen'),
				  'item-list'       		=> esc_html__('List', 'fioxen'),
				),
				'multiple' => false,
			),

			array(
				'name' 		=> esc_html__('Per Page', 'fioxen'),
				'id'   		=> "{$prefix}lt_per_page",
				'type' 		=> 'number',
				'std'			=> 12
			),
			
			array(
				'name' => esc_html__('Show Rating', 'fioxen'),
				'id'   => "{$prefix}lt_show_rating",
				'type' => 'select',
				'options' => array(
				  	''      		=> esc_html__( 'Hidden', 'fioxen' ),
					'star'  		=> esc_html__( 'Star', 'fioxen' ),
					'number'  	=> esc_html__( 'Number', 'fioxen' )
				),
			),

			array(
				'name' => esc_html__('Show Tagline', 'fioxen'),
				'id'   => "{$prefix}lt_show_tagline",
				'type' => 'select',
				'options' => array(
				  	'yes'     	=> esc_html__( 'Yes', 'fioxen' ),
					'no'  		=> esc_html__( 'no', 'fioxen' )
				),
			),
			
			array(
				'name' => esc_html__('Grid columns large screen', 'fioxen'),
				'id'   => "{$prefix}lt_grid_columns_lg",
				'type' => 'select',
				'options' => array(
					''                => esc_html__('--Default--', 'fioxen'),
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen'),
				),
				'std' => '3',
				'class'   => 'grid_setting'
			),

			array(
				'name' => esc_html__('Grid columns medium screen', 'fioxen'),
				'id'   => "{$prefix}lt_grid_columns_md",
				'type' => 'select',
				'options' => array(
					''                => esc_html__('--Default--', 'fioxen'),
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen'),
				),
				'std' => '3',
				'class'   => 'grid_setting'
			),

			array(
				'name' => esc_html__('Grid columns small screen', 'fioxen'),
				'id'   => "{$prefix}lt_grid_columns_sm",
				'type' => 'select',
				'options' => array(
					''                => esc_html__('--Default--', 'fioxen'),
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen'),
				),
				'std' => '2',
				'class'   => 'grid_setting'
			),

			array(
				'name' => esc_html__('Grid columns extra small screen', 'fioxen'),
				'id'   => "{$prefix}lt_grid_columns_xs",
				'type' => 'select',
				'options' => array(
					''                => esc_html__('--Default--', 'fioxen'),
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen'),
				),
				'std' => '2',
				'class'   => 'grid_setting'
			),

			array(
				'name' => esc_html__('Pagination Style', 'fioxen'), 
				'id'   => "{$prefix}lt_pagination_style",
				'type' => 'select',
				'options' => array(
					''                => esc_html__('--Default--', 'fioxen'),
				  'load_more'        => esc_html__('Load More', 'fioxen'),
				  'paginate'         => esc_html__('Paginate', 'fioxen')
				),
				'multiple' => false,
			),
		)
	);

	return $meta_boxes;
 }  
  /********************* META BOX REGISTERING ***********************/
  add_filter( 'rwmb_meta_boxes', 'fioxen_register_meta_boxes' , 99 );

