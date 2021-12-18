@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Author'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('Writer/ Translators/ Editors')}}</li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        {{-- {{ \App\CPU\translate('category_form')}} --}}
                        Writer/ Translators/ Editors Form
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <form action="{{route('admin.author.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Name *</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Writer/Translator/Editor Name" required>
                                    </div>
                                    <input name="position" value="0" style="display: none">
                                </div>
                                <div class="col-6">
                                    <div class="form-group"
                                         id="{">
                                        <label class="input-label"
                                               for="name">Bangla Name *</label>
                                        <input type="text" name="name_bangla" class="form-control"
                                               placeholder="Name in Bangla" required>
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
                                    <label>{{\App\CPU\translate('image')}} (Optional)</label><small style="color: red">
                                        ( {{\App\CPU\translate('ratio')}} 1:1 )</small>
                                    <div class="custom-file" style="text-align: left">
                                        <input type="file" name="image" id="customFileEg1"
                                               class="custom-file-input"
                                               accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        <label class="custom-file-label"
                                               for="customFileEg1">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                                    </div><br/><br/>
                                    <div class="form-group">
                                        <center>
                                            <img
                                                style="width: 30%;border: 1px solid; border-radius: 10px;"
                                                id="viewer"
                                                src="{{asset('public/assets/back-end/img/400x400/img1.jpg')}}"
                                                alt="image"/>
                                        </center>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{\App\CPU\translate('submit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        {{-- {{ \App\CPU\translate('category_form')}} --}}
                        <h3>Bulk Author Upload Form</h3>
                    </div>
                    <div class="card-body" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                        <form action="{{route('admin.author.bulkupload')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Excel File</label><small style="color: red">
                                (.xlsx, .xls )</small>
                            <div class="custom-file" style="text-align: left">
                                <input type="file" name="excelfile" id="excelFileUpload"
                                       class="custom-file-input"
                                       accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required="">
                                <label class="custom-file-label"
                                       for="excelFileUpload">{{\App\CPU\translate('choose')}} {{\App\CPU\translate('file')}}</label>
                            </div><br/><br/>
                            <div class="form-group">
                                <center>
                                    <img
                                        style="width: 40px;"
                                        id="excelviewer"
                                        src="{{asset('public/assets/back-end/img/white.png')}}"
                                        alt="excelfile"/>
                                    <span id="excelviewertxt"></span>
                                </center>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">{{\App\CPU\translate('submit')}}</button>
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
                                <h5>{{ \App\CPU\translate('author_table')}} <span style="color: red;">({{ $authors->count() }})</span></h5>
                            </div>
                            <div style="width: 30vw">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="" type="search" name="search" class="form-control"
                                            placeholder="" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn-primary">{{\App\CPU\translate('search')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0">
                        <div class="table-responsive">
                            <table style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{ \App\CPU\translate('name')}}</th>
                                    <th>{{ \App\CPU\translate('slug')}}</th>
                                    <th>{{ \App\CPU\translate('image')}}</th>
                                    <th class="text-center" style="width:15%;">{{ \App\CPU\translate('action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $key=>$author)
                                    <tr>
                                        <td>{{ $author->name }}<br/> {{ $author->name_bangla }}</td>
                                        <td>{{$author['slug']}}</td>
                                        <td>
                                            {{-- {{ asset('public/images/author/' . $author['image']) }} --}}
                                            <img width="64"
                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                 src="{{ asset('public/images/author/' . $author['image']) }}">
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm edit" style="cursor: pointer;"
                                               href="{{route('admin.author.edit',[$author['id']])}}">
                                                <i class="tio-edit"></i>{{ \App\CPU\translate('Edit')}}
                                            </a>
                                            <button class="btn btn-danger btn-sm delete" style="cursor: pointer;"
                                               id="{{$author['id']}}" disabled>
                                                <i class="tio-add-to-trash"></i>{{ \App\CPU\translate('Delete')}}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        {{$authors->links()}}
                    </div>
                    @if(count($authors)==0)
                        <div class="text-center p-4">
                            <img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                            <p class="mb-0">{{\App\CPU\translate('no_data_found')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

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
        {{-- //     if (lang == '- {{$default_lang}}- ') { --}}
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
                title: '{{\App\CPU\translate('Are_you_sure')}}?',
                text: "{{\App\CPU\translate('You_will_not_be_able_to_revert_this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{\App\CPU\translate('Yes')}}, {{\App\CPU\translate('delete_it')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "admin/author/delete/",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{\App\CPU\translate('Author_deleted_Successfully.')}}');
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
            $('#excelviewer').attr('src', '{{asset('public/assets/back-end/img/excel.png')}}');
            var fileName = $('#excelFileUpload').val().match(/[^\\/]*$/)[0];
            $('#excelviewertxt').text(fileName);
        });
    </script>
@endpush
