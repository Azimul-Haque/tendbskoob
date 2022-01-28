<?php $__env->startSection('title',\App\CPU\translate('Welcome To').' '.$web_config['name']->value); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta property="og:image" content="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e($web_config['web_logo']->value); ?>"/>
    <meta property="og:title" content="Welcome To <?php echo e($web_config['name']->value); ?> Home"/>
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:description" content="<?php echo substr($web_config['about']->value,0,100); ?>">

    <meta property="twitter:card" content="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e($web_config['web_logo']->value); ?>"/>
    <meta property="twitter:title" content="Welcome To <?php echo e($web_config['name']->value); ?> Home"/>
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:description" content="<?php echo substr($web_config['about']->value,0,100); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front-end')); ?>/css/home.css"/>
    <style>
        .media {
            background: white;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
        }

        .cz-countdown-days {
            color: white !important;
            background-color: <?php echo e($web_config['primary_color']); ?>;
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-hours {
            color: white !important;
            background-color: <?php echo e($web_config['primary_color']); ?>;
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-minutes {
            color: white !important;
            background-color: <?php echo e($web_config['primary_color']); ?>;
            padding: 0px 6px;
            border-radius: 3px;
            margin-right: 3px !important;
        }

        .cz-countdown-seconds {
            color: <?php echo e($web_config['primary_color']); ?>;
            border: 1px solid<?php echo e($web_config['primary_color']); ?>;
            padding: 0px 6px;
            border-radius: 3px !important;
        }

        .flash_deal_product_details .flash-product-price {
            font-weight: 700;
            font-size: 18px;
            color: <?php echo e($web_config['primary_color']); ?>;
        }

        .featured_deal_left {
            height: 130px;
            background: <?php echo e($web_config['primary_color']); ?> 0% 0% no-repeat padding-box;
            padding: 10px 13px;
            text-align: center;
        }

        .category_div:hover {
            color: <?php echo e($web_config['secondary_color']); ?>;
        }

        .deal_of_the_day {
            /* filter: grayscale(0.5); */
            opacity: .8;
            background: <?php echo e($web_config['secondary_color']); ?>;
            border-radius: 3px;
        }

        .deal-title {
            font-size: 12px;

        }

        .for-flash-deal-img img {
            max-width: none;
        }

        @media (max-width: 375px) {
            .cz-countdown {
                display: flex !important;

            }

            .cz-countdown .cz-countdown-seconds {

                margin-top: -5px !important;
            }

            .for-feature-title {
                font-size: 20px !important;
            }
        }

        @media (max-width: 600px) {
            .flash_deal_title {
                /*font-weight: 600;*/
                /*font-size: 18px;*/
                /*text-transform: uppercase;*/

                font-weight: 700;
                font-size: 25px;
                text-transform: uppercase;
            }

            .cz-countdown .cz-countdown-value {
                font-family: "Roboto", sans-serif;
                font-size: 11px !important;
                font-weight: 700 !important;
            }

            .featured_deal {
                opacity: 1 !important;
            }

            .cz-countdown {
                display: inline-block;
                flex-wrap: wrap;
                font-weight: normal;
                margin-top: 4px;
                font-size: smaller;
            }

            .view-btn-div-f {

                margin-top: 6px;
                float: right;
            }

            .view-btn-div {
                float: right;
            }

            .viw-btn-a {
                font-size: 10px;
                font-weight: 600;
            }


            .for-mobile {
                display: none;
            }

            .featured_for_mobile {
                max-width: 100%;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 360px) {
            .featured_for_mobile {
                max-width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .featured_deal {
                opacity: 1 !important;
            }
        }

        @media (max-width: 375px) {
            .featured_for_mobile {
                max-width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .featured_deal {
                opacity: 1 !important;
            }
        }

        @media (min-width: 768px) {
            .displayTab {
                display: block !important;
            }
        }

        @media (max-width: 800px) {
            .for-tab-view-img {
                width: 40%;
            }

            .for-tab-view-img {
                width: 105px;
            }

            .widget-title {
                font-size: 19px !important;
            }
        }

        .featured_deal_carosel .carousel-inner {
            width: 100% !important;
        }

        .badge-style2 {
            color: black !important;
            background: transparent !important;
            font-size: 11px;
        }
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front-end')); ?>/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/front-end')); ?>/css/owl.theme.default.min.css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero (Banners + Slider)-->
    <section class="bg-transparent mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-12">
                    <?php echo $__env->make('web-views.partials._home-top-slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </section>

    
    <?php ($flash_deals=\App\Model\FlashDeal::with(['products.product'])->where(['status'=>1])->where(['deal_type'=>'flash_deal'])->whereDate('start_date','<=',date('Y-m-d'))->whereDate('end_date','>=',date('Y-m-d'))->first()); ?>

    <?php if(isset($flash_deals)): ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row section-header fd rtl mx-0">
                        <div class="" style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 0">
                            <div class="d-inline-flex displayTab">
                                <span class="flash_deal_title ">
                                    <?php echo e($flash_deals['title']); ?>

                                </span>
                            </div>
                        </div>
                        <div class="" style="padding-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 0">
                            <div class="row view_all view-btn-div-f float-right mx-0">
                                <div class="<?php echo e(Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'); ?>">
                                    <span class="cz-countdown"
                                          data-countdown="<?php echo e(isset($flash_deals)?date('m/d/Y',strtotime($flash_deals['end_date'])):''); ?> 11:59:00 PM">
                                        <span class="cz-countdown-days">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-hours">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-minutes">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                        <span class="cz-countdown-value">:</span>
                                        <span class="cz-countdown-seconds">
                                            <span class="cz-countdown-value"></span>
                                        </span>
                                    </span>
                                </div>
                                <div class="">
                                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                                       href="<?php echo e(route('flash-deals',[isset($flash_deals)?$flash_deals['id']:0])); ?>"><?php echo e(\App\CPU\translate('view_all')); ?>

                                        <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme mt-2" id="flash-deal-slider">
                        <?php $__currentLoopData = $flash_deals->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if( $deal->product): ?>
                                <?php echo $__env->make('web-views.partials._product-card-1',['product'=>$deal->product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Products grid (featured products)-->
    <?php if(count($featured_products) > 0): ?>
        <section class="container rtl">
            <!-- Heading-->
            <div class="section-header">
                <div class="feature_header">
                    <span class="for-feature-title"><?php echo e(\App\CPU\translate('featured_products')); ?></span>
                </div>
                <div>
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="<?php echo e(route('products',['data_from'=>'featured','page'=>1])); ?>">
                        <?php echo e(\App\CPU\translate('view_all')); ?>

                        <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                    </a>
                </div>
            </div>
        
        <!-- Grid-->
            <div class="row mt-2 mb-3">
                <?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 20px">
                        <?php echo $__env->make('web-views.partials._single-product',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endif; ?>

    
    <?php ($featured_deals=\App\Model\FlashDeal::with(['products.product.reviews'])->where(['status'=>1])->where(['deal_type'=>'feature_deal'])->first()); ?>

    <?php if(isset($featured_deals)): ?>
        <section class="container featured_deal rtl">
            <div class="row">
                <div class="col-xl-3 col-md-4 right">
                    <div class="d-flex align-items-center justify-content-center featured_deal_left">
                        <h1 class="featured_deal_title"
                            style="padding-top: 12px"><?php echo e(\App\CPU\translate('featured_deal')); ?></h1>
                    </div>
                </div>

                <div class="col-xl-9 col-md-8">
                    <div class="owl-carousel owl-theme" id="web-feature-deal-slider">
                        <?php $__currentLoopData = $featured_deals->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web-views.partials._product-card-1',['product'=>$product->product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <div class="container rtl">
        <div class="row">
            
            <div class="col-xl-3 col-md-4 pb-4 mt-3">
                <div class="deal_of_the_day">
                    <?php if(isset($deal_of_the_day)): ?>
                        <h1 style="color: white"> <?php echo e(\App\CPU\translate('deal_of_the_day')); ?></h1>
                        <center>
                            <strong style="font-size: 21px!important;color: <?php echo e($web_config['primary_color']); ?>">
                                ৳ <?php echo e($deal_of_the_day->product->published_price - $deal_of_the_day->product->unit_price); ?>

                                <?php echo e(\App\CPU\translate('off')); ?>

                            </strong>
                        </center>
                        <div class="d-flex justify-content-center align-items-center" style="padding-top: 37px">
                            <img style="height: 206px;"
                                 src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($deal_of_the_day->product['thumbnail']); ?>"
                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                                 alt="" onmousedown='return false;' onselectstart='return false;'>
                        </div>
                        <div style="text-align: center; padding-top: 26px;">
                            <h5 style="font-weight: 600; color: <?php echo e($web_config['primary_color']); ?>">
                                <?php echo e(\Illuminate\Support\Str::limit($deal_of_the_day->product['name_bangla'],40)); ?><br/>
                                <?php if($deal_of_the_day->product->writers->count() > 0): ?>
                                    <small><?php echo e($deal_of_the_day->product->writers[0]->name_bangla); ?></small>
                                <?php elseif($deal_of_the_day->product->translators->count() > 0): ?>
                                    <small><?php echo e($deal_of_the_day->product->translators[0]->name_bangla); ?></small>
                                <?php elseif($deal_of_the_day->product->editors->count() > 0): ?>
                                    <small><?php echo e($deal_of_the_day->product->editors[0]->name_bangla); ?></small>
                                <?php endif; ?>
                            </h5>
                            <span class="text-accent">
                                ৳ <?php echo e(number_format($deal_of_the_day->product->unit_price, 0)); ?>

                            </span>
                            <?php if($deal_of_the_day->product->published_price > $deal_of_the_day->product->unit_price): ?>
                                <strike style="font-size: 12px!important;color: grey!important;">
                                    ৳ <?php echo e(number_format($deal_of_the_day->product->published_price, 0)); ?>

                                </strike>
                            <?php endif; ?>

                        </div>
                        <div class="pt-3 pb-2" style="text-align: center;">
                            <button class="buy_btn"
                                    onclick="location.href='<?php echo e(route('product',$deal_of_the_day->product->slug)); ?>'"><?php echo e(\App\CPU\translate('buy_now')); ?>

                            </button>
                        </div>
                    <?php else: ?>
                        <?php ($product=\App\Model\Product::active()->inRandomOrder()->first()); ?>
                        <?php if(isset($product)): ?>
                            <h1 style="color: white"> <?php echo e(\App\CPU\translate('recommended_product')); ?></h1>
                            <div class="d-flex justify-content-center align-items-center" style="padding-top: 55px">
                                <img style="height: 206px;"
                                     src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                                     onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                                     alt="" onmousedown='return false;' onselectstart='return false;'>
                            </div>
                            <div style="text-align: center; padding-top: 60px;" class="pb-2">
                                <button class="buy_btn" onclick="location.href='<?php echo e(route('product',$product->slug)); ?>'">
                                    <?php echo e(\App\CPU\translate('buy_now')); ?>

                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="container mt-2">
                    <div class="row p-0">
                        <div class="col-md-3 p-0 text-center mobile-padding mt-1 mt-md-0">
                            <img style="height: 29px;" src="<?php echo e(asset("public/assets/front-end/png/delivery.png")); ?>"
                                 alt="" onmousedown='return false;' onselectstart='return false;'>
                            <div class="deal-title">3 <?php echo e(\App\CPU\translate('days')); ?>

                                <br><span><?php echo e(\App\CPU\translate('free_delivery')); ?></span></div>
                        </div>
                        <div class="col-md-3 p-0 text-center mt-1 mt-md-0">
                            <img style="height: 29px;" src="<?php echo e(asset("public/assets/front-end/png/money.png")); ?>" alt="" onmousedown='return false;' onselectstart='return false;'>
                            <div class="deal-title"><?php echo e(\App\CPU\translate('money_back_guarantee')); ?></div>
                        </div>
                        <div class="col-md-3 p-0 text-center mt-1 mt-md-0">
                            <img style="height: 29px;" src="<?php echo e(asset("public/assets/front-end/png/Genuine.png")); ?>"
                                 alt="" onmousedown='return false;' onselectstart='return false;'>
                            <div class="deal-title">100% <?php echo e(\App\CPU\translate('genuine')); ?>

                                <br><span><?php echo e(\App\CPU\translate('product')); ?></span></div>
                        </div>
                        <div class="col-md-3 p-0 text-center mt-1 mt-md-0">
                            <img style="height: 29px;" src="<?php echo e(asset("public/assets/front-end/png/Payment.png")); ?>"
                                 alt="" onmousedown='return false;' onselectstart='return false;'>
                            <div class="deal-title"><?php echo e(\App\CPU\translate('authentic_payment')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-9 col-md-8">
                <div class="section-header">
                    <div class="feature_header">
                        <span class="for-feature-title"><?php echo e(\App\CPU\translate('latest_products')); ?></span>
                    </div>
                    <div>
                        <a class="btn btn-outline-accent btn-sm viw-btn-a"
                           href="<?php echo e(route('products',['data_from'=>'latest'])); ?>">
                            <?php echo e(\App\CPU\translate('view_all')); ?>

                            <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                        </a>
                    </div>
                </div>

                <div class="row mt-2 mb-3">
                    <?php $__currentLoopData = $latest_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-sm-4 col-6 mb-2">
                            <?php echo $__env->make('web-views.partials._single-product',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <section class="container rtl">
        <!-- Heading-->
        <div class="section-header">
            <div class="feature_header">
                <span><?php echo e(\App\CPU\translate('categories')); ?></span>
            </div>
            <div>
                <a class="btn btn-outline-accent btn-sm viw-btn-a"
                   href="<?php echo e(route('categories')); ?>"><?php echo e(\App\CPU\translate('view_all')); ?>

                    <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                </a>
            </div>
        </div>

        <div class="mt-2 mb-3 brand-slider">
            <div class="owl-carousel owl-theme " id="category-slider">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category_div" style="height: 132px; width: 100%;">
                        <a href="<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>">
                            <?php if($category['icon']): ?>
                                <img style="vertical-align: middle; padding: 16%;height: 100px"
                                src="<?php echo e(asset('public/images/category/' . $category['icon'])); ?>"
                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/category_demo.jpg')); ?>'"
                                 alt="<?php echo e($category->name_bangla); ?>" onmousedown='return false;' onselectstart='return false;'>
                            <?php else: ?>
                                <img style="vertical-align: middle; padding: 16%;height: 100px"
                                src="<?php echo e(asset('public/assets/front-end/img/category_demo.jpg')); ?>"
                                alt="<?php echo e($category->name_bangla); ?>" onmousedown='return false;' onselectstart='return false;'>
                            <?php endif; ?>
                            <p class="text-center small" style="margin-top: -10px"><?php echo e(\Illuminate\Support\Str::limit($category->name_bangla, 17)); ?></p>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section class="container rtl">
        <!-- Heading-->
        <div class="section-header">
            <div class="feature_header" style="color: black">
                <span> <?php echo e(\App\CPU\translate('Authors')); ?></span>
            </div>
            <div>
                <a class="btn btn-outline-accent btn-sm viw-btn-a" href="<?php echo e(route('brands')); ?>">
                    <?php echo e(\App\CPU\translate('view_all')); ?>

                    <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                </a>
            </div>
        </div>
    
    <!-- Grid-->
        <div class="mt-2 mb-3 brand-slider">
            <div class="owl-carousel owl-theme" id="brands-slider">
                <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="text-center">
                        <a href="<?php echo e(route('products',['id'=> $author['id'],'data_from'=>'author','page'=>1])); ?>">
                            <div class="brand_div d-flex align-items-center justify-content-center"
                                 style="height:100px">
                                <?php if($author->image): ?>
                                    <img src="<?php echo e(asset("public/images/author/" . $author->image)); ?>" alt="<?php echo e($author->name); ?>" onerror="this.src='<?php echo e(asset('public/assets/front-end/img/user_demo.jpg')); ?>'" onmousedown='return false;' onselectstart='return false;'>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('public/assets/front-end/img/user_demo.jpg')); ?>" onmousedown='return false;' onselectstart='return false;'>
                                <?php endif; ?>
                            </div>
                        </a>
                        <small><?php echo e($author->name_bangla); ?></small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- top sellers -->
    

    
    <?php $__currentLoopData = $home_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="container rtl">
            <!-- Heading-->
            <div class="section-header">
                <div class="feature_header">
                    <span class="for-feature-title"><?php echo e($category['name_bangla']); ?></span>
                </div>
                <div>
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>">
                        <?php echo e(\App\CPU\translate('view_all')); ?>

                        <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                    </a>
                </div>
            </div>

            <div class="row mt-2 mb-3">
                <?php $__currentLoopData = $category['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 10px">
                        <?php echo $__env->make('web-views.partials._single-product',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    <!-- Product widgets-->
    <section class="container pb-4 pb-md-5 rtl">
        <div class="row">
            <!-- Bestsellers-->
            <div class="col-12 col-sm-6 col-md-4 mb-2 py-3">
                <div class="widget">
                    <div class="d-flex justify-content-between">
                        <h3 class="widget-title"><?php echo e(\App\CPU\translate('best_sellings')); ?></h3>
                        <div>
                            <a class="btn btn-outline-accent btn-sm"
                               href="<?php echo e(route('products',['data_from'=>'best-selling','page'=>1])); ?>"><?php echo e(\App\CPU\translate('view_all')); ?>

                                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                            </a>
                        </div>
                    </div>
                    <?php $__currentLoopData = $bestSellProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$bestSell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($bestSell->product && $key<4): ?>
                            <div class="media align-items-center pt-2 pb-2 mb-1"
                                 data-href="<?php echo e(route('product',$bestSell->product->slug)); ?>">
                                <a class="d-block <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"
                                   href="<?php echo e(route('product',$bestSell->product->slug)); ?>">
                                    <img style="height: 77px; width: 54px"
                                         src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($bestSell->product['thumbnail']); ?>"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                                         alt="Product" onmousedown='return false;' onselectstart='return false;'/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a class="ptr"
                                           href="<?php echo e(route('product',$product->slug)); ?>">
                                            <?php echo e(\Illuminate\Support\Str::limit($bestSell->product['name_bangla'],30)); ?>

                                        </a><br/>
                                        <?php if($bestSell->product->writers->count() > 0): ?>
                                            <small><?php echo e($bestSell->product->writers[0]->name_bangla); ?></small>
                                        <?php elseif($bestSell->product->translators->count() > 0): ?>
                                            <small><?php echo e($bestSell->product->translators[0]->name_bangla); ?></small>
                                        <?php elseif($bestSell->product->editors->count() > 0): ?>
                                            <small><?php echo e($bestSell->product->editors[0]->name_bangla); ?></small>
                                        <?php endif; ?>
                                    </h6>
                                    <div class="widget-product-meta">
                                        <span class="text-accent">
                                            ৳ <?php echo e(number_format($bestSell->product->unit_price, 0)); ?>

                                            <?php if($bestSell->product->published_price > $bestSell->product->unit_price): ?>
                                                <strike style="font-size: 12px!important;color: grey!important;">
                                                    ৳ <?php echo e(number_format($bestSell->product->published_price, 0)); ?>

                                                </strike>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <!-- New arrivals-->
            <div class="col-12 col-sm-6 col-md-4 mb-2 py-3">
                <div class="widget">
                    <div class="d-flex justify-content-between">
                        <h3 class="widget-title"><?php echo e(\App\CPU\translate('new_arrivals')); ?></h3>
                        <div>
                            <a class="btn btn-outline-accent btn-sm"
                               href="<?php echo e(route('products',['data_from'=>'latest','page'=>1])); ?>"><?php echo e(\App\CPU\translate('view_all')); ?>

                                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i>
                            </a>
                        </div>
                    </div>
                    <?php $__currentLoopData = $latest_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key<4): ?>
                            <div class="media align-items-center pt-2 pb-2 mb-1"
                                 data-href="<?php echo e(route('product',$product->slug)); ?>">
                                <a class="d-block <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"
                                   href="<?php echo e(route('product',$product->slug)); ?>">
                                    <img style="height: 77px; width: 54px"
                                         src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                                         alt="Product" onmousedown='return false;' onselectstart='return false;'/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a class="ptr"
                                           href="<?php echo e(route('product',$product->slug)); ?>">
                                            <?php echo e(\Illuminate\Support\Str::limit($product['name_bangla'],30)); ?>

                                        </a><br/>
                                        <?php if($product->writers->count() > 0): ?>
                                            <small><?php echo e($product->writers[0]->name_bangla); ?></small>
                                        <?php elseif($product->translators->count() > 0): ?>
                                            <small><?php echo e($product->translators[0]->name_bangla); ?></small>
                                        <?php elseif($product->editors->count() > 0): ?>
                                            <small><?php echo e($product->editors[0]->name_bangla); ?></small>
                                        <?php endif; ?>
                                    </h6>
                                    <div class="widget-product-meta">
                                          <span class="text-accent">
                                            ৳ <?php echo e(number_format($product->unit_price, 0)); ?>

                                            <?php if($product->published_price > $product->unit_price): ?>
                                            <strike style="font-size: 12px!important;color: grey!important;">
                                                ৳ <?php echo e(number_format($product->published_price, 0)); ?>

                                            </strike>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <!-- Top rated-->
            <div class="col-12 col-sm-6 col-md-4 mb-2 py-3">
                <div class="widget">
                    <div class="d-flex justify-content-between">
                        <h3 class="widget-title"><?php echo e(\App\CPU\translate('top_rated')); ?></h3>
                        <div><a class="btn btn-outline-accent btn-sm"
                                href="<?php echo e(route('products',['data_from'=>'top-rated','page'=>1])); ?>"><?php echo e(\App\CPU\translate('view_all')); ?>

                                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'); ?>"></i></a>
                        </div>
                    </div>
                    <?php $__currentLoopData = $topRated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$top): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($top->product && $key<4): ?>
                            <div class="media align-items-center pt-2 pb-2 mb-1"
                                 data-href="<?php echo e(route('product',$top->product->slug)); ?>">
                                <a class="d-block <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"
                                   href="<?php echo e(route('product',$top->product->slug)); ?>">
                                    <img style="height: 77px; width: 54px"
                                         src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($top->product['thumbnail']); ?>"
                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/book_demo.jpg')); ?>'"
                                         alt="Product" onmousedown='return false;' onselectstart='return false;'/>
                                </a>
                                <div class="media-body">
                                    <h6 class="widget-product-title">
                                        <a class="ptr"
                                           href="<?php echo e(route('product',$top->product->slug)); ?>">
                                            <?php echo e(\Illuminate\Support\Str::limit($top->product['name_bangla'],30)); ?>

                                        </a><br/>
                                        <?php if($top->product->writers->count() > 0): ?>
                                            <small><?php echo e($top->product->writers[0]->name_bangla); ?></small>
                                        <?php elseif($top->product->translators->count() > 0): ?>
                                            <small><?php echo e($top->product->translators[0]->name_bangla); ?></small>
                                        <?php elseif($top->product->editors->count() > 0): ?>
                                            <small><?php echo e($top->product->editors[0]->name_bangla); ?></small>
                                        <?php endif; ?>
                                    </h6>
                                    <div class="widget-product-meta">
                                       <span class="text-accent">
                                            ৳ <?php echo e(number_format($top->product->unit_price, 0)); ?>

                                            <?php if($top->product->published_price > $top->product->unit_price): ?>
                                            <strike style="font-size: 12px!important;color: grey!important;">
                                                ৳ <?php echo e(number_format($top->product->published_price, 0)); ?>

                                            </strike>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    
    <script src="<?php echo e(asset('public/assets/front-end')); ?>/js/owl.carousel.min.js"></script>

    <script>
        $('#flash-deal-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 5,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '<?php echo e(session('direction')); ?>': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 3
                },
                //Large
                992: {
                    items: 4
                },
                //Extra large
                1200: {
                    items: 4
                },
                //Extra extra large
                1400: {
                    items: 4
                }
            }
        })

        $('#web-feature-deal-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 5,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '<?php echo e(session('direction')); ?>': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 3
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        })
    </script>

    <script>
        $('#brands-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 10,
            nav: false,
            '<?php echo e(session('direction')); ?>': true,
            //navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 7
                },
                //Large
                992: {
                    items: 9
                },
                //Extra large
                1200: {
                    items: 11
                },
                //Extra extra large
                1400: {
                    items: 12
                }
            }
        })
    </script>

    <script>
        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 5,
            nav: false,
            // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '<?php echo e(session('direction')); ?>': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/home.blade.php ENDPATH**/ ?>