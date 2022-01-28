@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('All Authors Page'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Author of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Author of {{$web_config['name']->value}}"/>
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
                <span style="margin-right: 15px;">{{\App\CPU\translate('Author')}}</span> 
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
                                placeholder="লেখক সার্চ করুন" value="{{ isset($search_param) ? $search_param : '' }}" required>
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
                    @foreach($authors as $author)
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6 px-2 pb-4 text-center">
                            <a href="{{route('products',['id'=> $author['id'],'data_from'=>'author','page'=>1, 'author_name'=>$author['slug']])}}" class="">
                                <div class="brand_div d-flex align-items-center justify-content-center"
                                 style="height: 200px">
                                    @if ($author->image && file_exists(public_path('/images/author/' . $author->image)))
                                        <img src="{{asset("public/images/author/" . $author->image)}}" alt="{{$author->name}}" onerror="this.src='{{asset('public/assets/front-end/img/user_demo.jpg')}}'" alt="{{$author->name_bangla}}" onmousedown='return false;' onselectstart='return false;'>
                                    @else
                                        <img src="{{asset('public/assets/front-end/img/user_demo.jpg')}}" alt="{{$author->name_bangla}}" onmousedown='return false;' onselectstart='return false;'>
                                    @endif
                                </div>
                            </a>
                            <small>{{ $author->name_bangla }}</small>
                        </div>
                    @endforeach
                </div>

                <hr class="my-3">
                <div class="row mx-n2">
                    <div class="col-md-12">
                        <center>
                            {!! $authors->links() !!}
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
