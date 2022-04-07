<?php $__env->startSection('title', $seller->name? $seller->name : \App\CPU\translate("Shop Name")); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard.index')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Seller_Edit')); ?></li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="<?php echo e(route('admin.sellers.seller-list')); ?>" class="btn btn-primary mt-3 mb-3"><?php echo e(\App\CPU\translate('Back_to_seller_list')); ?></a>
            </div>
            <div>
                <?php if($seller->status=="pending"): ?>
                    <div class="mt-4 pr-2 float-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>">
                        <div class="flex-start">
                            <h4 class="mx-1"><i class="tio-shop-outlined"></i></h4>
                            <div><h4><?php echo e(\App\CPU\translate('Seller_request_for_open_a_shop.')); ?></h4></div>
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
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <div class=" gx-2 gx-lg-3 mb-2">
                    <div>
                        <h4><i style="font-size: 30px"
                               class="tio-edit"></i><?php echo e(\App\CPU\translate('Seller_Edit')); ?></h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-2">
                                <form class="user mt-4" action="<?php echo e(route('shop.apply')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <h5 class="black">প্রকাশনী সম্পর্কিত তথ্যাদি</h5>
                                    <div class="form-group row">
                                        <div class="col-md-4 mb-3 mb-sm-0">
                                            <label for="name">প্রকাশনীর নাম</label>
                                            <input type="text" class="form-control form-control-user" id="name" name="name" value="<?php echo e($seller->name); ?>" placeholder="Din Publications" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address">প্রকাশনীর ঠিকানা</label>
                                            <input type="text" class="form-control form-control-user" id="address" name="address" value="<?php echo e($seller->address); ?>" placeholder="Banglabazar, Dhaka" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address">প্রকাশনীর লোগো <span style="color:red;">(অনুপাত - ১ঃ১)</span></label>
                                            <div class="form-group">
                                                <div class="custom-file" style="text-align: left">
                                                    <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .bmp, .tiff|image/*">
                                                    <label class="custom-file-label" for="customFileUpload"><?php echo e(\App\CPU\translate('Upload')); ?> <?php echo e(\App\CPU\translate('image')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 mb-3 mb-sm-0 mt-0">
                                            <label for="description">আপনার প্রকাশনী সম্পর্কে কিছু বলুন</label><br/>
                                            <textarea name="description" id="description" style="width: 100%; height: 220px;" placeholder="আপনার প্রকাশনী সম্পর্কে কিছু বলুন" required><?php echo e($seller->description); ?></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="collection_point">বই সংগ্রহ করার পয়েন্ট</label>
                                                    <select name="collection_point" id="collection_point" class="form-control form-control-user">
                                                        <option selected disabled>নির্বাচন করুন</option>
                                                        <option value="বাংলাবাজার" <?php if($seller->collection_point == 'বাংলাবাজার'): ?> selected <?php endif; ?>>বাংলাবাজার</option>
                                                        <option value="কাঁটাবন" <?php if($seller->collection_point == 'কাঁটাবন'): ?> selected <?php endif; ?>>কাঁটাবন</option>
                                                        <option value="মিরপুর (হেড অফিস)" <?php if($seller->collection_point == 'মিরপুর (হেড অফিস)'): ?> selected <?php endif; ?>>মিরপুর (হেড অফিস)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label for="payment_number">পেমেন্ট গ্রহণ করার জন্য আপনার নম্বরটি দিন</label>
                                                    <input type="number" class="form-control form-control-user" id="payment_number" name="payment_number" value="<?php echo e($seller->payment_number); ?>" placeholder="01712345678" maxlength="11" required>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label for="payment_option">আপনার নম্বরটি কোন সেবার আওতাধীন?</label>
                                                    <select name="payment_option" id="payment_option" class="form-control form-control-user">
                                                        <option selected disabled>নির্বাচন করুন</option>
                                                        <option value="বিকাশ" <?php if($seller->payment_option == 'বিকাশ'): ?> selected <?php endif; ?>>বিকাশ</option>
                                                        <option value="নগদ" <?php if($seller->payment_option == 'নগদ'): ?> selected <?php endif; ?>>নগদ</option>
                                                        <option value="রকেট" <?php if($seller->payment_option == 'রকেট'): ?> selected <?php endif; ?>>রকেট</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 mb-3 mb-sm-0">
                                            <label for="email">আপনার ই-মেইল</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="<?php echo e($seller->email); ?>" placeholder="bdjp@booksbd.net" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password">আপনার পাসওয়ার্ড দিন <span style="color:red;">(পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)</span></label>
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="পাসওয়ার্ড লিখুন (পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)" autocomplete="off">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password_confirmation ">আপনার পাসওয়ার্ডটি পুনরায় দিন <span style="color:red;">(পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)</span></label>
                                            <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="পুনরায় পাসওয়ার্ড লিখুন (পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="pb-1 mb-2">
                                            <center>
                                                <img style="width: auto;border: 1px solid; max-height:200px;" id="viewer"
                                                    src="<?php echo e(asset('public\assets\back-end\img\400x400\img2.jpg')); ?>" />
                                                <img style="width: auto;border: 1px solid; max-height:200px;" id="viewer" onerror="this.src='<?php echo e(asset('public\assets\back-end\img\400x400\img2.jpg')); ?>'" src="<?php echo e(asset('public/images/publisher/' . $seller['image'])); ?>" alt="Publisher Image">
                                            </center>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="apply">দাখিল করুন</button>
                                </form>
                                <hr>
                                <div class="text-center mt-4">
                                    আমাদের সাথে একাউন্ট আছে?  <a href="<?php echo e(route('seller.auth.login')); ?>" style="color: #339B38 !important;">সাইন ইন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/seller/edit.blade.php ENDPATH**/ ?>