<?php $__env->startSection('title', \App\CPU\translate('Publications')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><?php echo e(\App\CPU\translate('Publications')); ?></li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        
                        Publications Form
                    </div>
                    <div class="card-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <form action="<?php echo e(route('admin.publisher.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Name *</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Publication Name" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Bangla Name *</label>
                                        <input type="text" name="name_bangla" class="form-control"
                                               placeholder="Publication Name in Bangla" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="description">Description (Optional)</label>
                                        <textarea class="form-control" style="min-height: 150px;" name="description" placeholder="Description"></textarea>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6 from_part_2">
                                    <label><?php echo e(\App\CPU\translate('image')); ?> (Optional)</label><small style="color: red">
                                        ( <?php echo e(\App\CPU\translate('ratio')); ?> 1:1 )</small>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileEg1"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileEg1"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                                    </div><br/><br/>
                                    <div class="form-group">
                                        <center>
                                            <img
                                                style="width: 30%;border: 1px solid; border-radius: 10px;"
                                                id="viewer"
                                                src="<?php echo e(asset('public/assets/back-end/img/400x400/img1.jpg')); ?>"
                                                alt="image"/>
                                        </center>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('submit')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        
                        <h3>Bulk Publication Upload Form</h3>
                    </div>
                    <div class="card-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                        <form action="<?php echo e(route('admin.publisher.bulkupload')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <label>Excel File</label><small style="color: red">
                                (.xlsx, .xls )</small>
                            <div class="custom-file" style="text-align: left">
                                <input type="file" name="excelfile" id="excelFileUpload"
                                       class="custom-file-input"
                                       accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="">
                                <label class="custom-file-label"
                                       for="excelFileUpload"><?php echo e(\App\CPU\translate('choose')); ?> <?php echo e(\App\CPU\translate('file')); ?></label>
                            </div><br/><br/>
                            <div class="form-group">
                                <center>
                                    <img
                                        style="width: 40px;"
                                        id="excelviewer"
                                        src="<?php echo e(asset('public/assets/back-end/img/white.png')); ?>"
                                        alt="excelfile"/>
                                    <span id="excelviewertxt"></span>
                                </center>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('submit')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 20px" id="cate-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="flex-between justify-content-between align-items-center flex-grow-1">
                            <div>
                                <h5><?php echo e(\App\CPU\translate('publication_table')); ?> <span style="color: red;">(<?php echo e($publishers->total()); ?>)</span></h5>
                            </div>
                            <div style="width: 30vw">
                                <!-- Search -->
                                <form action="<?php echo e(url()->current()); ?>" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="" type="search" name="search" class="form-control" placeholder="" value="<?php echo e($search); ?>" required>
                                        <button type="submit" class="btn btn-primary"><?php echo e(\App\CPU\translate('search')); ?></button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(\App\CPU\translate('Publisher ID')); ?></th>
                                    <th>
                                        <?php if($orderby && $orderby == 'asc'): ?>
                                            <a href="<?php echo e(request()->fullUrlWithQuery(['orderby' => 'desc'])); ?>" style="font-weight: 900!important;">
                                                <i class="fa fa-sort-alpha-asc"></i> <?php echo e(\App\CPU\translate('name (ASC)')); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(request()->fullUrlWithQuery(['orderby' => 'asc'])); ?>" style="font-weight: 900!important;">
                                                <i class="fa fa-sort-alpha-desc"></i> <?php echo e(\App\CPU\translate('name (DESC)')); ?>

                                            </a>
                                        <?php endif; ?>
                                    </th>
                                    <th><?php echo e(\App\CPU\translate('slug')); ?></th>
                                    <th><?php echo e(\App\CPU\translate('image')); ?></th>
                                    <th class="text-center" style="width:15%;"><?php echo e(\App\CPU\translate('action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $publishers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$publisher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($publisher->id); ?></td>
                                        <td><?php echo e($publisher->name_bangla); ?><br/> <?php echo e($publisher->name); ?></td>
                                        <td><?php echo e($publisher['slug']); ?></td>
                                        <td>
                                            
                                            <img width="64"
                                                 onerror="this.src='<?php echo e(asset('public/assets/front-end/img/image-place-holder.png')); ?>'"
                                                 src="<?php echo e(asset('public/images/publisher/' . $publisher['image'])); ?>">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm edit" style="cursor: pointer;"
                                               href="<?php echo e(route('admin.publisher.edit',[$publisher['id']])); ?>">
                                                <i class="tio-edit"></i><?php echo e(\App\CPU\translate('Edit')); ?>

                                            </a>
                                            <button class="btn btn-danger btn-sm delete" style="cursor: pointer;"
                                               id="<?php echo e($publisher['id']); ?>">
                                                <i class="tio-add-to-trash"></i><?php echo e(\App\CPU\translate('Delete')); ?>

                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?php echo e($publishers->links()); ?>

                    </div>
                    <?php if(count($publishers)==0): ?>
                        <div class="text-center p-4">
                            <img class="mb-3" src="<?php echo e(asset('public/assets/back-end')); ?>/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0"><?php echo e(\App\CPU\translate('no_data_found')); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="https://use.fontawesome.com/112ed7653e.js"></script>
    <script>
        // $(".lang_link").click(function (e) {
        //     e.preventDefault();
        //     $(".lang_link").removeClass('active');
        //     $(".lang_form").addClass('d-none');
        //     $(this).addClass('active');

        //     let form_id = this.id;
        //     let lang = form_id.split("-")[0];
        //     console.log(lang);
        //     $("#" + lang + "-form").removeClass('d-none');
        
        //         $(".from_part_2").removeClass('d-none');
        //     } else {
        //         $(".from_part_2").addClass('d-none');
        //     }
        // });

        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

    <script>
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '<?php echo e(\App\CPU\translate('Are_you_sure')); ?>?',
                text: "<?php echo e(\App\CPU\translate('You_will_not_be_able_to_revert_this')); ?>!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(\App\CPU\translate('Yes')); ?>, <?php echo e(\App\CPU\translate('delete_it')); ?>!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('admin.publisher.delete')); ?>",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('<?php echo e(\App\CPU\translate('Publisher_deleted_Successfully.')); ?>');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });

        $("#excelFileUpload").change(function () {
            $('#excelviewer').attr('src', '<?php echo e(asset('public/assets/back-end/img/excel.png')); ?>');
            var fileName = $('#excelFileUpload').val().match(/[^\\/]*$/)[0];
            $('#excelviewertxt').text(fileName);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/publisher/index.blade.php ENDPATH**/ ?>