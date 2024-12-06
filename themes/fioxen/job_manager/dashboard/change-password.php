<?php
   if (!is_user_logged_in()) {
      return;
   }
   if( class_exists('Fioxen_Addons_Change_Pwd_Ajax') ){
      echo '<h3 class="page-title text-center">' . esc_html__('Change Password', 'fioxen') . '</h3>';
      echo '<div class="dashboard-inner-block dashboard-change-pw">';
         Fioxen_Addons_Change_Pwd_Ajax::instance()->html_form();
      echo '</div>';
   }
?>