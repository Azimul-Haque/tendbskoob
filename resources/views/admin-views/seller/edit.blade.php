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
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="{{route('admin.sellers.seller-list')}}" class="btn btn-primary mt-3 mb-3">{{\App\CPU\translate('Back_to_seller_list')}}</a>
            </div>
            <div>
                @if ($seller->status=="pending")
                    <div class="mt-4 pr-2 float-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}">
                        <div class="flex-start">
                            <h4 class="mx-1"><i class="tio-shop-outlined"></i></h4>
                            <div><h4>{{\App\CPU\translate('Seller_request_for_open_a_shop.')}}</h4></div>
                        </div>
                        <div class="text-center">
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary">{{\App\CPU\translate('Approve')}}</button>
                            </form>
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">{{\App\CPU\translate('reject')}}</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <div class=" gx-2 gx-lg-3 mb-2">
                    <div>
                        <h4><i style="font-size: 30px"
                               class="tio-edit"></i>{{\App\CPU\translate('Seller_Edit')}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 for-card col-md-6 mt-4" style="cursor: pointer">
                            s
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection

@push('script')

@endpush
