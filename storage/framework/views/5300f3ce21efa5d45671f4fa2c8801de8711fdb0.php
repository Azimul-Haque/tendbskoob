<?php $__env->startSection('title', \App\CPU\translate('Shop view')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="h3 mb-0  "><?php echo e(\App\CPU\translate('my_shop')); ?> <?php echo e(\App\CPU\translate('Info')); ?> </h3>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <?php if($shop->image=='def.png'): ?>
                                <div class="col-md-3 text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">
                                    <img height="200" width="200" class="rounded-circle border"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('public/assets/back-end')); ?>/img/shop.png">
                                </div>
                            <?php else: ?>
                                <div class="col-md-3 text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">
                                    <img src="<?php echo e(asset('storage/app/public/shop/'.$shop->image)); ?>"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         class="rounded-circle border"
                                         height="200" width="200" alt="">
                                </div>
                            <?php endif; ?>


                            <div class="col-md-4 mt-4">
                                <div class="flex-start">
                                    <h4><?php echo e(\App\CPU\translate('Name')); ?> : </h4>
                                    <h4 class="mx-1"><?php echo e($shop->name); ?></h4>
                                </div>
                                <div class="flex-start">
                                    <h6><?php echo e(\App\CPU\translate('Phone')); ?> : </h6>
                                    <h6 class="mx-1"><?php echo e($shop->contact); ?></h6>
                                </div>
                                <div class="flex-start">
                                    <h6><?php echo e(\App\CPU\translate('address')); ?> : </h6>
                                    <h6 class="mx-1"><?php echo e($shop->address); ?></h6>
                                </div>

                                <div class="flex-start">
                                    <a class="btn btn-primary" href="<?php echo e(route('seller.shop.edit',[$shop->id])); ?>"><?php echo e(\App\CPU\translate('edit')); ?></a>
                                </div>
                            </div>
                            <div class="col-md-5"></div>
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

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/seller-views/shop/shopInfo.blade.php ENDPATH**/ ?>