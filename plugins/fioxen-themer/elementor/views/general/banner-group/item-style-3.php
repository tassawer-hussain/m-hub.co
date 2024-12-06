<?php
   use Elementor\Group_Control_Image_Size;

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

   $target = '';
   if( !empty($banner['custom_link']['url']) ){ 
      $link_term = $banner['custom_link']['url'];
      if($banner['custom_link']['is_external']){
         $target = 'target="_blank"';
      }
   }
   $classes = array();
   $classes = $banner['item_active'] == 'yes' ? 'listings-banner-item-content banner-active' : 'listings-banner-item-content';

?>

<div class="item listings-banner-item">
   <div class="<?php echo esc_attr($classes) ?>">
      <?php if($image_url){ ?>
         <div class="banner-image">
            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_html($banner['title']) ?>" />
         </div>
      <?php } ?>

      <div class="banner-content">
         <?php 
            if($banner['sub_title']){ 
               echo '<div class="subtitle">' . $banner['sub_title'] . '</div>';
            }
            if($banner['title']){
               echo '<h3 class="title">' . $banner['title'] . '</h3>';
            } 
         ?>
         <?php 
            if ( $settings['show_number_content'] == 'yes' && $term ) {
               if(!empty($banner['term_slug'])){
                  echo '<div class="number-listings">' . $term->count . '</div>';
               }
            } 
         ?>
      </div>
      
      <?php if($link_term){ ?>
         <a class="link-term-overlay" href="<?php echo esc_url($link_term); ?>" <?php echo $target ?>></a>
      <?php } ?>
               
   </div>
</div>