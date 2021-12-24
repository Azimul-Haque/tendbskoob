<?php $__env->startSection('title', \App\CPU\translate('Deal Page')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('deal_of_the_day')); ?></li>
            <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('add_new')); ?></li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(\App\CPU\translate('Deal of the day form')); ?>

                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.deal.day')); ?>" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;" method="post">
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
                                <div class="row <?php echo e($lang != $default_lang ? 'd-none':''); ?> lang_form" id="<?php echo e($lang); ?>-form">
                                    <div class="col-md-12">
                                        <label for="name"><?php echo e(\App\CPU\translate('Title')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input type="text" name="title[]" class="form-control" id="title"
                                               placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('LUX')); ?>"
                                               <?php echo e($lang == $default_lang? 'required':''); ?>>
                                    </div>
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>" id="lang">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name"><?php echo e(\App\CPU\translate('Products')); ?></label>
                                    <select
                                        class="js-example-basic-multiple js-states js-example-responsive form-control"
                                        name="product_id">
                                        <?php $__currentLoopData = \App\Model\Product::orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product->id); ?>">
                                                <?php echo e($product['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer pl-0">
                            <button type="submit"
                                    class="btn btn-primary "><?php echo e(\App\CPU\translate('save')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="flex-between row justify-content-between align-items-center flex-grow-1 mx-1">
                        <div class="flex-between">
                            <div><h5><?php echo e(\App\CPU\translate('deal_of_the_day')); ?></h5></div>
                            <div class="mx-1"><h5 style="color: red;">(<?php echo e($deals->total()); ?>)</h5></div>
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
                                        placeholder="<?php echo e(\App\CPU\translate('Search by Title')); ?>" aria-label="Search orders" value="<?php echo e($search); ?>" required>
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
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><?php echo e(\App\CPU\translate('sl')); ?></th>
                                <th scope="col"><?php echo e(\App\CPU\translate('title')); ?></th>
                                <th scope="col"><?php echo e(\App\CPU\translate('status')); ?></th>
                                <th scope="col" style="width: 100px"><?php echo e(\App\CPU\translate('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($deals->firstItem()+ $k); ?></th>
                                    <td><?php echo e($deal['title']); ?></td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="<?php echo e($deal['id']); ?>" <?php echo e($deal->status == 1?'checked':''); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.deal.day-update',[$deal['id']])); ?>"
                                           class="btn btn-primary btn-sm">
                                           <?php echo e(trans ('Edit')); ?>

                                        </a>
                                        <a href="<?php echo e(route('admin.deal.day-delete',[$deal['id']])); ?>"
                                           class="btn btn-danger btn-sm">
                                           <?php echo e(trans ('Delete')); ?>

                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo e($deals->links()); ?>

                </div>
                <?php if(count($deals)==0): ?>
                    <div class="text-center p-4">
                        <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0"><?php echo e(\App\CPU\translate('No data to show')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
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
    </script>

    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });

        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.deal.status-update')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('<?php echo e(\App\CPU\translate('Status updated successfully')); ?>');
                }
            });
        });
    </script>

    <script>
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.deal.day-status-update')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('<?php echo e(\App\CPU\translate('Status updated successfully')); ?>');
                    location.reload();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/deal/day-index.blade.php ENDPATH**/ ?>