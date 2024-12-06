<?php
   $post_id = $job->ID;
   $tagline = get_post_meta( $post_id, '_lt_tagline', true );
   $class_content = 'listing-content without_thumbnail';
   $status = Fioxen_Lising_Theme::instance()->check_open( $post_id );
   $count_comment = Fioxen_Listing_Comment::instance()->total_reviews($post_id, false, true);
   $suffix_review = $count_comment == 1 ? sprintf(esc_html__('(%s Review)', 'fioxen'), $count_comment) : sprintf(esc_html__('(%s Reviews)', 'fioxen'), $count_comment);
   $review_avg = get_post_meta($post_id, 'lt_reviews_average', true); 
 
   $rterms =  wp_get_post_terms( $post_id, 'job_listing_region' );
   $city = $country = false;
   if ( !empty($rterms) ) {
      foreach ($rterms as $term) {
         if($term->parent == 0){
            $country = $term;
         }else{
            $city = $term;
         }
      }
   }

   $link_region_country = $link_region_city = '';
   if( isset($regions['city']) && $regions['city'] ){
      $link_region_city = get_term_link($regions['city'], 'job_listing_region');
   }
   if(isset($regions['country']) && $regions['country']){
      $link_region_country = get_term_link($regions['country'], 'job_listing_region');
   }
?>
<div class="my-listing-item job_listing listing-block listing-list">
   <div class="listing-content-inner">
      <?php if( has_post_thumbnail($post_id) ){ ?>
         <div class="listing-image">
            <?php $class_content = 'listing-content with_thumbnail'; ?>
            <?php echo get_the_post_thumbnail( $post_id, 'medium', array( 'alt' => get_the_title($post_id) ) ); ?>
            <?php if($status['text']){ ?>
               <div class="listing-time <?php echo esc_attr( $status['check'] ) ?>"><?php echo esc_html($status['text']) ?></div>
            <?php } ?>  
             
            <?php 
               if(class_exists('Fioxen_Addons_Wishlist_Ajax')){
                  Fioxen_Addons_Wishlist_Ajax::instance()->html_icon($post_id);
               }
            ?>
            <?php if( isset($logo[0]) ){ ?>
               <div class="listing-logo"><img src="<?php echo esc_url($logo[0]) ?>" alt="<?php the_title_attribute() ?>" /></div>
            <?php } ?>
         </div>
      <?php } ?>

      <div class="<?php echo esc_attr($class_content) ?>">
         <div class="listing-status <?php echo esc_attr($job->post_status); ?>">
            <?php echo get_post_status($job->ID); ?>
         </div>
         <div class="lt_block-category clearfix">
            <?php Fioxen_Lising_Theme::instance()->html_categories($post_id, true); ?>
         </div>
         <h3 class="title"><a href="<?php the_permalink($post_id) ?>"><?php echo esc_html($job->post_title); ?></a></h3>

         <div class="listing-meta">
            <?php if($city || $country){ ?>
               <div class="location">          
                  <i class="icon fas fa-map-marker-alt"></i>
                  <span class="regions">
                     <?php if( $city ){ ?>
                        <a href="<?php echo esc_url(get_term_link($city->term_id, 'job_listing_region')) ?>"><?php echo esc_html($city->name) ?></a>
                     <?php } ?>
                     <?php if( $country ){ ?>
                        <span>,&nbsp;</span><a href="<?php echo esc_url(get_term_link($country->term_id, 'job_listing_region')) ?>"><?php echo esc_html($country->name) ?></a>
                     <?php } ?>
                  </span>
               </div>
            <?php } ?>
            <?php 
               if(!empty($review_avg) ){ 
                  $review_avg = round( $review_avg, 1 );
                  echo Fioxen_Listing_Comment::instance()->show_star_by_avg($review_avg, '', $suffix_review); 
               } 
            ?> 
         </div>    

      </div> 

      <div class="listing-action clearfix">
         <div class="action-left">
             <div class="listing-date-post listing-meta-item">
               <span class="label"><?php echo esc_html__( 'Date Post:', 'fioxen' ) ?></span>
               <span><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $job->post_date ) ) ); ?></span>
            </div>
            <div class="listing-expires listing-meta-item">
               <span class="label"><?php echo esc_html__( 'Date Expires:', 'fioxen' ) ?></span>
               <span><?php echo esc_html( $job->_job_expires ? date_i18n( get_option( 'date_format' ), strtotime( $job->_job_expires ) ) : '&ndash;' ); ?></span>
            </div>
         </div>
         <div class="action-right">   
            <div class="job-dashboard-actions">
               <?php
                  $actions = [];

                  switch ( $job->post_status ) {
                     case 'publish' :
                        if ( WP_Job_Manager_Post_Types::job_is_editable( $job->ID ) ) {
                           $actions[ 'edit' ] = [ 'label' => __( 'Edit', 'fioxen' ), 'nonce' => false ];
                        }
                        $actions['duplicate'] = [ 'label' => __( 'Duplicate', 'fioxen' ), 'nonce' => true ];
                        break;
                     case 'expired' :
                        if ( job_manager_get_permalink( 'submit_job_form' ) ) {
                           $actions['relist'] = [ 'label' => __( 'Relist', 'fioxen' ), 'nonce' => true ];
                        }
                        break;
                     case 'pending_payment' :
                     case 'pending' :
                        if ( WP_Job_Manager_Post_Types::job_is_editable( $job->ID ) ) {
                           $actions['edit'] = [ 'label' => __( 'Edit', 'fioxen' ), 'nonce' => false ];
                        }
                     break;
                     case 'draft' :
                     case 'preview' :
                        $actions['continue'] = [ 'label' => __( 'Continue Submission', 'fioxen' ), 'nonce' => true ];
                        break;
                  }

                  $actions['delete'] = [ 'label' => __( 'Delete', 'fioxen' ), 'nonce' => true ];
                  $actions           = apply_filters( 'job_manager_my_job_actions', $actions, $job );

                  foreach ( $actions as $action => $value ) {
                     $action_url = add_query_arg( [ 'action' => $action, 'job_id' => $job->ID ] );
                     if ( $value['nonce'] ) {
                        $action_url = wp_nonce_url( $action_url, 'job_manager_my_job_actions' );
                     }
                     echo '<a href="' . esc_url( $action_url ) . '" class="btn-gray-icon job-dashboard-action-' . esc_attr( $action ) . '">' . esc_html( $value['label'] ) . '</a>';
                  }

                  if( class_exists('LT_Package_Function') ){
                     if($job->post_status == 'publish' || $job->post_status == 'expired' || $job->post_status == 'pending'){
                        echo '<a href="#" data-id="' . esc_attr($job->ID) . '" data-bs-toggle="modal" data-bs-target="#popup-ajax-package" class="btn-gray-icon load-lt-package">' . esc_html__('Apply Package', 'fioxen') . '</a>';
                     }
                  }

               ?>
            </div>
         </div>   
      </div>

   </div>
</div>