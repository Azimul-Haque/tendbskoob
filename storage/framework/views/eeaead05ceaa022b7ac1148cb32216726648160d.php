<?php $__env->startSection('content'); ?>
    <div class="content container-fluid ">
        <div class="col-md-4" style="margin-bottom: 20px;">
            <h3 class="text-capitalize"><?php echo e(\App\CPU\translate('transaction_table')); ?>

                <span class="badge badge-soft-dark mx-2"><?php echo e($transactions->total()); ?></span>

            </h3>
        </div>
        
        
        <div class="card">
            <div class="card-header">
                <div class="flex-between justify-content-between align-items-center flex-grow-1">
                    <div class="col-md-5 ">
                        <form action="<?php echo e(url()->current()); ?>" method="GET">
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                       placeholder="Search by orders id or transaction id" aria-label="Search orders"
                                       value="<?php echo e($search); ?>"
                                       required>
                                <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                            </div>
                            <!-- End Search -->
                        </form>
                    </div>
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="row">

                            <div class="col-md-8">

                                <select class="form-control" name="status">

                                    <option class="text-center" value="0" selected disabled>
                                        ---<?php echo e(\App\CPU\translate('select_status')); ?>---
                                    </option>
                                    <option class="text-left text-capitalize"
                                            value="disburse" <?php echo e($status == 'disburse'? 'selected' : ''); ?> ><?php echo e(\App\CPU\translate('disburse')); ?> </option>
                                    <option class="text-left text-capitalize"
                                            value="hold" <?php echo e($status == 'hold'? 'selected' : ''); ?>><?php echo e(\App\CPU\translate('hold')); ?></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success"><?php echo e(\App\CPU\translate('filter')); ?></button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body" style="padding: 0">
                <div class="table-responsive">
                    <table id="datatable"
                           style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                           class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                        <tr>
                            <th><?php echo e(\App\CPU\translate('SL#')); ?></th>
                            
                            <th><?php echo e(\App\CPU\translate('seller_name')); ?></th>
                            <th><?php echo e(\App\CPU\translate('customer_name')); ?></th>
                            <th><?php echo e(\App\CPU\translate('order_id')); ?></th>
                            <th><?php echo e(\App\CPU\translate('transaction_id')); ?></th>
                            <th><?php echo e(\App\CPU\translate('order_amount')); ?></th>
                            <th><?php echo e(\App\CPU\translate('seller_amount')); ?></th>
                            <th><?php echo e(\App\CPU\translate('admin_commission')); ?></th>
                            <th><?php echo e(\App\CPU\translate('received_by')); ?></th>
                            <th><?php echo e(\App\CPU\translate('delivered_by')); ?></th>
                            <th><?php echo e(\App\CPU\translate('delivery_charge')); ?></th>
                            <th><?php echo e(\App\CPU\translate('payment_method')); ?></th>
                            <th><?php echo e(\App\CPU\translate('tax')); ?></th>
                            <th><?php echo e(\App\CPU\translate('status')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transactions->firstItem()+$key); ?></td>
                                
                                <td>
                                    <?php if($transaction['seller_is'] == 'admin'): ?>
                                        <?php echo e(\App\CPU\Helpers::get_business_settings('company_name')); ?>

                                    <?php else: ?>
                                        <?php echo e($transaction->seller->f_name); ?> <?php echo e($transaction->seller->l_name); ?>

                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php echo e($transaction->customer->f_name); ?> <?php echo e($transaction->customer->l_name); ?>

                                </td>
                                <td><?php echo e($transaction['order_id']); ?></td>
                                <td><?php echo e($transaction['transaction_id']); ?></td>
                                <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['order_amount']))); ?></td>
                                <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['seller_amount']))); ?></td>
                                <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['admin_commission']))); ?></td>
                                <td><?php echo e($transaction['received_by']); ?></td>
                                <td><?php echo e($transaction['delivered_by']); ?></td>
                                <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['delivery_charge']))); ?></td>
                                <td><?php echo e(str_replace('_',' ',$transaction['payment_method'])); ?></td>
                                <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($transaction['tax']))); ?></td>
                                <td>
                                    <?php if($transaction['status'] == 'disburse'): ?>
                                        <span class="badge badge-soft-success  ">

                                                    <?php echo e($transaction['status']); ?>

                                            </span>
                                    <?php else: ?>
                                        <span class="badge badge-soft-warning ">
                                                <?php echo e($transaction['status']); ?>

                                            </span>
                                    <?php endif; ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                    <?php if(count($transactions)==0): ?>
                        <div class="text-center p-4">
                            <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg"
                                 alt="Image Description" style="width: 7rem;">
                            <p class="mb-0"><?php echo e(\App\CPU\translate('No_data_to_show')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer">
                <?php echo e($transactions->links()); ?>

            </div>

        </div>
        

        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/transaction/list.blade.php ENDPATH**/ ?>