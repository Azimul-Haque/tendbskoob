<?php
    $titleforthispage = strtoupper($data['data_from']).' products';

    if($data['data_from'] == 'author' || $data['data_from'] == 'publisher' || $data['data_from'] == 'category'){
        $titleforthispage = $datasource['name'] . ' Books - ' . $datasource['name_bangla'] . ' এর বই | Booksbd.net';
    } else {
        $titleforthispage = strtoupper($data['data_from']) .' products';
    }
?>

<?php $__env->startSection('title', $titleforthispage); ?>

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
    <div class="container rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a class="openbtn-tab mt-5" onclick="openNav()">
                    <div style="font-size: 20px; font-weight: 600; " class="for-tab-display mt-5">
                        <i class="fa fa-filter"></i>
                        <?php echo e(\App\CPU\translate('filter')); ?>

                    </div>
                </a>
            </div>
            <div class="col-md-9"> </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4 mt-4 rtl"
         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <div class="row">
            

            <!-- Content  -->
            <section class="col-lg-9">
                <?php if($data['data_from'] == 'author'): ?>
                    <div class="row">
                        <div class="col-md-3">
                            <center>
                                <img class="img-fluid rounded-circle" style="padding:10px;"
                                    onerror="this.src='<?php echo e(asset('public/assets/front-end/img/user_demo.jpg')); ?>'"
                                    src="<?php echo e(asset('public/images/author/' . $datasource['image'])); ?>">
                            </center>
                        </div>
                        <div class="col-md-9 card" style="padding:10px;">
                            <h4>
                                <?php echo e($datasource['name_bangla']); ?>

                            </h4>
                            <p id="datasourcedetail">
                                <?php echo e(\Illuminate\Support\Str::limit($datasource['description'], 300)); ?><br/>
                                <?php if(strlen($datasource['description']) > 300): ?>
                                    <span style="cursor: pointer" onclick="datasourcedetail('<?php echo e($datasource['description']); ?>')"><big>Read More</big></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php elseif($data['data_from'] == 'publisher'): ?>
                    <div class="row">
                        <div class="col-md-3">
                            <center>
                                <img class="img-fluid rounded-circle" style="padding:10px;"
                                    onerror="this.src='<?php echo e(asset('public/assets/front-end/img/user_demo.jpg')); ?>'"
                                    src="<?php echo e(asset('public/images/publisher/' . $datasource['image'])); ?>">
                            </center>
                        </div>
                        <div class="col-md-9 card" style="padding:10px;">
                            <h4>
                                <?php echo e($datasource['name_bangla']); ?>

                            </h4>
                            <p id="datasourcedetail">
                                <?php echo e(\Illuminate\Support\Str::limit($datasource['description'], 300)); ?><br/>
                                <?php if(strlen($datasource['description']) > 300): ?>
                                    <span style="cursor: pointer" onclick="datasourcedetail('<?php echo e($datasource['description']); ?>')"><big>Read More</big></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row mt-2">
                    <div class="col-md-6">
                        
                        
                        <h1 class="h3 text-dark mb-3">
                            <?php if($data['data_from'] == 'author'): ?>
                                <b><?php echo e(isset($data_from_name) ? $data_from_name : ''); ?></b> এর বই সমূহ
                                <label>( <?php echo e($products->total()); ?> <?php echo e(\App\CPU\translate('items found')); ?> )</label>
                            <?php elseif($data['data_from'] == 'publisher'): ?>
                                <b><?php echo e(isset($data_from_name) ? $data_from_name : ''); ?></b> এর বই সমূহ
                                <label>( <?php echo e($products->total()); ?> <?php echo e(\App\CPU\translate('items found')); ?> )</label>
                            <?php elseif($data['data_from'] == 'category'): ?>
                                <b><?php echo e(isset($data_from_name) ? $data_from_name : ''); ?></b>
                                <label>( <?php echo e($products->total()); ?> <?php echo e(\App\CPU\translate('items found')); ?> )</label>
                            <?php else: ?>
                                <?php echo e(strtoupper($data['data_from'])); ?> <?php echo e(\App\CPU\translate('products')); ?>

                                <label>( <?php echo e($products->total()); ?> <?php echo e(\App\CPU\translate('items found')); ?> )</label>
                            <?php endif; ?>
                                    
                            
                        </h1>
                    </div>
                    <div class="col-md-6 for-display mx-0">
                        <button class="openbtn text-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>" onclick="openNav()">
                            <div style="margin-bottom: -30%;">
                                <i class="fa fa-filter"></i>
                                <?php echo e(\App\CPU\translate('filter')); ?>

                            </div>
                        </button>
        
                        <div class="d-flex flex-wrap float-right for-shoting-mobile">
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
            document.getElementById("mySidepanel").style.width = "80%";
            document.getElementById("mySidepanel").style.height = "100%";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
            document.getElementById("mySidepanel").style.height = "0";
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
        
        $("#search-author").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#authorlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-author-m").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#mauthorlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

        $("#search-publisher").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#publisherlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-publisher-m").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#mpublisherlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

        $("#search-category").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#categorylist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-category-m").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#mcategorylist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

        function datasourcedetail(text) {
            $('#datasourcedetail').text(text);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/products/view.blade.php ENDPATH**/ ?>