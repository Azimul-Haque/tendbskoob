@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('All Category Page'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Publication of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Publication of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
    <style>
        .brand_div {
            background: #fcfcfc no-repeat padding-box;
            border: 1px solid #e2f0ff;
            border-radius: 3px;
            opacity: 1;
            padding: 5px;
        }
    </style>
@endpush

@section('content')

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <div class="col-md-3 p-3 feature_header">
                <span style="margin-right: 15px;">{{\App\CPU\translate('Category')}}</span> 
            </div>
            <div class="col-md-6 p-3 feature_header">
                <div>
                    <!-- Search -->
                    <form action="{{ url()->current() }}" method="GET">
                        <div class="input-group input-group-merge input-group-flush">
                            
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            <input id="" type="search" name="search" class="form-control"
                                placeholder="বিষয় সার্চ করুন" value="{{ isset($search_param) ? $search_param : '' }}" required>
                            <button type="submit" class="btn btn-primary">{{\App\CPU\translate('search')}}</button>
                        </div>
                    </form>
                    <!-- End Search -->
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <!-- Content  -->
            <section class="col-lg-12">
                <!-- Products grid-->
                <div class="row mx-n2">
                    @foreach($categories as $category)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-2 pb-4 text-center">
                            <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}" class="">
                                <div class="brand_div d-flex align-items-center justify-content-center"
                                 style="height: 120px; background-image: url({{ asset("public/assets/front-end/img/category_back.jpg") }}); background-color: #cccccc; background-repeat: no-repeat; background-size: 100%;">
                                    {{-- @if ($category->image && file_exists(public_path('/public/images/category/' . $category->image)))
                                        <img src="{{asset("public/images/category/" . $category->image)}}" alt="{{$category->name}}" onerror="this.src='{{asset('public/assets/front-end/img/category_demo.jpg')}}'" alt="{{$category->name_bangla}}">
                                    @else
                                        <img src="{{asset('public/assets/front-end/img/category_demo.jpg')}}" alt="{{$category->name_bangla}}">
                                    @endif --}}
                                    <b>{{ $category->name_bangla }}</b>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <hr class="my-3">
                <div class="row mx-n2">
                    <div class="col-md-12">
                        <center>
                            {!! $categories->links() !!}
                        </center>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('public/assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.js"></script>
@endpush
