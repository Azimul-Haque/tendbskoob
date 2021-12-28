<style>
    .list-group-item li, a {
        color: <?php echo e($web_config['primary_color']); ?>;
    }

    .list-group-item li, a:hover {
        color: <?php echo e($web_config['secondary_color']); ?>;
    }
</style>
<ul class="list-group list-group-flush">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item" onclick="$('.search_form').submit()" style="padding: .3rem 0rem!important;">
            <a href="<?php echo e(route('product', $product->slug)); ?> " 
                
                >
                <div class="row">
                    <div class="col-1">
                        <img src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                         style="">
                    </div>
                    <div class="col-9">
                        <?php echo e($product['name_bangla']); ?><br/>
                        <span style="color:grey;">
                            <?php if($product->writers->count() > 0): ?>
                                <?php echo e($product->writers[0]->name_bangla); ?>

                            <?php elseif($product->translators->count() > 0): ?>
                                <?php echo e($product->translators[0]->name_bangla); ?>

                            <?php elseif($product->editors->count() > 0): ?>
                                <?php echo e($product->editors[0]->name_bangla); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="col-2">
                        ৳ <?php echo e(number_format($product->unit_price, 0)); ?>

                    </div>
                </div>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/partials/_search-result.blade.php ENDPATH**/ ?>