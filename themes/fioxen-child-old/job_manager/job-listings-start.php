<?php
/**
 * Content shown before job listings in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-listings-start.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.15.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$layout_settings = fioxen_listings_layout_page();
$layout = $layout_settings['layout'];
$class = 'listings-list-inner';
if( $layout_settings['layout_item'] == 'item-grid-1' || $layout_settings['layout_item'] == 'item-grid-2' || $layout_settings['layout_item'] == 'item-grid-4' ){
   $col_lg = $layout_settings['grid_columns_lg'];
   $col_md = $layout_settings['grid_columns_md'];
   $col_sm = $layout_settings['grid_columns_sm'];
   $col_xs = $layout_settings['grid_columns_xs'];
   if($layout == 'half_map' || $layout == 'half_map_2'){
      $class = "hm_lg-block-grid-{$col_lg} md-block-grid-{$col_md} sm-block-grid-{$col_sm} xs-block-grid-{$col_xs} xx-block-grid-1";
   }else{
      $class = "lg-block-grid-{$col_lg} md-block-grid-{$col_md} sm-block-grid-{$col_sm} xs-block-grid-{$col_xs} xx-block-grid-1";
   }
}
?>

<?php 
   if($layout == "filters_hidden"){
      echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">';
   }
   
   if( $layout == 'filters_left' || $layout == 'filters_right' ){ 
      // echo '<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">';
      echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">';
   }
?>

<div class="lt_results-sorting">
   <div class="results-text"><span class="results-number"></span> <?php echo esc_html__('Results Found', 'fioxen') ?></div>
   <div class="results-sorting">
      <select class="select_lt_results_sorting" name="select_lt_results_sorting">
         <option value="default"><?php echo esc_html__('Default sorting','fioxen') ?></option>
         <option value="rating"><?php echo esc_html__('Sort by average rating','fioxen') ?></option>
         <option value="date"><?php echo esc_html__('Sort by latest','fioxen') ?></option>
         <option value="date-old"><?php echo esc_html__('Sort by oldest','fioxen') ?></option>
         <option value="featured"><?php echo esc_html__('Sort by featured','fioxen') ?></option>
         <option value="random"><?php echo esc_html__('Sort by random','fioxen') ?></option>
      </select>
   </div>
</div>

<div class="job_listings <?php echo esc_attr($class) ?>">
