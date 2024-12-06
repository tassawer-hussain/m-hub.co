<?php
add_theme_support( 'wp-block-styles' );

function fioxen_breadcrumb(){
	$title = '';
	$title = is_search() ? esc_html__('Search', 'fioxen') : $title;
	$title = is_archive() ? get_the_archive_title() : $title;
	$title = is_home() ? esc_html__('Latest posts', 'fioxen') : $title;

	$padding_top = fioxen_get_option('breadcrumb_padding_top', '');
	$padding_bottom = fioxen_get_option('breadcrumb_padding_bottom', '');
	$show_title = fioxen_get_option('breadcrumb_show_title', '1');
	$bg_color = fioxen_get_option('breadcrumb_bg_color', '1');;
	$bg_color_opacity = fioxen_get_option('breadcrumb_bg_opacity', '1');
	$breadcrumb_image = fioxen_get_option('breadcrumb_bg_image', array('id'=> 0));
	$text_style = fioxen_get_option('breadcrumb_text_stype', 'text-light');
	$styles = $styles_inner = $classes = array();
	$styles_overlay = '';

	$classes[] = $text_style;

	if($bg_color){
		$rgba_color = fioxen_convert_hextorgb($bg_color);
		$styles_overlay = 'background-color: rgba(' . esc_attr($rgba_color['r']) . ',' . esc_attr($rgba_color['g']) . ',' . esc_attr($rgba_color['b']) . ', ' . ($bg_color_opacity/100) . ')';
	}

	if(isset($breadcrumb_image['url'])){
		$styles[] = 'background-image: url(\'' . $breadcrumb_image['url'] . '\')';
	}

	if($padding_top){
		$styles_inner[] = "padding-top:{$padding_top}px";
	}
	if($padding_bottom){
		$styles_inner[] = "padding-bottom:{$padding_bottom}px";
	}

	$css = count($styles) ? 'style="' . implode(';', $styles) . '"' : '';
	$css_inner = count($styles_inner) > 0 ? 'style="' . implode(';', $styles_inner) . '"' : '';
?>

	<div class="custom-breadcrumb breadcrumb-default <?php echo implode(' ', $classes); ?>" <?php echo trim($css) ?>>
		<?php if($styles_overlay){ ?>
			<div class="breadcrumb-overlay" style="<?php echo esc_attr($styles_overlay); ?>"></div>
		<?php } ?>
		<div class="breadcrumb-main">
		  	<div class="container">
			 	<div class="breadcrumb-container-inner" <?php echo trim($css_inner) ?>>
			 		<?php 
			 			if($title && $show_title){ 
							echo '<h2 class="heading-title">' . html_entity_decode($title) . '</h2>';
						} 
					 	fioxen_general_breadcrumbs();
					?>
			 	</div>  
		  	</div>   
		</div>  
	</div>

<?php }

add_action( 'fioxen_page_breacrumb', 'fioxen_breadcrumb', '10' );

/**
 * Hook to select footer of page
 */
function fioxen_get_footer_layout(){
	
	if(!class_exists('GVA_Layout_Frontend')){
		return false;
	}

	$post_id = false;
	if(class_exists('WooCommerce') && is_shop()){
		$post_id = wc_get_page_id('shop');
	}else{
		$post = get_post();
		if( $post && isset($post->ID) && $post->ID ){
			$post_id = $post->ID;
		}
	}

	$frontend = new GVA_Layout_Frontend();
	$template_id = $frontend->template_default_active_id();

	$post_meta_template = get_post_meta($post_id, 'fioxen_template_layout', true);
	if( !empty($post_meta_template) && $post_meta_template != '_default_active' && $post_meta_template != '_without_layout' && is_numeric($post_meta_template) ){
		$template_id = $post_meta_template;
	}

	$footer_id = 0;
	if($template_id){
		$footer_id = get_post_meta($template_id, 'footer_layout', true);
	}

	if(!$footer_id){
		$footer_id = $frontend->template_default_active_id('footer_layout');
	}

	return $footer_id;
} 
add_filter( 'fioxen_get_footer_layout', 'fioxen_get_footer_layout' );
 
/**
 * Hook to select header of page
 */
function fioxen_get_header_layout(){
	if(!class_exists('GVA_Layout_Frontend')){
		return false;
	}
	$post_id = false;

	if(class_exists('WooCommerce') && is_shop()){
		$post_id = wc_get_page_id('shop');
	}else{
		$post = get_post();
		if( $post && isset($post->ID) && $post->ID ){
			$post_id = $post->ID;
		}
	}

	$frontend = new GVA_Layout_Frontend();
	$template_id = $frontend->template_default_active_id();
	$post_meta_template = get_post_meta($post_id, 'fioxen_template_layout', true);

	if( !empty($post_meta_template) && $post_meta_template != '_default_active' && is_numeric($post_meta_template) ){
		$template_id = $post_meta_template;
	}

	$header_id = 0;
	if($template_id){
		$header_id = get_post_meta($template_id, 'header_layout', true);
	}

	if(!$header_id){
		$header_id = $frontend->template_default_active_id('header_layout');
	}
	
	$dashboard_pid = get_option( 'job_manager_job_dashboard_page_id');
	if($dashboard_pid == $post_id){
		$header_id = fioxen_get_option('lt_dashboard_header', $header_id);
	}
	
	return $header_id;
} 
add_filter( 'fioxen_get_header_layout', 'fioxen_get_header_layout' );

function fioxen_main_menu(){
	if(has_nav_menu( 'primary' )){
		$fioxen_menu = array(
			'theme_location'    => 'primary',
			'container'         => 'div',
			'container_class'   => 'navbar-collapse',
			'container_id'      => 'gva-main-menu',
			'menu_class'        => ' gva-nav-menu gva-main-menu',
			'walker'            => new Fioxen_Walker()
		);
		wp_nav_menu($fioxen_menu);
	}  
}
add_action( 'fioxen_main_menu', 'fioxen_main_menu', 10 );
 
function fioxen_mobile_menu(){
	if(has_nav_menu( 'primary' )){
		$fioxen_menu = array(
			'theme_location'    => 'primary',
			'container'         => 'div',
			'container_class'   => 'navbar-collapse',
			'container_id'      => 'gva-mobile-menu',
			'menu_class'        => 'gva-nav-menu gva-mobile-menu',
			'walker'            => new Fioxen_Walker()
		);
		wp_nav_menu($fioxen_menu);
	}  
}
add_action( 'fioxen_mobile_menu', 'fioxen_mobile_menu', 10 );

function fioxen_header_mobile(){
	get_template_part('templates/parts/header', 'mobile');
}
add_action('fioxen_header_mobile', 'fioxen_header_mobile', 10);

function fioxen_canvas_mobile(){
	get_template_part('templates/parts/canvas', 'mobile');
}
add_action('fioxen_canvas_mobile', 'fioxen_canvas_mobile', 10);

add_filter('gavias-elements/map-api', 'fioxen_googlemap_api');
function fioxen_googlemap_api( $key = '' ){
   return fioxen_get_option('map_api_key', '');
}

add_filter('gavias-post-type/slug-portfolio', 'fioxen_slug_portfolio');
function fioxen_slug_portfolio( $key = '' ){
	return fioxen_get_option('slug_portfolio', '');
}

function fioxen_setup_admin_setting(){
  	global $pagenow; 
  	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	 	update_option( 'thumbnail_size_w', 175 );  
	 	update_option( 'thumbnail_size_h', 175 );  
	 	update_option( 'thumbnail_crop', 1 );  
	 	update_option( 'medium_size_w', 600 );  
	 	update_option( 'medium_size_h', 540 ); 
	 	update_option( 'medium_crop', 1 );  
  }
}
add_action( 'init', 'fioxen_setup_admin_setting'  );

function fioxen_page_class_names($classes) {
	$post_id = fioxen_id();
 	$class_el = get_post_meta($post_id, 'fioxen_extra_page_class', true);
 	if($class_el) $classes[] = $class_el;
 	$classes[] = 'fioxen-body-loading';
 	return $classes;
}
add_filter( 'body_class', 'fioxen_page_class_names' );

function fioxen_post_classes($classes, $class, $post_id){
   if(is_single($post_id)){
    	$classes[] = 'post-single-content';
   }
   return $classes;
}
add_filter( 'post_class', 'fioxen_post_classes', 10, 3 );


//Contact form 7 dynamic email
add_filter( 'shortcode_atts_wpcf7', 'fioxen_shortcode_atts_wpcf7_filter', 10, 3 );
function fioxen_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
   $my_attr = 'author_email';
   if ( isset( $atts[$my_attr] ) ) {
      $out[$my_attr] = $atts[$my_attr];
   }
   return $out;
}
