@extends('layouts.front-end.app')



@section('content')
    <div class="container mt-4 rtl" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}}; min-height: 400px;">
        <!-- General info tab-->
        <div class="row">
            <div class="col-lg-6 col-md-6" style="background: #F6F6F6;">
                <form>
                    <button type="button" class="btn btn-success" onclick="getSPToken()">Submit</button>
                </form>
                <span id="result"></span>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function getSPToken() {
            $.ajax({
                type: "POST",
                url: 'https://engine.shurjopayment.com/api/get_token',
                data: {
                    username: 'booksbd',
                    password: 'nUdFqfaFzDq7',
                },
                success: function (respons) {
                    console.log('send successfully');
                    $('#result').text(respons);
                }
            });
        }
    </script>
@endpush
