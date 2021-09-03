<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo e((Utility::getValByName('header_text')) ? Utility::getValByName('header_text') : config('app.name', 'Workgo')); ?> - <?php echo $__env->yieldContent('page-title'); ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>" type="image" sizes="16x16">

    <link rel="stylesheet" href="<?php echo e(asset('assets/modules/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/modules/fontawesome/css/all.min.css')); ?>">

    <link href="<?php echo e(asset('assets/modules/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet" type="text/css"/>

    <link href="<?php echo e(asset('assets/modules/jquery-selectric/selectric.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/modules/bootstrap-toastr/toastr.min.css')); ?>" rel="stylesheet" type="text/css"/>

    <?php echo $__env->yieldPushContent('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>">
</head>
<?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/partials/admin/head.blade.php ENDPATH**/ ?>