<?php
	Redux::setSection( $opt_name, array(
		'title' 	=> esc_html__('Listings Map', 'fioxen'),
		'icon' 	=> 'el-icon-wrench',
		'fields' => array(
			array(
				'id'        => 'lt_map_source',
				'type'      => 'select',
				'title'     => esc_html__('Map Source', 'fioxen'),
				'desc'      => '',
				'options'   => array(
					'mapbox'         => 'Mapbox (mapbox.com)',
					'google'         => 'Google (google.com)',
					'openstreetmap'  => 'Open Street Map'
				),
				'default' => 'mapbox'
			),
			array(
			  'id'         => 'lt_default_latitude',
			  'type'       => 'text',
			  'title'      => esc_html__('Default Latitude', 'fioxen'),
			  'default'    => '40.6783499',
			),
			array(
			  'id'         => 'lt_default_longitude',
			  'type'       => 'text',
			  'title'      => esc_html__('Default Longitude', 'fioxen'),
			  'default'       => '-73.9495439',
			),
			array(
				'id'        => 'lt_map_zoom',
				'type'      => 'slider',
				'title'     => esc_html__('Map Zoom', 'fioxen'),
				'default'   => 14,
				'min'       => 2,
				'max'       => 18,
				'step'      => 1,
				'display_value' => 'text'
			),
			array(
			  	'id'         => 'listing_goolge_info',
			  	'type'       => 'info',
			  	'icon'       => true,
			  	'raw'        => '<h3 style="margin: 0;">' . esc_html__( 'Google Map Settings', 'fioxen' ) . '</h3>',
			  	'required'  	=> array( 'lt_map_source', '=', 'google' )
			),
			array(
           	'id' => 'map_api_key',
           	'type' => 'text',
           	'title' => esc_html__('Google Map API key', 'fioxen'),
           	'required'  	=> array( 'lt_map_source', '=', 'google' )
         ),
			array(
			  	'id'         => 'lt_google_map_style',
			  	'type'       => 'textarea',
			  	'title'      => esc_html__('Google Map Style', 'fioxen'),
			  	'desc'		 => sprintf(esc_html__('<a href="%s">Get Custom Style</a> and paste it below. If there is nothing added, we will fallback to the Google Maps service.', 'fioxen'), 'https://snazzymaps.com/'),
			  	'required'  	=> array( 'lt_map_source', '=', 'google' )
			),
			array(
			  	'id'         => 'listing_mapbox_info',
			  	'type'       => 'info',
			  	'icon'       => true,
			  	'raw'        => '<h3 style="margin: 0;">' . esc_html__( 'Map Box Settings', 'fioxen' ) . '</h3>',
			  	'required'  	=> array( 'lt_map_source', '=', 'mapbox' )
			),
			array(
			  	'id'         => 'lt_mapbox_token',
			  	'type'       => 'text',
			  	'title'      => esc_html__('Mapbox Access Token', 'fioxen'),
			  	'desc'		 => sprintf(esc_html__('Access Token key of <a href="%s">Mapbox</a> service.', 'fioxen'), 'https://www.mapbox.com/'),
			  	'required'  	=> array( 'lt_map_source', '=', 'mapbox' )
			),
			array(
			  	'id'         => 'lt_mapbox_style',
			  	'type'       => 'select',
			  	'title'      => esc_html__('Mapbox style', 'fioxen'),
			  	'options'    => array(
				  	'streets-v8' => 'streets-v8',
				  	'streets-v9' => 'streets-v9',
				  	'streets-v10' => 'streets-v10',
				  	'streets-v11' => 'streets-v11'
				),
			  	'default'  => 'streets-v11',
			  	'required'  	=> array( 'lt_map_source', '=', 'mapbox' )
			),
		)
	));