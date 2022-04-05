<?php if(is_admin()): ?>
  <img class="img-preview" src="<?php echo e(get_stylesheet_directory_uri()); ?>/Blocks/PAFeaturePost/preview.png" alt="<?php echo e(__('Illustrative image of the front end of the block.', 'iasd')); ?>"/>
<?php else: ?>
  <div class="col-lg-8">
    <div class="pa-blog-itens mb-5">    
      <h2 class="mb-3"><?php echo e($title); ?></h2>

      <div class="pa-blog-feature">
        <a href="<?php echo e(get_the_permalink($id)); ?>" title="<?php echo wp_strip_all_tags(get_the_title($id)); ?>">
          <div class="ratio ratio-16x9">
            <figure class="figure m-xl-0 w-100">
              <img src="<?php echo e(check_immg($id, 'full')); ?>" class="figure-img img-fluid m-0 rounded w-100 h-100 object-cover" alt="<?php echo wp_strip_all_tags(get_the_title($id)); ?>">

              <figcaption class="figure-caption position-absolute w-100 p-3 rounded-bottom">
                <?php if (! empty($department = getDepartment($id))) : ?>
                  <span class="pa-tag rounded-1 text-uppercase mb-2 d-none d-md-inline-block px-2"><?php echo e($department->name); ?></span>
                <?php endif; ?>
                
                <h3 class="h5 pt-2 pa-truncate-2"><?php echo get_the_title($id); ?></h3>
              </figcaption>
            </figure>
          </div>
        </a>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php /**PATH /Users/isaltino/Git/deploy-downloads.adventistas.org/app/pt/wp-content/themes/pa-theme-downloads/Blocks/PAFeaturePost/views/frontend.blade.php ENDPATH**/ ?>