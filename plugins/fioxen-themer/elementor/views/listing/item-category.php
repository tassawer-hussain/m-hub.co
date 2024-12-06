<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;

   $cats_html = '';
   $i = 0;
   $cats = get_the_terms($post_id, 'job_listing_category');
   if(!empty($cats) && !is_wp_error($cats)){
      foreach((array)$cats as $cat){
         $i++;
         $term_id = $cat->term_id;
         $has_icon = false;
         $cats_html .= '<a class="cat-item" href="' . get_category_link( $term_id ) . '">';
            $cats_html .= '<span class="cat-name">' . $cat->name . '</span>';
         $cats_html .= '</a>';   
         if( $i < count($cats) ) $cats_html .= '<span>&nbsp;-&nbsp;</span>';
      }
   }
?>

<div class="gva-listing-category">
   <div class="content-inner">
      <?php echo wp_kses_post($cats_html) ?>
   </div>
</div>

