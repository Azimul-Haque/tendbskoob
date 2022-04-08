<?php $__env->startSection('title', \App\CPU\translate('Review List')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(\App\CPU\translate('Review List')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <div class="flex-start">
                            <h5><?php echo e(\App\CPU\translate('Review')); ?> <?php echo e(\App\CPU\translate('Table')); ?> </h5>
                            <h5 class="mx-1"><span style="color: red;">(<?php echo e($reviews->total()); ?>)</span></h5>
                        </div>
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <!-- Search -->
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="<?php echo e(\App\CPU\translate('Search by Product Name')); ?>" aria-label="Search orders" value="<?php echo e($search); ?>" required>
                                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                                    </div>
                                    <!-- End Search -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive datatable-custom">
                            <table style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                   class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(\App\CPU\translate('SL#')); ?></th>
                                    <th style="width: 30%"><?php echo e(\App\CPU\translate('Product')); ?></th>

                                    <th><?php echo e(\App\CPU\translate('Review')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Rating')); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($review->product): ?>
                                        <tr>
                                            <td><?php echo e($reviews->firstItem()+ $key); ?></td>
                                            <td>
                                        <span class="d-block font-size-sm text-body">
                                            <a href="<?php echo e(route('seller.product.view',[$review['product_id']])); ?>">
                                                <?php echo e($review->product?$review->product['name']:"Product removed"); ?>

                                            </a>
                                        </span>
                                            </td>

                                            <td>
                                                <?php echo e($review->comment?$review->comment:"No Comment Found"); ?>

                                            </td>
                                            <td>
                                                <label class="badge badge-soft-info">
                                                    <?php echo e($review->rating); ?> <i class="tio-star"></i>
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- End Table -->
                    <!-- Footer -->
                     <div class="card-footer">
                        <?php echo e($reviews->links()); ?>

                    </div>
                    <?php if(count($reviews)==0): ?>
                        <div class="text-center p-4">
                            <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0"><?php echo e(\App\CPU\translate('No data to show')); ?></p>
                        </div>
                    <?php endif; ?>
                    <!-- End Footer -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/seller-views/reviews/list.blade.php ENDPATH**/ ?>