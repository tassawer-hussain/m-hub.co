<?php 
   $_search_location = '';
   $_location_value = '';
   if( isset($_GET['_search_location']) && !empty($_GET['_search_location']) ){
      $_search_location = $_GET['_search_location'];
   }
   if( isset($_GET['lt_filter_location_value']) && !empty($_GET['lt_filter_location_value']) ){
      $_location_value = $_GET['lt_filter_location_value'];
   }
?>

<div class="lt_search_location">
   <div class="content-inner">
      <i class="icon fa-solid fa-location-arrow"></i>
   	<div class="search-location-inner">
   		<input type="text" class="id_listing_location_text job-manager-filter" name="_search_location" id="lt_input_search_location" placeholder="<?php esc_attr_e( 'Location', 'fioxen' ); ?>" value="<?php echo esc_html($_search_location) ?>" autocomplete="off" />
   		<div class="places_list_autocomplete" style="display:none;"></div>
   	</div>
   	<input type="hidden" class="job-manager-filter" id="lt_filter_location_value" name="lt_filter_location_value" value="<?php echo esc_attr($_location_value) ?>" />
   </div>
</div>