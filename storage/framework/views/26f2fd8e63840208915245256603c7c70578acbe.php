<?php $__env->startSection('title',\App\CPU\translate('All Authors Page')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta property="og:image" content="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e($web_config['web_logo']->value); ?>"/>
    <meta property="og:title" content="Author of <?php echo e($web_config['name']->value); ?> "/>
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:description" content="<?php echo substr($web_config['about']->value,0,100); ?>">

    <meta property="twitter:card" content="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e($web_config['web_logo']->value); ?>"/>
    <meta property="twitter:title" content="Author of <?php echo e($web_config['name']->value); ?>"/>
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:description" content="<?php echo substr($web_config['about']->value,0,100); ?>">
    <style>
        .brand_div {
            background: #fcfcfc no-repeat padding-box;
            border: 1px solid #e2f0ff;
            border-radius: 3px;
            opacity: 1;
            padding: 5px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <div class="col-md-3 p-3 feature_header">
                <span style="margin-right: 15px;"><?php echo e(\App\CPU\translate('Author')); ?></span> 
            </div>
            <div class="col-md-6 p-3 feature_header">
                <div>
                    <!-- Search -->
                    <form action="<?php echo e(url()->current()); ?>" method="GET">
                        <div class="input-group input-group-merge input-group-flush">
                            
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            <input id="" type="search" name="search" class="form-control"
                                placeholder="লেখক সার্চ করুন" value="<?php echo e(isset($search_param) ? $search_param : ''); ?>" required>
                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                        </div>
                    </form>
                    <!-- End Search -->
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <!-- Content  -->
            <section class="col-lg-12">
                <!-- Products grid-->
                <div class="row mx-n2">
                    <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-2 pb-4 text-center">
                            <a href="<?php echo e(route('products',['id'=> $author['id'],'data_from'=>'author','page'=>1, 'author_name'=>$author['slug']])); ?>" class="">
                                <div class="brand_div d-flex align-items-center justify-content-center"
                                 style="height: 200px">
                                    <?php if($author->image): ?>
                                        <img src="<?php echo e(asset("public/images/author/" . $author->image)); ?>" alt="<?php echo e($author->name); ?>" onerror="this.src='<?php echo e(asset('public/assets/front-end/img/user_demo.jpg')); ?>'" alt="<?php echo e($author->name_bangla); ?>" onmousedown='return false;' onselectstart='return false;'>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('public/assets/front-end/img/user_demo.jpg')); ?>" alt="<?php echo e($author->name_bangla); ?>" onmousedown='return false;' onselectstart='return false;'>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <small><?php echo e($author->name_bangla); ?></small>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <hr class="my-3">
                <div class="row mx-n2">
                    <div class="col-md-12">
                        <center>
                            <?php echo $authors->links(); ?>

                        </center>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/front-end')); ?>/vendor/nouislider/distribute/nouislider.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/web-views/authors.blade.php ENDPATH**/ ?>