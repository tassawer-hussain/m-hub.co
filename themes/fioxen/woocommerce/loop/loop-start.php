<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

   global $woocommerce_loop; 
   $std_lg = 4; $std_md = 3; $std_sm = 3; $std_xs = 2; 
   if(is_active_sidebar('woocommerce_sidebar')){
      $std_lg = 3; $std_md = 2; $std_sm = 3; $std_xs = 2; 
   }
   $columns_lg = fioxen_get_option('product_columns_lg', $std_lg);
   $columns_md = fioxen_get_option('product_columns_md', $std_md);
   $columns_sm = fioxen_get_option('product_columns_sm', $std_sm);
   $columns_xs = fioxen_get_option('product_columns_xs', $std_xs);
?>

<div class="clearfix"></div>
<div class="products_wrapper grid-view">
	<div class="products lg-block-grid-<?php echo esc_attr($columns_lg); ?> md-block-grid-<?php echo esc_attr($columns_md); ?> sm-block-grid-<?php echo esc_attr($columns_sm); ?> xs-block-grid-<?php echo esc_attr($columns_xs); ?> xx-block-grid-1">