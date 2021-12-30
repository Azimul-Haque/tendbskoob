<?php ($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews)); ?>

<div class="product-card card <?php echo e($product['current_stock']==0?'stock-card':''); ?>"
     style="margin-bottom: 40px;display: flex; align-items: center; justify-content: center;">
    <?php if($product['current_stock']<=0): ?>
        <label style="left: 29%!important; top: 29%!important;"
               class="badge badge-danger stock-out"><?php echo e(\App\CPU\translate('stock_out')); ?></label>
    <?php endif; ?>

    <div class="card-header inline_product clickable" style="cursor: pointer;max-height: 193px;min-height: 193px">
        <?php if($product->discount > 0): ?>
            <div class="d-flex" style="right: 0;top:0;position: absolute">
                    <span class="for-discoutn-value pr-1 pl-1">
                    <?php if($product->discount_type == 'percent'): ?>
                            <?php echo e(round($product->discount,2)); ?>%
                        <?php elseif($product->discount_type =='flat'): ?>
                            <?php echo e(\App\CPU\Helpers::currency_converter($product->discount)); ?>

                        <?php endif; ?>
                        <?php echo e(\App\CPU\translate('off')); ?>

                    </span>
            </div>
        <?php else: ?>
            <div class="d-flex justify-content-end for-dicount-div-null">
                <span class="for-discoutn-value-null"></span>
            </div>
        <?php endif; ?>
        <div class="d-flex d-block center-div element-center" style="cursor: pointer">
            <a href="<?php echo e(route('product',$product->slug)); ?>">
                <img src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                     onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                     style="width: 90%;max-height: 215px!important;">
            </a>
        </div>
    </div>

    <div class="card-body inline_product text-center p-1 clickable"
         style="cursor: pointer; max-height:7.5rem;">
        
        <div style="position: relative;" class="product-title1">
            <a href="<?php echo e(route('product',$product->slug)); ?>">
                <?php echo e(\Illuminate\Support\Str::limit($product['name_bangla'], 25)); ?>

            </a><br/>
            <?php if($product->writers->count() > 0): ?>
                <small><?php echo e($product->writers[0]->name_bangla); ?></small>
            <?php elseif($product->translators->count() > 0): ?>
                <small><?php echo e($product->translators[0]->name_bangla); ?></small>
            <?php elseif($product->editors->count() > 0): ?>
                <small><?php echo e($product->editors[0]->name_bangla); ?></small>
            <?php endif; ?>
        </div>
        <div class="justify-content-between text-center">
            <div class="product-price text-center">
                
                <?php if($product->published_price > $product->unit_price): ?>
                    <strike style="font-size: 12px!important;color: grey!important;">
                        ৳ <?php echo e(number_format($product->published_price, 0)); ?>

                    </strike><br>
                <?php endif; ?>
                <span class="text-accent">
                    ৳ <?php echo e(number_format($product->unit_price, 0)); ?>

                </span>
            </div>
        </div>
    </div>

    <div class="card-body card-body-hidden" style="padding-bottom: 5px!important;">
        <div class="text-center">
            <?php if(Request::is('product/*')): ?>
                <a class="btn btn-primary btn-sm btn-block mb-2" href="<?php echo e(route('product',$product->slug)); ?>">
                    <i class="czi-forward align-middle <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                    <?php echo e(\App\CPU\translate('View')); ?>

                </a>
            <?php else: ?>
                <a class="btn btn-primary btn-sm btn-block mb-2" href="javascript:"
                   onclick="quickView('<?php echo e($product->id); ?>')">
                    <i class="czi-eye align-middle <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                    <?php echo e(\App\CPU\translate('Quick')); ?>   <?php echo e(\App\CPU\translate('View')); ?>

                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\booksbd\resources\views/web-views/partials/_single-product.blade.php ENDPATH**/ ?>