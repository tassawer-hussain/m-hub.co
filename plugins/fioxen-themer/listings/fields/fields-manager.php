<?php
 class GVA_Listing_Field{
	public $post_type = 'gva__template';
	public $meta_key = 'gva_template_type';
	
   function __construct(){
		add_action('admin_menu', array($this, 'add_admin_menu'));
	}

	public function add_admin_menu(){
		add_submenu_page(
         'edit.php?post_type=job_listing',
			esc_html__('Listing Fields', 'fioxen-themer'),
			esc_html__('Listing Fields', 'fioxen-themer'),
         'manage_options',
			'listing-manage-fields',
			array($this, 'show_fields')
		);
	}

   /*
      field = array(
         'label' => '',
         'key' => '',
         'description'  => '',
         'priority'     => '',
         'type'         => '',
         'type_field'   => 'custom/available', 
         'default'      => '',
         'disable'      => ,
         'required'     => 
      )
   */

   public static function mySort($a, $b) {
      return ( $a['priority'] > $b['priority'] ? 1 : -1 ); 
   }

	public function show_fields(){

      if(isset($_POST['gva_listing_fields'])){
         $data = isset($_POST['gva_listing_fields']) ? $this->sanitize($_POST['gva_listing_fields']) : [];
         //print '<pre>'; print_r($data);
         update_option( 'gva_listing_fields', $data );
      }

      $option_key = 'gva_listing_fields';
      wp_enqueue_style('admin-fields-listing', GAVIAS_FIOXEN_PLUGIN_URL . 'listings/fields/assets/admin.css'); 
      wp_enqueue_script('jquery-ui-sortable'); 
      wp_enqueue_script('admin-fields-listing', GAVIAS_FIOXEN_PLUGIN_URL . 'listings/fields/assets/admin.js', array('jquery') ); 
		wp_localize_script( 'admin-fields-listing', 'form_ajax_object', array( 
		  'ajaxurl' => admin_url( 'admin-ajax.php' ),
		  'redirecturl' => home_url(),
		  'security_nonce' => wp_create_nonce( "fioxen_ajax_security_nonce" )
		));

      $fieldsDataOption = get_option($option_key, false);
      
      $fieldsData = array();
      if(!empty($fieldsDataOption)){
         foreach ($fieldsDataOption as $key => $field){
            $field_key = isset($field['key']) ? $field['key'] : '';
            $fieldsData[$field_key] = array(
               'label'        => isset($field['label']) ? $field['label'] : '',
               'key'          => isset($field['key']) ? $field['key'] : '',
               'description'  => isset($field['description']) ? $field['description'] : '',
               'priority'     => isset($field['priority']) ? $field['priority'] : '99',
               'type'         => isset($field['type']) ? $field['type'] : '',
               'type_field'   => isset($field['type_field']) ? $field['type_field'] : 'custom',
               'default'      => isset($field['default']) ? $field['default'] : '',
               'required'     => isset($field['required']) ? $field['required'] : '',
               'disable'      => isset($field['disable']) ? $field['disable'] : '',
               'group'        => isset($field['group']) ? $field['group'] : 'other'
            );
         }
      }

      //print_r($fieldsData);
      $fields_available = Fioxen_LT_Fields_Model::instance()->default_fields();

      unset($fields_available['featured']);
      unset($fields_available['lt_claimed']);
      unset($fields_available['job_expires']);

      foreach ($fields_available as $key => $field){
         if($field['type'] != 'custom-heading'){
            if(!isset($fieldsData[$key])){
               $field['type_field'] = 'available';
               $field['key'] = $key;
               $fieldsData[] = $field;
            }else{
               if( isset($fieldsData[$key]['key']) ){
                  $fieldsData[$key]['key'] = $key;
               }
               if( isset($fieldsData[$key]['type'])){
                  $fieldsData[$key]['type'] = $field['type'];
               }
               if( isset($fieldsData[$key]['type_field']) ){
                  $fieldsData[$key]['type_field'] = 'available';
               }
            }
         }
      }
      uasort($fieldsData, array($this, 'mySort'));

      $fields_group = array();
      foreach($fieldsData as $key => $field){
         $group = !empty($field['group']) ? $field['group'] : 'other';
         $fields_group[$group][$key] = $field;
      }

		require_once('templates/fields.php');
	}

   public function sanitize($value, $senitize_func = 'sanitize_text_field') {
      $senitize_func = (in_array($senitize_func, [
         'sanitize_email',
         'sanitize_file_name',
         'sanitize_hex_color',
         'sanitize_hex_color_no_hash',
         'sanitize_html_class',
         'sanitize_key',
         'sanitize_meta',
         'sanitize_mime_type',
         'sanitize_sql_orderby',
         'sanitize_option',
         'sanitize_text_field',
         'sanitize_title',
         'sanitize_title_for_query',
         'sanitize_title_with_dashes',
         'sanitize_user',
         'esc_url_raw',
         'wp_filter_nohtml_kses',
      ])) ? $senitize_func : 'sanitize_text_field';

      if(!is_array($value)) {
         return $senitize_func($value);
      } else {
         return array_map(function($inner_value) use ($senitize_func) {
            return self::sanitize($inner_value, $senitize_func);
         }, $value);
      }
   }

}

new GVA_Listing_Field();