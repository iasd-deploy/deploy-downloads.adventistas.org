<?php if(is_admin()): ?>
	<img class="img-preview" src="<?php echo e(get_stylesheet_directory_uri()); ?>/Blocks/PAListPostsColumn/preview.png" alt="<?php echo e(__('Illustrative image of the front end of the block.', 'iasd')); ?>"/>
<?php else: ?>
	<?php if (! empty($items)) : ?> 
		<div class="pa-widget pa-w-list-posts pa-w-list-posts-column col-lg-4 mb-5">			
			<h2 class="mb-3"><?php echo e($title); ?></h2>

      <div class="row">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card col-12 mb-3 border-0">
            <a href="<?php echo e(get_the_permalink($id)); ?>" title="<?php echo wp_strip_all_tags(get_the_title($id)); ?>">
              <div class="row">
                <div class="img-container">
                  <div class="ratio ratio-56x31">
                    <figure class="figure m-xl-0">
                      <img src="<?php echo e(check_immg($id, 'medium')); ?>" class="figure-img img-fluid rounded m-0" alt="<?php echo wp_strip_all_tags(get_the_title($id)); ?>">
                    </figure>	
                  </div>
                </div>
                <div class="col ps-1">
                  <div class="card-body p-0">
                    <?php if (! empty($department = getDepartment($id))) : ?>
                      <span class="pa-tag rounded-1 text-uppercase d-inline-block px-2 mb-1"><?php echo e($department->name); ?></span>
                    <?php endif; ?>

                    <h3 class="card-title h6 pa-truncate-3 fw-bold m-0"><?php echo wp_strip_all_tags(get_the_title($id)); ?></h3>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

			<?php if(!empty($enable_link) && !empty($link)): ?>
				<a 
					href="<?php echo e($link['url'] ?? '#'); ?>" 
					target="<?php echo e($link['target'] ?? '_self'); ?>"
					class="pa-all-content d-inline-block mt-1"
				>
					<?php echo $link['title']; ?>

				</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php /**PATH /Users/isaltino/Git/deploy-downloads.adventistas.org/app/es/wp-content/themes/pa-theme-downloads/Blocks/PAListPostsColumn/views/frontend.blade.php ENDPATH**/ ?>