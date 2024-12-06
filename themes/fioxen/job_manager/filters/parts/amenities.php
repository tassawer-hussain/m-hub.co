<?php
   $default = '';

   $terms = get_terms( array(
      'taxonomy' => 'job_listing_amenity',
      'hide_empty' => false,
   ));

   if( isset($_GET['amenity']) && !empty($_GET['amenity']) ){
      $default = $_GET['amenity'];
   }

   $d_term = get_term_by( 'slug', $default, 'job_listing_amenity' );
   if($d_term){
      $default = $d_term->term_id;
   }

   $show = fioxen_get_option('lt_show_amenities', 'hide');


?>
<div class="lt-filter-by-amenities">
   <div class="content-inner">
      <h4 class="title"><?php echo esc_html__('Filter by Features', 'fioxen') ?></h4>
      <div class="filter-by-amenities" style="<?php echo ( esc_attr($show) == 'show' ? 'display: block' : 'display: none;' ) ?>">
         <ul class="amenities-list">
            <?php
               if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
                  foreach ($terms as $term) {
                     $checked = '';
                     if( $default == $term->term_id ){
                        $checked = 'checked = "checked"';
                     } 
               ?>
                     <li class="amenity-cat-item">
                        <div class="pretty p-icon p-curve p-smooth">
                           <input class="job-manager-filter" <?php echo trim($checked) ?> name="filter_listing_amenity[]" type="checkbox" value="<?php echo esc_attr($term->term_id) ?>" />
                           <div class="state">
                              <i class="icon fas fa-check"></i>
                              <label><?php echo esc_html($term->name) ?></label>
                           </div> 
                        </div>     
                     </li>
               <?php      
                  }
               }
            ?>
         </ul>
      </div>
   </div>   
</div>
