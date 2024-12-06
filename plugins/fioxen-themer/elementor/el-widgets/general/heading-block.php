<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Heading_Block extends GVAElement_Base {
	const NAME = 'gva-heading-block';
   const TEMPLATE = 'general/heading-block';
   const CATEGORY = 'fioxen_general';

    public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Heading Block', 'fioxen-themer' );
	}

	public function get_keywords() {
		return [ 'heading', 'title', 'text' ];
	}

	public function get_script_depends() {
		return [
			'typed',
			'gavias.elements',
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
			'sub_title',
			[
				'label' => __( 'Sub Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Sub Title', 'fioxen-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your title', 'fioxen-themer' ),
				'default' => __( 'Add Your Heading Text Here', 'fioxen-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'fioxen-themer' ),
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
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'fioxen-themer' ),
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
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment Text', 'fioxen-themer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'fioxen-themer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'fioxen-themer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'fioxen-themer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .content-inner' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_align',
			[
				'label' => __( 'Alignment Box', 'fioxen-themer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'fioxen-themer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'fioxen-themer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'fioxen-themer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label' => __( 'Max Width (px)', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .content-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'auto_responsive',
			[
				'label' => __( 'Auto Responsive', 'fioxen-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Auto Responsive size of title', 'fioxen-themer' ),
				'default' => 'yes'
			]
		);

		$this->end_controls_section();


		$this->start_controls_section( //** Section Icon
			'section_video',
			[
				'label' => __( 'Video Top', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'video',
			[
				'label' 			=> __( 'Video', 'fioxen-themer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> __( 'Enable/Disable Video Heading', 'fioxen-themer' ),
				'default' 		=> 'no'
			]
		);
		$this->add_control(
			'video_url',
			[
				'label' 			=> __( 'Video Youtube or Vimeo URL', 'fioxen-themer' ),
				'label_block'	=> true,
				'type' 			=> Controls_Manager::TEXT,
				'condition' => [
					'video' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section( //** Section Button
			'section_button',
			[
				'label' => __( 'Button', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 	=> __( 'Button URL', 'fioxen-themer' ),
				'type' 	=> Controls_Manager::URL,
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'fioxen-themer' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> 'Read More'
			]
		);
		$this->add_control(
			'button_style',
			[
				'label' 	=> __( 'Button Style', 'fioxen-themer' ),
				'type' 	=> Controls_Manager::SELECT,
				'options' => [
					'btn-theme' 			=> esc_html__('Button Theme', 'fioxen-themer'),
					'btn-theme-2' 			=> esc_html__('Button Theme Second', 'fioxen-themer'),
					'btn-white' 			=> esc_html__('Button White', 'fioxen-themer'),
					'btn-black' 			=> esc_html__('Button Black', 'fioxen-themer'),
					'btn-border' 			=> esc_html__('Button Border', 'fioxen-themer'),
					'btn-border-white' 	=> esc_html__('Button Border White', 'fioxen-themer')
				],
				'default' => 'btn-theme',
			]
		);
		$this->add_control(
			'button_size',
			[
				'label' => __( 'Button Size', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 					=> esc_html__('Button Size Default', 'fioxen-themer'),
					'btn-size-small' 	=> esc_html__('Button Small', 'fioxen-themer'),
					'btn-medium' 		=> esc_html__('Button Medium', 'fioxen-themer')
				],
				'default' => '',
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta' => 'color: {{VALUE}}!important;', 
				],
			]
		);
		$this->add_control(
			'button_background',
			[
				'label' => __( 'Button Background', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color Hover', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta:hover' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'button_background_hover',
			[
				'label' => __( 'Button Background Hover', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-action .btn-cta:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_video_style',
			[
				'label' => __( 'Video Button', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'video' => 'yes',
				],
			]
		);
		$this->add_control(
			'video_background_primary',
			[
				'label' => __( 'Primary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-video .video-link' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_background_second',
			[
				'label' => __( 'Primary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .heading-video .video-link:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_color',
			[
				'label' => __( 'Text Button Video Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'video_size',
			[
				'label' => __( 'Video Button Size', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 92,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading  .heading-video .video-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_space',
			[
				'label' => __( 'Heading Element Space Bottom', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-heading .title',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Title Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => __( 'Sub Title', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_responsive_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_space',
			[
				'label' => __( 'Sub Title Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_sub_title',
				'selector' => '{{WRAPPER}} .gsc-heading .sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => __( 'Description', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 		
		$this->add_responsive_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-heading .title-desc',
			]
		);

		$this->add_responsive_control(
			'description_space',
			[
				'label' => __( 'Description Spacing', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
              'top'       => 20,
              'right'     => 0,
              'left'      => 0,
              'bottom'    => 0,
              'unit'      => 'px'
          	],
				'selectors' => [
					'{{WRAPPER}} .gsc-heading .title-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

$widgets_manager->register(new GVAElement_Heading_Block());
