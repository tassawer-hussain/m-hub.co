<?php
/**
	*
	* @author     Gaviasthemes Team     
	* @copyright  Copyright (C) 2022 Gaviasthemes. All Rights Reserved.
	* @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
	* 
*/

define('FIOXEN_THEME_DIR', get_template_directory());
define('FIOXEN_THEME_URL', get_template_directory_uri());

// Include list of files of theme.
require_once(FIOXEN_THEME_DIR . '/includes/functions.php'); 
require_once(FIOXEN_THEME_DIR . '/includes/template.php'); 
require_once(FIOXEN_THEME_DIR . '/includes/hook.php'); 
require_once(FIOXEN_THEME_DIR . '/includes/comment.php'); 
require_once(FIOXEN_THEME_DIR . '/includes/metaboxes.php');
require_once(FIOXEN_THEME_DIR . '/includes/customize.php'); 
require_once(FIOXEN_THEME_DIR . '/includes/menu.php'); 
require_once(FIOXEN_THEME_DIR . '/includes/elementor/hooks.php');

if( in_array('wp-job-manager/wp-job-manager.php', apply_filters('active_plugins', get_option('active_plugins'))) ){
  	require_once(FIOXEN_THEME_DIR . '/includes/listings/functions.php');
  	require_once(FIOXEN_THEME_DIR . '/includes/listings/listing-data.php');
}

//Load Woocommerce plugin
if(class_exists('WooCommerce')){
	add_theme_support('woocommerce');
	require_once(FIOXEN_THEME_DIR . '/includes/woocommerce/functions.php'); 
	require_once(FIOXEN_THEME_DIR . '/includes/woocommerce/hooks.php'); 
}

// Load Redux - Theme options framework
if(class_exists('Redux')){
	require(FIOXEN_THEME_DIR . '/includes/options/init.php');
	require_once(FIOXEN_THEME_DIR . '/includes/options/opts-general.php'); 
	require_once(FIOXEN_THEME_DIR . '/includes/options/opts-styling.php'); 
	require_once(FIOXEN_THEME_DIR . '/includes/options/opts-page.php'); 
	require_once(FIOXEN_THEME_DIR . '/includes/options/opts-portfolio.php'); 
	if( in_array('wp-job-manager/wp-job-manager.php', apply_filters('active_plugins', get_option('active_plugins'))) ){
		require_once(FIOXEN_THEME_DIR . '/includes/options/opts-lt-general.php'); 
	   require_once(FIOXEN_THEME_DIR . '/includes/options/opts-lt-map.php'); 
	  	require_once(FIOXEN_THEME_DIR . '/includes/options/opts-lt-filter.php'); 
	   require_once(FIOXEN_THEME_DIR . '/includes/options/opts-lt-archives.php'); 
	}
	if(class_exists('WooCommerce')){
		require_once(FIOXEN_THEME_DIR . '/includes/options/opts-woo.php'); 
	}
}

if(class_exists('Fioxen_Listings_Addons')){
	Fioxen_Listings_Addons::instance()->init();
}

// TGM plugin activation
if (is_admin()) {
	require_once(FIOXEN_THEME_DIR . '/includes/tgmpa/class-tgm-plugin-activation.php');
	require(FIOXEN_THEME_DIR . '/includes/tgmpa/config.php');
}
load_theme_textdomain('fioxen', get_template_directory() . '/languages');

//-------- Register sidebar default in theme -----------
//------------------------------------------------------
function fioxen_widgets_init() {
	register_sidebar(array(
		'name' 				=> esc_html__('Default Sidebar', 'fioxen'),
		'id' 					=> 'default_sidebar',
		'description' 		=> esc_html__('Appears in the Default Sidebar section of the site.', 'fioxen'),
		'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	));

	if(class_exists('WooCommerce')){
		register_sidebar( array(
			'name' 				=> esc_html__('WooCommerce Shop Sidebar', 'fioxen'),
			'id' 					=> 'woocommerce_sidebar',
			'description' 		=> esc_html__('Appears in the Plugin WooCommerce section of the site.', 'fioxen'),
			'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'	 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title"><span>',
			'after_title' 		=> '</span></h3>',
		));
	}
	register_sidebar(array(
		'name' 				=> esc_html__('After Offcanvas Mobile', 'fioxen'),
		'id' 					=> 'offcanvas_sidebar_mobile',
		'description' 		=> esc_html__('Appears in the Offcanvas section of the site.', 'fioxen'),
		'before_widget' 	=> '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widget-title"><span>',
		'after_title' 		=> '</span></h3>',
	));
	
}
add_action('widgets_init', 'fioxen_widgets_init');


function fioxen_fonts_url() { 
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';
	$protocol = is_ssl() ? 'https' : 'http';
	if('off' !== _x('on', 'Quicksand font: on or off', 'fioxen')){
		$fonts[] = 'Quicksand:wght@300;400;500;600;700';
	}
	if('off' !== _x('on', 'Muli font: on or off', 'fioxen')){
		$fonts[] = 'Muli:wght@400;500;600;700';
	}
	if($fonts){
		$fonts_url = add_query_arg( array(
			'family' => (implode('&family=', $fonts)),
			'display' => 'swap',
		),  $protocol.'://fonts.googleapis.com/css2');
	}
	return $fonts_url;
}

function fioxen_custom_styles() {
	$custom_css = get_option('fioxen_theme_custom_styles');
	if($custom_css){
		wp_enqueue_style(
			'fioxen-custom-style',
			FIOXEN_THEME_URL . '/assets/css/custom_script.css'
		);
		wp_add_inline_style('fioxen-custom-style', $custom_css);
	}
}
add_action('wp_enqueue_scripts', 'fioxen_custom_styles', 9999);

function fioxen_init_scripts(){
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';
	if ( is_singular() && comments_open() && get_option('thread_comments') ){
		wp_enqueue_script('comment-reply');
	}

	$theme = wp_get_theme('fioxen');
	$theme_version = $theme['Version'];

	wp_enqueue_style('fioxen-fonts', fioxen_fonts_url(), array(), null );
	
	wp_enqueue_script('bootstrap', FIOXEN_THEME_URL . '/assets/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script('mcustomscrollbar', FIOXEN_THEME_URL . '/assets/js/scroll/jquery.mCustomScrollbar.min.js');
	wp_enqueue_script('jquery-magnific-popup', FIOXEN_THEME_URL . '/assets/js/magnific/jquery.magnific-popup.min.js');
	wp_enqueue_script('jquery-cookie', FIOXEN_THEME_URL . '/assets/js/jquery.cookie.js', array('jquery'));
	wp_enqueue_script('swiper', FIOXEN_THEME_URL . '/assets/js/swiper/swiper.min.js');
	wp_enqueue_script('jquery-appear', FIOXEN_THEME_URL . '/assets/js/jquery.appear.js');
	wp_enqueue_script('fioxen-main', FIOXEN_THEME_URL . '/assets/js/main.js', array('imagesloaded', 'jquery-masonry'));
  
	wp_enqueue_style('dashicons');
	wp_enqueue_style('swiper', FIOXEN_THEME_URL .'/assets/js/swiper/swiper.min.css');
	wp_enqueue_style('magnific', FIOXEN_THEME_URL .'/assets/js/magnific/magnific-popup.css');
	wp_enqueue_style('mcustomscrollbar', FIOXEN_THEME_URL . '/assets/js/scroll/jquery.mCustomScrollbar.min.css');
	wp_enqueue_style('fontawesome', FIOXEN_THEME_URL . '/assets/css/fontawesome/css/all.min.css');
	wp_enqueue_style('line-awesome', FIOXEN_THEME_URL . '/assets/css/line-awesome/css/line-awesome.min.css');

	wp_enqueue_style('fioxen-style', FIOXEN_THEME_URL . '/style.css');
	wp_enqueue_style('bootstrap', FIOXEN_THEME_URL . '/assets/css/bootstrap.css', array(), $theme_version , 'all'); 
	wp_enqueue_style('fioxen-template', FIOXEN_THEME_URL . '/assets/css/template.css', array(), $theme_version , 'all');
	
	//Woocommerce
	if(class_exists('WooCommerce')){
		wp_enqueue_style('fioxen-woocoomerce', FIOXEN_THEME_URL . '/assets/css/woocommerce.css', array(), $theme_version , 'all'); 
		wp_dequeue_script('wc-add-to-cart');
		wp_enqueue_script('wc-add-to-cart', FIOXEN_THEME_URL . '/assets/js/add-to-cart.js' , array('jquery'));
	}
} 
add_action('wp_enqueue_scripts', 'fioxen_init_scripts', 999);
