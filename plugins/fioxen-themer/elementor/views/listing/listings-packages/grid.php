<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Icons_Manager;

   extract($settings);
   $query = $this->query_posts();
   $this->add_render_attribute('wrapper', 'class', ['gsc-listings-packages layout-grid']);
   

   //add_render_attribute grid
   $this->get_grid_settings();
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div <?php echo $this->get_render_attribute_string('grid') ?>>
      <?php
         while ( $query->have_posts() ){
            $query->the_post(); 
            global $product;
            echo '<div class="item-columns">';
               wc_get_template_part('content', 'product-package');
            echo '</div>';
         }
      ?>
   </div>   
</div>
<?php 
  wp_reset_postdata();