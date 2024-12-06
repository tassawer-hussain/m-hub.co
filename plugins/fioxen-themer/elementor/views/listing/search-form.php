<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}
	wp_enqueue_style( 'select2' );
	wp_enqueue_script( 'select2' );

	wp_enqueue_script('map-api');
	wp_enqueue_script('leaflet');
	wp_enqueue_script('leaflet-markercluster');
	wp_enqueue_script('leaflet-googlemutant');
	wp_enqueue_script('geocoder-control');
	wp_enqueue_script('fioxen-listing'); 
  
	wp_enqueue_style('leaflet');
	wp_enqueue_style('marker-cluster');
	wp_enqueue_style('marker-cluster-default');
	wp_enqueue_style('geocoder-control');

	$map_options = fioxen_map_options();
	wp_localize_script( 'fioxen-listing', 'fioxen_map_options', $map_options );
		
	$number_field = 0;
	$has_search_keyword = '';
	if($settings['search_keyword'] == 'yes'){
		$number_field++;
		$has_search_keyword = ' has_search_keyword';
	} 
	$settings['search_category'] == 'yes' ? $number_field++ : false;
	$settings['search_regions'] == 'yes' ? $number_field++ : false;
	$settings['search_location'] == 'yes' ? $number_field++ : false;

  	$this->add_render_attribute( 'block', 'class', [ 'lt-listing-search-form', $settings['style'] ] );

  	$action_link = $settings['url_listings_page'];
  	if( empty($action_link) ){
	  	$job_manager_jobs_page_id = get_option( 'job_manager_jobs_page_id' );
		if($job_manager_jobs_page_id){
			$action_link = get_permalink($job_manager_jobs_page_id);
		}
	}
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
	<form class="lt-search-form-main" action="<?php echo esc_url($action_link) ?>" role='search'>

		<div class="search-form-content">
			
			<div class="search-form-fields clearfix cols-<?php echo esc_attr($number_field) . $has_search_keyword ?>">
				<?php if($settings['search_keyword'] == 'yes'){ ?>
					<div class="search_keywords">
						<div class="content-inner">
							<i class="icon fa-solid fa-globe"></i>
							<input type="text" name="search_keywords" class="lt-search-keyword-autocomplete" id="search_keywords" placeholder="<?php echo $settings['placeholder_keyword']; ?>" value="" autocomplete="off" />
							<div class="keyword_list_autocomplete" style="display:none;"></div>
						</div>
					</div>
				<?php } ?>	

				<?php if($settings['search_category'] == 'yes'){ ?>
					<div class="search_categories search-filter-wrapper">
						<div class="content-inner">
							<?php 
								job_manager_dropdown_categories( array(
								 	'taxonomy' => 'job_listing_category',
								 	'hierarchical' => 1,
								 	'show_option_all' => $settings['placeholder_category'],
								 	'placeholder' => $settings['placeholder_category'],
								 	'name' => 'search_categories',
									'class'	=> 'option-select2-filter',
								 	'orderby' => 'name',
								 	'multiple' => false,
								 	'hide_empty'    => false ) 
								 ); 
							?>
						</div>	
					</div>
				<?php } ?>
				
				<?php if($settings['search_regions'] == 'yes'){ ?>
					<div class="search_regions search-filter-wrapper">
						<div class="content-inner">
							<?php 
								job_manager_dropdown_categories( array( 
									'taxonomy' => 'job_listing_region', 
									'hierarchical' => 1, 
									'show_option_all' => $settings['placeholder_region'], 
									'placeholder' => $settings['placeholder_region'], 
									'name' => 'region', 
									'class'	=> 'option-select2-filter',
									'orderby' => 'name', 
									'multiple' => false, 
									'hide_empty' => false ) 
								); 
							?>
						</div>	
					</div>
				<?php } ?>

				<?php if($settings['search_location'] == 'yes'){ ?>
					<div class="lt_search_location">
						<div class="content-inner">
							<i class="icon fa-solid fa-location-arrow"></i>
							<div class="search-location-inner">
								<input type="text" class="id_listing_location_text" name="_search_location" id="lt_input_search_location" placeholder="<?php echo $settings['placeholder_location']; ?>" value="" autocomplete="off" />
								<div class="places_list_autocomplete" style="display:none;"></div>
							</div>
							<input type="hidden" class="job-manager-filter" id="lt_filter_location_value" name="lt_filter_location_value" value="" />
						</div>
					</div>
				<?php } ?>	
			</div>
			<input type="hidden" name="axx" value="<?php echo rand(0,10000) ?>" />
			<div class="form-action">
				<button class="btn-theme btn-action" type="submit">
					<i class="fi flaticon-magnifying-glass"></i>
					<?php echo $settings['btn_text'] ? $settings['btn_text'] : esc_html__("Search","fioxen-themer") ?>
				</button>
			</div>

	  </div>
	  
	</form>
</div>