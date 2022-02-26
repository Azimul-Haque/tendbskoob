<?php $__env->startSection('title',$seller->shop ? $seller->shop->name : \App\CPU\translate("shop name not found")); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Seller_Details')); ?></li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="<?php echo e(route('admin.sellers.seller-list')); ?>" class="btn btn-primary mt-3 mb-3"><?php echo e(\App\CPU\translate('Back_to_seller_list')); ?></a>
            </div>
            <div>
                <?php if($seller->status=="pending"): ?>
                    <div class="mt-4">
                        <div class="flex-start">
                            <div class="mx-1"><h4><i class="tio-shop-outlined"></i></h4></div>
                            <div><?php echo e(\App\CPU\translate('Seller_request_for_open_a_shop.')); ?></div>
                        </div>
                        <div class="text-center">
                            <form class="d-inline-block" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Approve')); ?></button>
                            </form>
                            <form class="d-inline-block" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger"><?php echo e(\App\CPU\translate('reject')); ?></button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Page Header -->
    <div class="page-header">
        <div class="flex-between row mx-1">
            <div>
                <h1 class="page-header-title"><?php echo e($seller->shop ? $seller->shop->name : "Shop Name : Update Please"); ?></h1>
            </div>

        </div>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                        <a class="nav-link " href="<?php echo e(route('admin.sellers.view',$seller->id)); ?>"><?php echo e(\App\CPU\translate('Shop')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'order'])); ?>"><?php echo e(\App\CPU\translate('Order')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'product'])); ?>"><?php echo e(\App\CPU\translate('Product')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'setting'])); ?>"><?php echo e(\App\CPU\translate('Setting')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'transaction'])); ?>"><?php echo e(\App\CPU\translate('Transaction')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?php echo e(route('admin.sellers.view',['id'=>$seller->id, 'tab'=>'review'])); ?>"><?php echo e(\App\CPU\translate('Review')); ?></a>
                    </li>

            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
        <!-- End Page Header-->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="product">
            <div class="row pt-2">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="flex-start">
                                <div class="mx-1"><h3><?php echo e(\App\CPU\translate('products')); ?></h3></div>
                                <div><h3><span style="color: red;">(<?php echo e($products->total()); ?>)</span></h3></div>
                            </div>

                            <a href="<?php echo e(route('admin.product.add-new')); ?>" class="btn btn-primary pull-right"><i
                                        class="tio-add-circle"></i> <?php echo e(\App\CPU\translate('add')); ?> <?php echo e(\App\CPU\translate('New')); ?> <?php echo e(\App\CPU\translate('product')); ?></a>
                        </div>
                        <div class="table-responsive datatable-custom">
                            <table id="columnSearchDatatable"
                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                   class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   data-hs-datatables-options='{
                                        "order": [],
                                        "orderCellsTop": true,
                                        "paging": false
                                    }'>
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php echo e(\App\CPU\translate('SL#')); ?></th>
                                <th><?php echo e(\App\CPU\translate('Product Name')); ?></th>
                                <th><?php echo e(\App\CPU\translate('purchase_price')); ?></th>
                                <th><?php echo e(\App\CPU\translate('selling_price')); ?></th>
                                <th><?php echo e(\App\CPU\translate('featured')); ?></th>
                                <th><?php echo e(\App\CPU\translate('Active')); ?> <?php echo e(\App\CPU\translate('status')); ?></th>
                                <th style="width: 5px" class="text-center"><?php echo e(\App\CPU\translate('Action')); ?></th>
                                    </tr>
                                </thead>

                                <tbody id="set-rows">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($products->firstItem()+$k); ?></th>
                                    <td>
                                        <a href="<?php echo e(route('admin.product.view',[$p['id']])); ?>">
                                            <?php echo e(substr($p['name'],0,20)); ?><?php echo e(strlen($p['name'])>20?'...':''); ?>

                                        </a>
                                    </td>
                                    <td>
                                        <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))); ?>

                                    </td>
                                    <td>
                                        <?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))); ?>

                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox"
                                                   onclick="featured_status('<?php echo e($p['id']); ?>')" <?php echo e($p->featured == 1?'checked':''); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <label class="switch switch-status">
                                            <input type="checkbox" class="status"
                                                   id="<?php echo e($p['id']); ?>" <?php echo e($p->status == 1?'checked':''); ?>>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                           href="<?php echo e(route('admin.product.edit',[$p['id']])); ?>">
                                            <i class="tio-edit"></i><?php echo e(\App\CPU\translate('Edit')); ?>

                                        </a>
                                        <a class="btn btn-danger btn-sm" href="javascript:"
                                           onclick="form_alert('product-<?php echo e($p['id']); ?>','Want to delete this item ?')">
                                            <i class="tio-add-to-trash"></i> <?php echo e(\App\CPU\translate('Delete')); ?>

                                        </a>
                                        <form action="<?php echo e(route('admin.product.delete',[$p['id']])); ?>"
                                              method="post" id="product-<?php echo e($p['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>


                        </div>
                        <div class="card-footer">
                    <?php echo e($products->links()); ?>

                </div>
                <?php if(count($products)==0): ?>
                    <div class="text-center p-4">
                        <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0"><?php echo e(\App\CPU\translate('No_data_to_show')); ?></p>
                    </div>
                <?php endif; ?>
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

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/seller/view/product.blade.php ENDPATH**/ ?>