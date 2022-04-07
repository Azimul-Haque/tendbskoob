<?php $__env->startSection('title',\App\CPU\translate('Book List')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Products')); ?></li>

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="flex-start">
                            <h5><?php echo e(\App\CPU\translate('Product')); ?> <?php echo e(\App\CPU\translate('Table')); ?></h5>
                            <h5 class="mx-1"><span style="color: red;">(<?php echo e($products->total()); ?>)</span></h5>
                        </div>

                        <div class="row justify-content-between align-items-center flex-grow-1">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <!-- Search -->
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="<?php echo e(\App\CPU\translate('Search by Product Name')); ?>" aria-label="Search orders" value="<?php echo e($search); ?>" required>
                                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                                    </div>
                                    <!-- End Search -->
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <a href="<?php echo e(route('seller.product.add-new')); ?>" class="btn btn-primary float-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>">
                                    <i class="tio-add-circle"></i>
                                    <span class="text"><?php echo e(\App\CPU\translate('Add new product')); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table id="datatable"
                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                   class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   style="width: 100%">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(\App\CPU\translate('SL#')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Product Name')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('purchase_price')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('selling_price')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('verify_status')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Active')); ?> <?php echo e(\App\CPU\translate('status')); ?></th>
                                    <th style="width: 5px" class="text-center"><?php echo e(\App\CPU\translate('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($products->firstitem()+ $k); ?></th>
                                        <td><a href="<?php echo e(route('seller.product.view',[$p['id']])); ?>">
                                                <?php echo e($p['name']); ?>

                                            </a></td>
                                        <td>
                                            <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))); ?>

                                        </td>
                                        <td>
                                            <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))); ?>

                                        </td>
                                        <td>
                                            <?php if($p->request_status == 0): ?>
                                                <label class="badge badge-warning"><?php echo e(\App\CPU\translate('New Request')); ?></label>
                                            <?php elseif($p->request_status == 1): ?>
                                                <label class="badge badge-success"><?php echo e(\App\CPU\translate('Approved')); ?></label>
                                            <?php elseif($p->request_status == 2): ?>
                                                <label class="badge badge-danger"><?php echo e(\App\CPU\translate('Denied')); ?></label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                       id="<?php echo e($p['id']); ?>" <?php echo e($p->status == 1?'checked':''); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="<?php echo e(route('seller.product.edit',[$p['id']])); ?>">
                                                <i class="tio-edit"></i><?php echo e(\App\CPU\translate('Edit')); ?>

                                            </a>
                                            <a class="btn btn-danger btn-sm" href="javascript:"
                                               onclick="form_alert('product-<?php echo e($p['id']); ?>','<?php echo e(\App\CPU\translate("Want to delete this item")); ?> ?')">
                                               <i class="tio-add-to-trash"></i> <?php echo e(\App\CPU\translate('Delete')); ?>

                                            </a>
                                            <form action="<?php echo e(route('seller.product.delete',[$p['id']])); ?>"
                                                  method="post" id="product-<?php echo e($p['id']); ?>">
                                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Footer -->
                     <div class="card-footer">
                        <?php echo e($products->links()); ?>

                    </div>
                    <?php if(count($products)==0): ?>
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
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
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
                url: "<?php echo e(route('seller.product.status-update')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    if(data.success == true) {
                        toastr.success('<?php echo e(\App\CPU\translate('Status updated successfully')); ?>');
                    }
                    else if(data.success == false) {
                        toastr.error('<?php echo e(\App\CPU\translate('Status updated failed. Product must be approved')); ?>');
                        location.reload();
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/seller-views/product/list.blade.php ENDPATH**/ ?>