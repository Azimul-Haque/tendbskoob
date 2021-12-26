<?php $__env->startSection('title', \App\CPU\translate('Flash Deal Update')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/back-end/css/tags-input.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Flash Deal')); ?></li>
            <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('Update Deal')); ?></li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(\App\CPU\translate('deal_form')); ?>

                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.deal.update',[$deal['id']])); ?>" method="post" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php ($language=\App\Model\BusinessSetting::where('type','pnc_language')->first()); ?>
                        <?php ($language = $language->value ?? null); ?>
                        <?php ($default_lang = 'en'); ?>

                        <?php ($default_lang = json_decode($language)[0]); ?>
                        <ul class="nav nav-tabs mb-4">
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link <?php echo e($lang == $default_lang? 'active':''); ?>"
                                       href="#"
                                       id="<?php echo e($lang); ?>-link"><?php echo e(\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <div class="form-group">
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                if (count($deal['translations'])) {
                                    $translate = [];
                                    foreach ($deal['translations'] as $t) {
                                        if ($t->locale == $lang && $t->key == "title") {
                                            $translate[$lang]['title'] = $t->value;
                                        }
                                    }
                                }
                                ?>
                                <div class="row <?php echo e($lang != $default_lang ? 'd-none':''); ?> lang_form" id="<?php echo e($lang); ?>-form">
                                    <input type="text" name="deal_type" value="flash_deal"  class="d-none">
                                    <div class="col-md-12">
                                        <label for="name"><?php echo e(\App\CPU\translate('Title')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input type="text" name="title[]" class="form-control" id="title"
                                               value="<?php echo e($lang==$default_lang?$deal['title']:($translate[$lang]['title']??'')); ?>"
                                               placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('LUX')); ?>"
                                            <?php echo e($lang == $default_lang? 'required':''); ?>>
                                    </div>
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>" id="lang">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('start_date')); ?></label>
                                    <input type="date" value="<?php echo e(date('Y-m-d',strtotime($deal['start_date']))); ?>" name="start_date" required
                                           class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('end_date')); ?></label>
                                    <input type="date" value="<?php echo e(date('Y-m-d', strtotime($deal['end_date']))); ?>" name="end_date" required
                                           class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                
                                
                                <div class="col-md-12 pt-3">
                                    <label for="name"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('Image')); ?></label><span class="badge badge-soft-danger">( <?php echo e(\App\CPU\translate('ratio')); ?> 5:1 )</span>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label" for="customFileUpload"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 20px">
                                    <center>
                                        <img style="width: auto;border: 1px solid; border-radius: 10px; max-height:200px;" id="viewer"
                                        onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'" src="<?php echo e(asset('storage/app/public/deal')); ?>/<?php echo e($deal['banner']); ?>" alt="banner image"/>
                                    </center>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pl-0">
                            <button type="submit" class="btn btn-primary "><?php echo e(\App\CPU\translate('update')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    <?php echo $__env->make('shared-partials.image-process._image-crop-modal',['modal_id'=>'banner-image-modal','width'=>1100,'margin_left'=>'-65%'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

    <!-- Page level custom scripts -->

    <script>
        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>

    <script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '<?php echo e($default_lang); ?>') {
                $(".from_part_2").removeClass('d-none');
            } else {
                $(".from_part_2").addClass('d-none');
            }
        });

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

    <?php echo $__env->make('shared-partials.image-process._script',[
     'id'=>'banner-image-modal',
     'height'=>170,
     'width'=>1050,
     'multi_image'=>false,
     'route'=>route('image-upload')
     ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/deal/flash-update.blade.php ENDPATH**/ ?>