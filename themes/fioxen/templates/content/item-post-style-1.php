<?php 
   global $post;

   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';

   $desc = fioxen_limit_words($excerpt_words, get_the_excerpt(), '');

   $meta_classes = 'entry-meta';
   if(empty(get_the_date())){
      $meta_classes = 'entry-meta schedule-date';
   }
   $content_classes = 'entry-content';
   $content_classes .= has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';
?>

   <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post post-style-1'); ?>>
      
      <?php if(has_post_thumbnail()){ ?>
         <div class="post-thumbnail">
            <a href="<?php echo esc_url( get_permalink() ) ?>">
               <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
            </a>
            <?php if( get_the_date() ){ ?>
               <div class="entry-date">
                  <span class="date"><?php echo esc_html( get_the_date('d')) ?></span>
                  <span class="month"><?php echo esc_html( get_the_date('M')) ?></span>
               </div>
            <?php } ?>
         </div>   
      <?php } ?>   

      <div class="<?php echo esc_attr($content_classes) ?>">
         <div class="content-inner">
            
            <div class="<?php echo esc_attr($meta_classes) ?>">
               <?php fioxen_posted_on(); ?>
            </div>

            <h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
            
            <?php if($desc){ ?>
               <div class="entry-desc">
                  <?php echo esc_html($desc) ?>
               </div>   
            <?php } ?>

            <div class="content-footer">
               <?php
                  if ( in_array( 'category', get_object_taxonomies(get_post_type())) ){
                     echo '<div class="entry-category"><span class="cat-links"><i class="las la-tags"></i>' . get_the_category_list( _x( ", ", "Used between list items, there is a space after the comma.", "fioxen" ) ) . '</span></div>';
                  }
               ?>
               <div class="read-more">
                  <a href="<?php echo esc_url( get_permalink() ) ?>"><i class="arrow fa-solid fa-arrow-right"></i></a>
               </div>
            </div>   

         </div>
      </div>   
   </article>   

  