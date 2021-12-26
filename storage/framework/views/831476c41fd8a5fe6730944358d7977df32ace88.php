<?php $__env->startSection('title', \App\CPU\translate('Attribute')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/back-end/css/croppie.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">

        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
                <div class="card">
                    <div class="card-header">
                        <h3><?php echo e(\App\CPU\translate('update')); ?> <?php echo e(\App\CPU\translate('attribute')); ?></h3>
                    </div>
                    <div class="card-body"
                         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <form action="<?php echo e(route('admin.attribute.update',[$attribute['id']])); ?>" method="post">
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
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                if (count($attribute['translations'])) {
                                    $translate = [];
                                    foreach ($attribute['translations'] as $t) {
                                        if ($t->locale == $lang && $t->key == "name") {
                                            $translate[$lang]['name'] = $t->value;
                                        }
                                    }
                                }
                                ?>
                                <div class="form-group <?php echo e($lang != $default_lang ? 'd-none':''); ?> lang_form"
                                     id="<?php echo e($lang); ?>-form">
                                    <input type="hidden" id="id">
                                    <label
                                        for="name"><?php echo e(\App\CPU\translate('Attribute')); ?> <?php echo e(\App\CPU\translate('Name')); ?>

                                        (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <input type="text" name="name[]"
                                           value="<?php echo e($lang==$default_lang?$attribute['name']:($translate[$lang]['name']??'')); ?>"
                                           class="form-control" id="name"
                                           placeholder="<?php echo e(\App\CPU\translate('Enter_Attribute_Name')); ?>" <?php echo e($lang == $default_lang? 'required':''); ?>>
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>" id="lang">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('update')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php $__env->stopSection(); ?>

            <?php $__env->startPush('script'); ?>
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
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/attribute/edit.blade.php ENDPATH**/ ?>