<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;


// Action: woocommerce_after_shop_loop_item_title
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
$package = array(
	'limit'		=> get_post_meta(get_the_ID(), 'lt_package_limit', true ),
	'duration'	=>	get_post_meta(get_the_ID(), 'lt_package_duration', true ),
	'feature'	=> get_post_meta(get_the_ID(), 'lt_package_feature', true )
);
?>

<div <?php post_class(); ?>>
	<div class="package-block">
		<div class="product-block-inner clearfix">
			<div class="package-top">
				<h3 class="title"><?php the_title(); ?></h3>
				<div class="package-price">
					<?php 
						if($product->get_price() == 0){ 
							echo '<span class="price">' . esc_html__('Free', 'fioxen') . '</span>';
							if( $product->is_on_sale() ) {
							   $regular_price = $product->get_regular_price();
							   echo '<del class="regular_price">' . wc_price($regular_price) . '</del>';
							}
				  		}else{
				  			woocommerce_template_loop_price(); 
				  		}
				  	?>
				</div>
				<div class="desc">
					<?php echo the_excerpt() ?>
				</div>	
		 	</div>
			<div class="package-content">
				<div class="content-inner">
					<?php echo the_content() ?>				
				</div>
				<div class="add-to-cart">
				 	<?php woocommerce_template_loop_add_to_cart(); ?>
			 	</div> 
			</div>
		</div>
	</div>	
</div>	
