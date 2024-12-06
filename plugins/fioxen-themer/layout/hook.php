<?php
class GVA_Layout_Frontend_Hook extends GVA_Layout_Model{
   
   function __construct(){
      add_action('fioxen/layouts/page', array($this, 'layout_page'));
      
      add_action('fioxen/layouts/single/listing', array($this, 'layout_single_listing'));

      add_action('fioxen/layouts/single/post', array($this, 'layout_single_post'));
      add_action('fioxen/layouts/archive/post', array($this, 'layout_archive_post'));

      add_action('fioxen/layouts/single/template', array($this, 'single_template'));

      add_action('fioxen/layouts/single/product', array($this, 'layout_single_product'));
      add_action('fioxen/layouts/archive/product', array($this, 'layout_archive_product'));

      add_action('wp_enqueue_scripts', array($this, 'fioxen_themer_elementor_load_css_header'), 500);
   }

   public function fioxen_themer_elementor_load_css_header(){
      if (!class_exists( 'Elementor\Core\Files\CSS\Post')){
         return;
      }

      global $post;
      $template_id = 0;
      if($post && $post->post_type == 'product'){
         $template_id = $this->get_template_default('single_product_layout');
      }

      if($post && $post->post_type == 'post'){
         $template_id = $this->get_template_default('post_single_layout');
      }

      if(is_archive()){
         $template_id = $this->get_template_default('post_archive_layout');
      }
      
      if($post && $post->post_type == 'job_listing'){
         $template_id = $this->get_template_default('listing_single_layout');
         $post_meta_template = get_post_meta($post->ID, 'fioxen_template_layout', true);
         if(is_numeric($post_meta_template)){
            $template_id = $post_meta_template;
         }
      }

      if($post && $post->post_type == 'page'){
         $template_id = $this->get_template_default('page_layout');
         $post_meta_template = get_post_meta($post->ID, 'fioxen_template_layout', true);
         if(is_numeric($post_meta_template)){
            $template_id = $post_meta_template;
         }
      }


      if($template_id){
         $this->enqueue_element_kit();
         $css_file = new Elementor\Core\Files\CSS\Post($template_id);
         $css_file->enqueue();
      }
   }

   public function enqueue_element_kit(){
      $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
      if($active_kit_id){
         $css_file = new Elementor\Core\Files\CSS\Post($active_kit_id);
         $css_file->enqueue();
      }
   }

   public function layout_page(){
      global $post;
      $post_id = $post->ID;
      
      if(class_exists('WooCommerce') && is_shop()){
         $post_id = wc_get_page_id('shop');
      }

      $page_template = $this->get_template_default('page_layout');

      $post_meta_template = get_post_meta($post_id, 'fioxen_template_layout', true);

      if($post_meta_template == '_without_layout' || empty($post_meta_template) || !metadata_exists('post', $post_id, 'fioxen_template_layout')){
         get_template_part('templates/page/single');
         return;
      }
      if( !empty($post_meta_template) && $post_meta_template != '_default_active' && is_numeric($post_meta_template) ){
         $page_template = $post_meta_template;
      }
      if($page_template){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($page_template);
         echo $content_page;
      }else{ 
         get_template_part('templates/page/content');
      }
   }
 
   public function layout_single_listing(){
      global $post;
      $post_id = $post->ID;
      $template_id = 0;
      // Preview 
      $_submit_form_page = get_option( 'job_manager_submit_job_form_page_id', false );
      if( $post_id == $_submit_form_page && isset($_POST['job_id']) && isset($_POST['submit_job']) && $_POST['job_id'] && $_POST['submit_job'] ==  __( 'Preview', 'wp-job-manager' ) ){
         $template_id = $this->get_template_default('listing_single_layout');
      }else{
         
         $template_id = $this->get_template_default('listing_single_layout');
         $post_meta_template = get_post_meta($post_id, 'fioxen_template_layout', true);
         if( !empty($post_meta_template) && $post_meta_template != '_default_active' && is_numeric($post_meta_template) ){
            $template_id = $post_meta_template;
         }
      }

      if($template_id){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);
         if($content_page){
            echo $content_page;
            return;
         }
      }

      get_template_part('templates/blog/single');
   }

   public function layout_single_post(){
      global $post;
      $page_template = $this->get_template_default('post_single_layout');
      if($page_template){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($page_template);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/blog/single');
   }


   public function layout_archive_post(){
      global $post;
      $page_template = $this->get_template_default('post_archive_layout');
      if($page_template){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($page_template);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/blog/archive');
   }

   public function layout_single_product(){
      global $post;
      $post_id = $post->ID;
      $template_id = $this->get_template_default('single_product_layout');
      $post_template_id = get_post_meta($post_id, 'fioxen_template_layout', true);
      if( !empty($post_template_id) && $post_template_id && $post_template_id != '_default_active' && is_numeric($post_template_id) ){
         $template_id = $post_template_id;
      }
      if($template_id){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/blog/single');
   }

   public function layout_archive_product(){
      global $post;
      $template_id = $this->get_template_default('archive_product_layout');
      if($template_id){
         $content_page = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($template_id);
         if($content_page){
            echo $content_page;
            return;
         }
      }
      get_template_part('templates/product/layout/archive');
   }

   public function single_template(){
      echo apply_filters('the_content', get_the_content());
   }

}

new GVA_Layout_Frontend_Hook();

