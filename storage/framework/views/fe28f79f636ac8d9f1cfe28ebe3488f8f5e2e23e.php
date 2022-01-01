<?php $__env->startSection('title', \App\CPU\translate('Payment Method')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('payment_method')); ?></li>
            </ol>
        </nav>

        <div class="row" style="padding-bottom: 20px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('system_default')); ?> <?php echo e(\App\CPU\translate('payment_method')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('cash_on_delivery')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method.update',['cash_on_delivery'])); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('cash_on_delivery')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('digital_payment')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('digital_payment')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method.update',['digital_payment'])); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('digital_payment')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('SSLCOMMERZ')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('ssl_commerz_payment')); ?>
                        <form
                            action="<?php echo e(route('admin.business-settings.payment-method.update',['ssl_commerz_payment'])); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('ssl_commerz_payment')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('Store')); ?> <?php echo e(\App\CPU\translate('ID')); ?> </label><br>
                                    <input type="text" class="form-control" name="store_id"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['store_id']); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('Store')); ?> <?php echo e(\App\CPU\translate('password')); ?></label><br>
                                    <input type="text" class="form-control" name="store_password"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['store_password']); ?>">
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('Paypal')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('paypal')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method.update',['paypal'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label
                                        class="control-label"><?php echo e(\App\CPU\translate('Paypal')); ?> <?php echo e(\App\CPU\translate('Payment')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('Paypal')); ?> <?php echo e(\App\CPU\translate('Client')); ?><?php echo e(\App\CPU\translate('ID')); ?>  </label><br>
                                    <input type="text" class="form-control" name="paypal_client_id"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['paypal_client_id']); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('Paypal')); ?> <?php echo e(\App\CPU\translate('Secret')); ?> </label><br>
                                    <input type="text" class="form-control" name="paypal_secret"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['paypal_secret']); ?>">
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('Stripe')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('stripe')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method.update',['stripe'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('stripe')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?> </label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('Published')); ?><?php echo e(\App\CPU\translate('Key')); ?>  </label><br>
                                    <input type="text" class="form-control" name="published_key"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['published_key']); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('api_key')); ?></label><br>
                                    <input type="text" class="form-control" name="api_key"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['api_key']); ?>">
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('razor_pay')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('razor_pay')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method.update',['razor_pay'])); ?>"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('razor_pay')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?> </label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Key')); ?>  </label><br>
                                    <input type="text" class="form-control" name="razor_key"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['razor_key']); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('secret')); ?></label><br>
                                    <input type="text" class="form-control" name="razor_secret"
                                           value="<?php echo e(env('APP_MODE')=='demo'?'':$config['razor_secret']); ?>">
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('Configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('senang_pay')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('senang_pay')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['senang_pay']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('senang_pay')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?> </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Callback_URI')); ?></label>
                                    <span class="btn btn-secondary btn-sm m-2"
                                          onclick="copyToClipboard('#id_senang_pay')"><i class="tio-copy"></i> <?php echo e(\App\CPU\translate('Copy URI')); ?></span>
                                    <br>
                                    <p class="form-control" id="id_senang_pay"><?php echo e(url('/')); ?>/return-senang-pay</p>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('secret')); ?> <?php echo e(\App\CPU\translate('key')); ?></label><br>
                                    <input type="text" class="form-control" name="secret_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['secret_key']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('Merchant')); ?> <?php echo e(\App\CPU\translate('ID')); ?></label><br>
                                    <input type="text" class="form-control" name="merchant_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['merchant_id']:''); ?>">
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6" style="margin-top: 26px!important;">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('paystack')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('paystack')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['paystack']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('paystack')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Callback_URI')); ?></label>
                                    <span class="btn btn-secondary btn-sm m-2"
                                          onclick="copyToClipboard('#id_paystack')"><i
                                            class="tio-copy"></i> <?php echo e(\App\CPU\translate('Copy URI')); ?></span>
                                    <br>
                                    <p class="form-control" id="id_paystack"><?php echo e(url('/')); ?>/paystack-callback</p>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('publicKey')); ?></label><br>
                                    <input type="text" class="form-control" name="publicKey"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['publicKey']:''); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('secretKey')); ?> </label><br>
                                    <input type="text" class="form-control" name="secretKey"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['secretKey']:''); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('paymentUrl')); ?> </label><br>
                                    <input type="text" class="form-control" name="paymentUrl"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['paymentUrl']:''); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('merchantEmail')); ?> </label><br>
                                    <input type="text" class="form-control" name="merchantEmail"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['merchantEmail']:''); ?>">
                                </div>
                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4" style="display: none">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('paymob_accept')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('paymob_accept')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['paymob_accept']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('paymob_accept')); ?></label>
                                </div>
                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?> </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('Callback_URI')); ?></label>
                                    <span class="btn btn-secondary btn-sm m-2"
                                          onclick="copyToClipboard('#id_paymob_accept')"><i class="tio-copy"></i> <?php echo e(\App\CPU\translate('Copy URI')); ?></span>
                                    <br>
                                    <p class="form-control" id="id_paymob_accept"><?php echo e(url('/')); ?>/paymob-callback</p>
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('api_key')); ?></label><br>
                                    <input type="text" class="form-control" name="api_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('iframe_id')); ?></label><br>
                                    <input type="text" class="form-control" name="iframe_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['iframe_id']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('integration_id')); ?></label><br>
                                    <input type="text" class="form-control" name="integration_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['integration_id']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('HMAC')); ?></label><br>
                                    <input type="text" class="form-control" name="hmac"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['hmac']:''); ?>">
                                </div>


                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4" style="display: block">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('bkash')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('bkash')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['bkash']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('bkash')); ?></label>
                                </div>

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?> </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('api_key')); ?></label><br>
                                    <input type="text" class="form-control" name="api_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('api_secret')); ?></label><br>
                                    <input type="text" class="form-control" name="api_secret"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['api_secret']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('username')); ?></label><br>
                                    <input type="text" class="form-control" name="username"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['username']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('password')); ?></label><br>
                                    <input type="text" class="form-control" name="password"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['password']:''); ?>">
                                </div>


                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4" style="display: none">
                <div class="card">
                    <div class="card-body" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('paytabs')); ?></h5>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('paytabs')); ?>
                        <form
                            action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method.update',['paytabs']):'javascript:'); ?>"
                            method="post">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($config)): ?>
                                <div class="form-group mb-2">
                                    <label class="control-label"><?php echo e(\App\CPU\translate('paytabs')); ?></label>
                                </div>

                                <div class="form-group mb-2 mt-2">
                                    <input type="radio" name="status" value="1" <?php echo e($config['status']==1?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Active')); ?></label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <input type="radio" name="status" value="0" <?php echo e($config['status']==0?'checked':''); ?>>
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('Inactive')); ?> </label>
                                    <br>
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('profile_id')); ?></label><br>
                                    <input type="text" class="form-control" name="profile_id"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['profile_id']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label style="padding-left: 10px"><?php echo e(\App\CPU\translate('server_key')); ?></label><br>
                                    <input type="text" class="form-control" name="server_key"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['server_key']:''); ?>">
                                </div>

                                <div class="form-group mb-2">
                                    <label
                                        style="padding-left: 10px"><?php echo e(\App\CPU\translate('base_url_by_region')); ?></label><br>
                                    <input type="text" class="form-control" name="base_url"
                                           value="<?php echo e(env('APP_MODE')!='demo'?$config['base_url']:''); ?>">
                                </div>


                                <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                        onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                            <?php else: ?>
                                <button type="submit"
                                        class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('configure')); ?></button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            toastr.success("<?php echo e(\App\CPU\translate('Copied to the clipboard')); ?>");
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/business-settings/payment-method/index.blade.php ENDPATH**/ ?>