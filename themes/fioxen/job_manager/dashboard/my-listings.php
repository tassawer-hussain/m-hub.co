<h3 class="page-title"><?php echo esc_html__('My Listings', 'fioxen') ?></h3>

<div class="job-manager-jobs">
   <?php if ( ! $jobs ) : ?>
      <div class="alert alert-warning"><?php echo esc_html_e( 'You do not have any active listings.', 'fioxen' ); ?></div>
   <?php else : ?>
      <?php foreach ( $jobs as $job ) : ?>
         <?php $attrs['job'] = $job; ?>
         <?php get_job_manager_template( 'loop/item-my-listing.php', $attrs) ?>
      <?php endforeach; ?>
   <?php endif; ?>
   <?php get_job_manager_template( 'pagination.php', [ 'max_num_pages' => $max_num_pages ] ); ?>
</div>

<div class="modal fade modal-ajax-user-form" id="popup-ajax-package" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header-form">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="ajax-package-form-content"></div>
         </div>
      </div>
   </div>
</div>
