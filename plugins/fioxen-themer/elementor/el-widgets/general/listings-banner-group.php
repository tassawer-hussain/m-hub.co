<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Icons_Manager;

class GVAElement_Listings_Banner_Group extends GVAElement_Base{
	const NAME = 'gva-listings-banner-group';
	const TEMPLATE = 'general/banner-group/';
	const CATEGORY = 'fioxen_general';

	public function get_name() {
		return self::NAME;
	}
	
	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_title() {
		return __('Listing Banners Group', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'listings', 'banner', 'content', 'group', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'fioxen-themer'),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
				  'style-1' => esc_html__('Style I', 'fioxen-themer'),
				  'style-2' => esc_html__('Style II', 'fioxen-themer'),
				  'style-3' => esc_html__('Style III', 'fioxen-themer')
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'taxonomy',
			[
				'label' => __( 'Style', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => [
				  'job_listing_region' => esc_html__('Listing Region Taxonomy', 'fioxen-themer'),
				  'job_listing_category' => esc_html__('Listing Category Taxonomy', 'fioxen-themer'),
				],
				'default' => 'job_listing_region',
			]
		);
		$repeater = new Repeater();
		
		$repeater->add_control(
			'sub_title',
		  [
			 'label'       => __('Sub Title', 'fioxen-themer'),
			 'type'        => Controls_Manager::TEXT,
			 'placeholder' => esc_html__( 'Add your Sub-Title', 'fioxen-themer' ),
			 'default'     => esc_html__('Places in', 'fioxen-themer'),
		  ]
		);
		$repeater->add_control(
			'title',
		  [
			 'label'       => __('Title', 'fioxen-themer'),
			 'type'        => Controls_Manager::TEXT,
			 'placeholder' => esc_html__( 'Add your Title', 'fioxen-themer' ),
			 'default'     => 'London',
		  ]
		);
		$repeater->add_control(
			'icon',
		  	[
			 	'label'       => __('Icon (Option for style II)', 'fioxen-themer'),
			 	'type'        => Controls_Manager::ICONS,
			 	'default' => [
					'value' => 'flaticon-gift-box',
					'library' => 'fa-solid',
				],
		  	]
		);
		$repeater->add_control(
			'term_slug',
		  [
			 'label'     => __( 'Taxonomy Slug', 'fioxen-themer' ),
			 'type'      => Controls_Manager::TEXT,
			 'placeholder' => __( 'Add term slug here', 'fioxen-themer' ),
		  ]
		);
		$repeater->add_control(
			'custom_link',
		  [
			 'label'       => __('Custom Link', 'fioxen-themer'),
			 'type'        => Controls_Manager::URL,
			 'placeholder' => esc_html__( 'Add Your Custom Link', 'fioxen-themer' ),
		  ]
		);
		$repeater->add_control(
			'image',
		  [
			 'label'      => __('Choose Image', 'fioxen-themer'),
			 'default'    => [
				  'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/banner-1.jpg',
			 ],
			 'dynamic' => [
				'active' => true,
			 ],
			 'type'       => Controls_Manager::MEDIA,
			 'show_label' => false,
		  ]
		);

		$repeater->add_control(
			'item_active',
			[
				'label'   => __( 'Active', 'fioxen-themer' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		 $this->add_control(
			 'content_banners',
			 [
				'label'       => __('Listings Banner Content', 'fioxen-themer'),
				'type'        => Controls_Manager::REPEATER,
				 'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
				  array(
						'sub_title'  	=> esc_html__( 'Places in', 'fioxen-themer' ),
						'title'  		=> esc_html__( 'London', 'fioxen-themer' ),
						'image'			=> ['url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/banner-1.jpg']
				  ),
				  array(
						'sub_title'  	=> esc_html__( 'Enjoy in', 'fioxen-themer' ),
						'title'       => esc_html__( 'Dubai', 'fioxen-themer' ),
						'image'			=> ['url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/banner-2.jpg']
				  ),
				  array(
						'sub_title'  	=> esc_html__( 'Travel to', 'fioxen-themer' ),
						'title'  		=> esc_html__( 'Turkey', 'fioxen-themer' ),
						'image'			=> ['url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/banner-3.jpg']
				  ),
				  array(
						'sub_title'  	=> esc_html__( 'Eat in', 'fioxen-themer' ),
						'title'  		=> esc_html__( 'New York', 'fioxen-themer' ),
						'image'			=> ['url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/banner-4.jpg']
				  ),
				)
			 ]
		  );
		  $this->add_control( // xx Layout
				'layout_heading',
				[
					 'label'   => __( 'Layout', 'fioxen-themer' ),
					 'type'    => Controls_Manager::HEADING,
				]
		  );
			$this->add_control(
				'layout',
				[
					 'label'   => __( 'Layout Display', 'fioxen-themer' ),
					 'type'    => Controls_Manager::SELECT,
					 'default' => 'carousel',
					 'options' => [
						  'grid'      => __( 'Grid', 'fioxen-themer' ),
						  'carousel'  => __( 'Carousel', 'fioxen-themer' ),
					 ]
				]
		  );

		  $this->add_control(
			 'show_number_content',
			 [
				'label'   => __( 'Show number content', 'fioxen-themer' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			 ]
		  );
  
		  
		  $this->add_control(
				'image_size',
				[
					'label'     => __('Image Size', 'fioxen-themer'),
					'type'      => \Elementor\Controls_Manager::SELECT,
					'options'   => $this->get_thumbnail_size(),
					'default'   => 'full'
				]
			);
		  $this->add_control(
			 'view',
			 [
				'label'   => __('View', 'fioxen-themer'),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			 ]
		  );

		  $this->end_controls_section();

		  $this->add_control_carousel(false, array('layout' => 'carousel'));

		  $this->add_control_grid(array('layout' => 'grid'));

		  // Icon Styling
		  $this->start_controls_section(
			 'section_style_icon',
			 [
				'label' => __( 'Icon', 'fioxen-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			 ]
		  );

		  $this->add_control(
			 'icon_color',
			 [
				'label' => __( 'Icon Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .box-icon i' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content svg' => 'fill: {{VALUE}};'
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_size',
			 [
				'label' => __( 'Size', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 60
				],
				'range' => [
				  'px' => [
					 'min' => 20,
					 'max' => 80,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .box-icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			 ]
		  );

		  $this->add_responsive_control(
			 'icon_space',
			 [
				'label' => __( 'Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
				  'size' => 0,
				],
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 50,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .icon-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			 ]
		  );

	  	$this->add_responsive_control(
		 	'icon_padding',
		 	[
				'label' => __( 'Padding', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
				  	'{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
		 	]
	  	);

		$this->end_controls_section();

	  	$this->start_controls_section(
		 	'section_style_content',
		 	[
				'label' => __( 'Content', 'fioxen-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
		 	]
	  	);

	  	$this->add_control(
		 	'heading_title',
		 	[
				'label' => __( 'Title', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		 	]
	  	);

	  	$this->add_responsive_control(
		 	'title_bottom_space',
		 	[
				'label' => __( 'Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 	'min' => 0,
					 	'max' => 100,
				  	],
				],
				'default' => [
				  'size'  => 5
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				]
		 	]
	  	); 

	  	$this->add_control(
		 	'title_color',
		 	[
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title a' => 'color: {{VALUE}};',
				]
		 	]
	  	);

	  	$this->add_group_control(
		 	Group_Control_Typography::get_type(),
		 	[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title, {{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title a',
		 	]
	  	);

	  	$this->add_control(
		 	'heading_description',
		 	[
				'label' => __( 'Description', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
				  'style' => ['style-2'],
				]
		 	]
	  	);

	  	$this->add_control(
		 	'description_color',
		 	[
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
				  'style' => ['style-2']
				]
		 	]
	  	);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content',
				'condition' => [
				  'style' => ['style-2'],
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
			if( !empty($settings['layout']) ){
				include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
			}
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Listings_Banner_Group());
