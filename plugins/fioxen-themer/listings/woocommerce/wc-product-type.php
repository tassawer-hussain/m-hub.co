<?php
defined( 'ABSPATH' ) || exit;

class WC_Product_LT_Package extends WC_Product  {
		
 	public function __construct( $product ) {
	  	$this->product_type = 'lt_package';
		parent::__construct( $product );
 	}
 	
	public function add_to_cart_url() {
		$url = $this->is_purchasable() && $this->is_in_stock() ? remove_query_arg( 'added-to-cart', add_query_arg( 'add-to-cart', $this->id ) ) : get_permalink( $this->id );
		return apply_filters( 'woocommerce_product_add_to_cart_url', $url, $this );
	}

	public function is_sold_individually() {
		return apply_filters( 'wcpl_' . $this->product_type . '_is_sold_individually', true );
	}

	public function is_purchasable() {
		return true;
	}

	public function is_virtual() {
		return true;
	}
}

if (! class_exists('WC_Product_LT_Packge_Type')) {
	class WC_Product_LT_Packge_Type{

		public function __construct(){
			add_filter( 'product_type_selector', array($this, 'product_type_selector') );
			add_filter( 'woocommerce_product_options_general_product_data', array($this, 'product_tab_content'), 10, 1 );
			add_action( 'woocommerce_process_product_meta_lt_package', array( $this, 'save_lt_package_data' ) );
			add_action( "woocommerce_lt_package_add_to_cart", array($this, 'product_add_to_cart') );
			add_action('admin_footer', array($this, 'product_admin_custom_js'));
			add_filter( 'parse_query', array( $this, 'parse_query' ) );

			add_filter( 'option_woocommerce_enable_signup_and_login_from_checkout', array( $this, 'enable_signup_and_login_from_checkout' ) );
      	add_filter( 'option_woocommerce_enable_guest_checkout', array( $this, 'enable_guest_checkout' ) );

		}

		public function product_add_to_cart () {
		  // do_action('woocommerce_simple_add_to_cart');
		}

		public function product_type_selector( $types ){
		 $types[ 'lt_package' ] = __( 'Package of Listings', 'fioxen-themer' );
			return $types;   
		}


		public function product_tab_content() {
			global $post;
			$post_id = $post->ID;
			echo '<div class="options_group show_if_lt_package">';
					woocommerce_wp_text_input(
						array(
						  'id' => 'lt_package_limit',
						  'label' => __( 'Listings Limit', 'fioxen-themer' ),
						  'placeholder' => '10',
						  'type' => 'number',
						  'value'	=>  get_post_meta( $post_id, 'lt_package_limit', true )
						)
					);
					woocommerce_wp_text_input(
						array(
						  'id' => 'lt_package_duration',
						  'label' => __( 'Limit Days Availability', 'fioxen-themer' ),
						  'placeholder' => '30',
						  'description' => __( 'Listings Duration (Days)', 'fioxen-themer' ),
						  'type' => 'number',
						  'value'	=>  get_post_meta( $post_id, 'lt_package_duration', true )

						)
					);
					woocommerce_wp_text_input(
						array(
						  'id' => 'lt_package_featured',
						  'label' => __( 'Listings Featured', 'fioxen-themer' ),
						  'description' => __( 'Enable Featured In Search Results', 'fioxen-themer' ),
						  'type' => 'checkbox',
						  'class'	=> 'checkbox',
						  'value'	=>  get_post_meta( $post_id, 'lt_package_featured', true )
						)
					);
					woocommerce_wp_text_input(
						array(
						  'id' => 'lt_package_icon',
						  'label' => __( 'Package Icon', 'fioxen-themer' ),
						  'placeholder' => 'fa fa-home',
						  'type' => 'text',
						  'value'	=>  get_post_meta( $post_id, 'lt_package_icon', true )
						)
					);


			echo '</div>';
		}
		    
		public function product_admin_custom_js() {
		 	if ('product' != get_post_type()) { return; }
		?>
		 	<script type='text/javascript'>
			  	jQuery(document).ready(function () {
					//for Price tab
					jQuery('.pricing').addClass('show_if_lt_package');
					//for Inventory tab
					jQuery('#product-type').change();
					jQuery('.inventory_options').addClass('show_if_lt_package');
					jQuery('#inventory_product_data ._manage_stock_field').addClass('show_if_lt_package');
					jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_lt_package');
					jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_lt_package');
			  	});
		 	</script>
		 <?php
	 	}

	 	public function parse_query( $query ) {
			global $typenow, $wp_query;
			if ( 'job_listing' === $typenow  ) {
				if ( isset( $_GET['package'] ) ) {
					$query->query_vars['meta_key']   = 'lt_user_package_id';
					$query->query_vars['meta_value'] = absint( $_GET['package'] );
				}
			}
			return $query;
		}

	 	public function save_lt_package_data($post_id){
	 		global $wpdb;
	 		if ( isset( $_POST['lt_package_limit'] ) ) {
				update_post_meta( $post_id, 'lt_package_limit', $_POST['lt_package_limit'] );
			}
			if ( isset( $_POST['lt_package_duration'] ) ) {
				update_post_meta( $post_id, 'lt_package_duration', $_POST['lt_package_duration'] );
			}

			update_post_meta( $post_id, 'lt_package_featured', isset( $_POST['lt_package_featured'] ) ? 'yes' : 'no' );
			
			if ( isset( $_POST['lt_package_icon'] ) ) {
				update_post_meta( $post_id, 'lt_package_icon', $_POST['lt_package_icon'] );
			}

	 	}

	 	public function cart_contains_job_package() {
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

	      if ( 'yes' === $woocommerce_enable_guest_checkout && ( $this->cart_contains_job_package()  ) ) {
	         return 'yes';
	      } else {
	         return $value;
	      }
	   }

	   public function enable_guest_checkout( $value ) {
	      if ( $this->cart_contains_job_package() ) {
	         return 'no';
	      } else {
	         return $value;
	      }
	   }
	}

	new WC_Product_LT_Packge_Type();
}

