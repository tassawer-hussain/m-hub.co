<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_Listings extends GVAElement_Base{
	const NAME = 'gva-listings';
	const TEMPLATE = 'listing/all-items/';
	const CATEGORY = 'fioxen_listing';

	public function get_name() {
		return self::NAME;
	}
	
	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_title() {
		return esc_html__('All Items Listing', 'fioxen-themer');
	}

	public function get_keywords() {
		return [ 'listings', 'content', 'carousel', 'grid' ];
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

	private function get_categories_list($taxonomy){
		$categories = array();

		$categories['none'] = esc_html__( 'None', 'fioxen-themer' );
		$tax_terms = get_terms( $taxonomy );
		if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
		  foreach( $tax_terms as $item ) {
			 $categories[$item->term_id] = $item->name;
		  }
		}
		return $categories;
	}

	private function get_posts() {
		$posts = array();

		$loop = new \WP_Query( array(
			'post_type' => array('tribe_events'),
			'posts_per_page' => -1,
			'post_status'=>array('publish'),
		) );

	  	$posts['none'] = esc_html__('None', 'fioxen-themer');

	  	while ( $loop->have_posts() ) : $loop->the_post();
			$id = get_the_ID();
			$title = get_the_title();
			$posts[$id] = $title;
	  	endwhile;

		wp_reset_postdata();

		return $posts;
	}

	protected function register_controls() {
	  	$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__('Query & Layout', 'fioxen-themer'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
	  	);

	  	$this->add_control(
		 	'category_ids',
		 	[
				'label' => esc_html__( 'Select By Category', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default' => '',
				'options'   => $this->get_categories_list('job_listing_category')
		 	]
	  	);

	  	$this->add_control(
		 	'region_ids',
		 	[
				'label' => esc_html__( 'Select By Region', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default' => '',
				'options'   => $this->get_categories_list('job_listing_region')
		 	]
	  	);

		$this->add_control(
		 	'type_ids',
		 	[
				'label' => esc_html__( 'Select By Type', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default' => '',
				'options'   => $this->get_categories_list('job_listing_type')
		 	]
		);

		$this->add_control(
		 	'tag_ids',
		 	[
				'label' => esc_html__( 'Select By Tags', 'fioxen-themer' ),
				'type' => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default' => '',
				'options'   => $this->get_categories_list('job_listing_tag')
		 	]
		);

	  	$this->add_control(
			'post_ids',
			[
			 	'label' => esc_html__( 'Select Individually', 'fioxen-themer' ),
			 	'type' => Controls_Manager::SELECT2,
			 	'default' => '',
			 	'multiple'    => true,
			 	'label_block' => true,
			 	'options'   => $this->get_posts()
			]  
	  	);

	  	$this->add_control(
			'is_featured',
			[
				'label'     => esc_html__('Featured', 'fioxen-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no'
			]
	  	);

	  	$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'fioxen-themer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
	  	);

	  	$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'fioxen-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
				  	'post_date'  => esc_html__( 'Date', 'fioxen-themer' ),
				  	'rating'  	=> esc_html__( 'Rating', 'fioxen-themer' ),
				  	'featured'  	=> esc_html__( 'Featured', 'fioxen-themer' ),
				  	'post_title' => esc_html__( 'Title', 'fioxen-themer' ),
				  	'rand'       => esc_html__( 'Random', 'fioxen-themer' ),
				],
			]
	  	);

	  	$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'fioxen-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__( 'ASC', 'fioxen-themer' ),
					'desc' => esc_html__( 'DESC', 'fioxen-themer' ),
				],
				'condition' => [
					'orderby' => ['post_date', 'post_title']
				],
			]
	  	);

	  	$this->add_control( // xx Layout
			'layout_heading',
			[
				'label'   => esc_html__( 'Layout', 'fioxen-themer' ),
				'type'    => Controls_Manager::HEADING,
			]
	  	);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout Display', 'fioxen-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => [
					'carousel'  => esc_html__( 'Carousel', 'fioxen-themer' ),
					'grid'      => esc_html__( 'Grid', 'fioxen-themer' )
				]
			]
	  	);
	  	$this->add_control(
			'style',
			[
				 'label'     => esc_html__('Style', 'fioxen-themer'),
				 'type'      => \Elementor\Controls_Manager::SELECT,
				 'options' => [
					  'grid-1'                => esc_html__( 'Item Style I', 'fioxen-themer' ),
					  'grid-2'                => esc_html__( 'Item Style II', 'fioxen-themer' ),
					  'grid-3'                => esc_html__( 'Item Style III', 'fioxen-themer' ),
					  'grid-4'                => esc_html__( 'Item Style IV', 'fioxen-themer' ),
				 ],
				  'default' => 'grid-1',
			]
	  	);
	  	$this->add_control(
			'image_size',
			[
				'label'     => esc_html__('Image Size', 'fioxen-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'fioxen_medium'
			]
		);
		$this->add_control(
			'show_tagline',
			[
				 'label'     => esc_html__('Show Tagline', 'fioxen-themer'),
				 'type'      => Controls_Manager::SWITCHER,
				 'default'   => 'no'
			]
	  	);
		$this->add_control(
			'show_rating',
			[
				 'label'   => esc_html__( 'Rating Display', 'fioxen-themer' ),
				 'type'    => Controls_Manager::SELECT,
				 'default' => 'number',
				 'options' => [
					  ''      	=> esc_html__( 'Hidden', 'fioxen-themer' ),
					  'star'  	=> esc_html__( 'Star', 'fioxen-themer' ),
					  'number'  => esc_html__( 'Number', 'fioxen-themer' )
				 ]
			]
	  	);
	  	$this->add_control(
			'pagination',
			[
				 'label'     => esc_html__('Pagination', 'fioxen-themer'),
				 'type'      => Controls_Manager::SWITCHER,
				 'default'   => 'no',
				 'condition' => [
					  'layout' => ['grid', 'list']
				 ],
			]
	  	);

		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

	}

	public static function get_query_args(  $settings ) {
	  	$defaults = [
			'post_ids'        => '',
			'category_ids'    => '',
			'region_ids'      => '',
			'type_ids'			=> '',
			'tag_ids'			=> '',
			'is_featured'		=> 'no',
			'orderby'         => 'date',
			'order'           => 'desc',
			'posts_per_page'  => 6,
			'offset'          => 0,
			'show_rating'		=> 'number'
	  	];

	  	$settings = wp_parse_args( $settings, $defaults );
	  	$cats = $settings['category_ids'];
	  	$regions = $settings['region_ids'];
	  	$types = $settings['type_ids'];
	  	$tags = $settings['tag_ids'];
	  	$ids = $settings['post_ids'];

	  	$query_args = [
			'post_type'=>array('job_listing'),
			'posts_per_page' => $settings['posts_per_page'],
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish', 
	  	];
		
		switch ( $settings['orderby'] ) {
			case 'post_date':
				$query_args['orderby']		= 'date';
				$query_args['order']			= $settings['order'];
			break;

			case 'rating':
				$query_args['meta_query'][] = array(
					'relation' => 'OR',
					'key_reviews_average_value' => array(
						'key' => 'lt_reviews_average',
					),
					'key_reviews_average' => array(
						'key' => 'lt_reviews_average',
						'compare' => 'NOT EXISTS',
					)
				);

				$query_args['orderby']  	= array(
					'key_reviews_average_value' => 'DESC',
					'key_reviews_average' => 'DESC',
					'date' 			  => 'DESC'
				);
				$query_args['order']       = 'DESC';
			break;

			case 'featured':
				$query_args['meta_key']		= '_featured';
				$query_args['orderby']  	= array(
					'meta_value' => 'DESC',
					'date' 			  => 'DESC'
				);
				$query_args['order']			= 'DESC';
			break;

			case 'rand':
				$query_args['orderby']		= 'rand';
				$query_args['order']			= $settings['order'];
			break;

			default:
				$query_args['orderby'] = Array(
					'menu_order'	=> 'ASC',
					'date'			=> 'DESC',
					'ID'				=> 'DESC'
				);
			break;
		}

		if($settings['is_featured'] == 'yes'){
			$query_args['meta_query'][] = array(
				'key'     => '_featured',
				'value'   => 1,
				'compare' => '='
			);
		}

	  	if($cats){
			if( is_array($cats) && count($cats) > 0 ){
				$field_name = is_numeric($cats[0]) ? 'term_id':'slug';
				$query_args['tax_query'][] = array(
					array(
						'taxonomy' => 'job_listing_category',
						'terms' => $cats,
						'field' => $field_name,
						'include_children' => false
					)
				);
			}
	  	}

	  	if($regions){
			if( is_array($regions) && count($regions) > 0 ){
				$field_name = is_numeric($regions[0]) ? 'term_id':'slug';
				$query_args['tax_query'][] = array(
					array(
						'taxonomy' => 'job_listing_region',
						'terms' => $regions,
						'field' => $field_name,
						'include_children' => false
					)
				);
			}
	  	}

	  	if($types){
			if( is_array($types) && count($types) > 0 ){
				$field_name = is_numeric($types[0]) ? 'term_id':'slug';
				$query_args['tax_query'][] = array(
					array(
						'taxonomy' => 'job_listing_type',
						'terms' => $types,
						'field' => $field_name,
						'include_children' => false
					)
				);
			}
	  	}

	  	if($tags){
			if( is_array($tags) && count($tags) > 0 ){
				$field_name = is_numeric($tags[0]) ? 'term_id':'slug';
				$query_args['tax_query'][] = array(
					array(
						'taxonomy' => 'job_listing_tag',
						'terms' => $tags,
						'field' => $field_name,
						'include_children' => false
					)
				);
			}
	  	}

		// Join tax query
		if(isset($query_args['tax_query']) && $query_args['tax_query']){
			$tax_querys = $query_args['tax_query'];
			$query_args['tax_query'] = array();

			if( $tax_querys && is_array($tax_querys) ){
				if( count($tax_querys) == 1 ){
					$query_args['tax_query'] = $tax_querys[0];
				 }
				if ( count($tax_querys) > 1 ) {
					$query_args['tax_query']['relation'] = 'AND';
					foreach ($tax_querys as $tax_query) {
						$query_args['tax_query'][] = $tax_query;
					}
				}
			}
		}

		// Listing ids
	  	if( $ids ){
		 	if( is_array($ids) && count($ids) > 0 ){
				$query_args['post__in'] = $ids;
				$query_args['orderby'] = 'post__in';
		 	}
	  	}

	  	if(is_front_page()){
			$query_args['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
	  	}else{
			$query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
	  	}

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

$widgets_manager->register(new GVAElement_Listings());
