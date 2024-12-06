<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
?>

<div class="gva-listing-rating">
   <?php if( class_exists('Fioxen_Listing_Comment') ): ?>
       <!-- Reviews Addon -->
      <?php 
         $count_reviews = Fioxen_Listing_Comment::instance()->total_reviews($post_id, 0, true);
         $review_avg = get_post_meta( $post_id, 'lt_reviews_average', true );
         $review_text = $count_reviews == 1 ? esc_html__('review', 'fioxen-themer') : esc_html__('reviews', 'fioxen-themer');
      ?>

      <?php if( !empty($review_avg) ){ ?>
         <!-- Reviews Addon -->
            <div class="gva-listing-rating">
               <div class="review-avg-content">
                  <div class="review-star">
                     <?php echo Fioxen_Listing_Comment::instance()->show_star_by_avg( round($review_avg, 2) ); ?>
                     <span class="review-text">
                        <?php echo round($review_avg, 2) . ' ' . esc_html__( 'by', 'fioxen-themer' ) . ' ' . esc_html($count_reviews) . ' ' . $review_text ?>
                     </span>  
                  </div>
                   
               </div>
            </div>
         <!-- End Reviews Addon -->
      <?php } ?>  
   <?php endif; ?>   
</div>

