<?php
   wp_enqueue_script('jquery-ui-core');
   wp_enqueue_script('jquery-ui-slider');
   wp_enqueue_style('jquery-ui');
   $distance_default = fioxen_get_option('lt_distance', '60');
?>
<div class="lt-filter-distance-slider">
   <div class="content-inner">
      <div class="title">
         <span class="title-text"><?php echo esc_html__('Radius Around Distance:', 'fioxen') ?></span>
         <span class="value-text"><?php echo esc_html($distance_default) ?></span>
         <span><?php echo fioxen_get_option('lt_distance_unit', 'km') ?></span>
      </div>
      <div class="lt-filter-slider">
         <input type="hidden" name="lt_filter_distance" class="job-manager-filter" value="<?php echo esc_attr($distance_default) ?>" />
         <div class="filter-distance-slider"><div class="lt-distance-slider-ui"></div></div>
      </div>
   </div>   
</div>