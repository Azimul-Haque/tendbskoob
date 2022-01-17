@extends('layouts.front-end.app')

@php
    $titleforthispage = strtoupper($data['data_from']).' products';

    if($data['data_from'] == 'author' || $data['data_from'] == 'publisher' || $data['data_from'] == 'category'){
        $titleforthispage = $datasource['name'] . ' Books - ' . $datasource['name_bangla'] . ' এর বই | Booksbd.net';
    } else {
        $titleforthispage = strtoupper($data['data_from']) .' products';
    }
@endphp

@section('title', $titleforthispage)

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="og:title" content="Products of {{$web_config['name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="twitter:title" content="Products of {{$web_config['name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <style>
        .headerTitle {
            font-size: 26px;
            font-weight: bolder;
            margin-top: 3rem;
        }

        .for-count-value {
            position: absolute;

        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0.6875 rem;;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;

            color: black;
            font-size: .75rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.25rem;
        }

        .for-count-value {
            position: absolute;

        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0.6875 rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            line-height: 1.25rem;
        }

        .for-brand-hover:hover {
            color: {{$web_config['primary_color']}};
        }

        .for-hover-lable:hover {
            color: {{$web_config['primary_color']}}       !important;
        }

        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}      !important;
        }

        .page-item.active > .page-link {
            box-shadow: 0 0 black !important;
        }

        .for-shoting {
            font-weight: 600;
            font-size: 18px;
            padding- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 9px;
            color: #030303;
        }

        .sidepanel {
            width: 0;
            position: fixed;
            z-index: 6;
            height: 500px;
            top: 0;
        {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;
            background-color: #ffffff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 40px;
        }

        .sidepanel a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidepanel a:hover {
            color: #f1f1f1;
        }

        .sidepanel .closebtn {
            position: absolute;
            top: 0;
        {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 25 px;
            font-size: 36px;
        }

        .openbtn {
            font-size: 18px;
            cursor: pointer;
            background-color: transparent !important;
            color: #373f50;
            width: 40%;
            border: none;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .for-display {
            display: block !important;
        }

        @media (max-width: 360px) {
            .openbtn {
                width: 59%;
            }

            .for-shoting-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0% !important;
            }

            .for-mobile {

                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

        }

        @media (max-width: 500px) {
            .for-mobile {

                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 27%;
            }

            .openbtn:hover {
                background-color: #fff;
            }

            .for-display {
                display: flex !important;
            }

            .for-tab-display {
                display: none !important;
            }

            .openbtn-tab {
                margin-top: 0 !important;
            }

        }

        @media screen and (min-width: 500px) {
            .openbtn {
                display: none !important;
            }


        }

        @media screen and (min-width: 800px) {


            .for-tab-display {
                display: none !important;
            }

        }

        @media (max-width: 768px) {
            .headerTitle {
                font-size: 23px;

            }

            .openbtn-tab {
                margin-top: 3rem;
                display: inline-block !important;
            }

            .for-tab-display {
                display: inline;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a class="openbtn-tab mt-5" onclick="openNav()">
                    <div style="font-size: 20px; font-weight: 600; " class="for-tab-display mt-5">
                        <i class="fa fa-filter"></i>
                        {{\App\CPU\translate('filter')}}
                    </div>
                </a>
            </div>
            <div class="col-md-9"> </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4 mt-4 rtl"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <!-- Sidebar-->
            {{-- normal sidebar --}}
            <aside
                class="col-lg-3 hidden-xs col-md-3 col-sm-4 SearchParameters {{Session::get('direction') === "rtl" ? 'pl-0' : 'pr-0'}}"
                id="SearchParameters">
                <!--Price Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: -10px;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}"
                                type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle">{{\App\CPU\translate('Dashboard')}}Close sidebar</span><span
                                class="d-inline-block align-middle {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="widget cz-filter mb-4 pb-4 mt-2">
                            <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('filter')}}</h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <div
                                class="form-inline flex-nowrap {{Session::get('direction') === "rtl" ? 'ml-sm-4' : 'mr-sm-4'}} pb-3 for-mobile"
                                style="width: 100%">
                                <label class="opacity-75 text-nowrap for-shoting" for="sorting"
                                       style="width: 100%; padding-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0">
                                    <select style="background: whitesmoke; appearance: auto;width: 100%"
                                            class="form-control custom-select" id="searchByFilterValue">
                                        <option selected disabled>{{\App\CPU\translate('Choose')}}</option>
                                        <option
                                            value="{{route('products',['id'=> $data['id'],'data_from'=>'best-selling','page'=>1])}}">{{\App\CPU\translate('best_selling_product')}}</option>
                                        <option
                                            value="{{route('products',['id'=> $data['id'],'data_from'=>'top-rated','page'=>1])}}">{{\App\CPU\translate('top_rated')}}</option>
                                        <option
                                            value="{{route('products',['id'=> $data['id'],'data_from'=>'most-favorite','page'=>1])}}">{{\App\CPU\translate('most_favorite')}}</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Price Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: -10px;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}"
                                type="button" data-dismiss="sidebar" aria-label="Close">
                            <span
                                class="d-inline-block font-size-xs font-weight-normal align-middle">{{\App\CPU\translate('Dashboard')}}{{\App\CPU\translate('Close sidebar')}}</span>
                            <span
                                class="d-inline-block align-middle {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="cz-sidebar-body pb-0" style="padding-top: 12px;">
                        <!-- Filter by price-->
                        <div class="widget cz-filter mb-4 pb-4 mt-2">
                            <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Price')}}</h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <div class="input-group-overlay input-group-sm mb-1">
                                <input style="background: aliceblue;"
                                       class="cz-filter-search form-control form-control-sm appended-form-control"
                                       type="number" value="0" min="0" max="1000000" id="min_price">
                                <div class="input-group-append-overlay">
                                    <span style="color: #3498db;" class="input-group-text">
                                        {{\App\CPU\currency_symbol()}}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p style="text-align: center;margin-bottom: 1px;">{{\App\CPU\translate('to')}}</p>
                            </div>
                            <div class="input-group-overlay input-group-sm mb-2">
                                <input style="background: aliceblue;" value="100" min="100" max="1000000"
                                       class="cz-filter-search form-control form-control-sm appended-form-control"
                                       type="number" id="max_price">
                                <div class="input-group-append-overlay">
                                    <span style="color: #3498db;" class="input-group-text">
                                        {{\App\CPU\currency_symbol()}}
                                    </span>
                                </div>
                            </div>

                            <div class="input-group-overlay input-group-sm mb-2">
                                <button class="btn btn-primary btn-block"
                                        onclick="searchByPrice()">
                                    <span>{{\App\CPU\translate('search')}}</span>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Brand Sidebar-->
                {{-- <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: 11px;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}"
                                type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle">{{\App\CPU\translate('Dashboard')}}{{\App\CPU\translate('Close sidebar')}}</span><span
                                class="d-inline-block align-middle {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body">
                        <!-- Filter by Brand-->
                        <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                            <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('brands')}}</h3>
                            <div class="divider-role"
                                 style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                            <div class="input-group-overlay input-group-sm mb-2">
                                <input style="background: aliceblue" placeholder="Search brand"
                                       class="cz-filter-search form-control form-control-sm appended-form-control"
                                       type="text" id="search-brand">
                                <div class="input-group-append-overlay">
                                    <span style="color: #3498db;"
                                          class="input-group-text">
                                        <i class="czi-search"></i>
                                    </span>
                                </div>
                            </div>
                            <ul id="lista1" class="widget-list cz-filter-list list-unstyled pt-1"
                                style="max-height: 12rem;"
                                data-simplebar data-simplebar-auto-hide="false">
                                @foreach(\App\CPU\BrandManager::get_brands() as $brand)
                                    <div class="brand mt-4 for-brand-hover {{Session::get('direction') === "rtl" ? 'mr-2' : ''}}" id="brand">
                                        <li style="cursor: pointer;padding: 2px" class="flex-between"
                                            onclick="location.href='{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}'">
                                            <div>
                                                {{ $brand['name'] }}
                                            </div>
                                            @if($brand['brand_products_count'] > 0 )
                                                <div>
                                                    <span class="count-value">
                                                    {{ $brand['brand_products_count'] }}
                                                    </span>
                                                </div>
                                            @endif
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </div> --}}
                
                @if ($data['data_from'] != 'author')
                    <!-- Author Sidebar-->
                    <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: 11px;">
                        <div class="cz-sidebar-header box-shadow-sm">
                            <button class="close {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}"
                                    type="button" data-dismiss="sidebar" aria-label="Close"><span
                                    class="d-inline-block font-size-xs font-weight-normal align-middle">{{\App\CPU\translate('Dashboard')}}{{\App\CPU\translate('Close sidebar')}}</span><span
                                    class="d-inline-block align-middle {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="cz-sidebar-body">
                            <!-- Filter by Author-->
                            <div class="widget cz-filter mb-4 pb-6 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Authors')}}</h3>
                                <div class="divider-role"
                                    style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue" placeholder="Search Author"
                                        class="cz-filter-search form-control form-control-sm appended-form-control"
                                        type="text" id="search-author">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                            class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="authorlist" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="height: 300px;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach($authors as $author)
                                        <div class="brand mt-1 for-brand-hover {{Session::get('direction') === "rtl" ? 'mr-2' : ''}}" id="author">
                                            <li style="cursor: pointer;padding: 2px" class="flex-between"
                                                onclick="location.href='{{route('products',['id'=> $author['id'],'data_from'=>'author','page'=>1, 'author_name'=>$author['slug']])}}'">
                                                <div>
                                                    {{ $author['name_bangla'] }}
                                                </div>
                                                @if($author->products->count() > 0 )
                                                    <div>
                                                        <span class="count-value">
                                                        {{ $author->products->count() }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                @if ($data['data_from'] != 'publisher')
                    <!-- Publisher Sidebar-->
                    <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: 11px;">
                        <div class="cz-sidebar-header box-shadow-sm">
                            <button class="close {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}"
                                    type="button" data-dismiss="sidebar" aria-label="Close"><span
                                    class="d-inline-block font-size-xs font-weight-normal align-middle">{{\App\CPU\translate('Dashboard')}}{{\App\CPU\translate('Close sidebar')}}</span><span
                                    class="d-inline-block align-middle {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="cz-sidebar-body">
                            <!-- Filter by Publisher-->
                            <div class="widget cz-filter mb-4 pb-6 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Publications')}}</h3>
                                <div class="divider-role"
                                    style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue" placeholder="Search Publication"
                                        class="cz-filter-search form-control form-control-sm appended-form-control"
                                        type="text" id="search-publisher">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                            class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="publisherlist" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="height: 300px;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach($publishers as $publisher)
                                        <div class="brand mt-1 for-brand-hover {{Session::get('direction') === "rtl" ? 'mr-2' : ''}}" id="publisher">
                                            <li style="cursor: pointer;padding: 2px" class="flex-between"
                                                onclick="location.href='{{route('products',['id'=> $publisher['id'],'data_from'=>'publisher','page'=>1, 'publisher_name'=>$publisher['slug']])}}'">
                                                <div>
                                                    {{ $publisher['name_bangla'] }}
                                                </div>
                                                @if($publisher->products->count() > 0 )
                                                    <div>
                                                        <span class="count-value">
                                                        {{ $publisher->products->count() }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($data['data_from'] != 'category')
                    <!-- Category Sidebar-->
                    <div class="cz-sidebar rounded-lg box-shadow-lg" id="shop-sidebar" style="margin-bottom: 11px;">
                        <div class="cz-sidebar-header box-shadow-sm">
                            <button class="close {{Session::get('direction') === "rtl" ? 'mr-auto' : 'ml-auto'}}"
                                    type="button" data-dismiss="sidebar" aria-label="Close"><span
                                    class="d-inline-block font-size-xs font-weight-normal align-middle">{{\App\CPU\translate('Dashboard')}}{{\App\CPU\translate('Close sidebar')}}</span><span
                                    class="d-inline-block align-middle {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        
                        <div class="cz-sidebar-body">
                            <!-- Filter by Category-->
                            <div class="widget cz-filter mb-4 pb-6 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Categories')}}</h3>
                                <div class="divider-role"
                                    style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue" placeholder="Search Category"
                                        class="cz-filter-search form-control form-control-sm appended-form-control"
                                        type="text" id="search-category">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                            class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="categorylist" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="height: 300px;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach($categories as $category)
                                        <div class="brand mt-1 for-brand-hover {{Session::get('direction') === "rtl" ? 'mr-2' : ''}}" id="publisher">
                                            <li style="cursor: pointer;padding: 2px" class="flex-between"
                                                onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'">
                                                <div>
                                                    {{ $category['name_bangla'] }}
                                                </div>
                                                @if($category->products->count() > 0 )
                                                    <div>
                                                        <span class="count-value">
                                                        {{ $category->products->count() }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </aside>

            {{-- responsive sidebar --}}
            <div id="mySidepanel" class="sidepanel">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <aside class="" style="padding-right: 5%;padding-left: 5%;">
                    <div class="" id="shop-sidebar" style="margin-bottom: -10px;">
                        <div class=" box-shadow-sm">
                            
                        </div>
                        <div class="" style="padding-top: 12px;">
                            <!-- Filter -->
                            <div class="widget cz-filter">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('filter')}}</h3>
                                <div class="" style="width: 100%">
                                    <label class="opacity-75 text-nowrap for-shoting" for="sorting"
                                           style="width: 100%; padding-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 0">
                                        <select style="background: whitesmoke; appearance: auto;width: 100%"
                                                class="form-control custom-select" id="searchByFilterValue">
                                            <option selected disabled>{{\App\CPU\translate('Choose')}}</option>
                                            <option
                                                value="{{route('products',['id'=> $data['id'],'data_from'=>'best-selling','page'=>1])}}">{{\App\CPU\translate('best_selling_product')}}</option>
                                            <option
                                                value="{{route('products',['id'=> $data['id'],'data_from'=>'top-rated','page'=>1])}}">{{\App\CPU\translate('top_rated')}}</option>
                                            <option
                                                value="{{route('products',['id'=> $data['id'],'data_from'=>'most-favorite','page'=>1])}}">{{\App\CPU\translate('most_favorite')}}</option>
                                        </select>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Price Sidebar-->
                    <div class="" id="shop-sidebar" style="margin-bottom: -10px;">
                        <div class=" box-shadow-sm">

                        </div>
                        <div class="" style="padding-top: 12px;">
                            <!-- Filter by price-->
                            <div class="widget cz-filter mb-4 pb-4 mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Price')}}</h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-1">
                                    <input style="background: aliceblue;"
                                           class="cz-filter-search form-control form-control-sm appended-form-control"
                                           type="number" value="0" min="0" max="1000000" id="min_price">
                                    <div class="input-group-append-overlay">
                                    <span style="color: #3498db;" class="input-group-text">
                                        {{\App\CPU\currency_symbol()}}
                                    </span>
                                    </div>
                                </div>
                                <div>
                                    <p style="text-align: center;margin-bottom: 1px;">{{\App\CPU\translate('to')}}</p>
                                </div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue;" value="100" min="100" max="1000000"
                                           class="cz-filter-search form-control form-control-sm appended-form-control"
                                           type="number" id="max_price">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;" class="input-group-text">
                                            {{\App\CPU\currency_symbol()}}
                                        </span>
                                    </div>
                                </div>

                                <div class="input-group-overlay input-group-sm mb-2">
                                    <button class="btn btn-primary btn-block"
                                            onclick="searchByPrice()">
                                        <span>{{\App\CPU\translate('search')}}</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Brand Sidebar-->
                    {{-- <div class="" id="shop-sidebar" style="margin-bottom: 11px;">

                        <div class="">
                            <!-- Filter by Brand-->
                            <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('brands')}}</h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue"
                                           class="cz-filter-search form-control form-control-sm appended-form-control"
                                           type="text" id="search-brand-m">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                              class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="lista1" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="max-height: 12rem;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach(\App\CPU\BrandManager::get_brands() as $brand)
                                        <div class="brand mt-4 for-brand-hover" id="brand">
                                            <li style="cursor: pointer;padding: 2px"
                                                onclick="location.href='{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}'">
                                                {{ $brand['name'] }}
                                                @if($brand['brand_products_count'] > 0 )

                                                    <span class="for-count-value"
                                                          style="float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}}">{{ $brand['brand_products_count'] }}</span>

                                                @endif
                                            </li>

                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div> --}}

                    @if ($data['data_from'] != 'author')
                    <!-- Author Sidebar-->
                    <div class="" id="shop-sidebar" style="margin-bottom: 11px;">
                        <div class="">
                            <!-- Filter by Brand-->
                            <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Authors')}}</h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue"
                                           class="cz-filter-search form-control form-control-sm appended-form-control" placeholder="Search Author"
                                           type="text" id="search-author-m">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                              class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="mauthorlist" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="height: 250px;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach($authors as $author)
                                        <div class="brand mt-1 for-brand-hover" id="author">
                                            <li style="cursor: pointer;padding: 2px"
                                                onclick="location.href='{{route('products',['id'=> $author['id'],'data_from'=>'author','page'=>1, 'author_name'=>$author['slug']])}}'">
                                                {{ $author['name_bangla'] }}
                                                @if($author->products->count() > 0 )
                                                    <span class="for-count-value"
                                                          style="float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}}">{{ $author->products->count() }}</span>

                                                @endif
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($data['data_from'] != 'publisher')
                    <!-- Publisher Sidebar-->
                    <div class="" id="shop-sidebar" style="margin-bottom: 11px;">
                        <div class="">
                            <!-- Filter by Brand-->
                            <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Publications')}}</h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue"
                                           class="cz-filter-search form-control form-control-sm appended-form-control" placeholder="Search Publisher"
                                           type="text" id="search-publisher-m">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                              class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="mpublisherlist" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="height: 250px;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach($publishers as $publisher)
                                        <div class="brand mt-1 for-brand-hover" id="publisher">
                                            <li style="cursor: pointer;padding: 2px"
                                                onclick="location.href='{{route('products',['id'=> $publisher['id'],'data_from'=>'publisher','page'=>1, 'publisher_name'=>$publisher['slug']])}}'">
                                                {{ $publisher['name_bangla'] }}
                                                @if($publisher->products->count() > 0 )
                                                    <span class="for-count-value"
                                                          style="float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}}">{{ $publisher->products->count() }}</span>

                                                @endif
                                            </li>

                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($data['data_from'] != 'category')
                    <!-- Category Sidebar-->
                    <div class="" id="shop-sidebar" style="margin-bottom: 11px;">
                        <div class="">
                            <!-- Filter by Brand-->
                            <div class="widget cz-filter mb-4 pb-4 border-bottom mt-2">
                                <h3 class="widget-title" style="font-weight: 700;">{{\App\CPU\translate('Categories')}}</h3>
                                <div class="divider-role"
                                     style="border: 1px solid whitesmoke; margin-bottom: 14px;  margin-top: -6px;"></div>
                                <div class="input-group-overlay input-group-sm mb-2">
                                    <input style="background: aliceblue"
                                           class="cz-filter-search form-control form-control-sm appended-form-control" placeholder="Search Category"
                                           type="text" id="search-category-m">
                                    <div class="input-group-append-overlay">
                                        <span style="color: #3498db;"
                                              class="input-group-text">
                                            <i class="czi-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul id="mcategorylist" class="widget-list cz-filter-list list-unstyled pt-1"
                                    style="height: 250px;"
                                    data-simplebar data-simplebar-auto-hide="false">
                                    @foreach($categories as $category)
                                        <div class="brand mt-1 for-brand-hover" id="category">
                                            <li style="cursor: pointer;padding: 2px"
                                                onclick="location.href='{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}'">
                                                {{ $category['name_bangla'] }}
                                                @if($category->products->count() > 0 )
                                                    <span class="for-count-value"
                                                          style="float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}}">{{ $category->products->count() }}</span>

                                                @endif
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </aside>
            </div>

            <!-- Content  -->
            <section class="col-lg-9">
                @if ($data['data_from'] == 'author')
                    <div class="row">
                        <div class="col-md-3">
                            <center>
                                <img class="img-fluid rounded-circle" style="padding:10px;"
                                    onerror="this.src='{{asset('public/assets/front-end/img/user_demo.jpg')}}'"
                                    src="{{ asset('public/images/author/' . $datasource['image']) }}">
                            </center>
                        </div>
                        <div class="col-md-9 card" style="padding:10px;">
                            <h4>
                                {{ $datasource['name_bangla'] }}
                            </h4>
                            <p id="datasourcedetail">
                                {{ \Illuminate\Support\Str::limit($datasource['description'], 300) }}<br/>
                                @if (strlen($datasource['description']) > 300)
                                    <span style="cursor: pointer" onclick='datasourcedetail()'><big>Read More</big></span>
                                @endif
                            </p>
                            <p style="display: none;" id="datasourcedetail2">{{ $datasource['description'] }}</p>
                        </div>
                    </div>
                @elseif($data['data_from'] == 'publisher')
                    <div class="row">
                        <div class="col-md-3">
                            <center>
                                <img class="img-fluid rounded-circle" style="padding:10px;"
                                    onerror="this.src='{{asset('public/assets/front-end/img/user_demo.jpg')}}'"
                                    src="{{ asset('public/images/publisher/' . $datasource['image']) }}">
                            </center>
                        </div>
                        <div class="col-md-9 card" style="padding:10px;">
                            <h4>
                                {{ $datasource['name_bangla'] }}
                            </h4>
                            <p id="datasourcedetail">
                                {{ \Illuminate\Support\Str::limit($datasource['description'], 300) }}<br/>
                                @if (strlen($datasource['description']) > 300)
                                    <span style="cursor: pointer" onclick='datasourcedetail()'><big>Read More</big></span>
                                @endif
                            </p>
                            <p style="display: none;" id="datasourcedetail2">{{ $datasource['description'] }}</p>
                        </div>
                    </div>
                @endif
                <div class="row mt-2">
                    <div class="col-md-6">
                        {{-- if need data from also --}}
                        {{-- <h1 class="h3 text-dark mb-0 headerTitle text-uppercase">{{\App\CPU\translate('product_by')}} {{$data['data_from']}} ({{ isset($brand_name) ? $brand_name : $data_from}})</h1> --}}
                        <h1 class="h3 text-dark mb-3">
                            @if($data['data_from'] == 'author')
                                <b>{{ isset($data_from_name) ? $data_from_name : ''}}</b> এর বই সমূহ
                                <label>( {{$products->total()}} {{\App\CPU\translate('items found')}} )</label>
                            @elseif($data['data_from'] == 'publisher')
                                <b>{{ isset($data_from_name) ? $data_from_name : ''}}</b> এর বই সমূহ
                                <label>( {{$products->total()}} {{\App\CPU\translate('items found')}} )</label>
                            @elseif($data['data_from'] == 'category')
                                <b>{{ isset($data_from_name) ? $data_from_name : ''}}</b>
                                <label>( {{$products->total()}} {{\App\CPU\translate('items found')}} )</label>
                            @else
                                {{ strtoupper($data['data_from']) }} {{\App\CPU\translate('products')}}
                                <label>( {{$products->total()}} {{\App\CPU\translate('items found')}} )</label>
                            @endif
                                    
                            {{-- {{$data['data_from']}} {{\App\CPU\translate('products')}}  --}}
                        </h1>
                    </div>
                    <div class="col-md-6 for-display mx-0">
                        <button class="openbtn text-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}" onclick="openNav()">
                            <div style="margin-bottom: -30%;">
                                <i class="fa fa-filter"></i>
                                {{\App\CPU\translate('filter')}}
                            </div>
                        </button>
        
                        <div class="d-flex flex-wrap float-right for-shoting-mobile">
                            <form id="search-form" action="{{ route('products') }}" method="GET">
                                <input hidden name="data_from" value="{{$data['data_from']}}">
                                <div class="form-inline flex-nowrap pb-3 for-mobile">
                                    <label
                                        class="opacity-75 text-nowrap {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}} for-shoting"
                                        for="sorting">
                                        <span
                                            class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">{{\App\CPU\translate('sort_by')}}</span></label>
                                    <select style="background: white; appearance: auto;"
                                            class="form-control custom-select" onchange="filter(this.value)">
                                        <option value="latest">{{\App\CPU\translate('Latest')}}</option>
                                        <option
                                            value="low-high">{{\App\CPU\translate('low_high')}} {{\App\CPU\translate('Price')}} </option>
                                        <option
                                            value="high-low">{{\App\CPU\translate('hight_low')}} {{\App\CPU\translate('Price')}}</option>
                                        <option
                                            value="a-z">{{\App\CPU\translate('a_z')}} {{\App\CPU\translate('Order')}}</option>
                                        <option
                                            value="z-a">{{\App\CPU\translate('z_a')}} {{\App\CPU\translate('Order')}}</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if (count($products) > 0)
                    <div class="row" id="ajax-products">
                        @include('web-views.products._ajax-products',['products'=>$products])
                    </div>
                @else
                    <div class="text-center pt-5">
                        <h2>{{\App\CPU\translate('No Product Found')}}</h2>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "80%";
            document.getElementById("mySidepanel").style.height = "100%";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
            document.getElementById("mySidepanel").style.height = "0";
        }

        function filter(value) {
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    min_price: '{{$data['min_price']}}',
                    max_price: '{{$data['max_price']}}',
                    sort_by: value
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function searchByPrice() {
            let min = $('#min_price').val();
            let max = $('#max_price').val();
            $.get({
                url: '{{url('/')}}/products',
                data: {
                    id: '{{$data['id']}}',
                    name: '{{$data['name']}}',
                    data_from: '{{$data['data_from']}}',
                    sort_by: '{{$data['sort_by']}}',
                    min_price: min,
                    max_price: max,
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (response) {
                    $('#ajax-products').html(response.view);
                    $('#paginator-ajax').html(response.paginator);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        $('#searchByFilterValue, #searchByFilterValue-m').change(function () {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

        $("#search-brand").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#lista1 div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        
        $("#search-author").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#authorlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-author-m").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#mauthorlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

        $("#search-publisher").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#publisherlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-publisher-m").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#mpublisherlist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

        $("#search-category").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#categorylist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });
        $("#search-category-m").on("keyup", function () {
            var value = this.value.toLowerCase().trim();
            $("#mcategorylist div>li").show().filter(function () {
                return $(this).text().toLowerCase().trim().indexOf(value) == -1;
            }).hide();
        });

        function datasourcedetail(text) {
            $('#datasourcedetail').hide();
            $('#datasourcedetail2').css('display', 'block'); 
        }
    </script>
@endpush
