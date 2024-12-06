<?php
function fioxen_id(){
 	if(class_exists('WooCommerce') && is_shop()){
		$pid = wc_get_page_id('shop');
 	}elseif(is_page() || is_singular()){
		$pid = get_the_ID();
 	}else{
		$pid = '';
 	}
 	return $pid;
}

function fioxen_get_page_layout(){
 	$layouts = array();
 	$layouts[''] = esc_html__('-- Select Layout --', 'fioxen');
 	$layouts['_without_layout'] = esc_html__('_Default Page Content (Breadcrumb + Container)', 'fioxen');
 	$layouts['_default_active'] = esc_html__('_Default Page Layout Actived', 'fioxen');
 	if(class_exists('GVA_Layout_Model')){
 		$page_layouts = GVA_Layout_Model::getInstance()->get_templates('page_layout', 'title', 'desc');
 		if($page_layouts){
	 		foreach ($page_layouts as $item) {
	 			$layouts[$item['id']] = $item['title'];
	 		}
	 	}
 	}
 	return $layouts;
}

function fioxen_get_single_listing_layout(){
   $layouts = array();
   $layouts[''] = esc_html__('-- Select Layout --', 'fioxen');
   $layouts['_default_active'] = esc_html__('_Default Single Template Actived', 'fioxen');
   if(class_exists('GVA_Layout_Model')){
      $page_layouts = GVA_Layout_Model::getInstance()->get_templates('listing_single_layout', 'title', 'desc');
      if($page_layouts){
         foreach ($page_layouts as $item) {
            $layouts[$item['id']] = $item['title'];
         }
      }
   }
   return $layouts;
}

function fioxen_general_breadcrumbs() {
 	$delimiter = '';
 	$home = esc_html__('Home', 'fioxen');
 	$before = '<li class="active">';
 	$after = '</li>';
 	$breadcrumb = '';
 	if(!is_home() && !is_front_page() || is_paged()) {

		$breadcrumb .= '<ol class="breadcrumb">';

		global $post;
		$breadcrumb .= '<li><a href="' . esc_url(home_url()) . '">' . $home . '</a> ' . $delimiter . '</li> ';

		if(is_category()){
		  
		  	global $wp_query;
		  	$cat_obj = $wp_query->get_queried_object();
		  	$thisCat = $cat_obj->term_id;
		  	$thisCat = get_category($thisCat);
		  	$parentCat = get_category($thisCat->parent);
		  	if ($thisCat->parent != 0) $breadcrumb .= (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
		  	$breadcrumb .= $before . single_cat_title('', false) . $after;
	  
		}elseif(is_day()){
		  
		  	$breadcrumb .= '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a>' . ' ' . $delimiter . ' ' . '</li>';
		  	$breadcrumb .= '<li><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a>' . ' ' . $delimiter . ' ' . '</li>';
		  	$breadcrumb .= $before . get_the_time('d') . $after;
	  
		}elseif(is_month()){
		 
		  	$breadcrumb .= '<li><a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a>' . ' ' . $delimiter . ' ' . '</li>';
		  	$breadcrumb .= $before . get_the_time('F') . $after;
	  
		}elseif(is_year()){
		 
		  	$breadcrumb .= $before . get_the_time('Y') . $after;
		
		}elseif( is_search() || get_query_var('s')){

		  	$breadcrumb .= $before . esc_html__('Search results for', 'fioxen') . '"' . get_search_query() . '"' . $after;

		}elseif(is_single() && !is_attachment()){
		  	
		  	if ( get_post_type() != 'post' ) {
			 	if(get_the_title()){
					$breadcrumb .= $before . get_the_title() . $after;
			 	}
		  	}else{
			 	$cat = get_the_category(); $cat = $cat[0];
			 	$breadcrumb .= $before . get_category_parents($cat, TRUE, '') . $after;
		  	}

		}elseif(!is_single() && !is_page() && get_post_type() != 'post' && !is_404()){
		  
		  	$post_type = get_post_type_object(get_post_type());
		  	if( $post_type ){
			 	$breadcrumb .= $before . $post_type->labels->singular_name . $after;
		  	}

		}elseif(is_attachment()){

		  	$parent = get_post($post->post_parent);
		  	$cat = get_the_category($parent->ID); 
		  	if(isset($cat[0]) && $cat[0]){
			 	$cat = $cat[0];
			 	$breadcrumb .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		  	}
		  	$breadcrumb .= '<li><a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
		  	$breadcrumb .= $before . get_the_title() . $after;

		}elseif(is_page() && !$post->post_parent){
		  
		  	$breadcrumb .= $before . get_the_title() . $after;

		}elseif(is_page() && $post->post_parent){

		  	$parent_id  = $post->post_parent;
		  	$breadcrumbs = array();
		  	while ($parent_id) {
			 	$page = get_page($parent_id);
			 	$breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a></li>';
			 	$parent_id  = $page->post_parent;
		  	}
		  	$breadcrumbs = array_reverse($breadcrumbs);
		  	foreach ($breadcrumbs as $crumb) $breadcrumb .= ($crumb) . ' ' . $delimiter . ' ';
		  	$breadcrumb .= $before . get_the_title() . $after;

		}elseif(is_tag()){

		  $breadcrumb .= $before . esc_html__('Posts tagged', 'fioxen') . '"' . single_tag_title('', false) . '"' . $after;

		}elseif(is_author()){

		  	global $author;
		  	$userdata = get_userdata($author);
		  	if($userdata){
			 	$breadcrumb .= $before . esc_html__('Articles posted by', 'fioxen') . $userdata->display_name . $after;
		  	} 

		}elseif(is_404()){
		  	$breadcrumb .= $before . esc_html__('Error 404', 'fioxen') . $after;
		}

		if(get_query_var('paged')){
		  	$breadcrumb .= $before . esc_html__('Page','fioxen') . ' ' . get_query_var('paged') . $after;
		}

		$breadcrumb .= '</ol>';
		echo html_entity_decode($breadcrumb);
 	}
}

function fioxen_comment_nav() {
  if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
  ?>
  	<nav class="navigation comment-navigation" role="navigation">
	 	<h2 class="screen-reader-text"><?php esc_html__( 'Comment navigation', 'fioxen' ); ?></h2>
	 	<div class="nav-links">
			<?php
			  	if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'fioxen' ) ) ) :
				 	printf( '<div class="nav-previous">%s</div>', $prev_link );
			  	endif;

			  	if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'fioxen' ) ) ) :
				 	printf( '<div class="nav-next">%s</div>', $next_link );
			  	endif;
			?>
	 	</div>
  	</nav>
  <?php
  endif;
}

function fioxen_category_count( $links ) {
  	$links = str_replace( '(', '<span class="count">(', $links );
  	$links = str_replace( ')', ')</span>', $links );
  	return $links;
}
add_filter( 'wp_list_categories', 'fioxen_category_count' );

function fioxen_archive_count($links) {
  	$links = str_replace( '&nbsp;(', '<span class="count">(', $links );
  	$links = str_replace( ')', ')</span>', $links );
  	return $links;
}
add_filter( 'get_archives_link', 'fioxen_archive_count' );

function fioxen_limit_words($word_limit, $string, $string_second = ''){
	$string = !empty($string) ? esc_html($string) : esc_html($string_second);
  	if(!empty($string)){
	  	$words = explode(' ', $string, ($word_limit + 1));
	  	if(count($words) > $word_limit)
	  	array_pop($words);
	  	return implode(' ', $words);
	}
	return '';
}

function fioxen_get_options(){
 		global $fioxen_theme_options;
 		return $fioxen_theme_options;
	}

function fioxen_get_option($key, $default = ''){
 	global $fioxen_theme_options;
 	if(isset($fioxen_theme_options[$key]) && $fioxen_theme_options[$key]){
		return $fioxen_theme_options[$key];
 	}else{
		return $default;
 	}
}

function fioxen_random_id($length=4){
 	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
 	$string = '';
 	for ($i = 0; $i < $length; $i++) {
		$string .= $characters[rand(0, strlen($characters) - 1)];
 	}
 	return $string;
}

function fioxen_convert_hextorgb($hex, $alpha = false) {
 	$hex = str_replace('#', '', $hex);
 	if ( strlen($hex) == 6 ){
		$rgb['r'] = hexdec(substr($hex, 0, 2));
		$rgb['g'] = hexdec(substr($hex, 2, 2));
		$rgb['b'] = hexdec(substr($hex, 4, 2));
 	}else if ( strlen($hex) == 3 ){
		$rgb['r'] = hexdec(str_repeat(substr($hex, 0, 1), 2));
		$rgb['g'] = hexdec(str_repeat(substr($hex, 1, 1), 2));
		$rgb['b'] = hexdec(str_repeat(substr($hex, 2, 1), 2));
 	}else {
		$rgb['r'] = '0';
		$rgb['g'] = '0';
		$rgb['b'] = '0';
  	}
  	if ($alpha) {
		$rgb['a'] = $alpha;
 	}
 	return $rgb;
}

function fioxen_image_attach($post_id, $key, $single = true, $thumbnail = 'thumbnail') {
   $result = false;
   $attach = get_post_meta(get_the_ID(), $key, $single);
   if($attach){
      if( !$single ){
         $result = array();
         foreach ($attach as $id) {
            $result[] = wp_get_attachment_image_src($id, $thumbnail);
         }
      }else{
         $result =  wp_get_attachment_image_src($attach, $thumbnail);
      }
   }
   return $result;
}

function fioxen_get_post_value($key, $default = ""){
  	$result = '';
  	if( isset($_POST[$key]) && $_POST[$key] ){
    	$result = $_POST[$key];
  	}else{
    	$result = $default;
  	}
  	return $result;
}