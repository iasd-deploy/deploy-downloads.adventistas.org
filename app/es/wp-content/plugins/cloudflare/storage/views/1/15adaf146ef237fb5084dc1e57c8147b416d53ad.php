<?php echo get_header(); ?>


<?php echo $__env->make('components.header.title', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('components.global.modal-report', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo get_footer(); ?>

<?php /**PATH /Users/isaltino/Git/deploy-downloads.adventistas.org/app/es/wp-content/themes/pa-theme-downloads/layouts/app.blade.php ENDPATH**/ ?>