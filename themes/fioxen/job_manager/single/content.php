<div class="listing-single-content">
   <?php 
      if(class_exists('GVA_Layout_Frontend')){
         do_action('fioxen/layouts/single/listing');
      }else{
         get_template_part('templates/blog/single');
      }
   ?>
</div>
