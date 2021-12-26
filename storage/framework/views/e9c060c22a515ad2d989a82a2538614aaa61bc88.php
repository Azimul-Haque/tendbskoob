<?php $__env->startSection('title', \App\CPU\translate('Edit Role')); ?>
<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Role Update')); ?></li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.custom-role.update',[$role['id']])); ?>" method="post"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(\App\CPU\translate('role_name')); ?></label>
                                <input type="text" name="name" value="<?php echo e($role['name']); ?>" class="form-control" id="name"
                                       aria-describedby="emailHelp"
                                       placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('Store')); ?>">
                            </div>

                            <label for="module"><?php echo e(\App\CPU\translate('module_permission')); ?> : </label>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="order_management" class="form-check-input"
                                               id="order" <?php echo e(in_array('order_management',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;" for="order"><?php echo e(\App\CPU\translate('Order_Management')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="product_management" class="form-check-input"
                                               id="product" <?php echo e(in_array('product_management',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="product"><?php echo e(\App\CPU\translate('Product_Management')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="marketing_section"
                                               class="form-check-input"
                                               id="marketing" <?php echo e(in_array('marketing_section',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="marketing"><?php echo e(\App\CPU\translate('Marketing_Section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="business_section"
                                               class="form-check-input"
                                               id="business_section" <?php echo e(in_array('business_section',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="business_section"><?php echo e(\App\CPU\translate('Business_Section')); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="user_section"
                                               class="form-check-input"
                                               id="user_section" <?php echo e(in_array('user_section',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="user_section"><?php echo e(\App\CPU\translate('user_section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="support_section"
                                               class="form-check-input"
                                               id="support_section" <?php echo e(in_array('support_section',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="support_section"><?php echo e(\App\CPU\translate('Support_Section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="business_settings"
                                               class="form-check-input"
                                               id="business_settings" <?php echo e(in_array('business_settings',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="business_settings"><?php echo e(\App\CPU\translate('Business_Settings')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="web_&_app_settings"
                                               class="form-check-input"
                                               id="web_&_app_settings" <?php echo e(in_array('web_&_app_settings',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="web_&_app_settings"><?php echo e(\App\CPU\translate('Web_&_App_Settings')); ?></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="report" class="form-check-input"
                                               id="report" <?php echo e(in_array('report',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="report"><?php echo e(\App\CPU\translate('Report_&_Analytics')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="employee_section"
                                               class="form-check-input"
                                               id="employee_section" <?php echo e(in_array('employee_section',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="employee_section"><?php echo e(\App\CPU\translate('employee_section')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="modules[]" value="dashboard" class="form-check-input"
                                               id="dashboard" <?php echo e(in_array('dashboard',(array)json_decode($role['module_access']))?'checked':''); ?>>
                                        <label class="form-check-label" style="<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''); ?>;"
                                               for="dashboard"><?php echo e(\App\CPU\translate('Dashboard')); ?></label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('update')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/custom-role/edit.blade.php ENDPATH**/ ?>