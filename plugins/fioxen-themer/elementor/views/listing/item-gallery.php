<?php
   if (!defined('ABSPATH')){ exit; }

   global $fioxen_post;
   $rand = wp_rand(6);
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   $post_id = $fioxen_post->ID;
   $images = get_post_meta( $post_id, '_lt_gallery_images', true );
   $video = get_post_meta( $post_id, '_lt_video', true );

   $classes = array();
   $classes[] = 'swiper-slider-wrapper';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);

   $style = $style_class = $settings['style'];
   $style_class = ($style == 'style-3' ? 'style-1 style-3' : $style_class);
?>

<div class="gva-listing-gallery <?php echo esc_attr($style_class) ?>">
   
   <?php if( isset($images) && $images && count($images) > 0 && $style == 'style-1' ){ ?>
      <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
         <div class="swiper-content-inner">
            <div class="init-carousel-swiper swiper swiper-3d" data-carousel="<?php echo $this->get_carousel_settings() ?>">
               <div class="swiper-wrapper">
                  <?php 
                     foreach ($images as $key => $image){ 
                        $image_attachment = wp_get_attachment_image_src( $image, $settings['image_size'] );
                        if( isset($image_attachment[0]) && $image_attachment[0] ){
                           echo '<div class="swiper-slide">';
                              echo '<img src="' . esc_url($image_attachment[0]) . '" alt="' . esc_attr($fioxen_post->post_title) . '" />';
                           echo '</div>';
                        }
                     }
                  ?>
               </div>
            </div>
         </div>  
         <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
         <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?> 
      </div>
   <?php } ?>   

   <?php if( isset($images) && $images && count($images) > 0 && $style == 'style-2' ){ ?>
      <div class="swiper-content-inner">
         <div class="init-carousel-swiper swiper swiper-3d" data-carousel="<?php echo $this->get_carousel_settings() ?>">
            <div class="swiper-wrapper">
               <?php 
                  $i = 0;
                  foreach ($images as $key => $image){
                     $i++;
                     $image_attachment = wp_get_attachment_image_src( $image, $settings['image_size'] );
                     $image_url = isset($image_attachment[0]) && $image_attachment[0] ? $image_attachment[0] : '';
                     if( $i % 5 == 1 ){
                        if( $image_url ){
                           echo '<div class="swiper-slide"><div class="image-large">';
                              echo '<a class="lightbox-link" href="'. esc_url($image_url) .'" data-elementor-lightbox-slideshow="'. $rand .'">';
                                 echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($fioxen_post->post_title) . '" />';
                              echo '</a>';
                           echo '</div></div>';
                        }
                     }else{
                        if( $i % 5 == 2) echo '<div class="swiper-slide"><div class="images-small-wrapper">';
                           
                              echo '<div class="small-image-item">';
                                 echo '<a class="lightbox-link" href="'. esc_url($image_url) .'" data-elementor-lightbox-slideshow="'. $rand .'">';
                                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($fioxen_post->post_title) . '" />';
                                 echo '</a>';
                              echo '</div>';

                        if( $i % 5 == 0 or $i == count($images)) echo '</div></div>';
                     }
                  }
               ?>
            </div>
         </div>
         <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
         <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?> 
      </div> 
   <?php } ?>   

   <?php if( $style == 'style-3' ){ 
      $image_url = get_the_post_thumbnail_url($post_id, 'full');
      echo ('<div class="background-image" style="background-image:url(' . esc_url($image_url) . ')">');
      echo '</div>';
   } ?>   

   <?php if($settings['show_media'] == 'yes' && ($video || $images)){ ?>
      <div class="lt-media">
         <?php 
            if($images){
               $i = 1;
               foreach($images as $image){ 
                  $classes = ($i>1) ? 'hidden' : 'lt-gallery';
                  $image_attachment = wp_get_attachment_image_src( $image, 'full' );
                  if( isset($image_attachment[0]) ){ 
                     echo '<a class="' . esc_attr($classes) . '" href="'. esc_url($image_attachment[0]) .'" data-elementor-lightbox-slideshow="'. $rand .'">';
                        if($i == 1){
                           echo '<i class="las la-camera"></i>';
                           echo '<span>' . count($images) . '</span>';
                        }
                     echo '</a>';
                  }  
                  $i = $i + 1;
               }
            }
         ?>

         <?php if($video){ ?>
            <a class="lt-video popup-video" href="<?php echo esc_url($video) ?>"><i class="las la-video"></i></a>
         <?php } ?>
      </div>
   <?php } ?>
</div>