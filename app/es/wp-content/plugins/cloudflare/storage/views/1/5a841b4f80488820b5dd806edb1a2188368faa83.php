<?php $__env->startSection('content'); ?>

<div class="pa-content py-5">
	<div class="container">

        <?php echo the_content(); ?>


    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/isaltino/Git/deploy-downloads.adventistas.org/app/es/wp-content/themes/pa-theme-downloads/page-front-page.blade.php ENDPATH**/ ?>