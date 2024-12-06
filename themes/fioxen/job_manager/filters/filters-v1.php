<?php
$atts['atts'] = $atts;
$atts['keywords'] = $keywords;
?>
<?php
   $filter = fioxen_get_option('lt_filter_sort_fields', '');
   $filter_fields = ( isset($filter['enabled']) && $filter['enabled'] ) ? $filter['enabled'] : array('keywords', 'category', 'regions', 'types', 'location', 'distance', 'price_range', 'amenities');
   foreach( $filter_fields as $key => $value ){
      switch($key) {
         case 'keywords': get_job_manager_template( 'filters/parts/keywords.php', $atts );
         break;

         case 'keywords_title': get_job_manager_template( 'filters/parts/keywords_title.php', $atts );
         break;

         case 'category': get_job_manager_template( 'filters/parts/category.php', $atts );
         break;

         case 'regions': get_job_manager_template( 'filters/parts/regions.php', $atts );
         break;

         case 'types': get_job_manager_template( 'filters/parts/types.php', $atts );
         break;

         case 'location': get_job_manager_template( 'filters/parts/location.php', $atts );
         break;

         case 'distance': get_job_manager_template( 'filters/parts/distance.php', $atts );
         break;

         case 'price_range': get_job_manager_template( 'filters/parts/price_range.php', $atts );
         break;

         case 'amenities': get_job_manager_template( 'filters/parts/amenities.php', $atts );
         break;
      }
   }
?>

