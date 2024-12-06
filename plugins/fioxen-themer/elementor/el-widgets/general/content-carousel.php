<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Content_Carousel extends GVAElement_Base{
	const NAME = 'gva-content-carousel';
	const TEMPLATE = 'general/content-carousel';
	const CATEGORY = 'fioxen_general';

	public function get_name() {
		return self::NAME;
	}

	public function get_categories() {
		return array(self::CATEGORY);
	}


	public function get_title() {
		return __('Content Carousel', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'services', 'content', 'carousel' ];
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
  
	  	$repeater = new Repeater();
	  	$repeater->add_control(
			'image',
			[
				'label'      => __('Choose Image', 'fioxen-themer'),
				'default'    => [
					'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/image-3.jpg',
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false
			]
	  	);
	  	$repeater->add_control(
		 	'sub_title',
		 	[
				'label'       => __('SubTitle', 'fioxen-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'top Funding stories',
				'label_block' => true,
		 	]
	 	);
		  $repeater->add_control(
			 'title',
			 [
				'label'       => __('Title', 'fioxen-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Add your Title',
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
			 'desc',
			 [
				'label'       => __('Description', 'fioxen-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo enim ipsam voluptatem',
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
			 'btn_title',
			 [
				'label'       => __('Button Title', 'fioxen-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Learn More', 'fioxen-themer'),
				'label_block' => true,
			 ]
		  );
		  $repeater->add_control(
			 'btn_link',
			 [
				'label'     => __( 'Button Link', 'fioxen-themer' ),
				'type'      => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'fioxen-themer' ),
				'label_block' => true
			 ]
		  );
		  
		  $this->add_control(
			 'carousel_content',
			 [
				'label'       => __('Content Item', 'fioxen-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'sub_title'         => esc_html__( 'Why Choose Us', 'fioxen-themer' ),
						'title'             => 'About Our Fioxen Comunity and Our Expertise'
					),
					array(
						'sub_title'         => esc_html__( 'Why Choose Us', 'fioxen-themer' ),
						'title'             => 'About Our Fioxen Comunity and Our Expertise'
					),
				)
			 ]
		  );
		  
			$this->end_controls_section();

			$this->add_control_carousel(true);

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
					  'size'  => 0
					],
					'selectors' => [
					  '{{WRAPPER}} .gsc-content-carousel .item-content .item-content-inner .box-content .gsc-heading .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
				  '{{WRAPPER}} .gsc-content-carousel .item-content .item-content-inner .box-content .gsc-heading .title' => 'color: {{VALUE}};',
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-content-carousel .item-content .item-content-inner .box-content .gsc-heading .title',
			 ]
		  );

		  $this->add_control(
			 'description_color',
			 [
				'label' => __( 'Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .gsc-content-carousel .item-content .item-content-inner .box-content .gsc-heading .title-desc' => 'color: {{VALUE}};',
				],
			 ]
		  );

		  $this->add_group_control(
			 Group_Control_Typography::get_type(),
			 [
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .gsc-content-carousel .item-content .item-content-inner .box-content .gsc-heading .title-desc',
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

$widgets_manager->register(new GVAElement_Content_Carousel());
