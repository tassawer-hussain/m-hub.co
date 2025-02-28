<?php
   use Elementor\Icons_Manager;
   $style = $settings['style'];
   $description_text = $settings['description_text'];
   $header_tag = 'h2';
   if(!empty($settings['header_tag'])) $header_tag = $settings['header_tag'];
   $has_icon = ! empty( $settings['selected_icon']['value']);
   $title_html = $settings['title_text'];
   $this->add_render_attribute( 'block', 'class', [ 'widget gsc-icon-box-styles', $settings['style'], $settings['active'] == 'yes' ? 'active' : '' ] );
   $this->add_render_attribute( 'description_text', 'class', 'desc' );
   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $this->add_inline_editing_attributes( 'title_text', 'none' );
   $this->add_inline_editing_attributes( 'description_text' );

   ?>

   <?php if($style == 'style-1'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="icon-box-content">
               <?php if ( $has_icon ){ ?>
                  <div class="icon-inner">
                     <span class="box-icon">
                        <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                     </span>
                  </div>
               <?php } ?>
            <div class="box-content">
               <?php
                  if(!empty($title_html)){
                     echo '<' . esc_attr($header_tag) . ' '. $this->get_render_attribute_string( 'title_text' ) . '>';
                        echo $title_html;
                     echo ('</' .  esc_attr($header_tag) . '>');
                  } 
                  if(!empty($description_text)){
                     echo '<div ' . $this->get_render_attribute_string( 'description_text' ) . '>';
                        echo $description_text;
                     echo '</div>';
                  } 
               ?>
            </div>
         </div> 
         <?php $this->gva_render_link_html('', $settings['button_url'], 'link-overlay'); ?>
      </div>   
   <?php } ?>

   <?php if($style == 'style-2'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="icon-box-content">
               <?php if ( $has_icon ){ ?>
                  <div class="icon-inner">
                     <span class="box-icon">
                        <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                     </span>
                  </div>
               <?php } ?>
            <div class="box-content">
               <?php 
                  if(!empty($settings['subtitle_text'])){
                     echo '<span class="sub-title">' . esc_html($settings['subtitle_text']) . '</span>';
                  } 
                  if(!empty($title_html)){
                     echo '<' . esc_attr($header_tag) . ' '. $this->get_render_attribute_string( 'title_text' ) . '>';
                        echo $title_html;
                     echo ('</' .  esc_attr($header_tag) . '>');
                  } 
               ?>
               
            </div>
         </div> 
         <?php $this->gva_render_link_html('', $settings['button_url'], 'link-overlay'); ?>
      </div>   
   <?php } ?>

   <?php if($style == 'style-3'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="icon-box-content">
               <?php if ( $has_icon ){ ?>
                  <div class="icon-inner">
                     <span class="box-icon">
                        <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                     </span>
                  </div>
               <?php } ?>
            <div class="box-content">
               <?php
                  if(!empty($title_html)){
                     echo '<' . esc_attr($header_tag) . ' '. $this->get_render_attribute_string( 'title_text' ) . '>';
                        echo $title_html;
                     echo ('</' .  esc_attr($header_tag) . '>');
                  } 
                  if(!empty($description_text)){
                     echo '<div ' . $this->get_render_attribute_string( 'description_text' ) . '>';
                        echo $description_text;
                     echo '</div>';
                  }
                  if($settings['button_url']['url']){
                     echo '<div class="action"><span>' . $settings['button_text'] . '</span></div>';
                  }
               ?>
            </div>
         </div> 
         <?php $this->gva_render_link_html('', $settings['button_url'], 'link-overlay'); ?>
      </div>   
   <?php } ?>

   <?php if($style == 'style-4'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         
         <div class="content-inner">
            <?php if ( $has_icon ){ ?>
               <div class="box-icon">
                  <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
               </div>
            <?php } ?>

            <?php if(!empty($settings['title_text'])){ ?>
               <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                  <?php echo $title_html ?>
               </<?php echo esc_attr($header_tag) ?>>
            <?php } ?>
         </div>
         <?php $this->gva_render_link_html('', $settings['button_url'], 'link-overlay'); ?>
      </div> 
   <?php } ?>  