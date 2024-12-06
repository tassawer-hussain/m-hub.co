<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Utils;

class GVAElement_Rev_Slider extends \Elementor\Widget_Shortcode{

    const NAME = 'gva-rev-slider';
    const TEMPLATE = 'plugins/rev-slider';
    const CATEGORY = 'fioxen_general';

    public function get_name() {
        return self::NAME;
    }

    public function get_categories() {
        return array(self::CATEGORY);
    }

    public function get_title() {
        return __('GVA Revolution Slider', 'fioxen-themer');
    }

    public function get_keywords() {
        return [ 'revolution', 'slider', 'images' ];
    }

    protected function register_controls() {
        $slider = new RevSlider();
        $arrSliders = $slider->getArrSliders();

        $revsliders = array('' => '-- Choose Slider --');
        if ( $arrSliders ) {
            foreach ( $arrSliders as $slider ) {
                $revsliders[ $slider->getAlias() ] = $slider->getTitle();
            }
        } else {
            $revsliders[ __( 'No sliders found', 'fioxen-themer' ) ] = 0;
        }

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'fioxen-themer'),
            ]
        );
        $this->add_control(
            'alias_slider',
            [
                'label'   => __( 'Choose Slider:', 'fioxen-themer' ),
                'type'    => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => $revsliders
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
       global $rs_loaded_by_editor;
      if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) $rs_loaded_by_editor = true;
      $settings = $this->get_settings_for_display();
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
        include(GAVIAS_FIOXEN_PLUGIN_DIR . 'elementor/views/plugins/rev-slider.php');
      print '</div>';
      if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) $rs_loaded_by_editor = false;
    }
}

$widgets_manager->register(new GVAElement_Rev_Slider());
