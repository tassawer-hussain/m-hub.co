<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $logo = $this->image_attach($post_id, '_lt_logo_image', true);
   $logo_url = isset($logo[0]) && $logo[0] ? $logo[0] : $settings['image']['url'];
?>

<div class="gva-listing-logo">
   <?php if( $logo_url ){ ?>
      <div class="content-inner">
         <img src="<?php echo esc_url($logo_url) ?>" alt="<?php echo esc_attr($fioxen_post->title) ?>" />
      </div>
   <?php } ?>
</div>

