<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

class WC_Paid_LT_Package_Orders {

   private static $instance;
   public static function getInstance() {
      if (!isset(self::$instance) && !(self::$instance instanceof WC_Paid_LT_Package_Orders)) {
         self::$instance = new WC_Paid_LT_Package_Orders();
      }
      return self::$instance;
   }

   public function __construct() {
      add_action( 'woocommerce_thankyou', array( $this, 'woocommerce_thankyou' ), 5 );
      add_action( 'woocommerce_before_my_account', array( $this, 'my_packages' ) );
      add_action( 'woocommerce_order_status_processing', array( $this, 'change_status_order_paid' ) );
      add_action( 'woocommerce_order_status_completed', array( $this, 'change_status_order_paid' ) );
   }

   /* Thanks page Woocommerce */
   public function woocommerce_thankyou( $order_id ) {
      global $wp_post_types;

      $order = wc_get_order( $order_id );

      foreach ( $order->get_items() as $item ) {
         if ( isset( $item['job_id'] ) && 'publish' === get_post_status( $item['job_id'] ) ) {
            switch ( get_post_status( $item['job_id'] ) ) {
               case 'pending' :
                  echo wpautop( sprintf( __( '%s has been submitted successfully and will be visible once approved.', 'fioxen-themer' ), get_the_title( $item['job_id'] ) ) );
               break;
               case 'pending_payment' :
                  echo wpautop( sprintf( __( '%s has been submitted successfully and will be visible once payment has been confirmed.', 'fioxen-themer' ), get_the_title( $item['job_id'] ) ) );
               break;
               default :
                  echo wpautop( sprintf( __( '%s has been submitted successfully.', 'fioxen-themer' ), get_the_title( $item['job_id'] ) ) );
               break;
            }

            echo '<p class="job-manager-submitted-paid-listing-actions">';

            if ( 'publish' === get_post_status( $item['job_id'] ) ) {
               echo '<a class="button" href="' . get_permalink( $item['job_id'] ) . '">' . __( 'View Listing', 'fioxen-themer' ) . '</a> ';
            } elseif ( get_option( 'job_manager_job_dashboard_page_id' ) ) {
               echo '<a class="button" href="' . get_permalink( get_option( 'job_manager_job_dashboard_page_id' ) ) . '">' . __( 'View Dashboard', 'fioxen-themer' ) . '</a> ';
            }

            echo '</p>';

         } 
      }
   }


   public function change_status_order_paid( $order_id ) {
      // Order 
      $order = wc_get_order( $order_id );

      if ( get_post_meta( $order_id, 'wc_paid_lt_packages_processed', true ) ) {
         return;
      }

      foreach ( $order->get_items() as $item ) {
         $product = wc_get_product( $item['product_id'] );
         $product_id = $item['product_id'];

         if ( $product->is_type( array( 'lt_package' ) ) && $order->get_customer_id() ) {

            for ( $i = 0; $i < $item['qty']; $i ++ ) {

               $package = wc_get_product( $product_id );
               if ( !$package->is_type( 'lt_package' ) )  return false;

               $args =  array(
                  'post_title' => $package->get_title() . " - Order {$order_id}",
                  'post_status' => 'publish',
                  'post_type' => 'lt_package'
               );

               $user_package_id = wp_insert_post( $args );

               if ( $user_package_id ) {

                  $metas = array(
                     'lt_package_type'       => $product_id,
                     'lt_package_limit'      => get_post_meta($product_id, 'lt_package_limit', true ),
                     'lt_package_duration'   => get_post_meta($product_id, 'lt_package_duration', true ),
                     'lt_package_count'      => 0,
                     'lt_package_feature'    => get_post_meta($product_id, 'lt_package_feature', true ),
                     'lt_package_user'       => $order->get_customer_id(),
                     'lt_package_order'      => $order_id,
                  );
                  
                  foreach ($metas as $key => $value) {
                     update_post_meta($user_package_id, $key, $value);
                  }  
               }
            }

            if ( isset( $item['job_id'] ) ) {
               $listing = get_post( $item['job_id'] );

               if ( in_array( $listing->post_status, array( 'pending_payment', 'expired' ) ) ) {
                  LT_Package_Function::getInstance()->approve_listing_with_package( $listing->ID, $order->get_customer_id(), $user_package_id );
               }
            }

         }
      }

      update_post_meta( $order_id, 'wc_paid_lt_packages_processed', true );
   }

   public function delete_user_packages( $user_id ) {
      
   }
}

new WC_Paid_LT_Package_Orders();
