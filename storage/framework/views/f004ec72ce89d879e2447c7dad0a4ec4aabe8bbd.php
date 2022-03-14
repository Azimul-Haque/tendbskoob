<?php $__env->startSection('title', \App\CPU\translate('Bank Info')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end/css/croppie.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Seller')); ?></li>
                <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('Bank info')); ?></li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mb-0 "><?php echo e(\App\CPU\translate('Edit Bank Info')); ?></h1>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('seller.profile.bank_update',[$data->id])); ?>" method="post"
                              enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name"><?php echo e(\App\CPU\translate('Bank Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" value="<?php echo e($data->bank_name); ?>"
                                               class="form-control" id="name"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name"><?php echo e(\App\CPU\translate('Branch Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="branch" value="<?php echo e($data->branch); ?>" class="form-control"
                                               id="name"
                                               required>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="account_no"><?php echo e(\App\CPU\translate('Holder Name')); ?> <span class="text-danger">*</span></label>
                                        <input type="text" name="holder_name" value="<?php echo e($data->holder_name); ?>"
                                               class="form-control" id="account_no"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="account_no"><?php echo e(\App\CPU\translate('Account No')); ?> <span class="text-danger">*</span></label>
                                        <input type="number" name="account_no" value="<?php echo e($data->account_no); ?>"
                                               class="form-control" id="account_no"
                                               required>
                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary" id="btn_update"><?php echo e(\App\CPU\translate('Update')); ?></button>
                            <a class="btn btn-danger" href="<?php echo e(route('seller.profile.view')); ?>"><?php echo e(\App\CPU\translate('Cancel')); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/seller-views/profile/bankEdit.blade.php ENDPATH**/ ?>