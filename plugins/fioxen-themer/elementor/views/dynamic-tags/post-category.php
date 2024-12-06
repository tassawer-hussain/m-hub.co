<?php
	if (!defined('ABSPATH')) {
		exit; 
	}
	global $fioxen_post;
	if (!$fioxen_post){
		return;
	}
	?>
	
	<div class="post-category">
		<?php 
			if($settings['show_icon']){ 
				echo '<i class="far fa-folder-open"></i>';
			}
			echo get_the_category_list( ", ", '', $fioxen_post->ID ) . '</span>';
		?>
	</div>      

