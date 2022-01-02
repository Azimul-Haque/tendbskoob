<?php $__env->startSection('content'); ?>
    <div class="container mt-4 rtl" style="text-align: <?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>; min-height: 400px;">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\booksbd\resources\views/web-views/testpg.blade.php ENDPATH**/ ?>