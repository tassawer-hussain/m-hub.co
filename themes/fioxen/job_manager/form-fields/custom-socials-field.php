
<?php
   if ( ! defined( 'ABSPATH' ) ) {
      exit; // Exit if accessed directly.
   }
   global $post;
   wp_enqueue_script('fioxen-listing-fields');
   $post_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? absint($_REQUEST['job_id']) : $post->ID;
   $key = 'lt_social_items';
   $socials = get_post_meta($post_id, '_lt_socials_media_values', true);
?>

<div class="lt-custom-socials-field lt-socials-<?php echo esc_attr( $key ); ?>">
   <div class="custom-socials-field">
      <div class="content-inner">
         <?php 
            $i = 0;
            if($socials){ 
               foreach ($socials as $_key => $item) { 
                  echo '<div class="social-media-item">
                     <div class="col-width-2 col-select">
                        <select name="' . esc_attr($key) . '[' . $i . '][name]">
                           <option value="">' . esc_html__('Select Social Media', 'fioxen') . '</option>
                           <option value="facebook"' . ($item['name']=='facebook' ? ' selected' : '') . '>' . esc_html__('Facebook', 'fioxen') . '</option>
                           <option value="twitter"' . ($item['name']=='twitter' ? ' selected' : '') . '>'. esc_html__('Twitter', 'fioxen') . '</option>
                           <option value="instagram"' . ($item['name']=='instagram' ? ' selected' : '') . '>'. esc_html__('Instagram', 'fioxen') . '</option>
                           <option value="linkedin-in"' . ($item['name']=='linkedin-in' ? ' selected' : '') . '>'. esc_html__('LinkedIn', 'fioxen') . '</option>
                           <option value="youtube"' . ($item['name']=='youtube' ? ' selected' : '') . '>'. esc_html__('Youtube', 'fioxen') . '</option>
                           <option value="snapchat"' . ($item['name']=='snapchat' ? ' selected' : '') . '>'. esc_html__('Snapchat', 'fioxen') . '</option>
                           <option value="reddit"' . ($item['name']=='reddit' ? ' selected' : '') . '>'. esc_html__('Reddit', 'fioxen') . '</option>
                           <option value="tumblr"' . ($item['name']=='tumblr' ? ' selected' : '') . '>'. esc_html__('Tumblr', 'fioxen') . '</option>
                           <option value="pinterest"' . ($item['name']=='pinterest' ? ' selected' : '') . '>'. esc_html__('Pinterest', 'fioxen') . '</option>
                           <option value=discord"' . ($item['name']=='discord' ? ' selected' : '') . '>'. esc_html__('Discord', 'fioxen') . '</option>
                     </select>
                    </div>
                     <div class="col-width-2 col-link">
                        <input type="text" name="'.$key.'[' . $i . '][url]" value="' . esc_attr($item['url']) . '"/>
                     </div>
                     <div class="item-del">
                        <a class="btn-primary btn-inline-remove btn-remove_social_item" href="#"><i class="las la-trash"></i></a>
                     </div>
                  </div>
                  ';
                  $i++;
               }
            }
         ?>
      </div>   
      <a class="btn-primary btn-add_custom_social_item" data-index="<?php echo esc_attr($i) ?>" data-key="<?php echo esc_attr($key) ?>" href="#">
         <?php echo esc_html__('+ Add Social Media', 'fioxen') ?>     
      </a>
   </div>
</div>
