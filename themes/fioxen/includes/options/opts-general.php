<?php
Redux::setSection( $opt_name, array(
	'title' => esc_html__('General Options', 'fioxen'),
	'icon' => 'el-icon-wrench',
	'fields' => array(
      array(
        'id'      => 'header_settings',
        'type'    => 'info',
        'raw'     => '<h3 class="margin-bottom-0">' . esc_html__('Header settings', 'fioxen') . '</h3>'
      ),
      array(
        'id'      => 'header_logo', 
        'type'    => 'media',
        'url'     => true,
        'title'   => esc_html__('Logo in header default', 'fioxen'), 
        'default' => ''
      ),  
      array(
        'id'      => 'footer_settings',
        'type'    => 'info',
        'raw'     => '<h3 class="margin-bottom-0">' . esc_html__('Footer settings', 'fioxen') . '</h3>'
      ),
      array(
         'id'        => 'copyright_default',
         'type'      => 'button_set',
         'title'     => esc_html__('Enable/Disable Copyright Text', 'fioxen'),
         'options'   => array(
            'yes'    => esc_html__('Enable', 'fioxen'),
            'no'     => esc_html__('Disable', 'fioxen')
         ),
         'default'   => 'yes'
      ),
      array(
         'id'        => 'copyright_text',
         'type'      => 'editor',
         'title'     => esc_html__('Footer Copyright Text', 'fioxen'),
         'default'   => esc_html__('Copyright - 2022 - Company - All rights reserved. Powered by WordPress.', 'fioxen')
      ),
      array(
        'id'      => 'page_layout_settings',
        'type'    => 'info',
        'raw'     => '<h3 class="margin-bottom-0">' . esc_html__('Page Layout', 'fioxen') . '</h3>'
      ),
		array(
			'id'           => 'page_layout',
			'type'         => 'button_set',
			'title'        => esc_html__('Page Layout', 'fioxen'),
			'subtitle'     => esc_html__('Select the page layout type', 'fioxen'),
			'options'      => array(
				'boxed'     => esc_html__('Boxed', 'fioxen'),
				'fullwidth' => esc_html__('Fullwidth', 'fioxen')
			),
			'default' => 'fullwidth'
		),
      

		// Breadcrumb Default Settings
		array(
         'id'     => 'breadcrumb_default',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="margin-bottom-0">' . esc_html__('Breadcrumb Settings Without Elementor', 'fioxen') . '</h3>',
      ),
		array(
         'id'        => 'breadcrumb_title',
         'type'      => 'button_set',
         'title'     => esc_html__('Breadcrumb Title', 'fioxen'),
         'options'   => array(
            1 => esc_html__('Enable', 'fioxen'),
            0 => esc_html__('Disable', 'fioxen')
         ),
         'default'   => 1
      ),
      array(
         'id'        => 'breadcrumb_padding_top',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Padding Top', 'fioxen'),
         'default'   => 120,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_padding_bottom',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Padding Top', 'fioxen'),
         'default'   => 120,
         'min'       => 50,
         'max'       => 500,
         'step'      => 1,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_bg_color',
         'type'      => 'color',
         'title'     => esc_html__('Background Overlay Color', 'fioxen'),
         'default'   => ''
      ),
      array(
         'id'        => 'breadcrumb_bg_opacity',
         'type'      => 'slider',
         'title'     => esc_html__('Breadcrumb Ovelay Color Opacity', 'fioxen'),
         'default'   => 50,
         'min'       => 0,
         'max'       => 100,
         'step'      => 2,
         'display_value' => 'text',
      ),
      array(
         'id'        => 'breadcrumb_bg_image',
         'type'      => 'media',
         'url'       => true,
         'title'     => esc_html__('Breadcrumb Background Image', 'fioxen'),
         'default'   => '',
         'required'  => array('woo_breadcrumb_bg', '=', 1 )
      ),
      array(
         'id'        => 'breadcrumb_text_stype',
         'type'      => 'select',
         'title'     => esc_html__('Breadcrumb Text Stype', 'fioxen'),
         'options'   => 
         array(
            'text-light'     => esc_html__('Light', 'fioxen'),
            'text-dark'      => esc_html__('Dark', 'fioxen')
         ),
         'default' => 'text-light'
      )
	)
));