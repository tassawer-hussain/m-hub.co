<?php
   use Elementor\Group_Control_Image_Size;

   $this->add_render_attribute('block', 'class', ['gsc-listing-banner', 'text-' . $settings['content_align'], $settings['style']]);
   
   $desc = $settings['desc'];
   $title_text = $settings['title'];

   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $image_id = $settings['image']['id']; 
   $image_url = $settings['image']['url'];

   if($image_id){
      $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
      if($attach_url) $image_url = $attach_url;
   }

   $taxonomy = $settings['taxonomy'] ? $settings['taxonomy'] : 'ba_location'; 
   $term = $link_term = false;
   if( !empty($settings['term_slug']) ){
      $term = get_term_by( 'slug', $settings['term_slug'], $taxonomy );
      if($term){
         $link_term = get_term_link( $term->term_id, $taxonomy );
      }
   }
   $link = $link_term;
   if( !empty($settings['link_custom']) ) $link = $settings['link_custom'];
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <div class="listings-banner-content">
      
      <?php 
         if ( $settings['show_number_content'] == 'yes' && $term ) {
            if(!empty($settings['term_slug'])){
               echo '<span class="items-count">';
                  echo $term->count . '&nbsp;';
                  echo ($term->count < 2 ? $settings['show_number_one_text'] : $settings['show_number_text']);
               echo '</span>';
            }
         } 
      ?>

      <?php if($image_url){ ?>
         <div class="banner-image">
            <img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_html($title_text) ?>" />
         </div>
      <?php } ?>

      <div class="banner-content">
         <?php if($title_text){ ?>
            <h3 class="title"><?php echo $title_text ?></h3>
         <?php } ?>

         <?php if($desc){ ?>
            <div class="content-inner">
               
               <span class="desc"><?php echo esc_html($desc) ?></span>
               
               <?php 
                  if($settings['style'] == 'style-1'){ 
                     $rating = $settings['rating'];
                     if($rating > 0){
                        echo '<span class="rating">';
                           for ($i=0; $i < 5; $i++) { 
                              echo '<i class="fas fa-star' . ($rating > $i ? ' active' : '') . '"></i>';
                           } 
                        echo '</span>';
                     }
                  } 
               ?>
                  
            </div>
         <?php } ?>

      </div>

      <?php if($link){ ?>
         <a class="link-term-overlay" href="<?php echo esc_url($link); ?>"></a>
      <?php } ?>
               
   </div>
</div>