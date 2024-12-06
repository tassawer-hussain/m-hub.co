<?php
class Fioxen_Filter{

	public function __construct(){
		add_filter( 'job_manager_get_listings', array($this,'filter_fields_query_args'), 10, 2 );
		add_filter( 'posts_where', array($this, 'title_filter'), 10, 2 );
		add_filter( 'job_listing_searchable_meta_keys', array($this, 'job_listing_searchable_meta_keys'), 10, 2 );
	}

	function job_listing_searchable_meta_keys(){
		return array();
	}

	function filter_by_amenities_field__() {
		echo '<div class="filter-by-amenities">';
			echo '<ul class="amenities-list">';

				if ( empty( $field['default'] ) ) {
					$field['default'] = array();
				}

				$values = isset( $field['value'] ) ? $field['value'] : ( is_array( $field['default'] ) ? $field['default'] : [ $field['default'] ] );
				 
				$terms = get_terms( array(
					'taxonomy' => 'job_listing_amenity',
					'hide_empty' => false,
				));

				$categories = array();
				$categories_query = get_terms( array(
					'taxonomy'   => 'job_listing_category',
					'hide_empty' => false,
				));

				foreach ($categories_query as $category) {
					$categories[$category->slug] = $category->term_id;
				}

				if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
					foreach ($terms as $term) {
						$term_amenity_cats_slug = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'gva_amenity_categories', true ) : false;
						$term_amenity_cats_class_array = array();
						foreach ($term_amenity_cats_slug as $amenity_cat_slug) {
							if($categories[$amenity_cat_slug] && $categories[$amenity_cat_slug]){
								$term_amenity_cats_class_array[] = 'cat-' . $categories[$amenity_cat_slug];
							}
						}
						$term_amenity_cats_class = count($term_amenity_cats_class_array) > 0 ? implode(' ', $term_amenity_cats_class_array) : 'cat-all';
						echo '<li class="amenity-cat-item ' .  $term_amenity_cats_class . '"><label style="display: block">';
							echo ('<input class="job-manager-filter" name="filter_listing_amenity[]" type="checkbox" value="' . $term->term_id . '"' . ( in_array($term->term_id, $values) ? 'checked="checked"' : '' ) . '/>' . $term->name);
						echo '</label></li>';
					}
				}
			echo '</ul>';
		echo '</div>';     
	 }

	function title_filter( $where, $wp_query ){
	   global $wpdb;
	    // 2. pull the custom query in here:
	   if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
	      $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
	   }
	   return $where;
	}

	function filter_fields_query_args( $query_args, $args ) {
		if ( isset($_POST['form_data']) ):
			parse_str( $_POST['form_data'], $form_data );
			
			// If this is set, we are filtering by fields
			$tax_querys = array();

			//Filter by title
			if(get_option('lt_search_keywords_type') == 'only_title'){
				if ( isset($form_data['search_keywords'] ) && !empty( $form_data['search_keywords'] ) ) {
					$search_title = $form_data['search_keywords'];
					$query_args['search_prod_title'] = trim($search_title);
				}
			}

			//Filter by amenities
			if ( isset($form_data['filter_listing_amenity'] ) && !empty( $form_data['filter_listing_amenity'] ) ) {
				$amenities_data =  $form_data['filter_listing_amenity'];
				$query_args['tax_query'][] = array(
					'taxonomy'         => 'job_listing_amenity',
					'field'            => 'term_id',
					'terms'            => $amenities_data,
					'operator'         => 'IN'
				);
			}

			//Filter by regions
			if ( isset($form_data['filter_listing_region'] ) && !empty( $form_data['filter_listing_region'] ) ) {
				$region_data =  $form_data['filter_listing_region'];
				if(count($region_data) == 2){
					//if($region_data[0] == '') $region_data[1] = '';
				}
				foreach ($region_data as $value) {
					if ( !empty($value) ) {
						$query_args['tax_query'][] = array(
							'taxonomy'         => 'job_listing_region',
							'field'            => 'term_id',
							'terms'            => $value,
							'operator'         => 'IN'
						);
					}
				}
			}

			//Filter by type
			if ( isset($form_data['lt_filter_job_type'] ) && !empty( $form_data['lt_filter_job_type']) ) {
				$type_data = array_filter($form_data['lt_filter_job_type']);
				if( count($type_data) ){
					$query_args['tax_query'][] = array(
						'taxonomy'         => 'job_listing_type',
						'field'            => 'slug',
						'terms'            => $type_data,
						'operator'         => 'IN'
					);
				}
			}

			//Filter by tags
			if (isset($form_data['lt_filter_tag']) && $form_data['lt_filter_tag']) {
				$query_args['tax_query'][] = array(
					'taxonomy'         => 'job_listing_tag',
					'field'            => 'slug',
					'terms'            => $form_data['lt_filter_tag'],
					'operator'         => 'IN'
				);
			}

			// Join tax query
			$tax_querys = $query_args['tax_query'];
			$query_args['tax_query'] = array();

			if( $tax_querys && is_array($tax_querys) ){
				if ( count($tax_querys) > 1 ) {
					$query_args['tax_query']['relation'] = 'AND';
				}
				foreach ($tax_querys as $tax_query) {
					$query_args['tax_query'][] = $tax_query;
				}
			}

			//Filter by Location
			if ( isset($form_data['lt_filter_location_value']) && !empty( $form_data['lt_filter_location_value']) ) {
				$location_data =  $form_data['lt_filter_location_value'];
				$lt_filter_distance = (isset($form_data['lt_filter_distance']) && $form_data['lt_filter_distance']) ? $form_data['lt_filter_distance'] : 50;
				//$lt_filter_distance = 50;
				//echo $lt_filter_distance;
				//$location_data = '40.7127281,-74.0060152';
				$use_miles = false; // use KM

				$distance_unit = fioxen_themer_get_theme_option('lt_distance_unit', 'km');
				if($distance_unit = 'km'){
					$use_miles = false;
				}else{
					$use_miles = true;
				}

				if(!empty($location_data)){
					$lat_lng = explode(',', $location_data);
					$lat = isset($lat_lng[0]) && $lat_lng[0] ? $lat_lng[0] : '';
					$lng = isset($lat_lng[1]) && $lat_lng[1] ? $lat_lng[1] : '';

					$ids = $this->get_nearby_locations($lat, $lng, -1, $lt_filter_distance, 99, 'job_listing', $use_miles);
					$ids[] = 0;
					$query_args['post__in'] = $ids;
				}else{
					if ( isset($form_data['_search_location']) && !empty($form_data['_search_location']) ) {
						$location_meta_keys = [ 'geolocation_formatted_address', '_job_location', 'geolocation_state_long' ];
						$location_search    = [ 'relation' => 'OR' ];
						foreach ( $location_meta_keys as $meta_key ) {
							$location_search[] = [
								'key'     => $meta_key,
								'value'   => $form_data['_search_location'],
								'compare' => 'like'
							];
						}
						$query_args['meta_query'][] = $location_search;
					}
				}
			}

			if ( isset($form_data['lt_filter_price_range']) && !empty( $form_data['lt_filter_price_range']) ) {
				$price_range = $form_data['lt_filter_price_range'];
				$query_args['meta_query'][] = array(
					'key'     => '_lt_price_range',
					'value'   => $price_range,
					'compare' => 'like'
				);
			}

			// ======== Order ========
			if ( isset($form_data['lt_results_sorting']) && !empty($form_data['lt_results_sorting']) ) {
				$sorting = $form_data['lt_results_sorting'];
				switch ($sorting) {
					case 'default':
						$query_args['orderby'] = array(
							'menu_order'	=> 'ASC',
							'date'			=> 'DESC',
							'ID'				=> 'DESC'
						);
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

					case 'date':
         			$query_args['orderby']		= 'date';
         			$query_args['order']			= 'DESC';
					break;

					case 'date-old': 
						$query_args['orderby']		= 'date';
         			$query_args['order']			= 'ASC';
					break;

					case 'featured':
						$query_args['meta_key']		= '_featured';
						$query_args['orderby']  	= array(
         				'meta_value' => 'DESC',
         				'date' 			  => 'DESC'
         			);
         			$query_args['order']			= 'DESC';
					break;

					case 'random':
         			$query_args['orderby']		= 'rand';
         			$query_args['order']			= 'DESC';
					break;

					default:
						$query_args['orderby'] = Array(
							'menu_order'	=> 'ASC',
							'date'			=> 'DESC',
							'ID'				=> 'DESC'
						);
					break;
				}
			}

		endif;

		return $query_args;
	 }

	/* source 
	* https://wordpress.stackexchange.com/questions/61775/how-to-query-posts-based-on-lat-lng-coordinate-as-post-meta
	* https://ourcodeworld.com/articles/read/1019/how-to-find-nearest-locations-from-a-collection-of-coordinates-latitude-and-longitude-with-php-mysql
	*/
	public function get_nearby_locations( $lat, $lng, $min_distance = 0, $max_distance = 100, $limit = 99, $post_type = 'job_listing', $use_miles = false ) {
		global $wpdb;
		
		$meta_lat_key = '_lt_map_latitude';
		$meta_lng_key = '_lt_map_longitude';

		$miles_to_km = $use_miles ? 1 : 1.609344;
		
		$query = "SELECT DISTINCT
			lat.post_id,
			lt.post_title,
			lat.meta_value as latitude,
			lng.meta_value as longitude,
			((ACOS(SIN(%f * PI() / 180) * SIN(lat.meta_value * PI() / 180) + COS(%f * PI() / 180) * COS(lat.meta_value * PI() / 180) * COS((%f - lng.meta_value) * PI() / 180)) * 180 / PI()) * 60 * 1.1515 * {$miles_to_km}) AS distance
			FROM {$wpdb->postmeta} AS lat
			LEFT JOIN {$wpdb->postmeta} as lng ON lat.post_id = lng.post_id
			INNER JOIN {$wpdb->posts} as lt ON lt.ID = lat.post_id
			WHERE lat.meta_key = %s AND lng.meta_key = %s AND lt.post_type = %s
			HAVING distance > %d AND distance < %d ORDER BY distance ASC LIMIT %d;";
	

		$prepared_query = $wpdb->prepare( $query, [ $lat, $lat, $lng, $meta_lat_key, $meta_lng_key, $post_type, $min_distance, $max_distance, $limit ] );
			
		$wp_query = $wpdb->get_results( $prepared_query );
		$ids = [];
		if($wp_query && is_array($wp_query) && count($wp_query) > 0){
			foreach ($wp_query as $lt) {
				$ids[] = $lt->post_id;
			}
		}
		return $ids;
	}
}

new Fioxen_Filter();