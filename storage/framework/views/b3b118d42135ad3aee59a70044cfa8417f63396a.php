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
        <li class="list-group-item" onclick="$('.search_form').submit()">
            <a href="javascript:" onmouseover="$('.search-bar-input-mobile').val('<?php echo e($product['name']); ?>');$('.search-bar-input').val('<?php echo e($product['name']); ?>');">
                <?php echo e($product['name_bangla']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/partials/_search-result.blade.php ENDPATH**/ ?>