<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Map extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_map';
   const TEMPLATE = 'listing/item-map';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Listing Item Map', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'map' ];
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
         'heading_title',
         [
            'label' => esc_html__( 'Have No Settings', 'fioxen-themer' ),
            'type' => Controls_Manager::HEADING
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

$widgets_manager->register(new GVAElement_Listing_Item_Map());
