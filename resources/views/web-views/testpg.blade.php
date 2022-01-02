{{-- @extends('layouts.front-end.app') --}}



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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function getSPToken() {
        $.ajax({
            type: "POST",
            url: 'https://sandbox.shurjopayment.com/api/get_token',
            data: {
                username: 'sp_sandbox',
                password: 'pyyk97hu&6u6',
            },
            success: function (data1) {
                console.log(data1);
                $('#result').text('Got Token, processing...');
                $.ajax({
                    type: "POST",
                    url: data1.execute_url,
                    data: {
                        token: data1.token,
                        store_id: data1.store_id,
                        prefix: 'RIFAT',
                        currency: 'BDT',
                        return_url: 'http://localhost:8000/pay-shurjo-pay-test',
                        cancel_url: 'http://localhost:8000/pay-shurjo-pay-test',
                        amount: 10,
                        order_id: 'RIFAT' + Math.floor((Math.random() * 1000000) + 1),
                        client_ip: '127.0.0.1',
                        customer_name: 'Rifat',
                        customer_phone: Math.floor((Math.random() * 1000000) + 1),
                        customer_email: Math.floor((Math.random() * 1000000) + 1) + '@booksbd.net',
                        customer_address: 'Dhaka',
                        customer_city: 'Dhaka',
                        value1: 'Test Data 1',
                    },
                    success: function (data2) {
                        console.log(data2);
                        $('#result').text(JSON.stringify(data2));
                    }
                });
            }
        });
    }
</script>
