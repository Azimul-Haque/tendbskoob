<?php
    if($product->writers->count() > 0){
        $bn_book_writer_for_title = $product->writers[0]->name_bangla;
        $en_book_writer_for_title = $product->writers[0]->name;
    } elseif($product->translators->count() > 0) {
        $bn_book_writer_for_title = $product->translators[0]->name_bangla;
        $en_book_writer_for_title = $product->translators[0]->name;
    } elseif($product->editors->count() > 0) {
        $bn_book_writer_for_title = $product->editors[0]->name_bangla;
        $en_book_writer_for_title = $product->editors[0]->name;
    } else {
        $bn_book_writer_for_title = '';
        $en_book_writer_for_title = '';
    }
?>

<?php $__env->startSection('title',$product['name_bangla'] . ':' . $bn_book_writer_for_title . ' - ' . $product['name'] . ':' . $en_book_writer_for_title . ' | Booksbd.net'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="description" content="<?php echo e($product['meta_description']); ?>">
    <meta name="keywords" content="<?php $__currentLoopData = explode(' ',$product['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
    <?php if($product->added_by=='seller'): ?>
        <meta name="author" content="<?php echo e($product->seller->shop?$product->seller->shop->name:$product->seller->f_name); ?>">
    <?php elseif($product->added_by=='admin'): ?>
        <meta name="author" content="<?php echo e($web_config['name']->value); ?>">
    <?php endif; ?>
    <!-- Viewport-->

    <?php if($product['meta_image']!=null): ?>
        <meta property="og:image" content="<?php echo e(asset("storage/app/public/product/meta")); ?>/<?php echo e($product->meta_image); ?>"/>
        <meta property="twitter:card"
              content="<?php echo e(asset("storage/app/public/product/meta")); ?>/<?php echo e($product->meta_image); ?>"/>
    <?php else: ?>
        <meta property="og:image" content="<?php echo e(asset("storage/app/public/product/thumbnail")); ?>/<?php echo e($product->thumbnail); ?>"/>
        <meta property="twitter:card"
              content="<?php echo e(asset("storage/app/public/product/thumbnail/")); ?>/<?php echo e($product->thumbnail); ?>"/>
    <?php endif; ?>

    <?php if($product['meta_title']!=null): ?>
        <meta property="og:title" content="<?php echo e($product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net'); ?>"/>
        <meta property="twitter:title" content="<?php echo e($product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net'); ?>"/>
    <?php else: ?>
        <meta property="og:title" content="<?php echo e($product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net'); ?>"/>
        <meta property="twitter:title" content="<?php echo e($product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net'); ?>"/>
    <?php endif; ?>
    <meta property="og:url" content="<?php echo e(route('product',[$product->slug])); ?>">

    <?php if($product['meta_description']!=null): ?>
        <meta property="twitter:description" content="<?php echo e('লেখকঃ ' . $bn_book_writer_for_title); ?>,  মূল্যঃ ৳ <?php echo e($product->unit_price); ?>, লিংকঃ <?php echo e(route('product',[$product->slug])); ?>, booksbd.net থেকে বইটি সংগ্রহ করুন booksbd.net থেকে">
        <meta property="og:description" content="<?php echo e('লেখকঃ ' . $bn_book_writer_for_title); ?>,  মূল্যঃ ৳ <?php echo e($product->unit_price); ?>, লিংকঃ <?php echo e(route('product',[$product->slug])); ?>, booksbd.net থেকে বইটি সংগ্রহ করুন booksbd.net থেকে">
    <?php else: ?>
        <meta property="og:description"
              content="<?php $__currentLoopData = explode(' ',$product['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
        <meta property="twitter:description"
              content="<?php $__currentLoopData = explode(' ',$product['name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($keyword.' , '); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>">
    <?php endif; ?>
    <meta property="twitter:url" content="<?php echo e(route('product',[$product->slug])); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front-end/css/product-details.css')); ?>"/>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    ?>
    <!-- Page Content-->
    <div class="container mt-4 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <!-- General info tab-->
        <div class="row" style="direction: ltr; border: 1px solid #e2f0ff; border-radius: 0px; background: white; box-shadow: 1px 1px 6px #00000014;">
            <!-- Product gallery-->
            <div class="col-lg-3 col-md-3" style="padding: 16px;">
                <div class="d-flex align-items-center">
                    <div style="border: 1px solid lightgrey; padding: 20px;">
                        <img class="img-responsive" style="max-height: 320px; width: auto;"
                        onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                        src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                        data-zoom="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                        alt="Product image" width="" onmousedown='return false;' onselectstart='return false;'>
                    </div>
                    
                </div>
            </div>
            <!-- Product details-->
            <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-3" style="direction: <?php echo e(Session::get('direction')); ?>; padding: 16px;">
                <div class="">
                    <h1 class="h3 mb-2" style="font-size: 22px;"><?php echo e($product->name_bangla); ?></h1>
                    <?php
                        $autor_html = '';
                        if($product->writers->count() > 0) {
                            for($i = 0; $i < count($product->writers); $i++){
                                $route = route('products',['id'=> $product->writers[$i]->id,'data_from'=>'author','page'=>1, 'author_name'=>$product->writers[$i]['slug']]);
                                $autor_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->writers[$i]->name_bangla . '</a>';
                                if($i < (count($product->writers) -1)){
                                    $autor_html .= ", ";
                                }
                            }
                        }    

                        if($product->translators->count() > 0) {
                            if($product->writers->count() > 0) {
                                $autor_html .= ", ";
                            }
                            for($i = 0; $i < count($product->translators); $i++){
                                $route = route('products',['id'=> $product->translators[$i]->id,'data_from'=>'author','page'=>1, 'author_name'=>$product->translators[$i]['slug']]);
                                $autor_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->translators[$i]->name_bangla . ' (অনুবাদক)</a>';
                                if($i < (count($product->translators) -1)){
                                    $autor_html .= ", ";
                                }
                            }
                        }

                        if($product->editors->count() > 0) {
                            if($product->writers->count() > 0 || $product->translators->count() > 0) {
                                $autor_html .= ", ";
                            }
                            for($i = 0; $i < count($product->editors); $i++){
                                $route = route('products',['id'=> $product->editors[$i]->id,'data_from'=>'author','page'=>1, 'author_name'=>$product->editors[$i]['slug']]);
                                $autor_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->editors[$i]->name_bangla . ' (সম্পাদক)</a>';
                                if($i < (count($product->editors) -1)){
                                    $autor_html .= ", ";
                                }
                            }
                        }
                    ?>
                    <?php echo $autor_html; ?><br/>

                    <div class="mb-2 mt-2">
                        Category:
                        <?php
                            $category_html = '';
                            if($product->categories->count() > 0) {
                                for($i = 0; $i < count($product->categories); $i++){
                                    $route = route('products',['id'=> $product->categories[$i]->id,'data_from'=>'category','page'=>1]);
                                    $category_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->categories[$i]->name_bangla . '</a>';
                                    if($i < (count($product->categories) -1)){
                                        $category_html .= ", ";
                                    }
                                }
                            }
                        ?>
                        <?php echo $category_html; ?>

                    </div>
                    <div class="d-flex align-items-center mb-2 pro">
                        
                        <div class="star-rating">
                            <?php for($inc=0;$inc<5;$inc++): ?>
                                <?php if($inc<$overallRating[0]): ?>
                                    <i class="sr-star czi-star-filled active"></i>
                                <?php else: ?>
                                    <i class="sr-star czi-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <span
                            class="font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 <?php echo e(Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'); ?>"><?php echo e($overallRating[1]); ?> <?php echo e(\App\CPU\translate('Reviews')); ?></span>
                        

                    </div>
                    <div class="mb-4 mt-4">
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

                    

                    
                    <form id="add-to-cart-form" class="mb-2">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <div class="position-relative <?php echo e(Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'); ?> mb-3">
                            <?php if($product->colors && count(json_decode($product->colors)) > 0): ?>
                                <div class="flex-start">
                                    <div class="mt-2"><?php echo e(\App\CPU\translate('color')); ?>:
                                    </div>
                                    <div>
                                        <ul class="list-inline checkbox-color mb-1 flex-start <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                            style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 0;">
                                            <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <li>
                                                        <input type="radio"
                                                               id="<?php echo e($product->id); ?>-color-<?php echo e($key); ?>"
                                                               name="color" value="<?php echo e($color); ?>"
                                                               <?php if($key == 0): ?> checked <?php endif; ?>>
                                                        <label style="background: <?php echo e($color); ?>;"
                                                               for="<?php echo e($product->id); ?>-color-<?php echo e($key); ?>"
                                                               data-toggle="tooltip"></label>
                                                    </li>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php
                                $qty = 0;
                                // if(!empty($product->variation)){
                                // foreach (json_decode($product->variation) as $key => $variation) {
                                //         $qty += $variation->qty;
                                //     }
                                // }
                            ?>
                        </div>
                        

                    <!-- Quantity + Add to cart -->
                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="mt-2"><?php echo e(\App\CPU\translate('Quantity')); ?>:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div
                                        class="input-group input-group--style-2 <?php echo e(Session::get('direction') === "rtl" ? 'pl-3' : 'pr-3'); ?>"
                                        style="width: 160px;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button"
                                                    data-type="minus" data-field="quantity"
                                                    disabled="disabled" style="padding: 10px">
                                                -
                                            </button>
                                        </span>
                                        <input type="text" name="quantity"
                                               class="form-control input-number text-center cart-qty-field"
                                               placeholder="1" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="plus"
                                                    data-field="quantity" style="padding: 10px">
                                               +
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-start no-gutters d-none mt-2" id="chosen_price_div">
                            <div class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>">
                                <div class=""><?php echo e(\App\CPU\translate('Total Price')); ?>:</div>
                            </div>
                            <div>
                                <div class="product-price for-total-price">
                                    <strong id="chosen_price"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                
                                <?php if($product['current_stock'] > 0): ?>
                                    <h5 class="mt-3" style="color: green"><img style="margin-right: 8px; width: 18px; height: auto;" src="<?php echo e(asset('public/assets/front-end/img/in-stock(mini).svg')); ?>"> <?php echo e(\App\CPU\translate('Book in Stock')); ?></h5>
                                <?php endif; ?>
                                <?php
                                    $category_names = [];
                                    if($product->categories->count() > 0) {
                                        for($i = 0; $i < count($product->categories); $i++){
                                            $category_names[] = $product->categories[$i]->name;
                                        }
                                    }
                                ?>
                                <?php if(in_array('Pre Order', $category_names)): ?>
                                    <label style="background-color: #FF9900 !important; color: #FFFFFF !important;" class="badge badge-danger stock-out">Pre Order</label><br/><br/>
                                <?php endif; ?>
                                <?php if(in_array('Pre Order', $category_names) && $product->release_date): ?>
                                    <br/><span style="color: #0300c4 !important;">প্রি-অর্ডারের এ বইটি <?php echo e(date('F d, Y', strtotime($product->release_date))); ?> তারিখে প্রকাশ পেতে পারে বলে প্রকাশনী থেকে জানানো হয়েছে। তবে বিশেষ কোন কারণে প্রকাশিত হওয়ার তারিখ পরিবর্তিত হতে পারে।</span><br/>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-flex
                        
                        mt-2">
                            
                            <?php if($product['stock_status'] == 3): ?>
                                <?php
                                    $book_details = 'লেখকঃ ' . $product->writers[0]->name_bangla . ', প্রকাশনীঃ ' . $product->publisher->name_bangla;
                                ?>
                                <a href="<?php echo e(route('book-request', ['book_name' => $product->name_bangla, 'book_details' => $book_details])); ?>" class="btn btn-success"><i class="fa fa-refresh"></i> বইটি অনুরোধ করুন</a>
                            <?php else: ?>
                                <button
                                    class="btn btn-primary element-center btn-gap-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>"
                                    onclick="addToCart()"
                                    type="button"
                                    style="width:37%; height: 45px; margin-right: 10px;">
                                    <i class="fa fa-cart-plus mr-2"></i>
                                    <span class="string-limit"><?php echo e(\App\CPU\translate('add_to_cart')); ?></span>
                                </button>
                                <button type="button" onclick="addWishlist('<?php echo e($product['id']); ?>')"
                                        class="btn btn-dark for-hover-bg"
                                        style="">
                                    <i class="fa fa-heart-o <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"
                                    aria-hidden="true"></i>
                                    <span class="countWishlist-<?php echo e($product['id']); ?>"><?php echo e($countWishlist); ?></span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr style="padding-bottom: 10px">
                    <div style="text-align:<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                         class="sharethis-inline-share-buttons"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3" style="background: #F6F6F6;" onmousedown='return false;' onselectstart='return false;'>
                <center style="padding: 10px;">
                    <h5><b>দৃষ্টি আকর্ষণ</b></h5>
                </center>
                <div style="font-size: 15px;">
                    ১। আলোর উৎস কিংবা ডিভাইসের কারণে বইয়ের প্রকৃত রং কিংবা পরিধি ভিন্ন হতে পারে।<br/><br/>
                    ২। যে কোন সময়, প্রকাশক কর্তৃক বইয়ের কাভার পরিবর্তন হতে পারে। সে ক্ষেত্রে পরিবর্তিত কাভারের বই প্রদান করা হবে।<br/><br/>
                    ৩। ওয়েবসাইটে কাভারের ছবি আপলোড করার সুবিধার্থে আমরা একটি নিদির্ষ্ট সাইজ ব্যবহার করে থাকি। যেকারণে ওয়েবসাইটে দেওয়া কাভারের ছবির সাইজের সাথে প্রকৃত বইয়ের সাইজ ভিন্ন হতে পারে।<br/><br/>
                    ৪। বই অর্ডার করার পূর্বে, অনুগ্রহ পূর্বক আমাদের টার্মস এন্ড কন্ডিশনসগুলো (<a href="<?php echo e(route('terms')); ?>" style="color: #5C7CFF !important;">Terms & Conditions</a>) ভালো করে পড়ে নেওয়ার অনুরোধ রইলো।
                </div>
            </div>
        </div>
    </div>

    
    <?php if($product->added_by=='seller'): ?>
        
    <?php else: ?>
        
    <?php endif; ?>

    
    <div class="container mt-4 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row" style="background: white">
            <div class="col-12">
                <div class="product_overview mt-1">
                    <!-- Tabs-->
                    <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#overview" data-toggle="tab" role="tab"
                               style="color: black !important;">
                                <?php echo e(\App\CPU\translate('OVERVIEW')); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reviews" data-toggle="tab" role="tab"
                               style="color: black !important;">
                                <?php echo e(\App\CPU\translate('REVIEWS')); ?>

                            </a>
                        </li>
                    </ul>
                    <div class="px-4 pt-lg-3 pb-3 mb-3">
                        <div class="tab-content px-lg-3">
                            <!-- Tech specs tab-->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="row pt-2 specification">
                                    <?php if($product->video_url!=null): ?>
                                        <div class="col-12 mb-4">
                                            <iframe width="420" height="315"
                                                    src="<?php echo e($product->video_url); ?>">
                                            </iframe>
                                        </div>
                                    <?php endif; ?>

                                    <div class="col-lg-5 col-md-5">
                                        <table class="table table-hover table-bordered table-nowrap table-align-middle card-table">
                                            <tbody>
                                                <tr>
                                                    <th>বই</th>
                                                    <td><?php echo e($product->name_bangla); ?><br/> <?php echo e($product->name); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>লেখক</th>
                                                    <td><?php echo $autor_html; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>প্রকাশনী</th>
                                                    <td><a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="<?php echo e(route('products',['id'=> $product->publisher_id,'data_from'=>'publisher','page'=>1, 'publisher_name'=>$product->publisher['slug']])); ?>"><?php echo e($product->publisher->name_bangla); ?></a></td>
                                                </tr>
                                                <tr>
                                                    <th>আইএসবিএন (ISBN)</th>
                                                    <td><?php echo e($product->isbn); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-7 col-md-7" onmousedown='return false;' onselectstart='return false;' style="-webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">
                                        <?php echo $product['details']; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Reviews tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="row pt-2 pb-3">
                                    <div class="col-lg-4 col-md-5 ">
                                        <h2 class="overall_review mb-2"><?php echo e($overallRating[1]); ?>

                                            &nbsp<?php echo e(\App\CPU\translate('Reviews')); ?> </h2>
                                        <div
                                            class="star-rating <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>">
                                            <?php if(round($overallRating[0])==5): ?>
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <i class="czi-star-filled font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                            <?php if(round($overallRating[0])==4): ?>
                                                <?php for($i = 0; $i < 4; $i++): ?>
                                                    <i class="czi-star-filled font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                                <i class="czi-star font-size-sm text-muted <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                            <?php endif; ?>
                                            <?php if(round($overallRating[0])==3): ?>
                                                <?php for($i = 0; $i < 3; $i++): ?>
                                                    <i class="czi-star-filled font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                                <?php for($j = 0; $j < 2; $j++): ?>
                                                    <i class="czi-star font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                            <?php if(round($overallRating[0])==2): ?>
                                                <?php for($i = 0; $i < 2; $i++): ?>
                                                    <i class="czi-star-filled font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                                <?php for($j = 0; $j < 3; $j++): ?>
                                                    <i class="czi-star font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                            <?php if(round($overallRating[0])==1): ?>
                                                <?php for($i = 0; $i < 4; $i++): ?>
                                                    <i class="czi-star font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                                <i class="czi-star-filled font-size-sm text-accent <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                            <?php endif; ?>
                                            <?php if(round($overallRating[0])==0): ?>
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <i class="czi-star font-size-sm text-muted <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                        <span class="d-inline-block align-middle">
                                    <?php echo e($overallRating[0]); ?> <?php echo e(\App\CPU\translate('Overall')); ?> <?php echo e(\App\CPU\translate('rating')); ?>

                                </span>
                                    </div>
                                    <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><span
                                                    class="d-inline-block align-middle text-muted"><?php echo e(\App\CPU\translate('5')); ?></span><i
                                                    class="czi-star-filled font-size-xs <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted <?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                                        <?php echo e($rating[0]); ?>

                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><span
                                                    class="d-inline-block align-middle text-muted"><?php echo e(\App\CPU\translate('4')); ?></span><i
                                                    class="czi-star-filled font-size-xs <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                         aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted <?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                                       <?php echo e($rating[1]); ?>

                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><span
                                                    class="d-inline-block align-middle text-muted"><?php echo e(\App\CPU\translate('3')); ?></span><i
                                                    class="czi-star-filled font-size-xs ml-1"></i></div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                         aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted <?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                                        <?php echo e($rating[2]); ?>

                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><span
                                                    class="d-inline-block align-middle text-muted"><?php echo e(\App\CPU\translate('2')); ?></span><i
                                                    class="czi-star-filled font-size-xs <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                         aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted <?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                                    <?php echo e($rating[3]); ?>

                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="text-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><span
                                                    class="d-inline-block align-middle text-muted"><?php echo e(\App\CPU\translate('1')); ?></span><i
                                                    class="czi-star-filled font-size-xs <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                         aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted <?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                                       <?php echo e($rating[4]); ?>

                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-4 pb-4 mb-3">
                                <div class="row pb-4">
                                    <div class="col-12">
                                        <?php $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="single_product_review p-2" style="margin-bottom: 20px">
                                                <div class="product-review d-flex justify-content-between">
                                                    <div
                                                        class="d-flex mb-3 <?php echo e(Session::get('direction') === "rtl" ? 'pl-5' : 'pr-5'); ?>">
                                                        <div
                                                            class="media media-ie-fix align-items-center <?php echo e(Session::get('direction') === "rtl" ? 'ml-4 pl-2' : 'mr-4 pr-2'); ?>">
                                                            <img style="max-height: 64px;"
                                                                 class="rounded-circle" width="64"
                                                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                                                 src="<?php echo e(asset("storage/app/public/profile")); ?>/<?php echo e((isset($productReview->user)?$productReview->user->image:'')); ?>"
                                                                 alt="<?php echo e(isset($productReview->user)?$productReview->user->f_name:'not exist'); ?>" onmousedown='return false;' onselectstart='return false;'/>
                                                            <div
                                                                class="media-body <?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">
                                                                <h6 class="font-size-sm mb-0"><?php echo e(isset($productReview->user)?$productReview->user->f_name:'not exist'); ?></h6>
                                                                <div class="d-flex justify-content-between">
                                                                    <div
                                                                        class="product_review_rating"><?php echo e($productReview->rating); ?></div>
                                                                    <div class="star-rating">
                                                                        <?php for($inc=0;$inc<5;$inc++): ?>
                                                                            <?php if($inc<$productReview->rating): ?>
                                                                                <i class="sr-star czi-star-filled active"></i>
                                                                            <?php else: ?>
                                                                                <i class="sr-star czi-star"></i>
                                                                            <?php endif; ?>
                                                                        <?php endfor; ?>
                                                                    </div>
                                                                </div>

                                                                <div class="font-size-ms text-muted">
                                                                    <?php echo e($productReview->created_at->format('M d Y')); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="font-size-md mt-3 mb-2"><?php echo e($productReview->comment); ?></p>
                                                        <?php if(!empty(json_decode($productReview->attachment))): ?>
                                                            <?php $__currentLoopData = json_decode($productReview->attachment); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <img
                                                                    style="cursor: pointer;border-radius: 5px;border:1px;border-color: #7a6969; height: 67px ; margin-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 5px;"
                                                                    onclick="showInstaImage('<?php echo e(asset("storage/app/public/review/$photo")); ?>')"
                                                                    class="cz-image-zoom"
                                                                    onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                                                    src="<?php echo e(asset("storage/app/public/review/$photo")); ?>"
                                                                    alt="Product review" width="67" onmousedown='return false;' onselectstart='return false;'>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($product->reviews)==0): ?>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="text-danger text-center"><?php echo e(\App\CPU\translate('product_review_not_available')); ?></h6>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product carousel (You may also like)-->
    <div class="container  mb-3 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="flex-between">
            <div class="feature_header">
                <span><?php echo e(\App\CPU\translate('similar_products')); ?></span>
            </div>

            <div class="view_all ">
                <div>
                    <?php ($category=json_decode($product['category_ids'])); ?>
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="<?php echo e(route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])); ?>"><?php echo e(\App\CPU\translate('view_all')); ?>

                        <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Grid-->
        <hr class="view_border">
        <!-- Product-->
        <div class="row mt-4">
            <?php if(count($relatedProducts)>0): ?>
                <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 20px">
                        <?php echo $__env->make('web-views.partials._single-product',['product'=>$relatedProduct], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-danger text-center"><?php echo e(\App\CPU\translate('similar')); ?> <?php echo e(\App\CPU\translate('product_not_available')); ?></h6>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
         aria-hidden="true" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="display: flex;justify-content: center">
                    <button class="btn btn-default"
                            style="border-radius: 50%;margin-top: -25px;position: absolute;<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: -7px;"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                    <img class="element-center" id="attachment-view" src="">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        // SET MAX VALUE
        // SET MAX VALUE
        $('.cart-qty-field').attr('max', 50);
        // SET MAX VALUE
        // SET MAX VALUE
        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
            // SET MAX VALUE
            // SET MAX VALUE
            $('.cart-qty-field').attr('max', 50);
            // SET MAX VALUE
            // SET MAX VALUE
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }
    </script>

    
    <script>
        $('#contact-seller').on('click', function (e) {
            // $('#seller_details').css('height', '200px');
            $('#seller_details').animate({'height': '276px'});
            $('#msg-option').css('display', 'block');
        });
        $('#sendBtn').on('click', function (e) {
            e.preventDefault();
            let msgValue = $('#msg-option').find('textarea').val();
            let data = {
                message: msgValue,
                shop_id: $('#msg-option').find('textarea').attr('shop-id'),
                seller_id: $('.msg-option').find('.seller_id').attr('seller-id'),
            }
            if (msgValue != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: '<?php echo e(route('messages_store')); ?>',
                    data: data,
                    success: function (respons) {
                        console.log('send successfully');
                    }
                });
                $('#chatInputBox').val('');
                $('#msg-option').css('display', 'none');
                $('#contact-seller').find('.contact').attr('disabled', '');
                $('#seller_details').animate({'height': '125px'});
                $('#go_to_chatbox').css('display', 'block');
            } else {
                console.log('say something');
            }
        });
        $('#cancelBtn').on('click', function (e) {
            e.preventDefault();
            $('#seller_details').animate({'height': '114px'});
            $('#msg-option').css('display', 'none');
        });
    </script>

    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
            async="async"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/products/details.blade.php ENDPATH**/ ?>