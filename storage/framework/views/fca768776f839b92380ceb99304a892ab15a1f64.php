<?php $__env->startSection('title', \App\CPU\translate('Edit Shipping Method')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Shipping Method Update')); ?></li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-black-50"><?php echo e(\App\CPU\translate('shipping_method')); ?> <?php echo e(\App\CPU\translate('update')); ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(\App\CPU\translate('shipping_method')); ?> <?php echo e(\App\CPU\translate('form')); ?>

                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.business-settings.shipping-method.update',[$method['id']])); ?>"
                          style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                          method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <label for="title"><?php echo e(\App\CPU\translate('title')); ?></label>
                                    <input type="text" name="title" value="<?php echo e($method['title']); ?>" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <label for="duration"><?php echo e(\App\CPU\translate('duration')); ?></label>
                                    <input type="text" name="duration" value="<?php echo e($method['duration']); ?>" class="form-control" placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('4 to 6 days')); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <div class="col-md-5">
                                    <label for="cost"><?php echo e(\App\CPU\translate('cost')); ?></label>
                                    <input type="number" min="0" max="1000000" name="cost" value="<?php echo e(\App\CPU\BackEndHelper::usd_to_currency($method['cost'])); ?>" class="form-control" placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('10 $')); ?>">
                                </div>
                                <div class="col-md-5">
                                    <label for="extra"><?php echo e(\App\CPU\translate('Extra Cost Per KG (After 1 KG)')); ?></label>
                                    <input type="number" min="0" max="1000000" name="extra" value="<?php echo e(\App\CPU\BackEndHelper::usd_to_currency($method['extra'])); ?>" class="form-control" placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('10 $')); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary "><?php echo e(\App\CPU\translate('Update')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/shipping-method/edit.blade.php ENDPATH**/ ?>