<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly.
}

$thumbnail = 'post-thumbnail';
if(isset($thumb_size) && $thumb_size){
   $thumbnail = $thumb_size;
}
$post_id = get_the_ID();
$phone = get_post_meta($post_id, '_lt_phone', true);
$logo = fioxen_image_attach($post_id, '_lt_logo_image', true, 'thumbnail');
$tagline = get_post_meta($post_id, '_lt_tagline', true);
$status = Fioxen_Lising_Theme::instance()->check_open($post_id);
$price_from = get_post_meta($post_id, '_lt_price_from', true);
$price_to = get_post_meta($post_id, '_lt_price_to', true);
$review_avg = get_post_meta($post_id, 'lt_reviews_average', true); 
$featured = get_post_meta($post_id, '_featured', true);
$results_reviews = get_post_meta($post_id, 'lt_results_reviews', true); 
$count_comment = Fioxen_Listing_Comment::instance()->total_reviews($post_id, false, true);
$suffix_review = $count_comment == 1 ? sprintf(esc_html__('(%s Review)', 'fioxen'), $count_comment) : sprintf(esc_html__('(%s Reviews)', 'fioxen'), $count_comment);

$rterms =  wp_get_post_terms($post_id, 'job_listing_region');
$city = $country = false;
if ( !empty($rterms) ) {
   foreach ($rterms as $term) {
      if($term->parent == 0){
         $country = $term;
      }else{
         $city = $term;
      }
   }
}

$link_region_country = $link_region_city = '';
if( isset($regions['city']) && $regions['city'] ){
   $link_region_city = get_term_link($regions['city'], 'job_listing_region');
}
if(isset($regions['country']) && $regions['country']){
   $link_region_country = get_term_link($regions['country'], 'job_listing_region');
}
?>

<div <?php job_listing_class('listing-block-4'); ?>>
   <div class="block-content">
      <div class="listing-image">
         <div class="content-inner">
            <?php  
               if ( has_post_thumbnail() ) {
                  the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) );
               } 
            ?>
            <?php if($status['text']){ ?>
                <div class="listing-time <?php echo esc_attr( $status['check'] ) ?>"><?php echo esc_html($status['text']) ?></div>
            <?php } ?> 

            <?php if( isset($logo[0]) ){ ?>
               <div class="listing-logo"><img src="<?php echo esc_url($logo[0]) ?>" alt="<?php the_title_attribute() ?>" /></div>
            <?php } ?>
            
            <?php 
               if(class_exists('Fioxen_Addons_Wishlist_Ajax')){
                  Fioxen_Addons_Wishlist_Ajax::instance()->html_icon(get_the_ID());
               }
            ?>

            <?php if($featured){ ?>
               <div class="lt-featured"><span><?php echo esc_html__('Featured', 'fioxen'); ?></span></div>
            <?php } ?>   

            <a href="<?php echo esc_url(the_permalink()) ?>" class="link-overlay"></a>
         </div>   
      </div>   

      <div class="listing-content">
         <div class="lt-content-block">
            <h3 class="title"><a href="<?php the_permalink() ?>"><?php wpjm_the_job_title(); ?></a></h3>

            <?php if( !empty($tagline) && $show_tagline == 'yes' ){ ?>
               <div class="listing-tagline"><?php echo esc_html($tagline) ?></div>
            <?php } ?>  
            
            <?php 
               if( $show_rating == 'star' && !empty($review_avg) ){ 
                  $review_avg = round( $review_avg, 1 );
                  echo Fioxen_Listing_Comment::instance()->show_star_by_avg($review_avg, '', $suffix_review); 
               } 
            ?>   

            <?php 
               if( $show_rating == 'number' && !empty($review_avg) ){ 
                  echo '<div class="lt-avg-review">';
                     echo round( $review_avg, 1 );
                  echo '</div>';
               } 
            ?>
            <div class="listing-meta">
               <?php if($city || $country){ ?>
                  <div class="location">          
                     <i class="icon las la-map"></i>
                     <span class="regions">
                        <?php if( $city ){ ?>
                           <a href="<?php echo esc_url(get_term_link($city->term_id, 'job_listing_region')) ?>"><?php echo esc_html($city->name) ?></a>
                        <?php } ?>
                        <?php if( $country ){ ?>
                           <span>,&nbsp;</span><a href="<?php echo esc_url(get_term_link($country->term_id, 'job_listing_region')) ?>"><?php echo esc_html($country->name) ?></a>
                        <?php } ?>
                     </span>
                  </div>
               <?php } ?>
                <?php if($price_from){ ?>
               <div class="price-from">
                  <i class="icon las la-money-bill"></i>
                  <?php echo esc_html__('From', 'fioxen') . ' ' . esc_html($price_from) . fioxen_get_option('lt_currency_symbol', '$') ?>
               </div>
            <?php } ?>
            </div>    

         </div>
      </div> 

   </div>   

   <?php if( isset($show_info_map) && $show_info_map == 'show' ){ ?>
      <?php 
         $first_cat = Fioxen_Lising_Theme::instance()->get_first_category($post_id); 
         $lt_logo = '';
         if( isset($logo[0]) && $logo[0] ){
            $lt_logo = '<img src="' . esc_url($logo[0]) . '"/>';
         }else{
            $lt_logo = isset($first_cat['icon_html']) ? $first_cat['icon_html'] : '';
         }
      ?>
      <div class="listing-data d-none hidden">
         <?php 
            $location = get_post_meta($post_id, '_job_location', true);
            $lat = get_post_meta($post_id, '_lt_map_latitude', true);
            $lng = get_post_meta($post_id, '_lt_map_longitude', true);
            $url_thumbnail = get_the_post_thumbnail_url($post_id, $thumbnail);
         ?>    
         <span class="data-lat"><?php echo esc_html($lat); ?></span>
         <span class="data-lon"><?php echo esc_html($lng); ?></span>
         <span class="data-logo"><?php echo wp_kses_post($lt_logo) ?></span>
         <span class="data-html">
            <span class="gva-map-content-popup">
               <span class="lt-top">
                  <?php if($status['text']){ ?>
                     <span class="listing-time <?php echo esc_attr( $status['check'] ) ?>"><?php echo esc_html($status['text']) ?></span>
                  <?php } ?> 

                  <?php if($price_from){ ?>
                     <span class="listing-price">
                        <span class="price-from"><?php echo esc_html($price_from) ?></span>
                        <?php if($price_to){ ?>
                           <span class="price-to">&nbsp;-&nbsp;<?php echo esc_html($price_to) ?></span>
                        <?php } ?>   
                     </span>
                  <?php } ?>
               </span>   

               <span class="content-inner">
                  <h3 class="title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php wpjm_the_job_title() ?></a></h3>
                  <?php if( !empty($tagline) ){ ?>
                     <span class="listing-tagline"><?php echo esc_html($tagline) ?></span>
                  <?php } ?> 
                  <?php if($location){ ?>
                     <span class="location"><i class="fas fa-map-marker-alt"></i><?php echo esc_html($location) ?></span>
                  <?php } ?>
                  <?php if($phone){ ?>
                     <span class="phone"><i class="icon fas fa-phone-alt"></i><a href="tel:<?php echo esc_attr($phone) ?>"><?php echo esc_html($phone) ?></a></span>
                  <?php } ?> 
               </span>

               <span class="image" style="background-image:url('<?php echo esc_url($url_thumbnail) ?>')"></span>
            </span>
         </span>
      </div>
   <?php } ?>   

</div>
   
