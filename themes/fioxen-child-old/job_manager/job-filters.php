<?php
/**
 * Filters in `[jobs]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-filters.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.33.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

wp_enqueue_script( 'wp-job-manager-ajax-filters' );

do_action( 'job_manager_job_filters_before', $atts );
$atts['atts'] = $atts;
$atts['keywords'] = $keywords;

$layout_settings = fioxen_listings_layout_page();
$layout = $layout_settings['layout'];

$show_map = $layout_settings['show_map_top'];

?>

<?php if( $layout == 'filters_hidden' ){ echo '<div class="d-none">'; } ?>

<?php 
   if( $layout == 'filters_left' || $layout == 'filters_right' ){ 
      echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 lt-sidebar-search">';
      echo '<div class="content-inner">';
   }
?>
	<a href="#" class="lt-control-search-mobile"><i class="fi flaticon-magnifying-glass"></i><?php echo esc_html__('Search', 'fioxen') ?></a>

	<form class="job_filters lt-listing-filters style-1">
		<a class="lt-control-search-mobile-close" href="#"><i class="las la-times-circle"></i></a>
		<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

		<div class="search_jobs">

			<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

			<?php get_job_manager_template( 'filters/filters-v1.php', $atts ); ?>

			<input type="hidden" name="lt_layout" value="<?php echo esc_attr($layout) ?>" />
			<input type="hidden" name="lt_layout_item" value="<?php echo esc_attr($layout_settings['layout_item']) ?>" />
			<input type="hidden" name="lt_show_map_top" value="<?php echo esc_attr($layout_settings['show_map_top']) ?>" />
			<input type="hidden" name="lt_grid_columns_lg" value="<?php echo esc_attr($layout_settings['grid_columns_lg']) ?>" />
			<input type="hidden" name="lt_grid_columns_md" value="<?php echo esc_attr($layout_settings['grid_columns_md']) ?>" />
			<input type="hidden" name="lt_grid_columns_sm" value="<?php echo esc_attr($layout_settings['grid_columns_sm']) ?>" />
			<input type="hidden" name="lt_grid_columns_xs" value="<?php echo esc_attr($layout_settings['grid_columns_xs']) ?>" />
			<input type="hidden" name="lt_show_rating" value="<?php echo esc_attr($layout_settings['show_rating']) ?>" />
			<input type="hidden" name="lt_show_tagline" value="<?php echo esc_attr($layout_settings['show_tagline']) ?>" />
			<input type="hidden" name="lt_results_sorting" class="lt_results_sorting job-manager-filter" value="featured" />

			<?php if ( is_tax('job_listing_tag') ) {
				global $wp_query;
				$term =	$wp_query->queried_object;
			?>
				<input type="hidden" name="lt_filter_tag" value="<?php echo esc_attr($term->slug); ?>">
			<?php } ?>

			<?php if ( apply_filters( 'job_manager_job_filters_show_submit_button', true ) ) : ?>
				<div class="search_submit">
					<input type="submit" value="<?php esc_attr_e( 'Search', 'fioxen' ); ?>">
				</div>
			<?php endif; ?>

			<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

		</div>

		<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
	</form>


	<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

	<noscript><?php esc_html_e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'fioxen' ); ?></noscript>

<?php if($layout == 'filters_left' || $layout == 'filters_right'){
		echo '</div>';
	echo '</div>';
} ?>

<?php if( $layout == 'filters_hidden' ){ echo '</div>'; } ?>


</div></div></div></div></div>

<!-- Display map after the filters -->
<?php if( $layout == 'filters_left' || $layout == 'filters_right' || $layout == 'filters_top' ){ ?>
         
	<?php if($show_map == 'container'){ ?>
	<div class="lt-map-top">
		<div class="container">
			<div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>
		</div>   
	</div>   
	<?php } ?> 

	<?php if($show_map == 'contain-fw'){ ?>
	<div class="lt-map-top">
		<div class="container-full">
			<div id="lt-listing--map" class="lt-listing--map lt-map-main"></div>
		</div>   
	</div>   
	<?php } ?>    

<?php } ?>


<!-- Start the div agains -->
<div class="lt--filters-slidebar-layout lt--warpper">
	<div class="lt--content-inner">
		<div class="lt--results-content">
			<div class="lt-content-inner container">
				<div class="row">