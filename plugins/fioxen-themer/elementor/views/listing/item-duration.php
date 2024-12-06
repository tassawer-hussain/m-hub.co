<?php
   use Elementor\Icons_Manager;
   if (!defined('ABSPATH')){ exit; }

   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $duration = get_post_meta( $post_id, '_lt_duration', true );
   $has_icon = ! empty( $settings['selected_icon']['value']);
?>

   <div class="gva-listing-duration">
      <div class="content-inner">
         <div class="icon">
            <?php if ($has_icon){ ?>
               <?php Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
            <?php } ?>
         </div>
         <div class="box-content">
            <?php 
               if($settings['title_text']){ 
                  echo '<h4 class="lt-meta-title">' . esc_html($settings['title_text']) . '</h4>';
               }
               echo '<div class="item-value">' . esc_html($duration) . '</div>';
            ?>
         </div>
      </div>
   </div>

