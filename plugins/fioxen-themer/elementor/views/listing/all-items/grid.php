<?php
	$query = $this->query_posts();
	$_random = gaviasthemer_random_id();
	if ( ! $query->found_posts ) {
		return;
	}

	$this->add_render_attribute('wrapper', 'class', ['gva-listings-grid clearfix', 'grid-' . $_random]);

	//add_render_attribute grid
	$this->get_grid_settings();
?>
  
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	
	<div class="gva-content-items"> 
	  	<div <?php echo $this->get_render_attribute_string('grid') ?>>
		 	<?php
				global $post;
				$count = 0;
				while ( $query->have_posts() ) { 
				  	$query->the_post();
				  	echo '<div class="item-columns">';
					 	$this->fioxen_get_template_part('job_manager/loop/item', $settings['style'] , 
							array( 
								'thumb_size' 	=> $settings['image_size'],
							 	'show_tagline' => $settings['show_tagline'],
							 	'show_rating'	=> $settings['show_rating']
							) 
						);
				  	echo '</div>';
				}
		 	?>
	  	</div>
	</div>

	<?php if($settings['pagination'] == 'yes'): ?>
	 	<div class="pagination">
		  	<?php echo $this->pagination($query); ?>
	 	</div>
	<?php endif; ?>

</div>

<?php wp_reset_postdata(); ?>