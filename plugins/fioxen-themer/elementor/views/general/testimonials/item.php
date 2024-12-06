<?php 
use Elementor\Icons_Manager;
	
$has_icon = ! empty( $item['selected_icon']['value']); 
$style = $settings['style'];
$avatar = (isset($item['testimonial_image']['url']) && $item['testimonial_image']['url']) ? $item['testimonial_image']['url'] : '';
?>
<div class="testimonial-item <?php echo esc_attr($style) ?> elementor-repeater-item-<?php echo $item['_id'] ?>">
	
		<?php if( $style == 'style-1'){ ?>
			<div class="testimonial-content">
	         <div class="testimonial-image"><img <?php echo $this->fioxen_get_image_size($avatar) ?> src="<?php echo esc_url($avatar) ?>" alt="<?php echo $item['testimonial_name']; ?>" /></div>
	         <div class="testimonial-content-inner">
	            <div class="testimonial-quote"><?php echo $item['testimonial_content']; ?></div>
	            <div class="testimonial-meta">
	               <div class="testimonial-information">
	                  <span class="testimonial-name"><?php echo $item['testimonial_name']; ?>,</span>
	                  <span class="testimonial-job"><?php echo $item['testimonial_job']; ?></span>
	               </div>
	            </div>
	            <span class="quote-icon"><i class="fi flaticon-quote"></i></span>
	         </div>
	      </div>   
		<?php } ?>	


		<?php if( $style == 'style-2'){ ?>
			<div class="testimonial-item-content">
	         <div class="testimonial-content">
	            <?php echo $item['testimonial_content']; ?>
	         </div>
	        	<div class="testimonial-meta clearfix">
	            <div class="testimonial-image">
	               <img <?php echo $this->fioxen_get_image_size($avatar) ?> src="<?php echo esc_url($avatar) ?>" alt="<?php echo $item['testimonial_name']; ?>" />
	            </div>
	            <div class="testimonial-information">
	               <span class="testimonial-name"><?php echo $item['testimonial_name']; ?></span>
	               <span class="testimonial-job"><?php echo $item['testimonial_job']; ?></span>
	            </div>
	         </div>
	         <span class="icon-quote icon-fioxen-quotes"></span>
	      </div>   
		<?php } ?>

</div>

