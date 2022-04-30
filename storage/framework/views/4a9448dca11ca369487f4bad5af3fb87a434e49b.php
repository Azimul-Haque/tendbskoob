<?php $__env->startSection('title', \App\CPU\translate('Order List')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mb-1">
            <div class="flex-between align-items-center">
                <div>
                    <h1 class="page-header-title"><?php echo e(\App\CPU\translate('Orders')); ?> <span
                            class="badge badge-soft-dark mx-2"><?php echo e($orders->total()); ?></span></h1>
                </div>
                <div>
                    <i class="tio-shopping-cart" style="font-size: 30px"></i>
                </div>
            </div>
            <!-- End Row -->

            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-left"></i>
              </a>
            </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
              <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                <i class="tio-chevron-right"></i>
              </a>
            </span>

                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><?php echo e(\App\CPU\translate('order_list')); ?></a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="flex-between justify-content-between align-items-center flex-grow-1">
                    <div>
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                       placeholder="<?php echo e(\App\CPU\translate('Search orders')); ?>" aria-label="Search orders" value="<?php echo e($search); ?>"
                                       required>
                                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    <div>
                        <label> <?php echo e(\App\CPU\translate('inhouse_orders_only')); ?> : </label>
                        <label class="switch ml-3">
                            <input type="checkbox" class="status"
                                   onclick="filter_order()" <?php echo e(session()->has('show_inhouse_orders') && session('show_inhouse_orders')==1?'checked':''); ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       style="width: 100%; text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">
                    <thead class="thead-light">
                    <tr>
                        <th class="">
                            <?php echo e(\App\CPU\translate('SL')); ?>#
                        </th>
                        <th class=" "><?php echo e(\App\CPU\translate('Order')); ?></th>
                        <th><?php echo e(\App\CPU\translate('Date')); ?></th>
                        <th><?php echo e(\App\CPU\translate('customer_name')); ?></th>
                        <th><?php echo e(\App\CPU\translate('Status')); ?></th>
                        <th><?php echo e(\App\CPU\translate('Total')); ?></th>
                        <th><?php echo e(\App\CPU\translate('Order')); ?> <?php echo e(\App\CPU\translate('Status')); ?> </th>
                        <th><?php echo e(\App\CPU\translate('Action')); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                            <td class="">
                                <?php echo e($orders->firstItem()+$key); ?>

                            </td>
                            <td class="table-column-pl-0">
                                <a href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                            </td>
                            <td><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></td>
                            <td>
                                <?php if($order->customer): ?>
                                    <a class="text-body text-capitalize"
                                       href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?></a>
                                <?php else: ?>
                                    <label class="badge badge-danger"><?php echo e(\App\CPU\translate('invalid_customer_data')); ?></label>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($order->payment_status=='paid'): ?>
                                    <span class="badge badge-soft-success">
                                      <span class="legend-indicator bg-success"
                                            style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate('paid')); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger">
                                      <span class="legend-indicator bg-danger"
                                            style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate('unpaid')); ?>

                                    </span>
                                <?php endif; ?>
                            </td>
                            <td> <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->order_amount))); ?></td>
                            <td class="text-capitalize">
                                <?php if($order['order_status']=='pending'): ?>
                                    <span class="badge badge-soft-info ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-info"
                                              style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                      </span>

                                <?php elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery'): ?>
                                    <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-warning"
                                              style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                      </span>
                                <?php elseif($order['order_status']=='confirmed'): ?>
                                    <span class="badge badge-soft-success ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-success"
                                              style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                      </span>
                                <?php elseif($order['order_status']=='failed'): ?>
                                    <span class="badge badge-danger ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-warning"
                                              style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                      </span>
                                <?php elseif($order['order_status']=='delivered'): ?>
                                    <span class="badge badge-soft-success ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-success"
                                              style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                      </span>
                                <?php else: ?>
                                    <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                        <span class="legend-indicator bg-danger"
                                              style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>"></span><?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                      </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="tio-settings"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                           href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><i
                                                class="tio-visible"></i> <?php echo e(\App\CPU\translate('view')); ?></a>
                                        <a class="dropdown-item" target="_blank"
                                           href="<?php echo e(route('admin.orders.generate-invoice',[$order['id']])); ?>"><i
                                                class="tio-download"></i> <?php echo e(\App\CPU\translate('invoice')); ?></a>
                                        <a class="dropdown-item" class="tio-delete" href="javascript:"
                                        onclick="form_alert('order-<?php echo e($order['id']); ?>','Want to delete this item ?')"><i
                                        class="tio-delete"></i>
                                            <?php echo e(\App\CPU\translate('Delete')); ?>

                                        </a>
                                        <form action="<?php echo e(route('admin.orders.delete',[$order['id']])); ?>"
                                            method="post" id="order-<?php echo e($order['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
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
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        function filter_order() {
            $.get({
                url: '<?php echo e(route('admin.orders.inhouse-order-filter')); ?>',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    toastr.success('<?php echo e(\App\CPU\translate('order_filter_success')); ?>');
                    location.reload();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        };
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/order/list.blade.php ENDPATH**/ ?>