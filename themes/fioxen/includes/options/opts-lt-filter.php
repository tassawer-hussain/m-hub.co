<?php
Redux::setSection( $opt_name, array(
	'title' => esc_html__('Listings Filter', 'fioxen'),
	'icon' => 'el-icon-wrench',
	'fields' => array(
		array(
         'id'        => 'lt_filter_sort_fields',
         'type'      => 'sorter',
         'title'     => esc_html__( 'Filter Fields', 'fioxen' ),
         'options'   => array(
            'enabled' => array(
            	'keywords' 		    => esc_html__('Keywords', 'fioxen'),
              //'keywords_title'  => esc_html__('Keywords Title', 'fioxen'),
            	'category' 		    => esc_html__('Category', 'fioxen'),
              'regions'         => esc_html__('Regions', 'fioxen'),
            	'types' 		      => esc_html__('Types', 'fioxen'),
            	'location' 		    => esc_html__('Location', 'fioxen'),
            	'distance' 		    => esc_html__('Distance', 'fioxen'),
            	'price_range' 	  => esc_html__('Price Range', 'fioxen'),
            	'amenities' 	    => esc_html__('Amenities', 'fioxen')
            ),
            'disabled' => array()
         )
      ),
		array(
	      'id'        => 'lt_distance',
	      'type'      => 'slider',
	      'title'     => esc_html__( 'Radius Around Distance Default', 'fioxen' ),
	      'default'   => 60,
	      'min'       => 5,
	      'max'       => 500,
	      'step'      => 1,
	      'display_value' => 'text',
	   ),
	   array(
		  	'id'         => 'lt_distance_unit',
		  	'type'       => 'select',
		  	'title'      => esc_html__('Distance Unit', 'fioxen'),
		  	'options'    => array(
			  	'km'      => esc_html__('Kilometre', 'fioxen'),
			  	'miles'   => esc_html__('Miles', 'fioxen'),
			),
		  	'default'  => 'km'
		),
		array(
        	'id'       => 'lt_show_amenities',
        	'type'     => 'button_set',
        	'title'    => esc_html__('Show Amenities', 'fioxen'),
        	'desc'     => '',
        	'options' => array(
        		'show' => esc_html__('Show', 'fioxen'),
        		'hide' => esc_html__('Hide', 'fioxen')
        	),
        	'default' => 'hide'
      ),
	)
));