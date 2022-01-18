<?php $__env->startSection('title',\App\CPU\translate('Support Ticket')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        .headerTitle {
            font-size: 24px;
            font-weight: 600;
            margin-top: 1rem;
        }

        body {
            font-family: 'Titillium Web', sans-serif
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .font-nameA {
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0;
            font-size: 17px;
            color: #030303;
        }

        .spandHeadO {
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px !important;

        }

        .tdBorder {
            border-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 1px solid #f7f0f0;
            text-align: center;
        }

        .bodytr {
            border: 1px solid #dadada;
            text-align: center;
        }

        .sellerName {
            font-size: 15px;
            font-weight: 600;
        }

        .modal-footer {
            border-top: none;
        }

        .sidebarL h3:hover + .divider-role {
            border-bottom: 3px solid <?php echo e($web_config['primary_color']); ?>                !important;
            transition: .2s ease-in-out;
        }

        .marl {
            margin-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 7px;
        }
        .badge-warning{
            color:white;
            background: <?php echo e($web_config['primary_color']); ?>;

        }
        .badge-secondary{
            color:white;
            background: <?php echo e($web_config['secondary_color']); ?>;
        }
        .badge-success {

        }

         .for-margin-sms{
            margin-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 56.3333333333%;
         }
         @media(max-width:475px){
            .for-margin-sms {
            margin-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 0.333333%;
           }
         }
        @media (max-width: 600px) {
            .sidebar_heading {
                background: <?php echo e($web_config['primary_color']); ?>

                }





            .sidebar_heading h1 {
                text-align: center;
                color: aliceblue;
                padding-bottom: 17px;
                font-size: 19px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Title-->
    <div class="container rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 sidebar_heading">
                <h1 class="h3  mb-0 float-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> headerTitle"><?php echo e(\App\CPU\translate('SUPPORT TICKET ANSWER')); ?></h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-3 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <!-- Sidebar-->
        <?php echo $__env->make('web-views.partials._profile-aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Content  -->
            <section class="col-lg-8">
                <!-- Toolbar-->
                <div
                    class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-4">
                    <div class="d-flex w-100 text-light text-center <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>">
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Date Submitted')); ?></div>
                            <div
                                class="opacity-60"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d')); ?></div>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Last Updated')); ?></div>
                            <div
                                class="opacity-60"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['updated_at'])->format('Y-m-d')); ?></div>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Type')); ?></div>
                            <div class="opacity-60"><?php echo e($ticket['type']); ?></div>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium" style="color:black"><?php echo e(\App\CPU\translate('Priority')); ?></div>
                            <span class="badge badge-warning"><?php echo e($ticket['priority']); ?></span>
                        </div>
                        <div class="font-size-ms px-3">
                            <div class="font-weight-medium" style="color: black"><?php echo e(\App\CPU\translate('Status')); ?></div>
                            <?php if($ticket['status']=='open'): ?>
                                <span class="badge badge-secondary"><?php echo e($ticket['status']); ?></span>
                            <?php else: ?>
                                <span class="badge badge-secondary"><?php echo e($ticket['status']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Ticket details (visible on mobile)-->
                <div class="d-flex d-lg-none flex-wrap bg-secondary text-center rounded-lg pt-4 px-4 pb-1 mb-4">
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Date Submitted')); ?></div>
                        <div
                            class="text-muted"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d')); ?></div>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Last Updated')); ?></div>
                        <div
                            class="text-muted"><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['updated_at'])->format('Y-m-d')); ?></div>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Type')); ?></div>
                        <div class="text-muted"><?php echo e($ticket['type']); ?></div>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Priority')); ?></div>
                        <span class="badge badge-warning"><?php echo e($ticket['priority']); ?></span>
                    </div>
                    <div class="font-size-sm px-3 pb-3">
                        <div class="font-weight-medium"><?php echo e(\App\CPU\translate('Status')); ?></div>
                        <?php if($ticket['status']=='open'): ?>
                            <span class="badge btn btn-secondary"><?php echo e($ticket['status']); ?></span>
                        <?php else: ?>
                            <span class="badge btn btn-secondary"><?php echo e($ticket['status']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Comment-->

                
                <div class="col-sm-6 col-lg-5 media pb-4  for-margin-sms">
                    <img class="rounded-circle" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>; height:40px; width:40px;"
                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                         src="<?php echo e(asset('storage/app/public/profile')); ?>/<?php echo e(auth('customer')->user()->image); ?>"
                         alt="<?php echo e(auth('customer')->user()->f_name); ?>"/>
                    <div class="media-body <?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">
                        <h6 class="font-size-md mb-2"><?php echo e(auth('customer')->user()->f_name); ?></h6>
                        <p class="font-size-md mb-1"><?php echo e($ticket['description']); ?></p>
                        <span class="font-size-ms text-muted">
                                 <i class="czi-time align-middle <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"></i>
                            <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$ticket['created_at'])->format('Y-m-d h:i A')); ?>

                        </span>
                    </div>
                </div>
                <?php $__currentLoopData = $ticket->conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if($conversation['customer_message'] == null ): ?>
                        <div class="media pb-4 ">
                            <div class="media-body <?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">
                                <?php ($admin=\App\Model\Admin::where('id',$conversation['admin_id'])->first()); ?>
                                <h6 class="font-size-md mb-2"><?php echo e($admin['name']); ?></h6>
                                <p class="font-size-md mb-1"><?php echo e($conversation['admin_message']); ?></p>
                                <span
                                    class="font-size-ms text-muted"> <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$conversation['updated_at'])->format('Y-m-d h:i A')); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($conversation['admin_message'] == null): ?>
                        <div class="col-sm-6 col-lg-5 media pb-4 for-margin-sms">
                            <img class="rounded-circle" height="40" width="40"
                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                 src="<?php echo e(asset('storage/app/public/profile')); ?>/<?php echo e(auth('customer')->user()->image); ?>"
                                 alt="<?php echo e(auth('customer')->user()->f_name); ?>"/>
                            <div class="media-body <?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">
                                <h6 class="font-size-md mb-2"><?php echo e(auth('customer')->user()->f_name); ?></h6>
                                <p class="font-size-md mb-1"><?php echo e($conversation['customer_message']); ?></p>
                                <span class="font-size-ms text-muted">
                                             <i class="czi-time align-middle <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"></i>
                                    <?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$conversation['created_at'])->format('Y-m-d h:i A')); ?>

                                </span>
                            </div>
                        </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!-- Leave message-->
                <div class="col-sm-12">
                    <h3 class="h5 mt-2 pt-4 pb-2"><?php echo e(\App\CPU\translate('Leave a Message')); ?></h3>
                    <form class="needs-validation" href="<?php echo e(route('support-ticket.comment',[$ticket['id']])); ?>"
                          method="post" novalidate>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <textarea class="form-control" name="comment" rows="8"
                                      placeholder="Write your message here..." required></textarea>
                            <div class="invalid-tooltip"><?php echo e(\App\CPU\translate('Please write the message')); ?>!</div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="">
                                <a href="<?php echo e(route('support-ticket.close',[$ticket['id']])); ?>" class="btn btn-secondary"
                                   style="color: white"><?php echo e(\App\CPU\translate('close')); ?></a>
                            </div>
                            <button class="btn btn-primary my-2" type="submit"><?php echo e(\App\CPU\translate('Submit message')); ?></button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/web-views/users-profile/ticket-view.blade.php ENDPATH**/ ?>