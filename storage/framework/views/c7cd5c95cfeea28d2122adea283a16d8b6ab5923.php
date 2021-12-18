<?php $__env->startSection('message'); ?>
    <style>
        .for-margin {
            margin: auto;

            margin-bottom: 10%;
        }

        .for-margin {

        }

        .page-not-found {
            margin-top: 30px;
            font-weight: 600;
            text-align: center;
        }
    </style>
    <div class="container ">
        <div class="col-md-3"></div>
        <div class="col-md-6 for-margin">
            <div class="for-image">
                <img style="" src="<?php echo e(asset("storage/app/public/png/500.png")); ?>" alt="">
            </div>
            <h2 class="page-not-found">Server Error</h2>
            <p style="text-align: center;"><?php echo e(\App\CPU\translate('We are sorry, server is not responding')); ?>. <br> <?php echo e(\App\CPU\translate('Try after sometime')); ?>.</p>
        </div>
        <div class="col-md-3"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/errors/500.blade.php ENDPATH**/ ?>