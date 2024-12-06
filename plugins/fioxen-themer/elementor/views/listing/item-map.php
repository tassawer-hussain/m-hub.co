<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
 
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

   $lat = get_post_meta($post_id, '_lt_map_latitude', true);
   $lng = get_post_meta($post_id, '_lt_map_longitude', true);

   $lat_long = get_post_meta($post_id,  '_lt_map', true);
   $lat = $lng = '';

   if(isset($lat_long['lat']) && $lat_long['lat']) $lat = $lat_long['lat'];
   if(isset($lat_long['lng']) && $lat_long['lng']) $lng = $lat_long['lng'];

   $map_options = fioxen_map_options();
   $without_map = false;
   if( !empty($lat) && !empty($lng) ){
      $map_options['mode'] = 'single';
      $map_options['latitude'] = $lat;
      $map_options['longitude'] = $lng;
      wp_localize_script( 'fioxen-listing', 'fioxen_map_options', $map_options );
   }else{
      $map_options['mode'] = 'without_map';
      $without_map = true;
   }
?>

<div class="gva-listing-map">
   <?php 
      if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
         echo '<img src="' . GAVIAS_FIOXEN_PLUGIN_URL . 'elementor/assets/images/demo-map.jpg" />';
      }else{
         if( !$without_map ){ 
            echo '<div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>';
         } 
      }
    ?>
</div>

