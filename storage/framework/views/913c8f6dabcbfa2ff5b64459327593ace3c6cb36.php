<?php $__env->startSection('title', \App\CPU\translate('Product List')); ?>
<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Products')); ?></li>
        </ol>
    </nav>

    <div class="d-md-flex_ align-items-center justify-content-between mb-0">
        <div class="row text-center">
            <div class="col-12">
                <h3 class="h3 mt-2 text-black-50"><?php echo e(\App\CPU\translate('product_list')); ?></h3>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(\App\CPU\translate('product_table')); ?></h5>
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
                                <th><?php echo e(\App\CPU\translate('featured')); ?></th>
                                <th><?php echo e(\App\CPU\translate('status')); ?></th>
                                <th style="width: 5px"><?php echo e(\App\CPU\translate('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($k+1); ?></th>
                                    <td>
                                        <a href="<?php echo e(route('admin.product.view',[$p['id']])); ?>">
                                            <?php echo e(substr($p['name'],0,20)); ?><?php echo e(strlen($p['name'])>20?'...':''); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <?php echo e(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']).\App\CPU\BackEndHelper::currency_symbol()); ?>

                                    </td>
                                    <td>
                                        <?php echo e(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']).\App\CPU\BackEndHelper::currency_symbol()); ?>

                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onclick="featured_status('<?php echo e($p['id']); ?>')" <?php echo e($p->featured == 1?'checked':''); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="status"
                                                   id="<?php echo e($p['id']); ?>" <?php echo e($p->status == 1?'checked':''); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="<?php echo e(route('admin.product.edit',[$p['id']])); ?>"><?php echo e(\App\CPU\translate('Edit')); ?></a>
                                                <a class="dropdown-item" href="javascript:"
                                                onclick="form_alert('product-<?php echo e($p['id']); ?>','Want to delete this item ?')"><?php echo e(\App\CPU\translate('Delete')); ?></a>
                                                <form action="<?php echo e(route('admin.product.delete',[$p['id']])); ?>"
                                                      method="post" id="product-<?php echo e($p['id']); ?>">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo e($product->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
                url: "<?php echo e(route('admin.product.status-update')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    if (data.success == true) {
                        toastr.success('<?php echo e(\App\CPU\translate('Status updated successfully')); ?>');
                    } else {
                        toastr.error('<?php echo e(\App\CPU\translate('Status updated failed. Product must be approved')); ?>');
                        location.reload();
                    }
                }
            });
        });

        function featured_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.product.featured-status')); ?>",
                method: 'POST',
                data: {
                    id: id
                },
                success: function () {
                    toastr.success('<?php echo e(\App\CPU\translate('Featured status updated successfully')); ?>');
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/seller/porduct-list.blade.php ENDPATH**/ ?>