<?php if($category->childes->count()>0): ?>
    <?php $__currentLoopData = $category->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3 mt-4">
            <label class="text-center"
                   onclick="location.href='<?php echo e(route('products',['id'=> $c['id'],'data_from'=>'category','page'=>1])); ?>'"
                   style="padding: 10px;border: 1px solid #0000001f;width: 100%;cursor: pointer;background: white">
                <?php echo e($c['name_bangla']); ?>

            </label>
            <ul class="list-group">
                <?php $__currentLoopData = $c->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item" style="cursor: pointer"
                        onclick="location.href='<?php echo e(route('products',['id'=> $child['id'],'data_from'=>'category','page'=>1])); ?>'">
                        <?php echo e($child['name_bangla']); ?>

                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="col-md-12 text-center mt-5">
        <a href="<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>" class="btn btn-primary"><?php echo e(\App\CPU\translate('View Products')); ?></a>
    </div>
<?php endif; ?>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/partials/_category-list-ajax.blade.php ENDPATH**/ ?>