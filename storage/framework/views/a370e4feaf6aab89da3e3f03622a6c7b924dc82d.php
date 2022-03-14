<?php $__env->startSection('title', \App\CPU\translate('Shop Edit')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
     <!-- Custom styles for this page -->
     <link href="<?php echo e(asset('public/assets/back-end/css/croppie.css')); ?>" rel="stylesheet">
     <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Row -->
    <div class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 "><?php echo e(\App\CPU\translate('Edit Shop Info')); ?></h1>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('seller.shop.update',[$shop->id])); ?>" method="post"
                          style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><?php echo e(\App\CPU\translate('Shop Name')); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="<?php echo e($shop->name); ?>" class="form-control" id="name"
                                            required>
                                </div>
                                <div class="form-group">
                                    <label for="name"><?php echo e(\App\CPU\translate('Contact')); ?> <small class="text-danger">( * <?php echo e(\App\CPU\translate('country_code_is_must')); ?> <?php echo e(\App\CPU\translate('like_for_BD_880')); ?> )</small></label>
                                    <input type="number" name="contact" value="<?php echo e($shop->contact); ?>" class="form-control" id="name"
                                            required>
                                </div>
                                <div class="form-group">
                                    <label for="address"><?php echo e(\App\CPU\translate('Address')); ?> <span class="text-danger">*</span></label>
                                    <textarea type="text" rows="4" name="address" value="" class="form-control" id="address"
                                            required><?php echo e($shop->address); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('image')); ?></label>
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                    onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                    src="<?php echo e(asset('storage/app/public/shop/'.$shop->image)); ?>" alt="Product thumbnail"/>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mt-2">
                                <div class="form-group">
                                    <div class="flex-start">
                                        <div for="name"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('Banner')); ?> </div>
                                        <div class="mx-1" for="ratio"><small style="color: red"><?php echo e(\App\CPU\translate('Ratio')); ?> : ( 6:1 )</small></div>
                                    </div>
                                    <div class="custom-file text-left">
                                        <input type="file" name="banner" id="BannerUpload" class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="BannerUpload"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img style="width: auto; height:auto; border: 1px solid; border-radius: 10px; max-height:200px" id="viewerBanner"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                         src="<?php echo e(asset('storage/app/public/shop/banner/'.$shop->banner)); ?>" alt="Product thumbnail"/>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="btn_update"><?php echo e(\App\CPU\translate('Update')); ?></button>
                        <a class="btn btn-danger" href="<?php echo e(route('seller.shop.view')); ?>"><?php echo e(\App\CPU\translate('Cancel')); ?></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

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

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $("#BannerUpload").change(function () {
            readBannerURL(this);
        });
   </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/seller-views/shop/edit.blade.php ENDPATH**/ ?>