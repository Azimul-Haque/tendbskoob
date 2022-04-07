<?php $__env->startSection('title', $seller->name? $seller->name : \App\CPU\translate("Shop Name")); ?>

<?php $__env->startPush('css_or_js'); ?>
<link href="<?php echo e(asset('public/assets/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Seller_Edit')); ?></li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e($seller->name); ?></li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="<?php echo e(route('admin.sellers.seller-list')); ?>" class="btn btn-primary mt-3 mb-3"><?php echo e(\App\CPU\translate('Back_to_seller_list')); ?></a>
            </div>
            <div>
                <h3>
                    Seller Status: 
                    <?php if($seller->status=="approved"): ?>
                        <span class="badge badge-success">Active</span>
                    <?php elseif($seller->status=="pending"): ?>
                        <span class="badge badge-info">Pending</span>
                    <?php elseif($seller->status=="suspended"): ?>
                        <span class="badge badge-danger">Suspended</span>
                    <?php elseif($seller->status=="rejected"): ?>
                        <span class="badge badge-danger">Rejected</span>
                    <?php endif; ?>
                </h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <div class=" gx-2 gx-lg-3 mb-2">
                    <div>
                        <h4><i style="font-size: 30px"
                               class="tio-edit"></i>সেলার এক্টিভেশন/সাসপেনশন পাতা</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($seller->status=="pending" || $seller->status=="rejected" || $seller->status=="suspended"): ?>
                                <form class="d-inline-block" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                    <input type="hidden" name="status" value="approved">
                                    <div class="form-group">
                                        <label for="publisher_id">পাবলিকেশার সেট করুন</label><br/>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control" name="publisher_id" id="publisher_id" required>
                                            <option value="<?php echo e(old('publisher_id')); ?>" selected disabled>Select Publication</option>
                                            <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($publisher['id']); ?>" <?php echo e(old('name_bangla')==$publisher['id']? 'selected': ''); ?>>
                                                    <?php echo e($publisher['name_bangla']); ?> (<?php echo e($publisher['name']); ?>)
                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Approve')); ?></button>
                                </form>

                                <?php if($seller->status != "rejected"): ?>
                                    <br/><br/>
                                    অথবা, রিজেক্ট করতে চাইলে নিচের বাটনে ক্লিক করুন<br/>
                                    <a class="btn btn-danger" href="javascript:"
                                    onclick="form_alert('seller-<?php echo e($seller['id']); ?>','নিশ্চিতভাবে এই সেলারকে রিজেক্ট করতে চান?')">
                                        <i class="tio-add-to-trash"></i> <?php echo e(\App\CPU\translate('Reject')); ?>

                                    </a>
                                    <form class="" id="seller-<?php echo e($seller['id']); ?>" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                        <input type="hidden" name="status" value="rejected">
                                        
                                    </form>
                                <?php endif; ?>
                            <?php elseif($seller->status == 'approved'): ?>
                                সাসপেন্ড করুন<br/>
                                <a class="btn btn-danger" href="javascript:"
                                onclick="form_alert('seller-suspend-<?php echo e($seller['id']); ?>','নিশ্চিতভাবে এই সেলারকে সাসপেন্ড করতে চান?')">
                                    <i class="tio-add-to-trash"></i> <?php echo e(\App\CPU\translate('Suspend')); ?>

                                </a>
                                <form class="d-inline-block" id="seller-suspend-<?php echo e($seller['id']); ?>" action="<?php echo e(route('admin.sellers.updateStatus')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($seller->id); ?>">
                                    <input type="hidden" name="status" value="suspended">
                                </form>
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
        function Validate(file) {
            var x;
            var le = file.length;
            var poin = file.lastIndexOf(".");
            var accu1 = file.substring(poin, le);
            var accu = accu1.toLowerCase();
            if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
                x = 1;
                return x;
            } else {
                x = 0;
                return x;
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        function readlogoURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerLogo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#LogoUpload").change(function () {
            readlogoURL(this);
        });
        $("#BannerUpload").change(function () {
            readBannerURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            // dir: "rtl",
            width: 'resolve'
        });

        $("#publisher_id").select2({
            placeholder: "Select Publication",
        });
        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/seller/approve.blade.php ENDPATH**/ ?>