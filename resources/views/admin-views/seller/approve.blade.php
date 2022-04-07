@extends('layouts.back-end.app')

@section('title', $seller->name? $seller->name : \App\CPU\translate("Shop Name"))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">{{\App\CPU\translate('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('Seller_Edit')}}</li>
                <li class="breadcrumb-item" aria-current="page">{{ $seller->name }}</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="{{route('admin.sellers.seller-list')}}" class="btn btn-primary mt-3 mb-3">{{\App\CPU\translate('Back_to_seller_list')}}</a>
            </div>
            <div>
                <h3>
                    Seller Status: 
                    @if ($seller->status=="active")
                        <span class="badge badge-success">Active</span>
                    @elseif ($seller->status=="pending")
                        <span class="badge badge-info">Pending</span>
                    @elseif ($seller->status=="suspended")
                        <span class="badge badge-danger">Suspended</span>
                    @endif
                </h3>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <div class=" gx-2 gx-lg-3 mb-2">
                    <div>
                        <h4><i style="font-size: 30px"
                               class="tio-edit"></i>{{\App\CPU\translate('Seller_Approve')}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if ($seller->status=="pending")
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="approved">
                                <div class="form-group">
                                    <label for="publisher_id">{{\App\CPU\translate('Publication')}}</label>
                                    <select
                                        class="js-example-basic-multiple js-states js-example-responsive form-control" name="publisher_id" id="publisher_id" required>
                                        <option value="{{ old('publisher_id') }}" selected disabled>Select Publication</option>
                                        @foreach($publishers as $publisher)
                                            <option value="{{ $publisher['id'] }}" {{ old('name_bangla')==$publisher['id']? 'selected': '' }}>
                                                {{ $publisher['name_bangla'] }} ({{ $publisher['name'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">{{\App\CPU\translate('Approve')}}</button>
                            </form>
                            {{-- <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">{{\App\CPU\translate('reject')}}</button>
                            </form> --}}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection

@push('script')
    <script>
        function Validate(file) {
            var x;
            var le = file.length;
            var poin = file.lastIndexOf(".");
            var accu1 = file.substring(poin, le);
            var accu = accu1.toLowerCase();
            if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
                x = 1;
                return x;
            } else {
                x = 0;
                return x;
            }
        }

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

        function readlogoURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerLogo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#LogoUpload").change(function () {
            readlogoURL(this);
        });
        $("#BannerUpload").change(function () {
            readBannerURL(this);
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
    </script>
@endpush
