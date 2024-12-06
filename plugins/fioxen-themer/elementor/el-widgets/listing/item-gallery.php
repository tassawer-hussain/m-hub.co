<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;

class GVAElement_Listing_Item_Gallery extends GVAElement_Base{
    
   const NAME = 'gva_lt_item_gallery';
   const TEMPLATE = 'listing/item-gallery';
   const CATEGORY = 'fioxen_listing';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('Listing Item Gallery', 'fioxen-themer');
   }

   public function get_keywords() {
      return [ 'listing', 'item', 'gallery' ];
   }

   public function get_script_depends() {
      return [
         'swiper',
         'gavias.elements'
      ];
    }

    public function get_style_depends() {
        return array('swiper');
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
         'style',
         [
            'label' => __( 'Style', 'fioxen-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style-1'      => __( 'Style I: Gallery I', 'fioxen-themer' ),
               'style-2'      => __( 'Style I: Gallery II', 'fioxen-themer' ),
               'style-3'      => __( 'Style III: Background Image Featured', 'fioxen-themer' ),
            ],
            'default' => 'style-1',
         ]
      );

      $this->add_responsive_control(
         'background_height',
         [
            'label' => __( 'style', 'fioxen-themer' ),
            'type' => Controls_Manager::SLIDER,
            'default' => [
              'size' => 600,
            ],
            'range' => [
              'px' => [
                'min' => 100,
                'max' => 1000,
              ],
            ],
            'selectors' => [
              '{{WRAPPER}} .gva-listing-gallery.style-3 .background-image' => 'min-height: {{SIZE}}{{UNIT}};background-size: cover;background-position:center center;',
            ],
            'condition' => [
               'style' => array('style-3')
            ]
         ]
      );

      $this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image', 
            'default'   => 'fioxen_medium',
            'separator' => 'none',
         ]
      );

      $this->add_control(
         'show_media',
         [
            'label' => __( 'Show Media', 'fioxen-themer' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
         ]
      );

      $this->end_controls_section();

      $this->add_control_carousel( false, array('style' => ['style-1', 'style-2']) );
   }

   protected function render(){
      parent::render();

      $settings = $this->get_settings_for_display();
      include $this->get_template(self::TEMPLATE . '.php');
   }
}

$widgets_manager->register(new GVAElement_Listing_Item_Gallery());
