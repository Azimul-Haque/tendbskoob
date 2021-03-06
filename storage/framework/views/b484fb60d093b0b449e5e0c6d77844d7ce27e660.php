<?php $__env->startSection('title', \App\CPU\translate('Employee List')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Employee')); ?></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('List')); ?></li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(\App\CPU\translate('employee_table')); ?></h5>
                    <a href="<?php echo e(route('admin.employee.add-new')); ?>" class="btn btn-primary  float-right">
                        <i class="tio-add-circle"></i>
                        <span class="text"><?php echo e(\App\CPU\translate('Add')); ?> <?php echo e(\App\CPU\translate('New')); ?></span>
                    </a>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(\App\CPU\translate('SL')); ?>#</th>
                                <th><?php echo e(\App\CPU\translate('Name')); ?></th>
                                <th><?php echo e(\App\CPU\translate('Email')); ?></th>
                                <th><?php echo e(\App\CPU\translate('Phone')); ?></th>
                                <th><?php echo e(\App\CPU\translate('Role')); ?></th>
                                <th style="width: 50px"><?php echo e(\App\CPU\translate('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $em; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($e->role): ?>
                                <tr>
                                    <th scope="row"><?php echo e($k+1); ?></th>
                                    <td class="text-capitalize"><?php echo e($e['name']); ?></td>
                                    <td >
                                      <?php echo e($e['email']); ?>

                                    </td>
                                    <td><?php echo e($e['phone']); ?></td>
                                    <td><?php echo e($e->role['name']); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('admin.employee.update',[$e['id']])); ?>"
                                           class="btn btn-primary btn-sm">
                                           <?php echo e(\App\CPU\translate('Edit')); ?>

                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo e($em->links()); ?>

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
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/employee/list.blade.php ENDPATH**/ ?>