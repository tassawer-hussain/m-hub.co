<?php
   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $post_id = $fioxen_post->ID;
   $hours = get_post_meta($post_id, '_lt_hours_value', true);
   $days = array(
      'mon' => esc_html__( 'Monday', 'fioxen-themer' ),
      'tue' => esc_html__( 'Tuesday', 'fioxen-themer' ),
      'wed' => esc_html__( 'Wednesday', 'fioxen-themer' ),
      'thu' => esc_html__( 'Thursday', 'fioxen-themer' ),
      'fri' => esc_html__( 'Friday', 'fioxen-themer' ),
      'sat' => esc_html__( 'Saturday', 'fioxen-themer' ),
      'sun' => esc_html__( 'Sunday', 'fioxen-themer' )
   );
   $check_open = Fioxen_Lising_Theme::instance()->check_open($post_id);
?>

<div class="gva-listing-opening-hour element-item-listing">
   <?php 
      if($settings['title']){ 
         echo '<h3 class="block-title">';
            echo '<span>' . $settings['title'] . '</span>';
         echo '</h3>';
      }
   ?>
   <div class="block-content">
      <?php if( $hours ){ ?>
         <div class="content-inner">
            
            <div class="item today clearfix">
               <label><?php echo esc_html__('Now', 'fioxen-themer') ?></label>
               <div class="text-value text-theme text-right">
                  <?php 
                     if($check_open['check'] == 'open' || $check_open['check'] == 'open_day'){ 
                        echo esc_html__('Open Now', 'fioxen-themer');
                     }else{
                        echo esc_html__( 'Closed Now', 'fioxen-themer' );
                     }
                  ?>   
               </div>
            </div>

            <?php 
               $lt_default_business_hours = fioxen_themer_get_theme_option('lt_default_business_hours', 'open_day');
               foreach ( $days as $key => $day ){
                  $daySchedule =  isset($hours[$key]) ? $hours[$key] : false;
                  $dayScheduleHrs = isset($daySchedule['hrs']) && $daySchedule['hrs'] ? $daySchedule['hrs'] : false;
                  $dayHrs = array();
                  $option_day = isset($daySchedule['option']) && $daySchedule['option'] ? $daySchedule['option'] : 'open_day';
                  
                  if($dayScheduleHrs){
                     foreach ($dayScheduleHrs as $key => $time) {
                        if( isset($time['from']) && isset($time['to']) && $time['from'] && $time['to'] ){
                           $dayHrs[] = array('from' => $time['from'], 'to' => $time['to']);
                        }
                     }
                  }

                  if( $dayHrs && count($dayHrs) || ($option_day == 'open_day' || $option_day == 'close_day')){
                     echo '<div class="item clearfix">';
                        echo '<label>' . esc_html($day) . '</label>';
                        echo '<div class="text-value">';
                           if($option_day == 'open_day'){
                              echo '<span>' . esc_html__('Open', 'fioxen-themer') . '</span>';
                           }
                           if($option_day == 'close_day'){
                              echo '<span>' . esc_html__('Closed', 'fioxen-themer') . '</span>';
                           }
                           if( $option_day == 'custom_hours' && isset($daySchedule['hrs']) && $daySchedule['hrs']){
                              foreach ($daySchedule['hrs'] as $key => $hr) {
                                 if($hr['to'] && $hr['from']){
                                    $time_0 = date(get_option('time_format'), strtotime($hr['from']));
                                    $time_1 = date(get_option('time_format'), strtotime($hr['to']));
                                    echo ('<span class="sub-value">' . preg_replace('/\s/', '', $time_0) . '&nbsp;-&nbsp;' . preg_replace('/\s/', '', $time_1)  . '</span>'); 
                                 }
                              }
                           }
                        echo '</div>';
                     echo '</div>';
                  }else{
                     if($lt_default_business_hours == 'open_day' || $lt_default_business_hours == 'close_day'){
                        echo '<div class="item clearfix">';
                           echo '<label>' . esc_html($day) . '</label>';
                           echo '<div class="text-value">';
                              if($lt_default_business_hours == 'open_day'){
                                 echo '<span>'. esc_html__('Open', 'fioxen-themer') . '</span>';
                              }
                              if($lt_default_business_hours == 'close_day'){
                                 echo '<span>'. esc_html__('Closed', 'fioxen-themer') . '</span>';
                              }
                           echo '</div>';
                        echo '</div>';
                     }
                  }
               }
            ?>

            <div class="current-time">
               <?php 
                  $current_time = date_i18n(get_option('time_format') , false); 
                  $current_date = date_i18n(get_option( 'date_format', false ));
               ?>
               <span class="date"><?php echo esc_html($current_date) ?></span>
               <span class="time"><?php echo esc_html($current_time) ?></span>
            </div>

         </div>
      <?php } ?>
   </div>   
</div>

