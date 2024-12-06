
<?php
   if ( ! defined( 'ABSPATH' ) ) {
      exit; // Exit if accessed directly.
   }
   global $post;
   wp_enqueue_script('fioxen-listing-fields');
   $post_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? absint($_REQUEST['job_id']) : $post->ID;
   $field_key = $key;
   $infos = get_post_meta($post_id, $field_key . '_value', true);
?>

<div class="lt-custom-additional-info-field lt-additional-info-<?php echo esc_attr( $key ); ?>">
   <div class="custom-additional-info-field">
      <div class="content-inner">
         <?php 
            $i = 0;
            if($infos){ 
               foreach ($infos as $key => $item) { 
                  echo '<div class="additional-info-item">
                     <div class="col-width-2 col-name">
                        <input type="text" name="'. esc_attr($field_key) .'[' . esc_attr($i) . '][name]" value="' . esc_attr($item['name']) . '" placeholder="' . esc_attr('Name', 'fioxen') . '"/>
                    </div>
                     <div class="col-width-2 col-value">
                        <input type="text" name="'. esc_attr($field_key) .'[' . esc_attr($i) . '][val]" value="' . esc_attr($item['val']) . '" placeholder="' . esc_attr('Value', 'fioxen') . '"/>
                     </div>
                     <div class="item-del">
                        <a class="btn-primary btn-inline-remove btn-remove_additional_item" href="#"><i class="las la-trash"></i></a>
                     </div>
                  </div>
                  ';
                  $i++;
               }
            }else{
               echo '<div class="additional-info-item">
                  <div class="col-width-2 col-name">
                     <input type="text" name="'. esc_attr($field_key) .'[0][name]" value="" placeholder="' . esc_attr('Name', 'fioxen') . '"/>
                 </div>
                  <div class="col-width-2 col-value">
                     <input type="text" name="'. esc_attr($field_key) .'[0][val]" value="" placeholder="' . esc_attr('Value', 'fioxen') . '"/>
                  </div>
                  <div class="item-del">
                     <a class="btn-primary btn-inline-remove btn-remove_additional_item" href="#"><i class="las la-trash"></i></a>
                  </div>
               </div>';
            }
         ?>
      </div>   
      <a class="btn-primary btn-add-additional_info_item" data-key="<?php echo esc_attr($field_key) ?>" data-index="<?php echo esc_attr($i) ?>" href="#"><?php echo esc_html__('+ Add Item', 'fioxen') ?></a>
   </div>
</div>
