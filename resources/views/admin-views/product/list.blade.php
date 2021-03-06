@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Book List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">  <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('Books')}}</li>
        </ol>
    </nav>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row flex-between justify-content-between align-items-center flex-grow-1">
                        <div>
                            <h5 class="flex-between">
                                <div>{{\App\CPU\translate('book_table')}}</div>
                                <div style="color: red; padding: 0 .4375rem;">({{ $pro->total() }})</div>
                            </h5>
                        </div>
                        <div style="width: 40vw">
                            <!-- Search -->
                            <form action="{{ url()->current() }}" method="GET">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                           placeholder="{{\App\CPU\translate('Search Book')}}" aria-label="Search orders"
                                           value="{{ $search }}" required>
                                    <input type="hidden" value="{{ $request_status }}" name="status">
                                    <button type="submit" class="btn btn-primary">{{\App\CPU\translate('search')}}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                        <div>
                            <a href="{{route('admin.product.add-new')}}" class="btn btn-primary  float-right">
                                <i class="tio-add-circle"></i>
                                <span class="text">{{\App\CPU\translate('Add New Book')}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               style="width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th>{{\App\CPU\translate('SL#')}}</th>
                                <th>{{\App\CPU\translate('Book Name')}}</th>
                                <th>
                                    @if ($orderby && $orderby == 'asc')
                                        <a href="{{ request()->fullUrlWithQuery(['orderby' => 'desc']) }}" style="font-weight: 900!important;">
                                            <i class="fa fa-sort-alpha-asc"></i> {{ \App\CPU\translate('Publication (ASC)')}}
                                        </a>
                                    @else
                                        <a href="{{ request()->fullUrlWithQuery(['orderby' => 'asc']) }}" style="font-weight: 900!important;">
                                            <i class="fa fa-sort-alpha-desc"></i> {{ \App\CPU\translate('Publication (DESC)')}}
                                        </a>
                                    @endif
                                </th>
                                <th>Price</th>
                                @if($type == 'seller')
                                    <th>Aprrove Status</th>
                                @endif
                                
                                @if(auth('admin')->user()->role->name != 'Master Admin' && auth('admin')->user()->role->name != 'Admin')
                                    
                                @else
                                    <th>Status</th>
                                @endif
                                <th>Stocks</th>
                                <th>Stock Status</th>
                                <th style="width: 5px" class="text-center">{{\App\CPU\translate('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($orderby && $orderby == 'asc')
                                @foreach($pro->sortBy('publisher.name_bangla') as $k=>$p)
                                    <tr>
                                        <th scope="row">{{$pro->firstItem()+$k}}</th>
                                        <td>
                                            <a href="{{route('admin.product.view',[$p['id']])}}"
                                            title="{{ $p['name_bangla'] }}&#10;{{ $p['name'] }}">
                                                {{\Illuminate\Support\Str::limit($p['name_bangla'],25)}}<br/>
                                                {{\Illuminate\Support\Str::limit($p['name'],20)}}
                                            </a>
                                            <?php
                                                $category_names = [];
                                                if($p->categories->count() > 0) {
                                                    for($i = 0; $i < count($p->categories); $i++){
                                                        $category_names[] = $p->categories[$i]->name;
                                                    }
                                                }
                                            ?>
                                            @if(in_array('Pre Order', $category_names))
                                                <label style="background-color: #FF9900 !important; color: #FFFFFF !important;" class="badge badge-danger stock-out">Pre Order</label><br/><br/>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $p->publisher->name_bangla }}
                                            @if($p->added_by == 'seller')
                                                <br/>{{ $p->publisher->seller ? $p->publisher->seller->name : '' }}
                                            @endif
                                        </td>
                                        <td>
                                            <small>
                                                {{\App\CPU\translate('purchase')}}: 
                                                <b>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}</b>
                                            </small><br/>
                                            <small>
                                                {{\App\CPU\translate('published')}}: 
                                                <b>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['published_price']))}}</b>
                                            </small><br/>
                                            <small>
                                                {{\App\CPU\translate('sale')}}: 
                                                <b>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}</b>
                                            </small>
                                        </td>
                                        @if(auth('admin')->user()->role->name != 'Master Admin' && auth('admin')->user()->role->name != 'Admin')
                                    
                                        @else
                                            @if($p->added_by == 'seller')
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            onclick="approve_status('{{$p['id']}}')" {{$p->request_status == 1?'checked':''}}>
                                                        <span class="slider round"></span>
                                                    </label><br/>
                                                </td>
                                            @endif
                                            <td>
                                                Featured: 
                                                <label class="switch">
                                                    <input type="checkbox"
                                                        onclick="featured_status('{{$p['id']}}')" {{$p->featured == 1?'checked':''}}>
                                                    <span class="slider round"></span>
                                                </label><br/>
                                                Active: 
                                                <label class="switch switch-status">
                                                    <input type="checkbox" class="status"
                                                        id="{{$p['id']}}" {{$p->status == 1?'checked':''}}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        @endif
                                        
                                        <td>
                                            {{ $p->current_stock }}
                                        </td>
                                        <td>
                                            <select id="stock_status{{$p['id']}}" onchange="stock_status('{{$p['id']}}')" class="form-control" style="width: 140px;">
                                                <option value="1" {{$p->stock_status == 1?'selected':''}}>In Stock</option>
                                                <option value="2" {{$p->stock_status == 2?'selected':''}}>Out of Stock</option>
                                                <option value="3" {{$p->stock_status == 3?'selected':''}}>Back Order</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                            href="{{route('admin.product.edit',[$p['id']])}}">
                                                <i class="tio-edit"></i> {{\App\CPU\translate('Edit')}}
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="javascript:"
                                            onclick="form_alert('product-{{$p['id']}}','Want to delete this Book ?')">
                                                <i class="tio-add-to-trash"></i> {{\App\CPU\translate('Delete')}}
                                            </a>
                                            <form action="{{route('admin.product.delete',[$p['id']])}}"
                                                method="post" id="product-{{$p['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($pro->sortByDesc('publisher.name_bangla') as $k=>$p)
                                    <tr>
                                        <th scope="row">{{$pro->firstItem()+$k}}</th>
                                        <td>
                                            <a href="{{route('admin.product.view',[$p['id']])}}"
                                            title="{{ $p['name_bangla'] }}&#10;{{ $p['name'] }}">
                                                {{\Illuminate\Support\Str::limit($p['name_bangla'],25)}}<br/>
                                                {{\Illuminate\Support\Str::limit($p['name'],20)}}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $p->publisher->name_bangla }}
                                        </td>
                                        <td>
                                            <small>
                                                {{\App\CPU\translate('purchase')}}: 
                                                <b>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}</b>
                                            </small><br/>
                                            <small>
                                                {{\App\CPU\translate('published')}}: 
                                                <b>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['published_price']))}}</b>
                                            </small><br/>
                                            <small>
                                                {{\App\CPU\translate('sale')}}: 
                                                <b>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}</b>
                                            </small>
                                        </td>
                                        @if($p->added_by == 'seller')
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox"
                                                        onclick="approve_status('{{$p['id']}}')" {{$p->request_status == 1?'checked':''}}>
                                                    <span class="slider round"></span>
                                                </label><br/>
                                            </td>
                                        @endif
                                        <td>
                                            Featured: 
                                            <label class="switch">
                                                <input type="checkbox"
                                                    onclick="featured_status('{{$p['id']}}')" {{$p->featured == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label><br/>
                                            Active: 
                                            <label class="switch switch-status">
                                                <input type="checkbox" class="status"
                                                    id="{{$p['id']}}" {{$p->status == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            {{ $p->current_stock }}
                                        </td>
                                        <td>
                                            <select id="stock_status{{$p['id']}}" onchange="stock_status('{{$p['id']}}')" class="form-control" style="width: 140px;">
                                                <option value="1" {{$p->stock_status == 1?'selected':''}}>In Stock</option>
                                                <option value="2" {{$p->stock_status == 2?'selected':''}}>Out of Stock</option>
                                                <option value="3" {{$p->stock_status == 3?'selected':''}}>Back Order</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                            href="{{route('admin.product.edit',[$p['id']])}}">
                                                <i class="tio-edit"></i> {{\App\CPU\translate('Edit')}}
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="javascript:"
                                            onclick="form_alert('product-{{$p['id']}}','Want to delete this item ?')">
                                                <i class="tio-add-to-trash"></i> {{\App\CPU\translate('Delete')}}
                                            </a>
                                            <form action="{{route('admin.product.delete',[$p['id']])}}"
                                                method="post" id="product-{{$p['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$pro->links()}}
                </div>
                @if(count($pro)==0)
                    <div class="text-center p-4">
                        <img class="mb-3" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">
                        <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="https://use.fontawesome.com/112ed7653e.js"></script>
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function (data) {
                    if(data.success == true) {
                        toastr.success('{{\App\CPU\translate('Status updated successfully')}}');
                    }
                    else if(data.success == false) {
                        toastr.error('{{\App\CPU\translate('Status updated failed. Product must be approved')}}');
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        function approve_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.approve-status')}}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function () {
                    toastr.success('{{\App\CPU\translate('Book has been approved successfully')}}');
                }
            });
        }

        function featured_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.featured-status')}}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function () {
                    toastr.success('{{\App\CPU\translate('Featured status updated successfully')}}');
                }
            });
        }

        function stock_status(id) {
            var stock_status_val = $('#stock_status' + id).val();
            // console.log(stock_status_val);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.product.stock-status')}}",
                method: 'POST',
                data: {
                    id: id,
                    stock_status: stock_status_val,
                },
                success: function () {
                    toastr.success('{{\App\CPU\translate('Stock status updated successfully')}}');
                }
            });
        }

    </script>
@endpush
