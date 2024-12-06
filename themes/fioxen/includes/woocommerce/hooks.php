<?php
add_filter('woocommerce_enqueue_styles', '__return_false');

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 10);
add_action('woocommerce_after_single_product_summary', 'fioxen_woocommerce_output_product_data', 10);

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_main_content', 'fioxen_woocommerce_breadcrumb', 20);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

add_filter('loop_shop_per_page', 'fioxen_woocommerce_shop_pre_page', 20);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title',  'fioxen_swap_images', 10);

// Add save percent next to sale item prices.
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_title', 'fioxen_woocommerce_custom_sales_price', 10);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

add_action('woocommerce_product_query', 'fioxen_hidden_lt_package_in_shop');
add_action('woocommerce_products_widget_query_args', 'fioxen_hidden_lt_package_in_widget');

function fioxen_hidden_lt_package_in_shop($wp_query){
  	$tax_query = array(
		array(
			'taxonomy' => 'product_type',
			'field'    => 'slug',
			'terms'    => array(
				'lt_package'
			),
			'operator' => 'NOT IN'
		)
  	);
  $wp_query->set( 'tax_query', $tax_query );
  return $wp_query;
}

function fioxen_hidden_lt_package_in_widget($query_args){
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'product_type',
			'field'    => 'slug',
			'terms'    => array(
				'lt_package'
			),
			'operator' => 'NOT IN'
		)
  	);
  	return $query_args;
}

function fioxen_woocommerce_custom_sales_price() {
	global $product;
	if($product->get_sale_price()){
		$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100);
		echo ('<span class="onsale">-' . $percentage . '%</span>' );
	}
}

function fioxen_woocommerce_shop_pre_page(){
	return fioxen_get_option('products_per_page', 6);
}

add_theme_support('woocommerce', array(
	'gallery_thumbnail_image_width' => 180,
));

function fioxen_woocommerce_breadcrumb(){
	$woo_breadcrumb = fioxen_get_option('woo_breadcrumb', 1);
	if(!$woo_breadcrumb){return;}

	$breadcrumb_padding_top = fioxen_get_option('woo_breadcrumb_padding_top', '120');
	$breadcrumb_padding_bottom = fioxen_get_option('woo_breadcrumb_padding_bottom', '120');
	$breadcrumb_title = fioxen_get_option('woo_breadcrumb_title', 0);

	$breadcrumb_bg_color = fioxen_get_option('woo_breadcrumb_bg_color', '');
	$breadcrumb_bg_color_opacity = fioxen_get_option('woo_breadcrumb_bg_opacity', '50');
	$breadcrumb_bg = fioxen_get_option('woo_breadcrumb_bg', 0);
	$breadcrumb_bg_image = fioxen_get_option('woo_breadcrumb_bg_image', array('id'=> 0));

	$breadcrumb_text_style = fioxen_get_option('woo_breadcrumb_text_stype', 'text-light');
	$breadcrumb_text_align = fioxen_get_option('woo_breadcrumb_text_align', 'text-left');

	if(is_singular('product')){
		$_title = get_the_title();
	}elseif(is_shop()){
		$title = woocommerce_page_title(false);
	}else{
		$title = get_the_archive_title();
	}

	$classes = array();
	$styles = array();
	$styles_inner = array();
	$css = $css_inner = $css_overlay = '';

	if(isset($breadcrumb_bg_image['url']) && $breadcrumb_bg_image['url'] && $breadcrumb_bg){
		$styles[] = 'background-image: url(\'' . $breadcrumb_bg_image['url'] . '\')';
	}

	if($breadcrumb_bg_color){
		$rgba_color = fioxen_convert_hextorgb($breadcrumb_bg_color);
		$css_overlay = 'background-color: rgba(' . esc_attr($rgba_color['r']) . ',' . esc_attr($rgba_color['g']) . ',' . esc_attr($rgba_color['b']) . ', ' . ($breadcrumb_bg_color_opacity/100) . ')';
	}

	if($breadcrumb_padding_top){
		$styles_inner[] = "padding-top:{$breadcrumb_padding_top}px";
	}

	if($breadcrumb_padding_bottom){
		$styles_inner[] = "padding-bottom:{$breadcrumb_padding_bottom}px";
	}

	$css = count($styles) ? 'style="' . implode(';', $styles) . '"' : '';
	$css_inner = count($styles_inner) > 0 ? 'style="' . implode(';', $styles_inner) . '"' : '';
	
?>
	<div class="custom-breadcrumb" <?php echo html_entity_decode($css) ?>>
		<?php if($css_overlay){ ?>
			<div class="breadcrumb-overlay" style="<?php echo esc_attr($css_overlay); ?>"></div>
		<?php } ?>
		<div class="breadcrumb-main">
			<div class="container">
			 <div class="breadcrumb-container-inner" <?php echo html_entity_decode($css_inner) ?>>
				<?php if( !empty($title) && $breadcrumb_title ){ ?>
					<h2 class="heading-title"><?php echo html_entity_decode($title) ?></h2>
				<?php } ?>
				<?php fioxen_general_breadcrumbs(); ?>
			 </div>  
			</div>   
		</div>  
	</div>
	<?php
}

add_action('fioxen_woocommerce_breacrumb', 'fioxen_woocommerce_breadcrumb');

function fioxen_woocommerce_output_product_data_accordions() {
	wc_get_template('single-product/tabs/accordions.php' );
}

function fioxen_woocommerce_output_product_data(){
	global $post;
	$tab_style = get_post_meta($post->ID, 'fioxen_product_tab_style', true);
	$tab_style = 'tabs';
	if($tab_style == 'accordion'){
		fioxen_woocommerce_output_product_data_accordions();
	}else{
		woocommerce_output_product_data_tabs();
	}
}

function fioxen_swap_images(){
	global $post, $product, $woocommerce;
	$image_size = wc_get_image_size('woocommerce_thumbnail');
	$_width = isset($image_size['width']) ? $image_size['width'] : 'auto';
	$_height = isset($image_size['height']) ? $image_size['height'] : 'auto';
	$output = '';
	$class = 'image';
	$output .= '<a class="link-overlay" href="' . get_the_permalink() . '"></a>';
	if(has_post_thumbnail()){
		$output .= '<span class="attachment-shop_catalog">' . get_the_post_thumbnail( $post->ID,'shop_catalog', array('class'=>'') ) . '</span>';
	}else{
		$output .= '<img src="'.wc_placeholder_img_src().'" alt="'. $post->title .'" class="'.$class.'" width="'.$_width.'" height="'.$_height.'" />';
	}
	echo trim($output);
}

function fioxen_single_page_published_and_draft_posts($query){
	$uid = get_current_user_id();
	if(is_single()){
		$pid = isset($query->query['p']) ? $query->query['p'] : '';
		if($pid){
			$post = get_post($pid);
			if($post){
				$author_id = $post->post_author;
				if($uid == $author_id){
					$query->set('post_status', 'publish,draft');
				}
			}
		}
	}
}
add_action('pre_get_posts', 'fioxen_single_page_published_and_draft_posts'); 

