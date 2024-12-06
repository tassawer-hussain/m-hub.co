<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Information extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_information';
   const TEMPLATE = 'listing/item-information';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Listing Item Information', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'information' ];
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
         'key',
         [
            'label' => __( 'Information', 'fioxen-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'phone'        => __( 'Listing Phone', 'fioxen-themer' ),
               'address'      => __( 'Listing Address', 'fioxen-themer' ),
               'email'        => __( 'Listing Email', 'fioxen-themer' ),
               'website'      => __( 'Listing Website', 'fioxen-themer' ),
               'type'      => __( 'Listing Type', 'fioxen-themer' )
            ],
            'default' => 'phone'
         ]
      );

      $this->add_control(
         'style',
         [
            'label' => __( 'Style Display', 'fioxen-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style-1'     => __( 'Style I', 'fioxen-themer' ),
            ],
            'default' => 'style-1',
            'condition' => [
               'key' => ['phone']
            ]
         ]
      );

      $this->add_control(
         'heading_icon', 
         [
            'label'  => __('Icon'),
            'type' => Controls_Manager::HEADING,
         ]
      );

      $this->add_control(
         'selected_icon',
         [
            'label' => __( 'Icon', 'fioxen-themer' ),
            'type' => Controls_Manager::ICONS,
            'fa4compatibility' => 'icon',
            'default' => [
               'value' => 'fas fa-home',
               'library' => 'fa-solid',
            ],
         ]
      );
      $this->add_responsive_control(
         'icon_color',
         [
            'label' => __( 'Icon Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-info .content-inner' => 'color: {{VALUE}};',
            ],
         ]
      );
      $this->add_responsive_control(
         'icon_size',
         [
            'label' => __( 'Icon Size', 'fioxen-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
               'size' => 20
            ],
            'range' => [
               'px' => [
                  'min' => 10,
                  'max' => 60,
               ],
            ],
            'selectors' => [
               '{{WRAPPER}} .gva-listing-info .content-inner i' => 'font-size: {{SIZE}}{{UNIT}};',
               '{{WRAPPER}} .gva-listing-info .content-inner svg' => 'width: {{SIZE}}{{UNIT}};'
            ],
         ]
      );

      $this->add_control(
         'heading_style', 
         [
            'label'  => __('Style Content'),
            'type' => Controls_Manager::HEADING,
         ]
      );

      $this->add_responsive_control(
         'text_color',
         [
            'label' => __( 'Text Color', 'fioxen-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .gva-listing-info .info-value' => 'color: {{VALUE}};',
            ],
         ]
      );

      $this->add_group_control(
         Group_Control_Typography::get_type(),
         [
            'name' => 'typography_text',
            'selector' => '{{WRAPPER}} .gva-listing-info .info-value',
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

$widgets_manager->register(new GVAElement_Listing_Item_Information());
