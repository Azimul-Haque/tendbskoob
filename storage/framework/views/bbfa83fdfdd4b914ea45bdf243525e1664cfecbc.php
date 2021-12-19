<?php $__env->startSection('title', \App\CPU\translate('Sub Sub Category')); ?>

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
                        <?php echo e(\App\CPU\translate('sub_sub_category_form')); ?>

                    </div>
                    <div class="card-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <form action="<?php echo e(route('admin.sub-sub-category.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php ($language=\App\Model\BusinessSetting::where('type','pnc_language')->first()); ?>
                            <?php ($language = $language->value ?? null); ?>
                            <?php ($default_lang = 'en'); ?>
                            <?php if($language): ?>
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
                                <div class="row">
                                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="col-12 form-group <?php echo e($lang != $default_lang ? 'd-none':''); ?> lang_form"
                                            id="<?php echo e($lang); ?>-form">
                                            <label class="input-label"
                                                   for="exampleFormControlInput1"><?php echo e(\App\CPU\translate('Sub_sub_category')); ?> <?php echo e(\App\CPU\translate('name')); ?>

                                                (<?php echo e(strtoupper($lang)); ?>)</label>
                                            <input type="text" name="name[]" class="form-control"
                                                   placeholder="<?php echo e(\App\CPU\translate('New_Sub_Sub_Category')); ?>" <?php echo e($lang == $default_lang? 'required':''); ?>>
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <div class="form-group lang_form" id="<?php echo e($default_lang); ?>-form">
                                                <label
                                                    class="input-label"><?php echo e(\App\CPU\translate('Sub_sub_category')); ?> <?php echo e(\App\CPU\translate('name')); ?>

                                                    (<?php echo e(strtoupper($lang)); ?>)</label>
                                                <input type="text" name="name[]" class="form-control"
                                                       placeholder="<?php echo e(\App\CPU\translate('New_Sub_Category')); ?>" required>
                                            </div>
                                            <input type="hidden" name="lang[]" value="<?php echo e($default_lang); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label
                                                class="input-label"><?php echo e(\App\CPU\translate('main')); ?> <?php echo e(\App\CPU\translate('category')); ?>

                                                <span class="input-label-secondary">*</span></label>
                                            <select class="form-control" id="cat_id" required>
                                                <option value="0">---<?php echo e(\App\CPU\translate('select')); ?>---</option>
                                                <?php $__currentLoopData = \App\Model\Category::where(['position'=>0])->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option
                                                        value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label
                                            for="name"><?php echo e(\App\CPU\translate('sub_category')); ?> <?php echo e(\App\CPU\translate('name')); ?></label>
                                        <select name="parent_id" id="parent_id" class="form-control">

                                        </select>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button type="submit"
                                                class="btn btn-primary"><?php echo e(\App\CPU\translate('submit')); ?></button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px" id="cate-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="flex-between justify-content-between align-items-center flex-grow-1">
                            <div>
                                <h5><?php echo e(\App\CPU\translate('sub_sub_category_table')); ?> <span style="color: red;">(<?php echo e($categories->total()); ?>)</span></h5>
                            </div>
                            <div style="width: 40vw">
                                <!-- Search -->
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="<?php echo e(\App\CPU\translate('Search_by_Sub_Sub_Category')); ?>" aria-label="Search orders" value="<?php echo e($search); ?>" required>
                                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 120px"><?php echo e(\App\CPU\translate('category')); ?> <?php echo e(\App\CPU\translate('ID')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('sub_sub_category_name')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('slug')); ?></th>
                                    <th scope="col" class="text-center"
                                        style="width: 120px"><?php echo e(\App\CPU\translate('action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($category['id']); ?></td>
                                        <td><?php echo e($category['name']); ?></td>
                                        <td><?php echo e($category['slug']); ?></td>
                                        <td>
                                            <a class="btn btn-primary btn-sm edit" style="cursor: pointer;"
                                               href="<?php echo e(route('admin.category.edit',[$category['id']])); ?>">
                                                <i class="tio-edit"></i><?php echo e(\App\CPU\translate('Edit')); ?>

                                            </a>
                                            <a class="btn btn-danger btn-sm delete" style="cursor: pointer;"
                                               id="<?php echo e($category['id']); ?>">
                                                <i class="tio-add-to-trash"></i><?php echo e(\App\CPU\translate('Delete')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php echo e($categories->links()); ?>

                    </div>
                    <?php if(count($categories)==0): ?>
                        <div class="text-center p-4">
                            <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0"><?php echo e(\App\CPU\translate('No_data_to_show')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
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

    <script>
        $('#cat_id').on('change', function () {
            var id = $(this).val();
            if (id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('admin.sub-sub-category.getSubCategory')); ?>',
                    data: {
                        id: id
                    },
                    success: function (result) {
                        $("#parent_id").html(result);
                    }
                });
            }
        });

        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '<?php echo e(\App\CPU\translate('Are_you_sure_to_delete_this?')); ?>',
                text: "<?php echo e(\App\CPU\translate('You_wont_be_able_to_revert_this!')); ?>",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(\App\CPU\translate('Yes')); ?>, <?php echo e(\App\CPU\translate('delete_it')); ?>!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('admin.sub-sub-category.delete')); ?>",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('<?php echo e(\App\CPU\translate('Sub_Sub_Category_Deleted_Successfully')); ?>.');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/category/sub-sub-category-view.blade.php ENDPATH**/ ?>