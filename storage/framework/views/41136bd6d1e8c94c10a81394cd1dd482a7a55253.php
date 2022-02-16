<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($product['product_id'])): ?>
        <?php ($product=$product->product); ?>
    <?php endif; ?>
    <div class=" <?php echo e(Request::is('books*')?'col-lg-3 col-md-4 col-sm-4 col-6':'col-lg-2 col-md-3 col-sm-4 col-6'); ?> <?php echo e(Request::is('shopView*')?'col-lg-3 col-md-4 col-sm-4 col-6':''); ?> mb-2">
        <?php if(!empty($product)): ?>
            <?php echo $__env->make('web-views.partials._single-product',['p'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="col-12">
    <nav class="d-flexsss justify-content-between pt-2" aria-label="Page navigation"
         id="paginator-ajax">
        <?php echo $products->links(); ?>

    </nav>
</div>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/products/_ajax-products.blade.php ENDPATH**/ ?>