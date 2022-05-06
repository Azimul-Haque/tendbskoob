<?php $__env->startSection('title', \App\CPU\translate('Seller product sale Report')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        .dataTables_info {
            margin-bottom: 20px;
            border-top: 1px solid;
            padding-top: 20px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <!-- Nav -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <ul class="nav nav-tabs page-header-tabs" id="projectsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:"><?php echo e(\App\CPU\translate('Seller product sale report')); ?></a>
                    </li>
                </ul>
            </div>
            <!-- End Nav -->
        </div>
        <!-- End Page Header -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form style="width: 100%;" action="<?php echo e(route('admin.report.seller-product-sale')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6 col-md-1">
                                    <div class="form-group text-center">
                                        <label for="exampleInputEmail1"><?php echo e(\App\CPU\translate('Seller')); ?></label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <select class="js-select2-custom form-control" name="seller_id">
                                            <option value="all"><?php echo e(\App\CPU\translate('All')); ?></option>
                                            <?php $__currentLoopData = \App\Model\Seller::where(['status'=>'approved'])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($seller['id']); ?>" <?php echo e($seller_id==$seller['id']?'selected':''); ?>>
                                                    <?php echo e($seller['f_name']); ?> <?php echo e($seller['l_name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6 col-md-1 text-center">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1"><?php echo e(\App\CPU\translate('Category')); ?></label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group">
                                        <select
                                            class="js-select2-custom form-control"
                                            name="category_id">
                                            <option value="all"><?php echo e(\App\CPU\translate('All')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($c['id']); ?>" <?php echo e($category_id==$c['id']? 'selected': ''); ?>>
                                                    <?php echo e($c['name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <?php echo e(\App\CPU\translate('Filter')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body"
                         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    <?php echo e(\App\CPU\translate('Product Name')); ?> <label class="badge badge-success ml-3"
                                                        style="cursor: pointer"><?php echo e(\App\CPU\translate('ASE/DESC')); ?></label>
                                </th>
                                <th scope="col">
                                    <?php echo e(\App\CPU\translate('Total Sale')); ?> <label class="badge badge-success ml-3"
                                                      style="cursor: pointer"><?php echo e(\App\CPU\translate('ASE/DESC')); ?></label>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($key+1); ?></th>
                                    <td><?php echo e($data['name']); ?></td>
                                    <td><?php echo e($data->order_details->sum('qty')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <table>
                            <tfoot>
                            <?php echo $products->links(); ?>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Stats -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/report/seller-product-sale.blade.php ENDPATH**/ ?>