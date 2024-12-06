<?php
/**
   * $Desc
   *
   * @author     Gaviasthemes Team     
   * @copyright  Copyright (C) 2022 gaviasthemes. All Rights Reserved.
   * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
   * 
*/
get_header(apply_filters('fioxen_get_header_layout', null )); 
?>

<section id="wp-main-content" class="clearfix main-page">
   <?php 
      remove_action( 'fioxen_before_page_content', 'fioxen_breadcrumb', '10' );
      do_action( 'fioxen_before_page_content' ); 
   ?>
   <div class="container-full clearfix"> 

      <div class="main-page-content">

         <div class="content-page"> 
           <?php while ( have_posts() ) : the_post(); ?>
               <?php the_content(); ?>
            <?php endwhile; ?>
         </div>

      </div>
         
   </div>
  <?php do_action( 'fioxen_after_page_content' ); ?>
</section>  
<?php get_footer(); ?>
