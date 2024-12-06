<?php
function fioxen_map_options(){
	$option = array(
		'map_source' 				=> fioxen_get_option('lt_map_source', 'mapbox'),
		'latitude'					=> fioxen_get_option('lt_default_latitude', '40.749402'),
		'longitude'					=> fioxen_get_option('lt_default_longitude', '-74.1752547'),
		'map_zoom'					=> fioxen_get_option('lt_map_zoom', '14'),
		'google_map_style'		=> fioxen_get_option('lt_google_map_style', ''),
		'mapbox_token'				=> fioxen_get_option('lt_mapbox_token', ''),
		'mapbox_style'				=> fioxen_get_option('lt_mapbox_style', 'streets-v11'),
		'map_api_key'				=> fioxen_get_option('map_api_key', ''),
		'mode'						=> 'map'
	);
	return $option;
}

function fioxen_listing_info($post_id, $prefix = ''){
	$data = array(
		'phone'		=> get_post_meta( $post_id, '_lt_phone', true ),
		'address'	=> get_post_meta( $post_id, '_lt_address', true ),
		'email'		=> get_post_meta( $post_id, '_lt_email', true ),
		'website'	=> get_post_meta( $post_id, '_lt_website', true ),
	);
	return $data;
}

function fioxen_lising_single_cover_style($post_id){
	$style = get_post_meta( $post_id, '_lt_single_style', true );
	if( empty($style) ){
		$style = "cover_gallery";
	}
	$photos = get_post_meta( $post_id, '_lt_gallery_images', true );
	if( empty($photos) ){
		$style = "cover_image";
	}
	if( is_array($photos) && count($photos) == 0 ){
		$style = "cover_image";
	}
	return $style;
}

function fioxen_listings_layout_page(){
	global $post;
	$layout = $layout_items = $show_map_top = $grid_columns = $per_page = $pagination_style = '';
	$grid_columns_lg = $grid_columns_md = $grid_columns_sm = $grid_columns_xs = '';
	if ( is_page() && is_object($post) ) {
		$post_id = $post->ID;
		$layout					= get_post_meta( $post_id, 'fioxen_lt_layout_page', true );
		$layout_item			= get_post_meta( $post_id, 'fioxen_lt_layout_item', true );
		$grid_columns_lg		= get_post_meta( $post_id, 'fioxen_lt_grid_columns_lg', true );
		$grid_columns_md		= get_post_meta( $post_id, 'fioxen_lt_grid_columns_md', true );
		$grid_columns_sm		= get_post_meta( $post_id, 'fioxen_lt_grid_columns_sm', true );
		$grid_columns_xs		= get_post_meta( $post_id, 'fioxen_lt_grid_columns_xs', true );
		$pagination_style		= get_post_meta( $post_id, 'fioxen_lt_pagination_style', true );
		$show_map_top			= get_post_meta( $post_id, 'fioxen_lt_show_map_top', true );
		$show_rating			= get_post_meta($post_id, 'fioxen_lt_show_rating', true);
		$show_tagline			= get_post_meta($post_id, 'fioxen_lt_show_tagline', true);
		$per_page 				= get_post_meta($post_id, 'fioxen_lt_per_page', true);
	}

	if ( isset($_REQUEST['form_data']) ) {
		$form_data = urldecode($_REQUEST['form_data']);
		parse_str($form_data, $settings);

		if( isset($settings['lt_layout']) && $settings['lt_layout'] ){
			$layout = $settings['lt_layout'];
		}	

		if( isset($settings['lt_layout_item']) && $settings['lt_layout_item'] ){
			$layout_item = $settings['lt_layout_item'];
		}	

		if( isset($settings['lt_grid_columns_lg']) && $settings['lt_grid_columns_lg'] ){
			$grid_columns_lg = $settings['lt_grid_columns_lg'];
		}

		if( isset($settings['lt_grid_columns_md']) && $settings['lt_grid_columns_md'] ){
			$grid_columns_md = $settings['lt_grid_columns_md'];
		}

		if( isset($settings['lt_grid_columns_sm']) && $settings['lt_grid_columns_sm'] ){
			$grid_columns_sm = $settings['lt_grid_columns_sm'];
		}

		if( isset($settings['lt_grid_columns_xs']) && $settings['lt_grid_columns_xs'] ){
			$grid_columns_xs = $settings['lt_grid_columns_xs'];
		}

		if( isset($settings['lt_show_map_top']) && $settings['lt_show_map_top'] ){
			$show_map_top = $settings['lt_show_map_top'];
		}

		if( isset($settings['lt_show_rating']) && $settings['lt_show_rating'] ){
			$show_rating = $settings['lt_show_rating'];
		}

		if( isset($settings['lt_show_tagline']) && $settings['lt_show_tagline'] ){
			$show_tagline = $settings['lt_show_tagline'];
		}
	}

	if( empty($layout) ){
		$layout = fioxen_get_option('lt_layout_page', 'filters_left');
	}
	if( empty($layout_item) ){
		$layout_item = fioxen_get_option('lt_layout_item', 'item-grid-1');
	}
	if( empty($show_map_top) ){
		$show_map_top = fioxen_get_option('lt_show_map_top', 'item-grid-1');
	}
	if( empty($grid_columns_lg) ){
		$grid_columns_lg = fioxen_get_option('lt_grid_columns_lg', '3');
	}
	if( empty($grid_columns_md) ){
		$grid_columns_md = fioxen_get_option('lt_grid_columns_md', '3');
	}
	if( empty($grid_columns_sm) ){
		$grid_columns_sm = fioxen_get_option('lt_grid_columns_sm', '3');
	}
	if( empty($grid_columns_xs) ){
		$grid_columns_xs = fioxen_get_option('lt_grid_columns_xs', '2');
	}
	if( empty($pagination_style) ){
		$pagination_style = fioxen_get_option('lt_pagination_style', 'load_more');
	}
	if( empty($show_rating) ){
		$show_rating = fioxen_get_option('lt_show_rating', 'number');
	}
	if( empty($show_tagline) ){
		$show_tagline = fioxen_get_option('lt_show_tagline', 'yes');
	}
	if( empty($per_page) ){
		$per_page = get_option( 'job_manager_per_page', '12' );
	}
	$data = array(
		'layout'					=> $layout,
		'layout_item'			=> $layout_item,
		'show_map_top'			=> $show_map_top,
		'grid_columns_lg'		=> $grid_columns_lg,
		'grid_columns_md'		=> $grid_columns_md,
		'grid_columns_sm'		=> $grid_columns_sm,
		'grid_columns_xs'		=> $grid_columns_xs,
		'pagination_style'	=> $pagination_style,
		'show_rating'			=> $show_rating, 
		'show_tagline'			=> $show_tagline,
		'per_page'				=> $per_page
	);	

	return $data;
}

