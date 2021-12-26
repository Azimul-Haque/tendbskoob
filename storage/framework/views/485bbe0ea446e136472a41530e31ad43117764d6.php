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
                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"/>
        </div>
        <div class="flash_deal_product_details pl-2 pr-1 d-flex align-items-center">
            <div>
                <h6 class="flash-product-title">
                    <?php echo e(\Illuminate\Support\Str::limit($product['name_bangla'],20)); ?>          
                </h6><br/>
                <?php if($product->writers->count() > 0): ?>
                    <small><?php echo e($product->writers[0]->name_bangla); ?></small>
                <?php elseif($product->translators->count() > 0): ?>
                    <small><?php echo e($product->translators[0]->name_bangla); ?></small>
                <?php elseif($product->editors->count() > 0): ?>
                    <small><?php echo e($product->editors[0]->name_bangla); ?></small>
                <?php endif; ?>
                <div class="flash-product-price">
                    ৳ <?php echo e(number_format($product->unit_price, 0)); ?>

                    <?php if($product->published_price > $product->unit_price): ?>
                        <strike
                            style="font-size: 12px!important;color: grey!important;">
                            ৳ <?php echo e(number_format($product->published_price, 0)); ?>

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