<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $fioxen_post;
   if (!$fioxen_post){
      return;
   }
?>

<?php 
   $thumbnail_size = $settings['fioxen_image_size'];

   if(has_post_thumbnail($fioxen_post)){
      echo get_the_post_thumbnail($fioxen_post, $thumbnail_size);
   }
?>

