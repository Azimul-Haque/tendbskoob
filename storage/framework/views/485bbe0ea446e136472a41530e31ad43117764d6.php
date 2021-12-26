<?php ($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews)); ?>
<div class="flash_deal_product rtl" style="cursor: pointer;"
     onclick="location.href='<?php echo e(route('product',$product->slug)); ?>'">
    <?php if($product->discount > 0): ?>
        <div class="discount-top-f">
            <span class="for-discoutn-value pl-1 pr-1">
                <?php if($product->discount_type == 'percent'): ?>
                    <?php echo e(round($product->discount)); ?>%
                <?php elseif($product->discount_type =='flat'): ?>
                    <?php echo e(\App\CPU\Helpers::currency_converter($product->discount)); ?>

                <?php endif; ?> <?php echo e(\App\CPU\translate('off')); ?>

            </span>
        </div>
    <?php endif; ?>
    <div class=" d-flex">
        <div class="d-flex align-items-center justify-content-center"
             style="min-width: 110px">
            <img style="height: 130px!important; width: 91px!important;"
                 src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"/>
        </div>
        <div class="flash_deal_product_details pl-2 pr-1 d-flex align-items-center">
            <div>
                <h6 class="flash-product-title">
                    <?php echo e($product['name']); ?>

                </h6>
                <div class="flash-product-price">
                    <?php echo e(\App\CPU\Helpers::currency_converter($product->unit_price-\App\CPU\Helpers::get_product_discount($product,$product->unit_price))); ?>

                    <?php if($product->discount > 0): ?>
                        <strike
                            style="font-size: 12px!important;color: grey!important;">
                            <?php echo e(\App\CPU\Helpers::currency_converter($product->unit_price)); ?>

                        </strike>
                    <?php endif; ?>
                </div>
                <h6 class="flash-product-review">
                    <?php for($inc=0;$inc<5;$inc++): ?>
                        <?php if($inc<$overallRating[0]): ?>
                            <i class="sr-star czi-star-filled active"></i>
                        <?php else: ?>
                            <i class="sr-star czi-star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <label class="badge-style2">
                        ( <?php echo e($product->reviews->count()); ?> )
                    </label>
                </h6>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/partials/_product-card-1.blade.php ENDPATH**/ ?>