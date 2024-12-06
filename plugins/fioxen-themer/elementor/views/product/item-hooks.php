<?php
   if (!defined('ABSPATH')){ exit; }

   global $fioxen_post, $post, $fioxen_template_type;
   if( !$fioxen_post ){ return; }
   if( $fioxen_post->post_type != 'product' ){ return; }
   $hook_name = $settings['hook_name'];
   $post_id = $fioxen_post->ID;
   $this->add_render_attribute('block', 'class', [ 'product-item-hook' ]);
?>

<?php if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $fioxen_template_type == 'gva__template'){ ?>
   <div class="woocommerce-notices-wrapper">
      <div class="alert alert-info">
         <div class="alert_wrapper"><?php echo $hook_name; ?></div>
      </div>
   </div>   
<?php } ?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php do_action($hook_name); ?>
</div>
