<?php
if( class_exists('WP_Job_Manager_Shortcodes') ){
	remove_action( 'job_manager_job_filters_end', array(WP_Job_Manager_Shortcodes::instance(), 'job_filter_job_types'), 20 );
}

add_filter( 'job_manager_job_listings_output', 'fioxen_layout_listings_page', 10, 1 );

add_theme_support( 'job-manager-templates' );

add_action('admin_enqueue_scripts', 'fioxen_init_listings_scripts', 99);
add_action('wp_enqueue_scripts', 'fioxen_init_listings_scripts', 99);

function fioxen_init_listings_scripts(){
	// Scripts Listings
	$theme = wp_get_theme('fioxen');
	$theme_version = $theme['Version'];

	$map_options = fioxen_map_options();
	if( $map_options['map_source'] == 'google' ){
		wp_register_script('map-api', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=' . esc_attr($map_options['map_api_key']), array( 'jquery' ));
	}

	$listing_js_path = apply_filters( 'fioxen_listing_js_path', FIOXEN_THEME_URL . '/assets/js/listing/listing.js' );

	wp_register_script('leaflet', FIOXEN_THEME_URL . '/assets/js/leaflet/js/leaflet.js');
	wp_register_script('leaflet-markercluster', FIOXEN_THEME_URL . '/assets/js/leaflet/js/leaflet.markercluster.js');
	wp_register_script('leaflet-googlemutant', FIOXEN_THEME_URL . '/assets/js/leaflet/Leaflet.GoogleMutant.js');
	wp_register_script('geocoder-control', FIOXEN_THEME_URL . '/assets/js/leaflet/control.geocoder.js', array( 'jquery' )); 
	wp_enqueue_script('sticky-kit', FIOXEN_THEME_URL . '/assets/js/sticky-kit.js');
	wp_register_script('fioxen-listing', $listing_js_path, array( 'jquery',  'jquery-ui-slider' ));  
	
	wp_register_script('fioxen-listing-fields', FIOXEN_THEME_URL . '/assets/js/listing/listing-fields.js', array( 'jquery' ), $theme_version);  

	wp_register_style('leaflet', FIOXEN_THEME_URL . '/assets/js/leaflet/css/leaflet.css');
	wp_register_style('marker-cluster', FIOXEN_THEME_URL . '/assets/js/leaflet/css/MarkerCluster.css');
	wp_register_style('marker-cluster-default', FIOXEN_THEME_URL . '/assets/js/leaflet/css/MarkerCluster.Default.css');
	wp_register_style('geocoder-control', FIOXEN_THEME_URL . '/assets/js/leaflet/css/Control.Geocoder.css');
	
	wp_localize_script( 'ajax-form', 'fioxen_ajax_object', array( 
	  'ajaxurl' => admin_url( 'admin-ajax.php' ),
	  'security_nonce' => wp_create_nonce( "fioxen-ajax-security-nonce" )
	));
}

function fioxen_layout_listings_page( $html ) {
	
	global $post;

	wp_enqueue_script('map-api');
	wp_enqueue_script('leaflet');
	wp_enqueue_script('leaflet-markercluster');
	wp_enqueue_script('leaflet-googlemutant');
	wp_enqueue_script('geocoder-control');
	wp_enqueue_script('select2');
	wp_enqueue_script('fioxen-listing'); 
  
	wp_enqueue_style('leaflet');
	wp_enqueue_style('marker-cluster');
	wp_enqueue_style('marker-cluster-default');
	wp_enqueue_style('geocoder-control');
	wp_enqueue_style('select2');

	$map_options = fioxen_map_options();
	wp_localize_script( 'fioxen-listing', 'fioxen_map_options', $map_options );
	
	$layout_settings = fioxen_listings_layout_page();
  
	$layout = $layout_settings['layout'];
	$show_map = $layout_settings['show_map_top'];
	$output = '';
	if($layout == 'half_map' || $layout == 'half_map_2'){

		$output .= '<div class="lt--map-layout lt--warpper">';
			$output .= '<div class="lt--content-inner show-content">';
			  
				$output .= '<div class="lt-layout-row half_map-row style-' . esc_attr($layout) . '">';

					$output .= '<div class="half_map-col col-results lt--results-content">';
						$output .= '<div class="lt-content-inner clearfix">';
							
					 		$output .= $html;

						$output .= '</div>';
					$output .= '</div>';

					$output .= '<div class="half_map-col col-map lt--map-content ajax-loading-map">';
						$output .= '<div class="map-full-height map-sticky listing-map-sticky">';
							$output .= '<div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>';
						$output .= '</div>';	
					$output .= '</div>';

				$output .= '</div>'; //End row    

			$output .= '</div>';
		$output .= '</div>';

	}elseif($layout == 'filters_left' || $layout == 'filters_right'){

		$output .= '<div class="lt--filters-slidebar-layout lt--warpper">';
			$output .= '<div class="lt--content-inner">';
					
				$output .= '<div class="lt--results-content">';
					$output .= '<div class="lt-content-inner container">';
						$output .= '<div class="row">';
							
							$output .= $html;

						$output .= '</div>';	
					$output .= '</div>';
				$output .= '</div>';

			$output .= '</div>';
		$output .= '</div>';

  	}elseif($layout == "filters_hidden" ){

	  	$output .= '<div class="lt--hidden-filters-layout lt--warpper">';
			$output .= '<div class="lt--content-inner">';
					
				$output .= '<div class="lt--results-content">';
					$output .= '<div class="lt-content-inner container">';
						$output .= '<div class="row">';
							
							$output .= $html;

						$output .= '</div>';	
					$output .= '</div>';
				$output .= '</div>';

			$output .= '</div>';
		$output .= '</div>';

  	}elseif($layout == 'full_map'){

  		$output .= '<div class="lt--full-map-layout lt--warpper">';
			$output .= '<div class="lt--content-inner show-content">';
			  
				$output .= '<div class="lt-layout-row">';

					$output .= '<div class="lt--results-content d-none">';
						$output .= '<div class="lt-content-inner clearfix">';
							
					 		$output .= $html;

						$output .= '</div>';
					$output .= '</div>';

					$output .= '<div class="lt--map-content">';
						$output .= '<div id="lt-listing--map" class="lt-listing--map lt-map-main hidden-sm hidden-xs"></div>';
					$output .= '</div>';

				$output .= '</div>'; //End row    

			$output .= '</div>';
		$output .= '</div>';

  	}
  return $output;
}

add_filter( 'job_manager_get_listings_result', 'fioxen_listings_custom_results', 10, 2 );
function fioxen_listings_custom_results( $result, $jobs ) {
	$result[ 'found' ] = $jobs->found_posts == 0 ? 0 : $jobs->found_posts;
	if ( isset($_REQUEST['form_data']) ) {
		$form_data = urldecode($_REQUEST['form_data']);
		parse_str($form_data, $data);
		if( 
			(isset($data['_search_location']) && !empty($data['_search_location']) ) ||
			( isset($data['filter_listing_region']) && array($data['filter_listing_region']) && count($data['filter_listing_region']) > 0 && $data['filter_listing_region'][0] > 0 ) || 
			( isset($data['lt_filter_job_type']) && array($data['lt_filter_job_type']) && count($data['lt_filter_job_type']) > 0 && !empty($data['lt_filter_job_type'][0]) ) ||
			( isset($data['lt_filter_price_range']) && !empty($data['lt_filter_price_range']) ) ||
			( isset($data['filter_listing_amenity']) && !empty($data['filter_listing_amenity']) ) 
		){
			$result[ 'showing' ] = sprintf(esc_html__('Search completed. Found %s matching record', 'fioxen'), $jobs->found_posts) . $result['showing_links'];
			$result['showing_links'] = '';
		}
	}

	return $result;
}

add_filter('the_content', 'fioxen_listing_count_views');
function fioxen_listing_count_views($content){
	global $post;
	if ( $post->post_type == 'job_listing' ) {
		$key = '_count_views';
	   $count = get_post_meta($post->ID, $key, true);
	   if( empty($count) ){
	      delete_post_meta($post->ID, $key);
	      add_post_meta($post->ID, $key, 1);
	   }else{
	      $count++;
	      update_post_meta($post->ID, $key, sanitize_text_field($count));
	   }
	}

   return $content;
}

add_filter( 'wp_get_nav_menu_items', 'fioxen_nav_items', 11, 3 );

function fioxen_nav_items( $items, $menu, $args ) {
   $job_dashboard_page_id = get_option('job_manager_job_dashboard_page_id');
   if( is_admin() ){
      return $items;
   }
   foreach($items as $item) {
      if($job_dashboard_page_id == $item->object_id){
         $item->url .= '?dashboard=' . $item->attr_title;
      }
      if($item->attr_title == 'logout'){
      	$item->url = wp_logout_url(get_home_url());
      }
   }
   return $items;
}

function fioxen_job_type_label($fields){
	if(isset($fields['job']['job_type']['label'])){
		$fields['job']['job_type']['label'] = esc_html__( 'Type', 'fioxen' );
	}
	return $fields;
}	

add_filter( 'submit_job_form_fields', 'fioxen_job_type_label', 1 ); 

//Dashboard Page
add_filter('job_manager_get_dashboard_jobs_args', 'fioxen_manager_get_dashboard_jobs_args');
function fioxen_manager_get_dashboard_jobs_args($args){
	$args['posts_per_page'] = 8;
	return $args;
}

function fioxen_register_link(){
	$job_dashboard_page_id = get_option('job_manager_job_dashboard_page_id');
	if($job_dashboard_page_id){
		return get_the_permalink($job_dashboard_page_id) . '?dashboard=register';
	}
	return '';
}