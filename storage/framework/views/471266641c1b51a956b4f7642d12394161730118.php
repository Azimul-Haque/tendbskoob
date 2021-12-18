<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(\App\CPU\translate('Ready to Leave')); ?>?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"><?php echo e(\App\CPU\translate('Select "Logout" below if you are ready to end your current session')); ?>.</div>
            <div class="modal-footer">
                <form action="<?php echo e(route('admin.auth.logout')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo e(\App\CPU\translate('Cancel')); ?></button>
                    <button class="btn btn-primary" type="submit"><?php echo e(\App\CPU\translate('Logout')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\booksbd\resources\views/layouts/back-end/partials/_modals.blade.php ENDPATH**/ ?>