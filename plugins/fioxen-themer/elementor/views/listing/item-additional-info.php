<?php
   if (!defined('ABSPATH')){ exit; }

   $result = array();
   global $fioxen_post;
   if(!$fioxen_post){ return; }
   if($fioxen_post->post_type != 'job_listing'){ return; }
   $post_id = $fioxen_post->ID;
   $result = get_post_meta($post_id, '_lt_additional_info_value', true);
   if( empty($result) ){return;}
  
?>

<div class="gva-listing-additional-info element-item-listing">
   <?php 
      if($settings['title']){ 
         echo '<h3 class="block-title">';
            echo '<span>' . $settings['title'] . '</span>';
         echo '</h3>';
      }
   ?>
   <div class="block-content">
      <div class="content-inner">
         <?php 
            foreach ($result as $key => $item) {
               echo '<div class="item-info">';
                  echo '<label>' . esc_html($item['name']) . '</label>';
                  echo '<span class="value">' . esc_html($item['val']) . '</span>';
               echo '</div>';
            } 
         ?>
      </div>   
   </div>   
</div>
