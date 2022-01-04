<?php $__env->startSection('title', \App\CPU\translate('Coupon Add')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/css/select2.min.css" rel="stylesheet"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i
                            class="tio-add-circle-outlined"></i> <?php echo e(\App\CPU\translate('Add')); ?> <?php echo e(\App\CPU\translate('New')); ?> <?php echo e(\App\CPU\translate('Coupon')); ?>

                    </h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Content Row -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.coupon.add-new')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('Type')); ?></label>
                                        <select class="form-control" name="coupon_type"
                                                style="width: 100%" required>
                                            
                                            <option value="discount_on_purchase"><?php echo e(\App\CPU\translate('Discount_on_Purchase')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('Title')); ?></label>
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="<?php echo e(\App\CPU\translate('Title')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('Code')); ?></label>
                                        <input type="text" name="code" value="<?php echo e(\Illuminate\Support\Str::random(10)); ?>"
                                               class="form-control" id="code"
                                               placeholder="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('start_date')); ?></label>
                                        <input type="date" name="start_date" class="form-control" id="start date"
                                               placeholder="<?php echo e(\App\CPU\translate('start date')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('expire_date')); ?></label>
                                        <input type="date" name="expire_date" class="form-control" id="expire date"
                                               placeholder="<?php echo e(\App\CPU\translate('expire date')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label
                                            for="exampleFormControlInput1"><?php echo e(\App\CPU\translate('limit')); ?> <?php echo e(\App\CPU\translate('for')); ?> <?php echo e(\App\CPU\translate('same')); ?> <?php echo e(\App\CPU\translate('user')); ?></label>
                                        <input type="number" name="limit" id="coupon_limit" class="form-control"
                                               placeholder="<?php echo e(\App\CPU\translate('EX')); ?>: <?php echo e(\App\CPU\translate('10')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('discount_type')); ?></label>
                                        <select class="form-control" name="discount_type"
                                                onchange="checkDiscountType(this.value)"
                                                style="width: 100%">
                                            <option value="amount"><?php echo e(\App\CPU\translate('Amount')); ?></option>
                                            <option value="percentage"><?php echo e(\App\CPU\translate('percentage')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('Discount')); ?></label>
                                        <input type="number" min="1" max="1000000" name="discount" class="form-control"
                                               id="discount"
                                               placeholder="<?php echo e(\App\CPU\translate('discount')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('minimum_purchase')); ?></label>
                                    <input type="number" min="1" max="1000000" name="min_purchase" class="form-control"
                                           id="minimum purchase"
                                           placeholder="<?php echo e(\App\CPU\translate('minimum purchase')); ?>" required>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('maximum_discount')); ?></label>
                                        <input type="number" min="1" max="1000000" name="max_discount"
                                               class="form-control" id="maximum discount"
                                               placeholder="<?php echo e(\App\CPU\translate('maximum discount')); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Submit')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-lg-3 mb-3 mb-lg-0">
                                <h5><?php echo e(\App\CPU\translate('coupons_table')); ?> <span style="color: red;">(<?php echo e($cou->total()); ?>)</span>
                                </h5>
                            </div>
                            <div class="col-lg-6">
                                <!-- Search -->
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                               placeholder="<?php echo e(\App\CPU\translate('Search by Title or Code or Discount Type')); ?>"
                                               value="<?php echo e($search); ?>" aria-label="Search orders" required>
                                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(\App\CPU\translate('SL')); ?>#</th>
                                    <th><?php echo e(\App\CPU\translate('coupon_type')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Title')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Code')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('user')); ?> <?php echo e(\App\CPU\translate('limit')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('minimum_purchase')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('maximum_discount')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Discount')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('discount_type')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('start_date')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('expire_date')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Status')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $cou; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($cou->firstItem() + $k); ?></th>
                                        <td style="text-transform: capitalize"><?php echo e(str_replace('_',' ',$c['coupon_type'])); ?></td>
                                        <td class="text-capitalize">
                                            <?php echo e(substr($c['title'],0,20)); ?>

                                        </td>
                                        <td><?php echo e($c['code']); ?></td>
                                        <td><?php echo e($c['limit']); ?></td>
                                        <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($c['min_purchase']))); ?></td>
                                        <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($c['max_discount']))); ?></td>
                                        <td><?php echo e($c['discount_type']=='amount'?\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($c['discount'])):$c['discount']); ?></td>
                                        <td><?php echo e($c['discount_type']); ?></td>
                                        <td><?php echo e(date('d-M-y',strtotime($c['start_date']))); ?></td>
                                        <td><?php echo e(date('d-M-y',strtotime($c['expire_date']))); ?></td>
                                        <td>
                                            <label class="toggle-switch toggle-switch-sm">
                                                <input type="checkbox" class="toggle-switch-input"
                                                       onclick="location.href='<?php echo e(route('admin.coupon.status',[$c['id'],$c->status?0:1])); ?>'"
                                                       class="toggle-switch-input" <?php echo e($c->status?'checked':''); ?>>
                                                <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                            </span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.coupon.update',[$c['id']])); ?>"
                                               class="btn btn-primary btn-sm">
                                                <?php echo e(\App\CPU\translate('Update')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php echo e($cou->links()); ?>

                    </div>
                    <?php if(count($cou)==0): ?>
                        <div class="text-center p-4">
                            <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg"
                                 alt="Image Description" style="width: 7rem;">
                            <p class="mb-0"><?php echo e(\App\CPU\translate('No data to show')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <!-- Page level plugins -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/demo/datatables-demo.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/coupon/add-new.blade.php ENDPATH**/ ?>