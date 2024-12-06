<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

class GVAElement_Icon_Box_Styles extends GVAElement_Base {  
	const NAME = 'gva-icon-box-styles';
	const TEMPLATE = 'general/icon-box-styles';
	const CATEGORY = 'fioxen_general';

   public function get_categories() {
      return array(self::CATEGORY);
   }
    
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Icon Box Styles', 'fioxen-themer' );
	}

	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box Style', 'fioxen-themer' ),
			]
		);
		
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I', 'fioxen-themer' ),
					'style-2' 		=> __( 'Style II', 'fioxen-themer' ),
					'style-3' 		=> __( 'Style III', 'fioxen-themer' ),
					'style-4' 		=> __( 'Style IV', 'fioxen-themer' )
				],
				'default' => 'style-1'
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'fioxen-themer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => 'Get Title',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Get it on', 'fioxen-themer' ),
				'placeholder' => __( 'Sub-title', 'fioxen-themer' ),
				'condition' => [
					'style' => ['style-2']
				]
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'fioxen-themer' ),
				'placeholder' => __( 'Enter your title', 'fioxen-themer' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'There are many new variations of pasages of available text.', 'fioxen-themer' ),
				'placeholder' => __( 'Enter your description', 'fioxen-themer' ),
				'show_label' => false,
				'condition' => [
					'style' => ['style-1', 'style-3']
				]
			]
		);

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'Title HTML Tag', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'active',
			[
				'label' => __( 'Active', 'fioxen-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Button
			'section_button',
			[
				'label' => __( 'Button & Link', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 	=> __( 'Link', 'fioxen-themer' ),
				'type' 	=> Controls_Manager::URL,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'fioxen-themer' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'	=> 'More Details +',
				'condition' => [
					'style' 	=> ['style-3'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_second_color',
			[
				'label' => __( 'Second Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' 		=> 0,
					'right' 		=> 0,
					'left'		=> 0,
					'bottom'		=> 0,
					'unit'		=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'fioxen-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'selected_icon[value]!' => ''
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner .box-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner .box-icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-styles .box-icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'	=> [
					'size'	=> 30
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1 .icon-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .icon-inner' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Icon Padding', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
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
				'default'	=> [
					'size'	=> 0
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-1 .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles .title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .icon-box-content .box-content .title' => 'color: {{VALUE}};',
					
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-styles .title, {{WRAPPER}} .gsc-icon-box-styles .title a',
			]
		);

		$this->add_control(
			'sub_title_style',
			[
				'label' => __( 'Sub Title', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['style-2'],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles.style-2 .icon-box-content .box-content .sub-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-2'],
				], 
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-styles .sub-title',
				'condition' => [
					'style' => ['style-2'],
				],
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['style-1', 'style-3'],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1', 'style-3'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-styles .desc',
				'condition' => [
					'style' => ['style-1', 'style-3'],
				],

			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template( self::TEMPLATE . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_Icon_Box_Styles());
