<?php
if (!defined('ABSPATH')) {
	 exit; // Exit if accessed directly.
}

if(!class_exists('Fioxen_Listings_Addons')){
  	class Fioxen_Listings_Addons {
  		
	  	private static $instance = null;
	   public static function instance() {
	      if ( is_null( self::$instance ) ) {
	         self::$instance = new self();
	      }
	      return self::$instance;
	   }

		public function init(){
			$this->include_files();
			add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
			add_action( 'init', array( $this, 'register_scripts' ) );
			add_action('admin_enqueue_scripts', array($this, 'register_scripts_admin'));
		}

		public function include_files(){
			require_once('taxonomies/job-listing-amenities.php'); 
			require_once('taxonomies/job-listing-categories.php'); 
			require_once('taxonomies/job-listing-type.php'); 
			require_once('taxonomies/job-listing-region.php'); 
			require_once('taxonomies/job-listing-tags.php'); 
			require_once('taxonomies/term-metabox.php'); 

			require_once('posttypes/job-listing.php'); 

			
			require_once('includes/functions.php');
			require_once('includes/functions-theme.php');
			require_once('includes/filter.php');
			require_once('includes/submit.php');
			require_once('includes/autocomplete.php');

			// Fields
			require_once('fields/model.php');
			require_once('fields/field-types.php');
			require_once('fields/fields-manager.php');
			require_once('fields/fields-listing.php');

			require_once('comment/base.php');
			require_once('comment/backend.php');
			require_once('comment/frontend.php');

			require_once('user/metabox.php');

			//Woocommerce
			if( class_exists('WooCommerce') ){
				$fioxen_enable_paid = 'enable';
				$theme_options = get_option('fioxen_theme_options');
				if(isset($theme_options['lt_enable_paid']) && !empty($theme_options['lt_enable_paid'])){
					$fioxen_enable_paid = $theme_options['lt_enable_paid'];
				}
				if( !class_exists('WC_Paid_Listings') && $fioxen_enable_paid != 'disable' ){
					require_once('woocommerce/post-type.php');
					require_once('woocommerce/wc-product-type.php');
					require_once('woocommerce/wc-cart.php');
					require_once('woocommerce/wc-order.php');
					require_once('woocommerce/function.php');
					require_once('woocommerce/submit-job-form.php');
				}
			}

			require_once('metabox/gallery/gallery.php');
		}

	 	public function register_scripts(){
			$js_dir = plugin_dir_url( __FILE__ ) . 'assets/js';
	 	}

		public function register_scripts_admin() {
			$css_dir = plugin_dir_url( __FILE__ ).'assets/css';
			wp_register_style('fioxen-listing-admin', $css_dir . '/admin.css');
			wp_enqueue_style('fioxen-listing-admin');
	 	}	
  	}
}

