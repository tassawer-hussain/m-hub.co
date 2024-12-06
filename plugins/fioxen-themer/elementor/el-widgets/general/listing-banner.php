<?php

if (!defined('ABSPATH')) {
	 exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Listing_Banner extends GVAElement_Base{
	
	const NAME = 'gva_listing_banner';
	const TEMPLATE = 'general/banner';
	const CATEGORY = 'fioxen_listing';

	public function get_categories() {
		return self::CATEGORY;
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Listing Banner', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'listing', 'banner' ];
	}

	public function get_script_depends() {
		return array();
	}

	public function get_style_depends() {
		return array();
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
				'label'     => __('Style', 'fioxen-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'      => __('Style I', 'fioxen-themer'),
					'style-2'      => __('Style II', 'fioxen-themer')
				],
			]
	  	);

		$this->add_control(
			'title',
			[
				'label' => __('Title', 'fioxen-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Add your Title', 'fioxen-themer'),
				'default' => esc_html__('Switzerland', 'fioxen-themer')
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => __('Description', 'fioxen-themer'),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Add your Description', 'fioxen-themer'),
				'default' => esc_html__('Venezia, Italy', 'fioxen-themer')
			]
		);
		$this->add_control(
         'rating',
         [
            'label'   => __('Rating', 'fioxen-themer'),
            'default' => '5',
            'type'    => Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 5,
            'condition' => [
				  'style' => ['style-1']
				],
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

		$this->add_control(
			'term_slug',
			[
				'label' => __('Region & Category Slug', 'fioxen-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'placeholder' => esc_html__('Term slug', 'fioxen-themer'),
				'default' => ''
			]
		);
		$this->add_control(
			'image',
			[
				'label' 		=> __('Image', 'fioxen-themer'),
				'type' 		=> Controls_Manager::TEXT,
				'default'    => [
					 'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/image-banner.jpg',
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __('Height', 'fioxen-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 100,
					 'max' => 1000,
				  ],
				],
				'default' => [
				  'size'  => 270
				],
				'condition' => [
				  'style' => ['style-1']
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-listing-banner.style-1 .listings-banner-content' => 'min-height: {{SIZE}}{{UNIT}};',
				  '{{WRAPPER}} .gsc-listing-banner.style-2 .listings-banner-content' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'link_custom',
			[
				'label' => __('Link Custom', 'fioxen-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'default' => ''
			]
		);
		$this->add_control(
			'btn_title',
			[
				'label' => __('Title Button', 'fioxen-themer'),
				'type' => Controls_Manager::TEXT,
				'label_block'	=> true,
				'default' => 'View Deals'
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
			'bg_overlay',
			[
				'label' => __('Overlay Background', 'fioxen-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-listing-banner .banner-image:after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_align',
			[
				'label' => __('Alignment Text', 'fioxen-themer'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'fioxen-themer'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('Center', 'fioxen-themer'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'fioxen-themer'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'show_number_content',
			[
				'label'   => __('Show number content', 'fioxen-themer'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		 );
		$this->add_control(
			'show_number_text',
			[
				'label'   => __('Text Prefix', 'fioxen-themer'),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('tours', 'fioxen-themer'),
				'condition' => [
				  'show_number_content' => ['yes']
				],
			]
		 );
		$this->add_control(
			'show_number_one_text',
			[
				'label'   => __('Text Prefix One Item', 'fioxen-themer'),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('tour', 'fioxen-themer'),
				'condition' => [
				  'show_number_content' => ['yes']
				],
			]
		 );
		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __('Content', 'fioxen-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_subtitle',
			[
				'label' => __('Sub Title', 'fioxen-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		  $this->add_control(
			 'subtitle_color',
			 [
				'label' => __('Color', 'fioxen-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-listing-banner.style-1 .banner-content .subtitle' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-listing-banner.style-2 .banner-content .subtitle' => 'color: {{VALUE}};',
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .gsc-listing-banner.style-1 .banner-content .subtitle, {{WRAPPER}} .gsc-listing-banner.style-2 .banner-content .subtitle',
			 ]
		  );

		$this->add_control(
			'heading_title',
			[
				'label' => __('Title', 'fioxen-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		  $this->add_control(
			 'title_color',
			 [
				'label' => __('Color', 'fioxen-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-listing-banner.style-1 .banner-content .title' => 'color: {{VALUE}};',
				  '{{WRAPPER}} .gsc-listing-banner.style-2 .banner-content .title' => 'color: {{VALUE}};',
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-listing-banner.style-1 .banner-content .title, {{WRAPPER}} .gsc-listing-banner.style-2 .banner-content .title',
			 ]
		  );


		  $this->end_controls_section();
	 }

	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			include $this->get_template( self::TEMPLATE . '.php');
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Listing_Banner());
