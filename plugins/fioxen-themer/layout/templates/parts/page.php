<?php 
   /*
      Type: page_layout
   */
   use Elementor\Plugin;
   $type = 'page_layout';
   $title = esc_html__('New Page Template', 'fioxen-themer');
?>
<div class="gva-template-layout">
   <h3><?php echo esc_html__('Page Templates', 'fioxen-themer') ?></h3>
   <div class="list-template-layout">
      <div class="item heading">
         <div class="state"><?php echo esc_html__('State', 'fioxen-themer') ?></div>
         <div class="name"><?php echo esc_html__('Name', 'fioxen-themer') ?></div>
         <div class="header"><?php echo esc_html__('Choose Header', 'fioxen-themer') ?></div>
         <div class="footer"><?php echo esc_html__('Choose Footer', 'fioxen-themer') ?></div>
         <div class="action" style="text-align: right;"><?php echo esc_html__('Actions', 'fioxen-themer') ?></div>
      </div>
      <?php foreach ($this->get_templates($type) as $item) { ?>
         <?php
            $header_value = get_post_meta( $item['id'], 'header_layout', true );
            $footer_value = get_post_meta( $item['id'], 'footer_layout', true );
            $default = get_post_meta( $item['id'], '_gva_set_default', true );
            $state = ($default == 'enabled') ? 'active' : '';
         ?>
         <div class="item" data-type="<?php echo $type ?>">
            <div class="state">
              <a class="btn-set-config-state <?php echo esc_attr($state) ?>" title="<?php echo esc_attr('Active Default', 'fioxen-theme') ?>" href="#" data-id="<?php echo $item['id'] ?>" data-type="<?php echo $type ?>"><i class="dashicons-before dashicons-marker"></i><span class="text">Default</span></a>
            </div>
            <div class="name"><?php echo $item['title'] ?></div>
            <div class="header checkboxs"><?php $this->get_checkboxs_header_footer('header_layout', $item['id'], $header_value) ?></div>
            <div class="footer checkboxs"><?php $this->get_checkboxs_header_footer('footer_layout', $item['id'], $footer_value) ?></div>
            <div class="action">
               <a target="_bank" href="<?php echo Plugin::$instance->documents->get( $item['id'] )->get_edit_url() ?>" title="<?php echo esc_attr__('Edit', 'fioxen-themer') ?>">
                  <i class="dashicons-before dashicons-edit"></i>
               </a> 
               <a target="_bank" href="<?php the_permalink($item['id']) ?>" title="<?php echo esc_attr__('View', 'fioxen-themer') ?>">
                  <i class="dashicons dashicons-welcome-view-site"></i>
               </a>

               <a class="template-layout-dulipcate" data-post_id="<?php echo $item['id'] ?>" data-language="" href="#" title="<?php echo esc_attr__('Duplicate', 'fioxen-themer') ?>">
                  <i class="dashicons dashicons-admin-page"></i>
               </a>
               <?php 
                  $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' ); 
                  if($languages && count($languages) > 1){ 
                     foreach ($languages as $language){
                        $language_code = '';
                        if(isset($language['language_code'])) $language_code = $language['language_code'];
                        if(isset($language['code'])) $language_code = $language['code'];
                        if(!$language['active']){
                           echo '<a class="template-layout-dulipcate dulipcate-width-language" data-post_id="'.$item['id'].'" data-language="'.$language_code.'" href="#" title="' . esc_attr('Duplicate to ', 'fioxen-themer') . $language_code . '">';
                              echo '<i class="dashicons dashicons-admin-page"></i>' . $language_code;
                           echo '</a>';
                        }
                     }
                  } 
               ?>
               <a class="template-layout-delete" href="#" data-post_id="<?php echo $item['id'] ?>"><i class="dashicons dashicons-trash"></i></a>
            </div>
         </div> 
      <?php } ?>
   </div>
   <p><a class="button-primary template-layout-add-new" data-type="<?php echo $type ?>" data-title="<?php echo $title ?>" href="#">
      <?php echo esc_html__('+ Add New', 'fioxen-themer') ?>
   </a></p>
</div>