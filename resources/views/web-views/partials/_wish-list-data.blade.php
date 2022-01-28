<style>

    body {
        font-family: 'Titillium Web', sans-serif
    }

    .card {
        border: none
    }

    .totals tr td {
        font-size: 13px
    }

    .footer span {
        font-size: 12px
    }

    .product-qty span {
        font-size: 12px;
        color: #6A6A6A;
    }

    .font-name {
        font-weight: 600;
        font-size: 15px;
        color: #030303;
    }

    .sellerName {

        font-weight: 600;
        font-size: 14px;
        color: #030303;
    }

    .wishlist_product_img img {
        margin: 15px;
    }

    @media (max-width: 600px) {
        .font-name {
            font-size: 12px;
            font-weight: 400;
        }

        .amount {
            font-size: 12px;
        }
    }

    @media (max-width: 600px) {
        .wishlist_product_img {
            width: 20%;
        }

        .forPadding {
            padding: 6px;
        }

        .sellerName {

            font-weight: 400;
            font-size: 12px;
            color: #030303;
        }

        .wishlist_product_desc {
            width: 50%;
            margin-top: 0px !important;
        }

        .wishlist_product_icon {
            margin-left: 1px !important;
        }

        .wishlist_product_btn {
            width: 30%;
            margin-top: 10px !important;
        }

        .wishlist_product_img img {
            margin: 8px;
        }
    }
</style>
@if($wishlists->count()>0)
    @foreach($wishlists as $wishlist)
        @php($product = $wishlist->product)
        @if( $wishlist->product)
            <div class="card box-shadow-sm mt-2">
                <div class="product mb-2">
                    <div class="card">
                        <div class="row forPadding">
                            <div class="wishlist_product_img col-md-2 col-lg-2 col-sm-2">
                                <a href="{{route('product',$product->slug)}}">
                                    <img
                                        src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                                        onerror="this.src='{{asset('public/assets/front-end/img/book_demo.jpg')}}'"
                                        style="height: 120px; width: auto;" onmousedown='return false;' onselectstart='return false;'>
                                </a>
                            </div>
                            <div class="wishlist_product_desc col-md-8 mt-3">
                                <span class="font-name">
                                    <a href="{{route('product',$product['slug'])}}"><big>{{$product['name_bangla']}}</big></a>
                                </span>
                                <br>
                                <span class="sellerName" style="color: #5C7CFF !important;"">
                                    @if ($product->writers->count() > 0)
                                        {{$product->writers[0]->name_bangla}}
                                    @elseif($product->translators->count() > 0)
                                        {{$product->translators[0]->name_bangla}}
                                    @elseif($product->editors->count() > 0)
                                        {{$product->editors[0]->name_bangla}}
                                    @endif
                                </span>
                                <div class="mt-2">
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
                            </div>
                            <div
                                class="wishlist_product_btn col-md-2 col-lg-2 col-sm-2 mt-5 float-right bodytr font-weight-bold"
                                style="color: #92C6FF;">

                                <a href="javascript:" class="wishlist_product_icon ml-2 pull-right mr-3">
                                    <i class="czi-close-circle" onclick="removeWishlist('{{$product['id']}}')"
                                       style="color: red"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <span class="badge badge-danger">{{\App\CPU\translate('item_removed')}}</span>
        @endif
    @endforeach
@else
    <center>
        <h6 class="text-muted">
            {{\App\CPU\translate('No data found')}}.
        </h6>
    </center>
@endif
