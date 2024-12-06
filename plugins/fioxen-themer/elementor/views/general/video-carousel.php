<?php
   if (!defined('ABSPATH')) { exit; }
   use Elementor\Group_Control_Image_Size;

   $classes = array();
   $classes[] = 'gva-video-carousel';
   $classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
   $this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">   
      <div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
         <div class="swiper-wrapper">
            <?php foreach ($settings['videos_content'] as $video):
               $image = (isset($video['video_image']['url']) && $video['video_image']['url']) ? $video['video_image']['url'] : '';
               ?>
               <div class="swiper-slide item video-item">
                  <div class="video-item-inner">
                     <div class="video-image">
                        <img src="<?php echo esc_url($image) ?>" alt="<?php echo $video['video_title']; ?>" />
                     </div>
                     <a class="video-link popup-video" href="<?php echo $video['video_link'] ?>"><i class="fa fa-play"></i></a>
                     <?php if($video['video_title']){ ?>
                        <div class="video-title"><?php echo $video['video_title']; ?></div>
                     <?php } ?>   
                  </div>   
               </div>
            <?php endforeach; ?>
         </div>   
      </div>
   </div>
   <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
   <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
