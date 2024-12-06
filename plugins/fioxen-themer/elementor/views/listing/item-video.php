<?php
if (!defined('ABSPATH')){ exit; }
global $fioxen_post;
if (!$fioxen_post){ return; }
if ($fioxen_post->post_type != 'job_listing'){ return;}

$post_id = $fioxen_post->ID;
$video = get_post_meta( $post_id, '_lt_video', true );
$video_embed = false;
$filetype = wp_check_filetype($video);

if ( !empty($video) ):
   if( shortcode_exists( 'flowplayer' ) ) {
      $video_embed = '[flowplayer src="' . esc_url( $video ) . '"]';
   }elseif( !empty($filetype['ext']) ) {
      $video_embed = wp_video_shortcode( array( 'src' => $video ) );
   }else{
      $video_embed = wp_oembed_get( $video );
   } ?>

   <div class="gva-listing-video element-item-listing">
      <?php 
         if($settings['title']){ 
            echo '<h3 class="block-title">';
               echo '<span>' . $settings['title'] . '</span>';
            echo '</h3>';
         }
      ?>
      <div class="block-content">
         <div class="video-content video-responsive"><?php echo trim($video_embed) ?></div>
      </div>
   </div>

<?php endif;