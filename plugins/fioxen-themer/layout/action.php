<?php
class GVA_Layout_Action extends GVA_Layout_Model{
   public $post_type = 'gva__template';

   function __construct(){
      add_action( 'init', array($this, 'ajax_auth_init') );
   }
   public function ajax_auth_init(){ 
      add_action( 'wp_ajax_fioxen_add_template_layout', array($this, 'add_template_layout') );
      add_action( 'wp_ajax_fioxen_duplicate_template_layout', array($this, 'duplicate_template_layout') );
      add_action( 'wp_ajax_fioxen_set_header_footer_layout', array($this, 'set_header_footer_layout') );
      add_action( 'wp_ajax_fioxen_set_state_config', array($this, 'set_state_config') );
      add_action( 'wp_ajax_fioxen_delete_template_layout', array($this, 'delete_template_layout') );
   }

   public function add_template_layout(){
      check_ajax_referer('fioxen_ajax_security_nonce', 'security');
      
      if ( !is_user_logged_in() || !current_user_can('manage_options')){
         return;
      }

      if( empty($_POST['type']) ){ 
         return;
      }

      $counter = 1;
      $check = true;
      $number = 0;
      $name = !empty($_POST['title']) ? $_POST['title'] : 'Template Layout';
      while ($check) {
         $check = false;
         $query = new WP_Query([
             'post_type' => $this->post_type,
             'post_status' => 'publish',
             'meta_key' => $this->meta_key,
             'meta_value' => $_POST['type']
         ]);
         foreach ($query->posts as $post) {
            if($post->ID > 0){
               $number = $number + 1;
            }
            if ($post->post_title === $name){
               $counter++;
               $name =  $name . ' #'. $counter;
               $check = true;
               break;
            }
         }
      }

      $pid = wp_insert_post([
         'post_title' => $name,
         'post_type' => $this->post_type,
         'post_status' => 'publish',
         'post_name'    => 'template_' . $_POST['type'] . '_' . wp_rand(8),
         'meta_input' => [
            'gva_template_type' => $_POST['type']
         ]
      ]);

      if($pid){
         update_post_meta($pid, '_elementor_edit_mode', 'builder');
         update_post_meta($pid, '_elementor_data', json_decode('[{"id":"396a7e6","elType":"section","settings":[],"elements":[{"id":"efbcfb5","elType":"column","settings":{"_column_size":100},"elements":[{"id":"f00f2c4","elType":"widget","settings":[],"elements":[],"widgetType":"gva-template_content"}],"isInner":false}],"isInner":false}]', true));
         
         if($_POST['type'] != 'header_layout' || $_POST['type'] != 'footer_layout'){
            $header_default = $this->get_template_default('header_layout');
            $footer_layout = $this->get_template_default('footer_layout');
            update_post_meta( $pid, 'header_layout', $header_default );
            update_post_meta( $pid, 'footer_layout', $footer_layout );
         }

         if($number == 0){
            $this->set_state_default($_POST['type'], $pid);
         }
      }

      echo json_encode(
         array(
            'status'  => 'success',
            'message' => esc_html__( $name . " created", 'fioxen-themer')
         )
      );
      die();
   }

   public function set_header_footer_layout(){
      check_ajax_referer('fioxen_ajax_security_nonce', 'security');
     
      if ( !is_user_logged_in() || !current_user_can('manage_options')){
         return;
      }
      
      if( empty($_POST['type']) || empty($_POST['h_f_id']) || empty($_POST['layout_id']) ){ 
         return;
      }
      $type = $_POST['type'];
      $h_f_id = $_POST['h_f_id'];
      $layout_id = $_POST['layout_id'];
      $title = $_POST['title'];

      if($type == 'header_layout'){
         update_post_meta( $layout_id, 'header_layout', $h_f_id );
      }
      if($type == 'footer_layout'){
         update_post_meta( $layout_id, 'footer_layout', $h_f_id );
      }

      echo json_encode(
         array(
            'status'  => 'success',
            'message' => esc_html__( "Changes saved successfully", 'fioxen-themer')
         )
      );
      die();
   }

   public function set_state_config(){
      check_ajax_referer('fioxen_ajax_security_nonce', 'security');
      if ( !is_user_logged_in() || !current_user_can('manage_options')){
         return;
      }
      // type: config post type 
      // key: post_meta of config post type
      // id: value of postmeta
     
      if( empty($_POST['id']) || empty($_POST['type']) ){ 
         echo json_encode(
            array(
               'status'  => 'success',
               'message' => esc_html__( "Changes Unsuccess", 'fioxen-themer')
            )
         );
         return;
      }

      $id         = $_POST['id'];
      $type       = $_POST['type'];
      // $meta_key   = $_POST['meta_key'];

      // $config = new GVA_Config($type);
      // $post_config_id = $config->get_post_config();      
      // update_post_meta( $post_config_id, $type . '_' . $meta_key, $value );

      $this->set_state_default($type, $id);

      echo json_encode(
         array(
            'status'  => 'success',
            'message' => esc_html__( "Changes saved successfully", 'fioxen-themer')
         )
      );
      die();
   }

   //
   public function duplicate_template_layout(){
      
      check_ajax_referer('fioxen_ajax_security_nonce', 'security');
      
      if ( !is_user_logged_in() || !current_user_can('manage_options')){
         return;
      }

      if( empty($_POST['post_id']) ){ 
         return;
      }

      $post_id = $_POST['post_id'];
      $counter = 1;
      $check = true;
      $name = get_the_title($post_id) ? get_the_title($post_id) : 'Template Layout';

      while ($check) {
         $check = false;
         $query = new WP_Query([
             'post_type' => $this->post_type,
             'post_status' => 'publish',
             'meta_key' => $this->meta_key,
             'meta_value' => $_POST['type']
         ]);
         foreach ($query->posts as $post) {
            if ($post->post_title === $name) {
               $counter++;
               $name =  $name . ' #'. $counter;
               $check = true;
               break;
            }
         }
      }

      $new_post_id = wp_insert_post([
         'post_title'      => $name,
         'post_type'       => $this->post_type,
         'post_status'     => get_post_status($post_id),
         'post_content'    => get_the_content($post_id),
         'post_modified'   => current_time('mysql'),
      ]);

      if (is_wp_error($new_post_id)) {
         echo json_encode(
            array(
               'status'  => 'success',
               'message' => esc_html__( "Can't Duplicate", 'fioxen-themer')
            )
         );
         die();
      }

      global $wpdb;
      $meta = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=" . $post_id);
      if (count($meta) !== 0) {
         $query = "INSERT INTO $wpdb->postmeta(post_id, meta_key, meta_value) ";
         $selectQuery = [];

         foreach ($meta as $meta_info) {
             $key = $meta_info->meta_key;
             if ($key === '_wp_old_slug' || $key === '_gva_set_default') {
                 continue;
             }

             $value = addslashes($meta_info->meta_value);
             $selectQuery[] = "SELECT $new_post_id, '$key', '$value'";
         }
         $query .= implode(" UNION ALL ", $selectQuery);
         $wpdb->query($query);
      }

      wp_update_post([
         'ID' => $new_post_id,
         'post_title' => $name,
      ]);
      wp_reset_query();     

      //Set Language
      if( !empty($_POST['language']) && function_exists('icl_object_id') ){
         $wpml_element_type = apply_filters( 'wpml_element_type', 'gva__template' );
         
         $set_language_args = array(
            'element_id'    => $new_post_id,
            'element_type'  => 'post_gva__template',
            'trid'          => false,
            'language_code' => $_POST['language']    
         );
 
         do_action( 'wpml_set_element_language_details', $set_language_args );
      }

      echo json_encode(
         array(
            'status'  => 'success',
            'message' => esc_html__( "Duplicate success", 'fioxen-themer')
         )
      );
      die();

   }

   function delete_template_layout(){
      check_ajax_referer('fioxen_ajax_security_nonce', 'security');
      
      if ( !is_user_logged_in() || !current_user_can('manage_options')){
         return;
      }

      if( empty($_POST['post_id']) ){ 
         return;
      }
      $post_id = $_POST['post_id'];

      $template_type = get_post_meta($post_id, 'gva_template_type', true);
    

      if($template_type){
         $get_templates = $this->get_templates($template_type);

         if( count($get_templates) < 2){
            echo json_encode(
               array(
                  'status'  => 'unsuccess',
                  'message' => esc_html__( "Can't delete when have only one item", 'fioxen-themer')
               )
            );
            die();
         }
         
      }

      $post = wp_delete_post($post_id, true);

      if (!$post) {
         echo json_encode(
            array(
               'status'  => 'unsuccess',
               'message' => esc_html__( "Can't Delete Template", 'fioxen-themer')
            )
         );
         die();
      }

      echo json_encode(
         array(
            'status'  => 'success',
            'message' => esc_html__( "Template deleted", 'fioxen-themer')
         )
      );
      die();

   }

}

new GVA_Layout_Action();