<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Pricing_Block extends GVAElement_Base {
	const NAME = 'gva-pricing-block';
   const TEMPLATE = 'general/pricing-block';
   const CATEGORY = 'fioxen_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Pricing Block', 'fioxen-themer' );
	}

	public function get_keywords() {
		return [ 'pricing', 'block' ];
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
					'style-1' 		=> __( 'Style I: Default', 'fioxen-themer' )
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'fioxen-themer' ),
				'default' => __( 'Basic Plan', 'fioxen-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'subtitle_text',
			[
				'label' => __( 'Sub Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Save 45%', 'fioxen-themer' ),
				'default' => __( 'Save 45%', 'fioxen-themer' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc_text',
			[
				'label' => __( 'Description', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Your Description', 'fioxen-themer' ),
				'default' => __( 'Suitable For Any IT Solutions.', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '29.68', 'fioxen-themer' ),
				'default' => __( '29.68', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Currency', 'fioxen-themer' ),
				'default' => __( '$', 'fioxen-themer' ),
			]
		);
		$this->add_control(
			'period',
			[
				'label' => __( 'Period', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Monthly', 'fioxen-themer' ),
				'default' => __( 'Monthly', 'fioxen-themer' ),
			]
		);

		$repeater = new Repeater();
      $repeater->add_control(
         'pricing_features',
			[
	         'label'       => __('Pricing Features', 'fioxen-themer'),
	         'type'        => Controls_Manager::TEXT,
	         'default'     => 'Free text goes here',
	         'label_block' => true,
	     	]
	   );
	   $repeater->add_control(
         'feature_active',
			[
	         'label'       => __('Pricing Features', 'fioxen-themer'),
	         'type'        => Controls_Manager::SWITCHER,
	         'default'	  => 'yes'
	     	]
	   );
		$this->add_control(
         'pricing_content',
         [
            'label'       => __('Pricing Features', 'fioxen-themer'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ pricing_features }}}',
            'default'     => array(
               array(
                  'pricing_features'  => esc_html__( 'Resposive Design', 'fioxen-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Unlimited Entities', 'fioxen-themer' )
               ),
               array(
                  'pricing_features'  => esc_html__( 'Premium Quality Support', 'fioxen-themer' ),
                  'feature_active'	=> 'no'
               ),
               array(
                  'pricing_features'  => esc_html__( 'Hosted In The Cloud', 'fioxen-themer' ),
                  'feature_active'	=> 'no'
               )
            ),
         ]
      );

      $this->add_control(
			'pricing_active',
			[
	         'label'       => __('Pricing Active', 'fioxen-themer'),
	         'type'        => Controls_Manager::SWITCHER,
	         'default'	  => 'no'
	     	]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_Button',
			[
				'label' => __( 'Button', 'fioxen-themer' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button URL', 'fioxen-themer' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Select Plan'
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'btn-theme' 		=> esc_html__('Button Theme', 'fioxen-themer'),
					'btn-theme-2' 		=> esc_html__('Button Theme Second', 'fioxen-themer'),
					'btn-white' 		=> esc_html__('Button White', 'fioxen-themer'),
					'btn-black' 		=> esc_html__('Button Black', 'fioxen-themer')
				],
				'default' => 'btn-theme',
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

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-pricing .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price Text', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_price_text',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-price .price-value',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'selector' => '{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .text',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'fioxen-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .content-inner .plan-list li .icon' => 'color: {{VALUE}};',
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

$widgets_manager->register(new GVAElement_Pricing_Block());
