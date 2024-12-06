<?php

if (!defined('ABSPATH')) {
	 exit; // Exit if accessed directly.
}
use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Template_Content extends  GVAElement_Base {

    public function get_categories(){
        return array('fioxen_layout');
    }

	public function get_name(){
		return 'gva-template_content';
	}

	public function get_title(){
		return __('GVA Tempate Content', 'fioxen-themer');
	}

	public function get_keywords(){
		return [ 'content', 'template'];
	}

	public function get_icon(){
		return 'eicon-content';
	}

	public function get_script_depends(){
		return array();
	}

	public function get_style_depends(){
		return array();
	}

	public function show_in_panel(){
      if (!is_singular('gva__template')){
         return false;
      }

      global $post;
      $template_type = get_post_meta($post->ID, 'gva_template_type', true);
      if($template_type == 'page_layout'){
      	return true;
      }

      return false;
      
   }

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('General', 'fioxen-themer'),
			]
	  	);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'fioxen-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'fioxen-themer' ),
			]
		);
		$this->end_controls_section();
	}

	protected function render(){
		global $post;

		$post_type = isset($post->post_type) ? $post->post_type : false;

		if($post_type === 'page'){

			get_template_part('templates/page/content');
			
			return;
		}

		if($post_type==='attachment') {
			get_template_part('templates/attachment');
			return;
		}
		
		if(class_exists('WooCommerce')){
			if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()){
				wc_get_template_part('archive', 'content');
				return;
			}
		}

		if($post_type === 'gva__template'){
			$template_type = get_post_meta($post->ID, 'gva_template_type', true);
			if($template_type == 'page_layout'){
				echo '<div style="padding: 300px 30px 250px;background: #525252;">';
			 		echo '<h1 style="color: #fff;text-align: center;">' . esc_html__('Your page content will be displayed here', 'fioxen-themer') . '</h1>';
			 	echo '</div>';
			}else{
			 	the_content();
			}
			return;
		}
		
		get_template_part('templates/page/content');

	}
}

$widgets_manager->register(new GVAElement_Template_Content());
