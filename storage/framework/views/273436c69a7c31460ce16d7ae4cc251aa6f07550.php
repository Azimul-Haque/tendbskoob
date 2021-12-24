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
                        <form action="<?php echo e(route('admin.publisher.update',[$publisher['id']])); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Name *</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo e($publisher->name); ?>" placeholder="Publication Name" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Bangla Name *</label>
                                        <input type="text" name="name_bangla" class="form-control" value="<?php echo e($publisher->name_bangla); ?>" placeholder="Publication Name in Bangla" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="description">Description (Optional)</label>
                                        <textarea class="form-control" style="min-height: 150px;" name="description" placeholder="Description"><?php echo e($publisher->description); ?></textarea>
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
                                                style="width: 40%;border: 1px solid; border-radius: 10px;"
                                                id="viewer"
                                                onerror="this.src='<?php echo e(asset('public/assets/back-end/img/900x400/img1.jpg')); ?>'"
                                                src="<?php echo e(asset('public/images/publisher/' . $publisher->image)); ?>"
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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

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
                        url: "admin/publisher/delete/",
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

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/admin-views/publisher/edit.blade.php ENDPATH**/ ?>