<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Custom_Field extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_custom_field';
   const TEMPLATE = 'listing/item-custom-field';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('BA Item Custom Field', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'custom', 'field' ];
   }


   protected function register_controls() {
      //--
      $fields = array();
      $fields_data = get_option('gva_listing_fields');
      if(!empty($fields_data)){
         foreach ($fields_data as $key => $field){
            $field_key = isset($field['key']) ? $field['key'] : '';
            if(isset($field['type_field']) && $field['type_field'] && $field['type_field'] == 'custom'){
               $fields[$field_key] = isset($field['label']) ? $field['label'] . '(' . $field['key'] . ')' : $field['key'];
            }
         }
      }

      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content', 'fioxen-themer'),
         ]
      );

      $this->add_control(
         'field_key',
         [
            'label' => __( 'Field Name', 'fioxen-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => $fields,
            'default' => 'phone'
         ]
      );

      $this->add_control(
         'title_text',
         [
            'label'        => esc_html__( 'Title', 'fioxen-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'Enter your title', 'fioxen-themer' ),
            'default'      => esc_html__( 'Custom Field', 'fioxen-themer' ),
            'label_block'  => true
         ]
      );

      $this->add_control(
         'selected_icon',
         [
            'label'      => esc_html__('Choose Icon', 'fioxen-themer'),
            'type'       => Controls_Manager::ICONS,
            'default' => [
              'value' => 'flaticon-clock',
              'library' => 'fa-solid',
            ]
         ]
      );

      $this->add_control(
         'heading_style_title',
         [
            'label' => esc_html__( 'Style Title Text', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_responsive_control(
         'title_color',
         [
            'label' => esc_html__( 'Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-custom-field .lt-meta-title' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .gva-listing-custom-field .lt-meta-title',
         ]
      );

      $this->add_control(
         'heading_style_value',
         [
            'label' => esc_html__( 'Style Value Text', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
         ]
      );
      $this->add_responsive_control(
         'value_color',
         [
            'label' => esc_html__( 'Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-custom-field .item-value' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'value_typography',
            'selector' => '{{WRAPPER}} .gva-listing-custom-field .item-value',
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
               '{{WRAPPER}} .gva-listing-custom-field .icon i' => 'color: {{VALUE}};',
               '{{WRAPPER}} .gva-listing-custom-field .icon svg' => 'fill: {{VALUE}};',
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
              '{{WRAPPER}} .gva-listing-custom-field .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
              '{{WRAPPER}} .gva-listing-custom-field .icon svg' => 'width: {{SIZE}}{{UNIT}};'
            ],
         ]
      );

      $this->add_responsive_control(
         'icon_space',
         [
            'label' => __( 'Spacing', 'fioxen-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 12,
            ],
            'range' => [
              'px' => [
                'min' => 0,
                'max' => 50,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gva-listing-custom-field .icon' => 'padding-right: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_Listing_Item_Custom_Field());
