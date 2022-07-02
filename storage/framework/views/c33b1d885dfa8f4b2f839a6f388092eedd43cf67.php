<script src="<?php echo e(asset('assets/modules/jquery.min.js')); ?> "></script>
<script src="<?php echo e(asset('assets/modules/popper.js')); ?> "></script>
<script src="<?php echo e(asset('assets/modules/tooltip.js')); ?> "></script>
<script src="<?php echo e(asset('assets/modules/bootstrap/js/bootstrap.min.js')); ?> "></script>
<script src="<?php echo e(asset('assets/modules/nicescroll/jquery.nicescroll.min.js')); ?> "></script>
<script src="<?php echo e(asset('assets/modules/moment.min.js')); ?> "></script>
<script src="<?php echo e(asset('assets/js/stisla.js')); ?> "></script>

<script src="<?php echo e(asset('assets/modules/jquery.sparkline.min.js')); ?> "></script>

<script src="<?php echo e(asset('assets/modules/chart/Chart.min.js')); ?> "></script>
<script src="<?php echo e(asset('assets/modules/chart/Chart.extension.js')); ?> "></script>


<script src="<?php echo e(asset('assets/modules/datatables/datatables.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/modules/datatables/datatables.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/modules/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/modules/bootstrap-toastr/toastr.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/modules/bootstrap-toastr/ui-toastr.min.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/modules/jquery-selectric/jquery.selectric.min.js')); ?> "></script>


<script src="<?php echo e(asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js')); ?> "></script>
<script src="<?php echo e(asset('assets/js/jquery.easy-autocomplete.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/scripts.js')); ?> "></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?> "></script>
<script src="<?php echo e(asset('assets/js/jscolor.js')); ?> "></script>
<script src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>

<script>
    var options = {
        url: function (phrase) {
            return "<?php echo e(route('search.json')); ?>/" + phrase;
        },
        categories: [
            {
                listLocation: "Projects",
                header: "<?php echo e(__('PROJECTS')); ?>"
            },
            {
                listLocation: "Tasks",
                header: "<?php echo e(__('TASKS')); ?>"
            }
        ],
        getValue: "text",
        template: {
            type: "links",
            fields: {
                link: "link"
            }
        }
    };

    $(".search-element input").easyAutocomplete(options);
</script>


<?php if($message = Session::get('success')): ?>
    <script>
        toastrs('Success', '<?php echo $message; ?>', 'success')
    </script>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
    <script>toastrs('Error', '<?php echo $message; ?>', 'error')</script>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
    <script>toastrs('Info', '<?php echo $message; ?>', 'info')</script>
<?php endif; ?>

<?php echo $__env->yieldPushContent('script-page'); ?>
<?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/partials/admin/footer.blade.php ENDPATH**/ ?>