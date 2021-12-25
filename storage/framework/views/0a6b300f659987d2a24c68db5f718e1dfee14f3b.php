<ul class="list-group">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item">
            <a href="<?php echo e(url('/').'/'.$i['url']); ?>">
                <?php echo e($i['key']); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/partials/_search-result.blade.php ENDPATH**/ ?>