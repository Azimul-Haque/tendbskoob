<?php $__env->startSection('title', \App\CPU\translate('Withdraw Request')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Withdraw')); ?>  </li>
            </ol>
        </nav>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(\App\CPU\translate('Withdraw Request Table')); ?></h5>
                        <select name="withdraw_status_filter" onchange="status_filter(this.value)" class="custom-select float-right" style="width: 200px">
                            <option value="all" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all'?'selected':''); ?>><?php echo e(\App\CPU\translate('All')); ?></option>
                            <option value="approved" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved'?'selected':''); ?>><?php echo e(\App\CPU\translate('Approved')); ?></option>
                            <option value="denied" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied'?'selected':''); ?>><?php echo e(\App\CPU\translate('Denied')); ?></option>
                            <option value="pending" <?php echo e(session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending'?'selected':''); ?>><?php echo e(\App\CPU\translate('Pending')); ?></option>

                        </select>
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
                                    <th><?php echo e(\App\CPU\translate('amount')); ?></th>
                                    
                                    <th><?php echo e(\App\CPU\translate('Name')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('request_time')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('status')); ?></th>
                                    <th style="width: 5px"><?php echo e(\App\CPU\translate('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $withdraw_req; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$wr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td scope="row"><?php echo e($withdraw_req->firstItem()+$k); ?></td>
                                        <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($wr['amount']))); ?></td>
                                        
                                        <td>
                                            <a href="<?php echo e(route('admin.sellers.view',$wr->seller_id)); ?>"><?php echo e($wr->seller->f_name . ' ' . $wr->seller->l_name); ?></a>
                                        </td>
                                        <td><?php echo e($wr->created_at); ?></td>
                                        <td>
                                            <?php if($wr->approved==0): ?>
                                                <label class="badge badge-primary"><?php echo e(\App\CPU\translate('Pending')); ?></label>
                                            <?php elseif($wr->approved==1): ?>
                                                <label class="badge badge-success"><?php echo e(\App\CPU\translate('Approved')); ?></label>
                                            <?php else: ?>
                                                <label class="badge badge-danger"><?php echo e(\App\CPU\translate('Denied')); ?></label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.sellers.withdraw_view',[$wr['id'],$wr->seller['id']])); ?>"
                                               class="btn btn-primary btn-sm">
                                                <?php echo e(\App\CPU\translate('View')); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php if(count($withdraw_req)==0): ?>
                                <div class="text-center p-4">
                                    <img class="mb-3"
                                         src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg"
                                         alt="Image Description" style="width: 7rem;">
                                    <p class="mb-0"><?php echo e(\App\CPU\translate('No_data_to_show')); ?></p>
                                </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php echo e($withdraw_req->links()); ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>
  <script>
      function status_filter(type) {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.post({
              url: '<?php echo e(route('admin.withdraw.status-filter')); ?>',
              data: {
                  withdraw_status_filter: type
              },
              beforeSend: function () {
                  $('#loading').show()
              },
              success: function (data) {
                 location.reload();
              },
              complete: function () {
                  $('#loading').hide()
              }
          });
      }
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/seller/withdraw.blade.php ENDPATH**/ ?>