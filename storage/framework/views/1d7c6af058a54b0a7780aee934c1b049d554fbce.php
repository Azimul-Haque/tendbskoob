<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Custom styles for this page -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid"> <!-- Page Heading -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Shipping Method')); ?></li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo e(\App\CPU\translate('shipping_method')); ?> <?php echo e(\App\CPU\translate('form')); ?>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.business-settings.shipping-method.add')); ?>"
                              style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                              method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label for="title"><?php echo e(\App\CPU\translate('title')); ?></label>
                                        <input type="text" name="title" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label for="duration"><?php echo e(\App\CPU\translate('duration')); ?></label>
                                        <input type="text" name="duration" class="form-control"
                                               placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('4 to 6 days')); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <label for="cost"><?php echo e(\App\CPU\translate('cost')); ?></label>
                                        <input type="number" min="0" max="1000000" name="cost" class="form-control"
                                               placeholder="<?php echo e(\App\CPU\translate('Ex')); ?> : <?php echo e(\App\CPU\translate('10')); ?> ">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-primary "><?php echo e(\App\CPU\translate('Submit')); ?></button>
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
                        <h5><?php echo e(\App\CPU\translate('shipping_method')); ?> <?php echo e(\App\CPU\translate('table')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0"
                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <thead>
                                <tr>
                                    <th scope="col"><?php echo e(\App\CPU\translate('sl#')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('title')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('duration')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('cost')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('status')); ?></th>
                                    <th scope="col" style="width: 50px"><?php echo e(\App\CPU\translate('action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $shipping_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($k+1); ?></th>
                                        <td><?php echo e($method['title']); ?></td>
                                        <td>
                                            <?php echo e($method['duration']); ?>

                                        </td>
                                        <td>
                                            <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($method['cost']))); ?>

                                        </td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                       id="<?php echo e($method['id']); ?>" <?php echo e($method->status == 1?'checked':''); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <div class="dropdown float-right">
                                                <button class="btn btn-seconary btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="<?php echo e(route('admin.business-settings.shipping-method.edit',[$method['id']])); ?>"><?php echo e(\App\CPU\translate('Edit')); ?></a>
                                                    <a class="dropdown-item delete" style="cursor: pointer;"
                                                       id="<?php echo e($method['id']); ?>"><?php echo e(\App\CPU\translate('Delete')); ?></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        // Call the dataTables jQuery plugin
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
                url: "<?php echo e(route('admin.business-settings.shipping-method.status-update')); ?>",
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
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '<?php echo e(\App\CPU\translate('Are you sure delete this')); ?> ?',
                text: "<?php echo e(\App\CPU\translate('You will not be able to revert this')); ?>!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(\App\CPU\translate('Yes, delete it')); ?>!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('admin.business-settings.shipping-method.delete')); ?>",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('<?php echo e(\App\CPU\translate('Shipping Method deleted successfully')); ?>');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/shipping-method/add-new.blade.php ENDPATH**/ ?>