<?php
add_action( 'wp_ajax_nopriv_fioxen_keyword_autocomplete', 'fioxen_keyword_autocomplete' );
add_action( 'wp_ajax_fioxen_keyword_autocomplete', 'fioxen_keyword_autocomplete' );

   function fioxen_themer_title_filter( $where, $wp_query ){
      global $wpdb;
       // 2. pull the custom query in here:
      if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
         $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
      }
      return $where;
   }


function fioxen_keyword_autocomplete(){
   check_ajax_referer('fioxen-ajax-security-nonce', 'security');
   global $autocomplete_lt_keyword;
   $autocomplete_lt_keyword = $keyword = $_POST['keyword'];
   $lt_search_keywords_type = get_option('lt_search_keywords_type');
   $output = '';
   //if($lt_search_keywords_type == 'only_title'){
      add_filter( 'posts_where', 'fioxen_themer_title_filter', 10, 2 );
   //}else{
   //   add_filter( 'posts_search', 'fioxen_get_job_listings_keyword_search' );
   //}
   $post_per_page = apply_filters( 'fioxen_keyword_autocomplete_per_page', 6 );
   $query_args = array(
      'post_type'       => 'job_listing',
      'post_status'     => 'publish',
      'posts_per_page'  => $post_per_page
   );
   //if($lt_search_keywords_type == 'only_title'){
      $query_args['search_prod_title'] = $keyword;
  // }else{
  //    $query_args['s'] = $keyword;
   //}
   $query_args['meta_key']    = '_featured';
   $query_args['orderby']     = array(
      'meta_value'      => 'DESC',
      'date'            => 'DESC'
   );
   $query_args['order']       = 'DESC';

   $query = new WP_Query($query_args);

   if ( $query->found_posts ) {
      foreach ($query->posts as $post) {
         $post_id = $post->ID;
         $logo_id = get_post_meta($post_id, '_lt_logo_image', true);
         $logo_url = '';
         if($logo_id){
            $logo_attached = wp_get_attachment_image_src($logo_id, 'thumbnail');
            $logo_url = isset($logo_attached[0]) && $logo_attached[0] ? $logo_attached[0] : false;
         }
         $address = get_post_meta($post_id, '_lt_address', true);

         $output .= '<div class="listing-item"><div class="content-inner">';
            if($logo_url){
               $output .= '<div class="lt-logo"><img src="' . esc_url($logo_url) . '" alt="' . esc_attr($post->post_title) . '" /></div>';
            }   
            $output .= '<div class="lt-info">';
               $output .= '<h4 class="title">' . $post->post_title . '</h4>';
               $output .= $address ? '<span class="address">' . $address . '</span>' : '';
            $output .= '</div>';
            $output .= '<a class="overlay" href="' . post_permalink($post_id) . '"></a>';
         $output .= '</div></div>';
      }
   }
   //if($lt_search_keywords_type == 'only_title'){
      remove_filter( 'posts_where', 'fioxen_themer_title_filter', 10 );
  // }else{
  //    remove_filter( 'posts_search', 'fioxen_get_job_listings_keyword_search' );
   //}
   wp_reset_postdata();

   // Listing Category
   $args = array(
      'taxonomy'      => array('job_listing_category'), 
      'orderby'       => 'id', 
      'order'         => 'ASC',
      'hide_empty'    => true,
      'fields'        => 'all',
      'name__like'    => $keyword
   ); 

   $terms = get_terms($args);
   $count = count($terms);
   if($count > 0){
      $output .= '<div class="listing-category">';
         foreach ($terms as $term) {
            $term_id = $term->term_id;

            if( get_term_meta($term_id, 'gva_term_icon_type', true) == 'icon_type_font' ){
               if( $icon_font = get_term_meta($term_id, 'gva_term_icon_font', true) ){
                  $cat_icon_html = '<span class="icon"><i class="' . $icon_font . '"></i></span>';
               }
            }else{
               if( $icon_image = get_term_meta($term_id, 'gva_term_icon_image', true) ){
                  $icon_attach = wp_get_attachment_image_src($icon_image, 'thumbnail');
                  if( isset($icon_attach[0]) && $icon_attach[0] ){
                     $cat_icon_html = '<span class="icon"><img src="' . esc_url($icon_attach[0]) . '"/></span>';
                  }
               }
            }

            $output .= '<div class="cat-item">';
               $output .= "<a href='".get_term_link( $term )."'>" . $cat_icon_html . $term->name . "</a>";
            $output .= '</div>';
         }
      $output .= '</div>';   
   }

   echo json_encode(array('html' => $output));
   die();
}

   function fioxen_get_job_listings_keyword_search( $search ) {
      global $wpdb, $autocomplete_lt_keyword;
      $searchable_meta_keys = [
         '_job_location',
         '_lt_tagline',
         '_lt_address'
      ];
      $searchable_meta_keys = $searchable_meta_keys;
      // Set Search DB Conditions.
      $conditions = [];
      // Search Post Meta.

      if ( apply_filters( 'job_listing_search_post_meta', true ) ) {
         // Only selected meta keys.
         if ( $searchable_meta_keys ) {
            $conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key IN ( '" . implode( "','", array_map( 'esc_sql', $searchable_meta_keys ) ) . "' ) AND meta_value LIKE '%" . esc_sql( $autocomplete_lt_keyword ) . "%' )";
         } else {
            // No meta keys defined, search all post meta value.
            $conditions[] = "{$wpdb->posts}.ID IN ( SELECT post_id FROM {$wpdb->postmeta} WHERE meta_value LIKE '%" . esc_sql( $autocomplete_lt_keyword ) . "%' )";
         }
      }

      // Search taxonomy.
      $conditions[] = "{$wpdb->posts}.ID IN ( SELECT object_id FROM {$wpdb->term_relationships} AS tr LEFT JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id LEFT JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id WHERE t.name LIKE '%" . esc_sql( $autocomplete_lt_keyword ) . "%' )";

      $conditions = apply_filters( 'job_listing_search_conditions', $conditions, $autocomplete_lt_keyword );
      if ( empty( $conditions ) ) {
         return $search;
      }

      $conditions_str = implode( ' OR ', $conditions );

      if ( ! empty( $search ) ) {
         $search = preg_replace( '/^ AND /', '', $search );
         $search = " AND ( {$search} OR ( {$conditions_str} ) )";
      } else {
         $search = " AND ( {$conditions_str} )";
      }

      return $search;
   }