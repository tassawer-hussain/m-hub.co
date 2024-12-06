<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Opening_Hour extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_opening_hour';
   const TEMPLATE = 'listing/item-opening-hour';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Listing Item Opening Hour', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'opening', 'hour' ];
   }

   protected function register_controls() {
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => __('Content', 'fioxen-themer'),
         ]
      );

      $this->add_control(
         'title',
         [
            'label'     => __( 'Title', 'fioxen-themer' ),
            'type'      => Controls_Manager::TEXT,
            'default'   => esc_html__( 'Opening Hours', 'fioxen-themer' )
         ]
      );
      
      $this->add_control(
         'heading_title_style',
         [
            'label' => esc_html__( 'Style Title Text', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'text_color',
         [
            'label' => __( 'Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .element-item-listing .block-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_text',
            'selector' => '{{WRAPPER}} .element-item-listing .block-title',
         ]
      );

      $this->add_control(
         'heading_label_style',
         [
            'label' => esc_html__( 'Style Label', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'label_color',
         [
            'label' => __( 'Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-opening_hour .content-inner' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_label',
            'selector' => '{{WRAPPER}} .gva-listing-opening_hour .content-inner',
         ]
      );

      $this->add_control(
         'heading_hour_style',
         [
            'label' => esc_html__( 'Style Hour', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'hour_color',
         [
            'label' => __( 'Hour Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-opening_hour .content-inner' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_hour',
            'selector' => '{{WRAPPER}} .gva-listing-opening_hour .content-inner',
         ]
      );

      $this->end_controls_section();

   }

   protected function render(){
      parent::render();

      $settings = $this->get_settings_for_display();
      printf( '<div class="fioxen-%s fioxen-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
   }
}

$widgets_manager->register(new GVAElement_Listing_Item_Opening_Hour());
