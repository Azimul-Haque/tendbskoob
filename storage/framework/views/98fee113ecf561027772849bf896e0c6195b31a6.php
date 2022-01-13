<?php $__env->startSection('title', \App\CPU\translate('Register')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        @media (max-width: 500px) {
            #sign_in {
                margin-top: -23% !important;
            }

        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4 py-lg-5 my-4"
         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <h2 class="h4 mb-1"><?php echo e(\App\CPU\translate('no_account')); ?></h2>
                        <p class="font-size-sm text-muted mb-4"><?php echo e(\App\CPU\translate('register_control_your_order')); ?>

                            .</p>
                        <form class="needs-validation_" action="<?php echo e(route('customer.auth.register')); ?>"
                              method="post" id="sign-up-form">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-fn"><?php echo e(\App\CPU\translate('first_name')); ?></label>
                                        <input class="form-control" value="<?php echo e(old('f_name')); ?>" type="text" name="f_name"
                                               style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                               required>
                                        <div class="invalid-feedback"><?php echo e(\App\CPU\translate('Please enter your first name')); ?>!</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-ln"><?php echo e(\App\CPU\translate('last_name')); ?></label>
                                        <input class="form-control" type="text" value="<?php echo e(old('l_name')); ?>" name="l_name"
                                               style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                        <div class="invalid-feedback"><?php echo e(\App\CPU\translate('Please enter your last name')); ?>!</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-email"><?php echo e(\App\CPU\translate('email_address')); ?></label>
                                        <input class="form-control" type="email" value="<?php echo e(old('email')); ?>"  name="email"
                                               style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;" required>
                                        <div class="invalid-feedback"><?php echo e(\App\CPU\translate('Please enter valid email address')); ?>!</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-phone"><?php echo e(\App\CPU\translate('phone_number')); ?>

                                            <small class="text-primary">( * <?php echo e(\App\CPU\translate('country_code_is_must')); ?> <?php echo e(\App\CPU\translate('like_for_BD_880')); ?> )</small></label>
                                        <input class="form-control" type="number"  value="<?php echo e(old('phone')); ?>"  name="phone"
                                               style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                               required>
                                        <div class="invalid-feedback"><?php echo e(\App\CPU\translate('Please enter your phone number')); ?>!</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="si-password"><?php echo e(\App\CPU\translate('password')); ?></label>
                                        <div class="password-toggle">
                                            <input class="form-control" name="password" type="password" id="si-password"
                                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                                   placeholder="<?php echo e(\App\CPU\translate('minimum_8_characters_long')); ?>"
                                                   required>
                                            <label class="password-toggle-btn">
                                                <input class="custom-control-input" type="checkbox"><i
                                                    class="czi-eye password-toggle-indicator"></i><span
                                                    class="sr-only"><?php echo e(\App\CPU\translate('Show')); ?> <?php echo e(\App\CPU\translate('password')); ?> </span>
                                            </label>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="si-password"><?php echo e(\App\CPU\translate('confirm_password')); ?></label>
                                        <div class="password-toggle">
                                            <input class="form-control" name="con_password" type="password"
                                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                                   placeholder="<?php echo e(\App\CPU\translate('minimum_8_characters_long')); ?>"
                                                   id="si-password"
                                                   required>
                                            <label class="password-toggle-btn">
                                                <input class="custom-control-input" type="checkbox"
                                                       style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"><i
                                                    class="czi-eye password-toggle-indicator"></i><span
                                                    class="sr-only"><?php echo e(\App\CPU\translate('Show')); ?> <?php echo e(\App\CPU\translate('password')); ?> </span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between">

                                <div class="form-group mb-1">
                                    <strong>
                                        <input type="checkbox" class="mr-1"
                                               name="remember" id="inputCheckd">
                                    </strong>
                                    <label class="" for="remember"><?php echo e(\App\CPU\translate('i_agree_to_Your_terms')); ?><a
                                            class="font-size-sm" target="_blank" href="<?php echo e(route('terms')); ?>">
                                            <?php echo e(\App\CPU\translate('terms_and_condition')); ?>

                                        </a></label>
                                </div>

                            </div>
                            <div class="flex-between row" style="direction: <?php echo e(Session::get('direction')); ?>">
                                <div class="mx-1">
                                    <div class="text-right">
                                        <button class="btn btn-primary" id="sign-up" type="submit" disabled>
                                            <i class="czi-user <?php echo e(Session::get('direction') === "rtl" ? 'ml-2 mr-n1' : 'mr-2 ml-n1'); ?>"></i>
                                            <?php echo e(\App\CPU\translate('sing_up')); ?>

                                        </button>
                                    </div>
                                </div>
                                <div class="mx-1">
                                    <a class="btn btn-outline-primary" href="<?php echo e(route('customer.auth.login')); ?>">
                                        <i class="fa fa-sign-in"></i> <?php echo e(\App\CPU\translate('sing_in')); ?>

                                    </a>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <?php $__currentLoopData = \App\CPU\Helpers::get_business_settings('social_login'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialLoginService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($socialLoginService) && $socialLoginService['status']==true): ?>
                                                <div class="col-sm-6 text-center mt-1">
                                                    <a class="btn btn-outline-primary"
                                                       href="<?php echo e(route('customer.auth.service-login', $socialLoginService['login_medium'])); ?>"
                                                       style="width: 100%">
                                                        <i class="czi-<?php echo e($socialLoginService['login_medium']); ?> <?php echo e(Session::get('direction') === "rtl" ? 'ml-2 mr-n1' : 'mr-2 ml-n1'); ?>"></i>
                                                        <?php echo e(\App\CPU\translate('sing_up_with_'.$socialLoginService['login_medium'])); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        $('#inputCheckd').change(function () {
            // console.log('jell');
            if ($(this).is(':checked')) {
                $('#sign-up').removeAttr('disabled');
            } else {
                $('#sign-up').attr('disabled', 'disabled');
            }

        });
        /*$('#sign-up-form').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('customer.auth.register')); ?>',
                dataType: 'json',
                data: $('#sign-up-form').serialize(),
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
                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setInterval(function () {
                            location.href = data.url;
                        }, 2000);
                    }
                },
                complete: function () {
                    $('#loading').hide();
                },
                error: function () {
                  console.log(response)
                }
            });
        });*/
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/customer-view/auth/register.blade.php ENDPATH**/ ?>