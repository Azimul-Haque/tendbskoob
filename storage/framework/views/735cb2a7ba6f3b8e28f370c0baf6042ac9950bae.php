<?php $__env->startSection('title', \App\CPU\translate('FAQ')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>

        .switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #377dff;
        }

        input:focus + .slider {
            background-color: #377dff;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .for-addFaq {
            float: right;
        }

        @media (max-width: 500px) {
            .for-addFaq {
                float: none !important;
            }
        }

    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><?php echo e(\App\CPU\translate('Dashboard')); ?></a>
                </li>
                <li class="breadcrumb-item"
                    aria-current="page"><?php echo e(\App\CPU\translate('Dashboard')); ?><?php echo e(\App\CPU\translate('help_topic')); ?></li>
            </ol>
        </nav>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo e(\App\CPU\translate('help_topic')); ?> <?php echo e(\App\CPU\translate('Table')); ?> </h5>
                        <button class="btn btn-primary btn-icon-split for-addFaq" data-toggle="modal"
                                data-target="#addModal">
                            <i class="tio-add-circle"></i>
                            <span class="text"><?php echo e(\App\CPU\translate('Add')); ?> <?php echo e(\App\CPU\translate('faq')); ?>  </span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                   style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                                <thead>
                                <tr>
                                    <th scope="col"><?php echo e(\App\CPU\translate('SL')); ?>#</th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('Question')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('Answer')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('Ranking')); ?></th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('Status')); ?> </th>
                                    <th scope="col"><?php echo e(\App\CPU\translate('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $helps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$help): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td scope="row"><?php echo e($k+1); ?></td>
                                        <td><?php echo e($help['question']); ?></td>
                                        <td><?php echo e($help['answer']); ?></td>
                                        <td><?php echo e($help['ranking']); ?></td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status status_id"
                                                       data-id="<?php echo e($help->id); ?>" <?php echo e($help->status == 1?'checked':''); ?>>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            

                                            
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item edit" style="cursor: pointer;"
                                                       data-toggle="modal" data-target="#editModal"
                                                       data-id="<?php echo e($help->id); ?>">
                                                        <?php echo e(\App\CPU\translate('Edit')); ?>

                                                    </a>
                                                    <a class="dropdown-item delete" style="cursor: pointer;"
                                                       id="<?php echo e($help['id']); ?>"> <?php echo e(\App\CPU\translate('Delete')); ?></a>
                                                </div>
                                            </div>
                                            </a>
                                        </td>


                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(\App\CPU\translate('Add Help Topic')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('admin.helpTopic.add-new')); ?>" method="post" id="addForm">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">

                            <div class="form-group">
                                <label><?php echo e(\App\CPU\translate('Question')); ?></label>
                                <input type="text" class="form-control" name="question" placeholder="<?php echo e(\App\CPU\translate('Type Question')); ?>">
                            </div>


                            <div class="form-group">
                                <label><?php echo e(\App\CPU\translate('Answer')); ?></label>
                                <textarea class="form-control" name="answer" cols="5"
                                          rows="5" placeholder="<?php echo e(\App\CPU\translate('Type Answer')); ?>"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="control-label"><?php echo e(\App\CPU\translate('Status')); ?></div>
                                        <label class="custom-switch" style="margin-left: -2.25rem;margin-top: 10px;">
                                            <input type="checkbox" name="status" id="e_status" value="1"
                                                   class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description"><?php echo e(\App\CPU\translate('Active')); ?></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="ranking"><?php echo e(\App\CPU\translate('Ranking')); ?></label>
                                    <input type="number" name="ranking" class="form-control" autofoucs>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(\App\CPU\translate('Close')); ?></button>
                            <button class="btn btn-primary"><?php echo e(\App\CPU\translate('Save')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(\App\CPU\translate('Edit Modal Help Topic')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editForm" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>;">
                    <?php echo csrf_field(); ?>
                    
                    <div class="modal-body">

                        <div class="form-group">
                            <label><?php echo e(\App\CPU\translate('Question')); ?></label>
                            <input type="text" class="form-control" name="question" placeholder="<?php echo e(\App\CPU\translate('Type Question')); ?>"
                                   id="e_question" class="e_name">
                        </div>


                        <div class="form-group">
                            <label><?php echo e(\App\CPU\translate('Answer')); ?></label>
                            <textarea class="form-control" name="answer" cols="5"
                                      rows="5" placeholder="<?php echo e(\App\CPU\translate('Type Answer')); ?>" id="e_answer"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>

                            <div class="col-md-4">
                                <label for="ranking"><?php echo e(\App\CPU\translate('Ranking')); ?></label>
                                <input type="number" name="ranking" class="form-control" id="e_ranking" required
                                       autofoucs>
                            </div>
                            <div class="col-md-4">

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(\App\CPU\translate('Close')); ?></button>
                        <button class="btn btn-primary"><?php echo e(\App\CPU\translate('update')); ?></button>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <!-- Page level plugins -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(asset('public/assets/back-end')); ?>/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
        $(document).on('click', ".status_id", function () {
            let id = $(this).attr('data-id');

            $.ajax({
                url: "status/" + id,
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    toastr.success(res.success);
                    window.location.reload();
                }

            });

        });
        $(document).on('click', '.edit', function () {
            let id = $(this).attr("data-id");
            console.log(id);
            $.ajax({
                url: "edit/" + id,
                type: "get",
                data: {"_token": "<?php echo e(csrf_token()); ?>"},
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    $("#e_question").val(data.question);
                    $("#e_answer").val(data.answer);
                    $("#e_ranking").val(data.ranking);


                    $("#editForm").attr("action", "update/" + data.id);


                }
            });
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '<?php echo e(\App\CPU\translate('Are you sure delete this FAQ')); ?>?',
                text: "<?php echo e(\App\CPU\translate('You will not be able to revert this')); ?>!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?php echo e(\App\CPU\translate('Yes, delete it')); ?>!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "<?php echo e(route('admin.helpTopic.delete')); ?>",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('<?php echo e(\App\CPU\translate('FAQ deleted successfully')); ?>');
                            location.reload();
                        }
                    });
                }
            })
        });


    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.back-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\booksbd\resources\views/admin-views/help-topics/list.blade.php ENDPATH**/ ?>