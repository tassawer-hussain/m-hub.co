<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly.
}

class GVAElement_Listing_Item_Tags extends GVAElement_Base{
    const NAME = 'gva_listing_item_tags';
    const TEMPLATE = 'listing/item-tags';
    const CATEGORY = 'fioxen_listing';

    public function get_categories(){
        return array(self::CATEGORY);
    }
    
    public function get_name(){
        return self::NAME;
    }

    public function get_title(){
        return esc_html__('Listing Item Tags', 'fioxen-themer');
    }

    public function get_keywords() {
        return [ 'listing', 'item', 'tag'];
    }
    
    protected function register_controls(){
        //--
      $this->start_controls_section(
         self::NAME . '_content',
         [
            'label' => esc_html__('Content', 'fioxen-themer'),
         ]
      );

      $this->add_control(
         'title_text',
         [
            'label'        => esc_html__( 'Title', 'fioxen-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => esc_html__( 'Enter your title', 'fioxen-themer' ),
            'default'      => esc_html__( 'Tags', 'fioxen-themer' ),
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

      $this->end_controls_section();
    }


    protected function render(){
        parent::render();

        $settings = $this->get_settings_for_display();
        include $this->get_template(self::TEMPLATE . '.php');
    }
}

$widgets_manager->register(new GVAElement_Listing_Item_Tags());
