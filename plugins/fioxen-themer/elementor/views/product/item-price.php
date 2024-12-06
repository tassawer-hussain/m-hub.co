<?php
	if (!defined('ABSPATH')){ exit; }

	global $fioxen_post, $post;
	if( !$fioxen_post ){ return; }
	if( $fioxen_post->post_type != 'product' ){ return; }
   $post_id = $fioxen_post->ID;
	if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
      global $product;
      $product = wc_get_product($post_id);
   }
?>

<div class="product-item-price">
	<?php woocommerce_template_single_price() ?>
</div>