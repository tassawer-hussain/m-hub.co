<?php
use Elementor\Controls_Manager;
if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly.
}

class GVAElement_Post_Thumbnail extends GVAElement_Base{
    const NAME = 'gva_post_thumbnail';
    const TEMPLATE = 'dynamic-tags/';
    const CATEGORY = 'fioxen_post';

    public function get_categories(){
        return array(self::CATEGORY);
    }
    
    public function get_name(){
        return self::NAME;
    }

    public function get_title(){
        return esc_html__('Post Thumbnail', 'fioxen-themer');
    }

    public function get_keywords() {
        return [ 'post', 'thumbnail'];
    }

    protected function register_controls(){
        $this->start_controls_section(
            self::NAME,
            [
                'label' => esc_html__('General', 'fioxen-themer'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control_image_size('full');

        $this->end_controls_section();
    }


    protected function render(){

        parent::render();

        $settings = $this->get_settings_for_display();
        printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
            include $this->get_template(self::TEMPLATE . 'post-thumbnail.php');
        print '</div>';
    }
}

$widgets_manager->register(new GVAElement_Post_Thumbnail());
