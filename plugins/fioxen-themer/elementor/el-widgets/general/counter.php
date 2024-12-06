<?php
if(!defined('ABSPATH')){ exit; }
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Counter extends GVAElement_Base {  

	const NAME = 'gva-counter';
   const TEMPLATE = 'general/counter';
   const CATEGORY = 'fioxen_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }
   
	public function get_title() {
		return __( 'Counter', 'fioxen-themer' );
	}

	
	public function get_keywords() {
		return [ 'counter', 'icon' ];
	}

	public function get_script_depends() {
      return [
         'jquery.count_to',
         'jquery.appear',
      ];
   }

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'fioxen-themer' ),
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
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon Class', 'fioxen-themer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style!' => ['style-1']
				]
			]
		);
		$this->add_control(
			'number',
			[
				'label' => __( 'Number', 'fioxen-themer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 110
			]
		);
		$this->add_control(
			'text_before',
			[
				'label' => __( 'Text Before Number', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'text_after',
			[
				'label' => __( 'Text After Number', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Listing', 'fioxen-themer' ),
				'placeholder' => __( 'Enter your sub title', 'fioxen-themer' ),
				'condition' => [
					'style' => ['style-1']
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
			'link',
			[
				'label' => __( 'Link', 'fioxen-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'title_size',
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
				'default' => 'div',
			]
		);
		
		$this->end_controls_section();


		// Style Icon
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'fioxen-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style!' => ['style-1']
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Primary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-icon .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .milestone-block .milestone-icon .icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label' => __( 'Secondary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block.style-2 .milestone-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Hover | Primary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block:hover .milestone-icon .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .milestone-block:hover .milestone-icon .icon svg' => 'fill: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => __( 'Hover | Secondary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block.style-2:hover .milestone-icon .icon' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 60
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-icon .icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .milestone-block .milestone-icon .icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block.style-1 .box-content .milestone-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .milestone-block.style-2 .box-content .milestone-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .milestone-block.style-3 .box-content .milestone-icon' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_top_space',
			[
				'label' => __( 'Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .box-content .milestone-content .milestone-text' => 'margin-top: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .milestone-block .box-content .milestone-content .milestone-text' => 'color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .milestone-block .box-content .milestone-content .milestone-text',
			]
		);

		$this->add_control(
			'subtitle_heading',
			[
				'label' => __( 'Sub-Title Style', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Sub Title Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block .box-content .milestone-content .milestone-text' => 'color: {{VALUE}}!important;',
				],
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .milestone-block .box-content .milestone-content .milestone-text',
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->end_controls_section();

		// Number Text
		$this->start_controls_section(
			'sectionn_number_style',
			[
				'label' => __( 'Number Text', 'fioxen-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'number_bottom_space',
			[
				'label' => __( 'Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-number-inner' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'number_text_color',
			[
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .milestone-block .milestone-number-inner .milestone-number' => 'color: {{VALUE}};',
					'{{WRAPPER}} .milestone-block .milestone-number-inner .symbol' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_text_typography',
				'selector' => '{{WRAPPER}} .box-content .milestone-content .milestone-number-inner',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}
}
$widgets_manager->register(new GVAElement_Counter());
