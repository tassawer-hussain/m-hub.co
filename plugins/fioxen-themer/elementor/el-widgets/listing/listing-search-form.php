<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Listing_Search_Form extends GVAElement_Base {
   const NAME = 'gva-listing-search-form';
   const TEMPLATE = 'listing/search-form';
   const CATEGORY = 'fioxen_listing';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Listing - Search Form', 'fioxen-themer' );
	}

	public function get_keywords() {
		return [ 'listings', 'search', 'form', 'content' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
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
              'style-1' => esc_html__('Style I + Align Left', 'fioxen-themer'),
              'style-1 align-center' => esc_html__('Style I + Align center', 'fioxen-themer'),
              'style-2' => esc_html__('Style II', 'fioxen-themer'),
            ],
            'default' => 'style-1',
         ]
      );
      $this->add_control(
         'url_listings_page',
         [
            'label' => esc_html__( 'Url Listings Page', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html__('Url Listings Page Results', 'fioxen-themer'),
            'label_block' => true 
         ]
      );
		$this->add_control(
         'search_keyword',
         [
            'label' => esc_html__( 'Enable search keyword', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
         ]
      );
      $this->add_control(
         'search_category',
         [
            'label' => esc_html__( 'Enable search category', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
         ]
      );
      $this->add_control(
         'search_regions',
         [
            'label' => esc_html__( 'Enable search region', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::SWITCHER,
            'default' => 'no',
         ]
      );
      $this->add_control(
         'search_location',
         [
            'label' => esc_html__( 'Enable search location', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
         ]
      );
      $this->add_control(
         'placeholder_keyword',
         [
            'label' => esc_html__( 'Placeholder keyword input', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('I\'m looking for...', 'fioxen-themer'),
            'label_block' => true 
         ]
      );
      $this->add_control(
         'placeholder_location',
         [
            'label' => esc_html__( 'Placeholder location input', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Location (e.g. New York)', 'fioxen-themer'),
            'label_block' => true 
         ]
      );
      $this->add_control(
         'placeholder_category',
         [
            'label' => esc_html__( 'Placeholder category input', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('All Categories', 'fioxen-themer'),
            'label_block' => true 
         ]
      );
      $this->add_control(
         'placeholder_region',
         [
            'label' => esc_html__( 'Placeholder region input', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('All regions', 'fioxen-themer'),
            'label_block' => true 
         ]
      );
      $this->add_control(
         'btn_text',
         [
            'label' => esc_html__( 'Text of button search', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Search', 'fioxen-themer'),
            'label_block' => true 
         ]
      );
      $this->add_control(
         'btn_submit_width',
         [
            'label' => esc_html__( 'Width submit button', 'fioxen-themer' ),
            'type' => Elementor\Controls_Manager::SLIDER,
            'default' => [
               'size' => 190,
            ],
            'range' => [
               'px' => [
                  'min' => 50,
                  'max' => 350,
               ],
            ],
            'selectors' => [
               '{{WRAPPER}} .gsc-call-to-action .content-inner .cta-content' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
         ]
      );
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Logo Styling', 'fioxen-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'logo_padding',
			[
				'label' => __( 'Padding', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-logo .site-branding-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'logo_margin',
			[
				'label' => __( 'Margin', 'fioxen-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-logo .site-branding-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
         Group_Control_Border::get_type(),
         [
            'name'      => 'logo_border',
            'selector'  => '{{WRAPPER}} .gsc-logo .site-branding-logo',
            'separator' => 'before',
         ]
       );

       $this->add_control(
         'image_border_radius',
         [
            'label'      => __('Border Radius', 'fioxen-themer'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .gsc-logo .site-branding-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

$widgets_manager->register( new GVAElement_Listing_Search_Form );
