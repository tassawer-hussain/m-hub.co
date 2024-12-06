<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
?>

<div class="gva-listing-rating-criteria">
   <?php if( class_exists('Fioxen_Listing_Comment') && comments_open($post_id) ): ?>
      <!-- Reviews Addon -->

      <?php 
         $total_votes = Fioxen_Listing_Comment::instance()->total_reviews($post_id, 0, true);

         $reviews = Fioxen_Listing_Comment::instance()->results_reviews_by_post( $post_id );
        
         $lt_results_reviews = get_post_meta( $post_id, 'lt_results_reviews', true ); 
         
         //print '<pre>'; print_r($lt_results_reviews);

         $reviews_average = get_post_meta( $post_id, 'lt_reviews_average', true ); 
         if($reviews_average) $reviews_average = round($reviews_average, 1);
         $cats_review = Fioxen_Listing_Comment::instance()->categories_review();

         $results_reviews_by_cats = array();
         $results_reviews_by_del_cats = array();
         if( $lt_results_reviews && is_array($lt_results_reviews) ){
            foreach ($lt_results_reviews as $key => $value){
               if( isset($cats_review[$key]) && $value['avg']){
                  $results_reviews_by_cats[$key] = $value;
               }else{
                  $results_reviews_by_del_cats[$key] = $value;
               }
            }
         }

         $text    = '';
         $step    = 1;
         if ($reviews_average <= $step) {
            $text = esc_html__('Bad', 'fioxen-themer');
         }elseif ($reviews_average > 1 && 2 >= $reviews_average) {
            $text = esc_html__('Not Bad', 'fioxen-themer');
         }elseif ($reviews_average > $step * 2 && $step * 3 >= $reviews_average) {
            $text = esc_html__('Good', 'fioxen-themer');
         }elseif ($reviews_average > $step * 3 && $step * 4 >= $reviews_average) {
            $text = esc_html__('Very Good', 'fioxen-themer');
         }elseif ($reviews_average > $step * 4) {
            $text = esc_html__('Wonderful', 'fioxen-themer');
         }

      ?>
      <?php if( $lt_results_reviews && is_array($lt_results_reviews) ): ?>
         <div class="listing-total-reviews">
            <div class="content-inner">
            
               <div class="reviews-left">
                  <div class="content-inner">
                     <div class="reviews-average">
                        <div class="rating-score">
                           <?php echo ($reviews_average . '<span>/5</span>') ?>
                        </div>   
                        <div class="vote-text">
                           <?php echo esc_html($text); ?>
                        </div>
                        <div class="vote-number"><?php printf('%s ' . _n('verified review', 'verified reviews', $total_votes, 'fioxen-themer'), $total_votes); ?></div>
                     </div>
                  </div>   
               </div>

               <div class="reviews-right">
                  <div class="content-inner">
                     <div class="reviews-result">
                        
                        <?php foreach ($results_reviews_by_cats as $key => $value) : ?>
                           <div class="result-item">
                              <div class="review-value">
                                 <div class="review-progress-wrapper clearfix">
                                    <?php $volume = round($value['avg']/5, 2) * 100; ?>
                                    <div class="review__progress-label"><?php echo esc_html( $cats_review[$key] ); ?></div>
                                    <div class="review__progress">
                                       <div class="review__progress-bar" data-progress-max="<?php echo esc_attr($volume) ?>%">
                                          <?php if($volume > 80){ ?>
                                            <span class="percentage percentage-left"><?php echo esc_attr( round($value['avg'], 1) ) ?></span>
                                          <?php }else{ ?>  
                                            <span class="percentage"><?php echo esc_attr( round($value['avg'], 1) ) ?></span>
                                          <?php } ?>  
                                       </div>
                                    </div>  
                                 </div> 
                              </div>
                           </div>
                        <?php endforeach; ?>

                        <?php if( count($results_reviews_by_del_cats) > 0 ): ?>
                           <?php foreach ($results_reviews_by_del_cats as $key => $value) : ?>
                              <div class="result-item">
                                 <div class="review-value">
                                    <div class="review-progress-wrapper clearfix">
                                       <?php $volume = round($value['avg']/5, 2) * 100; ?>
                                       <div class="review__progress-label"><?php echo esc_html( $key ); ?></div>
                                       <div class="review__progress">
                                          <div class="review__progress-bar" data-progress-max="<?php echo esc_attr($volume) ?>%">
                                             <?php if($volume > 80){ ?>
                                               <span class="percentage percentage-left"><?php echo esc_attr( round($value['avg'], 1) ) ?></span>
                                             <?php }else{ ?>  
                                               <span class="percentage"><?php echo esc_attr( round($value['avg'], 1) ) ?></span>
                                             <?php } ?>  
                                          </div>
                                       </div>  
                                    </div> 
                                 </div>
                              </div>
                           <?php endforeach; ?>
                        <?php endif; ?>   

                     </div>
                  </div>   
               </div>

            </div>   
         </div>

      <?php endif; ?>

      <!-- End Reviews Addon -->
      <?php endif; ?>
</div>

