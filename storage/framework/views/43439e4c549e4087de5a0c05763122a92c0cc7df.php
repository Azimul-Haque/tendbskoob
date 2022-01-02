



<div class="container mt-4 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>; min-height: 400px;">
    <!-- General info tab-->
    <div class="row">
        <div class="col-lg-6 col-md-6" style="background: #F6F6F6;">
            <button type="button" class="btn btn-success" onclick="getSPToken()">Submit</button>
            <button type="button" class="btn btn-primary" onclick="testVerify()">Test Verify</button><br/>
            <span id="result"></span><br/>
            
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
                        return_url: 'http://localhost:8000/shurjopay/verify',
                        cancel_url: 'http://localhost:8000/shurjopay/test',
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
                        $('#result').text('Redirecting...');
                        var url = data2.checkout_url;
                        $(location).attr('href', url);
                    }
                });
            }
        });
    }
    function testVerify() {
        $.ajax({
            type: "POST",
            url: 'https://sandbox.shurjopayment.com/api/verification',
            data: {
                token: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvc2FuZGJveC5zaHVyam9wYXltZW50LmNvbVwvYXBpXC9sb2dpbiIsImlhdCI6MTY0MTE1MDMxMCwiZXhwIjoxNjQxMTUzOTEwLCJuYmYiOjE2NDExNTAzMTAsImp0aSI6ImFGTTY5MHE1M2FJZmtrc0giLCJzdWIiOjEsInBydiI6IjgwNWYzOWVlZmNjNjhhZmQ5ODI1YjQxMjI3ZGFkMGEwNzZjNDk3OTMifQ.Ed_FTWANdHXn5UnGp6Rkox7JsWi48sZaN4FC4f7PXl8',
                order_id: 'NOK61d1c007ccfc5',
            },
            success: function (data3) {
                console.log(data3);
                $('#result').text(data3);
            }
        });
    }
</script>
<?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/testpg.blade.php ENDPATH**/ ?>