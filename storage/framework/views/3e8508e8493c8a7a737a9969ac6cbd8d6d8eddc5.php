<!-- Header -->
<div class="card-header">
    <h5 class="card-header-title">
        <i class="tio-user"></i> <?php echo e(\App\CPU\translate('top_customer')); ?>

    </h5>
    <i class="tio-poi-user" style="font-size: 45px"></i>
</div>
<!-- End Header -->

<!-- Body -->
<div class="card-body">
    <div class="row">
        <?php $__currentLoopData = $top_customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($item->customer)): ?>
                <div class="col-6 col-md-4 mt-2"
                     onclick="location.href='<?php echo e(route('admin.customer.view',[$item['customer_id']])); ?>'"
                     style="padding-left: 6px;padding-right: 6px;cursor: pointer">
                    <div class="grid-card" style="min-height: 170px">
                        <div class="label_1 row-center">
                            <div class="mx-1"><?php echo e(\App\CPU\translate('orders')); ?> : </div>
                            <div><?php echo e($item['count']); ?></div>
                        </div>
                        <div class="text-center mt-3">
                            <img style="border-radius: 50%;width: 60px;height: 60px;border:2px solid #80808082;"
                                 onerror="this.src='<?php echo e(asset('public/assets/back-end/img/160x160/img1.jpg')); ?>'"
                                 src="<?php echo e(asset('storage/app/public/profile/'.$item->customer->image??'')); ?>">
                        </div>
                        <div class="text-center mt-2">
                            <span style="font-size: 10px"><?php echo e($item->customer['f_name']??'Not exist'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<!-- End Body -->
<?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/partials/_top-customer.blade.php ENDPATH**/ ?>