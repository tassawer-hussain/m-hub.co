<?php
   $user = wp_get_current_user();
   $data = get_userdata( $user->ID );
   $data_socials = get_the_author_meta( 'user_socials', $user->ID, false );
   $address = get_the_author_meta( 'user_address', $user->ID );
   $social_keys = array(
      'facebook'     => 'Facebook', 
      'twitter'      => 'Twitter', 
      'google'       => 'Google', 
      'pinterest'    => 'Pinterest', 
      'linkedin'     => 'Linkedin', 
      'instagram'    => 'Instagram'
   );
?>
<h3 class="page-title"><?php echo esc_html__('Edit Profile', 'fioxen') ?></h3>
<div class="dashboard-inner-block">
   <form method="post" class="lt-change-profile-form">
      <h3 class="title"><?php echo esc_html__('Avatar', 'fioxen') ?></h3>
      <div class="lg-block-grid-1">
         <div class="clearfix">
            <fieldset class="fieldset-_user_avatar fieldset-type-file">
               <div class="field">
                  <?php 
                     $attrs = array(
                        'key'          => '_user_avatar',
                        'field'        => array(
                           'label'        => esc_html__( 'Avatar', 'fioxen' ),
                           'priority'     => 2.1,
                           'required'     => false,
                           'type'         => 'file',
                           'ajax'         => true,
                           'placeholder'  => '',
                           'multiple'     => false,
                           'allow_types'  => array(
                              'jpg|jpeg|jpe',
                              'jpeg',
                              'gif',
                              'png',
                           ),
                        )
                     );
                     get_job_manager_template( 'form-fields/file-field.php', $attrs) 
                  ?>
               </div> 
            </fieldset>  
         </div>      
      </div>

      <h3 class="title"><?php echo esc_html__('Information', 'fioxen') ?></h3>
      <div class="lg-block-grid-2">
         <div class="form-group">
            <input  type="text" name="first_name" placeholder="<?php echo esc_attr__('First Name', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->first_name ) ? esc_attr( $data->first_name ) : ''); ?>">
         </div>
         <div class="form-group">
            <input  type="text" name="last_name" placeholder="<?php echo esc_attr__('Last Name', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->last_name ) ? esc_attr( $data->last_name ) : ''); ?>">
         </div>
         <div class="form-group">
            <input  type="text" name="display_name" placeholder="<?php echo esc_attr__('Display Name', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->display_name ) ? esc_attr( $data->display_name ) : ''); ?>">
         </div>
         <div class="form-group">
            <input type="email" name="email" placeholder="<?php echo esc_attr__('Email', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->email ) ? esc_attr( $data->email ) : ''); ?>">
         </div>
         <div class="form-group">
            <input  type="text" name="phone" placeholder="<?php echo esc_attr__('Phone', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->phone ) ? esc_attr( $data->phone ) : ''); ?>">
         </div>
         <div class="form-group">
            <input  type="text" name="user_address" placeholder="<?php echo esc_attr__('Address', 'fioxen'); ?>" class="form-control" value="<?php echo esc_attr($address); ?>">
         </div>
         <div class="form-group">
            <input  type="url" name="website" placeholder="<?php echo esc_attr__('Website', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->website ) ? esc_attr( $data->website ) : ''); ?>">
         </div>
         <div class="form-group">
            <input type="date" name="birthday" placeholder="<?php echo esc_attr__('Website', 'fioxen'); ?>" class="form-control" value="<?php echo (!empty( $data->birthday ) ? esc_attr( $data->birthday ) : ''); ?>">
         </div>
      </div>

      <div class="lg-block-grid-1">
         <div class="form-group">
            <textarea placeholder="<?php echo esc_attr__('Biographical Info', 'fioxen'); ?>" class="form-control" name="description"rows="6"><?php echo (!empty( $data->description ) ? esc_attr( $data->description ) : ''); ?></textarea>
         </div>
      </div>

      <h3 class="title"><?php echo esc_html__('Socials', 'fioxen') ?></h3>
      <div class="lg-block-grid-2">

         <?php foreach ($social_keys as $key => $title) { ?>
            <div class="form-group">
               <input type="text" name="user_socials[<?php echo esc_attr($key) ?>]" placeholder="<?php echo esc_attr($title); ?>" class="form-control" value="<?php echo ( isset($data_socials[$key]) ? $data_socials[$key] : '' ); ?>" />
            </div>
         <?php } ?>
      </div>

      <div class="lg-col-grid-12">
         <div class="form-group">
            <input type="submit" value="<?php echo esc_attr__('Save changes', 'fioxen') ?>" />
         </div>
         <div class="form-status"></div>
      </div>

   </form>
</div>