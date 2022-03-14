<?php $__env->startSection('title', \App\CPU\translate('Withdraw Request')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('seller.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
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
                                    <th><?php echo e(\App\CPU\translate('request_time')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('status')); ?></th>
                                    <th style="width: 5px"><?php echo e(\App\CPU\translate('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $withdraw_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$withdraw_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td scope="row"><?php echo e($withdraw_requests->firstitem()+$key); ?></td>
                                        <td><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($withdraw_request['amount']))); ?></td>
                                        <td><?php echo e(date("F jS, Y", strtotime($withdraw_request->created_at))); ?></td>
                                        <td>
                                            <?php if($withdraw_request->approved==0): ?>
                                                <label class="badge badge-primary"><?php echo e(\App\CPU\translate('Pending')); ?></label>
                                            <?php elseif($withdraw_request->approved==1): ?>
                                                <label class="badge badge-success"><?php echo e(\App\CPU\translate('Approved')); ?></label>
                                            <?php else: ?>
                                                <label class="badge badge-danger"><?php echo e(\App\CPU\translate('Denied')); ?></label>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($withdraw_request->approved==0): ?>
                                                <button id="<?php echo e(route('seller.business-settings.withdraw.cancel', [$withdraw_request['id']])); ?>"
                                                        onclick="close_request('<?php echo e(route('seller.business-settings.withdraw.cancel', [$withdraw_request['id']])); ?>')"
                                                   class="btn btn-primary btn-sm">
                                                    <?php echo e(\App\CPU\translate('close')); ?>

                                                </button>
                                            <?php else: ?>
                                                <span class="btn btn-primary btn-sm disabled">
                                                    <?php echo e(\App\CPU\translate('close')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php echo e($withdraw_requests->links()); ?>

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
              url: '<?php echo e(route('seller.business-settings.withdraw.status-filter')); ?>',
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

  <script>
      function close_request(route_name) {
          swal({
              title: "<?php echo e(\App\CPU\translate('Are you sure?')); ?>",
              text: "<?php echo e(\App\CPU\translate('Once deleted, you will not be able to recover this')); ?>",
              icon: "<?php echo e(\App\CPU\translate('warning')); ?>",
              buttons: true,
              dangerMode: true,
          })
              .then((willDelete) => {
                  if (willDelete) {
                      window.location.href = (route_name);
                  }
              });
      }
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app-seller', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/seller-views/withdraw/list.blade.php ENDPATH**/ ?>