<?php
global $post;
$photos = get_post_meta( $post->ID, '_lt_gallery_images', true );
$cover_single = fioxen_lising_single_cover_style(get_the_ID());
   $random_key = fioxen_random_id();

$data_carousel = '';
$carousel_attributes = array(
   'items'               => 4,
   'items_lg'            => 4,
   'items_md'            => 3,
   'items_sm'            => 3,
   'items_xs'            => 2,
   'items_xx'            => 1,
   'loop'                => 1,
   'speed'               => 800,
   'auto_play'           => 0,
   'auto_play_speed'     => 800,
   'auto_play_timeout'   => 3600,
   'auto_play_hover'     => 1,
   'navigation'          => 0,
   'pagination'          => 0,
   'mouse_drag'          => 1,
   'touch_drag'          => 1,
   'stage_padding'       => 0
);
foreach ($carousel_attributes as $key => $value) {
   $data_carousel .= 'data-' . esc_attr( $key ) . '="' . esc_attr($value) . '" ';
}
?>

<?php if($cover_single == 'cover_gallery'){ ?>
<div class="listing-cover listing-cover-gallery">
   <div class="init-carousel-owl-theme owl-carousel" <?php echo trim($data_carousel) ?>>
      <?php 
         foreach ($photos as $photo){
            $image_full = wp_get_attachment_image_src( $photo, 'full' );
            $image_full_url = isset($image_full[0]) ? $image_full[0] : '';
            $image_thumb = wp_get_attachment_image_src( $photo, 'medium' );
            $image_thumb_url = isset($image_thumb[0]) ? $image_thumb[0] : '';
            $alt = get_post_meta( $photo, '_wp_attachment_image_alt', true);
            $alt = empty($alt) ? $post->post_title : $alt;
            if ($image_full_url) {
            ?>
               <div class="item">
                  <a class="photo-gallery-item" href="<?php echo esc_url($image_full_url); ?>" data-elementor-lightbox-slideshow="<?php echo esc_attr($random_key); ?>">
                     <img src="<?php echo esc_url($image_thumb_url) ?>" alt="<?php echo esc_attr($alt) ?>" />
                     <span class="image-expand"><i class="fas fa-expand"></i></span>
                  </a>
               </div>   
            <?php 
            }
         } 
      ?>
   </div>
</div>
<?php }elseif($cover_single == 'cover_image'){ ?>
   
   <?php 
      $cover_image_id = get_post_meta( $post->ID, '_lt_cover_image', true );
      $cover_image = wp_get_attachment_image_src( $cover_image_id, 'full' );
      if( isset($cover_image[0]) && $cover_image[0] ){
   ?>
      <div class="listing-cover listing-cover-image" style="background-image:url('<?php echo esc_url($cover_image[0]) ?>');">

      </div> 
   <?php } ?>

<?php } ?>
