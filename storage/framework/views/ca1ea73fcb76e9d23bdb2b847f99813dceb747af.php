<?php $__env->startSection('title', \App\CPU\translate('Product Preview')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <style>
        .checkbox-color label {
            width: 2.25rem;
            height: 2.25rem;
            float: left;
            padding: 0.375rem;
            margin-right: 0.375rem;
            display: block;
            font-size: 0.875rem;
            text-align: center;
            opacity: 0.7;
            border: 2px solid #d3d3d3;
            border-radius: 50%;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            transition: all 0.3s ease;
            transform: scale(0.95);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid"
         style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
        <!-- Page Header -->
        <div class="page-header">
            <div class="flex-between row mx-1">
                <div>
                    <h1 class="page-header-title"><?php echo e($product['name']); ?></h1>
                </div>
                <div class="row">
                    <div class="col-12 flex-start">
                        <div class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>">
                            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary float-right">
                                <i class="tio-back-ui"></i> <?php echo e(\App\CPU\translate('Back')); ?>

                            </a>
                        </div>
                        <div>
                            <a href="<?php echo e(route('product',$product['slug'])); ?>" class="btn btn-primary " target="_blank"><i
                                    class="tio-globe"></i> <?php echo e(\App\CPU\translate('View')); ?> <?php echo e(\App\CPU\translate('from')); ?> <?php echo e(\App\CPU\translate('Website')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($product['added_by'] == 'seller' && ($product['request_status'] == 0 || $product['request_status'] == 1)): ?>
                <div class="row">
                    <div class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                        <?php if($product['request_status'] == 0): ?>
                            <a href="<?php echo e(route('admin.product.approve-status', ['id'=>$product['id']])); ?>"
                               class="btn btn-secondary float-right">
                                <?php echo e(\App\CPU\translate('Approve')); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>">
                        <button class="btn btn-warning float-right" data-toggle="modal" data-target="#publishNoteModal">
                            <?php echo e(\App\CPU\translate('deny')); ?>

                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="publishNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLabel"><?php echo e(\App\CPU\translate('denied_note')); ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form class="form-group"
                                          action="<?php echo e(route('admin.product.deny', ['id'=>$product['id']])); ?>"
                                          method="post">
                                        <div class="modal-body">
                                            <textarea class="form-control" name="denied_note" rows="3"></textarea>
                                            <input type="hidden" name="_token" id="csrf-token"
                                                   value="<?php echo e(csrf_token()); ?>"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(\App\CPU\translate('Close')); ?>

                                            </button>
                                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('Save changes')); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php elseif($product['request_status'] == 2): ?>
            <!-- Card -->
                <div class="card mb-3 mb-lg-5 mt-2 mt-lg-3 bg-warning">
                    <!-- Body -->
                    <div class="card-body text-center">
                        <span class="text-dark"><?php echo e($product['denied_note']); ?></span>
                    </div>
                </div>
        <?php endif; ?>
        <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:">
                        <?php echo e(\App\CPU\translate('Product reviews')); ?>

                    </a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Page Header -->

        <!-- Card -->
        <div class="card mb-3 mb-lg-5">
            <!-- Body -->
            <div class="card-body">
                <div class="row align-items-md-center gx-md-5">
                    <div class="col-md-auto mb-3 mb-md-0">
                        <div class="d-flex align-items-center">
                            <img
                                class="avatar avatar-xxl avatar-4by3 <?php echo e(Session::get('direction') === "rtl" ? 'ml-4' : 'mr-4'); ?>"
                                onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                src="<?php echo e(\App\CPU\ProductManager::product_image_path('thumbnail')); ?>/<?php echo e($product['thumbnail']); ?>"
                                alt="Image Description">

                            <div class="d-block">
                                <h4 class="display-2 text-dark mb-0"><?php echo e(count($product->rating)>0?number_format($product->rating[0]->average, 2, '.', ' '):0); ?></h4>
                                <p> of <?php echo e($product->reviews->count()); ?> reviews
                                    <span
                                        class="badge badge-soft-dark badge-pill <?php echo e(Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'); ?>"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md">
                        <ul class="list-unstyled list-unstyled-py-2 mb-0">

                        <?php ($total=$product->reviews->count()); ?>
                        <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($five=\App\CPU\Helpers::rating_count($product['id'],5)); ?>
                                <span
                                    class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><?php echo e(\App\CPU\translate('5 star')); ?></span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($five/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($five/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>"><?php echo e($five); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($four=\App\CPU\Helpers::rating_count($product['id'],4)); ?>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><?php echo e(\App\CPU\translate('4 star')); ?></span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($four/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($four/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>"><?php echo e($four); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($three=\App\CPU\Helpers::rating_count($product['id'],3)); ?>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><?php echo e(\App\CPU\translate('3 star')); ?></span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($three/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($three/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span
                                    class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>"><?php echo e($three); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($two=\App\CPU\Helpers::rating_count($product['id'],2)); ?>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><?php echo e(\App\CPU\translate('2 star')); ?></span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($two/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($two/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>"><?php echo e($two); ?></span>
                            </li>
                            <!-- End Review Ratings -->

                            <!-- Review Ratings -->
                            <li class="d-flex align-items-center font-size-sm">
                                <?php ($one=\App\CPU\Helpers::rating_count($product['id'],1)); ?>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'); ?>"><?php echo e(\App\CPU\translate('1 star')); ?></span>
                                <div class="progress flex-grow-1">
                                    <div class="progress-bar" role="progressbar"
                                         style="width: <?php echo e($total==0?0:($one/$total)*100); ?>%;"
                                         aria-valuenow="<?php echo e($total==0?0:($one/$total)*100); ?>"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>"><?php echo e($one); ?></span>
                            </li>
                            <!-- End Review Ratings -->
                        </ul>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-4 pt-2">
                        <div class="flex-start">
                            <h4 class="border-bottom"><?php echo e($product['name']); ?></h4>
                        </div>
                        
                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Publisher')); ?> : </span>
                            <span class="mx-1"><?php echo e($product->publisher ? $product->publisher->name : ''); ?></span>
                        </div>

                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Writer')); ?> : </span>
                            <span class="mx-1"><?php echo e($product->writers->count() > 0 ? $product->writers[0]->name : ''); ?></span>
                        </div>

                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Translator')); ?> : </span>
                            <span class="mx-1"><?php echo e($product->translators->count() > 0 ? $product->translators[0]->name : ''); ?></span>
                        </div>

                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Editor')); ?> : </span>
                            <span class="mx-1"><?php echo e($product->editors->count() > 0 ? $product->editors[0]->name : ''); ?></span>
                        </div>

                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Category')); ?> : </span>
                            <span class="mx-1"><?php echo e($product->categories->count() > 0 ? $product->categories[0]->name : ''); ?></span>
                        </div>
                        
                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Price')); ?> : </span>
                            <span
                                class="mx-1"><?php echo e(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product['unit_price']))); ?></span>
                        </div>
                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('TAX')); ?> : </span>
                            <span class="mx-1"><?php echo e(($product['tax'])); ?> % </span>
                        </div>
                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Discount')); ?> : </span>
                            <span
                                class="mx-1"><?php echo e($product->discount_type=='flat'?(\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($product['discount']))): $product->discount.''.'%'); ?> </span>
                        </div>
                        <div class="flex-start">
                            <span><?php echo e(\App\CPU\translate('Current Stock')); ?> : </span>
                            <span class="mx-1"><?php echo e($product->current_stock); ?></span>
                        </div>
                    </div>

                    <div class="col-8 pt-2 border-left">

                        <span> <?php if(count(json_decode($product->colors)) > 0): ?>
                                <div class="row no-gutters">
                                <div class="col-2">
                                    <div class="product-description-label mt-2"><?php echo e(\App\CPU\translate('Available color')); ?>:
                                    </div>
                                </div>
                                <div class="col-10">
                                    <ul class="list-inline checkbox-color mb-1">
                                        <?php $__currentLoopData = json_decode($product->colors); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>

                                                <label style="background: <?php echo e($color); ?>;"
                                                       for="<?php echo e($product->id); ?>-color-<?php echo e($key); ?>"
                                                       data-toggle="tooltip"></label>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <?php endif; ?></span><br>
                        <span>
                        <?php echo e(\App\CPU\translate('Product Image')); ?>


                     <div class="row">
                         <?php $__currentLoopData = json_decode($product->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <div class="col-md-3">
                                 <div class="card">
                                     <div class="card-body">
                                         <img style="width: 100%"
                                              onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                              src="<?php echo e(asset("storage/app/public/product/$photo")); ?>" alt="Product image">

                                     </div>
                                 </div>
                             </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </div>
                    </span>
                    </div>
                </div>
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="card">
            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table class="table table-borderless table-thead-bordered table-nowrap card-table"
                       style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(\App\CPU\translate('Reviewer')); ?></th>
                        <th><?php echo e(\App\CPU\translate('Review')); ?></th>
                        <th><?php echo e(\App\CPU\translate('Date')); ?></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <a class="d-flex align-items-center"
                                   href="<?php echo e(route('admin.customer.view',[$review['customer_id']])); ?>">
                                    <div class="avatar avatar-circle">
                                        <img
                                            class="avatar-img"
                                            onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                            src="<?php echo e(asset('storage/app/public/profile/'.$review->customer->image)); ?>"
                                            alt="Image Description">
                                    </div>
                                    <div class="<?php echo e(Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'); ?>">
                                    <span class="d-block h5 text-hover-primary mb-0"><?php echo e($review->customer['f_name']." ".$review->customer['l_name']); ?> <i
                                            class="tio-verified text-primary" data-toggle="tooltip" data-placement="top"
                                            title="Verified Customer"></i></span>
                                        <span class="d-block font-size-sm text-body"><?php echo e($review->customer->email); ?></span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <div class="text-wrap" style="width: 18rem;">
                                    <div class="d-flex mb-2">
                                        <label class="badge badge-soft-info">
                                            <?php echo e($review->rating); ?> <i class="tio-star"></i>
                                        </label>
                                    </div>

                                    <p>
                                        <?php echo e($review['comment']); ?>

                                    </p>
                                </div>
                            </td>
                            <td>
                                <?php echo e(date('d M Y H:i:s',strtotime($review['created_at']))); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <?php echo $reviews->links(); ?>

            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/tags-input.min.js"></script>
    <script src="<?php echo e(asset('public/assets/select2/js/select2.min.js')); ?>"></script>
    <script>
        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });
        $(document).ready(function () {
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/product/view.blade.php ENDPATH**/ ?>