<?php
/*
 * https://github.com/zulfnore/gallery-metabox
*/
class Fioxen_Gallery_Metabox{

	public function __construct(){
		add_action('admin_enqueue_scripts', array($this, 'gallery_metabox_enqueue'));
		add_action('add_meta_boxes', array($this, 'add_gallery_metabox'));
		add_action('save_post', array($this, 'gallery_meta_save'));
	}

	public function gallery_metabox_enqueue($hook) {
	 	if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
			wp_enqueue_script('gallery-metabox', plugin_dir_url( __FILE__ ) . 'js/gallery-metabox.js', array('jquery', 'jquery-ui-sortable'));
	 	}
	}

	function add_gallery_metabox($post_type){
	 	$types = array('job_listing');
		if (in_array($post_type, $types)) {
			add_meta_box(
			  	'gallery-metabox',
			  	esc_html__('Gallery', 'fioxen-themer'),
			  	array($this, 'gallery_meta_callback'),
			  	$post_type,
			  	'side',
			  	'low'
			);
	 	}
	}

	function gallery_meta_callback($post) {
		wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
		$ids = get_post_meta($post->ID, '_lt_gallery_images', true);
		
	?>
		<table class="form-table">
			<tr>
				<td>
			  		<a class="gallery-add button" href="#" data-uploader-title="Add image(s) to gallery" data-uploader-button-text="Add image(s)">Add image(s)</a>

			  		<ul id="gallery-metabox-list">
			  			<?php if ($ids){ ?>
			  			 	<?php 
			  			 	foreach ($ids as $key => $value){ 
			  			 		$image = wp_get_attachment_image_src($value); 
			  			 	?>
							 	<li>
									<input type="hidden" name="_lt_gallery_images[<?php echo $key; ?>]" value="<?php echo $value; ?>">
									<img class="image-preview" src="<?php echo $image[0]; ?>">
									<a class="change-image" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image"><i class="dashicons dashicons-edit"></i></a>
									<a class="remove-image" href="#"><i class="dashicons dashicons-no-alt"></i></a>
							 	</li>
			  				<?php } ?>
			  			<?php }?>
			  		</ul>

				</td>
			</tr>
		</table>
	<?php }

	function gallery_meta_save($post_id){
		if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;

		if (!current_user_can('edit_post', $post_id)) return;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if(isset($_POST['_lt_gallery_images'])) {
			update_post_meta($post_id, '_lt_gallery_images', $_POST['_lt_gallery_images']);
		} else {
			delete_post_meta($post_id, '_lt_gallery_images');
		}
	}

}

new Fioxen_Gallery_Metabox();