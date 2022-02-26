<?php $__env->startSection('title', \App\CPU\translate('Bank Info View')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('seller')); ?></li>
                <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('my_bank_info')); ?></li>
            </ol>
        </nav>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                    <div class="card-header">
                        <h3 class="h3 mb-0  "><?php echo e(\App\CPU\translate('my_bank_info')); ?>  </h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-8 mt-4">
                            <div class="flex-start">
                                <h4><?php echo e(\App\CPU\translate('bank_name')); ?> : </h4>
                                <h4 class="mx-1"><?php echo e($data->bank_name ? $data->bank_name : 'No Data found'); ?></h4>
                            </div>
                            <div class="flex-start">
                                <h6><?php echo e(\App\CPU\translate('Branch')); ?> : </h6>
                                <h6 class="mx-1"><?php echo e($data->branch ? $data->branch : 'No Data found'); ?></h6>
                            </div>
                            <div class="flex-start">
                                <h6><?php echo e(\App\CPU\translate('holder_name')); ?> : </h6>
                                <h6 class="mx-1"><?php echo e($data->holder_name ? $data->holder_name : 'No Data found'); ?></h6>
                            </div>
                            <div class="flex-start">
                                <h6><?php echo e(\App\CPU\translate('account_no')); ?> : </h6>
                                <h6 class="mx-1"><?php echo e($data->account_no ? $data->account_no : 'No Data found'); ?></h6>
                            </div>

                            <a class="btn btn-primary"
                               href="<?php echo e(route('seller.profile.bankInfo',[$data->id])); ?>"><?php echo e(\App\CPU\translate('Edit')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <!-- Page level plugins -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/seller-views/profile/view.blade.php ENDPATH**/ ?>