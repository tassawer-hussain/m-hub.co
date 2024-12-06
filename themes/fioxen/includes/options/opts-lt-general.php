<?php
$header_options = array();

if(class_exists('GVA_Layout_Model')){
	$headers = GVA_Layout_Model::getInstance()->get_templates('header_layout', 'title');
	foreach ($headers as $key => $item) {
		$header_options[$item['id']] = $item['title'];
	}
}

Redux::setSection( $opt_name, array(
	'title' => esc_html__('Listings General', 'fioxen'),
	'desc' => '',
	'icon' => 'el-icon-wrench',
	'fields' => array(
		array(
			'id'        => 'lt_business_hours',
			'type'      => 'select',
			'title'     => esc_html__('Business Hours Group', 'fioxen'),
			'options'   => array(
				'enable'         => esc_html__('Enable', 'fioxen'),
				'disable'        => esc_html__('Disable', 'fioxen'),
			),
			'default' => 'enable'
		),
		array(
			'id'        => 'lt_default_business_hours',
			'type'      => 'select',
			'title'     => esc_html__('Status Open/Close when unset Business Hours', 'fioxen'),
			'desc'      => '',
			'options'   => array(
				'open_day'      => esc_html__('Open', 'fioxen'),
				'close_day'     => esc_html__('Closed', 'fioxen'),
				'hidden'        => esc_html__('Hidden Status', 'fioxen')
			),
			'default' => 'open'
		),
		array(
		  	'id'  	=> 'lt-rating-options',
		  	'type'  	=> 'info',
		  	'raw' 	=> '<h3 style="margin: 0;">' . esc_html__( 'Listing Rating Option', 'fioxen' ) . '</h3>'
		),
		array(
		  'id'            => 'lt_reviews',
		  'type'          => 'multi_text',
		  'title'         => esc_html__('Listing Review Item / Title[key]', 'fioxen'),
		  'subtitle'      => esc_html__('Example: Quality[quality], Format: Title[key]', 'fioxen'),
		  'default'       => array('Quality[quality]', 'Hospitality[hospitality]', 'Service[service]', 'Pricing[price]')
		),
		array(
			'id'        => 'lt_review_allow_owner',
			'type'      => 'select',
			'title'     => esc_html__('Allow listing owner review', 'fioxen'),
			'desc'      => esc_html__('Allow listing owners to review their own listings.', 'fioxen'),
			'options'   => array(
				'enable'         => esc_html__('Enable', 'fioxen'),
				'disable'        => esc_html__('Disable', 'fioxen'),
			),
			'default' => 'enable'
		),
		array(
			'id'        => 'lt_show_rating',
			'type'      => 'select',
			'title'     => esc_html__('Show Rating Default', 'fioxen'),
			'options'   => array(
			  	''      		=> esc_html__( 'Hidden', 'fioxen' ),
				'star'  		=> esc_html__( 'Star', 'fioxen' ),
				'number'  	=> esc_html__( 'Number', 'fioxen' )
			),
			'default' => 'star'
		),

		array(
		  	'id'  	=> 'lt-currency-options',
		  	'type'  	=> 'info',
		  	'raw' 	=> '<h3 style="margin: 0;">' . esc_html__( 'Listing Currency', 'fioxen' ) . '</h3>'
		),
		array(
			'id'        => 'lt_currency_symbol',
			'type'      => 'text',
			'title'     => esc_html__('Currency Symbol', 'fioxen'),
			'default' => '$'
		),
		array(
			'id'        => 'lt_enable_paid',
			'type'      => 'select',
			'title'     => esc_html__('Listing Package', 'fioxen'),
			'options'   => array(
				'enable'         => esc_html__('Enable', 'fioxen'),
				'disable'        => esc_html__('Disable', 'fioxen'),
			),
			'default' => 'enable'
		),
		array(
		  	'id'  	=> 'lt-single-options',
		  	'type'  	=> 'info',
		  	'raw' 	=> '<h3 style="margin: 0;">' . esc_html__( 'Listing Single Page', 'fioxen' ) . '</h3>'
		),
		array(
         'id'        => 'lt_single_contact_form',
         'type'      => 'text',
         'title'     => esc_html__('Contact Form ID', 'fioxen'),
         'default' => '1415'
      ),
	)
));