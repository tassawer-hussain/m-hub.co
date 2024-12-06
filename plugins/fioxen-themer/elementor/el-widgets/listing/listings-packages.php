<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_Listings_Packages extends GVAElement_Base{

	const NAME = 'gva-listings-packages';
   const TEMPLATE = 'listing/listings-packages/';
   const CATEGORY = 'fioxen_listing';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __('Listing Packages', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'listings', 'packages', 'purchase', 'carousel', 'grid' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'fioxen-themer'),
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout Display', 'fioxen-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => [
					'grid'      => __( 'Grid', 'fioxen-themer' ),
					'carousel'  => __( 'Carousel', 'fioxen-themer' )
				]
			]
	  	);

	  	$this->end_controls_section();

	  	$this->add_control_carousel(false, array('layout' => 'carousel'));

	  	$this->add_control_grid(array('layout' => 'grid'));

	}

	public static function get_query_args(  $settings ) {
      $defaults = [
         'layout' => 'carousel'
      ];

      $settings = wp_parse_args( $settings, $defaults );
       
      $query_args = [
         'post_type' 				=> 'product',
         'orderby'           		=> 'date',
   		'order'             		=> 'asc',
         'ignore_sticky_posts' 	=> 1,
         'post_status' 				=> 'publish',
         'paged'						=> 1,
         'tax_query' => array(
		      array(
	            'taxonomy' => 'product_type',
	            'field'    => 'slug',
	            'terms'    => 'lt_package', 
		      )
		   )
      ];

      return $query_args;
   }

   public function query_posts() {
      $query_args = $this->get_query_args( $this->get_settings() );
      return new WP_Query( $query_args );
   }

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
		if( !empty($settings['layout']) ){
			include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
		}
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_Listings_Packages());
