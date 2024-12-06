<?php
	Redux::setSection( $opt_name, array(
		'title' => esc_html__('Listings Archives', 'fioxen'),
		'desc' => '',
		'icon' => 'el-icon-wrench',
		'fields' => array(
			array(
				'id'        => 'lt_layout_page',
				'type'      => 'select',
				'title'     => esc_html__('Layout Page', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  'half_map'            => esc_html__('Half Map', 'fioxen'),
				  'filters_left'        => esc_html__('Filters Left', 'fioxen'),
				  'filters_right'       => esc_html__('Filters Right', 'fioxen'),
				  'filters_hidden'       => esc_html__('Hidden Filters', 'fioxen')
				),
				'default' => 'filters_left'
			),
			array(
				'id'        => 'lt_show_map_top',
				'type'      => 'select',
				'title'     => esc_html__('Show Map Top Page', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  'disable'             => esc_html__('Disable Map', 'fioxen'),
				  'container'           => esc_html__('Container', 'fioxen'),
				  'contain-fw'          => esc_html__('Full Width', 'fioxen'),
				),
				'default' => 'disable'
			),
			array(
				'id'        => 'lt_layout_item',
				'type'      => 'select',
				'title'     => esc_html__('Layout Item', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  'item-grid-1'       => esc_html__('Grid', 'fioxen'),
				  'item-grid-4'       => esc_html__('Grid 02', 'fioxen'),
				  'item-list'       => esc_html__('List', 'fioxen'),
				),
				'default' => 'item-grid-1'
			),
			array(
				'id'        => 'lt_grid_columns_lg',
				'type'      => 'select',
				'title'     => esc_html__('Grid columns large screen', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen')
				),
				'default' => '3'
			),
			array(
				'id'        => 'lt_grid_columns_md',
				'type'      => 'select',
				'title'     => esc_html__('Grid columns medium screen', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen')
				),
				'default' => '3'
			),
			array(
				'id'        => 'lt_grid_columns_sm',
				'type'      => 'select',
				'title'     => esc_html__('Grid columns small screen', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen')
				),
				'default' => '2'
			),
			array(
				'id'        => 'lt_grid_columns_xs',
				'type'      => 'select',
				'title'     => esc_html__('Grid columns extra small screen', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  '1'               	=> esc_html__('1 Column', 'fioxen'),
				  '2'                => esc_html__('2 Columns', 'fioxen'),
				  '3'        	  		=> esc_html__('3 Columns', 'fioxen'),
				  '4'       			=> esc_html__('4 Columns', 'fioxen'),
				  '5'       			=> esc_html__('5 Columns', 'fioxen'),
				  '6'       			=> esc_html__('6 Columns', 'fioxen')
				),
				'default' => '1'
			),
			array(
				'id'        => 'lt_pagination_style',
				'type'      => 'select',
				'title'     => esc_html__('Pagination Style', 'fioxen'),
				'desc'      => '',
				'options'   => array(
				  'load_more'        => esc_html__('Load More', 'fioxen'),
				  'paginate'         => esc_html__('Paginate', 'fioxen')
				),
				'default' => 'load_more'
			)
		)
	));