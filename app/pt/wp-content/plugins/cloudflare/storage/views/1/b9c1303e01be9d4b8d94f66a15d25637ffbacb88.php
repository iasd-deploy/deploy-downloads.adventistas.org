<?php if(is_admin()): ?>
	<img class="img-preview" src="<?php echo e(get_stylesheet_directory_uri()); ?>/Blocks/PACarouselPosts/preview.png" alt='<?php echo e(__('Illustrative image of the front end of the block.', 'iasd')); ?>'/>
<?php else: ?> 
  <?php if (! empty($items)) : ?> 
    <div class="pa-widget pa-carousel-download col-12 mb-5">
      <div class="pa-glide-posts">
        <?php if (! empty($title)) : ?>
          <div class="d-flex mb-4">
            <h2 class="flex-grow-1"><?php echo $title; ?></h2>	

            <?php if(count($items) > 1): ?>
              <div class="pa-slider-controle d-none d-sm-flex justify-content-between justify-content-xl-start align-items-center">
                <div data-glide-el="controls">
                  <span class="fa-stack" data-glide-dir="&lt;">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="icon fas fa-arrow-left fa-stack-1x"></i>
                  </span>
                </div>

                <div data-glide-el="controls">
                  <span class="fa-stack" data-glide-dir="&gt;">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="icon fas fa-arrow-right fa-stack-1x"></i>
                  </span>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        
        <div class="row mx-sm-0">
          <div class="glide__track ps-2 ps-sm-0 pe-0" data-glide-el="track">
            <div class="glide__slides">
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="glide__slide px-1 h-auto">

                  <div class="card border-0 shadow-sm">
                    <figure class="ratio ratio-16x9 bg-light rounded-bottom overflow-hidden m-0">
                      <img src="<?php echo e(check_immg($id, 'medium')); ?>" class="card-img-top"	alt="<?php echo wp_strip_all_tags(get_the_title($id)); ?>" />
                    </figure>
  
                    <div class="card-body p-3 d-flex flex-column">
                      <?php if (! empty($department = getDepartment($id))) : ?>
                        <div>
                          <span class="pa-tag rounded-1 text-uppercase d-inline-block px-2 mb-2"><?php echo e($department->name); ?></span>
                        </div>
                      <?php endif; ?>

                      <a href="<?php echo e(get_the_permalink($id)); ?>" class="stretched-link" title="<?php echo wp_strip_all_tags(get_the_title($id)); ?>">
                        <h3 class="card-title fw-bold h6 mb-3 pa-truncate-2"><?php echo wp_strip_all_tags(get_the_title($id)); ?></h3>
                      </a>

                      <div class="flex-grow-1"></div>
                    </div>
                  </div>
                
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php /**PATH /Users/isaltino/Git/deploy-downloads.adventistas.org/app/pt/wp-content/themes/pa-theme-downloads/Blocks/PACarouselPosts/views/frontend.blade.php ENDPATH**/ ?>