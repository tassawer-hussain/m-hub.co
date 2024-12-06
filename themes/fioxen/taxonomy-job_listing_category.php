<?php
/**
 * $Desc
 *
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2022 Gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
?>

<?php 
   get_header();
   $page_id = fioxen_id();
   $settings = fioxen_listings_layout_page();
   $layout = $settings['layout'];
   $per_page = $settings['per_page'];
   $container_class = "container";
   $pagination = $settings['pagination_style'] == 'load_more' ? 'show_more="true" show_pagination="false"' : 'show_more="false" show_pagination="true"';
   $show_map = $settings['show_map_top'];
   if( $layout == 'half_map' || $layout == 'half_map_2' ){
      $container_class = "container-full";
      remove_action( 'fioxen_before_page_content', 'fioxen_breadcrumb', '10' );
   }
   if( $show_map == 'container' || $show_map == 'contain-fw' ){
      remove_action( 'fioxen_before_page_content', 'fioxen_breadcrumb', '10' );
   }
   global $wp_query;
   $term =  $wp_query->queried_object;
?>
<script>sessionStorage.clear();</script>
<section id="wp-main-content" class="clearfix main-page">
   <?php do_action( 'fioxen_before_page_content' ); ?>
   <div class="lt-main-page-content lt-page_layout-<?php echo esc_attr($layout) ?>"> 
      
      <?php if( $layout == 'filters_left' || $layout == 'filters_right' || $layout == 'filters_top' ){ ?>
         
         <?php if($show_map == 'container'){ ?>
            <div class="lt-map-top">
               <div class="container">
                  <div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>
               </div>   
            </div>   
         <?php } ?> 

         <?php if($show_map == 'contain-fw'){ ?>
            <div class="lt-map-top">
               <div class="container-full">
                  <div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>
               </div>   
            </div>   
         <?php } ?>    

      <?php } ?>

      <div class="<?php echo esc_attr($container_class) ?>">
         <div class="main-page-content row">
            <div class="content-page col-12">
               <div id="wp-content" class="wp-content clearfix">
                  <?php
                     if ( isset( $term->term_id) ) {
                        $shortcode = sprintf('[jobs categories="%s" show_tags="true" per_page="%s" %s orderby="featured" order="DESC"]', $term->term_id, $per_page, $pagination);
                        echo do_shortcode( $shortcode );
                     }
                  ?>
               </div>      
            </div>      
         </div>   
      </div>   
   </div>
   <?php do_action( 'fioxen_after_page_content' ); ?>
</section>

<?php get_footer(); ?>
