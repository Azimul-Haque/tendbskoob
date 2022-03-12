@extends('layouts.front-end.app')

@php
    if($product->writers->count() > 0){
        $bn_book_writer_for_title = $product->writers[0]->name_bangla;
        $en_book_writer_for_title = $product->writers[0]->name;
    } elseif($product->translators->count() > 0) {
        $bn_book_writer_for_title = $product->translators[0]->name_bangla;
        $en_book_writer_for_title = $product->translators[0]->name;
    } elseif($product->editors->count() > 0) {
        $bn_book_writer_for_title = $product->editors[0]->name_bangla;
        $en_book_writer_for_title = $product->editors[0]->name;
    } else {
        $bn_book_writer_for_title = '';
        $en_book_writer_for_title = '';
    }
@endphp

@section('title',$product['name_bangla'] . ':' . $bn_book_writer_for_title . ' - ' . $product['name'] . ':' . $en_book_writer_for_title . ' | Booksbd.net')

@push('css_or_js')
    <meta name="description" content="{{ $product['meta_description'] }}">
    <meta name="keywords" content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @if($product->added_by=='seller')
        <meta name="author" content="{{ $product->seller->shop?$product->seller->shop->name:$product->seller->f_name}}">
    @elseif($product->added_by=='admin')
        <meta name="author" content="{{$web_config['name']->value}}">
    @endif
    <!-- Viewport-->

    @if($product['meta_image']!=null)
        <meta property="og:image" content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/meta")}}/{{$product->meta_image}}"/>
    @else
        <meta property="og:image" content="{{asset("storage/app/public/product/thumbnail")}}/{{$product->thumbnail}}"/>
        <meta property="twitter:card"
              content="{{asset("storage/app/public/product/thumbnail/")}}/{{$product->thumbnail}}"/>
    @endif

    @if($product['meta_title']!=null)
        <meta property="og:title" content="{{ $product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net' }}"/>
        <meta property="twitter:title" content="{{ $product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net' }}"/>
    @else
        <meta property="og:title" content="{{ $product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net' }}"/>
        <meta property="twitter:title" content="{{ $product['name_bangla'] . ' - ' . $bn_book_writer_for_title . ' | Booksbd.net' }}"/>
    @endif
    <meta property="og:url" content="{{route('product',[$product->slug])}}">

    @if($product['meta_description']!=null)
        <meta property="twitter:description" content="{{ 'লেখকঃ ' . $bn_book_writer_for_title }},  মূল্যঃ ৳ {{ $product->unit_price }}, লিংকঃ {{ route('product',[$product->slug]) }}, booksbd.net থেকে বইটি সংগ্রহ করুন booksbd.net থেকে">
        <meta property="og:description" content="{{ 'লেখকঃ ' . $bn_book_writer_for_title }},  মূল্যঃ ৳ {{ $product->unit_price }}, লিংকঃ {{ route('product',[$product->slug]) }}, booksbd.net থেকে বইটি সংগ্রহ করুন booksbd.net থেকে">
    @else
        <meta property="og:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
        <meta property="twitter:description"
              content="@foreach(explode(' ',$product['name']) as $keyword) {{$keyword.' , '}} @endforeach">
    @endif
    <meta property="twitter:url" content="{{ route('product',[$product->slug]) }}">

    <link rel="stylesheet" href="{{asset('public/assets/front-end/css/product-details.css')}}"/>
    {{-- <style>
        .msg-option {
            display: none;
        }

        .chatInputBox {
            width: 100%;
        }

        .go-to-chatbox {
            width: 100%;
            text-align: center;
            padding: 5px 0px;
            display: none;
        }

        .feature_header {
            display: flex;
            justify-content: center;
        }

        .btn-number:hover {
            color: {{$web_config['secondary_color']}};

        }

        .for-total-price {
            margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -30%;
        }

        .feature_header span {
            padding- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 15px;
            font-weight: 700;
            font-size: 25px;
            background-color: #ffffff;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .feature_header span {
                margin-bottom: -40px;
            }

            .for-total-price {
                padding- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 30%;
            }

            .product-quantity {
                padding- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

            .for-margin-bnt-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 7px;
            }

            .font-for-tab {
                font-size: 11px !important;
            }

            .pro {
                font-size: 13px;
            }
        }

        @media (max-width: 375px) {
            .for-margin-bnt-mobile {
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 3px;
            }

            .for-discount {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 10% !important;
            }

            .for-dicount-div {
                margin-top: -5%;
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7%;
            }

            .product-quantity {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 4%;
            }

        }

        @media (max-width: 500px) {
            .for-dicount-div {
                margin-top: -4%;
                margin- {{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -5%;
            }

            .for-total-price {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: -20%;
            }

            .view-btn-div {

                margin-top: -9%;
                float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}};
            }

            .for-discount {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }

            .viw-btn-a {
                font-size: 10px;
                font-weight: 600;
            }

            .feature_header span {
                margin-bottom: -7px;
            }

            .for-mobile-capacity {
                margin- {{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7%;
            }
        }
    </style>
    <style>
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 5px;
        }

        thead {
            background: {{$web_config['primary_color']}}                         !important;
            color: white;
        }
    </style> --}}
@endpush

@section('content')
    <?php
    $overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews);
    $rating = \App\CPU\ProductManager::get_rating($product->reviews);
    ?>
    <!-- Page Content-->
    <div class="container mt-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <!-- General info tab-->
        <div class="row" style="direction: ltr; border: 1px solid #e2f0ff; border-radius: 0px; background: white; box-shadow: 1px 1px 6px #00000014;">
            <!-- Product gallery-->
            <div class="col-lg-3 col-md-3" style="padding: 16px;">
                <div class="d-flex align-items-center">
                    <div style="border: 1px solid lightgrey; padding: 20px;">
                        <img class="img-responsive" style="max-height: 320px; width: auto;"
                        onerror="this.src='{{asset('public/assets/front-end/img/book_demo.jpg')}}'"
                        src="{{ \App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail'] }}"
                        data-zoom="{{ \App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail'] }}"
                        alt="Product image" width="" onmousedown='return false;' onselectstart='return false;'>
                    </div>
                    {{-- <div class="cz-image-zoom-pane"></div> --}}
                </div>
            </div>
            <!-- Product details-->
            <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-3" style="direction: {{ Session::get('direction') }}; padding: 16px;">
                <div class="">
                    <h1 class="h3 mb-2" style="font-size: 22px;">{{$product->name_bangla}}</h1>
                    @php
                        $autor_html = '';
                        if($product->writers->count() > 0) {
                            for($i = 0; $i < count($product->writers); $i++){
                                $route = route('products',['id'=> $product->writers[$i]->id,'data_from'=>'author','page'=>1, 'author_name'=>$product->writers[$i]['slug']]);
                                $autor_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->writers[$i]->name_bangla . '</a>';
                                if($i < (count($product->writers) -1)){
                                    $autor_html .= ", ";
                                }
                            }
                        }    

                        if($product->translators->count() > 0) {
                            if($product->writers->count() > 0) {
                                $autor_html .= ", ";
                            }
                            for($i = 0; $i < count($product->translators); $i++){
                                $route = route('products',['id'=> $product->translators[$i]->id,'data_from'=>'author','page'=>1, 'author_name'=>$product->translators[$i]['slug']]);
                                $autor_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->translators[$i]->name_bangla . ' (অনুবাদক)</a>';
                                if($i < (count($product->translators) -1)){
                                    $autor_html .= ", ";
                                }
                            }
                        }

                        if($product->editors->count() > 0) {
                            if($product->writers->count() > 0 || $product->translators->count() > 0) {
                                $autor_html .= ", ";
                            }
                            for($i = 0; $i < count($product->editors); $i++){
                                $route = route('products',['id'=> $product->editors[$i]->id,'data_from'=>'author','page'=>1, 'author_name'=>$product->editors[$i]['slug']]);
                                $autor_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->editors[$i]->name_bangla . ' (সম্পাদক)</a>';
                                if($i < (count($product->editors) -1)){
                                    $autor_html .= ", ";
                                }
                            }
                        }
                    @endphp
                    {!! $autor_html !!}<br/>

                    <div class="mb-2 mt-2">
                        Category:
                        @php
                            $category_html = '';
                            if($product->categories->count() > 0) {
                                for($i = 0; $i < count($product->categories); $i++){
                                    $route = route('products',['id'=> $product->categories[$i]->id,'data_from'=>'category','page'=>1]);
                                    $category_html .= '<a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="' . $route . '">' . $product->categories[$i]->name_bangla . '</a>';
                                    if($i < (count($product->categories) -1)){
                                        $category_html .= ", ";
                                    }
                                }
                            }
                        @endphp
                        {!! $category_html !!}
                    </div>
                    <div class="d-flex align-items-center mb-2 pro">
                        {{-- <span
                            class="d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-md-2 ml-sm-0 pl-2' : 'mr-md-2 mr-sm-0 pr-2'}}">{{$overallRating[0]}}</span> --}}
                        <div class="star-rating">
                            @for($inc=0;$inc<5;$inc++)
                                @if($inc<$overallRating[0])
                                    <i class="sr-star czi-star-filled active"></i>
                                @else
                                    <i class="sr-star czi-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span
                            class="font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">{{$overallRating[1]}} {{\App\CPU\translate('Reviews')}}</span>
                        {{-- <span style="width: 0px;height: 10px;border: 0.5px solid #707070; margin-top: 6px"></span>
                        <span
                            class="font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-1 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-1 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">{{$countOrder}} {{\App\CPU\translate('orders')}}   </span>
                        <span style="width: 0px;height: 10px;border: 0.5px solid #707070; margin-top: 6px">    </span>
                        <span
                            class=" font-for-tab d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-1 ml-md-2 ml-0 pr-md-2 pr-sm-1 pl-md-2 pl-sm-1' : 'ml-1 mr-md-2 mr-0 pl-md-2 pl-sm-1 pr-md-2 pr-sm-1'}}">  {{$countWishlist}} {{\App\CPU\translate('wish')}} </span> --}}

                    </div>
                    <div class="mb-4 mt-4">
                        @if($product->published_price > $product->unit_price)
                            <strike style="color: {{$web_config['secondary_color']}};">
                                ৳ {{ number_format($product->published_price, 0) }} 
                            </strike>
                        @endif
                        <span class="h3 font-weight-normal text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}">
                            ৳ {{ number_format($product->unit_price, 0) }}
                        </span>
                        @if($product->published_price > $product->unit_price)
                            <small>You save ৳ {{ $product->published_price - $product->unit_price }} ({{ ceil(100 * (($product->published_price - $product->unit_price)/$product->published_price)) }}%)</small>
                        @endif
                    </div>

                    {{-- @if($product->discount > 0)
                        <div class="mb-3">
                            <strong>{{\App\CPU\translate('discount')}} : </strong>
                            <strong id="set-discount-amount"></strong>
                        </div>
                    @endif --}}

                    {{-- <div class="mb-3">
                        <strong>{{\App\CPU\translate('tax')}} : </strong>
                        <strong id="set-tax-amount"></strong>
                    </div> --}}
                    <form id="add-to-cart-form" class="mb-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="position-relative {{Session::get('direction') === "rtl" ? 'ml-n4' : 'mr-n4'}} mb-3">
                            @if ($product->colors && count(json_decode($product->colors)) > 0)
                                <div class="flex-start">
                                    <div class="mt-2">{{\App\CPU\translate('color')}}:
                                    </div>
                                    <div>
                                        <ul class="list-inline checkbox-color mb-1 flex-start {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"
                                            style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                            @foreach (json_decode($product->colors) as $key => $color)
                                                <div>
                                                    <li>
                                                        <input type="radio"
                                                               id="{{ $product->id }}-color-{{ $key }}"
                                                               name="color" value="{{ $color }}"
                                                               @if($key == 0) checked @endif>
                                                        <label style="background: {{ $color }};"
                                                               for="{{ $product->id }}-color-{{ $key }}"
                                                               data-toggle="tooltip"></label>
                                                    </li>
                                                </div>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @php
                                $qty = 0;
                                // if(!empty($product->variation)){
                                // foreach (json_decode($product->variation) as $key => $variation) {
                                //         $qty += $variation->qty;
                                //     }
                                // }
                            @endphp
                        </div>
                        {{-- @if ($product->choice_options)
                        @foreach (json_decode($product->choice_options) as $key => $choice)
                            <div class="row flex-start mx-0">
                                <div
                                    class="product-description-label mt-2 {{Session::get('direction') === "rtl" ? 'pl-2' : 'pr-2'}}">{{ $choice->title }}
                                    :
                                </div>
                                <div>
                                    <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2 mx-1 flex-start"
                                        style="padding-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0;">
                                        @foreach ($choice->options as $key => $option)
                                            <div>
                                                <li class="for-mobile-capacity">
                                                    <input type="radio"
                                                           id="{{ $choice->name }}-{{ $option }}"
                                                           name="{{ $choice->name }}" value="{{ $option }}"
                                                           @if($key == 0) checked @endif >
                                                    <label style="font-size: .6em"
                                                           for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                </li>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        @endif --}}

                    <!-- Quantity + Add to cart -->
                        <div class="row no-gutters">
                            <div class="col-2">
                                <div class="mt-2">{{\App\CPU\translate('Quantity')}}:</div>
                            </div>
                            <div class="col-10">
                                <div class="product-quantity d-flex align-items-center">
                                    <div
                                        class="input-group input-group--style-2 {{Session::get('direction') === "rtl" ? 'pl-3' : 'pr-3'}}"
                                        style="width: 160px;">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button"
                                                    data-type="minus" data-field="quantity"
                                                    disabled="disabled" style="padding: 10px">
                                                -
                                            </button>
                                        </span>
                                        <input type="text" name="quantity"
                                               class="form-control input-number text-center cart-qty-field"
                                               placeholder="1" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number" type="button" data-type="plus"
                                                    data-field="quantity" style="padding: 10px">
                                               +
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row flex-start no-gutters d-none mt-2" id="chosen_price_div">
                            <div class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                <div class="">{{\App\CPU\translate('Total Price')}}:</div>
                            </div>
                            <div>
                                <div class="product-price for-total-price">
                                    <strong id="chosen_price"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {{-- @if($product['current_stock']<=0)
                                    <h5 class="mt-3" style="color: red">{{\App\CPU\translate('out_of_stock')}}</h5>
                                @endif --}}
                                @if($product['current_stock'] > 0)
                                    <h5 class="mt-3" style="color: green"><img style="margin-right: 8px; width: 18px; height: auto;" src="{{asset('public/assets/front-end/img/in-stock(mini).svg')}}"> {{\App\CPU\translate('Book in Stock')}}</h5>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex
                        {{-- justify-content-between --}}
                        mt-2">
                            {{-- <button
                                class="btn btn-secondary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                onclick="buy_now()"
                                type="button"
                                style="width:37%; height: 45px">
                                <span class="string-limit">{{\App\CPU\translate('buy_now')}}</span>
                            </button> --}}
                            @if($product['stock_status'] == 3)
                                @php
                                    $book_details = 'লেখকঃ ' . $product->writers[0]->name_bangla . ', প্রকাশনীঃ ' . $product->publisher->name_bangla;
                                @endphp
                                <a href="{{ route('book-request', ['book_name' => $product->name_bangla, 'book_details' => $book_details]) }}" class="btn btn-success"><i class="fa fa-refresh"></i> বইটি অনুরোধ করুন</a>
                            @else
                                <button
                                    class="btn btn-primary element-center btn-gap-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                    onclick="addToCart()"
                                    type="button"
                                    style="width:37%; height: 45px; margin-right: 10px;">
                                    <i class="fa fa-cart-plus mr-2"></i>
                                    <span class="string-limit">{{\App\CPU\translate('add_to_cart')}}</span>
                                </button>
                                <button type="button" onclick="addWishlist('{{$product['id']}}')"
                                        class="btn btn-dark for-hover-bg"
                                        style="">
                                    <i class="fa fa-heart-o {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"
                                    aria-hidden="true"></i>
                                    <span class="countWishlist-{{$product['id']}}">{{$countWishlist}}</span>
                                </button>
                            @endif
                        </div>
                    </form>
                    <hr style="padding-bottom: 10px">
                    <div style="text-align:{{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                         class="sharethis-inline-share-buttons"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3" style="background: #F6F6F6;">

            </div>
        </div>
    </div>

    {{--seller section--}}
    @if($product->added_by=='seller')
        {{-- <div class="container mt-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <div class="row seller_details d-flex align-items-center" id="sellerOption">
                <div class="col-md-6">
                    <div class="seller_shop">
                        <div class="shop_image d-flex justify-content-center align-items-center">
                            <a href="#" class="d-flex justify-content-center">
                                <img style="height: 65px; width: 65px; border-radius: 50%"
                                     src="{{asset('storage/app/public/shop')}}/{{$product->seller->shop->image}}"
                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                     alt="">
                            </a>
                        </div>
                        <div
                            class="shop-name-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} d-flex justify-content-center align-items-center">
                            <div>
                                <a href="#" class="d-flex align-items-center">
                                    <div
                                        class="title">{{$product->seller->shop->name}}</div>
                                </a>
                                <div class="review d-flex align-items-center">
                                    <div class="">
                                        <span
                                            class="d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">{{\App\CPU\translate('Seller')}} {{\App\CPU\translate('Info')}} </span>
                                        <span
                                            class="d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 p-md-0 pt-sm-3">
                    <div class="seller_contact">
                        <div
                            class="d-flex align-items-center {{Session::get('direction') === "rtl" ? 'pl-4' : 'pr-4'}}">
                            <a href="{{ route('shopView',[$product->seller->id]) }}">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    {{\App\CPU\translate('Visit')}}
                                </button>
                            </a>
                        </div>

                        @if (auth('customer')->id() == '')
                            <div class="d-flex align-items-center">
                                <a href="{{route('customer.auth.login')}}">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        {{\App\CPU\translate('Contact')}} {{\App\CPU\translate('Seller')}}
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="d-flex align-items-center" id="contact-seller">
                                <button class="btn btn-primary">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    {{\App\CPU\translate('Contact')}} {{\App\CPU\translate('Seller')}}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row msg-option" id="msg-option">
                <form action="">
                    <input type="text" class="seller_id" hidden seller-id="{{$product->seller->id }}">
                    <textarea shop-id="{{$product->seller->shop->id}}" class="chatInputBox"
                              id="chatInputBox" rows="5"> </textarea>

                    <button class="btn btn-secondary" style="color: white;"
                            id="cancelBtn">{{\App\CPU\translate('cancel')}}
                    </button>
                    <button class="btn btn-primary" style="color: white;"
                            id="sendBtn">{{\App\CPU\translate('send')}}</button>
                </form>
            </div>
            <div class="go-to-chatbox" id="go_to_chatbox">
                <a href="{{route('chat-with-seller')}}" class="btn btn-primary" id="go_to_chatbox_btn">
                    {{\App\CPU\translate('go_to')}} {{\App\CPU\translate('chatbox')}} </a>
            </div>
        </div> --}}
    @else
        {{-- <div class="container rtl mt-3" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <div class="row seller_details d-flex align-items-center" id="sellerOption">
                <div class="col-md-6">
                    <div class="seller_shop">
                        <div class="shop_image d-flex justify-content-center align-items-center">
                            <a href="{{ route('shopView',[0]) }}" class="d-flex justify-content-center">
                                <img style="height: 65px;width: 65px; border-radius: 50%"
                                     src="{{asset("storage/app/public/company")}}/{{$web_config['fav_icon']->value}}"
                                     onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                     alt="">
                            </a>
                        </div>
                        <div
                            class="shop-name-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} d-flex justify-content-center align-items-center">
                            <div>
                                <a href="#" class="d-flex align-items-center">
                                    <div
                                        class="title">{{$web_config['name']->value}}</div>
                                </a>
                                <div class="review d-flex align-items-center">
                                    <div class="">
                                        <span
                                            class="d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">{{ \App\CPU\translate('web_admin')}}</span>
                                        <span
                                            class="d-inline-block font-size-sm text-body align-middle mt-1 {{Session::get('direction') === "rtl" ? 'mr-2' : 'ml-2'}}"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-md-0 pt-sm-3">
                    <div class="seller_contact">

                        <div
                            class="d-flex align-items-center {{Session::get('direction') === "rtl" ? 'pl-4' : 'pr-4'}}">
                            <a href="{{ route('shopView',[0]) }}">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    {{\App\CPU\translate('Visit')}}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    @endif

    {{--overview--}}
    <div class="container mt-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row" style="background: white">
            <div class="col-12">
                <div class="product_overview mt-1">
                    <!-- Tabs-->
                    <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#overview" data-toggle="tab" role="tab"
                               style="color: black !important;">
                                {{\App\CPU\translate('OVERVIEW')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reviews" data-toggle="tab" role="tab"
                               style="color: black !important;">
                                {{\App\CPU\translate('REVIEWS')}}
                            </a>
                        </li>
                    </ul>
                    <div class="px-4 pt-lg-3 pb-3 mb-3">
                        <div class="tab-content px-lg-3">
                            <!-- Tech specs tab-->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                <div class="row pt-2 specification">
                                    @if($product->video_url!=null)
                                        <div class="col-12 mb-4">
                                            <iframe width="420" height="315"
                                                    src="{{$product->video_url}}">
                                            </iframe>
                                        </div>
                                    @endif

                                    <div class="col-lg-5 col-md-5">
                                        <table class="table table-hover table-bordered table-nowrap table-align-middle card-table">
                                            <tbody>
                                                <tr>
                                                    <th>বই</th>
                                                    <td>{{ $product->name_bangla }}<br/> {{ $product->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>লেখক</th>
                                                    <td>{!! $autor_html !!}</td>
                                                </tr>
                                                <tr>
                                                    <th>প্রকাশনী</th>
                                                    <td><a class="font-weight-normal text-accent" style="color: #5C7CFF !important;" href="{{ route('products',['id'=> $product->publisher_id,'data_from'=>'publisher','page'=>1, 'publisher_name'=>$product->publisher['slug']]) }}">{{ $product->publisher->name_bangla }}</a></td>
                                                </tr>
                                                <tr>
                                                    <th>আইএসবিএন (ISBN)</th>
                                                    <td>{{ $product->isbn }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-7 col-md-7" onmousedown='return false;' onselectstart='return false;' style="-webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">
                                        {!! $product['details'] !!}
                                    </div>
                                </div>
                            </div>
                            <!-- Reviews tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="row pt-2 pb-3">
                                    <div class="col-lg-4 col-md-5 ">
                                        <h2 class="overall_review mb-2">{{$overallRating[1]}}
                                            &nbsp{{\App\CPU\translate('Reviews')}} </h2>
                                        <div
                                            class="star-rating {{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}">
                                            @if (round($overallRating[0])==5)
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                            @if (round($overallRating[0])==4)
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                <i class="czi-star font-size-sm text-muted {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                            @endif
                                            @if (round($overallRating[0])==3)
                                                @for ($i = 0; $i < 3; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                @for ($j = 0; $j < 2; $j++)
                                                    <i class="czi-star font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                            @if (round($overallRating[0])==2)
                                                @for ($i = 0; $i < 2; $i++)
                                                    <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                @for ($j = 0; $j < 3; $j++)
                                                    <i class="czi-star font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                            @if (round($overallRating[0])==1)
                                                @for ($i = 0; $i < 4; $i++)
                                                    <i class="czi-star font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                                <i class="czi-star-filled font-size-sm text-accent {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                            @endif
                                            @if (round($overallRating[0])==0)
                                                @for ($i = 0; $i < 5; $i++)
                                                    <i class="czi-star font-size-sm text-muted {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                                                @endfor
                                            @endif
                                        </div>
                                        <span class="d-inline-block align-middle">
                                    {{$overallRating[0]}} {{\App\CPU\translate('Overall')}} {{\App\CPU\translate('rating')}}
                                </span>
                                    </div>
                                    <div class="col-lg-8 col-md-7 pt-sm-3 pt-md-0">
                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('5')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[0] != 0) ? ($rating[0] / $overallRating[1]) * 100 : (0); ?>%;"
                                                         aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                        {{$rating[0]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('4')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[1] != 0) ? ($rating[1] / $overallRating[1]) * 100 : (0); ?>%; background-color: #a7e453;"
                                                         aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                       {{$rating[1]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('3')}}</span><i
                                                    class="czi-star-filled font-size-xs ml-1"></i></div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[2] != 0) ? ($rating[2] / $overallRating[1]) * 100 : (0); ?>%; background-color: #ffda75;"
                                                         aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                        {{$rating[2]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('2')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[3] != 0) ? ($rating[3] / $overallRating[1]) * 100 : (0); ?>%; background-color: #fea569;"
                                                         aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                    {{$rating[3]}}
                                    </span>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="text-nowrap {{Session::get('direction') === "rtl" ? 'ml-3' : 'mr-3'}}"><span
                                                    class="d-inline-block align-middle text-muted">{{\App\CPU\translate('1')}}</span><i
                                                    class="czi-star-filled font-size-xs {{Session::get('direction') === "rtl" ? 'mr-1' : 'ml-1'}}"></i>
                                            </div>
                                            <div class="w-100">
                                                <div class="progress" style="height: 4px;">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                         style="width: <?php echo $widthRating = ($rating[4] != 0) ? ($rating[4] / $overallRating[1]) * 100 : (0); ?>%;"
                                                         aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-muted {{Session::get('direction') === "rtl" ? 'mr-3' : 'ml-3'}}">
                                       {{$rating[4]}}
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-4 pb-4 mb-3">
                                <div class="row pb-4">
                                    <div class="col-12">
                                        @foreach($product->reviews as $productReview)
                                            <div class="single_product_review p-2" style="margin-bottom: 20px">
                                                <div class="product-review d-flex justify-content-between">
                                                    <div
                                                        class="d-flex mb-3 {{Session::get('direction') === "rtl" ? 'pl-5' : 'pr-5'}}">
                                                        <div
                                                            class="media media-ie-fix align-items-center {{Session::get('direction') === "rtl" ? 'ml-4 pl-2' : 'mr-4 pr-2'}}">
                                                            <img style="max-height: 64px;"
                                                                 class="rounded-circle" width="64"
                                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                 src="{{asset("storage/app/public/profile")}}/{{(isset($productReview->user)?$productReview->user->image:'')}}"
                                                                 alt="{{isset($productReview->user)?$productReview->user->f_name:'not exist'}}" onmousedown='return false;' onselectstart='return false;'/>
                                                            <div
                                                                class="media-body {{Session::get('direction') === "rtl" ? 'pr-3' : 'pl-3'}}">
                                                                <h6 class="font-size-sm mb-0">{{isset($productReview->user)?$productReview->user->f_name:'not exist'}}</h6>
                                                                <div class="d-flex justify-content-between">
                                                                    <div
                                                                        class="product_review_rating">{{$productReview->rating}}</div>
                                                                    <div class="star-rating">
                                                                        @for($inc=0;$inc<5;$inc++)
                                                                            @if($inc<$productReview->rating)
                                                                                <i class="sr-star czi-star-filled active"></i>
                                                                            @else
                                                                                <i class="sr-star czi-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                </div>

                                                                <div class="font-size-ms text-muted">
                                                                    {{$productReview->created_at->format('M d Y')}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p class="font-size-md mt-3 mb-2">{{$productReview->comment}}</p>
                                                        @if (!empty(json_decode($productReview->attachment)))
                                                            @foreach (json_decode($productReview->attachment) as $key => $photo)
                                                                <img
                                                                    style="cursor: pointer;border-radius: 5px;border:1px;border-color: #7a6969; height: 67px ; margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 5px;"
                                                                    onclick="showInstaImage('{{asset("storage/app/public/review/$photo")}}')"
                                                                    class="cz-image-zoom"
                                                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                    src="{{asset("storage/app/public/review/$photo")}}"
                                                                    alt="Product review" width="67" onmousedown='return false;' onselectstart='return false;'>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(count($product->reviews)==0)
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="text-danger text-center">{{\App\CPU\translate('product_review_not_available')}}</h6>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product carousel (You may also like)-->
    <div class="container  mb-3 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="flex-between">
            <div class="feature_header">
                <span>{{ \App\CPU\translate('similar_products')}}</span>
            </div>

            <div class="view_all ">
                <div>
                    @php($category=json_decode($product['category_ids']))
                    <a class="btn btn-outline-accent btn-sm viw-btn-a"
                       href="{{route('products',['id'=> $category[0]->id,'data_from'=>'category','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                        <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1' : 'right ml-1 mr-n1'}}"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Grid-->
        <hr class="view_border">
        <!-- Product-->
        <div class="row mt-4">
            @if (count($relatedProducts)>0)
                @foreach($relatedProducts as $key => $relatedProduct)
                    <div class="col-xl-2 col-sm-3 col-6" style="margin-bottom: 20px">
                        @include('web-views.partials._single-product',['product'=>$relatedProduct])
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-danger text-center">{{\App\CPU\translate('similar')}} {{\App\CPU\translate('product_not_available')}}</h6>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade rtl" id="show-modal-view" tabindex="-1" role="dialog" aria-labelledby="show-modal-image"
         aria-hidden="true" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="display: flex;justify-content: center">
                    <button class="btn btn-default"
                            style="border-radius: 50%;margin-top: -25px;position: absolute;{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: -7px;"
                            data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                    <img class="element-center" id="attachment-view" src="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

    <script type="text/javascript">
        cartQuantityInitialize();
        getVariantPrice();
        // SET MAX VALUE
        // SET MAX VALUE
        $('.cart-qty-field').attr('max', 50);
        // SET MAX VALUE
        // SET MAX VALUE
        $('#add-to-cart-form input').on('change', function () {
            getVariantPrice();
            // SET MAX VALUE
            // SET MAX VALUE
            $('.cart-qty-field').attr('max', 50);
            // SET MAX VALUE
            // SET MAX VALUE
        });

        function showInstaImage(link) {
            $("#attachment-view").attr("src", link);
            $('#show-modal-view').modal('toggle')
        }
    </script>

    {{-- Messaging with shop seller --}}
    <script>
        $('#contact-seller').on('click', function (e) {
            // $('#seller_details').css('height', '200px');
            $('#seller_details').animate({'height': '276px'});
            $('#msg-option').css('display', 'block');
        });
        $('#sendBtn').on('click', function (e) {
            e.preventDefault();
            let msgValue = $('#msg-option').find('textarea').val();
            let data = {
                message: msgValue,
                shop_id: $('#msg-option').find('textarea').attr('shop-id'),
                seller_id: $('.msg-option').find('.seller_id').attr('seller-id'),
            }
            if (msgValue != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: '{{route('messages_store')}}',
                    data: data,
                    success: function (respons) {
                        console.log('send successfully');
                    }
                });
                $('#chatInputBox').val('');
                $('#msg-option').css('display', 'none');
                $('#contact-seller').find('.contact').attr('disabled', '');
                $('#seller_details').animate({'height': '125px'});
                $('#go_to_chatbox').css('display', 'block');
            } else {
                console.log('say something');
            }
        });
        $('#cancelBtn').on('click', function (e) {
            e.preventDefault();
            $('#seller_details').animate({'height': '114px'});
            $('#msg-option').css('display', 'none');
        });
    </script>

    <script type="text/javascript"
            src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons"
            async="async"></script>
@endpush
