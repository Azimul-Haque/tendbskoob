<?php $__env->startSection('title', \App\CPU\translate('Deal Product')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/back-end/css/custom.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a></li>
            <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('flash_deal')); ?></li>
            <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('Add new product')); ?></li>
        </ol>
    </nav>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-black-50"><?php echo e($deal['title']); ?></h1>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.deal.add-product',[$deal['id']])); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name"><?php echo e(\App\CPU\translate('Add new product')); ?></label>
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

                        <div class="card-footer">
                            <button type="submit"
                                    class="btn btn-primary float-right"><?php echo e(\App\CPU\translate('add')); ?></button>
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
                    <h5><?php echo e(\App\CPU\translate('Product')); ?> <?php echo e(\App\CPU\translate('Table')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo e(\App\CPU\translate('sl')); ?></th>
                                <th scope="col"><?php echo e(\App\CPU\translate('name')); ?></th>
                                <th scope="col"><?php echo e(\App\CPU\translate('price')); ?></th>
                                
                                <th scope="col" style="width: 50px"><?php echo e(\App\CPU\translate('action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$de_p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($products->firstitem()+$k); ?></th>
                                    <td><?php echo e($de_p['name']); ?></td>
                                    <td><?php echo e(\App\CPU\BackEndHelper::usd_to_currency($de_p['unit_price'])); ?></td>
                                    
                                    <td>
                                        <a href="<?php echo e(route('admin.deal.delete-product',[$de_p['id']])); ?>"
                                           class="btn btn-danger btn-sm">
                                           <?php echo e(trans ('Delete')); ?>

                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <table>
                            <tfoot>
                                <?php echo $products->links(); ?>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/deal/add-product.blade.php ENDPATH**/ ?>