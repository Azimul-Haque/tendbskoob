@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Seller Product Edit'))

@push('css_or_js')
    <link href="{{asset('public/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{\App\CPU\translate('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page"><a
                        href="{{route('admin.product.list', 'in_house')}}">{{\App\CPU\translate('Product')}}</a>
                </li>
                <li class="breadcrumb-item">{{\App\CPU\translate('Edit')}} {{\App\CPU\translate('Book')}} </li>
            </ol>
        </nav>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{route('seller.product.update', $product->id)}}" method="POST"
                      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                      enctype="multipart/form-data"
                      id="product_form">
                    @csrf
                    {{-- <div class="card">
                        <div class="card-header">
                            @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')

                            @php($default_lang = json_decode($language)[0])
                            <ul class="nav nav-tabs mb-4">
                                @foreach(json_decode($language) as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}" href="#"
                                           id="{{$lang}}-link">{{\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-body">
                            @foreach(json_decode($language) as $lang)
                                <div class="{{$lang != $default_lang ? 'd-none':''}} lang_form"
                                     id="{{$lang}}-form">
                                    <div class="form-group">
                                        <label class="input-label" for="{{$lang}}_name">{{\App\CPU\translate('name')}}
                                            ({{strtoupper($lang)}})</label>
                                        <input type="text" {{$lang == $default_lang? 'required':''}} name="name[]"
                                               id="{{$lang}}_name" class="form-control" placeholder="New Product" required>
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                    <div class="form-group pt-4">
                                        <label class="input-label"
                                               for="{{$lang}}_description">{{\App\CPU\translate('description')}}
                                            ({{strtoupper($lang)}})</label>
                                        <textarea name="description[]" class="editor textarea" id="textarea" cols="30"
                                                  rows="10" required>{{old('details')}}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Book</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="publisher_id">{{\App\CPU\translate('Publication')}} *</label>
                                <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control" name="publisher_id" id="publisher_id" required>
                                    <option value="{{ $seller->publisher ? $seller->publisher->id : '' }}" selected>
                                        {{ $seller->publisher ? $seller->publisher->name_bangla : '' }}
                                    </option>
                                    {{-- <option value="{{ old('publisher_id') }}" selected disabled>Select Publication</option>
                                    @foreach($publishers as $publisher)
                                        <option value="{{ $publisher['id'] }}" @if ($product->publisher_id == $publisher['id']) selected="" @endif>
                                            {{ $publisher['name_bangla'] }} ({{ $publisher['name'] }})
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="input-label" for="name_bangla">{{\App\CPU\translate('Book Name (Bangla)')}} *</label>
                                        <input type="text" name="name_bangla" id="name_bangla" value="{{ $product->name_bangla }}" class="form-control" placeholder="Book Name in Bangla" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="input-label" for="name">{{\App\CPU\translate('Book Name (English)')}} *</label>
                                        <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" placeholder="Book Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                        $writer_id_array = [];
                                        foreach ($product->writers as $writer) {
                                            $writer_id_array[] = $writer->id;
                                        }
                                    ?>
                                    <label for="name">{{\App\CPU\translate('Writer')}}</label>
                                    <select
                                        class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control"
                                        name="writer_id[]" id="writer_id" multiple>
                                        @foreach($authors as $writer)
                                            <option value="{{$writer['id']}}" imagename="{{ $writer->image != '' ? $writer->image : 0 }}" @if (in_array($writer->id, $writer_id_array)) selected="" @endif>
                                                {{ $writer['name_bangla'] }} ({{ $writer['name'] }})
                                            </option>
                                        @endforeach
                                    </select><br/><br/>
                                    
                                    <?php
                                        $translator_id_array = [];
                                        foreach ($product->translators as $translator) {
                                            $translator_id_array[] = $translator->id;
                                        }
                                    ?>
                                    <label for="name">{{\App\CPU\translate('Translator')}}</label>
                                    <select
                                        class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control"
                                        name="translator_id[]" id="translator_id" multiple>
                                        @foreach($authors as $translator)
                                            <option value="{{$translator['id']}}" imagename="{{ $translator->image != '' ? $translator->image : 0 }}" @if (in_array($translator->id, $translator_id_array)) selected="" @endif>
                                                {{ $translator['name_bangla'] }} ({{ $translator['name'] }})
                                            </option>
                                        @endforeach
                                    </select><br/><br/>

                                    <?php
                                        $editors_id_array = [];
                                        foreach ($product->editors as $editor) {
                                            $editors_id_array[] = $editor->id;
                                        }
                                    ?>
                                    <label for="name">{{\App\CPU\translate('Editor')}}</label>
                                    <select
                                        class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control" name="editor_id[]" id="editor_id" multiple>
                                        @foreach($authors as $editor)
                                            <option value="{{$editor['id']}}" imagename="{{ $editor->image != '' ? $editor->image : 0 }}" @if (in_array($editor->id, $editors_id_array)) selected="" @endif>
                                                {{ $editor['name_bangla'] }} ({{ $editor['name'] }})
                                            </option>
                                        @endforeach
                                    </select><br/><br/>

                                    <?php
                                        $category_id_array = [];
                                        foreach ($product->categories as $category) {
                                            $category_id_array[] = $category->id;
                                        }
                                    ?>
                                    <label for="name">{{\App\CPU\translate('Category')}} *</label>
                                    <select class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control" name="category_id[]" id="category_id" multiple required>
                                        @foreach($cat as $c)
                                            <option value="{{$c['id']}}" @if (in_array($c->id, $category_id_array)) selected="" @endif>
                                                {{ $c['name_bangla'] }} ({{ $c['name'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">{{\App\CPU\translate('Book Image')}} *</label> <small
                                            style="color: red">(w: 260px, h: 372px)</small>
                                    </div>
                                    <center>
                                        <div style="max-width:200px;">
                                            <div class="row" id="thumbnail"></div>
                                        </div>
                                    </center>
                                </div>
                            </div><br/>
                            <div class="form-group">
                                <label class="input-label" for="description">{{\App\CPU\translate('description (Optional)')}}</label>
                                <textarea name="description" class="editor textarea" id="textarea" cols="30" rows="10">{{  $product->details  }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{\App\CPU\translate('General Info')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="name">{{\App\CPU\translate('Category')}}</label>
                                        <select
                                            class="js-example-basic-multiple multiple js-states js-example-responsive form-control form-control"
                                            name="category_id[]" id="category_id" multiple
                                            onchange="getRequest('{{url('/')}}/admin/product/get-categories?parent_id='+this.value,'sub-category-select','select')"
                                            required>
                                            <option value="{{old('category_id')}}" selected disabled>---Select---</option>
                                            @foreach($cat as $c)
                                                <option value="{{$c['id']}}" {{old('name_bangla')==$c['id']? 'selected': ''}}>
                                                    {{$c['name_bangla']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{\App\CPU\translate('Sub Category')}}</label>
                                        <select class="js-example-basic-multiple form-control"
                                            name="sub_category_id" id="sub-category-select"
                                            onchange="getRequest('{{url('/')}}/admin/product/get-categories?parent_id='+this.value,'sub-sub-category-select','select')">
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="name">{{\App\CPU\translate('Sub Sub Category')}}</label>
                                        <select
                                            class="js-example-basic-multiple form-control"
                                            name="sub_sub_category_id" id="sub-sub-category-select">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="name">{{\App\CPU\translate('Brand')}}</label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="brand_id" required>
                                            <option value="{{null}}" selected disabled>---{{\App\CPU\translate('Select')}}---</option>
                                            @foreach($br as $b)
                                                <option value="{{$b['id']}}">{{$b['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="name">{{\App\CPU\translate('Unit')}}</label>
                                        <select
                                            class="js-example-basic-multiple form-control"
                                            name="unit">
                                            @foreach(\App\CPU\Helpers::units() as $x)
                                                <option
                                                    value="{{$x}}" {{old('unit')==$x? 'selected':''}}>{{$x}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{\App\CPU\translate('Variations')}}</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="colors">
                                            {{\App\CPU\translate('Colors')}} :
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" class="status" value="{{old('colors_active')}}"
                                                   name="colors_active">
                                            <span class="slider round"></span>
                                        </label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                                            name="colors[]" multiple="multiple" id="colors-selector" disabled>
                                            @foreach (\App\Model\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                <option value="{{ $color->code }}">
                                                    {{$color['name']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="attributes" style="padding-bottom: 3px">
                                            {{\App\CPU\translate('Attributes')}} :
                                        </label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="choice_attributes[]" id="choice_attributes" multiple="multiple">
                                            @foreach (\App\Model\Attribute::orderBy('name', 'asc')->get() as $key => $a)
                                                <option value="{{ $a['id']}}">
                                                    {{$a['name']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-2 mb-2">
                                        <div class="customer_choice_options" id="customer_choice_options"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4>{{\App\CPU\translate('Product price & stock')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">{{\App\CPU\translate('ISBN Number')}}</label>
                                        <input type="text"
                                               placeholder="{{\App\CPU\translate('ISBN Number')}}"
                                               name="isbn" value="{{ $product->isbn }}" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        @if ((auth('admin')->user() && auth('admin')->user()->role->name == 'Master Admin') || (auth('admin')->user() && auth('admin')->user()->role->name == 'Admin'))
                                            <label
                                                class="control-label">{{\App\CPU\translate('Book Weight (KG)')}}</label>
                                            <input type="number" min="0" step="0.01"
                                                placeholder="{{\App\CPU\translate('Book Weight')}}"
                                                value="{{ $product->weight }}" name="weight" class="form-control">
                                        @endif
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    @if ((auth('admin')->user() && auth('admin')->user()->role->name == 'Master Admin') || (auth('admin')->user() && auth('admin')->user()->role->name == 'Admin'))
                                    
                                    @endif
                                    <div class="col-md-4">
                                        <label class="control-label">মুদ্রিত মূল্য (৳)</label>
                                        <input type="number" min="0" step="0.01"
                                            placeholder="{{\App\CPU\translate('Published Price')}}"
                                            name="published_price" id="published_price" value="{{ $product->published_price }}" class="form-control"
                                            required>
                                    </div>    
                                    <div class="col-md-4">
                                        <label
                                            class="control-label">বুকসবিডির কমিশন (%) <small id="purchase_percentage_text" style="color: green; font-weight: bold;">৳ {{ $product->purchase_price }}</small></label>
                                        <input type="number" min="0" step="0.01" max="100"
                                            placeholder="শুধুমাত্র ইংরেজি নম্বরে পারসেন্টিজটি উল্লেখ করুন"
                                            value="{{ (($product->published_price - $product->purchase_price) / $product->published_price) * 100 }}"
                                            onkeyup="purchasePercetage();"
                                            id="purchase_price_percentage" class="form-control" required>
                                        <input type="hidden" name="purchase_price" id="purchase_price">
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <label class="control-label">কাস্টমার কমিশন (%) <small id="unit_percentage_text" style="color: green; font-weight: bold;">৳ {{ $product->unit_price }}</small></label>
                                        <input type="number" min="0" step="0.01" max="100"
                                            placeholder="শুধুমাত্র ইংরেজি নম্বরে পারসেন্টিজটি উল্লেখ করুন"
                                            value="{{ (($product->published_price - $product->unit_price) / $product->published_price) * 100 }}"
                                            onkeyup="unitPercetage()"
                                            id="unit_price_percentage"  class="form-control"
                                            required>
                                        <input type="hidden" name="unit_price" id="unit_price">
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    {{-- <div class="col-md-5">
                                        <label class="control-label">{{\App\CPU\translate('Tax')}}</label>
                                        <label class="badge badge-info">{{\App\CPU\translate('Percent')}} ( % )</label>
                                        <input type="number" min="0" value="0" step="0.01"
                                               placeholder="{{\App\CPU\translate('Tax')}}}" name="tax"
                                               value="{{old('tax')}}"
                                               class="form-control">
                                        <input name="tax_type" value="percent" style="display: none">
                                    </div>

                                    <div class="col-md-5">
                                        <label class="control-label">{{\App\CPU\translate('Discount')}}</label>
                                        <input type="number" min="0" value="{{old('discount')}}" step="0.01"
                                               placeholder="{{\App\CPU\translate('Discount')}}" name="discount"
                                               class="form-control">
                                    </div>
                                    <div class="col-md-2" style="padding-top: 30px;">
                                        <select style="width: 100%"
                                            class="js-example-basic-multiple js-states js-example-responsive demo-select2"
                                            name="discount_type">
                                            <option value="flat">{{\App\CPU\translate('Flat')}}</option>
                                            <option value="percent">{{\App\CPU\translate('Percent')}}</option>
                                        </select>
                                    </div>
                                    <div class="pt-4 col-12 sku_combination" id="sku_combination">

                                    </div> --}}
                                    <div class="col-md-4" id="quantity">
                                        <label
                                            class="control-label">{{\App\CPU\translate('total')}} {{\App\CPU\translate('Quantity')}}</label>
                                        <input type="number" min="0" step="1" placeholder="{{\App\CPU\translate('Quantity')}}" name="current_stock" value="{{ $product->current_stock }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-4" id="release_date">
                                        <label
                                            class="control-label">প্রকাশনার সম্ভ্যাব্য তারিখ (অপশনাল)</label>
                                            <input type="date" name="release_date" value="{{ $product->release_date }}" id="release_date" class="form-control">
                                    </div>
                                    <div class="col-md-4 pt-4">
                                        <center>
                                            <label class="radio-inline" style="margin-right: 10px;">
                                                <input type="radio" name="stock_status" value="1" @if ($product->stock_status == 1) checked @endif> In Stock 
                                            </label>
                                            <label class="radio-inline" style="margin-right: 10px;">
                                                <input type="radio" name="stock_status" value="2" @if ($product->stock_status == 2) checked @endif> Out of Stock 
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="stock_status" value="3" @if ($product->stock_status == 3) checked @endif> Back Order 
                                            </label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card mt-2 mb-2 rest-part">
                        <div class="card-header">
                            <h4>{{\App\CPU\translate('seo_section')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="control-label">{{\App\CPU\translate('Meta Title')}}</label>
                                    <input type="text" name="meta_title" placeholder="" class="form-control">
                                </div>

                                <div class="col-md-8 mb-4">
                                    <label class="control-label">{{\App\CPU\translate('Meta Description')}}</label>
                                    <textarea rows="10" type="text" name="meta_description" class="form-control"></textarea>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label>{{\App\CPU\translate('Meta Image')}}</label>
                                    </div>
                                    <div class="border border-dashed">
                                        <div class="row" id="meta_img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="card mt-2 rest-part">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="control-label">{{\App\CPU\translate('Youtube video link')}}</label>
                                    <small class="badge badge-soft-danger"> ( {{\App\CPU\translate('optional, please provide embed link not direct link')}}. )</small>
                                    <input type="text" name="video_link" placeholder="{{\App\CPU\translate('EX')}} : https://www.youtube.com/embed/5R06LRdUCSE" class="form-control" required>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{\App\CPU\translate('Upload product images')}}</label><small
                                            style="color: red">* ( {{\App\CPU\translate('ratio')}} 1:1 )</small>
                                    </div>
                                    <div class="p-2 border border-dashed" style="max-width:430px;">
                                        <div class="row" id="coba"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card card-footer">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 20px">
                                <button type="button" onclick="check()" class="btn btn-primary">{{\App\CPU\translate('Submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <?php
        $thumbnail = asset('public/assets/back-end/img/book_demo.jpg');
        if($product->thumbnail != null) {
            // if(file_exists(\App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product->thumbnail)) {
            //     $thumbnail = \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product->thumbnail;
            // }
            $thumbnail = \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product->thumbnail;
        }
        // echo \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $product['thumbnail'];
    ?>
    <script src="{{asset('public/assets/back-end')}}/js/tags-input.min.js"></script>
    <script src="{{asset('public/assets/back-end/js/spartan-multi-image-picker.js')}}"></script>
    <script>
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 4,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/back-end/img/400x400/img2.jpg')}}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('Please only input png or jpg type file')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('File size too big')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            
            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ $thumbnail }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('Please only input png or jpg type file')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('File size too big')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#meta_img").spartanMultiImagePicker({
                fieldName: 'meta_image',
                maxCount: 1,
                rowHeight: '280px',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/back-end/img/400x400/img2.jpg')}}',
                    width: '90%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('Please only input png or jpg type file')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('File size too big')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        function purchasePercetage() {
            var published_price = $('#published_price').val() ? $('#published_price').val() : 0;
            var purchase_price_percentage = $('#purchase_price_percentage').val() ? $('#purchase_price_percentage').val() : 0;
            var purchase_price = published_price - (published_price * (purchase_price_percentage/100));
            console.log(purchase_price_percentage);
            $('#purchase_price').val(purchase_price);
            $('#purchase_percentage_text').text('(৳: ' + purchase_price + ')');
        }

        function unitPercetage() {
            var published_price = $('#published_price').val() ? $('#published_price').val() : 0;
            var unit_price_percentage = $('#unit_price_percentage').val() ? $('#unit_price_percentage').val() : 0;
            var unit_price = published_price - (published_price * (unit_price_percentage/100));
            console.log(unit_price_percentage);
            $('#unit_price').val(unit_price);
            $('#unit_percentage_text').text('(৳: ' + unit_price + ')');
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src="public/public/assets/back-end/img/book_demo.jpg', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });


        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            // dir: "rtl",
            width: 'resolve'
        });

        $("#publisher_id").select2({
            placeholder: "Select Publication",
        });

        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            // console.log(state.element.attributes['imagename'].value);
            if(state.element.attributes['imagename'].value != 0) {
                var baseUrl = "/public/images/author";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.attributes['imagename'].value + '" style="height:50px;width:50px;" /> ' + state.text + '</span>'
                );
            } else {
                var $state = $(
                    '<span><img src="/public/assets/back-end/img/user.png" style="height:50px;width:50px;" /> ' + state.text + '</span>'
                );
            }
            
            return $state;
        };

        $("#writer_id").select2({
            placeholder: "Select Witer",
            multiple: true,
            templateResult: formatState,
            templateSelection: formatState,
        });

        $("#translator_id").select2({
            placeholder: "Select Translator",
            multiple: true,
            templateResult: formatState,
            templateSelection: formatState,
        });

        $("#editor_id").select2({
            placeholder: "Select Editor",
            multiple: true,
            templateResult: formatState,
            templateSelection: formatState,
        });

        $("#category_id").select2({
            placeholder: "Select Category",
            multiple: true,
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    if (type == 'select') {
                        $('#' + id).empty().append(data.select_tag);
                    }
                },
            });
        }

        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append('<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="{{trans('Choice Title') }}" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{trans('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }


        $('#colors-selector').on('change', function () {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function () {
            // update_sku();
        });

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '{{route('admin.product.sku-combination')}}',
                data: $('#product_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        $(document).ready(function () {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>

    <script>
        function check(){
            Swal.fire({
                title: '{{\App\CPU\translate('Are you sure')}}?',
                text: '',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var formData = new FormData(document.getElementById('product_form'));
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{route('admin.product.update', $product->id)}}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                            console.log(data.errors);
                        } else {
                            toastr.success('{{\App\CPU\translate('product added successfully')}}!', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('#product_form').submit();
                        }
                    }
                });
            })
        };
    </script>

    {{-- <script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == ' default_lang ') {
                $(".rest-part").removeClass('d-none');
            } else {
                $(".rest-part").addClass('d-none');
            }
        });
    </script> --}}

    {{--ck editor--}}
    {{-- <script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script> --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
    <script>
        $(document).ready(function() {
            // $('.textarea').ckeditor({
            //     // contentsLangDirection : '{{Session::get('direction')}}',
            // });
            CKEDITOR.replace('textarea', {
                toolbar : 'Basic',
            });
        });
    </script>
    {{--ck editor--}}
@endpush
