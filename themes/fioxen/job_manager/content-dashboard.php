<?php 
   $protocol = is_ssl() ? 'https' : 'http'; 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
   <meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="<?php echo esc_attr($protocol) ?>://gmpg.org/xfn/11">
   <?php wp_head(); ?>
</head> 
<body <?php body_class() ?>>
   <div class="wrapper-page"> <!--page-->

      <?php 
         $fioxen_options = fioxen_get_options();
         $fioxen_logo = FIOXEN_THEME_URL . '/assets/images/logo.png';
         if(isset($fioxen_options['header_logo']['url']) && $fioxen_options['header_logo']['url']){
           $fioxen_logo = $fioxen_options['header_logo']['url'];
         }

         $job_dashboard_page_id = get_option( 'job_manager_job_dashboard_page_id' );
         $dashboard_link = $job_dashboard_page_id ? get_permalink($job_dashboard_page_id) : '';

         $user_info = wp_get_current_user();
         $user_id = get_current_user_id();
         $avatar = fioxen_get_avatar($user_id);
         $classes = 'dashboard-main-content';
         if(!is_user_logged_in()){ 
            $classes = 'dashboard-main-content without-login';
         }
      ?>

      <section id="wp-main-content" class="clearfix main-page listing-dashboard-page">
         
         <div class="my-account-header">
            <div class="header-left">
               <div class="logo">
                  <a class="logo-theme" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                     <img src="<?php echo esc_url($fioxen_logo); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                  </a>
               </div>
            </div>
            <div class="header-right">
               <div class="wishlist">
                  <a href="<?php echo esc_url($dashboard_link) . '?dashboard=favorite' ?>">
                     <i class="lar la-heart"></i>&nbsp;<?php echo esc_html__( 'Wishlist', 'fioxen' ) ?>
                  </a>
               </div>
               <div class="user-profile">
                  <div class="avata">
                     <?php  
                        if( $avatar ){ 
                        echo '<div class="user-avatar">';
                           echo wp_kses_post($avatar, false);
                        echo '</div>';
                     }
                     ?>
                  </div>
                  <div class="name">
                     <span class="user-text">
                        <?php echo esc_html($user_info->display_name) ?>
                     </span>
                  </div>
               </div>
            </div>
         </div>

      	<?php do_action( 'fioxen_before_page_content' ); ?>
      	<div class="main-page-content"> 
      		<div id="job-manager-job-dashboard">
               <a class="job-control-mobile-sidebar"><i class="icon fas fa-bars"></i></a>
            	<div class="dashboard-content-wrapper">
                  
                  <?php if ( is_user_logged_in() ) { ?>
                     <div class="dashboard-sidebar">
                       <?php get_template_part( 'job_manager/dashboard/nav' ) ?>
                     </div>
                  <?php } ?>

                  <div class="<?php echo esc_attr($classes) ?>">
                     <div class="dashboard-content-inner">
                        <?php 
                           if(have_posts()){ 
                              the_post();
                              the_content(); 
                           } 
                        ?>  
                     </div> 
                     <div class="dashboard-copyright">
                        <?php 
                           $copyright = fioxen_get_option('copyright_text', '');
                           if(!empty($copyright)){ 
                              echo esc_html($copyright);
                           }else{
                              echo esc_html__('© 2022 Fioxen. All Right Reserved.', 'fioxen');
                           }
                        ?>
                     </div>   
                  </div>
               </div>
            </div>
         </div>
      	<?php do_action( 'fioxen_after_page_content' ); ?>
      </section>
   </div>
   <?php do_action('fioxen/addons/user') ?>
   <?php wp_footer(); ?>
</body>      
