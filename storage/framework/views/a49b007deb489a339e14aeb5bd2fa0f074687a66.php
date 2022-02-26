<?php $__env->startSection('title', \App\CPU\translate('Order List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Heading -->
<div class="content container-fluid">
    <div class="row align-items-center mb-3">
        <div class="col-sm">
            <h1 class="page-header-title"><?php echo e(\App\CPU\translate('Orders')); ?> <span
                    class="badge badge-soft-dark ml-2"><?php echo e($orders->total()); ?></span>
            </h1>

        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-black-50"><?php echo e(\App\CPU\translate('Seller')); ?> : <?php echo e($seller['f_name'].' '.$seller['l_name']); ?> , <?php echo e(\App\CPU\translate('ID')); ?> : <?php echo e($seller['id']); ?></h1>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(\App\CPU\translate('Order Table')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered"  width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(\App\CPU\translate('SL#')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Order')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('customer_name')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Phone')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Status')); ?> </th>
                                    <th><?php echo e(\App\CPU\translate('Payment')); ?></th>

                                    <th style="width: 30px"><?php echo e(\App\CPU\translate('Action')); ?></th>
                                </tr>
                                </thead>
                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($orders->firstItem()+$k); ?></th>
                                    <td>
                                        <a href="<?php echo e(route('admin.sellers.order-details',[$order['id'],$seller['id']])); ?>"><?php echo e($order['id']); ?></a>
                                    </td>
                                    <td>
                                        <?php if($order->customer != null): ?>
                                            <?php echo e($order->customer['f_name']); ?> <?php echo e($order->customer['l_name']); ?>

                                        <?php else: ?>
                                            <label class='badge badge-warning'><?php echo e(\App\CPU\translate('Customer not available')); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($order->customer != null): ?>
                                            <?php echo e($order->customer['phone']); ?>

                                        <?php else: ?>
                                            <label class="badge badge-warning"><?php echo e(\App\CPU\translate('Customer not available')); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-capitalize ">
                                        <?php if($order->order_status=='pending'): ?>
                                            <label class="badge badge-primary"><?php echo e(str_replace('_',' ',$order->order_status)); ?></label>
                                        <?php elseif($order->order_status=='processing' || $order->order_status=='out_for_delivery'): ?>
                                            <label class="badge badge-warning"><?php echo e(str_replace('_',' ',$order->order_status)); ?></label>
                                        <?php elseif($order->order_status=='processed'): ?>
                                            <label class="badge badge-warning"><?php echo e(str_replace('_',' ',$order->order_status)); ?></label>
                                        <?php elseif($order->order_status=='delivered' || $order->order_status=='confirmed'): ?>
                                            <label class="badge badge-success"><?php echo e(str_replace('_',' ',$order->order_status)); ?></label>
                                        <?php elseif($order->order_status=='returned'): ?>
                                            <label class="badge badge-warning"><?php echo e(str_replace('_',' ',$order->order_status)); ?></label>
                                        <?php elseif($order->order_status=='failed' || $order->order_status=='canceled'): ?>
                                            <label class="badge badge-danger"><?php echo e(str_replace('_',' ',$order->order_status)); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($order->payment_status=='paid'): ?>
                                            <span class="badge badge-soft-success">
                                  <span class="legend-indicator bg-success"></span><?php echo e(\App\CPU\translate('Paid')); ?>

                                </span>
                                        <?php else: ?>
                                            <span class="badge badge-soft-danger">
                                  <span class="legend-indicator bg-danger"></span><?php echo e(\App\CPU\translate('Unpaid')); ?>

                                </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="<?php echo e(route('admin.sellers.order-details',[$order['id'],$seller['id']])); ?>"><i
                                                        class="tio-visible"></i> <?php echo e(\App\CPU\translate('View')); ?></a>
                                                <a class="dropdown-item" target="_blank"
                                                   href="<?php echo e(route('admin.orders.generate-invoice',[$order->id])); ?>"><i
                                                        class="tio-download"></i> <?php echo e(\App\CPU\translate('Invoice')); ?></a>
                                            </div>
                                        </div>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- Pagination -->
                    <div class="row justify-content-center justify-content-sm-between align-items-sm-center">


                        <div class="col-sm-auto">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <!-- Pagination -->
                                <?php echo $orders->links(); ?>

                                
                            </div>
                        </div>
                    </div>
                    <!-- End Pagination -->
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/seller/order-list.blade.php ENDPATH**/ ?>