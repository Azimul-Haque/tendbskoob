@php($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews))

<div class="product-card card {{$product['current_stock']==0?'stock-card':''}}"
     style="margin-bottom: 40px;display: flex; align-items: center; justify-content: center;">
    {{-- @if($product['current_stock']<=0)
        <label style="left: 29%!important; top: 29%!important;"
               class="badge badge-danger stock-out">{{\App\CPU\translate('stock_out')}}</label>
    @endif --}}
    @if($product['stock_status'] == 3)
        <label style="left: 29%!important; top: 29%!important;"
               class="badge badge-danger stock-out">{{\App\CPU\translate('Back Order')}}</label>
    @endif
    @php
        $category_names = [];
        if($product->categories->count() > 0) {
            for($i = 0; $i < count($product->categories); $i++){
                $category_names[] = $product->categories[$i]->name;
            }
        }
    @endphp
    @if($product['category'] == 3)
        <label style="left: 29%!important; top: 29%!important;"
               class="badge badge-danger stock-out">{{ $category_names }}</label>
    @endif

    <div class="card-header inline_product clickable" style="cursor: pointer;max-height: 193px;min-height: 193px">
        @if($product->discount > 0)
            <div class="d-flex" style="right: 0;top:0;position: absolute">
                    <span class="for-discoutn-value pr-1 pl-1">
                    @if ($product->discount_type == 'percent')
                            {{round($product->discount,2)}}%
                        @elseif($product->discount_type =='flat')
                            {{\App\CPU\Helpers::currency_converter($product->discount)}}
                        @endif
                        {{\App\CPU\translate('off')}}
                    </span>
            </div>
        @else
            <div class="d-flex justify-content-end for-dicount-div-null">
                <span class="for-discoutn-value-null"></span>
            </div>
        @endif
        <div class="d-flex d-block center-div element-center" style="cursor: pointer">
            <a href="{{route('product',$product->slug)}}">
                <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                     onerror="this.src='{{asset('public/assets/front-end/img/book_demo.jpg')}}'"
                     style="width: 90%;max-height: 215px!important;" onmousedown='return false;' onselectstart='return false;'>
            </a>
        </div>
    </div>

    <div class="card-body inline_product text-center p-1 clickable"
         style="cursor: pointer; max-height:7.5rem;">
        {{-- <div class="rating-show">
            <span class="d-inline-block font-size-sm text-body">
                @for($inc=0;$inc<5;$inc++)
                    @if($inc<$overallRating[0])
                        <i class="sr-star czi-star-filled active"></i>
                    @else
                        <i class="sr-star czi-star"></i>
                    @endif
                @endfor
                <label class="badge-style">( {{$product->reviews_count}} )</label>
            </span>
        </div> --}}
        <div style="position: relative;" class="product-title1">
            <a href="{{route('product',$product->slug)}}">
                {{ \Illuminate\Support\Str::limit($product['name_bangla'], 25) }}
            </a><br/>
            @if ($product->writers->count() > 0)
                <small>{{$product->writers[0]->name_bangla}}</small>
            @elseif($product->translators->count() > 0)
                <small>{{$product->translators[0]->name_bangla}}</small>
            @elseif($product->editors->count() > 0)
                <small>{{$product->editors[0]->name_bangla}}</small>
            @endif
        </div>
        <div class="justify-content-between text-center">
            <div class="product-price text-center">
                @if($product['current_stock'] > 0)
                    <small class="mt-3" style="color: green">{{\App\CPU\translate('Book in Stock')}}</small><br>
                @endif
                @if($product->published_price > $product->unit_price)
                    <strike style="font-size: 12px!important;color: grey!important;">
                        ৳ {{ number_format($product->published_price, 0) }}
                    </strike><br>
                @endif
                <span class="text-accent">
                    ৳ {{ number_format($product->unit_price, 0) }}
                </span>
            </div>
        </div>
    </div>

    <div class="card-body card-body-hidden" style="padding-bottom: 5px!important;">
        <div class="text-center">
            {{-- @if(Request::is('product/*'))
                <a class="btn btn-primary btn-sm btn-block mb-2" href="{{route('product',$product->slug)}}">
                    <i class="czi-forward align-middle {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                    {{\App\CPU\translate('View')}}
                </a>
            @else
                <a class="btn btn-primary btn-sm btn-block mb-2" href="javascript:"
                   onclick="quickView('{{$product->id}}')">
                    <i class="czi-eye align-middle {{Session::get('direction') === "rtl" ? 'ml-1' : 'mr-1'}}"></i>
                    {{\App\CPU\translate('Quick')}}   {{\App\CPU\translate('View')}}
                </a>
            @endif --}}
            <form>
                <button type="button" class="btn btn-primary btn-sm btn-block mb-2" onclick="addToCart2({{ $product->id }})">
                    <i class="fa fa-cart-plus mr-2"></i>
                    <span class="string-limit">{{\App\CPU\translate('add_to_cart')}}</span>
                </button>
            </form>
        </div>
    </div>
</div>
