@extends('layouts.back-end.app')

@section('title', $seller->name? $seller->name : \App\CPU\translate("Shop Name"))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">{{\App\CPU\translate('Dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{\App\CPU\translate('Seller_Edit')}}</li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="{{route('admin.sellers.seller-list')}}" class="btn btn-primary mt-3 mb-3">{{\App\CPU\translate('Back_to_seller_list')}}</a>
            </div>
            <div>
                @if ($seller->status=="pending")
                    <div class="mt-4 pr-2 float-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}">
                        <div class="flex-start">
                            <h4 class="mx-1"><i class="tio-shop-outlined"></i></h4>
                            <div><h4>{{\App\CPU\translate('Seller_request_for_open_a_shop.')}}</h4></div>
                        </div>
                        <div class="text-center">
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-primary">{{\App\CPU\translate('Approve')}}</button>
                            </form>
                            <form class="d-inline-block" action="{{route('admin.sellers.updateStatus')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$seller->id}}">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger">{{\App\CPU\translate('reject')}}</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <div class=" gx-2 gx-lg-3 mb-2">
                    <div>
                        <h4><i style="font-size: 30px"
                               class="tio-edit"></i>{{\App\CPU\translate('Seller_Edit')}}</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-2">
                                <form class="user mt-4" action="{{route('admin.sellers.update', $seller->id)}}" method="PUT" enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="black">প্রকাশনী সম্পর্কিত তথ্যাদি</h5>
                                    <div class="form-group row">
                                        <div class="col-md-4 mb-3 mb-sm-0">
                                            <label for="name">প্রকাশনীর নাম</label>
                                            <input type="text" class="form-control form-control-user" id="name" name="name" value="{{ $seller->name }}" placeholder="Din Publications" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address">প্রকাশনীর ঠিকানা</label>
                                            <input type="text" class="form-control form-control-user" id="address" name="address" value="{{ $seller->address }}" placeholder="Banglabazar, Dhaka" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="address">প্রকাশনীর লোগো <span style="color:red;">(অনুপাত - ১ঃ১)</span></label>
                                            <div class="form-group">
                                                <div class="custom-file" style="text-align: left">
                                                    <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .bmp, .tiff|image/*">
                                                    <label class="custom-file-label" for="customFileUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('image')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8 mb-3 mb-sm-0 mt-0">
                                            <label for="description">আপনার প্রকাশনী সম্পর্কে কিছু বলুন</label><br/>
                                            <textarea name="description" id="description" style="width: 100%; height: 220px;" placeholder="আপনার প্রকাশনী সম্পর্কে কিছু বলুন" required>{{ $seller->description }}</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="collection_point">বই সংগ্রহ করার পয়েন্ট</label>
                                                    <select name="collection_point" id="collection_point" class="form-control form-control-user">
                                                        <option selected disabled>নির্বাচন করুন</option>
                                                        <option value="বাংলাবাজার" @if($seller->collection_point == 'বাংলাবাজার') selected @endif>বাংলাবাজার</option>
                                                        <option value="কাঁটাবন" @if($seller->collection_point == 'কাঁটাবন') selected @endif>কাঁটাবন</option>
                                                        <option value="মিরপুর (হেড অফিস)" @if($seller->collection_point == 'মিরপুর (হেড অফিস)') selected @endif>মিরপুর (হেড অফিস)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label for="payment_number">পেমেন্ট গ্রহণ করার জন্য আপনার নম্বরটি দিন</label>
                                                    <input type="number" class="form-control form-control-user" id="payment_number" name="payment_number" value="{{ $seller->payment_number }}" placeholder="01712345678" maxlength="11" required>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label for="payment_option">আপনার নম্বরটি কোন সেবার আওতাধীন?</label>
                                                    <select name="payment_option" id="payment_option" class="form-control form-control-user">
                                                        <option selected disabled>নির্বাচন করুন</option>
                                                        <option value="বিকাশ" @if($seller->payment_option == 'বিকাশ') selected @endif>বিকাশ</option>
                                                        <option value="নগদ" @if($seller->payment_option == 'নগদ') selected @endif>নগদ</option>
                                                        <option value="রকেট" @if($seller->payment_option == 'রকেট') selected @endif>রকেট</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 mb-3 mb-sm-0">
                                            <label for="email">আপনার ই-মেইল</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="{{ $seller->email }}" placeholder="bdjp@booksbd.net" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password">আপনার পাসওয়ার্ড দিন <span style="color:red;">(পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)</span></label>
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="পাসওয়ার্ড লিখুন (পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)" autocomplete="off">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password_confirmation ">আপনার পাসওয়ার্ডটি পুনরায় দিন <span style="color:red;">(পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)</span></label>
                                            <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="পুনরায় পাসওয়ার্ড লিখুন (পরিবর্তন করতে চাইলে দিন, নাহলে ফাঁকা রাখুন)" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="pb-1 mb-2">
                                            <center>
                                                <img style="width: auto;border: 1px solid; max-height:200px;" id="viewer" onerror="this.src='{{asset('/public/assets/back-end/img/400x400/img2.jpg')}}'" src="{{ asset('/public/images/publisher/' . $seller['image']) }}" alt="Publisher Image">
                                            </center>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" id="apply">দাখিল করুন</button>
                                </form>
                                <hr>
                                <div class="text-center mt-4">
                                    আমাদের সাথে একাউন্ট আছে?  <a href="{{route('seller.auth.login')}}" style="color: #339B38 !important;">সাইন ইন</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div>
@endsection

@push('script')
    <script>
        function Validate(file) {
            var x;
            var le = file.length;
            var poin = file.lastIndexOf(".");
            var accu1 = file.substring(poin, le);
            var accu = accu1.toLowerCase();
            if ((accu != '.png') && (accu != '.jpg') && (accu != '.jpeg')) {
                x = 1;
                return x;
            } else {
                x = 0;
                return x;
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        function readlogoURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerLogo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readBannerURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewerBanner').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#LogoUpload").change(function () {
            readlogoURL(this);
        });
        $("#BannerUpload").change(function () {
            readBannerURL(this);
        });
    </script>
@endpush
