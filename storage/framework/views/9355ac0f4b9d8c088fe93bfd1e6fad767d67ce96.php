<?php $__env->startSection('title',\App\CPU\translate('Shipping Address Choose')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        .btn-outline {
            border-color: <?php echo e($web_config['primary_color']); ?> ;
        }

        .btn-outline {
            color: #020512;
            border-color: <?php echo e($web_config['primary_color']); ?>   !important;
        }

        .btn-outline:hover {
            color: white;
            background: <?php echo e($web_config['primary_color']); ?>;

        }

        .btn-outline:focus {
            border-color: <?php echo e($web_config['primary_color']); ?>   !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container pb-5 mb-2 mb-md-4 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <div class="col-md-12 mb-5 pt-5">
                <div class="feature_header" style="background: #dcdcdc;line-height: 1px">
                    <span><?php echo e(\App\CPU\translate('shipping_address')); ?></span>
                </div>
            </div>
            <section class="col-lg-8">
                <hr>
                <div class="checkout_details mt-3">
                    <!-- Steps-->
                <?php echo $__env->make('web-views.partials._checkout-steps',['step'=>2], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- Shipping methods table-->
                    <h2 class="h4 pb-3 mb-2 mt-5"><?php echo e(\App\CPU\translate('shipping_address')); ?> <?php echo e(\App\CPU\translate('choose_shipping_address')); ?></h2>
                    <?php ($shipping_addresses=\App\Model\ShippingAddress::where('customer_id',auth('customer')->id())->get()); ?>
                    <form method="post" action="" id="address-form">
                        <?php echo csrf_field(); ?>
                        <div class="card-body" style="padding: 0!important;">
                            <ul class="list-group">
                                <?php $__currentLoopData = $shipping_addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item mb-2 mt-2"
                                        style="cursor: pointer;background: rgba(245,245,245,0.51)"
                                        onclick="$('#sh-<?php echo e($address['id']); ?>').prop( 'checked', true )">
                                        <input type="radio" name="shipping_method_id"
                                               id="sh-<?php echo e($address['id']); ?>"
                                               value="<?php echo e($address['id']); ?>" <?php echo e($key==0?'checked':''); ?>>
                                        <span class="checkmark" style="margin-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 10px"></span>
                                        <label class="badge"
                                               style="background: <?php echo e($web_config['primary_color']); ?>; color:white !important;"><?php echo e($address['address_type']); ?></label>
                                        <small>
                                            <i class="fa fa-phone"></i> <?php echo e($address['phone']); ?>

                                        </small>
                                        <hr>
                                        <span><?php echo e(\App\CPU\translate('contact_person_name')); ?>: <?php echo e($address['contact_person_name']); ?></span><br>
                                        <span><?php echo e(\App\CPU\translate('address')); ?> : <?php echo e($address['address']); ?>, <?php echo e($address['city']); ?>, <?php echo e($address['zip']); ?>, <?php echo e($address['country']); ?>.</span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item mb-2 mt-2" onclick="anotherAddress()">
                                    <input type="radio" name="shipping_method_id"
                                           id="sh-0" value="0" data-toggle="collapse"
                                           data-target="#collapseThree" <?php echo e($shipping_addresses->count()==0?'checked':''); ?>>
                                    <span class="checkmark" style="margin-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 10px"></span>
                                    <label class="badge"
                                           style="background: <?php echo e($web_config['primary_color']); ?>; color:white !important;">
                                        <i class="fa fa-plus-circle"></i></label>
                                    <button type="button" class="btn btn-outline" data-toggle="collapse"
                                            data-target="#collapseThree"><?php echo e(\App\CPU\translate('Another')); ?> <?php echo e(\App\CPU\translate('address')); ?>

                                    </button>
                                    <div id="accordion">
                                        <div id="collapseThree"
                                             class="collapse <?php echo e($shipping_addresses->count()==0?'show':''); ?>"
                                             aria-labelledby="headingThree"
                                             data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1"><?php echo e(\App\CPU\translate('contact_person_name')); ?>

                                                        <span style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="contact_person_name" <?php echo e($shipping_addresses->count()==0?'required':''); ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo e(\App\CPU\translate('Phone')); ?><span
                                                            style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="phone" <?php echo e($shipping_addresses->count()==0?'required':''); ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputPassword1"><?php echo e(\App\CPU\translate('address')); ?> <?php echo e(\App\CPU\translate('Type')); ?></label>
                                                    <select class="form-control" name="address_type">
                                                        <option
                                                            value="permanent"><?php echo e(\App\CPU\translate('Permanent')); ?></option>
                                                        <option value="home"><?php echo e(\App\CPU\translate('Home')); ?></option>
                                                        <option value="others"><?php echo e(\App\CPU\translate('Others')); ?></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label><?php echo e(\App\CPU\translate('Country')); ?> <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="country" <?php echo e($shipping_addresses->count()==0?'required':''); ?>>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"><?php echo e(\App\CPU\translate('City')); ?> <span
                                                            style="color: red">*</span></label>
                                                    <input type="text" class="form-control"
                                                           name="city" <?php echo e($shipping_addresses->count()==0?'required':''); ?>>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1"><?php echo e(\App\CPU\translate('zip_code')); ?> <span
                                                            style="color: red">*</span></label>
                                                    <input type="number" class="form-control"
                                                           name="zip" <?php echo e($shipping_addresses->count()==0?'required':''); ?>>
                                                </div>

                                                <div class="form-group">
                                                    <label
                                                        for="exampleInputEmail1"><?php echo e(\App\CPU\translate('address')); ?> <span
                                                            style="color: red">*</span></label>
                                                    <textarea class="form-control"
                                                              name="address" <?php echo e($shipping_addresses->count()==0?'required':''); ?>></textarea>
                                                </div>
                                                <div class="form-check" style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 1.25rem;">
                                                    <input type="checkbox" name="save_address" class="form-check-input"
                                                           id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1" style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 1.09rem">
                                                        <?php echo e(\App\CPU\translate('save_this_address')); ?>

                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary" style="display: none"
                                                        id="address_submit"></button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <!-- Navigation (desktop)-->
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-secondary btn-block" href="<?php echo e(route('shop-cart')); ?>">
                                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> mt-sm-0 mx-1"></i>
                                <span class="d-none d-sm-inline"><?php echo e(\App\CPU\translate('shop_cart')); ?></span>
                                <span class="d-inline d-sm-none"><?php echo e(\App\CPU\translate('shop_cart')); ?></span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-primary btn-block" href="javascript:" onclick="proceed_to_next()">
                                <span class="d-none d-sm-inline"><?php echo e(\App\CPU\translate('proceed_payment')); ?></span>
                                <span class="d-inline d-sm-none"><?php echo e(\App\CPU\translate('Next')); ?></span>
                                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?> mt-sm-0 mx-1"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Sidebar-->
                </div>
            </section>
            <?php echo $__env->make('web-views.partials._order-summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

    <script>
        function anotherAddress() {
            $('#sh-0').prop('checked', true);
            $("#collapseThree").collapse();
        }
    </script>

    <script>
        function proceed_to_next() {

            let allAreFilled = true;
            document.getElementById("address-form").querySelectorAll("[required]").forEach(function (i) {
                if (!allAreFilled) return;
                if (!i.value) allAreFilled = false;
                if (i.type === "radio") {
                    let radioValueCheck = false;
                    document.getElementById("address-form").querySelectorAll(`[name=${i.name}]`).forEach(function (r) {
                        if (r.checked) radioValueCheck = true;
                    });
                    allAreFilled = radioValueCheck;
                }
            });


            if (allAreFilled) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '<?php echo e(route('customer.choose-shipping-address')); ?>',
                    dataType: 'json',
                    data: $('#address-form').serialize(),
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            location.href = '<?php echo e(route('checkout-payment')); ?>';
                        }
                    },
                    complete: function () {
                        $('#loading').hide();
                    },
                    error: function () {
                        toastr.error('<?php echo e(\App\CPU\translate('Something went wrong!')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            } else {
                toastr.error('<?php echo e(\App\CPU\translate('Please fill all required fields')); ?>', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/checkout-shipping.blade.php ENDPATH**/ ?>