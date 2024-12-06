<?php
   if (!defined('ABSPATH')){ exit; }

   global $fioxen_post;
   if( !$fioxen_post || $fioxen_post->post_type != 'product' ||  !$fioxen_post->post_excerpt ){ return; }
   
   $post_id = $fioxen_post->ID;
   $this->add_render_attribute('block', 'class', [ 'cf-item-social-share' ]);
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php wpcf_function()->template('include/social-share'); ?>
</div>