<style>
    .list-group-item li, a {
        color: {{$web_config['primary_color']}};
    }

    .list-group-item li, a:hover {
        color: {{$web_config['secondary_color']}};
    }
</style>
<ul class="list-group list-group-flush">
    @foreach($products as $product)
        <li class="list-group-item" onclick="$('.search_form').submit()" style="padding: .3rem 0rem!important;">
            <a href="{{ route('product', $product->slug)}} " 
                {{-- onmouseover="$('.search-bar-input-mobile').val('{{$product['name']}}');$('.search-bar-input').val('{{$product['name_bangla']}}');" --}}
                >
                <div class="row">
                    <div class="col-1">
                        <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                         onerror="this.src='{{asset('public/assets/front-end/img/book_demo.jpg')}}'"
                         style="">
                    </div>
                    <div class="col-9">
                        {{$product['name_bangla']}}<br/>
                        <span style="color:grey;">
                            @if ($product->writers->count() > 0)
                                {{$product->writers[0]->name_bangla}}
                            @elseif($product->translators->count() > 0)
                                {{$product->translators[0]->name_bangla}}
                            @elseif($product->editors->count() > 0)
                                {{$product->editors[0]->name_bangla}}
                            @endif
                        </span>
                    </div>
                    <div class="col-2">
                        ৳ {{ number_format($product->unit_price, 0) }}<br/>
                        @if($product->published_price > $product->unit_price)
                            <strike style="font-size: 12px!important;color: grey!important;">
                                ৳ {{ number_format($product->published_price, 0) }}
                            </strike><br>
                        @endif
                    </div>
                </div>
            </a>
        </li>
    @endforeach
    
    @if(count($products) == 0)
    <li class="list-group-item" style="padding: .3rem 0rem!important;">
        পাওয়া যায়নি! <a href="{{ route('book-request') }}" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> অনুরোধ করুন</a>
    </li>  
    @endif
</ul>
