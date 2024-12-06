<?php
   global $wp_query;
   $region = $d_country = $d_city = '';
   $term =  $wp_query->queried_object;
   
   if( $term && isset( $term->slug) ){
      $region = $term->slug;
   }
   
   if( isset($_GET['region']) ){
      $region = $_GET['region'];
      if( $region && is_array($region) ){
         if( isset($region[0]) ){
            $region = $region[0];
         }
      }
   }

   if( $region ){
      $region_field = is_numeric($region) ? 'term_id' : 'slug';
      $term_1 = get_term_by($region_field, $region, 'job_listing_region'); 
      if($term_1){
         if($term_1->parent == 0){
            $d_country = $term_1->term_id;
         }else{
            $d_city = $term_1->term_id;
            $term_2 = get_term( $term_1->parent, 'job_listing_region' );
            if($term_2){
               $d_country = $term_2->term_id;
            }
         }
      }
   }

   $regions = get_terms( array(
      'taxonomy'   => 'job_listing_region',
      'hide_empty' => false,
   ));

   $cities = array();
   if ( !empty( $regions ) && !is_wp_error( $regions ) ) {
      foreach ($regions as $city) {
         if($city->parent > 0){
            $cities[] = array(
               'parent' => $city->parent,
               'id' => $city->term_id,
               'name' => $city->name
            );
         }  
      }
   }

   $d_country = apply_filters('listings_filter_regions_1', $d_country);

   wp_localize_script( 'fioxen-listing', 'fioxen_region_cities', array(
      'region_cities' => $cities,
      'default_value' => $d_city,
      'str_select_city' => esc_html__( 'Filter By City', 'fioxen')
   ));
?>
   <div class="filter-by-region filter-by-country">
      <div class="content-inner">
         <i class="icon fa-solid fa-flag"></i>
         <select class="option-select2-filter job-manager-filter filter-listing-country th-filter-listing-country" id="filter-listing-country" name="filter_listing_region[]" placeholder="<?php echo esc_attr__('Filter By Region', 'fioxen') ?>">
            <option class="country-item" value=""><?php echo esc_html__('Filter By Region', 'fioxen') ?></option>
            <?php 
               if ( !empty( $regions ) && !is_wp_error( $regions ) ) {
                  foreach ($regions as $country) {
                     if($country->parent == 0){
                        echo '<option class="country-item" ' . ($country->term_id == $d_country ? 'selected' : '') . ' value="' . $country->term_id . '">' . $country->name . '</option>';
                     }
                  }
               }
            ?>   
         </select>
      </div>   
   </div>

   <div class="filter-by-region filter-by-city">
      <div class="content-inner">
         <i class="icon fa-solid fa-location-dot"></i>
         <select class="option-select2-filter job-manager-filter filter-listing-city th-filter-listing-city" id="filter-listing-city" name="filter_listing_region[]" placeholder="<?php echo esc_attr__('Filter By City', 'fioxen') ?>">
            <?php if( !empty($d_city) ){ ?>
               <option class="country-item" selected value="<?php echo esc_attr($d_city) ?>"></option>
            <?php } ?>
         </select>
      </div>   
   </div>   