<?php
   wp_localize_script( 'fioxen-listing', 'fioxen_lt_types', array(
      'str_select_type' => esc_html__( 'Filter by Type', 'fioxen')
   ));
?>
<div class="lt-filter-by-types">
   <div class="content-inner">
      <i class="icon fa-solid fa-font-awesome"></i>
      <?php WP_Job_Manager_Shortcodes::instance()->job_filter_job_types($atts); ?>
   </div>    
</div>