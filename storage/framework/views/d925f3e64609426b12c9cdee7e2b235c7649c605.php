<?php $__env->startSection('title', \App\CPU\translate('Employee Add')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/css/select2.min.css" rel="stylesheet"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('employee_add')); ?></li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(\App\CPU\translate('employee_form')); ?>

                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.employee.add-new')); ?>" method="post" enctype="multipart/form-data"
                          style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('Name')); ?></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('Md. Al Imrun')); ?>" value="<?php echo e(old('name')); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('Phone')); ?></label>
                                    <input type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control" id="phone"
                                           placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : +88017********">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('Email')); ?></label>
                                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" id="email"
                                           placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : ex@gmail.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('Role')); ?></label>
                                    <select class="form-control" name="role_id"
                                            style="width: 100%">
                                        <option value="0" selected disabled>---<?php echo e(\App\CPU\translate('select')); ?>---</option>
                                        <?php $__currentLoopData = $rls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($r->id); ?>"><?php echo e($r->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('password')); ?></label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="<?php echo e(\App\CPU\translate('Password')); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('employee_image')); ?></label><span class="badge badge-soft-danger">( <?php echo e(\App\CPU\translate('ratio')); ?> 1:1 )</span>
                                    <br>
                                    <div class="form-group">
                                        <div class="custom-file text-left">
                                            <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                            <label class="custom-file-label" for="customFileUpload"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                            src="<?php echo e(asset('public\assets\back-end\img\400x400\img2.jpg')); ?>" alt="Product thumbnail"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('submit')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/select2.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/employee/add-new.blade.php ENDPATH**/ ?>