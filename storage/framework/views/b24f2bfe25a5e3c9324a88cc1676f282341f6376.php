<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Payment')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Payment')); ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4><?php echo e(__('Manage Payment')); ?></h4>
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

                                                        <th> <?php echo e(__('Transaction ID')); ?></th>
                                                        <th> <?php echo e(__('Invoice')); ?></th>
                                                        <th> <?php echo e(__('Payment Date')); ?></th>
                                                        <th> <?php echo e(__('Payment Method')); ?></th>
                                                        <th> <?php echo e(__('Note')); ?></th>
                                                        <th> <?php echo e(__('Amount')); ?></th>
                                                        <?php if(Gate::check('show invoice') || \Auth::user()->type=='client'): ?>
                                                            <th><?php echo e(__('Action')); ?></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo e(sprintf("%05d", $payment->transaction_id)); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(Auth::user()->invoiceNumberFormat($payment->invoice->invoice_id)); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(Auth::user()->dateFormat($payment->date)); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e((!empty($payment->payment)?$payment->payment->name:'')); ?>

                                                            </td>
                                                            <td class="td-style">
                                                                <?php echo e($payment->notes); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(Auth::user()->priceFormat($payment->amount)); ?>

                                                            </td>
                                                            <?php if(Gate::check('show invoice') || \Auth::user()->type=='client'): ?>
                                                                <td>
                                                                    <a href="<?php echo e(route('invoices.show',$payment->invoice->id)); ?>" class="table-action" data-toggle="tooltip" data-original-title="<?php echo e(__('Invoice Detail')); ?>">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                </td>
                                                            <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp-July\htdocs\Laravel\Grafimax-CRM\resources\views/invoices/all-payments.blade.php ENDPATH**/ ?>