<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Video_Box extends GVAElement_Base {  
	const NAME = 'gva-video-box';
   const TEMPLATE = 'general/video-box';
   const CATEGORY = 'fioxen_general';

   public function get_categories(){
      return array(self::CATEGORY);
   }
    
   public function get_name(){
      return self::NAME;
   }

	public function get_title() {
		return __( 'Video Box', 'fioxen-themer' );
	}

	public function get_keywords() {
		return [ 'video', 'box' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Content', 'fioxen-themer' ),
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Your Title', 'fioxen-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'style', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style I', 'fioxen-themer' ),
					'style-2' 		=> __( 'Style II', 'fioxen-themer' ),
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'fioxen-themer' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
               'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/video.jpg',
				],
				'condition' => [
					'style' => ['style-1']
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link Video (Youtube/Vimeo)', 'fioxen-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'fioxen-themer' ),
				'separator' => 'before',
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
			'primary_color',
			[
				'label' => __( 'Primary Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-video-box.style-2 .video-inner .video-content .video-action .popup-video' => 'background: {{VALUE}};',
					'{{WRAPPER}} .gsc-video-box.style-2 .video-inner .video-content .video-action .popup-video::before, {{WRAPPER}} .gsc-video-box.style-2 .video-inner .video-content .video-action .popup-video::after' => 'border-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'second_color',
			[
				'label' => __( 'Second Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gsc-video-box.style-2 .video-inner .video-content .video-action .popup-video' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'fioxen-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-video-box .video-inner .video-content .video-action .popup-video' => 'font-size: {{SIZE}}{{UNIT}};',
				],
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
					'size' => 20
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-video-box .video-inner .video-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .gsc-video-box .video-inner .video-content .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-video-box .video-inner .video-content .title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'fioxen-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => 'style-1',
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
					'{{WRAPPER}} .highlight_content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .highlight_content .desc',
				'condition' => [
					'style' => 'style-1',
				],

			]
		);

		$this->add_responsive_control(
			'description_bottom_space',
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
					'size' => 20
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_Video_Box());
