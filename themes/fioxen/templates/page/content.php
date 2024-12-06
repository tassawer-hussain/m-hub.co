<?php 
$page_template = get_page_template_slug();

if($page_template == 'page-listing.php'){
   $settings = fioxen_listings_layout_page();
   $layout = $settings['layout'];
   $per_page = $settings['per_page'];
   $pagination = $settings['pagination_style'] == 'load_more' ? 'show_more="true" show_pagination="false"' : 'show_more="false" show_pagination="true"';
   $show_map = $settings['show_map_top'];

   echo '<script>sessionStorage.clear();</script>';
   echo '<div class="lt-main-page-content lt-page_layout-' . esc_attr($layout) . '">';
      if( $layout == 'filters_left' || $layout == 'filters_right' || $layout == 'filters_top' ){
         if($show_map == 'container'){ 
            echo '<div class="lt-map-top">
               <div class="container">
                  <div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>
               </div>   
            </div>';
          } 

         if($show_map == 'contain-fw'){ 
            echo '<div class="lt-map-top">
               <div class="container-full">
                  <div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>
               </div>   
            </div>';
         }  
      }

      echo '<div class="lt-filter-results">';
      echo '<div class="main-page-content row">';
         echo '<div class="content-page col-12">';
            echo '<div id="wp-content" class="wp-content clearfix">';
               $shortcode = sprintf('[jobs show_tags="true" per_page="%s" %s orderby="featured" order="DESC"]', $per_page, $pagination);
               echo do_shortcode( $shortcode );
               echo '</div>';      
            echo '</div>';    
         echo '</div>'; 
      echo '</div>'; 
      
   echo '</div>';   

}else{
   if(have_posts()) : the_post(); 
      the_content(); 
   endif;
}