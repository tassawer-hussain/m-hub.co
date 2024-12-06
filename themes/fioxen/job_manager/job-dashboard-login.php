<?php
/**
 * Job dashboard shortcode content if user is not logged in.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-dashboard-login.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$register_link = home_url('/wp-login.php?action=register&redirect_to=' . get_permalink());
$job_dashboard_page_id = get_option('job_manager_job_dashboard_page_id');
if($job_dashboard_page_id){
   $register_link = get_the_permalink($job_dashboard_page_id) . '?dashboard=register';
}
?>

<?php if(isset($_GET['dashboard']) && $_GET['dashboard'] == 'register'){ ?>
   
   <div class="dashboard-inner-block user-login-form">
      <div class="ajax-user-form">
         <h2 class="title"><?php echo esc_html__('Register', 'fioxen'); ?></h2>
         <div class="form-ajax-registration-popup-content">
            <?php 
               if(class_exists('Fioxen_Addons_Registration_Ajax')){
                  Fioxen_Addons_Registration_Ajax::instance()->html_form();
               } 
            ?>
         </div>
         <div class="user-registration">
            <?php echo esc_html__("Already have an account?", "fioxen"); ?>
            <a class="login-popup" data-bs-toggle="modal" data-bs-target="#form-ajax-login-popup"><?php echo esc_html__('Login', 'fioxen') ?></a>
         </div>
      </div>  
   </div>  

<?php }else{ ?>

   <div class="dashboard-inner-block user-login-form">
      <p class="account-sign-in hidden"><?php esc_html_e( 'You need to be signed in to manage your listings.', 'fioxen' ); ?> <a class="button" href="<?php echo esc_url( apply_filters( 'job_manager_job_dashboard_login_url', wp_login_url( get_permalink() ) ) ); ?>"><?php esc_html_e( 'Sign in', 'fioxen' ); ?></a></p>
      <div class="ajax-user-form">
         <h2 class="title"><?php echo esc_html__('Sign In', 'fioxen'); ?></h2>
         <div class="form-ajax-login-popup-content">
            <?php 
               if(class_exists('Fioxen_Addons_Login_Ajax')){
                  Fioxen_Addons_Login_Ajax::instance()->html_form();
               } 
            ?>
         </div>
         <div class="user-registration">
            <?php echo esc_html__("Don't have an account", "fioxen"); ?>
            <a class="registration-popup"  href="<?php echo esc_url($register_link) ?>">
               <?php echo esc_html__('Register', 'fioxen') ?>
            </a>
         </div>   
      </div>
   </div>   

<?php } ?>