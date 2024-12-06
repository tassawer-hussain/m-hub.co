<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $socials = get_post_meta($post_id, '_lt_socials_media_values', true);
   $new_tab = $settings['new_tab'] == 'yes' ? 'target="_blank"' : '';
?>

<div class="gva-listing-social-media">
   <div class="content-inner">
      <?php 
         if($socials){ 
            foreach($socials as $key => $item){ 
               echo '<a '. $new_tab .' href="'. esc_url($item['url']) .'"><i class="fa-brands fa-'. esc_attr($item['name']) .'"></i></a>';
            }
         }
      ?>
   </div>
</div>

