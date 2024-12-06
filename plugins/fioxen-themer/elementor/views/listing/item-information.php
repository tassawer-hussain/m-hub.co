<?php
   use Elementor\Icons_Manager;

   if (!defined('ABSPATH')){ exit; }
   global $fioxen_post;
   if (!$fioxen_post){ return; }
   if ($fioxen_post->post_type != 'job_listing'){ return;}
   
   $has_icon = ! empty( $settings['selected_icon']['value']);

   $post_id = $fioxen_post->ID;
   $value = '';
   if($settings['key'] == 'type'){
      $types = get_the_terms($post_id, 'job_listing_type');
      if(!empty($types) && !is_wp_error($types)){
         foreach((array)$types as $type){
            $i++;
            $term_id = $type->term_id;
               $value .= '<span class="type-name">' . $type->name . '</span>';
            if( $i < count($types) ) $value .= '<span>&nbsp;, &nbsp;</span>';
         }
      }
   }else{
      $key = '_lt_' . $settings['key'];
      $value = get_post_meta($post_id, $key, true);
   }
?>

<div class="gva-listing-info lt-info-<?php echo esc_attr($settings['key']) ?>">
   <?php if( $value ){ ?>
      <div class="content-inner">
         <?php 
            echo '<span class="info-value">';
               switch ($settings['key']) {
                  case 'phone':
                     echo '<a href="tel:' . esc_attr($value) . '">';
                        if($has_icon) Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '<span>' . esc_html($value) . '</span>';
                     echo '</a>';
                     break;
                  case 'email':
                     echo '<a href="mailto:' . esc_attr($value) . '">';
                        if($has_icon) Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '<span>' . esc_html($value) . '</span>';
                     echo '</a>';
                     break;
                  case 'website':
                     echo '<a href="' . esc_attr($value) . '">';
                        if($has_icon) Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '<span>' . esc_html($value) . '</span>';
                     echo '</a>';
                     break;
                  case 'type':
                     if($has_icon) Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                     echo '<span>' . $value . '</span>';
                     break;
                  default:
                     if($has_icon) Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                     echo '<span>' . esc_html($value) . '</span>';
                  break;
                  
               }
               
         ?>
      </div>
   <?php } ?>
</div>

