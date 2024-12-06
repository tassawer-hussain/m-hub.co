<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
?>

<div class="gva-listing-comment">
<?php
   if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
      echo '<div class="alert alert-info">' . esc_html__('Comment Disabled on Edit Mode', 'fioxen-themer') . '</div>';
   }else{
      if( comments_open($post_id) || get_comments_number($post_id) ) {
         echo '<div class="listing-comment">';
            comments_template();
         echo '</div>';   
      }
   }
?>
</div>