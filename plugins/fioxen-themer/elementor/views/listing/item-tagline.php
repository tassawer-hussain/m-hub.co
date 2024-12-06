<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $tagline = get_post_meta( $post_id, '_lt_tagline', true );
?>

<div class="gva-listing-tagline">
   <?php if( $tagline ){ ?>
      <div class="content-inner">
         <?php echo esc_html($tagline) ?>
      </div>
   <?php } ?>
</div>

