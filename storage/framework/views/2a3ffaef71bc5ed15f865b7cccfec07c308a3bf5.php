<style>

    body {
        font-family: 'Titillium Web', sans-serif
    }

    .card {
        border: none
    }

    .totals tr td {
        font-size: 13px
    }

    .footer span {
        font-size: 12px
    }

    .product-qty span {
        font-size: 12px;
        color: #6A6A6A;
    }

    .font-name {
        font-weight: 600;
        font-size: 15px;
        color: #030303;
    }

    .sellerName {

        font-weight: 600;
        font-size: 14px;
        color: #030303;
    }

    .wishlist_product_img img {
        margin: 15px;
    }

    @media (max-width: 600px) {
        .font-name {
            font-size: 12px;
            font-weight: 400;
        }

        .amount {
            font-size: 12px;
        }
    }

    @media (max-width: 600px) {
        .wishlist_product_img {
            width: 20%;
        }

        .forPadding {
            padding: 6px;
        }

        .sellerName {

            font-weight: 400;
            font-size: 12px;
            color: #030303;
        }

        .wishlist_product_desc {
            width: 50%;
            margin-top: 0px !important;
        }

        .wishlist_product_icon {
            margin-left: 1px !important;
        }

        .wishlist_product_btn {
            width: 30%;
            margin-top: 10px !important;
        }

        .wishlist_product_img img {
            margin: 8px;
        }
    }
</style>
<?php if($wishlists->count()>0): ?>
    <?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php ($product = $wishlist->product); ?>
        <?php if( $wishlist->product): ?>
            <div class="card box-shadow-sm mt-2">
                <div class="product mb-2">
                    <div class="card">
                        <div class="row forPadding">
                            <div class="wishlist_product_img col-md-2 col-lg-2 col-sm-2">
                                <a href="<?php echo e(route('product',$product->slug)); ?>">
                                    <img
                                        src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                                        onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                                        style="height: 120px; width: auto;">
                                </a>
                            </div>
                            <div class="wishlist_product_desc col-md-8 mt-3">
                                <span class="font-name">
                                    <a href="<?php echo e(route('product',$product['slug'])); ?>"><big><?php echo e($product['name_bangla']); ?></big></a>
                                </span>
                                <br>
                                <span class="sellerName" style="color: #5C7CFF !important;"">
                                    <?php if($product->writers->count() > 0): ?>
                                        <?php echo e($product->writers[0]->name_bangla); ?>

                                    <?php elseif($product->translators->count() > 0): ?>
                                        <?php echo e($product->translators[0]->name_bangla); ?>

                                    <?php elseif($product->editors->count() > 0): ?>
                                        <?php echo e($product->editors[0]->name_bangla); ?>

                                    <?php endif; ?>
                                </span>
                                <div class="mt-2">
                                    <?php if($product->published_price > $product->unit_price): ?>
                                        <strike style="color: <?php echo e($web_config['secondary_color']); ?>;">
                                            ৳ <?php echo e(number_format($product->published_price, 0)); ?> 
                                        </strike>
                                    <?php endif; ?>
                                    <span class="h3 font-weight-normal text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>">
                                        ৳ <?php echo e(number_format($product->unit_price, 0)); ?>

                                    </span>
                                    <?php if($product->published_price > $product->unit_price): ?>
                                        <small>You save ৳ <?php echo e($product->published_price - $product->unit_price); ?> (<?php echo e(ceil(100 * (($product->published_price - $product->unit_price)/$product->published_price))); ?>%)</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div
                                class="wishlist_product_btn col-md-2 col-lg-2 col-sm-2 mt-5 float-right bodytr font-weight-bold"
                                style="color: #92C6FF;">

                                <a href="javascript:" class="wishlist_product_icon ml-2 pull-right mr-3">
                                    <i class="czi-close-circle" onclick="removeWishlist('<?php echo e($product['id']); ?>')"
                                       style="color: red"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <span class="badge badge-danger"><?php echo e(\App\CPU\translate('item_removed')); ?></span>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <center>
        <h6 class="text-muted">
            <?php echo e(\App\CPU\translate('No data found')); ?>.
        </h6>
    </center>
<?php endif; ?>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/partials/_wish-list-data.blade.php ENDPATH**/ ?>