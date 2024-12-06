<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $fioxen_post;
   if (!$fioxen_post){
      return;
   }
   $html_tag = $settings['html_tag'];
?>

<div class="fioxen-post-title">
   <<?php echo esc_attr($html_tag) ?> class="post-title">
      <span><?php echo get_the_title($fioxen_post) ?></span>
   </<?php echo esc_attr($html_tag) ?>>
</div>   