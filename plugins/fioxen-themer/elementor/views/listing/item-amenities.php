<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   $result = false;
   
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   $post_id = $fioxen_post->ID;
   $result = wp_get_post_terms( $post_id, 'job_listing_amenity' );
?>

<div class="gva-listing-amenities">
   <?php if( $result ): ?>
      <div class="listing-amenities element-item-listing">
         <?php 
            if($settings['title']){ 
               echo '<h3 class="block-title">';
                  echo '<span>' . $settings['title'] . '</span>';
               echo '</h3>';
            }
         ?>
         <div class="block-content">
            <ul class="amenities-list clearfix">
               <?php foreach ($result as $term) { ?>
                  <?php 
                     $has_icon = 'without-icon'; 
                     $icon_html = '<i class="icon flaticon-star-2"></i>';
                     $term_id = $term->term_id;
                     $icon_style = get_term_meta($term_id, 'gva_term_icon_type', true);

                     if($icon_style == 'icon_type_font'){
                        $icon = get_term_meta($term_id, 'gva_term_icon_font', true);
                        if( !empty($icon) ){
                           $has_icon = 'with-icon';
                           $icon_html = '<i class="icon icon-font ' . esc_attr($icon) . '"></i>';
                        }
                     }elseif($icon_style == 'icon_type_image'){
                        $icon = get_term_meta($term_id, 'gva_term_icon_image', true);
                        $icon_attach = wp_get_attachment_image_src($icon, 'full');
                        if( isset($icon_attach[0]) && $icon_attach[0] ){
                           $has_icon = 'with-icon';
                           $icon_html = '<img class="icon icon-img" src="'.esc_url($icon_attach[0]) . '" alt="' . esc_attr($term->name) . '" />';
                        }
                     }
                  ?>

                  <li class="amenity-item <?php echo esc_attr($has_icon) ?>">
                     <span class="icon-box"><?php echo trim($icon_html) ?></span>
                     <span class="name"><?php echo esc_html($term->name) ?></span>
                  </li>
               <?php } ?>
            </ul>
         </div>   
      </div>
   <?php endif; ?>
</div>

