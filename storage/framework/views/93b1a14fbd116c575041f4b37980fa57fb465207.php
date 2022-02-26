<?php $__env->startSection('title',\App\CPU\translate('Seller Apply')); ?>

<?php $__env->startPush('css_or_js'); ?>
<link href="<?php echo e(asset('public/assets/back-end')); ?>/css/select2.min.css" rel="stylesheet"/>
<link href="<?php echo e(asset('public/assets/back-end/css/croppie.css')); ?>" rel="stylesheet">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>

<div class="container main-card rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">

    <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body ">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center mb-2 ">
                            <h3 class="" > <?php echo e(\App\CPU\translate('Shop')); ?> <?php echo e(\App\CPU\translate('Application')); ?></h3>
                            <hr>
                        </div>
                        <form class="user" action="<?php echo e(route('shop.apply')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <h5 class="black"><?php echo e(\App\CPU\translate('Seller')); ?> <?php echo e(\App\CPU\translate('Info')); ?> </h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name="f_name" value="<?php echo e(old('f_name')); ?>" placeholder="<?php echo e(\App\CPU\translate('first_name')); ?>" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name="l_name" value="<?php echo e(old('l_name')); ?>" placeholder="<?php echo e(\App\CPU\translate('last_name')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 mt-4">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(\App\CPU\translate('email_address')); ?>" required>
                                </div>
                                <div class="col-sm-6"><small class="text-danger">( * <?php echo e(\App\CPU\translate('country_code_is_must')); ?> <?php echo e(\App\CPU\translate('like_for_BD_880')); ?> )</small>
                                    <input type="number" class="form-control form-control-user" id="exampleInputPhone" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(\App\CPU\translate('phone_number')); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleInputPassword" name="password" placeholder="<?php echo e(\App\CPU\translate('password')); ?>" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" minlength="6" id="exampleRepeatPassword" placeholder="<?php echo e(\App\CPU\translate('repeat_password')); ?>" required>
                                    <div class="pass invalid-feedback"><?php echo e(\App\CPU\translate('Repeat')); ?>  <?php echo e(\App\CPU\translate('password')); ?> <?php echo e(\App\CPU\translate('not match')); ?> .</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                            src="<?php echo e(asset('public\assets\back-end\img\400x400\img2.jpg')); ?>" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('image')); ?></label>
                                    </div>
                                </div>
                            </div>


                            <h5 class="black"><?php echo e(\App\CPU\translate('Shop')); ?> <?php echo e(\App\CPU\translate('Info')); ?></h5>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 ">
                                    <input type="text" class="form-control form-control-user" id="shop_name" name="shop_name" placeholder="<?php echo e(\App\CPU\translate('shop_name')); ?>" value="<?php echo e(old('shop_name')); ?>"required>
                                </div>
                                <div class="col-sm-6">
                                    <textarea name="shop_address" class="form-control" id="shop_address"rows="1" placeholder="<?php echo e(\App\CPU\translate('shop_address')); ?>"><?php echo e(old('shop_address')); ?></textarea>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerLogo"
                                            src="<?php echo e(asset('public\assets\back-end\img\400x400\img2.jpg')); ?>" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="logo" id="LogoUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="LogoUpload"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('logo')); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewerBanner"
                                             src="<?php echo e(asset('public\assets\back-end\img\400x400\img2.jpg')); ?>" alt="banner image"/>
                                    </center>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" style="overflow: hidden; padding: 2%">
                                        <label class="custom-file-label" for="BannerUpload"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('Banner')); ?></label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block" id="apply"><?php echo e(\App\CPU\translate('Apply')); ?> <?php echo e(\App\CPU\translate('Shop')); ?> </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small"  href="<?php echo e(route('seller.auth.login')); ?>"><?php echo e(\App\CPU\translate('already_have_an_account?_login.')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>
<script>
    $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup',function () {
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass==passRepeat){
            $('.pass').hide();
        }
        else{
            $('.pass').show();
        }
    });
    $('#apply').on('click',function () {

        var image = $("#image-set").val();
        if (image=="")
        {
            $('.image').show();
            return false;
        }
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass!=passRepeat){
            $('.pass').show();
            return false;
        }


    });
    function Validate(file) {
        var x;
        var le = file.length;
        var poin = file.lastIndexOf(".");
        var accu1 = file.substring(poin, le);
        var accu = accu1.toLowerCase();
        if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
            x = 1;
            return x;
        } else {
            x = 0;
            return x;
        }
    }

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

    function readlogoURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerLogo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function readBannerURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#viewerBanner').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#LogoUpload").change(function () {
        readlogoURL(this);
    });
    $("#BannerUpload").change(function () {
        readBannerURL(this);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/seller-views/auth/register.blade.php ENDPATH**/ ?>