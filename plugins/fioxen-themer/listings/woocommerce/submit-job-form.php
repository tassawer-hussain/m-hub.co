<?php
class WC_Paid_LT_Submit_Job_Form{
   
   private static $available_package_id      = 0;
   private static $is_use_available_package = false;

   public static function init(){
      add_action('submit_job_steps', array(__CLASS__, 'submit_job_steps'), 20);
      
      if ( ! empty( $_POST['wc_lt_job_package'] ) ) {

         if ( is_numeric( $_POST['wc_lt_job_package'] ) ) {
            self::$available_package_id      = absint( $_POST['wc_lt_job_package'] );
            self::$is_use_available_package = false;
         } else {
            self::$available_package_id      = absint( substr( $_POST['wc_lt_job_package'], 3 ) );
            self::$is_use_available_package = true;
         }

      } elseif ( ! empty( $_COOKIE['available_package_id'] ) ) {

         self::$available_package_id      = absint( $_COOKIE['available_package_id'] );
         self::$is_use_available_package = absint( $_COOKIE['available_package_is_use'] ) === 1;

      }

   }

   public static function submit_job_steps( $steps ){

      $packages = self::get_products();

      if ( !empty($packages) ) {
         $steps['listing-submit-choose-package'] = array(
            'name'     => esc_html__( 'Choose a package', 'fioxen-themer' ),
            'view'     => array( __CLASS__, 'lt_submit_select_package' ),
            'handler'  => array( __CLASS__, 'lt_submit_select_package_handler' ),
            'priority' => 1
         );

         $steps['listing-submit-process-package'] = array(
            'name'     => '',
            'view'     => false,
            'handler'  => array( __CLASS__, 'lt_submit_select_package_handler' ),
            'priority' => 25
         );
         add_filter( 'submit_job_post_status', array( __CLASS__, 'submit_job_post_status' ), 10, 2 );
      }
  
      return $steps;
   }

   public static function get_products() {
      $query_args = array(
         'post_type' => 'product',
         'post_status' => 'publish',
         'posts_per_page'   => -1,
         'order'            => 'asc',
         'orderby'          => 'menu_order',
            'tax_query' => array(
              array(
                  'taxonomy' => 'product_type',
                  'field'    => 'slug',
                  'terms'    => array('lt_package'),
              ),
          ),
      );
      $posts = get_posts( $query_args );

      return $posts;
   }

   public static function submit_job_post_status( $status, $job ) {
      return 'preview' === $job->post_status ? 'pending_payment' : $status;
   }

   public static function lt_submit_select_package($atts = array()) {
      $form = WP_Job_Manager_Form_Submit_Job::instance();
      $job_id    = $form->get_job_id();
      $step      = $form->get_step();
      $form_name = $form->form_name;

      $user_id = get_current_user_id();

      $user_packages = LT_Package_Function::getInstance()->get_packages_by_user($user_id);
      
      $packages = self::get_products();
      ?>
      <form method="post" class="select-lt-submit-package">
         <?php if ( job_manager_user_can_post_job() || job_manager_user_can_edit_job( $job_id ) ) { ?>
            <div class="job_listing_packages_title">
               <input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
               <input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
               <input type="hidden" name="job_manager_form" value="<?php echo esc_attr($form_name); ?>" />
               <h2><?php esc_html_e( 'Choose a package', 'fioxen-themer' ); ?></h2>
            </div>
            <div class="job_listing_types">
               <div id="job-manager-job-dashboard" style="padding:0;margin: 0 0 35px;">
                  <?php  
                     if( !empty($user_packages) ){
                        echo '<div class="lg-block-grid-2 md-block-grid-2 sm-block-grid-2 xs-block-grid-1 my-packages">';
    
                           foreach ($user_packages as $key => $package) { ?>
                              <div class="item-columns">
                                 <div class="package-item margin-bottom-30">
                                    <div class="content-inner">
                                       <input type="radio" checked="checked" name="wc_lt_job_package" value="pk-<?php echo $package['id'] ?>" id="package-<?php echo $package['id'] ?>">
                                       <label class="title" for="package-<?php echo $package['id'] ?>"><?php echo esc_html( $package['title'] ) ?></label>
                                       <div class="package-content">
                                          <div class="content-left">
                                             <div class="package-id">
                                                <span class="label"><?php echo esc_html__('ID', 'fioxen-themer') ?>:</span>
                                                <span><?php echo esc_html($package['id']) ?></span>
                                             </div>
                                             <div class="posted">
                                                <span class="label"><?php echo esc_html__('Posted', 'fioxen-themer') ?>:</span>
                                                <span><?php echo esc_html($package['count']) ?>/<?php echo esc_html($package['limit']) ?></span>
                                             </div>
                                          </div>
                                          <div class="content-right">   
                                             <div class="limit-posts">
                                                <span class="label"><?php echo esc_html__('Limit Posts', 'fioxen-themer') ?>:</span>
                                                <span><?php echo esc_html($package['limit']) ?></span>
                                             </div>
                                             <div class="posted">
                                                <span class="label"><?php echo esc_html__('Duration', 'fioxen-themer') ?>:</span>
                                                <span><?php echo esc_html($package['duration']) ?> <?php echo esc_html__('days', 'fioxen-themer') ?></span>
                                             </div>
                                          </div>   
                                       </div>
                                    </div>
                                 </div>
                              </div>   
                           <?php } 
                        echo '</div>';
                        echo '<div class="clearfix"><button class="btn-theme" type="submit">'.esc_html__('Continue', 'fioxen-themer').'</button></div>';

                     }else{
                        echo '<div class="alert alert-warning">' . esc_html__('You have no Pack Available, You can Purchase Pack Listing', 'fioxen-themer') . '</div>';
                     }
                  ?>
               </div>   

               <?php if ( $packages ) : ?>
                  <div class="widget widget-packages">
                     <div class="row">
                        <?php foreach ( $packages as $key => $package ) :
                           $product = wc_get_product( $package );
                           if ( ! $product->is_type( array( 'lt_package' ) ) || ! $product->is_purchasable() ) {
                              continue;
                           }
                           ?>
                           <div class="col-md-4 col-sm-6 col-xs-12">
                              <div class="package-block">
                                 <div class="product-block-inner clearfix">
                                    <div class="package-top">
                                       <h3 class="title"><?php echo $product->get_title() ?></h3>
                                       <div class="package-price">
                                          <?php 
                                             if($product->get_price() == 0){ 
                                                echo '<span class="price">' . esc_html__('Free', 'fioxen-themer') . '</span>';
                                                if( $product->is_on_sale() ) {
                                                   $regular_price = $product->get_regular_price();
                                                   echo '<del class="regular_price">' . wc_price($regular_price) . '</del>';
                                                }
                                                
                                             }else{
                                                echo '<span class="price">' . $product->get_price_html() . '</span>';
                                             }
                                          ?>
                                       </div>
                                       <div class="desc">
                                          <?php 
                                             if( get_post_field('post_excerpt', $product->get_id()) ) { 
                                                echo get_post_field('post_excerpt', $product->get_id()); 
                                             }
                                          ?>
                                       </div>   
                                    </div>

                                    <div class="package-content">
                                       <div class="content-inner">
                                          <?php 
                                             if( get_post_field('post_content', $product->get_id()) ) { 
                                                echo get_post_field('post_content', $product->get_id()); 
                                             }
                                          ?>   
                                          <div class="add-to-cart">
                                             <button class="btn-theme" type="submit" name="wc_lt_job_package" value="<?php echo esc_attr($product->get_id()); ?>" id="package-<?php echo esc_attr($product->get_id()); ?>">
                                                <?php esc_html_e('Get Started', 'fioxen-themer') ?>
                                             </button>
                                          </div> 
                                       </div>   
                                    </div>
                                 </div>
                              </div>

                           </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
               <?php endif; ?>


            </div>
         <?php } else { ?>
            <div class="alert alert-warning">
               <?php esc_html_e('Please sign in before accessing this page.', 'fioxen-themer'); ?>
            </div>
         <?php } ?>
      </form>
      <?php
   }

   public static function lt_submit_select_package_handler() {
      $form = WP_Job_Manager_Form_Submit_Job::instance();

      $validation = LT_Package_Function::getInstance()->package_is_valid( self::$available_package_id, self::$is_use_available_package );

      if ( is_wp_error( $validation ) ) {
         $form->add_error( $validation->get_error_message() );
         $form->set_step( array_search( 'listing-submit-choose-package', array_keys( $form->get_steps() ) ) );
         return false;
      }

      wc_setcookie( 'available_package_id', self::$available_package_id );
      wc_setcookie( 'available_package_is_use', self::$is_use_available_package ? 1 : 0 );

      if ( 'listing-submit-process-package' === $form->get_step_key() ) {
         if ( self::listing_process_package( self::$available_package_id, self::$is_use_available_package, $form->get_job_id() ) ) {
            $form->next_step();
         }
      } else {
         $form->next_step();
      }

   }

   private static function listing_process_package( $package_id, $is_use_available_package, $job_id ) {
      if ( 'preview' === get_post_status( $job_id ) ) {
         // Update job listing
         $update_job                  = array();
         $update_job['ID']            = $job_id;
         $update_job['post_status']   = 'pending_payment';
         $update_job['post_date']     = current_time( 'mysql' );
         $update_job['post_date_gmt'] = current_time( 'mysql', 1 );
         $update_job['post_author']   = get_current_user_id();
         wp_update_post( $update_job );
      }

      if ( $is_use_available_package ) {
         $user_package = LT_Package_Function::getInstance()->get_lt_package( $package_id );

         update_post_meta( $job_id, '_job_duration', $user_package['duration'] );
         update_post_meta( $job_id, '_featured', $user_package['feature'] ? 1 : 0 );
         update_post_meta( $job_id, '_package_id', $package_id );

         if ( $user_package) {
            update_post_meta( $job_id, '_job_expires', '' );
         }

         // Approve the job
         if ( in_array( get_post_status( $job_id ), array( 'pending_payment', 'expired' ) ) ) {
            LT_Package_Function::getInstance()->approve_listing_with_package( $job_id, get_current_user_id(), $package_id );
         }
         $link_redirect = home_url();
         $job_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
         if($job_dashboard_page_id){
            $link_redirect = get_permalink($job_dashboard_page_id) . '?dashboard=my-listings';
         }
         wp_redirect( $link_redirect );

      } elseif ( $package_id ) {

         $package = wc_get_product( $package_id );
         $listings_duration = get_post_meta($package_id, 'lt_package_duration', true );
         $listings_featured = get_post_meta($package_id, 'lt_package_feature', true );

         update_post_meta( $job_id, '_job_duration', $listings_duration );
         update_post_meta( $job_id, '_featured', $listings_featured ? 1 : 0 );
         update_post_meta( $job_id, '_package_id', $package_id );

         WC()->cart->add_to_cart( $package_id, 1, '', array(), array(
            'job_id' => $job_id
         ) );

         wc_add_to_cart_message( $package_id );

         wc_setcookie( 'available_package_id', '', time() - HOUR_IN_SECONDS );
         wc_setcookie( 'available_package_is_use', '', time() - HOUR_IN_SECONDS );

         wp_redirect( get_permalink( wc_get_page_id( 'checkout' ) ) );
         exit;
      }
   }
}

WC_Paid_LT_Submit_Job_Form::init();