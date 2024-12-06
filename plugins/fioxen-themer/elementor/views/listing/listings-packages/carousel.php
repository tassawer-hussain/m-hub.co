<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Icons_Manager;
   
   extract($settings);
   $query = $this->query_posts();
   $classes = array();
   $classes[] = 'gsc-listings-packages layout-carousel swiper-slider-wrapper';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php
               while ( $query->have_posts() ): 
                  $query->the_post(); 
                  global $product;
                  echo '<div class="swiper-slide">';
                     wc_get_template_part('content', 'product-package');
                  echo '</div>';   
               endwhile;
            ?>
         </div>
      </div>      
   </div>
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?> 
</div>
<?php 
  wp_reset_postdata();
