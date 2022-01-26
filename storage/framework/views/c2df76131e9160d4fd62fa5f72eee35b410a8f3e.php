<div class="feature_header">
    <span><?php echo e(\App\CPU\translate('shopping_cart')); ?></span>
</div>

<!-- Grid-->
<hr class="view_border">
<?php ($shippingMethod=\App\CPU\Helpers::get_business_settings('shipping_method')); ?>
<?php ($cart=\App\Model\Cart::where(['customer_id' => auth('customer')->id()])->get()->groupBy('cart_group_id')); ?>

<div class="row">
    <!-- List of items-->
    <section class="col-lg-8">
        <div class="cart_information">
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_key=>$group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_key=>$cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($cart_key==0): ?>
                        
                    <?php endif; ?>
                    <div class="cart_item mb-2">
                        <div class="row">
                            <div class="col-md-7 col-sm-6 col-9 d-flex align-items-center">
                                <div class="media">
                                    <div
                                        class="media-header d-flex justify-content-center align-items-center <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>">
                                        <a href="<?php echo e(route('product',$cartItem['slug'])); ?>">
                                            <img style="height: 82px;"
                                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                                 src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($cartItem['thumbnail']); ?>"
                                                 alt="Product">
                                        </a>
                                    </div>

                                    <div class="media-body d-flex justify-content-center align-items-center">
                                        <div class="cart_product">
                                            <div class="product-title">
                                                <a href="<?php echo e(route('product',$cartItem['slug'])); ?>"><?php echo e($cartItem['name_bangla']); ?></a><br/>
                                                <small><?php echo e($cartItem['author']); ?></small>
                                            </div>
                                            <div
                                                class=" text-accent"><?php echo e(\App\CPU\Helpers::currency_converter($cartItem['price']-$cartItem['discount'])); ?></div>
                                            <?php if($cartItem['discount'] > 0): ?>
                                                <strike style="font-size: 12px!important;color: grey!important;">
                                                    <?php echo e(\App\CPU\Helpers::currency_converter($cartItem['price'])); ?>

                                                </strike>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = json_decode($cartItem['variations'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 =>$variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="text-muted"><span
                                                        class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"><?php echo e($key1); ?> :</span><?php echo e($variation); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-2 col-3 d-flex align-items-center">
                                <div>
                                    <select name="quantity[<?php echo e($cartItem['id']); ?>]" id="cartQuantity<?php echo e($cartItem['id']); ?>"
                                            onchange="updateCartQuantity('<?php echo e($cartItem['id']); ?>')">
                                        <?php for($i = 1; $i <= 10; $i++): ?>
                                            <option
                                                value="<?php echo e($i); ?>" <?php echo e($cartItem['quantity'] == $i?'selected':''); ?>>
                                                <?php echo e($i); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div
                                class="col-md-4 col-sm-4 offset-4 offset-sm-0 text-center d-flex justify-content-between align-items-center">
                                <div class="">
                                    <div class=" text-accent">
                                        <?php echo e(\App\CPU\Helpers::currency_converter(($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])); ?>

                                    </div>
                                </div>
                                <div style="margin-top: 3px;">
                                    <button class="btn btn-link px-0 text-danger"
                                            onclick="removeFromCart(<?php echo e($cartItem['id']); ?>)" type="button"><i
                                            class="czi-close-circle <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($cart_key==$group->count()-1): ?>
                    <!-- choosen shipping method-->
                        <?php ($choosen_shipping=\App\Model\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first()); ?>
                        <?php if(isset($choosen_shipping)==false): ?>
                            <?php ($choosen_shipping['shipping_method_id']=0); ?>
                        <?php endif; ?>

                        <?php if($shippingMethod=='sellerwise_shipping'): ?>
                            <?php ($shippings=\App\CPU\Helpers::get_shipping_methods($cartItem['seller_id'],$cartItem['seller_is'])); ?>
                            <div class="row">
                                <div class="col-12">
                                    <select class="form-control"
                                            onchange="set_shipping_id(this.value,'<?php echo e($cartItem['cart_group_id']); ?>')">
                                        <option><?php echo e(\App\CPU\translate('choose_shipping_method')); ?></option>
                                        <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($shipping['id']); ?>" <?php echo e($choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''); ?>>
                                                <?php echo e($shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="mt-3"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($shippingMethod=='inhouse_shipping'): ?>
                <?php ($shippings=\App\CPU\Helpers::get_shipping_methods(1,'admin')); ?>
                <div class="row">
                    <div class="col-12">
                        <select class="form-control" onchange="set_shipping_id(this.value,'all_cart_group')">
                            <option><?php echo e(\App\CPU\translate('choose_shipping_method')); ?></option>
                            <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($shipping['id']); ?>" <?php echo e($choosen_shipping['shipping_method_id']==$shipping['id']?'selected':''); ?>>
                                    <?php echo e($shipping['title'].' ( '.$shipping['duration'].' ) '.\App\CPU\Helpers::currency_converter($shipping['cost'])); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( $cart->count() == 0): ?>
                <div class="d-flex justify-content-center align-items-center">
                    <h4 class="text-danger text-capitalize"><?php echo e(\App\CPU\translate('cart_empty')); ?></h4>
                </div>
            <?php endif; ?>
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
                    <i class="fa fa-<?php echo e(Session::get('direction') === "rtl" ? 'forward' : 'backward'); ?> px-1"></i> <?php echo e(\App\CPU\translate('continue_shopping')); ?>

                </a>
            </div>
            <div class="col-6">
                <a href="<?php echo e(route('checkout-details')); ?>"
                   class="btn btn-primary pull-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>" id="checkout-btn">
                    <?php echo e(\App\CPU\translate('checkout')); ?>

                    <i class="fa fa-<?php echo e(Session::get('direction') === "rtl" ? 'backward' : 'forward'); ?> px-1"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- Sidebar-->
    <?php echo $__env->make('web-views.partials._order-summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<script>
    cartQuantityInitialize();

    function set_shipping_id(id, cart_group_id) {

        $('#checkout-btn').hide();

        $.get({
            url: '<?php echo e(url('/')); ?>/customer/set-shipping-method',
            dataType: 'json',
            data: {
                id: id,
                cart_group_id: cart_group_id
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                location.reload();
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }
</script>
<?php /**PATH C:\wamp\www\booksbd\resources\views/layouts/front-end/partials/cart_details.blade.php ENDPATH**/ ?>