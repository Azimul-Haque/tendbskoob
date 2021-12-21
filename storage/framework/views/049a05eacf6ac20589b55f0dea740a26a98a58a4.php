<?php $__env->startSection('title', \App\CPU\translate('Product Bulk Import')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="<?php echo e(route('admin.product.list', ['in_house',''])); ?>"><?php echo e(\App\CPU\translate('Product')); ?></a>
                </li>
                <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('bulk_import')); ?> </li>
            </ol>
        </nav>
        <!-- Content Row -->
        <div class="row" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
            <div class="col-12">
                <div class="jumbotron" style="background: white">
                    <h1 class="display-4"><?php echo e(\App\CPU\translate('Instructions')); ?> : </h1>
                    <p> 1. <?php echo e(\App\CPU\translate('Download the format file and fill it with proper data')); ?>.</p>

                    <p>2. <?php echo e(\App\CPU\translate('You can download the example file to understand how the data must be filled')); ?>.</p>

                    <p>3. <?php echo e(\App\CPU\translate('Once you have downloaded and filled the format file, upload it in the form below and submit')); ?>.</p>

                    <p> 4. <?php echo e(\App\CPU\translate('After uploading products you need to edit them and set product images and choices')); ?>.</p>

                    <p> 5. <?php echo e(\App\CPU\translate('You can get brand and category id from their list, please input the right ids')); ?>.</p>

                </div>
            </div>

            <div class="col-md-12">
                <form class="product-form" action="<?php echo e(route('admin.product.bulk-import')); ?>" method="POST"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4><?php echo e(\App\CPU\translate('Import Products File')); ?></h4>
                            <a href="<?php echo e(asset('public/assets/product_bulk_format.xlsx')); ?>" download=""
                               class="btn btn-secondary"><?php echo e(\App\CPU\translate('Download Format')); ?></a>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="file" name="products_file">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/product/bulk-import.blade.php ENDPATH**/ ?>