<?php $__env->startSection('title',ucfirst($data['data_from']).' products'); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta property="og:image" content="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e($web_config['web_logo']); ?>"/>
    <meta property="og:title" content="Products of <?php echo e($web_config['name']); ?> "/>
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:description" content="<?php echo substr($web_config['about']->value,0,100); ?>">

    <meta property="twitter:card" content="<?php echo e(asset('storage/app/public/company')); ?>/<?php echo e($web_config['web_logo']); ?>"/>
    <meta property="twitter:title" content="Products of <?php echo e($web_config['name']); ?>"/>
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:description" content="<?php echo substr($web_config['about']->value,0,100); ?>">

    <style>
        .headerTitle {
            font-size: 26px;
            font-weight: bolder;
            margin-top: 3rem;
        }

        .for-count-value {
            position: absolute;

        <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 0.6875 rem;;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;

            color: black;
            font-size: .75rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.25rem;
        }

        .for-count-value {
            position: absolute;

        <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 0.6875 rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.25rem;
        }

        .for-brand-hover:hover {
            color: <?php echo e($web_config['primary_color']); ?>;
        }

        .for-hover-lable:hover {
            color: <?php echo e($web_config['primary_color']); ?>       !important;
        }

        .page-item.active .page-link {
            background-color: <?php echo e($web_config['primary_color']); ?>      !important;
        }

        .page-item.active > .page-link {
            box-shadow: 0 0 black !important;
        }

        .for-shoting {
            font-weight: 600;
            font-size: 18px;
            padding- <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 9px;
            color: #030303;
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 6;
            height: 500px;
            top: 0;
        <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 40px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
        <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 25 px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 18px;
            cursor: pointer;
            background-color: transparent !important;
            color: #373f50;
            width: 40%;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .for-display {
            display: block !important;
        }

        @media (max-width: 360px) {
            .openbtn {
                width: 59%;
            }

            .for-shoting-mobile {
                margin- <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 0% !important;
            }

            .for-mobile {

                margin- <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 10% !important;
            }

        }

        @media (max-width: 500px) {
            .for-mobile {

                margin- <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 27%;
            }

            .openbtn:hover {
                background-color: #fff;
            }

            .for-display {
                display: flex !important;
            }

            .for-tab-display {
                display: none !important;
            }

            .openbtn-tab {
                margin-top: 0 !important;
            }

        }

        @media  screen and (min-width: 500px) {
            .openbtn {
                display: none !important;
            }


        }

        @media  screen and (min-width: 800px) {


            .for-tab-display {
                display: none !important;
            }

        }

        @media (max-width: 768px) {
            .headerTitle {
                font-size: 23px;

            }

            .openbtn-tab {
                margin-top: 3rem;
                display: inline-block !important;
            }

            .for-tab-display {
                display: inline;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Title-->
    <div class="container rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <div class="col-md-3">
                <a class="openbtn-tab mt-5" onclick="openNav()">
                    <div style="font-size: 20px; font-weight: 600; " class="for-tab-display mt-5">
                        <i class="fa fa-filter"></i>
                        <?php echo e(\App\CPU\translate('filter')); ?>

                    </div>
                </a></div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        
                        
                        <h1 class="h3 text-dark mb-3 headerTitle text-uppercase">
                            <?php echo e($data['data_from']); ?> <?php echo e(\App\CPU\translate('products')); ?> <?php echo e(isset($data_from_name) ? '('.$data_from_name.')' : ''); ?>

                            <label>( <?php echo e($products->total()); ?> <?php echo e(\App\CPU\translate('items found')); ?> )</label>
                        </h1>
                    </div>
                    <div class="row col-md-6 for-display mx-0">

                        <button class="openbtn text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" onclick="openNav()">
                            <div style="margin-bottom: -30%;">
                                <i class="fa fa-filter"></i>
                                <?php echo e(\App\CPU\translate('filter')); ?>

                            </div>
                        </button>

                        <div class="d-flex flex-wrap mt-5 float-right for-shoting-mobile">
                            <form id="search-form" action="<?php echo e(route('products')); ?>" method="GET">
                                <input hidden name="data_from" value="<?php echo e($data['data_from']); ?>">
                                <div class="form-inline flex-nowrap pb-3 for-mobile">
                                    <label
                                        class="opacity-75 text-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?> for-shoting"
                                        for="sorting">
                                        <span
                                            class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"><?php echo e(\App\CPU\translate('sort_by')); ?></span></label>
                                    <select style="background: white; appearance: auto;"
                                            class="form-control custom-select" onchange="filter(this.value)">
                                        <option value="latest"><?php echo e(\App\CPU\translate('Latest')); ?></option>
                                        <option
                                            value="low-high"><?php echo e(\App\CPU\translate('low_high')); ?> <?php echo e(\App\CPU\translate('Price')); ?> </option>
                                        <option
                                            value="high-low"><?php echo e(\App\CPU\translate('hight_low')); ?> <?php echo e(\App\CPU\translate('Price')); ?></option>
                                        <option
                                            value="a-z"><?php echo e(\App\CPU\translate('a_z')); ?> <?php echo e(\App\CPU\translate('Order')); ?></option>
                                        <option
                                            value="z-a"><?php echo e(\App\CPU\translate('z_a')); ?> <?php echo e(\App\CPU\translate('Order')); ?></option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl"
         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <!-- Sidebar-->
            <aside
                class="col-lg-3 hidden-xs col-md-3 col-sm-4 SearchParameters <?php echo e(Session::get('direction') === "rtl" ? 'pl-0' : 'pr-0'); ?>"
                id="SearchParameters">
                <!--Price Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: -10px;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close <?php echo e(Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'); ?>"
                                type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(\App\CPU\translate('Dashboard')); ?>Close sidebar</span><span
                                class="d-inline-block align-middle <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="widget cz-filter mb-4 pb-4 mt-2">
                            <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('filter')); ?></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <div
                                class="form-inline flex-nowrap <?php echo e(Session::get('direction') === "rtl" ? 'ml-sm-4' : 'mr-sm-4'); ?> pb-3 for-mobile"
                                style="width: 100%">
                                <label class="opacity-75 text-nowrap for-shoting" for="sorting"
                                       style="width: 100%; padding-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 0">
                                    <select style="background: whitesmoke; appearance: auto;width: 100%"
                                            class="form-control custom-select" id="searchByFilterValue">
                                        <option selected disabled><?php echo e(\App\CPU\translate('Choose')); ?></option>
                                        <option
                                            value="<?php echo e(route('products',['id'=> $data['id'],'data_from'=>'best-selling','page'=>1])); ?>"><?php echo e(\App\CPU\translate('best_selling_product')); ?></option>
                                        <option
                                            value="<?php echo e(route('products',['id'=> $data['id'],'data_from'=>'top-rated','page'=>1])); ?>"><?php echo e(\App\CPU\translate('top_rated')); ?></option>
                                        <option
                                            value="<?php echo e(route('products',['id'=> $data['id'],'data_from'=>'most-favorite','page'=>1])); ?>"><?php echo e(\App\CPU\translate('most_favorite')); ?></option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Price Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: -10px;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close <?php echo e(Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'); ?>"
                                type="button" data-dismiss="sidebar" aria-label="Close">
                            <span
                                class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(\App\CPU\translate('Dashboard')); ?><?php echo e(\App\CPU\translate('Close sidebar')); ?></span>
                            <span
                                class="d-inline-block align-middle <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="cz-sidebar-body pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="widget cz-filter mb-4 pb-4 mt-2">
                            <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('Price')); ?></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <div class="input-group-overlay input-group-sm mb-1">
                                <input style="background: aliceblue;"
                                       class="cz-filter-search form-control form-control-sm appended-form-control"
                                       type="number" value="0" min="0" max="1000000" id="min_price">
                                <div class="input-group-append-overlay">
                                    <span style="color: #3498db;" class="input-group-text">
                                        <?php echo e(\App\CPU\currency_symbol()); ?>

                                    </span>
                                </div>
                            </div>
                            <div>
                                <p style="text-align: center;margin-bottom: 1px;"><?php echo e(\App\CPU\translate('to')); ?></p>
                            </div>
                            <div class="input-group-overlay input-group-sm mb-2">
                                <input style="background: aliceblue;" value="100" min="100" max="1000000"
                                       class="cz-filter-search form-control form-control-sm appended-form-control"
                                       type="number" id="max_price">
                                <div class="input-group-append-overlay">
                                    <span style="color: #3498db;" class="input-group-text">
                                        <?php echo e(\App\CPU\currency_symbol()); ?>

                                    </span>
                                </div>
                            </div>

                            <div class="input-group-overlay input-group-sm mb-2">
                                <button class="btn btn-primary btn-block"
                                        onclick="searchByPrice()">
                                    <span><?php echo e(\App\CPU\translate('search')); ?></span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Brand Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: 11px;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close <?php echo e(Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'); ?>"
                                type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(\App\CPU\translate('Dashboard')); ?><?php echo e(\App\CPU\translate('Close sidebar')); ?></span><span
                                class="d-inline-block align-middle <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body">
                        <!-- Filter by Brand-->
                        <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                            <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('brands')); ?></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <div class="input-group-overlay input-group-sm mb-2">
                                <input style="background: aliceblue" placeholder="Search brand"
                                       class="cz-filter-search form-control form-control-sm appended-form-control"
                                       type="text" id="search-brand">
                                <div class="input-group-append-overlay">
                                    <span style="color: #3498db;"
                                          class="input-group-text">
                                        <i class="czi-search"></i>
                                    </span>
                                </div>
                            </div>
                            <ul id="lista1" class="widget-list cz-filter-list list-unstyled pt-1"
                                style="max-height: 12rem;"
                                data-simplebar data-simplebar-auto-hide="false">
                                <?php $__currentLoopData = \App\CPU\BrandManager::get_brands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="brand mt-4 for-brand-hover <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : ''); ?>" id="brand">
                                        <li style="cursor: pointer;padding: 2px" class="flex-between"
                                            onclick="location.href='<?php echo e(route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])); ?>'">
                                            <div>
                                                <?php echo e($brand['name']); ?>

                                            </div>
                                            <?php if($brand['brand_products_count'] > 0 ): ?>
                                                <div>
                                                    <span class="count-value">
                                                    <?php echo e($brand['brand_products_count']); ?>

                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </li>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Categories & Color & Size Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close <?php echo e(Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'); ?>"
                                type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle"><?php echo e(\App\CPU\translate('Close sidebar')); ?></span><span
                                class="d-inline-block align-middle <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body">
                        <!-- Categories-->
                        <div class="widget widget-categories mb-4 pb-4 border-bottom">
                            <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('categories')); ?></h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <?php ($categories=\App\CPU\CategoryManager::parents()); ?>
                            <div class="accordion mt-n1" id="shop-categories">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card">
                                        <div class="card-header p-1 flex-between">
                                            <div>
                                                <label class="for-hover-lable" style="cursor: pointer"
                                                       onclick="location.href='<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>'">
                                                    <?php echo e($category['name']); ?>

                                                </label>
                                            </div>
                                            <div>
                                                <strong class="pull-right for-brand-hover" style="cursor: pointer"
                                                        onclick="$('#collapse-<?php echo e($category['id']); ?>').toggle(400)">
                                                    <?php echo e($category->childes->count()>0?'+':''); ?>

                                                </strong>
                                            </div>
                                        </div>
                                        <div class="card-body <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                             id="collapse-<?php echo e($category['id']); ?>"
                                             style="display: none">
                                            <?php $__currentLoopData = $category->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class=" for-hover-lable card-header p-1 flex-between">
                                                    <div>
                                                        <label style="cursor: pointer"
                                                               onclick="location.href='<?php echo e(route('products',['id'=> $child['id'],'data_from'=>'category','page'=>1])); ?>'">
                                                            <?php echo e($child['name']); ?>

                                                        </label>
                                                    </div>
                                                    <div>
                                                        <strong class="pull-right" style="cursor: pointer"
                                                                onclick="$('#collapse-<?php echo e($child['id']); ?>').toggle(400)">
                                                            <?php echo e($child->childes->count()>0?'+':''); ?>

                                                        </strong>
                                                    </div>
                                                </div>
                                                <div
                                                    class="card-body <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                                    id="collapse-<?php echo e($child['id']); ?>"
                                                    style="display: none">
                                                    <?php $__currentLoopData = $child->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="card-header p-1">
                                                            <label class="for-hover-lable" style="cursor: pointer"
                                                                   onclick="location.href='<?php echo e(route('products',['id'=> $ch['id'],'data_from'=>'category','page'=>1])); ?>'"><?php echo e($ch['name']); ?></label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div id="mySidepanel" class="sidepanel">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <aside class="" style="padding-right: 5%;padding-left: 5%;">
                    <div class="" id="shop-sidebar" style="margin-bottom: -10px;">
                        <div class=" box-shadow-sm">

                        </div>
                        <div class="" style="padding-top: 12px;">
                            <!-- Filter -->
                            <div class="widget cz-filter">
                                <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('filter')); ?></h3>
                                <div class="" style="width: 100%">
                                    <label class="opacity-75 text-nowrap for-shoting" for="sorting"
                                           style="width: 100%; padding-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 0">
                                        <select style="background: whitesmoke; appearance: auto;width: 100%"
                                                class="form-control custom-select" id="searchByFilterValue">
                                            <option selected disabled><?php echo e(\App\CPU\translate('Choose')); ?></option>
                                            <option
                                                value="<?php echo e(route('products',['id'=> $data['id'],'data_from'=>'best-selling','page'=>1])); ?>"><?php echo e(\App\CPU\translate('best_selling_product')); ?></option>
                                            <option
                                                value="<?php echo e(route('products',['id'=> $data['id'],'data_from'=>'top-rated','page'=>1])); ?>"><?php echo e(\App\CPU\translate('top_rated')); ?></option>
                                            <option
                                                value="<?php echo e(route('products',['id'=> $data['id'],'data_from'=>'most-favorite','page'=>1])); ?>"><?php echo e(\App\CPU\translate('most_favorite')); ?></option>
                                        </select>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Price Sidebar-->
                    <div class="" id="shop-sidebar" style="margin-bottom: -10px;">
                        <div class=" box-shadow-sm">

                        </div>
                        <div class="" style="padding-top: 12px;">
                            <!-- Filter by price-->
                            <div class="widget cz-filter mb-4 pb-4 mt-2">
                                <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('Price')); ?></h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-1">
                                    <input style="background: aliceblue;"
                                           class="cz-filter-search form-control form-control-sm appended-form-control"
                                           type="number" value="0" min="0" max="1000000" id="min_price">
                                    <div class="input-group-append-overlay">
                                    <span style="color: #3498db;" class="input-group-text">
                                        <?php echo e(\App\CPU\currency_symbol()); ?>

                                    </span>
                                    </div>
                                </div>
                                <div>
                                    <p style="text-align: center;margin-bottom: 1px;"><?php echo e(\App\CPU\translate('to')); ?></p>
                                </div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue;" value="100" min="100" max="1000000"
                                           class="cz-filter-search form-control form-control-sm appended-form-control"
                                           type="number" id="max_price">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;" class="input-group-text">
                                            <?php echo e(\App\CPU\currency_symbol()); ?>

                                        </span>
                                    </div>
                                </div>

                                <div class="input-group-overlay input-group-sm mb-2">
                                    <button class="btn btn-primary btn-block"
                                            onclick="searchByPrice()">
                                        <span><?php echo e(\App\CPU\translate('search')); ?></span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Brand Sidebar-->
                    <div class="" id="shop-sidebar" style="margin-bottom: 11px;">

                        <div class="">
                            <!-- Filter by Brand-->
                            <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;"><?php echo e(\App\CPU\translate('brands')); ?></h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue"
                                           class="cz-filter-search form-control form-control-sm appended-form-control"
                                           type="text" id="search-brand-m">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                              class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="lista1" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="max-height: 12rem;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    <?php $__currentLoopData = \App\CPU\BrandManager::get_brands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="brand mt-4 for-brand-hover" id="brand">
                                            <li style="cursor: pointer;padding: 2px"
                                                onclick="location.href='<?php echo e(route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])); ?>'">
                                                <?php echo e($brand['name']); ?>

                                                <?php if($brand['brand_products_count'] > 0 ): ?>

                                                    <span class="for-count-value"
                                                          style="float: <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>"><?php echo e($brand['brand_products_count']); ?></span>

                                                <?php endif; ?>
                                            </li>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Categories & Color & Size Sidebar (mobile) -->
                    <div class="" id="shop-sidebar">
                        <div class="">
                            <!-- Categories-->
                            <div class="widget widget-categories mb-4 pb-4 border-bottom">
                                <h3 class="widget-title"
                                    style="font-weight: 700;"><?php echo e(\App\CPU\translate('categories')); ?></h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="accordion mt-n1" id="shop-categories">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card">
                                            <div class="card-header p-1 flex-between">
                                                <div>
                                                    <label class="for-hover-lable" style="cursor: pointer"
                                                           onclick="location.href='<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>'">
                                                        <?php echo e($category['name']); ?>

                                                    </label>
                                                </div>
                                                <div>
                                                    <strong class="pull-right for-brand-hover" style="cursor: pointer"
                                                            onclick="$('#collapsem-<?php echo e($category['id']); ?>').toggle(300)">
                                                        <?php echo e($category->childes->count()>0?'+':''); ?>

                                                    </strong>
                                                </div>
                                            </div>
                                            <div
                                                class="card-body <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                                id="collapsem-<?php echo e($category['id']); ?>"
                                                style="display: none">
                                                <?php $__currentLoopData = $category->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="card-header p-1 flex-between">
                                                        <div>
                                                            <label class="for-hover-lable" style="cursor: pointer"
                                                                   onclick="location.href='<?php echo e(route('products',['id'=> $child['id'],'data_from'=>'category','page'=>1])); ?>'">
                                                                <?php echo e($child['name']); ?>

                                                            </label>
                                                        </div>
                                                        <div>
                                                            <strong class="pull-right for-brand-hover"
                                                                    style="cursor: pointer"
                                                                    onclick="$('#collapsem-<?php echo e($child['id']); ?>').toggle(300)">
                                                                <?php echo e($child->childes->count()>0?'+':''); ?>

                                                            </strong>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="card-body <?php echo e(Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'); ?>"
                                                        id="collapsem-<?php echo e($child['id']); ?>"
                                                        style="display: none">
                                                        <?php $__currentLoopData = $child->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="card-header p-1">
                                                                <label class="for-hover-lable" style="cursor: pointer"
                                                                       onclick="location.href='<?php echo e(route('products',['id'=> $ch['id'],'data_from'=>'category','page'=>1])); ?>'"><?php echo e($ch['name']); ?></label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <!-- Content  -->
            <section class="col-lg-9">
                <?php if(count($products) > 0): ?>
                    <div class="row" id="ajax-products">
                        <?php echo $__env->make('web-views.products._ajax-products',['products'=>$products], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center pt-5">
                        <h2><?php echo e(\App\CPU\translate('No Product Found')); ?></h2>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "50%";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }

        function filter(value) {
            $.get({
                url: '<?php echo e(url('/')); ?>/products',
                data: {
                    id: '<?php echo e($data['id']); ?>',
                    name: '<?php echo e($data['name']); ?>',
                    data_from: '<?php echo e($data['data_from']); ?>',
                    min_price: '<?php echo e($data['min_price']); ?>',
                    max_price: '<?php echo e($data['max_price']); ?>',
                    sort_by: value
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function searchByPrice() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $.get({
                url: '<?php echo e(url('/')); ?>/products',
                data: {
                    id: '<?php echo e($data['id']); ?>',
                    name: '<?php echo e($data['name']); ?>',
                    data_from: '<?php echo e($data['data_from']); ?>',
                    sort_by: '<?php echo e($data['sort_by']); ?>',
                    min_price: min,
                    max_price: max,
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                    $('#paginator-ajax').html(response.paginator);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        $('#searchByFilterValue, #searchByFilterValue-m').change(function () {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        $("#search-brand").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/products/view.blade.php ENDPATH**/ ?>