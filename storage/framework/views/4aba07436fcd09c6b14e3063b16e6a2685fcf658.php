<?php $__env->startSection('title', \App\CPU\translate('Book List')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Books')); ?></li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row flex-between justify-content-between align-items-center flex-grow-1">
                        <div>
                            <h5 class="flex-between">
                                <div><?php echo e(\App\CPU\translate('book_table')); ?></div>
                                <div style="color: red; padding: 0 .4375rem;">(<?php echo e($pro->total()); ?>)</div>
                            </h5>
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
                                           placeholder="<?php echo e(\App\CPU\translate('Search Book')); ?>" aria-label="Search orders"
                                           value="<?php echo e($search); ?>" required>
                                    
                                    <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                        <div>
                            <a href="<?php echo e(route('seller.product.add-new')); ?>" class="btn btn-primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text"><?php echo e(\App\CPU\translate('Add New Book')); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th><?php echo e(\App\CPU\translate('SL#')); ?></th>
                                <th><?php echo e(\App\CPU\translate('Book Name')); ?></th>
                                <th>
                                    <?php if($orderby && $orderby == 'asc'): ?>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['orderby' => 'desc'])); ?>" style="font-weight: 900!important;">
                                            <i class="fa fa-sort-alpha-asc"></i> <?php echo e(\App\CPU\translate('Publication (ASC)')); ?>

                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(request()->fullUrlWithQuery(['orderby' => 'asc'])); ?>" style="font-weight: 900!important;">
                                            <i class="fa fa-sort-alpha-desc"></i> <?php echo e(\App\CPU\translate('Publication (DESC)')); ?>

                                        </a>
                                    <?php endif; ?>
                                </th>
                                <th>Price</th>
                                <?php if(auth('admin')->user()->role->name != 'Master Admin' && auth('admin')->user()->role->name != 'Admin'): ?>
                                    
                                <?php else: ?>
                                    <th><?php echo e(\App\CPU\translate('featured')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('Active')); ?> <?php echo e(\App\CPU\translate('status')); ?></th>
                                <?php endif; ?>
                                <th>Stocks</th>
                                <th>Stock Status</th>
                                <th style="width: 5px" class="text-center"><?php echo e(\App\CPU\translate('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($orderby && $orderby == 'asc'): ?>
                                <?php $__currentLoopData = $pro->sortBy('publisher.name_bangla'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($pro->firstItem()+$k); ?></th>
                                        <td>
                                            <a href="<?php echo e(route('admin.product.view',[$p['id']])); ?>"
                                            title="<?php echo e($p['name_bangla']); ?>&#10;<?php echo e($p['name']); ?>">
                                                <?php echo e(\Illuminate\Support\Str::limit($p['name_bangla'],25)); ?><br/>
                                                <?php echo e(\Illuminate\Support\Str::limit($p['name'],20)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <?php echo e($p->publisher->name_bangla); ?>

                                        </td>
                                        <td>
                                            <small>
                                                <?php echo e(\App\CPU\translate('purchase')); ?>: 
                                                <b><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))); ?></b>
                                            </small><br/>
                                            <small>
                                                <?php echo e(\App\CPU\translate('published')); ?>: 
                                                <b><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['published_price']))); ?></b>
                                            </small><br/>
                                            <small>
                                                <?php echo e(\App\CPU\translate('sale')); ?>: 
                                                <b><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))); ?></b>
                                            </small>
                                        </td>
                                        <?php if(auth('admin')->user()->role->name != 'Master Admin' && auth('admin')->user()->role->name != 'Admin'): ?>
                                    
                                        <?php else: ?>
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
                                        <?php endif; ?>
                                        
                                        <td>
                                            <?php echo e($p->current_stock); ?>

                                        </td>
                                        <td>
                                            <select id="stock_status<?php echo e($p['id']); ?>" onchange="stock_status('<?php echo e($p['id']); ?>')" class="form-control" style="width: 140px;">
                                                <option value="1" <?php echo e($p->stock_status == 1?'selected':''); ?>>In Stock</option>
                                                <option value="2" <?php echo e($p->stock_status == 2?'selected':''); ?>>Out of Stock</option>
                                                <option value="3" <?php echo e($p->stock_status == 3?'selected':''); ?>>Back Order</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                            href="<?php echo e(route('admin.product.edit',[$p['id']])); ?>">
                                                <i class="tio-edit"></i> <?php echo e(\App\CPU\translate('Edit')); ?>

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
                            <?php else: ?>
                                <?php $__currentLoopData = $pro->sortByDesc('publisher.name_bangla'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e($pro->firstItem()+$k); ?></th>
                                        <td>
                                            <a href="<?php echo e(route('admin.product.view',[$p['id']])); ?>"
                                            title="<?php echo e($p['name_bangla']); ?>&#10;<?php echo e($p['name']); ?>">
                                                <?php echo e(\Illuminate\Support\Str::limit($p['name_bangla'],25)); ?><br/>
                                                <?php echo e(\Illuminate\Support\Str::limit($p['name'],20)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <?php echo e($p->publisher->name_bangla); ?>

                                        </td>
                                        <td>
                                            <small>
                                                <?php echo e(\App\CPU\translate('purchase')); ?>: 
                                                <b><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))); ?></b>
                                            </small><br/>
                                            <small>
                                                <?php echo e(\App\CPU\translate('published')); ?>: 
                                                <b><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['published_price']))); ?></b>
                                            </small><br/>
                                            <small>
                                                <?php echo e(\App\CPU\translate('sale')); ?>: 
                                                <b><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))); ?></b>
                                            </small>
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
                                            <?php echo e($p->current_stock); ?>

                                        </td>
                                        <td>
                                            <select id="stock_status<?php echo e($p['id']); ?>" onchange="stock_status('<?php echo e($p['id']); ?>')" class="form-control" style="width: 140px;">
                                                <option value="1" <?php echo e($p->stock_status == 1?'selected':''); ?>>In Stock</option>
                                                <option value="2" <?php echo e($p->stock_status == 2?'selected':''); ?>>Out of Stock</option>
                                                <option value="3" <?php echo e($p->stock_status == 3?'selected':''); ?>>Back Order</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                            href="<?php echo e(route('admin.product.edit',[$p['id']])); ?>">
                                                <i class="tio-edit"></i> <?php echo e(\App\CPU\translate('Edit')); ?>

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
                            <?php endif; ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo e($pro->links()); ?>

                </div>
                <?php if(count($pro)==0): ?>
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
    <script src="https://use.fontawesome.com/112ed7653e.js"></script>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
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
                    if(data.success == true) {
                        toastr.success('<?php echo e(\App\CPU\translate('Status updated successfully')); ?>');
                    }
                    else if(data.success == false) {
                        toastr.error('<?php echo e(\App\CPU\translate('Status updated failed. Product must be approved')); ?>');
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
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

        function stock_status(id) {
            var stock_status_val = $('#stock_status' + id).val();
            // console.log(stock_status_val);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('admin.product.stock-status')); ?>",
                method: 'POST',
                data: {
                    id: id,
                    stock_status: stock_status_val,
                },
                success: function () {
                    toastr.success('<?php echo e(\App\CPU\translate('Stock status updated successfully')); ?>');
                }
            });
        }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/seller-views/product/list.blade.php ENDPATH**/ ?>