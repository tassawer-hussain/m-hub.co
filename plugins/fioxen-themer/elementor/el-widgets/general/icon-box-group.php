<?php
if (!defined('ABSPATH')) {
	exit;
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Icon_Box_Group extends GVAElement_Base{
	const NAME = 'gva_icon_box_group';
	const TEMPLATE = 'booking/booking';
	const CATEGORY = 'fioxen_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}
		
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Icon Box Group', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'icon', 'box', 'content', 'carousel', 'grid' ];
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
				'label' => esc_html__('Content', 'fioxen-themer'),
			]
		);
		$this->add_control( // xx Layout
			'layout_heading',
			[
				'label'   => esc_html__('Layout', 'fioxen-themer'),
				'type'    => Controls_Manager::HEADING,
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Layout Display', 'fioxen-themer'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => [
					'grid'      => esc_html__('Grid', 'fioxen-themer'),
					'carousel'  => esc_html__('Carousel', 'fioxen-themer')
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> esc_html__('Style', 'fioxen-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'style-1' => esc_html__('Style I', 'fioxen-themer'),
					'style-2' => esc_html__('Style II', 'fioxen-themer'),
					'style-3' => esc_html__('Style III', 'fioxen-themer'),
				],
				'default' => 'style-1',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'fioxen-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'fioxen-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label'      	=> esc_html__('Choose Icon', 'fioxen-themer'),
				'type'       	=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'flaticon-serving-dish',
					'library' 	=> 'gva_custom_icon'
				]
			]
		);
		$repeater->add_control(
			'link',
			[
				'label'     	=> esc_html__('Link', 'fioxen-themer'),
				'type'      	=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'fioxen-themer'),
				'label_block' 	=> true
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label'     	=> esc_html__('Icon Color', 'fioxen-themer'),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .style-1 {{CURRENT_ITEM}} .icon-box-content .box-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .style-1 {{CURRENT_ITEM}} .icon-box-content .box-icon svg' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .style-2 {{CURRENT_ITEM}} .icon-box-content .box-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .style-2 {{CURRENT_ITEM}} .icon-box-content .box-icon svg' => 'fill: {{VALUE}}'
				],
			]
		);
		$repeater->add_control(
			'active',
			[
				'label' 			=> esc_html__('Active', 'fioxen-themer'),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> esc_html__('Active', 'fioxen-themer'),
				'default' 		=> 'no'
			]
		);

		$this->add_control(
			'icon_boxs',
			[
				'label'       => esc_html__('Brand Content Item', 'fioxen-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  					=> esc_html__('Museums', 'fioxen-themer'),
						'selected_icon' 			=> array('value' => 'flaticon-government')
					),
					array(
						'title'  					=> esc_html__('Restaurant', 'fioxen-themer'),
						'selected_icon' 			=> array('value' => 'flaticon-serving-dish')
					),
					array(
						'title'  					=> esc_html__('Game Field', 'fioxen-themer'),
						'selected_icon' 			=> array('value' => 'flaticon-game-controller')
					),
					array(
						'title'  					=> esc_html__('Job & Feed', 'fioxen-themer'),
						'selected_icon' 			=> array('value' => 'flaticon-suitcase')
					),
					array(
						'title'  					=> esc_html__('Party Center', 'fioxen-themer'),
						'selected_icon' 			=> array('value' => 'flaticon-gift-box')
					),
					array(
						'title'  					=> esc_html__('Fitness Zone', 'fioxen-themer'),
						'selected_icon' 			=> array('value' => 'flaticon-dumbbell')
					)
				)
			]
		);
		
		$this->add_control(
			'active_bg',
			[
				'label' => esc_html__('Color', 'fioxen-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group.style-1 .icon-box-item:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1'],
				],
			]
		);

		$this->end_controls_section();

		$this->add_control_carousel(array(6, 4, 3, 2), array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

		// Icon Styling
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__('Icon', 'fioxen-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'fioxen-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item .box-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> esc_html__('Size', 'fioxen-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 60
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item .box-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item .box-icon svg' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .gsc-icon-box-group.style-2 .icon-box-item .icon-box-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-group.style-2 .icon-box-item .icon-box-content .box-icon i' => 'width: {{SIZE}}{{UNIT}};',
					
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' 		=> esc_html__('Spacing', 'fioxen-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group.style-1 .icon-box-item .icon-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-group.style-3 .icon-box-item .box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'fioxen-themer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .icon-inner .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'fioxen-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'fioxen-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__('Spacing', 'fioxen-themer'),
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
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'fioxen-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .title a' => 'color: {{VALUE}};',
				],
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
				'label' => esc_html__('Description', 'fioxen-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['style-2'],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'fioxen-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item-content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-2'],
				],
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
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			if( !empty($settings['layout']) ){
				include $this->get_template('general/icon-box-group/' . $settings['layout'] . '.php');
			}
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Icon_Box_Group());
