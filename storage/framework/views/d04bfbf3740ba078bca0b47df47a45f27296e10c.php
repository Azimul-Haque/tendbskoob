<?php $__env->startSection('title', \App\CPU\translate('Shipping Method Settings')); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="text-center"><i class="tio-settings-outlined"></i>
                 <?php echo e(\App\CPU\translate('Shipping_Method_Select')); ?>

            </h5>

        </div>
        <div class="card-body">
             <?php ($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method')); ?>
            <form action="<?php echo e(route('admin.business-settings.shipping-method.shipping-store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-8">

                        <select class="form-control" name="shippingMethod"
                                style="width: 100%">
                            <option value="0" selected disabled>---<?php echo e(\App\CPU\translate('select')); ?>---</option>
                                <option class="text-capitalize" value="inhouse_shipping" <?php echo e($shippingMethod=='inhouse_shipping'?'selected':''); ?> ><?php echo e(\App\CPU\translate('inhouse_shipping_method')); ?> </option>
                                <option class="text-capitalize" value="sellerwise_shipping" <?php echo e($shippingMethod=='sellerwise_shipping'?'selected':''); ?>><?php echo e(\App\CPU\translate('seller_wise_shipping_method')); ?></option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('submit')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/shipping-method/setting.blade.php ENDPATH**/ ?>