<?php $__env->startSection('title',\App\CPU\translate('My Order List')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        .widget-categories .accordion-heading > a:hover {
            color: #FFD5A4 !important;
        }

        .widget-categories .accordion-heading > a {
            color: #FFD5A4;
        }

        body {
            font-family: 'Titillium Web', sans-serif
        }

        .card {
            border: none
        }

        .totals tr td {
            font-size: 13px
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .spandHeadO {
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px;

        }

        .tdBorder {
            border- <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 1px solid #f7f0f0;
            text-align: center;
        }

        .bodytr {
            text-align: center;
            vertical-align: middle !important;
        }

        .sidebar h3:hover + .divider-role {
            border-bottom: 3px solid <?php echo e($web_config['primary_color']); ?>                                   !important;
            transition: .2s ease-in-out;
        }

        tr td {
            padding: 3px 5px !important;
        }

        td button {
            padding: 3px 13px !important;
        }

        @media (max-width: 600px) {
            .sidebar_heading {
                background: <?php echo e($web_config['primary_color']); ?>;
            }

            .orderDate {
                display: none;
            }

            .sidebar_heading h1 {
                text-align: center;
                color: aliceblue;
                padding-bottom: 17px;
                font-size: 19px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
                <h1 class="h3  mb-0 float-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> headerTitle"><?php echo e(\App\CPU\translate('my_order')); ?></h1>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl"
         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <!-- Sidebar-->
        <?php echo $__env->make('web-views.partials._profile-aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Content  -->
            <section class="col-lg-9 mt-2 col-md-9">
                <div class="card box-shadow-sm">
                    <div style="overflow: auto">
                        <table class="table">
                            <thead>
                            <tr style="background-color: #6b6b6b;">
                                <td class="tdBorder">
                                    <div class="py-2"><span
                                            class="d-block spandHeadO "><?php echo e(\App\CPU\translate('Order#')); ?></span></div>
                                </td>

                                <td class="tdBorder orderDate">
                                    <div class="py-2"><span
                                            class="d-block spandHeadO"><?php echo e(\App\CPU\translate('Order')); ?> <?php echo e(\App\CPU\translate('Date')); ?></span>
                                    </div>
                                </td>
                                <td class="tdBorder">
                                    <div class="py-2"><span
                                            class="d-block spandHeadO"> <?php echo e(\App\CPU\translate('Status')); ?></span></div>
                                </td>
                                <td class="tdBorder">
                                    <div class="py-2"><span
                                            class="d-block spandHeadO"> <?php echo e(\App\CPU\translate('Total')); ?></span></div>
                                </td>
                                <td class="tdBorder">
                                    <div class="py-2"><span
                                            class="d-block spandHeadO"> <?php echo e(\App\CPU\translate('action')); ?></span></div>
                                </td>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="bodytr font-weight-bold">
                                        <?php echo e(\App\CPU\translate('ID')); ?>: <?php echo e($order['id']); ?>

                                    </td>
                                    <td class="bodytr orderDate"><span class=""><?php echo e($order['created_at']); ?></span></td>
                                    <td class="bodytr">
                                        <?php if($order['order_status']=='failed' || $order['order_status']=='canceled'): ?>
                                            <span class="badge badge-danger text-capitalize">
                                                <?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                            </span>
                                        <?php elseif($order['order_status']=='confirmed' || $order['order_status']=='processing' || $order['order_status']=='delivered'): ?>
                                            <span class="badge badge-success text-capitalize">
                                                <?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-info text-capitalize">
                                                <?php echo e(\App\CPU\translate($order['order_status'])); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="bodytr">
                                        <?php echo e(\App\CPU\Helpers::currency_converter($order['order_amount'])); ?>

                                    </td>
                                    <td class="bodytr" style="width: 162px">
                                        <a href="<?php echo e(route('account-order-details', ['id'=>$order->id])); ?>"
                                           class="btn btn-secondary p-2">
                                            <i class="fa fa-eye"></i> <?php echo e(\App\CPU\translate('view')); ?>

                                        </a>
                                        <?php if($order['payment_method']=='cash_on_delivery' && $order['order_status']=='pending'): ?>
                                            <a href="javascript:"
                                               onclick="route_alert('<?php echo e(route('order-cancel',[$order->id])); ?>','<?php echo e(\App\CPU\translate('want_to_cancel_this_order?')); ?>')"
                                               class="btn btn-danger p-2 top-margin">
                                                <i class="fa fa-trash"></i> <?php echo e(\App\CPU\translate('cancel')); ?>

                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-danger p-2 top-margin" onclick="cancel_message()">
                                                <i class="fa fa-trash"></i> <?php echo e(\App\CPU\translate('cancel')); ?>

                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if($orders->count()==0): ?>
                            <center class="mt-3 mb-2"><?php echo e(\App\CPU\translate('no_order_found')); ?></center>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function cancel_message() {
            toastr.info('<?php echo e(\App\CPU\translate('order_can_be_canceled_only_when_pending.')); ?>', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/users-profile/account-orders.blade.php ENDPATH**/ ?>