<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Amenities extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_amenities';
   const TEMPLATE = 'listing/item-amenities';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Listing Item Amenities', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'amenities' ];
   }


   protected function register_controls() {
      //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content', 'fioxen-themer'),
         ]
      );

      $this->add_control(
         'title',
         [
            'label'        => esc_html__( 'Title', 'fioxen-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'Enter your title', 'fioxen-themer' ),
            'default'      => esc_html__( 'Amenities', 'fioxen-themer' ),
            'label_block'  => true
         ]
      );

     
      $this->add_control(
         'heading_style_title',
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
         'heading_style_value',
         [
            'label' => esc_html__( 'Style Value Text', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'value_color',
         [
            'label' => esc_html__( 'Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-amenities .listing-amenities .block-content .amenities-list > li.amenity-item .name' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'value_typography',
            'selector' => '{{WRAPPER}} .gva-listing-amenities .listing-amenities .block-content .amenities-list > li.amenity-item .name',
         ]
      );

      // --- Style Icon ---
      $this->add_control(
         'heading_style_icon',
         [
            'label' => esc_html__( 'Style Icon', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_control(
         'icon_color',
         [
            'label' => esc_html__( 'Icon Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-amenities .listing-amenities .block-content .amenities-list > li.amenity-item .icon-box .icon' => 'color: {{VALUE}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'icon_size',
         [
            'label' => __( 'Size', 'fioxen-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 32
            ],
            'range' => [
              'px' => [
                'min' => 20,
                'max' => 80,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gva-listing-amenities .listing-amenities .block-content .amenities-list > li.amenity-item .icon-box .icon' => 'font-size: {{SIZE}}{{UNIT}};',
              '{{WRAPPER}} .gva-listing-amenities .listing-amenities .block-content .amenities-list > li.amenity-item .icon-box .icon icon-image' => 'max-width: {{SIZE}}{{UNIT}};'
            ],
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

$widgets_manager->register(new GVAElement_Listing_Item_Amenities());
