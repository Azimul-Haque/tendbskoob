<?php $__env->startSection('title', \App\CPU\translate('SMS Module Setup')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(\App\CPU\translate('sms')); ?> <?php echo e(\App\CPU\translate('gateway')); ?> <?php echo e(\App\CPU\translate('setup')); ?></h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row" style="padding-bottom: 20px">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('releans_sms')); ?></h5>
                        <span class="badge badge-soft-info mb-3">NB : #OTP# will be replace with otp</span>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('releans_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['releans_sms']):'javascript:'); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-2">
                                <label class="control-label"><?php echo e(\App\CPU\translate('releans_sms')); ?></label>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <input type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('active')); ?></label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <input type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('inactive')); ?> </label>
                                <br>
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('api_key')); ?></label><br>
                                <input type="text" class="form-control" name="api_key"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('from')); ?></label><br>
                                <input type="text" class="form-control" name="from"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['from']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('otp_template')); ?></label><br>
                                <input type="text" class="form-control" name="otp_template"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['otp_template']??"":''); ?>">
                            </div>

                            <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('twilio_sms')); ?></h5>
                        <span class="badge badge-soft-info mb-3">NB : #OTP# will be replace with otp</span>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('twilio_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['twilio_sms']):'javascript:'); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-2">
                                <label class="control-label"><?php echo e(\App\CPU\translate('twilio_sms')); ?></label>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <input type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('active')); ?></label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <input type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('inactive')); ?> </label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-capitalize"
                                       style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('sid')); ?></label><br>
                                <input type="text" class="form-control" name="sid"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['sid']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label class="text-capitalize"
                                       style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('messaging_service_sid')); ?></label><br>
                                <input type="text" class="form-control" name="messaging_service_sid"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['messaging_service_sid']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('token')); ?></label><br>
                                <input type="text" class="form-control" name="token"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['token']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('from')); ?></label><br>
                                <input type="text" class="form-control" name="from"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['from']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('otp_template')); ?></label><br>
                                <input type="text" class="form-control" name="otp_template"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['otp_template']??"":''); ?>">
                            </div>

                            <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('nexmo_sms')); ?></h5>
                        <span class="badge badge-soft-info mb-3">NB : #OTP# will be replace with otp</span>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('nexmo_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['nexmo_sms']):'javascript:'); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-2">
                                <label class="control-label"><?php echo e(\App\CPU\translate('nexmo_sms')); ?></label>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <input type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('active')); ?></label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <input type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('inactive')); ?> </label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-capitalize"
                                       style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('api_key')); ?></label><br>
                                <input type="text" class="form-control" name="api_key"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']??"":''); ?>">
                            </div>
                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('api_secret')); ?></label><br>
                                <input type="text" class="form-control" name="api_secret"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_secret']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('from')); ?></label><br>
                                <input type="text" class="form-control" name="from"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['from']??"":''); ?>">
                            </div>

                            <div class="form-group mb-2">
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('otp_template')); ?></label><br>
                                <input type="text" class="form-control" name="otp_template"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['otp_template']??"":''); ?>">
                            </div>

                            <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('2factor_sms')); ?></h5>
                        <span class="badge badge-soft-info"><?php echo e(\App\CPU\translate("EX of SMS provider's template : your OTP is XXXX here, please check")); ?>.</span><br>
                        <span class="badge badge-soft-info mb-3"><?php echo e(\App\CPU\translate('NB : XXXX will be replace with otp')); ?></span>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('2factor_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['2factor_sms']):'javascript:'); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-2">
                                <label class="control-label"><?php echo e(\App\CPU\translate('2factor_sms')); ?></label>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <input type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('active')); ?></label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <input type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('inactive')); ?> </label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-capitalize"
                                       style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('api_key')); ?></label><br>
                                <input type="text" class="form-control" name="api_key"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['api_key']??"":''); ?>">
                            </div>

                            <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" style="padding: 20px">
                        <h5 class="text-center"><?php echo e(\App\CPU\translate('msg91_sms')); ?></h5>
                        <span class="badge badge-soft-info mb-3"><?php echo e(\App\CPU\translate('NB : Keep an OTP variable in your SMS providers OTP Template')); ?>.</span><br>
                        <?php ($config=\App\CPU\Helpers::get_business_settings('msg91_sms')); ?>
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.sms-module-update',['msg91_sms']):'javascript:'); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>

                            <div class="form-group mb-2">
                                <label class="control-label"><?php echo e(\App\CPU\translate('msg91_sms')); ?></label>
                            </div>
                            <div class="form-group mb-2 mt-2">
                                <input type="radio" name="status" value="1" <?php echo e(isset($config) && $config['status']==1?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('active')); ?></label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <input type="radio" name="status" value="0" <?php echo e(isset($config) && $config['status']==0?'checked':''); ?>>
                                <label style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('inactive')); ?> </label>
                                <br>
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-capitalize"
                                       style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('template_id')); ?></label><br>
                                <input type="text" class="form-control" name="template_id"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['template_id']??"":''); ?>">
                            </div>
                            <div class="form-group mb-2">
                                <label class="text-capitalize"
                                       style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10px"><?php echo e(\App\CPU\translate('authkey')); ?></label><br>
                                <input type="text" class="form-control" name="authkey"
                                       value="<?php echo e(env('APP_MODE')!='demo'?$config['authkey']??"":''); ?>">
                            </div>

                            <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"
                                    onclick="<?php echo e(env('APP_MODE')!='demo'?'':'call_demo()'); ?>"
                                    class="btn btn-primary mb-2"><?php echo e(\App\CPU\translate('save')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/business-settings/sms-index.blade.php ENDPATH**/ ?>