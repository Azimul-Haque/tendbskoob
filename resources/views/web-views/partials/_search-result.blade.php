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
        <li class="list-group-item" onclick="$('.search_form').submit()">
            <a href="javascript:" onmouseover="$('.search-bar-input-mobile').val('{{$product['name']}}');$('.search-bar-input').val('{{$product['name']}}');">
                {{$product['name_bangla']}}
            </a>
        </li>
    @endforeach
</ul>
