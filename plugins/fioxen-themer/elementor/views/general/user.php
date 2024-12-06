<?php
   use Elementor\Icons_Manager;
   $this->add_render_attribute( 'block', 'class', [ 'gva-user', ' text-' . $settings['align'] ] );
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <?php if(is_user_logged_in()){ ?>
      <?php
         $user_id = get_current_user_id();
         $user_info = wp_get_current_user();
         $_random = gaviasthemer_random_id();
         $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],  
            'menu_class'  => 'gva-user-menu clearfix',
            'menu_id'     => 'menu-' . $_random,
            'container'   => 'div'
         ];
         if(class_exists('Fioxen_Walker')){
            $args['walker' ]     = new Fioxen_Walker();
         }
         $menu_html = '<div class="hi-account">' . $settings['hi_text'] . $user_info->display_name . '</div>';
         $menu_html .= wp_nav_menu($args);
      ?>
      <div class="login-account">
         <div class="profile">
            <div class="avata">
               <?php  
                  $user_avatar = get_avatar_url($user_id, array('size' => 90));
                  $avatar = get_the_author_meta( '_user_avatar', $user_id);
                   if($avatar){
                       $avatar = wp_get_attachment_image_src( $avatar, 'thumbnail' );
                       if( isset($avatar[0]) && $avatar[0] ){
                           $user_avatar = $avatar[0];
                       }
                   }
                  //$user_avatar = get_the_author_meta( '_user_avatar', $user_id); 

                  $avatar_url = !empty($user_avatar) ? $user_avatar : (get_template_directory_uri() . '/images/placehoder-user.jpg');
               ?>
               <img src="<?php echo esc_url($avatar_url) ?>" alt="<?php echo esc_html($user_info->display_name) ?>">
            </div>
         </div>  
         
         <div class="user-account">
            <?php echo ($menu_html) ?>
         </div> 

      </div>

   <?php }else{ ?>
      <?php 
         $register_link = site_url('/wp-login.php?action=register&redirect_to=' . get_permalink());
         $job_dashboard_page_id = get_option('job_manager_job_dashboard_page_id');
         if($job_dashboard_page_id){
            $register_link = get_the_permalink($job_dashboard_page_id) . '?dashboard=register';
         }
         $register_link = !empty($settings['link_register']) ? $settings['link_register'] : $register_link;
      ?>
      <div class="login-account without-login">
         <div class="profile">
            <div class="avata avata-icon">
               <?php if($settings['selected_icon']){ ?>
                  <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'class' => 'icon', 'aria-hidden' => 'true' ] ); ?>
               <?php } ?>
            </div>
         </div>
         <div class="user-account">
            <ul class="my_account_nav_list gva-user-menu">
               <li>
                  <a class="login-link" href="#" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup">
                     <i class="icon la la-user-circle-o"></i>
                     <?php echo esc_html__('Login', 'fioxen-themer') ?>
                  </a>
               </li>
               <li>
                  <a class="register-link" href="<?php echo esc_url($register_link) ?>">
                     <i class="icon las la-user-plus"></i>
                     <span class="register-text"><?php echo ($settings['register_text'] ? $settings['register_text'] : "Register"); ?></span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
         
   <?php } ?>
</div>