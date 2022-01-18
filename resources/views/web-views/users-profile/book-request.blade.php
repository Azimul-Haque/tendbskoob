@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Book Request'))

@push('css_or_js')
    <style>
        .headerTitle {
            font-size: 24px;
            font-weight: 600;
            margin-top: 1rem;
        }

        body {
            font-family: 'Titillium Web', sans-serif
        }

        .product-qty span {
            font-size: 14px;
            color: #6A6A6A;
        }

        .font-nameA {
            font-weight: 600;
            display: inline-block;
            margin-bottom: 0;
            font-size: 17px;
            color: #030303;
        }

        .spandHeadO {
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px !important;

        }

        .tdBorder {
            border-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 1px solid #f7f0f0;
            text-align: center;
        }

        .bodytr {
            border: 1px solid #dadada;
            text-align: center;
        }

        .sellerName {
            font-size: 15px;
            font-weight: 600;
        }

        .modal-footer {
            border-top: none;
        }

        .sidebarL h3:hover + .divider-role {
            border-bottom: 3px solid {{$web_config['primary_color']}}                !important;
            transition: .2s ease-in-out;
        }

        .marl {
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 7px;
        }
        .badge-warning{
            color:white;
            background: {{$web_config['primary_color']}};

        }
        .badge-secondary{
            color:white;
            background: {{$web_config['secondary_color']}};
        }
        .badge-success {

        }

         .for-margin-sms{
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 56.3333333333%;
         }
         @media(max-width:475px){
            .for-margin-sms {
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0.333333%;
           }
         }
        @media (max-width: 600px) {
            .sidebar_heading {
                background: {{$web_config['primary_color']}}
                }
            .sidebar_heading h1 {
                text-align: center;
                color: aliceblue;
                padding-bottom: 17px;
                font-size: 19px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Page Title-->
    <div class="container rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10 sidebar_heading">
                <h1 class="h3  mb-0 float-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} headerTitle">{{\App\CPU\translate('Book Request')}}</h1>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-3 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
        <!-- Content  -->
            <div class="col-md-2"></div>
            <section class="col-md-8">
                <form class="mt-3 card p-3" method="post" action="{{route('submit-book-request')}}" id="open-ticket">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ticket_subject">বইয়ের নাম</label>
                            <input type="text" class="form-control" id="ticket-subject" name="ticket_subject" placeholder="বইয়ের নাম" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="detaaddressils">বিস্তারিত তথ্য</label>
                            <textarea class="form-control" rows="6" id="ticket-description" name="ticket_description" placeholder="লেখকের নাম&#10;প্রকাশনীর নাম&#10;এবং বই সংক্রান্ত যে কোন তথ্য যা আমাদের বইটি খুঁজে পেতে সহায়তা করবে।" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <button type="submit" class="btn btn-primary col-md-6">অনুরোধ করুন</button>
                    </div>
                </form>
            </section>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection

@push('script')

@endpush
