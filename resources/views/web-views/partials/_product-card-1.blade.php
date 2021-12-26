@php($overallRating = \App\CPU\ProductManager::get_overall_rating($product->reviews))
<div class="flash_deal_product rtl" style="cursor: pointer;"
     onclick="location.href='{{route('product',$product->slug)}}'">
    @if($product->discount > 0)
        <div class="discount-top-f">
            <span class="for-discoutn-value pl-1 pr-1">
                @if ($product->discount_type == 'percent')
                    {{round($product->discount)}}%
                @elseif($product->discount_type =='flat')
                    {{\App\CPU\Helpers::currency_converter($product->discount)}}
                @endif {{\App\CPU\translate('off')}}
            </span>
        </div>
    @endif
    <div class=" d-flex">
        <div class="d-flex align-items-center justify-content-center"
             style="min-width: 110px">
            <img style="height: 130px!important; width: 91px!important;"
                 src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"/>
        </div>
        <div class="flash_deal_product_details pl-2 pr-1 d-flex align-items-center">
            <div>
                <h6 class="flash-product-title">
                    {{\Illuminate\Support\Str::limit($product['name_bangla'],20)}}          
                </h6><br/>
                @if ($product->writers->count() > 0)
                    <small>{{$product->writers[0]->name_bangla}}</small>
                @elseif($product->translators->count() > 0)
                    <small>{{$product->translators[0]->name_bangla}}</small>
                @elseif($product->editors->count() > 0)
                    <small>{{$product->editors[0]->name_bangla}}</small>
                @endif
                <div class="flash-product-price">
                    ৳ {{ number_format($product->unit_price, 0) }}
                    @if($product->published_price > $product->unit_price)
                        <strike
                            style="font-size: 12px!important;color: grey!important;">
                            ৳ {{ number_format($product->published_price, 0) }}
                        </strike>
                    @endif
                </div>
                <h6 class="flash-product-review">
                    @for($inc=0;$inc<5;$inc++)
                        @if($inc<$overallRating[0])
                            <i class="sr-star czi-star-filled active"></i>
                        @else
                            <i class="sr-star czi-star"></i>
                        @endif
                    @endfor
                    <label class="badge-style2">
                        ( {{$product->reviews->count()}} )
                    </label>
                </h6>
            </div>
        </div>
    </div>
</div>
