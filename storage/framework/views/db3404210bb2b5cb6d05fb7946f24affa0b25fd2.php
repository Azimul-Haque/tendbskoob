<?php $__env->startSection('title', \App\CPU\translate('Product Add')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <link href="<?php echo e(asset('public/assets/back-end/css/tags-input.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/assets/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="<?php echo e(route('admin.product.list', 'in_house')); ?>"><?php echo e(\App\CPU\translate('Product')); ?></a>
                </li>
                <li class="breadcrumb-item"><?php echo e(\App\CPU\translate('Add')); ?> <?php echo e(\App\CPU\translate('New')); ?> </li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="<?php echo e(route('admin.product.store')); ?>" method="POST"
                      style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                      enctype="multipart/form-data"
                      id="product_form">
                    <?php echo csrf_field(); ?>
                    

                    <div class="card">
                        <div class="card-header">
                            <h4>Add New Book</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="publisher_id"><?php echo e(\App\CPU\translate('Publication')); ?> *</label>
                                <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control" name="publisher_id[]" id="publisher_id" required>
                                    <option value="<?php echo e(old('publisher_id')); ?>" selected disabled>Select Publication</option>
                                    <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($publisher['id']); ?>" <?php echo e(old('name_bangla')==$publisher['id']? 'selected': ''); ?>>
                                            <?php echo e($publisher['name_bangla']); ?> (<?php echo e($publisher['name']); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="input-label" for="name_bangla"><?php echo e(\App\CPU\translate('Book Name (Bangla)')); ?> *</label>
                                        <input type="text" name="name_bangla" id="name_bangla" class="form-control" placeholder="Book Name in Bangla" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="input-label" for="name"><?php echo e(\App\CPU\translate('Book Name (English)')); ?> *</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Book Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name"><?php echo e(\App\CPU\translate('Writer')); ?></label>
                                    <select
                                        class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control"
                                        name="writer_id[]" id="writer_id" multiple>
                                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($writer['id']); ?>" <?php echo e(old('name_bangla')==$writer['id']? 'selected': ''); ?>>
                                                <?php echo e($writer['name_bangla']); ?> (<?php echo e($writer['name']); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select><br/><br/>
                                    
                                    <label for="name"><?php echo e(\App\CPU\translate('Translator')); ?></label>
                                    <select
                                        class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control"
                                        name="translator_id[]" id="translator_id" multiple>
                                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($translator['id']); ?>" <?php echo e(old('name_bangla')==$translator['id']? 'selected': ''); ?>>
                                                <?php echo e($translator['name_bangla']); ?> (<?php echo e($translator['name']); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select><br/><br/>

                                    <label for="name"><?php echo e(\App\CPU\translate('Editor')); ?></label>
                                    <select
                                        class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control" name="editor_id[]" id="editor_id" multiple>
                                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($editor['id']); ?>" <?php echo e(old('name_bangla')==$editor['id']? 'selected': ''); ?>>
                                                <?php echo e($editor['name_bangla']); ?> (<?php echo e($editor['name']); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select><br/><br/>

                                    <label for="name"><?php echo e(\App\CPU\translate('Category')); ?> *</label>
                                    <select class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control" name="category_id[]" id="category_id" multiple required>
                                        <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($c['id']); ?>" <?php echo e(old('name_bangla')==$c['id']? 'selected': ''); ?>>
                                                <?php echo e($c['name_bangla']); ?> (<?php echo e($c['name']); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><?php echo e(\App\CPU\translate('Book Image')); ?> *</label> <small
                                            style="color: red">(w: 260px, h: 372px)</small>
                                    </div>
                                    <center>
                                        <div style="max-width:200px;">
                                            <div class="row" id="thumbnail"></div>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="description"><?php echo e(\App\CPU\translate('description (Optional)')); ?></label>
                                <textarea name="description" class="editor textarea" id="textarea" cols="30" rows="10"><?php echo e(old('description')); ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    

                    

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4><?php echo e(\App\CPU\translate('Product price & stock')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label"><?php echo e(\App\CPU\translate('ISBN Number')); ?></label>
                                        <input type="number" min="0" step="0.01"
                                               placeholder="<?php echo e(\App\CPU\translate('ISBN Number')); ?>"
                                               name="isbn" value="<?php echo e(old('isbn')); ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label
                                            class="control-label"><?php echo e(\App\CPU\translate('Book Weight (KG)')); ?></label>
                                        <input type="number" min="0" step="0.01"
                                               placeholder="<?php echo e(\App\CPU\translate('Book Weight')); ?>"
                                               value="<?php echo e(old('weight')); ?>" name="weight" class="form-control">
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-md-4">
                                        <label
                                            class="control-label"><?php echo e(\App\CPU\translate('Purchase Price')); ?> (৳)</label>
                                        <input type="number" min="0" step="0.01"
                                               placeholder="<?php echo e(\App\CPU\translate('Purchase Price')); ?>"
                                               value="<?php echo e(old('purchase_price')); ?>"
                                               name="purchase_price" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"><?php echo e(\App\CPU\translate('Published Price')); ?> (৳)</label>
                                        <input type="number" min="0" step="0.01"
                                               placeholder="<?php echo e(\App\CPU\translate('Published Price')); ?>"
                                               name="published_price" value="<?php echo e(old('published_price')); ?>" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"><?php echo e(\App\CPU\translate('Sale Price')); ?> (৳)</label>
                                        <input type="number" min="0" step="0.01"
                                               placeholder="<?php echo e(\App\CPU\translate('Sale Price')); ?>"
                                               name="unit_price" value="<?php echo e(old('unit_price')); ?>" class="form-control"
                                               required>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    
                                    <div class="col-md-6" id="quantity">
                                        <label
                                            class="control-label"><?php echo e(\App\CPU\translate('total')); ?> <?php echo e(\App\CPU\translate('Quantity')); ?></label>
                                        <input type="number" min="0" value="0" step="1"
                                               placeholder="<?php echo e(\App\CPU\translate('Quantity')); ?>"
                                               name="current_stock" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                <button type="button" onclick="check()" class="btn btn-primary"><?php echo e(\App\CPU\translate('Submit')); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/tags-input.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end/js/spartan-multi-image-picker.js')); ?>"></script>
    <script>
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 4,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '<?php echo e(asset('public/assets/back-end/img/400x400/img2.jpg')); ?>',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('<?php echo e(\App\CPU\translate('Please only input png or jpg type file')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('<?php echo e(\App\CPU\translate('File size too big')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '<?php echo e(asset('public/assets/back-end/img/book_demo.jpg')); ?>',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('<?php echo e(\App\CPU\translate('Please only input png or jpg type file')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('<?php echo e(\App\CPU\translate('File size too big')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#meta_img").spartanMultiImagePicker({
                fieldName: 'meta_image',
                maxCount: 1,
                rowHeight: '280px',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '<?php echo e(asset('public/assets/back-end/img/400x400/img2.jpg')); ?>',
                    width: '90%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('<?php echo e(\App\CPU\translate('Please only input png or jpg type file')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('<?php echo e(\App\CPU\translate('File size too big')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });


        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            // dir: "rtl",
            width: 'resolve'
        });

        $("#publisher_id").select2({
            placeholder: "Select Publication",
        });

        $("#writer_id").select2({
            placeholder: "Select Witer",
            multiple: true,
        });

        $("#translator_id").select2({
            placeholder: "Select Translator",
            multiple: true,
        });

        $("#editor_id").select2({
            placeholder: "Select Editor",
            multiple: true,
        });

        $("#category_id").select2({
            placeholder: "Select Category",
            multiple: true,
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    if (type == 'select') {
                        $('#' + id).empty().append(data.select_tag);
                    }
                },
            });
        }

        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append('<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="<?php echo e(trans('Choice Title')); ?>" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="<?php echo e(trans('Enter choice values')); ?>" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }


        $('#colors-selector').on('change', function () {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function () {
            // update_sku();
        });

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '<?php echo e(route('admin.product.sku-combination')); ?>',
                data: $('#product_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        $(document).ready(function () {
            // color select select2
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

    <script>
        function check(){
            Swal.fire({
                title: '<?php echo e(\App\CPU\translate('Are you sure')); ?>?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var formData = new FormData(document.getElementById('product_form'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '<?php echo e(route('admin.product.store')); ?>',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                            console.log(data.errors);
                        } else {
                            toastr.success('<?php echo e(\App\CPU\translate('product added successfully')); ?>!', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('#product_form').submit();
                        }
                    }
                });
            })
        };
    </script>

    

    
    
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="<?php echo e(asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            // $('.textarea').ckeditor({
            //     // contentsLangDirection : '<?php echo e(Session::get('direction')); ?>',
            // });
            CKEDITOR.replace('textarea', {
                toolbar : 'Basic',
            });
        });
    </script>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/product/add-new.blade.php ENDPATH**/ ?>