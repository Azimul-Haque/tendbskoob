<style>
    .navbar-vertical .nav-link {
        color: #ffffff;
        font-weight: bold;
    }
    .navbar .nav-link:hover {
        color: #C6FFC1;
    }
    .navbar .active > .nav-link, .navbar .nav-link.active, .navbar .nav-link.show, .navbar .show > .nav-link {
        color: #C6FFC1;
    }
    .navbar-vertical .active .nav-indicator-icon, .navbar-vertical .nav-link:hover .nav-indicator-icon, .navbar-vertical .show > .nav-link > .nav-indicator-icon {
        color: #C6FFC1;
    }
    .nav-subtitle {
        display: block;
        color: #fffbdf91;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03125rem;
    }
    .side-logo{
        background-color: #F7F8FA;
    }
    .nav-sub{
        background-color: #182c2f!important;
    }

    .nav-indicator-icon {
        margin-left: <?php echo e(Session::get('direction') === "rtl" ? '6px' : ''); ?>;
    }
</style>
<div id="sidebarMain" class="d-none">
    <aside style="background: #182c2f!important; text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset" style="padding-bottom: 0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    <?php ($seller_logo=auth('seller')->user()->image); ?>
                    <a class="navbar-brand" href="<?php echo e(route('seller.dashboard.index')); ?>" aria-label="Front">
                        <img onerror="this.src='<?php echo e(asset('public/assets/back-end/img/900x400/img1.jpg')); ?>'"
                             class="navbar-brand-logo-mini for-seller-logo"
                             src="<?php echo e(asset("storage/app/public/shop/$seller_logo")); ?>" alt="Logo">
                    </a>
                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller')?'show':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('seller.dashboard.index')); ?>">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(\App\CPU\translate('Dashboard')); ?>

                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->


                        
                        <!-- End Pages -->

                        <li class="nav-item">
                            <small class="nav-subtitle"><?php echo e(\App\CPU\translate('book_management')); ?></small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <li class="nav-item <?php echo e((Request::is('seller/product*'))?'active':''); ?>">
                            <a class="nav-link " href="<?php echo e(route('seller.product.list')); ?>">
                                <i class="tio-book nav-icon"></i>
                                <span class="text-truncate"><?php echo e(\App\CPU\translate('Seller')); ?> <?php echo e(\App\CPU\translate('Books')); ?></span>
                            </a>
                        </li>

                        

                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller/reviews/list*')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('seller.reviews.list')); ?>">
                                <i class="tio-star nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(\App\CPU\translate('Product')); ?> <?php echo e(\App\CPU\translate('Reviews')); ?>

                                </span>
                            </a>
                        </li>


                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller/messages*')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('seller.messages.chat')); ?>">
                                <i class="tio-email nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(\App\CPU\translate('messages')); ?>

                                </span>
                            </a>
                        </li>
                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller/profile*')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('seller.profile.view')); ?>">
                                <i class="tio-shop nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(\App\CPU\translate('my_bank_info')); ?>

                                </span>
                            </a>
                        </li>


                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller/shop*')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('seller.shop.view')); ?>">
                                <i class="tio-home nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(\App\CPU\translate('my_shop')); ?>

                                </span>
                            </a>
                        </li>


                        <!-- End Pages -->
                        <li class="nav-item <?php echo e(( Request::is('seller/business-settings*'))?'scroll-here':''); ?>">
                            <small class="nav-subtitle" title=""><?php echo e(\App\CPU\translate('business_section')); ?></small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>
                        <?php ($shippingMethod = \App\CPU\Helpers::get_business_settings('shipping_method')); ?>
                        <?php if($shippingMethod=='sellerwise_shipping'): ?>
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller/business-settings/shipping-method*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                href="<?php echo e(route('seller.business-settings.shipping-method.add')); ?>">
                                    <i class="tio-settings nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">
                                        <?php echo e(\App\CPU\translate('shipping_method')); ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('seller/business-settings/withdraws*')?'active':''); ?>">
                            <a class="js-navbar-vertical-aside-menu-link nav-link"
                               href="<?php echo e(route('seller.business-settings.withdraw.list')); ?>">
                                <i class="tio-wallet-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate text-capitalize">
                                        <?php echo e(\App\CPU\translate('withdraws')); ?>

                                    </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

<?php /**PATH C:\wamp\www\booksbd\resources\views/layouts/back-end/partials-seller/_side-bar.blade.php ENDPATH**/ ?>