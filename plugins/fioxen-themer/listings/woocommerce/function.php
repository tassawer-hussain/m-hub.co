<?php
class LT_Package_Function{
   
   private static $instance;
   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof LT_Package_Function)) {
         self::$instance = new LT_Package_Function();
      }
      return self::$instance;
   }

   public function __construct(){
      add_action( 'wp_ajax_nopriv_load_lt_package', array($this, 'load_package_html') );
      add_action( 'wp_ajax_load_lt_package', array($this, 'load_package_html') );

      add_action( 'wp_ajax_nopriv_lt_apply_package', array($this, 'apply_package') );
      add_action( 'wp_ajax_lt_apply_package', array($this, 'apply_package') );
   }

   public function get_packages_by_user($user_id){
      $results = array();
      $args = array(
         'post_type' => 'lt_package',
         'post_status' => 'publish', 
         'meta_query'   => array(
            'relation' => 'AND',
            array(
               'key' => 'lt_package_user', 
               'value' => $user_id, 
               'compare' => '=', 
            )
         )
      );
      
      $query = new \WP_Query($args);
      
      if( $query->have_posts() ){
         foreach ( $query->posts as $p ) {
            $package_result = $this->get_lt_package($p->ID);
            $results[$p->ID] = $package_result;
         }
      }
      wp_reset_postdata();

      return $results;
   }

   public function get_lt_package($package_id){
      $product_id = get_post_meta($package_id, 'lt_package_type', true);
      $results = array(
         'id'             => $package_id,
         'product_id'     => $product_id,
         'title'          => get_the_title($product_id),
         'limit'          => get_post_meta($package_id, 'lt_package_limit', true),
         'duration'       => get_post_meta($package_id, 'lt_package_duration', true),
         'count'          => get_post_meta($package_id, 'lt_package_count', true),
         'feature'        => get_post_meta($package_id, 'lt_package_feature', true),
         'user_id'        => get_post_meta($package_id, 'lt_package_user', true),
         'order_id'       => get_post_meta($package_id, 'lt_package_order', true)
      );
      return $results;
   }

   public function package_is_valid($user_id, $package_id){
    
      $package = get_post($package_id);
      
      if ( !$package ) {
         return array(
            '_status' => 'failed',
            'notice' => '<div class="alert alert-warning margin-top-10">' . esc_html__('Listing Package does not exist!', 'fioxen-themer') .'</div>'
         );
      }

      $package_data = $this->get_lt_package($package->ID);

      if ( !$package_data ) {
         return array(
            '_status' => 'failed',
            'notice' => '<div class="alert alert-warning margin-top-10">' . esc_html__('Listing Package does not exist!', 'fioxen-themer') .'</div>'
         );
      }else{
         if($package_data['user_id'] != $user_id){
            return array(
               '_status' => 'failed',
               'notice' => '<div class="alert alert-warning margin-top-10">' .  esc_html__('This package is not yours!', 'fioxen-themer') .'</div>'
            );
         }
         if( $package_data['limit'] && (int)$package_data['limit'] != 0 && (int)$package_data['count'] > 0 && (int)$package_data['limit'] ){
            return array(
               '_status' => 'failed',
               'notice' => '<div class="alert alert-warning margin-top-10">' . esc_html__('Listing Package out of limit!') . '</div>'
            );
         }
      }
      return array(
         '_status' => 'success',
         'notice' => '<div class="alert alert-warning margin-top-10">' .  esc_html__('Listing Package does exist', 'fioxen-themer') . '</div>'
      );
   }

   public function load_package_html(){
      $html = '';
      check_ajax_referer( 'fioxen-ajax-security-nonce', 'security' );
      $listing_id = isset($_POST['listing_id']) && $_POST['listing_id'] ? $_POST['listing_id'] : 0;

      if ( !is_user_logged_in() || $listing_id == 0 ) {
         return;
      }
      $user_id = get_current_user_id();

      $package_id = get_post_meta($listing_id, '_lt_package', true);
      $package = !empty($package_id) ? $this->get_lt_package($package_id) : false;
      $lt_status = get_post_status($listing_id);
      if( $lt_status == 'publish' && $package ){
         $html = sprintf(esc_html__('This listing has applied package "%s", you can only apply package when listing expired!', 'fioxen-themer'), $package['title']);
         echo json_encode(array( 
            'html'    => '<div class="alert alert-warning margin-top-10">' . $html . '</div>'
         ));
         die();
      }

      if( $lt_status == 'pending' && $package ){
         $html =  sprintf(esc_html__('This listing has package "%s" but still pending, listings will be apply package when approve!', 'fioxen-themer'), $package['title']);
         echo json_encode(array( 
            'html'    => '<div class="alert alert-warning margin-top-10">' . $html . '</div>'
         ));
         die();
      }

      $args = array(
         'post_type' => 'lt_package',
         'post_status' => 'publish', 
         'meta_query'   => array(
            'relation' => 'AND',
            array(
               'key' => 'lt_package_user', 
               'value' => $user_id, 
               'compare' => '=', 
            )
         )
      );
      
      $query = new \WP_Query($args);

      $html .= '<div class="notice-text"></div>';
      if($listing_id){
         $html .= '<input type="hidden" value="' . esc_attr($listing_id) . '" id="listing-id-val"/>';
      }
      if( $query->have_posts() ){
         foreach ( $query->posts as $p ) {
            $package = $this->get_lt_package($p->ID);
            $html .= '<div class="package-item" data-package_id="' . esc_attr( $p->ID ) . '">';
               $html .= '<div class="checkbox-field">';
                  $html .= '<input type="radio" checked="checked" name="lt_package_choose" value="' . esc_attr( $p->ID ) . '" id="lt-package-' . esc_attr( $p->ID ) . '">';
                  $html .= '<span>' . esc_html($package['title']) . '</span>';
               $html.= '</div>';
               $html .= '<div class="package-info">';
                  $html .= '<span class="count">' . sprintf( esc_html__('%s jobs posted out of %s', 'fioxen-themer'), $package['count'], $package['limit'] ) . '</span>, ';
                  $html .= '<span class="count">' . sprintf( esc_html__('%s listed for %s days', 'fioxen-themer'), $package['duration'], $package['limit'] ) . '</span>';
               $html .= '</div>';
            $html .= '</div>';
         }

         $html .= '<div class="action margin-top-20 text-left">';
            $html .= '<a href="#" class="btn-theme btn-small btn-apply-package">'. esc_html__('Apply Package', 'fioxen-themer') . '</a>';
         $html .= '</div>';
      }else{
         $html .= '<div class="alert alert-warning">' . esc_html__( 'You don\'t have a package listings, you can buy package listings before!', 'fioxen-themer' ) . '</div>';
      }
      wp_reset_postdata();
      echo json_encode(array( 'html' => $html ));
      die();
   }

   public function apply_package(){
      check_ajax_referer( 'fioxen-ajax-security-nonce', 'security' );
      $listing_id = isset($_POST['listing_id']) && $_POST['listing_id'] ? $_POST['listing_id'] : 0;
      $package_id = isset($_POST['package_id']) && $_POST['package_id'] ? $_POST['package_id'] : 0;
      
      if ( !is_user_logged_in() || $listing_id == 0 || !$package_id ){
         return;
      }

      $user_id = get_current_user_id();
      $package = $this->get_lt_package($package_id);

      if( $package['user_id'] =! $user_id){
         echo json_encode(array( 
            '_status' => 'failed',
            'notice'    => esc_html__('This package is not yours!', 'fioxen-themer')
         ));
         die();
      }
      $check_valid = $this->package_is_valid($user_id, $package_id);
      
      if($check_valid['_status'] == 'failed'){
         echo json_encode($check_valid);
         die();
      }

      $lt_status = get_post_status($listing_id);
      $job_expires = get_post_meta($listing_id, '_job_expires', true);
      $old_package_id = get_post_meta($listing_id, '_lt_package', true);
      $old_package = !empty($old_package_id) ? $this->get_lt_package($old_package_id) : false;

      if( $lt_status == 'publish' && $old_package ){
         echo json_encode(array( 
            '_status' => 'failed',
            'notice'    => '<div class="alert alert-warning">' . sprintf(esc_html__('This listing has applied package "%s", you can only apply package when listing expired !', 'fioxen-themer'), $old_package['title']) . '</div>'
         ));
         die();
      }

      if( $lt_status == 'pending' && $old_package ){
         echo json_encode(array( 
            '_status' => 'failed',
            'notice'    => '<div class="alert alert-warning">' . sprintf(esc_html__('This listing has add package "%s" but still pending, listings will be apply package when approve !', 'fioxen-themer'), $old_package['title'])  . '</div>'
         ));
         die();
      }

      if( $lt_status == 'expired' || ($lt_status == 'pending' && !$old_package ) || ( $lt_status == 'publish' && !$old_package ) ){
         $duration = $package['duration'];
         
         if( $lt_status == 'expired' || ($lt_status == 'publish' && !$old_package ) ){
            $expires = date( 'Y-m-d', strtotime( "+{$duration} days", current_time( 'timestamp' ) ) );
            update_post_meta( $listing_id, '_job_expires', $expires );
            $query = array(
              'ID' => $listing_id,
              'post_status' => 'publish',
            );
            wp_update_post( $query, true );
            $this->add_package_count($package_id, $user_id);
            update_post_meta($listing_id, '_lt_package', $package_id);

            echo json_encode(array( 
               '_status' => 'success',
               'notice'    => '<div class="alert alert-success">' . esc_html__('Apply Package for listing success! Reloading ...', 'fioxen-themer') . '</div>'
            ));
            die();
         }

         if( $lt_status == 'pending' && !$old_package ){
            update_post_meta($listing_id, '_lt_package', $package_id);
            update_post_meta( $listing_id, '_job_duration', $package['duration'] );
            update_post_meta( $listing_id, '_job_expires', '' ); // Never expire automatically
            $this->add_package_count($package_id, $user_id);
            echo json_encode(array( 
               '_status' => 'success',
               'notice'    => '<div class="alert alert-success">' . esc_html__('Apply Package for pending listing success! Reloading ...', 'fioxen-themer'). '</div>'
            ));
            die();
         }

         echo json_encode(array( 
            '_status' => 'failed',
            'notice'    => '<div class="alert alert-warning">' . esc_html__('Apply Package for listing unsuccess! Reloading ...', 'fioxen-themer') . '</div>'
         ));
         die();
      }
   }

   public function add_package_count($lt_package_id, $user_id){
      if ( empty(get_post( $lt_package_id )) ) {
         return false;
      }

      $package = $this->get_lt_package($lt_package_id);
      if($package['user_id'] != $user_id){
         return false;
      }

      $package_count = intval(get_post_meta($lt_package_id, 'lt_package_count', true)) + 1;
      update_post_meta($lt_package_id, 'lt_package_count', $package_count);
   }

   public function approve_listing_with_package( $listing_id, $user_id, $lt_package_id ) {
      if ( $this->package_is_valid( $user_id, $lt_package_id ) ) {
         
         $listing = array(
            'ID'            => $listing_id,
            'post_date'     => current_time( 'mysql' ),
            'post_date_gmt' => current_time( 'mysql', 1 )
         );

         $post_type = get_post_type($listing_id);

         if ( $post_type === 'job_listing' ) {
            delete_post_meta( $listing_id, '_job_expires' );
            $listing['post_status'] = get_option( 'job_manager_submission_requires_approval' ) ? 'pending' : 'publish';
         }

         // Update Lising
         wp_update_post( $listing );
         update_post_meta( $listing_id, '_lt_package', $lt_package_id );
         $this->add_package_count( $lt_package_id, $user_id);
         
      }
   }

}

new LT_Package_Function();