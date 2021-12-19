<?php $__env->startSection('title', \App\CPU\translate('Category')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('category')); ?></li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo e(\App\CPU\translate('category_form')); ?>

                    </div>
                    <div class="card-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <form action="<?php echo e(route('admin.category.update',[$category['id']])); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            
                                <!--image upload only for main category-->
                                

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Name *</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Category Name" value="<?php echo e($category->name); ?>" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Bangla Name *</label>
                                        <input type="text" name="name_bangla" class="form-control"
                                               placeholder="Category Name in Bangla" value="<?php echo e($category->name_bangla); ?>" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6 from_part_2">
                                    <label><?php echo e(\App\CPU\translate('image')); ?> (Optional)</label><small style="color: red">
                                        ( <?php echo e(\App\CPU\translate('ratio')); ?> 3:1 )</small>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileEg1"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileEg1"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div><br/><br/>
                                    <div class="form-group">
                                        <center>
                                            <img
                                                style="width: 40%;border: 1px solid; border-radius: 10px;"
                                                id="viewer"
                                                onerror="this.src='<?php echo e(asset('public/assets/back-end/img/900x400/img1.jpg')); ?>'"
                                                 src="<?php echo e(asset('storage/app/public/category')); ?>/<?php echo e($category['icon']); ?>"
                                                alt="image"/>
                                            
                                        </center>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('update')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

    <script>
        

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

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

        $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/category/category-edit.blade.php ENDPATH**/ ?>