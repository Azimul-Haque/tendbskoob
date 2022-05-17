@extends('layouts.front-end.app')

@section('title', 'বুকস বিডিতে প্রকাশনী হিসেবে অ্যাকাউন্ট করুন | Booksbd.net')

@push('css_or_js')
<link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
<link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush


@section('content')

<div class="container main-card rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">

    <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body ">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-2">
                        <div class="text-center mb-2">
                            <h3 class=""><b>বুকস বিডিতে প্রকাশনী হিসেবে</b> অ্যাকাউন্ট করুন</h3>
                            <hr>
                        </div>
                        <form class="user mt-4" action="{{route('shop.apply')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="black">প্রকাশনী সম্পর্কিত তথ্যাদি</h5>
                            <div class="form-group row">
                                <div class="col-md-4 mb-3 mb-sm-0">
                                    <label for="name">প্রকাশনীর নাম</label>
                                    <input type="text" class="form-control form-control-user" id="name" name="name" value="{{old('name')}}" placeholder="Din Publications" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="address">প্রকাশনীর ঠিকানা</label>
                                    <input type="text" class="form-control form-control-user" id="address" name="address" value="{{old('address')}}" placeholder="Banglabazar, Dhaka" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="address">প্রকাশনীর লোগো <span style="color:red;">(অনুপাত - ১ঃ১)</span></label>
                                    <div class="form-group">
                                        <div class="custom-file" style="text-align: left">
                                            <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .bmp, .tiff|image/*" required>
                                            <label class="custom-file-label" for="customFileUpload">{{\App\CPU\translate('Upload')}} {{\App\CPU\translate('image')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 mb-3 mb-sm-0 mt-0">
                                    <label for="description">আপনার প্রকাশনী সম্পর্কে কিছু বলুন</label><br/>
                                    <textarea name="description" id="description" style="width: 100%; height: 220px;" placeholder="আপনার প্রকাশনী সম্পর্কে কিছু বলুন" required></textarea>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="collection_point">বই সংগ্রহ করার পয়েন্ট</label>
                                            <select name="collection_point" id="collection_point" class="form-control form-control-user">
                                                <option selected disabled>নির্বাচন করুন</option>
                                                <option value="বাংলাবাজার">বাংলাবাজার</option>
                                                <option value="কাঁটাবন">কাঁটাবন</option>
                                                <option value="মিরপুর (হেড অফিস)">মিরপুর (হেড অফিস)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="payment_number">পেমেন্ট গ্রহণ করার জন্য আপনার নম্বরটি দিন</label>
                                            <input type="number" class="form-control form-control-user" id="payment_number" name="payment_number" value="{{old('payment_number')}}" placeholder="01712345678" maxlength="11" required>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="payment_option">আপনার নম্বরটি কোন সেবার আওতাধীন?</label>
                                            <select name="payment_option" id="payment_option" class="form-control form-control-user">
                                                <option selected disabled>নির্বাচন করুন</option>
                                                <option value="বিকাশ">বিকাশ</option>
                                                <option value="নগদ">নগদ</option>
                                                <option value="রকেট">রকেট</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 mb-3 mb-sm-0">
                                    <label for="email">আপনার ই-মেইল</label>
                                    <input type="email" class="form-control form-control-user" id="email" name="email" value="{{old('email')}}" placeholder="bdjp@booksbd.net"  autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="password">আপনার পাসওয়ার্ড দিন</label>
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="পাসওয়ার্ড লিখুন" autocomplete="off" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="password_confirmation ">আপনার পাসওয়ার্ডটি পুনরায় দিন</label>
                                    <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="পুনরায় পাসওয়ার্ড লিখুন" required>
                                </div>
                            </div>
                            <div class="">
                                <div class="pb-1 mb-2">
                                    <center>
                                        <img style="width: auto;border: 1px solid; max-height:200px;" id="viewer"
                                            src="{{asset('public\assets\back-end\img\400x400\img2.jpg')}}" alt="banner image"/>
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
@endsection
@push('script')
@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<script>
    $('#payment_number').keypress(function() {
        if (this.value.length >= 11) {
            return false;
        }
    });
    $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup',function () {
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass==passRepeat){
            $('.pass').hide();
        }
        else{
            $('.pass').show();
        }
    });
    $('#apply').on('click',function () {

        var image = $("#image-set").val();
        if (image=="")
        {
            $('.image').show();
            return false;
        }
        var pass = $("#exampleInputPassword").val();
        var passRepeat = $("#exampleRepeatPassword").val();
        if (pass!=passRepeat){
            $('.pass').show();
            return false;
        }


    });
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
