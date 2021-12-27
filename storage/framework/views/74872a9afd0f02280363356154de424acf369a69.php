<?php $__env->startSection('title',\App\CPU\translate('Order Complete')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        @import  url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        body {
            font-family: 'Montserrat', sans-serif
        }

        .card {
            border: none
        }

        .totals tr td {
            font-size: 13px
        }

        .footer span {
            font-size: 12px
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .spanTr {
            color: <?php echo e($web_config['primary_color']); ?>;
            font-weight: 700;

        }

        .spandHeadO {
            color: #030303;
            font-weight: 500;
            font-size: 20px;

        }

        .font-name {
            font-weight: 600;
            font-size: 13px;
        }

        .amount {
            font-size: 17px;
            color: <?php echo e($web_config['primary_color']); ?>;
        }

        @media (max-width: 600px) {
            .orderId {
                margin- <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 91px;
            }

            .p-5 {
                padding: 2% !important;
            }

            .spanTr {

                font-weight: 400 !important;
                font-size: 12px;
            }

            .spandHeadO {

                font-weight: 300;
                font-size: 12px;

            }

            .table th, .table td {
                padding: 5px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-5 mb-5 rtl"
         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-lg-10">
                <div class="card">
                    <?php if(auth('customer')->check()): ?>
                        <div class=" p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 style="font-size: 20px; font-weight: 900"><?php echo e(\App\CPU\translate('your_order_has_been_placed_successfully!')); ?>

                                        !</h5>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <center>
                                        <i style="font-size: 100px; color: #0f9d58" class="fa fa-check-circle"></i>
                                    </center>
                                </div>
                            </div>

                            <span class="font-weight-bold d-block mt-4" style="font-size: 17px;"><?php echo e(\App\CPU\translate('Hello')); ?>, <?php echo e(auth('customer')->user()->f_name); ?></span>
                            <span><?php echo e(\App\CPU\translate('You order has been confirmed and will be shipped according to the method you selected!')); ?></span>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                                        <?php echo e(\App\CPU\translate('go_to_shopping')); ?>

                                    </a>
                                </div>

                                <div class="col-6">
                                    <a href="<?php echo e(route('account-oder')); ?>"
                                       class="btn btn-secondary pull-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>">
                                        <?php echo e(\App\CPU\translate('check_orders')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/checkout-complete.blade.php ENDPATH**/ ?>