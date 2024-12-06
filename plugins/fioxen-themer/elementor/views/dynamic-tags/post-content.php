<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $fioxen_post;
   if (!$fioxen_post){
      return;
   }
   ?>
   
   <div class="post-content">
      <?php 
      if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
         echo do_shortcode( $fioxen_post->post_content );
      }else{
         $content = apply_filters( 'the_content', $fioxen_post->post_content );
         echo do_shortcode($content);
      }
      ?>
   </div> 