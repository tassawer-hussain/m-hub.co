<?php
   if (!defined('ABSPATH')){ exit; }

   global $fioxen_post, $post;

   if(!$fioxen_post){ return; }
   $post = $fioxen_post;
?>
   
<div class="post-comment">
   <?php
      if(comments_open($fioxen_post->ID)){
         comments_template();
      }else{
         if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            echo '<div class="alert alert-info">' . esc_html__('This Post Disabled Comment', 'fioxen-themer') . '</div>';
         }
      }
   ?>
</div>      

