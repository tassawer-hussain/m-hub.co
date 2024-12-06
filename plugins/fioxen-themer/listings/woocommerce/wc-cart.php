<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

class WC_Paid_LT_Package_Cart {

   public function __construct() {
      add_action( 'woocommerce_lt_package_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
      add_filter( 'woocommerce_get_cart_item_from_session', array( $this, 'cart_item_session' ), 10, 2 );
      add_action( 'woocommerce_add_order_item_meta', array( $this, 'order_item_meta' ), 10, 2 );
      add_filter( 'woocommerce_get_item_data', array( $this, 'get_item_data' ), 10, 2 );

      add_filter( 'option_woocommerce_enable_signup_and_login_from_checkout', array( $this, 'enable_signup_and_login_from_checkout' ) );
      add_filter( 'option_woocommerce_enable_guest_checkout', array( $this, 'enable_guest_checkout' ) );
   }

   public function cart_contains_lt_package() {
      global $woocommerce;
      if ( ! empty( $woocommerce->cart->cart_contents ) ) {
         foreach ( $woocommerce->cart->cart_contents as $cart_item ) {
            $product = $cart_item['data'];
            if ( $product->is_type( 'lt_package' ) ) {
               return true;
            }
         }
      }
   }

   public function enable_signup_and_login_from_checkout( $value ) {
      remove_filter( 'option_woocommerce_enable_guest_checkout', array( $this, 'enable_guest_checkout' ) );
      $woocommerce_enable_guest_checkout = get_option( 'woocommerce_enable_guest_checkout' );
      add_filter( 'option_woocommerce_enable_guest_checkout', array( $this, 'enable_guest_checkout' ) );

      if ( 'yes' === $woocommerce_enable_guest_checkout && ( $this->cart_contains_lt_package()  ) ) {
         return 'yes';
      } else {
         return $value;
      }
   }

   public function enable_guest_checkout( $value ) {
      if ( $this->cart_contains_lt_package() ) {
         return 'no';
      } else {
         return $value;
      }
   }

   public function cart_item_session( $cart_item, $values ) {
      if ( ! empty( $values['job_id'] ) ) {
         $cart_item['job_id'] = $values['job_id'];
      }
      return $cart_item;
   }

   public function order_item_meta( $item_id, $values ) {
      if ( isset( $values['job_id'] ) ) {
         $job = get_post( absint( $values['job_id'] ) );
         wc_add_order_item_meta( $item_id, __( 'Job Listing', 'fioxen-themer' ), $job->post_title );
         wc_add_order_item_meta( $item_id, '_job_id', $values['job_id'] );
      }
   }

   public function get_item_data( $data, $cart_item ) {
      if ( isset( $cart_item['job_id'] ) ) {
         $job = get_post( absint( $cart_item['job_id'] ) );

         $data[] = array(
            'name'  => __( 'Listing', 'fioxen-themer' ),
            'value' => $job->post_title
         );
      }
      return $data;
   }

}

new WC_Paid_LT_Package_Cart();