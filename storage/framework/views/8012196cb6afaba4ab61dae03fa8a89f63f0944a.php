<?php $__env->startSection('title', \App\CPU\translate('Customer Details')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-print-none pb-2">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item">
                                <a class="breadcrumb-link"
                                   href="<?php echo e(route('admin.customer.list')); ?>">
                                    <?php echo e(\App\CPU\translate('Customers')); ?>

                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e(\App\CPU\translate('Customer details')); ?></li>
                        </ol>
                    </nav>

                    <div class="d-sm-flex align-items-sm-center">
                        <h1 class="page-header-title"><?php echo e(\App\CPU\translate('Customer ID')); ?> #<?php echo e($customer['id']); ?></h1>
                        <span class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-2 mr-sm-3' : 'ml-2 ml-sm-3'); ?>">
                        <i class="tio-date-range">
                        </i> <?php echo e(\App\CPU\translate('Joined At')); ?> : <?php echo e(date('d M Y H:i:s',strtotime($customer['created_at']))); ?>

                        </span>
                    </div>
                    <div class="row border-top pt-3">
                        <div class="col-12">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-primary">
                                <i class="tio-home-outlined"></i> <?php echo e(\App\CPU\translate('Dashboard')); ?>

                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- End Page Header -->

        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-title"></h5>
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
                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(\App\CPU\translate('sl')); ?>#</th>
                                <th style="width: 50%" class="text-center"><?php echo e(\App\CPU\translate('Order ID')); ?></th>
                                <th style="width: 50%"><?php echo e(\App\CPU\translate('Total')); ?></th>
                                <th style="width: 10%"><?php echo e(\App\CPU\translate('Action')); ?></th>
                            </tr>

                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($orders->firstItem()+$key); ?></td>
                                    <td class="table-column-pl-0 text-center">
                                        <a href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                    </td>
                                    <td> <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount']))); ?></td>

                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="<?php echo e(route('admin.orders.details',['id'=>$order['id']])); ?>"><i
                                                        class="tio-visible"></i> <?php echo e(\App\CPU\translate('View')); ?></a>
                                                <a class="dropdown-item" target="_blank"
                                                   href="<?php echo e(route('admin.orders.generate-invoice',[$order['id']])); ?>"><i
                                                        class="tio-download"></i> <?php echo e(\App\CPU\translate('Invoice')); ?></a>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($orders)==0): ?>
                            <div class="text-center p-4">
                                <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                                <p class="mb-0"><?php echo e(\App\CPU\translate('No_data_to_show')); ?></p>
                            </div>
                        <?php endif; ?>
                        <!-- Footer -->
                        <div class="card-footer">
                            <!-- Pagination -->
                        <?php echo $orders->links(); ?>

                        <!-- End Pagination -->
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title"><?php echo e(\App\CPU\translate('Customer')); ?></h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->


                    <?php if($customer): ?>

                        <div class="card-body">
                            <div class="media align-items-center" href="javascript:">
                                <div class="avatar avatar-circle <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>">
                                    <img
                                        class="avatar-img"
                                        onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                        src="<?php echo e(asset('storage/app/public/profile/'.$customer->image)); ?>"
                                        alt="Image Description">
                                </div>
                                <div class="media-body">
                                <span
                                    class="text-body text-hover-primary"><?php echo e($customer['f_name'].' '.$customer['l_name']); ?></span>
                                </div>
                                <div class="media-body text-right">
                                    
                                </div>
                            </div>

                            <hr>

                            <div class="media align-items-center" href="javascript:">
                                <div class="icon icon-soft-info icon-circle <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>">
                                    <i class="tio-shopping-basket-outlined"></i>
                                </div>
                                <div class="media-body">
                                    <span class="text-body text-hover-primary"> <?php echo e(\App\Model\Order::where('customer_id',$customer['id'])->count()); ?> <?php echo e(\App\CPU\translate('orders')); ?></span>
                                </div>
                                <div class="media-body text-right">
                                    
                                </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <h5><?php echo e(\App\CPU\translate('Contact info')); ?></h5>
                            </div>

                            <ul class="list-unstyled list-unstyled-py-2">
                                <li>
                                    <i class="tio-online <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"></i>
                                    <?php echo e($customer['email']); ?>

                                </li>
                                <li>
                                    <i class="tio-android-phone-vs <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"></i>
                                    <?php echo e($customer['phone']); ?>

                                </li>
                            </ul>

                            <hr>


                            

                        </div>
                <?php endif; ?>

                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/customer/customer-view.blade.php ENDPATH**/ ?>