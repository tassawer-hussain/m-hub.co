<?php 
   $post_id = get_the_ID();
   $item_classes = 'all ';
   $post_category = ''; $separator = ', '; $output = '';
   $item_cats = get_the_terms( get_the_ID(), 'category_portfolio' );

   if(!empty($item_cats) && !is_wp_error($item_cats)){
      foreach((array)$item_cats as $item_cat){
         $item_classes .= $item_cat->slug . ' ';
         $output .= '<a href="'.get_category_link( $item_cat->term_id ).'" title="' . esc_attr( sprintf( esc_attr__( "View all posts in %s", 'fioxen' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
      }
      $post_category = trim($output, $separator);
   }
   $thumbnail = 'post-thumbnail';
   if(isset($thumbnail_size) && $thumbnail_size){
      $thumbnail = $thumbnail_size;
   }
   if(isset($layout) && $layout && $layout == 'grid'){
      $item_classes .= ' item-columns isotope-item';
   }
?>

<div class="<?php echo esc_attr($item_classes) ?>">
   <div class="portfolio-block portfolio-v2">      
      <div class="images">
         <a class="link-image-content" href="<?php the_permalink(); ?>">
            <?php 
               if(has_post_thumbnail()){
                  the_post_thumbnail($thumbnail);
               }
            ?>
         </a> 
         <a class="bg-overlay" href="<?php the_permalink(); ?>"></a>
      </div>
      <div class="case-content">
         <div class="content-inner">
            <div class="content-left">
               <div class="case-meta"><?php echo wp_kses($post_category, true) ?></div>
               <h3 class="title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
               </h3>
            </div>
            <div class="content-right">   
               <a class="link-to-content" href="<?php the_permalink(); ?>"><i class="las la-long-arrow-alt-right"></i></a>
            </div>   
         </div>    
      </div>  
      <div class="bg-overlay"></div>
   </div>
   
</div>
