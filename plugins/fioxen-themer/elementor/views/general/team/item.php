<?php 
   use Elementor\Group_Control_Image_Size;

   $style = $settings['style'];
	$image_id = isset($item['image']['id']) && $item['image']['id'] ? $item['image']['id'] : 0; 
   $image_url = isset($item['image']['url']) && $item['image']['url'] ? $item['image']['url'] : '';
   $image_alt = $item['name'];
   if($image_id){
      $attach_url = wp_get_attachment_image_src( $image_id, $settings['image_size']);
      if(isset($attach_url[0]) && $attach_url[0]){
         $image_url = $attach_url[0];
      }
      $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
   }
   $name = $item['name'];
   
   $image = '<img ' . $this->fioxen_get_image_size($image_url) . ' src="' . esc_url($image_url) . '" alt="' . esc_html($image_alt) . '" />';

?>

<?php if($style == 'style-1'){ ?>
   <div class="gsc-team-item">
   	<?php if($image_url){ ?>
   		<div class="team-image">
            <?php echo $this->gva_render_link_html($image, $item['link'], 'link-content') ?>  
            <div class="socials-team">
               <?php $this->gva_render_link_html_2('<i class="fa fa-facebook"></i>', $item['facebook']) ?>
               <?php $this->gva_render_link_html_2('<i class="fa fa-twitter"></i>', $item['twitter']) ?>
               <?php $this->gva_render_link_html_2('<i class="fa fa-instagram"></i>', $item['instagram']) ?>
               <?php $this->gva_render_link_html_2('<i class="fa fa-pinterest"></i>', $item['pinterest']) ?>
            </div>
   		</div>
   	<?php } ?>	
      <div class="team-content">
   		<?php if($item['name']){ ?>
   			<h3 class="team-name">
               <?php echo $this->gva_render_link_html($item['name'], $item['link']) ?>   
            </h3>
   		<?php } ?>
   		<?php if($item['position']){ ?>
   			<div class="team-job"><?php echo $item['position'] ?></div>
   		<?php } ?>
   	</div>
   </div>		
<?php } ?>

