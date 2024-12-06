<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Video_Carousel extends GVAElement_Base{
	const NAME = 'gva-video-carousel';
	const TEMPLATE = 'general/video-carousel';
	const CATEGORY = 'fioxen_general';
	
	public function get_categories(){
      return array(self::CATEGORY);
   }
    
   public function get_name(){
      return self::NAME;
   }

	public function get_title() {
		return __('Video Carousel', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'video', 'content', 'carousel' ];
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
	  	$this->start_controls_section(
			'section_videos',
			[
				'label' => __('Videos', 'fioxen-themer'),
			]
	  	);

		$repeater = new Repeater();
		  
	  	$repeater->add_control(
			'video_title',
			[
			 	'label'       => __('Title', 'fioxen-themer'),
			 	'type'        => Controls_Manager::TEXT,
			 	'placeholder' => 'Add your title',
			 	'label_block' => true
			]
	  	);
	  	$repeater->add_control(
			'video_image',
			[
				 'label'      => __('Choose Image', 'fioxen-themer'),
				 'default'    => [
					  'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
				 ],
				 'type'       => Controls_Manager::MEDIA,
			]
	  	);
	  	$repeater->add_control(
			'video_link',
			[
				 'label'   => __('Video Link', 'fioxen-themer'),
				 'default' => 'https://www.youtube.com/watch?v=knTiUD5IAww',
				 'type'    => Controls_Manager::TEXT,
				 'description' => esc_html__( 'You can add youtube/vimeo video link', 'fioxen-themer' )
			]
	  	);
		 
	  	$this->add_control(
			'videos_content',
			[
				 'label'       => __('Video Content', 'fioxen-themer'),
				 'type'        => Controls_Manager::REPEATER,
				 'fields'      => $repeater->get_controls(),
				 'title_field' => '',
				 'default'     => array(
					  array(
							'video_image'    => [
								 'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
							],
							'video_link'      => 'https://www.youtube.com/watch?v=knTiUD5IAww',
					  ),
					  array(
							'video_image'    => [
								 'url' => GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
							],
							'video_link'      => 'https://www.youtube.com/watch?v=knTiUD5IAww',
					  ),

				 ),
			]
	  	);

	  	$this->add_group_control(
			Elementor\Group_Control_Image_Size::get_type(),
			[
				 'name'      => 'video_image', 
				 'default'   => 'full',
				 'separator' => 'none',
			]
	  	);

	  	$this->add_control(
			'view',
			[
				 'label'   => __('View', 'fioxen-themer'),
				 'type'    => Controls_Manager::HIDDEN,
				 'default' => 'traditional',
			]
	  	);
	  	$this->end_controls_section();

		$this->add_control_carousel( false, array());

	  	// Title Styling
	  	$this->start_controls_section(
			'section_style_name',
			[
				 'label' => __('Title', 'fioxen-themer'),
				 'tab'   => Controls_Manager::TAB_STYLE,
			]
	  	);
	  	$this->add_control(
			'title_text_color',
			[
				 'label'     => __('Text Color', 'fioxen-themer'),
				 'type'      => Controls_Manager::COLOR,
				 'default'   => '',
				 'selectors' => [
					  '{{WRAPPER}} .testimonial-name, {{WRAPPER}} .testimonial-name a' => 'color: {{VALUE}};',
				 ],
			]
	  	);
	  	$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				 'name'     => 'title_typography',
				 'selector' => '{{WRAPPER}} .testimonial-name',
			]
	  	);
	  	$this->end_controls_section();
 	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
		  include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	}

}
$widgets_manager->register(new GVAElement_Video_Carousel());
