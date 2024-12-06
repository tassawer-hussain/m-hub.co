<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $tags = wp_get_post_terms( $post_id, 'job_listing_tag' );
?>

<?php if ( !empty($tags) ): ?>

   <div class="gva-listing-tags element-item-listing">
      <?php 
         if($settings['title_text']){ 
            echo '<h3 class="block-title">';
               echo '<span>' . $settings['title_text'] . '</span>';
            echo '</h3>';
         }
      ?>
      <div class="block-content">
         <?php foreach ($tags as $tag) { ?>
               <a class="tag-item" href="<?php echo get_category_link($tag->term_id); ?>"><?php echo esc_html($tag->name) ?></a>
         <?php } ?>
      </div>
   </div>

<?php endif; ?>