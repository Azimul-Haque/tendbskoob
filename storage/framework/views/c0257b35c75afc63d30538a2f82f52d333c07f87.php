<style>
    .card-body.search-result-box {
        overflow: scroll;
        height: 400px;
        overflow-x: hidden;
    }

    .active .seller {
        font-weight: 700;
    }

    .for-count-value {
        position: absolute;

        right: 0.6875rem;;
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 50%;
        color: <?php echo e($web_config['primary_color']); ?>;

        font-size: .75rem;
        font-weight: 500;
        text-align: center;
        line-height: 1.25rem;
    }

    .count-value {
        width: 1.25rem;
        height: 1.25rem;
        border-radius: 50%;
        color: <?php echo e($web_config['primary_color']); ?>;

        font-size: .75rem;
        font-weight: 500;
        text-align: center;
        line-height: 1.25rem;
    }

    .list-level-0>.list-item>a:hover {
        background: rgb(185, 185, 185);
    }
    .list-level-1>.list-item:hover {
        background: rgb(185, 185, 185);
    }

    @media (min-width: 992px) {
        .navbar-sticky.navbar-stuck .navbar-stuck-menu.show {
            display: block;
            height: 55px !important;
        }
    }

    @media (min-width: 768px) {
        .navbar-stuck-menu {
            background-color: <?php echo e($web_config['primary_color']); ?>;
            line-height: 15px;
            padding-bottom: 6px;
        }

    }

    @media (max-width: 767px) {
        .search_button {
            background-color: transparent !important;
        }

        .search_button .input-group-text i {
            color: <?php echo e($web_config['primary_color']); ?>                              !important;
        }

        .navbar-expand-md .dropdown-menu > .dropdown > .dropdown-toggle {
            position: relative;
            padding- <?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 1.95rem;
        }

        .mega-nav1 {
            background: white;
            color: <?php echo e($web_config['primary_color']); ?>                              !important;
            border-radius: 3px;
        }

        .mega-nav1 .nav-link {
            color: <?php echo e($web_config['primary_color']); ?>                              !important;
        }
    }

    @media (max-width: 768px) {
        .tab-logo {
            width: 10rem;
        }
    }

    @media (max-width: 360px) {
        .mobile-head {
            padding: 3px;
        }
    }

    @media (max-width: 471px) {
        .navbar-brand img {

        }

        .mega-nav1 {
            background: white;
            color: <?php echo e($web_config['primary_color']); ?>                              !important;
            border-radius: 3px;
        }

        .mega-nav1 .nav-link {
            color: <?php echo e($web_config['primary_color']); ?>                              !important;
        }
    }


</style>

<header class="box-shadow-sm rtl">
    <!-- Topbar-->
    <!--
    <div class="topbar">
        <div class="container ">
            <div>
                <?php ( $local = \App\CPU\Helpers::default_lang()); ?>
                <div
                    class="topbar-text dropdown disable-autohide <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?> text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php $__currentLoopData = json_decode($language['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['code']==$local): ?>
                                <img class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>" width="20"
                                     src="<?php echo e(asset('public/assets/front-end')); ?>/img/flags/<?php echo e($data['code']); ?>.png"
                                     alt="Eng">
                                <?php echo e($data['name']); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>"
                        style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <?php $__currentLoopData = json_decode($language['value'],true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['status']==1): ?>
                                <li>
                                    <a class="dropdown-item pb-1" href="<?php echo e(route('lang',[$data['code']])); ?>">
                                        <img class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"
                                             width="20"
                                             src="<?php echo e(asset('public/assets/front-end')); ?>/img/flags/<?php echo e($data['code']); ?>.png"
                                             alt="<?php echo e($data['name']); ?>"/>
                                        <span style="text-transform: capitalize"><?php echo e(\App\CPU\Helpers::get_language_name($data['code'])); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <?php ($currency_model = \App\CPU\Helpers::get_business_settings('currency_model')); ?>
                <?php if($currency_model=='multi_currency'): ?>
                    <div class="topbar-text dropdown disable-autohide">
                        <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                            <span><?php echo e(session('currency_code')); ?> <?php echo e(session('currency_symbol')); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>"
                            style="min-width: 160px!important;text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                            <?php $__currentLoopData = \App\Model\Currency::where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li style="cursor: pointer" class="dropdown-item"
                                    onclick="currency_change('<?php echo e($currency['code']); ?>')">
                                    <?php echo e($currency->name); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="topbar-text dropdown d-md-none <?php echo e(Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'); ?>">
                <a class="topbar-link" href="tel: <?php echo e($web_config['phone']->value); ?>">
                    <i class="fa fa-phone"></i> <?php echo e($web_config['phone']->value); ?>

                </a>
            </div>
            <div class="d-none d-md-block <?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?> text-nowrap">
                <a class="topbar-link d-none d-md-inline-block" href="tel:<?php echo e($web_config['phone']->value); ?>">
                    <i class="fa fa-phone"></i> <?php echo e($web_config['phone']->value); ?>

                </a>
            </div>
        </div>
    </div>
    -->

    <?php ($categories=\App\Model\Category::with(['childes.childes'])->where('position', 0)->take(11)->get()); ?>
    <?php ($authors=\App\Model\Author::take(15)->get()); ?>
    <?php ($publishers=\App\Model\Publisher::take(15)->get()); ?>

    <!-- off-canvas -->
    <div class="off-canvas">
      <div class="off-canvas-header">
        <h4 class="off-canvas-title">
          ????????????
        </h4>
        <div data-bs-dismiss="off-canvas" aria-label="Close">
          <div class="icon-close"></div>
        </div>
      </div>

      <div class="off-canvas-body">
        <nav>
          <ul class="list-level-0">
            <li class="list-item">
                <div class="input-group-overlay d-md-none my-3">
                    <form action="<?php echo e(route('products')); ?>" type="submit" class="search_form">
                        <input class="form-control appended-form-control search-bar-input-mobile" type="text"
                               autocomplete="off" id="globalsearch"
                               placeholder="<?php echo e(\App\CPU\translate('search')); ?>" name="name" required>
                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <button class="input-group-append-overlay search_button" type="submit"
                                style="border-radius: <?php echo e(Session::get('direction') === "rtl" ? '7px 0px 0px 7px; right: unset; left: 0' : '0px 7px 7px 0px; left: unset; right: 0'); ?>;">
                        <span class="input-group-text" style="font-size: 20px;">
                            <i class="czi-search text-white"></i>
                        </span>
                        </button>
                        <div class="card search-card"
                             style="position: absolute;background: white;z-index: 999;width: 100%;display: none">
                            <div class="card-body search-result-box" id=""
                                 style="overflow:scroll; height:400px;overflow-x: hidden"></div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="list-item">
              <a class="link-level-1" href="<?php echo e(route('home')); ?>">
                ?????????????????????
              </a>
            </li>

            <li class="list-item">
              <a class="link-level-1" href="#">
                ???????????? &nbsp;<span class="link-arrow">&#8250;</span>
              </a>
              <ul class="list-level-1">
                <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-item">
                        <a class="link-level-2" href="<?php echo e(route('products', ['id'=> $author['id'],'data_from'=>'author','page'=>1, 'author_name'=>$author['slug']])); ?>">
                            <?php echo e($author->name_bangla); ?>

                        </a>
                    </li> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="list-item">
                    <a class="link-level-2" href="<?php echo e(route('authors')); ?>">
                        <b>????????? ??????????????? <i class="fa fa-angle-double-right"></i></b>
                    </a>
                </li> 
              </ul>
            </li>

            <li class="list-item">
              <a class="link-level-1" href="#">
                ????????????????????????&nbsp;<span class="link-arrow">&#8250;</span>
              </a>
              <ul class="list-level-1">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-item">
                        <a class="link-level-2" href="<?php echo e(route('products', ['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>">
                            <?php echo e($category->name_bangla); ?>

                        </a>
                    </li> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="list-item">
                    <a class="link-level-2" href="<?php echo e(route('products', ['id'=> 444,'data_from'=>'category','page'=>1])); ?>">
                        ???????????? ??????????????????
                    </a>
                </li>
                <li class="list-item">
                    <a class="link-level-2" href="<?php echo e(route('categories')); ?>">
                        <b>????????? ??????????????? <i class="fa fa-angle-double-right"></i></b>
                    </a>
                </li> 
              </ul>
            </li>

            <li class="list-item">
              <a class="link-level-1" href="#">
                ???????????????????????? &nbsp;<span class="link-arrow">&#8250;</span>
              </a>
              <ul class="list-level-1">
                <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-item">
                        <a class="link-level-2" href="<?php echo e(route('products', ['id'=> $publisher['id'],'data_from'=>'publisher', 'author_name'=>$author['slug'], 'page'=>1])); ?>">
                            <?php echo e($publisher->name_bangla); ?>

                        </a>
                    </li> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li class="list-item">
                    <a class="link-level-2" href="<?php echo e(route('publishers')); ?>">
                        <b>????????? ??????????????? <i class="fa fa-angle-double-right"></i></b>
                    </a>
                </li> 
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- off-canvas -->

    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="container ">
               <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"> -->
                <button class="navbar-toggler off-canvas-toggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?> flex-shrink-0"
                   href="<?php echo e(route('home')); ?>"
                   style="min-width: 7rem;">
                    <img style="height: 70px!important; width: auto;"
                         src="<?php echo e(asset("storage/app/public/company")."/".$web_config['web_logo']->value); ?>"
                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                         alt="<?php echo e($web_config['name']->value); ?>"/>
                </a>
                <a class="navbar-brand d-sm-none <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?>"
                   href="<?php echo e(route('home')); ?>">
                    <img style="height: 40px!important; width: auto;" class="mobile-logo-img"
                         src="<?php echo e(asset("storage/app/public/company")."/".$web_config['mob_logo']->value); ?>"
                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                         alt="<?php echo e($web_config['name']->value); ?>"/>
                </a>
                <!-- Search-->
                <div class="input-group-overlay d-none d-md-block mx-4"
                     style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">
                    <form action="<?php echo e(route('products')); ?>" type="submit" class="search_form">
                        <input class="form-control appended-form-control search-bar-input" type="text"
                               id="globalsearch-m"
                               autocomplete="off"
                               placeholder="<?php echo e(\App\CPU\translate('search')); ?>"
                               name="name" required>
                        <button class="input-group-append-overlay search_button" type="submit"
                                style="border-radius: <?php echo e(Session::get('direction') === "rtl" ? '7px 0px 0px 7px; right: unset; left: 0' : '0px 7px 7px 0px; left: unset; right: 0'); ?>;">
                                <span class="input-group-text" style="font-size: 20px;">
                                    <i class="czi-search text-white"></i>
                                </span>
                        </button>
                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <div class="card search-card"
                             style="position: absolute;background: white;z-index: 999;width: 100%;display: none">
                            <div class="card-body search-result-box"
                                 style="overflow:scroll; height:400px;overflow-x: hidden"></div>
                        </div>
                    </form>
                </div>
                <!-- Toolbar-->
                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler" href="#">
                        <span class="navbar-tool-tooltip"><?php echo e(\App\CPU\translate('Expand menu')); ?></span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu"></i>
                        </div>
                    </a>
                    <div class="navbar-tool dropdown <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="<?php echo e(route('wishlists')); ?>">
                            <span class="navbar-tool-label">
                                <span
                                    class="countWishlist"><?php echo e(session()->has('wish_list')?count(session('wish_list')):0); ?></span>
                           </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div>
                    <?php if(auth('customer')->check()): ?>
                        <div class="dropdown">
                            <a class="navbar-tool ml-1 mr-1 " type="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <img style="width: 40px;height: 40px"
                                             src="<?php echo e(asset('storage/app/public/profile/'.auth('customer')->user()->image)); ?>"
                                             onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                             class="img-profile rounded-circle">
                                    </div>
                                </div>
                                <div class="navbar-tool-text">
                                    <small><?php echo e(\App\CPU\translate('hello')); ?>, <?php echo e(auth('customer')->user()->f_name); ?></small>
                                    <?php echo e(\App\CPU\translate('dashboard')); ?>

                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                   href="<?php echo e(route('account-oder')); ?>"> <?php echo e(\App\CPU\translate('my_order')); ?> </a>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('user-account')); ?>"> <?php echo e(\App\CPU\translate('my_profile')); ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('customer.auth.logout')); ?>"><?php echo e(\App\CPU\translate('logout')); ?></a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="dropdown">
                            <a class="navbar-tool <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"
                               type="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <i class="navbar-tool-icon czi-user"></i>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" aria-labelledby="dropdownMenuButton"
                                 style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <a class="dropdown-item" href="<?php echo e(route('customer.auth.login')); ?>">
                                    <i class="fa fa-sign-in <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i> <?php echo e(\App\CPU\translate('sing_in')); ?>

                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('customer.auth.register')); ?>">
                                    <i class="fa fa-user-circle <?php echo e(Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'); ?>"></i><?php echo e(\App\CPU\translate('sing_up')); ?>

                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div id="cart_items">
                        <?php echo $__env->make('layouts.front-end.partials.cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarCollapse"
                     style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">

                    <!-- Search-->
                    <div class="input-group-overlay d-md-none my-3">
                        <form action="<?php echo e(route('products')); ?>" type="submit" class="search_form">
                            <input class="form-control appended-form-control search-bar-input-mobile" type="text"
                                   autocomplete="off" id="globalsearch"
                                   placeholder="<?php echo e(\App\CPU\translate('search')); ?>" name="name" required>
                            <input name="data_from" value="search" hidden>
                            <input name="page" value="1" hidden>
                            <button class="input-group-append-overlay search_button" type="submit"
                                    style="border-radius: <?php echo e(Session::get('direction') === "rtl" ? '7px 0px 0px 7px; right: unset; left: 0' : '0px 7px 7px 0px; left: unset; right: 0'); ?>;">
                            <span class="input-group-text" style="font-size: 20px;">
                                <i class="czi-search text-white"></i>
                            </span>
                            </button>
                            <div class="card search-card"
                                 style="position: absolute;background: white;z-index: 999;width: 100%;display: none">
                                <div class="card-body search-result-box" id=""
                                     style="overflow:scroll; height:400px;overflow-x: hidden"></div>
                            </div>
                        </form>
                    </div>

                    <?php if(!request()->is('/')): ?>
                        <ul class="navbar-nav pr-2 pl-2 <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?> d-none d-xl-block">
                            <li class="nav-item" style="float: left;">
                                <a class="nav-link off-canvas-toggle2" href="#!">
                                    <i class="czi-menu align-middle mt-n1 mr-2"></i>
                                </a>
                            </li>
                        </ul> 
                    <?php endif; ?>
                    
                    <ul class="navbar-nav mega-nav pr-2 pl-2 <?php echo e(Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'); ?> d-none d-xl-block">
                        <!--web-->
                        <?php if(request()->is('/')): ?>
                            <li class="nav-item" style="float: left;">
                                <a class="nav-link off-canvas-toggle2" href="#!">
                                    <i class="czi-menu align-middle mt-n1 mr-2"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item <?php echo e(!request()->is('/')?'dropdown':''); ?>">
                            <a class="nav-link dropdown-toggle <?php echo e(Session::get('direction') === "rtl" ? 'pr-0' : 'pl-0'); ?>"
                               href="#" data-toggle="dropdown" style="<?php echo e(request()->is('/')?'pointer-events: none':''); ?>">
                                <span
                                    style="margin-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 40px !important;margin-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>: 50px">
                                    ????????????????????????
                                </span>
                            </a>
                            <?php if(request()->is('/')): ?>
                                <ul class="dropdown-menu"
                                    style="right: 0%; display: block!important;margin-top: 7px; box-shadow: none;min-width: 303px !important;<?php echo e(Session::get('direction') === "rtl" ? 'margin-right: 1px!important;text-align: right;' : 'margin-left: 1px!important;text-align: left;'); ?>padding-bottom: 0px!important;">
                                    
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($key<10): ?>
                                            <li class="dropdown">
                                                <a class="dropdown-item flex-between"
                                                   <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                                   onclick="location.href='<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>'">
                                                    <div>
                                                        <i class="fa fa-ticket"></i>
                                                        <span class="<?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>"><?php echo e($category['name_bangla']); ?></span>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dropdown">
                                        <a class="dropdown-item flex-between"
                                            <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                            onclick="location.href='<?php echo e(route('products',['id'=> 444,'data_from'=>'category','page'=>1])); ?>'">
                                            <div>
                                                <i class="fa fa-ticket"></i>
                                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">???????????? ??????????????????</span>
                                            </div>
                                        </a>
                                    </li>
                                    <a class="dropdown-item" href="<?php echo e(route('categories')); ?>"
                                       style="<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 29%">
                                        <?php echo e(\App\CPU\translate('view_more')); ?>

                                    </a>
                                </ul>
                            <?php else: ?>
                                <ul class="dropdown-menu"
                                    style="right: 0; text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="dropdown">
                                            <a class="dropdown-item flex-between <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown"?> "
                                               <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                               onclick="location.href='<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>'">
                                                <div>
                                                    <!-- <img src="<?php echo e(asset("storage/app/public/category/$category->icon")); ?>"
                                                         onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                                         style="width: 18px; height: 18px; "> -->
                                                    <i class="fa fa-ticket"></i>
                                                    <span
                                                        class="<?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>"><?php echo e($category['name_bangla']); ?></span>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dropdown">
                                        <a class="dropdown-item flex-between"
                                            <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                            onclick="location.href='<?php echo e(route('products',['id'=> 444,'data_from'=>'category','page'=>1])); ?>'">
                                            <div>
                                                <i class="fa fa-ticket"></i>
                                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">???????????? ??????????????????</span>
                                            </div>
                                        </a>
                                    </li>
                                    <a class="dropdown-item" href="<?php echo e(route('categories')); ?>"
                                       style="<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 29%">
                                        <?php echo e(\App\CPU\translate('view_more')); ?>

                                    </a>
                                </ul>
                            <?php endif; ?>
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-2 pl-2 d-blocksss d-xl-none"><!--mobile-->
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link off-canvas-toggle3" href="#!">
                                <i class="czi-menu align-middle mt-n1 mr-2"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo e(Session::get('direction') === "rtl" ? 'pr-0' : 'pl-0'); ?>"
                               href="#" data-toggle="dropdown">
                                
                                <span
                                    style="margin-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 20px !important;">????????????????????????</span>
                            </a>
                            <ul class="dropdown-menu"
                                style="right: 0%; text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dropdown">
                                        <a class="dropdown-item <?php if ($category->childes->count() > 0) echo "dropdown-toggle"?> "
                                           <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="<?php echo e(route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>">
                                            <!-- <img src="<?php echo e(asset("public/images/category/" . $category->icon)); ?>"
                                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                                 style="width: 18px; height: 18px; "> -->
                                            <i class="fa fa-ticket"></i>
                                            <span
                                                class="<?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>"><?php echo e($category['name_bangla']); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li class="dropdown">
                                        <a class="dropdown-item flex-between"
                                            <?php if ($category->childes->count() > 0) echo "data-toggle='dropdown'"?> href="javascript:"
                                            onclick="location.href='<?php echo e(route('products',['id'=> 444,'data_from'=>'category','page'=>1])); ?>'">
                                            <div>
                                                <i class="fa fa-ticket"></i>
                                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'); ?>">???????????? ??????????????????</span>
                                            </div>
                                        </a>
                                    </li>
                                <a class="dropdown-item" href="<?php echo e(route('categories')); ?>"
                                style="<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 29%">
                                    <?php echo e(\App\CPU\translate('view_more')); ?>

                                </a>
                            </ul>
                        </li>
                    </ul>
                    <!-- Primary menu-->
                    <ul class="navbar-nav" style="<?php echo e(Session::get('direction') === "rtl" ? 'padding-right: 0px' : ''); ?>">
                        <li class="nav-item dropdown <?php echo e(request()->is('/')?'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>">?????????????????????</a>
                        </li>

                        
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo e(route('authors')); ?>">????????????</a>
                            <ul class="dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> scroll-bar"
                                style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="border-bottom: 1px solid #e3e9ef; display:flex; justify-content:space-between; ">
                                        <div>
                                            <a class="dropdown-item"
                                               href="<?php echo e(route('products',['id'=> $author['id'],'data_from'=>'author','page'=>1, 'author_name'=>$author['slug']])); ?>">
                                                <?php echo e($author['name_bangla']); ?>

                                            </a>
                                        </div>
                                        
                                        <div class="align-baseline">
                                            <!--
                                                <?php if($author->products()->count() > 0): ?>
                                                    <span class="count-value px-2">( <?php echo e($author->products()->count()); ?> )</span>
                                                <?php endif; ?>
                                                -->
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li style="border-bottom: 1px solid #e3e9ef; display:flex; justify-content:center; ">
                                    <div>
                                        <a class="dropdown-item" href="<?php echo e(route('authors')); ?>">
                                            <?php echo e(\App\CPU\translate('View_more')); ?>

                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo e(route('publishers')); ?>">????????????????????????</a>
                            <ul class="dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> scroll-bar"
                                style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li style="border-bottom: 1px solid #e3e9ef; display:flex; justify-content:space-between; ">
                                        <div>
                                            <a class="dropdown-item"
                                               href="<?php echo e(route('products',['id'=> $publisher['id'],'data_from'=>'publisher','page'=>1, 'publisher_name'=>$publisher['slug']])); ?>">
                                                <?php echo e($publisher['name_bangla']); ?>

                                            </a>
                                        </div>
                                        
                                        <div class="align-baseline">
                                            <!--
                                                <?php if($publisher->products()->count() > 0): ?>
                                                    <span class="count-value px-2">( <?php echo e($publisher->products()->count()); ?> )</span>
                                                <?php endif; ?>
                                            -->
                                            
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li style="border-bottom: 1px solid #e3e9ef; display:flex; justify-content:center; ">
                                    <div>
                                        <a class="dropdown-item" href="<?php echo e(route('publishers')); ?>">
                                            <?php echo e(\App\CPU\translate('View_more')); ?>

                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="nav-item dropdown <?php echo e(request()->is('/')?'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('sellers')); ?>"><?php echo e(\App\CPU\translate('Sellers')); ?></a>
                        </li>
                        -->
                        <?php ($seller_registration=\App\Model\BusinessSetting::where(['type'=>'seller_registration'])->first()->value); ?>
                        <?php if($seller_registration): ?>
                        <!--
                            <li class="nav-item dropdown ml-2">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            style="color: white;margin-top: 5px; padding-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>: 0">
                                        <?php echo e(\App\CPU\translate('Seller')); ?>  <?php echo e(\App\CPU\translate('zone')); ?>

                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                         style="min-width: 165px !important; text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                        <a class="dropdown-item" href="<?php echo e(route('shop.apply')); ?>">
                                            <b><?php echo e(\App\CPU\translate('Become a')); ?> <?php echo e(\App\CPU\translate('Seller')); ?></b>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo e(route('seller.auth.login')); ?>">
                                            <b><?php echo e(\App\CPU\translate('Seller')); ?>  <?php echo e(\App\CPU\translate('login')); ?> </b>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        -->
                        <?php endif; ?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\wamp\www\booksbd\resources\views/layouts/front-end/partials/_header.blade.php ENDPATH**/ ?>