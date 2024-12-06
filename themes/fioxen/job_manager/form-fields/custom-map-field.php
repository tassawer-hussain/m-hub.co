<?php
   if ( ! defined( 'ABSPATH' ) ) {
      exit; // Exit if accessed directly.
   }
   global $post;

   wp_enqueue_script('map-api');
   wp_enqueue_script('leaflet');
   wp_enqueue_script('leaflet-markercluster');
   wp_enqueue_script('leaflet-googlemutant');
   wp_enqueue_script('geocoder-control');
   wp_enqueue_script('fioxen-listing-fields');

   wp_enqueue_style('leaflet');
   wp_enqueue_style('marker-cluster');
   wp_enqueue_style('marker-cluster-default');
   wp_enqueue_style('geocoder-control');

   $post_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? absint($_REQUEST['job_id']) : $post->ID;
   $map_options = fioxen_map_options();

   $lat_long = get_post_meta($post_id, '_lt_map', true);

   $latitude = $longitude = '';
   if(!empty($lat_long['lat'])) $map_options['latitude'] = $latitude = $lat_long['lat'];
   if(!empty($lat_long['lng'])) $map_options['longitude'] = $longitude = $lat_long['lng'];

   wp_localize_script( 'fioxen-listing-fields', 'fioxen_map_options', $map_options );

?>

<div class="custom-map-field">
   <div class="col-width-2">
      <div class="content-inner">
         <div id="custom-map-field_map" class="custom-map-field_map"></div>
      </div>
   </div>
   <div class="col-width last-col">
      <div class="content-inner">
         <div class="form-field-map field_job_latitude">
            <div class="content-inner">
               <label for="latitude-text"><?php echo esc_html__('Listing Latitude:', 'fioxen') ?> </label>
               <input type="text" id="latitude-text" name="<?php echo esc_attr($key) ?>[lat]" class="form-control latitude-text" value="<?php echo esc_attr($latitude) ?>" autocomplete="off">
            </div>
         </div>
         <div class="form-field-map field_job_longitude">
            <div class="content-inner">
               <label for="longitude-text"><?php echo esc_html__('Listing Longitude:', 'fioxen') ?> </label>
               <input type="text" id="longitude-text" name="<?php echo esc_attr($key) ?>[lng]" class="form-control longitude-text" value="<?php echo esc_attr($longitude) ?>" autocomplete="off">
            </div>   
         </div>
      </div>   
   </div>
</div>

