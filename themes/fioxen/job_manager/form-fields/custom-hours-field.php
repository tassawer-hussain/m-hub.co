<?php
   if ( ! defined( 'ABSPATH' ) ) {
      exit; // Exit if accessed directly.
   }
   global $post;
   wp_enqueue_script('fioxen-listing-fields');
   $data = array(
      'html_options' => Fioxen_LT_Fields_Model::instance()->select_hours()
   );
   wp_localize_script( 'fioxen-listing-fields', 'fioxen_hour_options', $data);

   $post_id = isset($_REQUEST['job_id']) && !empty($_REQUEST['job_id']) ? absint($_REQUEST['job_id']) : $post->ID;
   $hours = get_post_meta($post_id, '_lt_hours_value', true);
   $days = array(
      'mon' => esc_html__( 'Monday', 'fioxen' ),
      'tue' => esc_html__( 'Tuesday', 'fioxen' ),
      'wed' => esc_html__( 'Wednesday', 'fioxen' ),
      'thu' => esc_html__( 'Thursday', 'fioxen' ),
      'fri' => esc_html__( 'Friday', 'fioxen' ),
      'sat' => esc_html__( 'Saturday', 'fioxen' ),
      'sun' => esc_html__( 'Sunday', 'fioxen' )
   );
?>

<div class="lt-custom-hours-field lt-hours-<?php echo esc_attr($key); ?>">
   
   <?php foreach ($days as $day => $name) { 
      $i = 0;
      $option = isset($hours[$day]['option']) && $hours[$day]['option'] ? $hours[$day]['option'] : '';
   ?>
      <div class="custom-hours-field-item">
         <div class="content-inner">
            <div class="heading-field"> <?php echo esc_html($name) ?></div>
           
            <div class="day-option">
               <select name="lt_hours_items[<?php echo esc_attr($day) ?>][option]">
                  <option value="custom_hours" <?php echo esc_attr($option == 'custom_hours' ? 'selected' : '') ?>><?php echo esc_html__('Enter Hours', 'fioxen') ?></option>
                  <option value="open_day" <?php echo esc_attr($option == 'open_day' ? 'selected' : '') ?>><?php echo esc_html__('Open Day', 'fioxen') ?></option>
                  <option value="close_day" <?php echo esc_attr($option == 'close_day' ? 'selected' : '') ?>><?php echo esc_html__('Closed Day', 'fioxen') ?></option>
               </select>
            </div>

            <div class="field-repeater">
               <div class="content-inner">
                  <?php if(isset($hours[$day]['hrs'])){ 
                     $i = 0;
                     foreach ($hours[$day]['hrs'] as $key => $item) { ?>
                        <div class="field-repeater-item">
                           <select name="lt_hours_items[<?php echo esc_attr($day) ?>][hrs][<?php echo esc_attr($i) ?>][from]">
                              <?php echo Fioxen_LT_Fields_Model::instance()->select_hours($item['from']); ?>
                           </select>
                           <select name="lt_hours_items[<?php echo esc_attr($day) ?>][hrs][<?php echo esc_attr($i) ?>][to]">
                              <?php echo Fioxen_LT_Fields_Model::instance()->select_hours($item['to']); ?>
                           </select>
                           <a class="btn-primary btn-inline-remove btn-remove_custom_hour_item" href="#"><i class="las la-trash"></i></a>
                        </div>   
                  <?php 
                     $i++;
                     }
                  } ?>  
               </div>
               <a class="btn-primary btn-inline-add btn-add_custom_hour_item" data-day=<?php echo esc_attr($day) ?> data-index="<?php echo esc_attr($i) ?>" href="#">
                  <?php echo esc_html__('Add Enter Hour', 'fioxen') ?>
               </a>
            </div>
         </div>   
      </div>
   <?php } ?>
</div>

