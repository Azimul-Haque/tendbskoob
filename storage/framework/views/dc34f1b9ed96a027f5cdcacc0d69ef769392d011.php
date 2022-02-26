<?php $__env->startSection('title',$seller->shop ? $seller->shop->name : \App\CPU\translate("shop name not found")); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #377dff;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #377dff;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #banner-image-modal .modal-content {
            width: 1116px !important;
            margin-left: -264px !important;
        }

        @media (max-width: 768px) {
            #banner-image-modal .modal-content {
                width: 698px !important;
                margin-left: -75px !important;
            }


        }

        @media (max-width: 375px) {
            #banner-image-modal .modal-content {
                width: 367px !important;
                margin-left: 0 !important;
            }

        }

        @media (max-width: 500px) {
            #banner-image-modal .modal-content {
                width: 400px !important;
                margin-left: 0 !important;
            }


        }


    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="<?php echo e(route('admin.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Seller_Details')); ?></li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="<?php echo e(route('admin.sellers.seller-list')); ?>" class="btn btn-primary mt-3 mb-3"><?php echo e(\App\CPU\translate('Back_to_seller_list')); ?></a>
            </div>
            <div>
                <?php if($seller->status=="pending"): ?>
                    <div class="mt-4 pr-2 float-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>">
                        <div class="flex-start">
                            <div class="mx-1"><h4><i class="tio-shop-outlined"></i></h4></div>
                            <div><?php echo e(\App\CPU\translate('Seller_request_for_open_a_shop.')); ?></div>
                        </div>
                        <div class="text-center">
                            <form class="d-inline-block" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Approve')); ?></button>
                            </form>
                            <form class="d-inline-block" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger"><?php echo e(\App\CPU\translate('reject')); ?></button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Page Header -->
        <div class="page-header">
            <div class="flex-between row mx-1">
                <div>
                    <h1 class="page-header-title"><?php echo e($seller->shop ? $seller->shop->name : "Shop Name : Update Please"); ?></h1>
                </div>
            </div>
            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo e(route('admin.sellers.view',$seller->id)); ?>"><?php echo e(\App\CPU\translate('Shop')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'order'])); ?>"><?php echo e(\App\CPU\translate('Order')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'product'])); ?>"><?php echo e(\App\CPU\translate('Product')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'setting'])); ?>"><?php echo e(\App\CPU\translate('Setting')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'transaction'])); ?>"><?php echo e(\App\CPU\translate('Transaction')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'review'])); ?>"><?php echo e(\App\CPU\translate('Review')); ?></a>
                    </li>

                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->

        <!-- Page Heading -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="order">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card w-100">
                            <div class="card-header">
                                <?php echo e(\App\CPU\translate('Order')); ?> <?php echo e(\App\CPU\translate('info')); ?>

                            </div>
                            <!-- Card -->
                            <div class="card-body mb-3 mb-lg-5">
                                <div class="row gx-lg-4">
                                    <div class="col-sm-6 col-lg-4">
                                        <div class="flex-between align-items-center" style="cursor: pointer">
                                            <div class="media-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                                <h6 class="card-subtitle"><?php echo e(\App\CPU\translate('pending')); ?></h6>
                                                <span class="card-title h3">
                                                <?php echo e($orders->where('order_status','pending')->count()); ?></span>
                                            </div>
                                            <div class="icon icon-sm icon-soft-secondary icon-circle ml-3">
                                                <i class="tio-airdrop"></i>
                                            </div>
                                        </div>
                                        <div class="d-lg-none">
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 column-divider-sm">
                                        <div class="flex-between align-items-center" style="cursor: pointer">
                                            <div class="media-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                                <h6 class="card-subtitle"><?php echo e(\App\CPU\translate('delivered')); ?></h6>
                                                <span class="card-title h3">
                                                    <?php echo e($orders->where('order_status','delivered')->count()); ?></span>
                                            </div>
                                            <div class="icon icon-sm icon-soft-secondary icon-circle ml-3">
                                                <i class="tio-checkmark-circle"></i>
                                            </div>
                                        </div>
                                        <div class="d-lg-none">
                                            <hr>
                                        </div>
                                    </div>

                                    

                                    <div class="col-sm-6 col-lg-4 column-divider-sm">
                                        <div class="flex-between align-items-center" style="cursor: pointer">
                                            <div class="media-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                                <h6 class="card-subtitle"><?php echo e(\App\CPU\translate('All')); ?></h6>
                                                <span class="card-title h3"><?php echo e($orders->count()); ?></span>
                                            </div>
                                            <div class="icon icon-sm icon-soft-secondary icon-circle ml-3">
                                                <i class="tio-table"></i>
                                            </div>
                                        </div>
                                        <div class="d-lg-none">
                                            <hr>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Table -->
                            <div class="table-responsive datatable-custom">
                                <table id="datatable"
                                       style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                       class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                       style="width: 100%"
                                       data-hs-datatables-options='{
                                "columnDefs": [{
                                    "targets": [0],
                                    "orderable": false
                                }],
                                "order": [],
                                "info": {
                                "totalQty": "#datatableWithPaginationInfoTotalQty"
                                },
                                "search": "#datatableSearch",
                                "entries": "#datatableEntries",
                                "pageLength": 25,
                                "isResponsive": false,
                                "isShowPaging": false,
                                "pagination": "datatablePagination"
                            }'>
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="">
                                            <?php echo e(\App\CPU\translate('#SL')); ?>

                                        </th>
                                        <th class="table-column-pl-0"><?php echo e(\App\CPU\translate('Order')); ?></th>
                                        <th><?php echo e(\App\CPU\translate('Date')); ?></th>
                                        <th><?php echo e(\App\CPU\translate('Customer')); ?></th>
                                        <th><?php echo e(\App\CPU\translate('Payment')); ?> <?php echo e(\App\CPU\translate('status')); ?></th>
                                        <th><?php echo e(\App\CPU\translate('total')); ?></th>
                                        <th><?php echo e(\App\CPU\translate('Order')); ?> <?php echo e(\App\CPU\translate('status')); ?></th>
                                        <th><?php echo e(\App\CPU\translate('action')); ?></th>
                                    </tr>
                                    </thead>

                                    <tbody id="set-rows">

                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="status class-all">
                                            <td class="">
                                                <?php echo e($orders->firstItem()+$key); ?>

                                            </td>
                                            <td class="table-column-pl-0">
                                                <a href="<?php echo e(route('admin.sellers.order-details',['order_id'=>$order['id'],'seller_id'=>$order->sellerName['seller_id']])); ?>"><?php echo e($order['id']); ?></a>
                                            </td>
                                            <td><?php echo e(date('d M Y',strtotime($order['created_at']))); ?></td>
                                            <td>
                                                <?php if($order->customer): ?>
                                                    <a class="text-body text-capitalize"
                                                       href="<?php echo e(route('admin.customer.view',['user_id'=>$order->customer['id']])); ?>">
                                                        <?php echo e($order->customer['f_name'].' '.$order->customer['l_name']); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <label class="badge badge-danger"><?php echo e(\App\CPU\translate('Removed')); ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($order->payment_status=='paid'): ?>
                                                    <span class="badge badge-soft-success">
                                                    <span class="legend-indicator bg-success"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(\App\CPU\translate('paid')); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-soft-danger">
                                                <span class="legend-indicator bg-danger"
                                                      style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                </span><?php echo e(\App\CPU\translate('unpaid')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($order['order_amount']); ?></td>
                                            <td class="text-capitalize">
                                                <?php if($order['order_status']=='pending'): ?>
                                                    <span class="badge badge-soft-info ml-2 ml-sm-3">
                                                    <span class="legend-indicator bg-info"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(\App\CPU\translate('pending')); ?>

                                                    </span>
                                                    <?php elseif($order['order_status']=='confirmed'): ?>
                                                        <span class="badge badge-soft-info ml-2 ml-sm-3">
                                                    <span class="legend-indicator bg-info"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(\App\CPU\translate('confirmed')); ?>

                                                    </span>
                                                    <?php elseif($order['order_status']=='processing'): ?>
                                                        <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                                    <span class="legend-indicator bg-warning"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(\App\CPU\translate('processing')); ?>

                                                    </span>
                                                    <?php elseif($order['order_status']=='out_for_delivery'): ?>
                                                        <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                                    <span class="legend-indicator bg-warning"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(\App\CPU\translate('out_for_delivery')); ?>

                                                    </span>
                                                    <?php elseif($order['order_status']=='delivered'): ?>
                                                        <span class="badge badge-soft-success ml-2 ml-sm-3">
                                                    <span class="legend-indicator bg-success"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(\App\CPU\translate('delivered')); ?>

                                                    </span>
                                                    <?php else: ?>
                                                        <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                                    <span class="legend-indicator bg-danger"
                                                          style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 0;margin-left: .4375rem;' : 'margin-left: 0;margin-right: .4375rem;'); ?>">
                                                    </span><?php echo e(str_replace('_',' ',$order['order_status'])); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-white"
                                                   href="<?php echo e(route('admin.sellers.order-details',['order_id'=>$order['id'],'seller_id'=>$order['customer_id']])); ?>"><i
                                                        class="tio-visible"></i> <?php echo e(\App\CPU\translate('View')); ?></a>
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
                                <div
                                    class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                    <div class="col-sm-auto">
                                        <div class="d-flex justify-content-center justify-content-sm-end">
                                            <!-- Pagination -->
                                            <?php echo $orders->links(); ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Pagination -->
                            </div>
                            <?php if(count($orders)==0): ?>
                                <div class="text-center p-4">
                                    <img class="mb-3"
                                         src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg"
                                         alt="Image Description" style="width: 7rem;">
                                    <p class="mb-0"><?php echo e(\App\CPU\translate('No_data_to_show')); ?></p>
                                </div>
                        <?php endif; ?>
                        <!-- End Footer -->
                            <!-- End Card -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/seller/view/order.blade.php ENDPATH**/ ?>