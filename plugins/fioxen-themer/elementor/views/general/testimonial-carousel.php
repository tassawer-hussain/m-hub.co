<?php
	if(!defined('ABSPATH')){ exit; }

	$classes = array();
	$classes[] = $style = $settings['style'];
	$classes[] = 'gsc-testimonial-carousel swiper-slider-wrapper';
	$this->add_render_attribute('wrapper', 'class', $classes);

?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<div class="swiper-content-inner">
		<div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
			<div class="swiper-wrapper">
				<?php foreach ($settings['testimonials'] as $item){ ?>
					<?php
						$has_icon = ! empty( $item['selected_icon']['value']); 
						$avatar = (isset($item['testimonial_image']['url']) && $item['testimonial_image']['url']) ? $item['testimonial_image']['url'] : '';
					?>
					<div class="swiper-slide">
						<div class="testimonial-item">
							<div class="testimonial-item-content">
								
								<?php if($style == "style-1"){ ?>
									<div class="testimonial-image">
										<img <?php echo $this->fioxen_get_image_size($avatar) ?> src="<?php echo esc_url($avatar) ?>" alt="<?php echo $item['testimonial_name']; ?>" />
									</div>
									<div class="testimonial-content">
										<div class="testimonial-quote">
											<?php echo $item['testimonial_content']; ?>
										</div>
										<div class="testimonial-information">
											<span class="testimonial-name"><?php echo $item['testimonial_name']; ?></span>
											<span class="testimonial-job"><?php echo $item['testimonial_job']; ?></span>
										</div>
									</div>
								<?php } ?>	

								<?php if($style == "style-2"){ ?>
									<div class="testimonial-content">
										<div class="testimonial-quote">
											<?php echo $item['testimonial_content']; ?>
										</div>
										<div class="testimonial-information">
											<div class="testimonial-image">
												<img <?php echo $this->fioxen_get_image_size($avatar) ?> src="<?php echo esc_url($avatar) ?>" alt="<?php echo $item['testimonial_name']; ?>" />
											</div>
											<div class="right-info">
												<span class="testimonial-name"><?php echo $item['testimonial_name']; ?></span>
												<span class="testimonial-job"><?php echo $item['testimonial_job']; ?></span>
											</div>	
										</div>
									</div>
								<?php } ?>	

							</div>
						</div>	
					</div>
				<?php } ?>
			</div>
		</div>
	</div>   
	<?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
	<?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
</div>
