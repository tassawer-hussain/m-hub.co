<?php
   use Elementor\Group_Control_Image_Size;
   use Elementor\Icons_Manager;

   $image_id = $banner['image']['id']; 
   $image_url = $banner['image']['url'];
   if($image_id){
      $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
      if($attach_url) $image_url = $attach_url;
   }

   $taxonomy = $settings['taxonomy'] ? $settings['taxonomy'] : 'job_listing_region';
   $term = $link_term = false;
   if( !empty($banner['term_slug']) ){
      $term = get_term_by( 'slug', $banner['term_slug'], $taxonomy );
      if($term){
         $link_term = get_term_link( $term->term_id, $taxonomy );
      }
   }

   $has_icon = !empty($banner['icon']['value']);

   $target = '';
   if( !empty($banner['custom_link']['url']) ){ 
      $link_term = $banner['custom_link']['url'];
      if($banner['custom_link']['is_external']){
         $target = 'target="_blank"';
      }
   }
?>

<div class="item listings-banner-item">
   <div class="listings-banner-item-content">

      <?php if($image_url){ ?>
         <div class="banner-image">
            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_html($banner['title']) ?>" />
            
            <?php 
               if($link_term){ 
                  echo '<span class="arrow"><i class="fa-solid fa-arrow-right"></i></span>';
                  echo '<a class="link-term-overlay" href="' . esc_url($link_term) . '" '. $target . '></a>';
               } 
            ?>

         </div>
      <?php } ?>

      <div class="banner-content">
         <?php 
            if($has_icon){ 
               echo '<span class="box-icon">';
                  Icons_Manager::render_icon($banner['icon'], ['aria-hidden' => 'true']); 
               echo '</span>';
            } 
         ?>

         <?php if($banner['title']){ ?>
            <h3 class="title">
               <?php 
                  if($link_term){ 
                     echo '<a href="' . esc_url($link_term) . '" '. $target . '>'. $banner['title'] . '</a>';
                  }else{
                     echo $banner['title'];
                  } 
               ?>
            </h3>
         <?php } ?>

         <?php 
            if ( $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($banner['term_slug'])){
                  echo '<div class="number-listings">' . sprintf(_n('%d Listing', '%d Listings', $term->count, 'ziston-themer'), $term->count) . '</div>';
               }
            }
         ?>

      </div>
   </div>
</div>