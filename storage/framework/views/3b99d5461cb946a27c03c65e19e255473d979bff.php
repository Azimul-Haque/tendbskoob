<?php $__env->startSection('title', \App\CPU\translate('Create Role')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('custom_role')); ?></li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo e(\App\CPU\translate('role_form')); ?>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.custom-role.create')); ?>" method="post"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(\App\CPU\translate('role_name')); ?></label>
                                <input type="text" name="name" class="form-control" id="name"
                                       aria-describedby="emailHelp"
                                       placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('Store')); ?>" required>
                            </div>

                            <label for="name"><?php echo e(\App\CPU\translate('module_permission')); ?> : </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="order_management" class="form-check-input"
                                               id="order">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;" for="order"><?php echo e(\App\CPU\translate('Order_Management')); ?></label>
                                    </div>
                                </div>
                                <!--order end-->

                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="product_management" class="form-check-input"
                                               id="product">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="product"><?php echo e(\App\CPU\translate('Product_Management')); ?></label>
                                    </div>
                                </div>
                                <!--product-->

                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="marketing_section"
                                               class="form-check-input"
                                               id="marketing">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="marketing"><?php echo e(\App\CPU\translate('Marketing_Section')); ?></label>
                                    </div>
                                </div>
                                <!--marketing-->

                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="business_section"
                                               class="form-check-input"
                                               id="business_section">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="business_section"><?php echo e(\App\CPU\translate('Business_Section')); ?></label>
                                    </div>
                                </div>
                                <!--business_settings-->
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="user_section"
                                               class="form-check-input"
                                               id="user_section">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="user_section"><?php echo e(\App\CPU\translate('user_Section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="support_section"
                                               class="form-check-input"
                                               id="support_section">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="support_section"><?php echo e(\App\CPU\translate('Support_Section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="business_settings"
                                               class="form-check-input"
                                               id="business_settings">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="business_settings"><?php echo e(\App\CPU\translate('Business_Settings')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="web_&_app_settings"
                                               class="form-check-input"
                                               id="web_&_app_settings">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="web_&_app_settings"><?php echo e(\App\CPU\translate('Web_&_App_Settings')); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="report" class="form-check-input"
                                               id="report">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="report"><?php echo e(\App\CPU\translate('Report_&_Analytics')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="employee_section" class="form-check-input"
                                               id="employee_section">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="employee_section"><?php echo e(\App\CPU\translate('Employee_Section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="dashboard" class="form-check-input"
                                               id="dashboard">
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="dashboard"><?php echo e(\App\CPU\translate('Dashboard')); ?></label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Submit')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(\App\CPU\translate('roles_table')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <thead>
                                <tr>
                                    <th scope="col"><?php echo e(\App\CPU\translate('SL')); ?>#</th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('role_name')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('modules')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('created_at')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('status')); ?></th>
                                    <th scope="col" style="width: 50px"><?php echo e(\App\CPU\translate('action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $rl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($k+1); ?></th>
                                        <td><?php echo e($r['name']); ?></td>
                                        <td class="text-capitalize">
                                            <?php if($r['module_access']!=null): ?>
                                                <?php $__currentLoopData = (array)json_decode($r['module_access']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e(str_replace('_',' ',$m)); ?> <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(date('d-M-y',strtotime($r['created_at']))); ?></td>
                                        <td><?php echo e(\App\CPU\Helpers::status($r['status'])); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.custom-role.update',[$r['id']])); ?>"
                                               class="btn btn-primary btn-sm">
                                                <?php echo e(\App\CPU\translate('Edit')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/custom-role/create.blade.php ENDPATH**/ ?>