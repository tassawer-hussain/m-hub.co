<?php
   if ( ! defined( 'ABSPATH' ) ) {
      exit; // Exit if accessed directly.
   }
   global $post;
   wp_enqueue_script('fioxen-listing-fields');
?>

<div class="job-custom-regions-field job-custom-regions-<?php echo esc_attr( $key ); ?>">
   <?php
      $values = isset( $field['value'] ) && $field['value'] ? $field['value'] : array();
      if( isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ){
         $post_id = $_REQUEST['job_id'];
         $tmp_values = array();
         $terms_value = wp_get_post_terms( $post_id, $field['taxonomy'] );
         if ( !empty($terms_value) ) {
            foreach ($terms_value as $term) {
               if($term->parent == 0){
                  $values['country'] = $term->slug;
               }else{
                  $values['city'] = $term->slug;
               }
            }
         }
      } 

      $value_country = isset($values['country']) && $values['country'] ? $values['country'] : '';
      $value_city = isset($values['city']) && $values['city'] ? $values['city'] : '';
      

      $regions = get_terms( array(
         'taxonomy'   => 'job_listing_region',
         'hide_empty' => false,
      ));

      echo '<div class="form-field form-field-lt_field_job_country">';
         echo '<select id="lt_field_job_country" class="field_job_country job_country" name="' . esc_attr($key) . '[]">';
            echo '<option class="country-item" value="">' . esc_html__('Select Region', 'fioxen') . '</option>';

            if ( !empty( $regions ) && !is_wp_error( $regions ) ) {
               foreach ($regions as $country) {
                  if($country->parent == 0){
                     echo '<option class="country-item" data-id="' . $country->term_id . '" value="' . $country->slug . '" ' . ($country->slug == $value_country ? 'selected="selected"':'') . '>' . $country->name . '</option>';
                  }
               }
            }
         echo '</select>';
      echo '</div>';   

      echo '<div class="form-field form-field-lt_field_job_city">';
         echo '<select id="lt_field_job_city" class="field_job_city job_city" name="' . esc_attr($key) . '[]"></select>';
      echo '</div>';   

      $cities = array();
      if ( !empty( $regions ) && !is_wp_error( $regions ) ) {
         foreach ($regions as $city) {
            if($city->parent > 0){
               $cities[] = array(
                  'parent' => $city->parent,
                  'id' => $city->term_id,
                  'slug' => $city->slug,
                  'name' => $city->name
               );
            }  
         }
      }

      wp_localize_script( 'fioxen-listing-fields', 'fioxen_region_cities', array(
         'region_cities' => $cities,
         'default_value' => $value_city,
         'str_select_city' => esc_html__( 'Select City', 'fioxen')
      ));

   ?>
</div>
