<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Orders')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Orders')); ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4><?php echo e(__('Manage Orders')); ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0">
                                <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush" id="dataTable">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th><?php echo e(__('Order Id')); ?></th>
                                                        <th><?php echo e(__('Name')); ?></th>
                                                        <th><?php echo e(__('Plan Name')); ?></th>
                                                        <th><?php echo e(__('Price')); ?></th>
                                                        <th><?php echo e(__('Status')); ?></th>
                                                        <th><?php echo e(__('Date')); ?></th>
                                                        <th class="text-center"><?php echo e(__('Invoice')); ?></th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($order->order_id); ?></td>
                                                            <td><?php echo e($order->user_name); ?></td>
                                                            <td><?php echo e($order->plan_name); ?></td>
                                                            <td>$<?php echo e(number_format($order->price)); ?></td>
                                                            <td>
                                                                <?php if($order->payment_status == 'succeeded'): ?>
                                                                    <i class="mdi mdi-circle text-success"></i> <?php echo e(ucfirst($order->payment_status)); ?>

                                                                <?php else: ?>
                                                                    <i class="mdi mdi-circle text-danger"></i> <?php echo e(ucfirst($order->payment_status)); ?>

                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                                                            <td class="text-center">
                                                                <?php if(!empty($order->receipt)): ?>
                                                                    <a href="<?php echo e($order->receipt); ?>" title="Invoice" target="_blank" class=""><i class="fas fa-file-invoice"></i> </a>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Projects\Laravel\Grafimax-CRM\resources\views/order/index.blade.php ENDPATH**/ ?>