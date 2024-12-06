<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Additional_Info extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_additional_info';
   const TEMPLATE = 'listing/item-additional-info';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Listing Item Additional Info', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'additional' ];
   }

   protected function register_controls() {
      //--
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
            'default'   => esc_html__( 'Additional info', 'fioxen-themer' )
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
            'label' => __( 'Title Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .element-item-listing .block-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_title',
            'selector' => '{{WRAPPER}} .element-item-listing .block-titl',
         ]
      );

      $this->add_control(
         'heading_style', 
         [
            'label'  => __('Style Content'),
            'type' => Controls_Manager::HEADING,
         ]
      );

      $this->add_control(
         'label_color',
         [
            'label' => __( 'Label Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-additional-info .item-info label' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_label',
            'selector' => '{{WRAPPER}} .gva-listing-additional-info .item-info label',
         ]
      );

      $this->add_control(
         'Value_color',
         [
            'label' => __( 'Value Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-additional-info .item-info .value' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_value',
            'selector' => '{{WRAPPER}} .gva-listing-additional-info .item-info .value',
         ]
      );

      $this->end_controls_section();

   }

   protected function render(){
      parent::render();
      $settings = $this->get_settings_for_display();
      include $this->get_template(self::TEMPLATE . '.php');
   }
}

$widgets_manager->register(new GVAElement_Listing_Item_Additional_Info());
