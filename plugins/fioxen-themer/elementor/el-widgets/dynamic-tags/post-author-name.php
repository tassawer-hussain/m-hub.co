<?php
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH')) {
   exit; // Exit if accessed directly.
}

class GVAElement_Post_Author_Name extends GVAElement_Base{
    const NAME = 'gva_author_name';
    const TEMPLATE = 'dynamic-tags/';
    const CATEGORY = 'fioxen_post';

    public function get_categories(){
        return array(self::CATEGORY);
    }

    public function get_name(){
        return self::NAME;
    }

    public function get_title(){
        return esc_html__('Post Author Name', 'fioxen-themer');
    }

    public function get_keywords(){
        return [ 'post', 'author', 'name'];
    }
    
    protected function register_controls(){
        $this->start_controls_section(
            self::NAME,
            [
                'label' => esc_html__('General', 'fioxen-themer'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__('Display Icon', 'fioxen-themer'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => '1',
                'default' => '1'
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Color', 'fioxen-themer' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} a',
            ]
        );


        $this->end_controls_section();
    }


    protected function render(){

        parent::render();

        $settings = $this->get_settings_for_display();
        printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
            include $this->get_template(self::TEMPLATE . 'post-author-name.php');
        print '</div>';
    }
}

$widgets_manager->register(new GVAElement_Post_Author_Name());
