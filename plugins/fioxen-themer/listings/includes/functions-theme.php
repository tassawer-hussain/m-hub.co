<?php
class Fioxen_Lising_Theme{
   private static $instance = null;
   public static function instance() {
      if ( is_null( self::$instance ) ) {
         self::$instance = new self();
      }
      return self::$instance;
   }

   public function html_categories($post_id, $print = true){
      //Categories Listing
      $cats = get_the_terms( $post_id, 'job_listing_category' );
      $cats_html = '';
      $i = 0;
      $cat_first_class = 'first-cat';
      if(!empty($cats) && !is_wp_error($cats)){

         foreach((array)$cats as $cat){
            $i++;
            $term_id = $cat->term_id;
            $cat_icon_html = $cat_icon_html_2 = ''; 
            if( get_term_meta($term_id, 'gva_term_icon_type', true) == 'icon_type_font' ){
               if( $icon_font = get_term_meta($term_id, 'gva_term_icon_font', true) ){
                  $cat_icon_html = '<span class="icon"><i class="' . $icon_font . '"></i></span>';
                  $cat_first_class = 'first-cat';
               }
            }else{
               if( $icon_image = get_term_meta($term_id, 'gva_term_icon_image', true) ){
                  $icon_attach = wp_get_attachment_image_src($icon_image, 'thumbnail');
                  if( isset($icon_attach[0]) && $icon_attach[0] ){
                     $cat_icon_html = '<span class="icon"><img src="' . esc_url($icon_attach[0]) . '"/></span>';
                     $cat_first_class = 'first-cat';
                  }
               }
            }
            if( empty($cat_icon_html) ){
               $cat_icon_html = '<span class="icon"><i class="fas fa-tags"></i></span>';
            }
            if( $i == 2 ){ 
               $cats_html .= '<div class="more-cat">';
                  $cats_html .= '<div class="more-cat-number">+' . (count($cats) - 1) .'</div>';
                  $cats_html .= '<div class="more-cat-content">';
            }
                  $cats_html .= '<div class="cat-item ' . ($i == 1 ? $cat_first_class : '') . '">';
                     $cats_html .= '<a href="' . get_category_link( $term_id ) . '">' . $cat_icon_html;
                        $cats_html .= '<span class="cat-name">' . $cat->name . '</span>';
                     $cats_html .= '</a>';   
                  $cats_html .= '</div>';

            if($i > 1 && $i == count($cats)){
               $cats_html .= '</div></div>';
            }
         }
      }
      if($print){
         echo trim($cats_html);
      }else{
         return trim($cats_html);
      }
   }

   public function html_categories_icon($post_id, $print = true){
      //Categories Listing
      $cats = get_the_terms( $post_id, 'job_listing_category' );
      $cats_html = '';
      $i = 0;
      $cat_first_class = 'first-cat';
      if(!empty($cats) && !is_wp_error($cats)){

         foreach((array)$cats as $cat){
            $i++;
            $term_id = $cat->term_id;
            $has_icon = false;
            $cat_icon_html = $cat_icon_html_2 = ''; 
            if( get_term_meta($term_id, 'gva_term_icon_type', true) == 'icon_type_font' ){
               if( $icon_font = get_term_meta($term_id, 'gva_term_icon_font', true) ){
                  $cat_icon_html = '<span class="icon"><i class="' . $icon_font . '"></i></span>';
                  $cat_first_class = 'first-cat';
                  $has_icon = true;
               }
            }else{
               if( $icon_image = get_term_meta($term_id, 'gva_term_icon_image', true) ){
                  $icon_attach = wp_get_attachment_image_src($icon_image, 'thumbnail');
                  if( isset($icon_attach[0]) && $icon_attach[0] ){
                     $cat_icon_html = '<span class="icon"><img src="' . esc_url($icon_attach[0]) . '"/></span>';
                     $cat_first_class = 'first-cat';
                     $has_icon = true;
                  }
               }
            }
            if( empty($cat_icon_html) ){
               $cat_icon_html = '<span class="icon"><i class="fas fa-tags"></i></span>';
            }
            $cats_html .= '<div class="cat-item ' . ($i == 1 ? $cat_first_class : '') . '">';
               $cats_html .= '<a href="' . get_category_link( $term_id ) . '">' . $cat_icon_html;
                  $cats_html .= '<span class="cat-name">' . $cat->name . '</span>';
               $cats_html .= '</a>';   
            $cats_html .= '</div>';
          
         }
      }
      if($print){
         echo trim($cats_html);
      }else{
         return trim($cats_html);
      }
   }

   public function get_first_category($post_id){
      $cats = get_the_terms( $post_id, 'job_listing_category' );
      $results = false;
      $i = 0;
      if( !empty($cats) && !is_wp_error($cats) ){
         foreach((array)$cats as $cat){
            $i++;
            if($i == 1){
               $cat_icon_html = '';
               if( get_term_meta($cat->term_id, 'gva_term_icon_type', true) == 'icon_type_font' ){
                  if( $icon_font = get_term_meta($cat->term_id, 'gva_term_icon_font', true) ){
                     $cat_icon_html = sprintf('<i class="%s"></i>', $icon_font);
                  }
               }else{
                  if( $icon_image = get_term_meta($cat->term_id, 'gva_term_icon_image', true) ){
                     $icon_attach = wp_get_attachment_image_src($icon_image, 'thumbnail');
                     if( isset($icon_attach[0]) && $icon_attach[0] ){
                        $cat_icon_html = sprintf( '<img src="%s" />', esc_url($icon_attach[0]) );
                     }
                  }
               }
               $results = array(
                  'cat_name'     => $cat->name,
                  'id'           => $cat->term_id,
                  'icon_html'    => $cat_icon_html
               );
            }
         }
      }
      return $results;
   }

   public function get_price_range( $post_id, $prefix = '', $suffix = '', $print = true){
      $html = '';
      $lt_currency = fioxen_themer_get_theme_option('lt_currency_symbol', '$');
      $price_range = get_post_meta($post_id, '_lt_price_range', true);
      switch ($price_range) {
         case 'inexpensive':
            $html = $lt_currency;
            break;
         case 'moderate':
            $html = $lt_currency . $lt_currency;
            break;
         case 'pricey':
            $html = $lt_currency . $lt_currency . $lt_currency;
            break;
         case 'ultra-high':
            $html = $lt_currency . $lt_currency . $lt_currency . $lt_currency;
            break;
      }
      $html = $prefix . $html . $suffix;

      if($print){
         echo trim($html);
      }else{
         return trim($html);
      }
   }

   public function get_time_now(){
      $time = current_time(get_option('time_format') , false);
      $time = strtotime($time);
      $day = date('D', $time);
      $day = strtolower($day);
      return array( 'day' => $day, 'time' => $time );
   }

   public function check_open($post_id){
      $day_option = ''; $results = array();
      $current = $this->get_time_now();
      $current_day = $current['day'];
      $current_time = $current['time'];
      //print_r($day_time_now);
      $text_default = fioxen_themer_get_theme_option('lt_default_business_hours', 'open_day') == 'hidden' ? '' : fioxen_themer_get_theme_option('lt_default_business_hours', 'open_day');

      if($text_default == 'open_day') $text_default = esc_html__('Open', 'fioxen-themer');
      if($text_default == 'close_day') $text_default = esc_html__('Closed', 'fioxen-themer');

      $time_value = get_post_meta($post_id, '_lt_hours_value', true);

      $todaySchedule =  isset($time_value[$current_day]) ? $time_value[$current_day] : false;
      if(!$todaySchedule){
         return $results = array('text' => $text_default, 'check' => fioxen_themer_get_theme_option('lt_default_business_hours', 'open_day'));
      }

      if($todaySchedule){
         $day_option = $todaySchedule['option'];
         switch ($day_option) {
            case 'open_day':
               return $results = array('text' => esc_html__('Open', 'fioxen-themer'), 'check' => 'open');
               break;
            case 'close_day':
               return $results = array('text' => esc_html__('Closed', 'fioxen-themer'), 'check' => 'closed');
               break;
            case 'custom_hours':
               if(isset($todaySchedule['hrs']) && $todaySchedule['hrs']){
                  foreach ($todaySchedule['hrs'] as $key => $time) {
                     $from = isset($time['from']) ? strtotime($time['from'], $current_time) : 0;
                     $to = isset($time['to']) ? strtotime($time['to'], $current_time) : 99999999999;
                     if (($from < $current_time) && ($current_time < $to)) {
                        return $results = array('text' => esc_html__('Open', 'fioxen-themer'), 'check' => 'open');
                        break;
                     }
                  }
               }else{
                  return $results = array('text' => $text_default, 'check' => fioxen_themer_get_theme_option('lt_default_business_hours', 'open_day'));
               }
               return $results = array('text' => esc_html__('Closed', 'fioxen-themer'), 'check' => 'closed');
            break;

         }
      }
      $text = fioxen_themer_get_theme_option('lt_default_business_hours', 'open') == 'hidden' ? '' : fioxen_themer_get_theme_option('lt_default_business_hours', 'open_day');
      return $results = array('text' => $text, 'check' => fioxen_themer_get_theme_option('lt_default_business_hours', 'open'));
   }

}